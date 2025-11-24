<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Conexión a la BD
$conn = new mysqli("localhost", "root", "", "ECOCYTE");
if ($conn->connect_error) die("Error BD: " . $conn->connect_error);


/* ============================================================
   1️⃣ VER PERFIL DEL USUARIO (para aprobar/rechazar)
   ============================================================ */
if (isset($_GET['ver_id'])) {
    $usuario_id = (int)$_GET['ver_id'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE codigo_usuario=?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();
    if (!$usuario) die("Usuario no encontrado.");

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Perfil de Usuario</title>
        <style>
            body { font-family: Arial; background: #f5f5f5; color: #3e2723; padding: 20px; }
            .perfil { background: white; padding: 20px; border-radius: 10px; max-width: 600px; margin:auto;
                      box-shadow: 0 0 12px rgba(0,0,0,0.1); }
            .btn { padding:10px 20px; color:white; text-decoration:none; border-radius:5px; margin-right:10px;}
            .aprobar { background: green; }
            .rechazar { background: red; }
        </style>
    </head>
    <body>
    <div class="perfil">
        <h2>Perfil de <?= htmlspecialchars($usuario['nombre']) ?></h2>
        <p><b>ID:</b> <?= $usuario['codigo_usuario'] ?></p>
        <p><b>Correo:</b> <?= $usuario['correo'] ?></p>
        <p><b>Tipo:</b> <?= $usuario['tipo'] ?></p>
        <p><b>Plantel:</b> <?= $usuario['plantel'] ?></p>
        <p><b>Semestre:</b> <?= $usuario['semestre'] ?></p>
        <p><b>Participación:</b> <?= $usuario['participacion'] ?></p>
        <p><b>Motivación:</b> <?= $usuario['motivo'] ?></p>
        <p><b>Intereses:</b> <?= $usuario['intereses'] ?></p>

        <?php
        if (isset($_GET['admin_id'])):
            $admin_id = (int)$_GET['admin_id'];

            $stmt = $conn->prepare("SELECT tipo FROM usuarios WHERE codigo_usuario=?");
            $stmt->bind_param("i", $admin_id);
            $stmt->execute();
            $admin = $stmt->get_result()->fetch_assoc();

            if ($admin):
        ?>
            <p>
                <a href="?accion=aprobar&id=<?= $usuario_id ?>&admin_id=<?= $admin_id ?>" class="btn aprobar">Aprobar</a>
                <a href="?accion=rechazar&id=<?= $usuario_id ?>&admin_id=<?= $admin_id ?>" class="btn rechazar">Rechazar</a>
            </p>
        <?php
            endif;
        endif;
        ?>
    </div>
    </body>
    </html>
    <?php
    exit;
}


/* ============================================================
   2️⃣ APROBAR O RECHAZAR SOLICITUD
   ============================================================ */
if (isset($_GET['accion'], $_GET['id'], $_GET['admin_id'])) {

    $usuario_id = (int)$_GET['id'];
    $accion = $_GET['accion'];
    $admin_id = (int)$_GET['admin_id'];

    // Verificar permisos
    $stmt = $conn->prepare("SELECT tipo FROM usuarios WHERE codigo_usuario=?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if (!$admin) die("Admin inválido.");
    if (!in_array($admin['tipo'], ['docente', 'directivo', 'administrativo']))
        die("El usuario no tiene permisos.");

    // Obtener la actividad solicitada
    $stmt = $conn->prepare("SELECT actividad FROM solicitudes_encargado 
                        WHERE codigo_usuario=? AND estado='pendiente'
                        ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $solicitud = $stmt->get_result()->fetch_assoc();

    if (!$solicitud) die("No hay solicitud pendiente.");   

    $actividad_nombre_formal = $solicitud['actividad'];

    if ($accion === 'aprobar') {

    // Guardar encargado REAL
    $stmt = $conn->prepare("
        INSERT INTO actividades_encargado (actividad, codigo_encargado)
        VALUES (?, ?)
    ");
    $stmt->bind_param("si", $actividad_nombre_formal, $usuario_id);
    $stmt->execute();

    // ACTUALIZAR al usuario como encargado
    $stmt = $conn->prepare("
    UPDATE usuarios 
    SET codigo_encargado=? 
    WHERE codigo_usuario=?
    ");
    $stmt->bind_param("ii", $usuario_id, $usuario_id);
    $stmt->execute();


    // Actualizar estado solicitud
    $stmt = $conn->prepare("
        UPDATE solicitudes_encargado 
        SET estado='aprobado', admin_id=? 
        WHERE codigo_usuario=?
    ");
    $stmt->bind_param("ii", $admin_id, $usuario_id);
    $stmt->execute();

    // =====================================
    // ENVIAR CORREO AL USUARIO APROBADO
    // =====================================
    $stmt = $conn->prepare("SELECT correo, nombre FROM usuarios WHERE codigo_usuario=?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $usuario_datos = $stmt->get_result()->fetch_assoc();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "murilloruelas1508@gmail.com";
        $mail->Password = "xozcrjqlezsdewkn";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom("murilloruelas1508@gmail.com", "Sistema ECOCYTE");
        $mail->addAddress($usuario_datos['correo'], $usuario_datos['nombre']);

        $mail->isHTML(true);
        $mail->Subject = "Solicitud aprobada - ECOCYTE";
        $mail->Body = "
            <h3>¡Felicidades!</h3>
            <p>Tu solicitud para ser encargado de la actividad <b>$actividad_nombre_formal</b> ha sido <b>aprobada</b>.</p>
            <p>Ahora formas parte de los encargados de esta actividad.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        echo "No se pudo enviar el correo al usuario: " . $mail->ErrorInfo;
    }

    echo "<p>Solicitud aprobada. El usuario ahora es encargado.</p>";
} else { // rechazo de solicitud

    $stmt = $conn->prepare("
        UPDATE solicitudes_encargado 
        SET estado='rechazado', admin_id=? 
        WHERE codigo_usuario=?
    ");
    $stmt->bind_param("ii", $admin_id, $usuario_id);
    $stmt->execute();

    // =====================================
    // ENVIAR CORREO AL USUARIO RECHAZADO
    // =====================================
    $stmt = $conn->prepare("SELECT correo, nombre FROM usuarios WHERE codigo_usuario=?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $usuario_datos = $stmt->get_result()->fetch_assoc();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "murilloruelas1508@gmail.com";
        $mail->Password = "xozcrjqlezsdewkn";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom("murilloruelas1508@gmail.com", "Sistema ECOCYTE");
        $mail->addAddress($usuario_datos['correo'], $usuario_datos['nombre']);

        $mail->isHTML(true);
        $mail->Subject = "Solicitud rechazada - ECOCYTE";
        $mail->Body = "
            <h3>Solicitud rechazada</h3>
            <p>Tu solicitud para ser encargado de la actividad <b>$actividad_nombre_formal</b> ha sido <b>rechazada</b>.</p>
            <p>Si crees que hubo un error o deseas intentarlo de nuevo, puedes enviar otra solicitud.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        echo "No se pudo enviar el correo al usuario: " . $mail->ErrorInfo;
    }

    echo "<p>Solicitud rechazada.</p>";
}

    echo "<p><a href='http://localhost/Pagina/perfil.php'>Volver</a></p>";
    exit;
}


/* ============================================================
   3️⃣ ENVIAR SOLICITUD DEL USUARIO
   ============================================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['usuario_id'], $_POST['actividad']))
        die("No tienes permisos o falta la actividad.");

    $actividad_id = $_POST['actividad'];
    $usuario_id = $_SESSION["usuario_id"];
    $usuario_nombre = $_SESSION["usuario_nombre"];

    // Mapeo formal FORZADO
    $actividades = [
        'limpieza' => 'Campañas de Limpieza',
        'reciclaje' => 'Talleres de Reciclaje y Reutilización',
        'reforestacion' => 'Reforestación',
        'conferencias' => 'Conferencias y Charlas Ambientales',
        'eventos' => 'Eventos Especiales'
    ];

    $actividad_formal = $actividades[$actividad_id] ?? null;

    if ($actividad_formal === null)
        die("Actividad inválida.");

    // Insertar solicitud con NOMBRE FORMAL
    $stmt = $conn->prepare("
        INSERT INTO solicitudes_encargado (codigo_usuario, actividad, estado)
        VALUES (?, ?, 'pendiente')
    ");
    $stmt->bind_param("is", $usuario_id, $actividad_formal);
    $stmt->execute();

    // Seleccionar admin
    $admin = $conn->query("
        SELECT codigo_usuario FROM usuarios 
        WHERE tipo IN ('docente','directivo','administrativo') 
        ORDER BY RAND() LIMIT 1
    ")->fetch_assoc();

    $admin_id = $admin['codigo_usuario'];

    // Enviar correo
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "murilloruelas1508@gmail.com";
        $mail->Password = "xozcrjqlezsdewkn";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom("murilloruelas1508@gmail.com", "Sistema ECOCYTE");
        $mail->addAddress("murilloruelas1508@gmail.com");

        $ver_url = "http://localhost/Pagina/solicitar_encargado.php?ver_id=$usuario_id&admin_id=$admin_id";

        $mail->isHTML(true);
        $mail->Subject = "Solicitud para encargado - ECOCYTE";
        $mail->Body = "
            <h3>Solicitud de encargado</h3>
            <p><b>ID Usuario:</b> $usuario_id</p>
            <p><b>Usuario:</b> $usuario_nombre</p>
            <p><b>Actividad:</b> $actividad_formal</p>
            <p><a href='$ver_url' style='padding:10px 20px;background:blue;color:white;text-decoration:none;border-radius:5px;'>Revisar perfil</a></p>
        ";

        $mail->send();
        echo "Solicitud enviada correctamente.";

    } catch (Exception $e) {
        echo "Error enviando correo: " . $mail->ErrorInfo;
    }

    exit;
}


// Acceso directo
echo "Acceso no permitido.";
?>
