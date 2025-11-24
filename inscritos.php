<?php
session_start();

// ================== LANG ==================
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';

// ================== TEXTOS ==================
$txt = [
    'es' => [
        'titulo' => 'Alumnos Inscritos',
        'estado' => 'Estado',
        'nombre' => 'Nombre',
        'correo' => 'Correo',
        'plantel' => 'Plantel',
        'semestre' => 'Semestre',
        'horarios' => 'Horarios',
        'activo' => 'activo',
        'inactivo' => 'inactivo',
        'no_inscritos' => 'No hay alumnos inscritos aún.',
        'regresar' => 'Regresar a mi perfil',
        'footer'=>'© 2025 ECOCYTE – Proyecto ecológico',
        'menu' => [
            'inicio' => 'Inicio',
            'nosotros' => 'Nosotros',
            'materiales' => 'Todo sobre tus Materiales ▾',
            'plastico' => 'Plástico',
            'papel' => 'Papel',
            'vidrio' => 'Vidrio',
            'metal' => 'Metal',
            'carton' => 'Cartón',
            'organico' => 'Orgánico',
            'actividades' => 'Actividades',
            'manualidades' => 'Manualidades',
            'conferencias' => 'Conferencias',
            'registro' => 'Registro',
            'mas' => 'Más ▾',
            'galeria' => 'Galería',
            'contacto' => 'Contacto',
            'perfil' => 'Perfil'
        ],
    ],
    'en' => [
        'titulo' => 'Enrolled Students',
        'estado' => 'Status',
        'nombre' => 'Name',
        'correo' => 'Email',
        'plantel' => 'Campus',
        'semestre' => 'Semester',
        'horarios' => 'Schedules',
        'activo' => 'active',
        'inactivo' => 'inactive',
        'no_inscritos' => 'No students enrolled yet.',
        'regresar' => 'Return to my profile',
        'footer'=>'© 2025 ECOCYTE – Ecology Project',
        'menu' => [
            'inicio' => 'Home',
            'nosotros' => 'About Us',
            'materiales' => 'All About Your Materials ▾',
            'plastico' => 'Plastic',
            'papel' => 'Paper',
            'vidrio' => 'Glass',
            'metal' => 'Metal',
            'carton' => 'Cardboard',
            'organico' => 'Organic',
            'actividades' => 'Activities',
            'manualidades' => 'Crafts',
            'conferencias' => 'Conferences',
            'registro' => 'Register',
            'mas' => 'More ▾',
            'galeria' => 'Gallery',
            'contacto' => 'Contact',
            'perfil' => 'Profile'
        ],
    ]
];

// ================== NOMBRES ACTIVIDADES ==================
$nombre_formal_es = [
    'limpieza' => 'Campañas de Limpieza',
    'reciclaje' => 'Talleres de Reciclaje y Reutilización',
    'reforestacion' => 'Reforestación',
    'conferencias' => 'Conferencias y Charlas Ambientales',
    'eventos' => 'Eventos Especiales'
];

$nombre_formal_en = [
    'limpieza' => 'Cleaning Campaigns',
    'reciclaje' => 'Recycling and Reuse Workshops',
    'reforestacion' => 'Reforestation',
    'conferencias' => 'Environmental Conferences and Talks',
    'eventos' => 'Special Events'
];

$nombre_formal_actual = $lang === 'en' ? $nombre_formal_en : $nombre_formal_es;

// ================== SESIÓN ==================
if (!isset($_SESSION['usuario_id'])) {
    header("Location: Registro.php");
    exit;
}

$codigo_encargado = $_SESSION['usuario_id'];
$actividad_id = intval($_GET['id'] ?? 0);
if ($actividad_id <= 0) die("Actividad no válida.");

// ================== CONEXIÓN ==================
$conn = new mysqli("localhost", "root", "", "ECOCYTE");
if ($conn->connect_error) die("Error BD: " . $conn->connect_error);

// ================== OBTENER ACTIVIDAD ==================
$stmt = $conn->prepare("
    SELECT actividad 
    FROM actividades_encargado 
    WHERE id=? AND codigo_encargado=?
");
$stmt->bind_param("ii", $actividad_id, $codigo_encargado);
$stmt->execute();
$actividad = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$actividad) die("Actividad no encontrada o no eres el encargado.");

// ================== CAMBIO DE ESTADO ==================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_usuario'], $_POST['estado'])) {
    $codigo_usuario = intval($_POST['codigo_usuario']);
    $estado = $_POST['estado'] === 'activo' ? 'activo' : 'inactivo';
    $stmtUpd = $conn->prepare("
        UPDATE actividades 
        SET estado=? 
        WHERE codigo_usuario=? AND actividad=? AND codigo_encargado=?
    ");
    $stmtUpd->bind_param("siis", $estado, $codigo_usuario, $actividad['actividad'], $codigo_encargado);
    echo $stmtUpd->execute() ? 'ok' : 'error';
    $stmtUpd->close();
    $conn->close();
    exit;
}

// ================== OBTENER INSCRITOS ==================
$stmt2 = $conn->prepare("
    SELECT u.codigo_usuario, u.nombre, u.correo, u.plantel, u.semestre, 
           GROUP_CONCAT(a.horario SEPARATOR ', ') AS horarios,
           a.estado
    FROM actividades a
    JOIN usuarios u ON a.codigo_usuario = u.codigo_usuario
    WHERE a.codigo_encargado = ? AND a.actividad = ?
    GROUP BY u.codigo_usuario, u.nombre, u.correo, u.plantel, u.semestre, a.estado
    ORDER BY u.nombre ASC
");
$stmt2->bind_param("is", $codigo_encargado, $actividad['actividad']);
$stmt2->execute();
$inscritos = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt2->close();
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($nombre_formal_actual[$actividad['actividad']] ?? $actividad['actividad']) ?></title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    color: #3e2723;

}


/* ===================== HEADER FIJO ===================== */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #A9B192;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 20px;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}


/* Logo con animación */
.logo img {
    height: 60px;
    animation: shine 4s linear infinite;
}


/* ===================== MENÚ ===================== */
nav.menu {
    flex: 1;
    text-align: center;
}
nav.menu ul {
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 15px;
}
nav.menu li {
    position: relative;
}
nav.menu li a {
    display: block;
    padding: 8px 12px;
    font-weight: bold;
    color: white;
    text-decoration: none;
    transition: 0.3s;
}
nav.menu li a:hover {
    background: #8d6e63;
    border-radius: 4px;
}


/* Submenú */
nav.menu .submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #A9B192;
    min-width: 180px;
}
nav.menu li:hover .submenu {
    display: block;
}
nav.menu .submenu li a {
    padding: 8px 12px;
}


/* ===================== CAMBIO DE IDIOMA ===================== */
.language {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: bold;
    color: white;
    font-size: 0.9rem;
    gap: 5px;
}
.language span {
    font-size: 0.85rem;
}
.language .flags {
    display: flex;
    gap: 5px;
}
.language .flag {
    width: 30px;
    cursor: pointer;
    vertical-align: middle;
}
.contenido {
    background-color: #fff;       /* Fondo blanco */
    border: 1px solid #ccc;       /* Borde gris */
    border-radius: 10px;          /* Bordes redondeados */
    padding: 20px;                /* Espacio interno */
    margin: 120px auto 40px;      /* Separación del header y margen inferior */
    max-width: 1100px;            /* Ancho máximo */
    box-shadow: 0 4px 12px rgba(0,0,0,0.1); /* Sombra para efecto “tarjeta” */
}



/* ===================== ANIMACIONES ===================== */
@keyframes shine {
    0% { filter: brightness(1); }
    50% { filter: brightness(1.5); }
    100% { filter: brightness(1); }
}

/* TABLA */
table {
    border-collapse: collapse;
    width: 100%;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}
th {
    background-color: #8d6e63;
    color: white;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* BOTONES DE ESTADO */
button.toggle-estado {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}
button.activo {
    background-color: #4CAF50;
    color: white;
}
button.inactivo {
    background-color: #f44336;
    color: white;
}

/* ENLACES */
a {
    color: #8d6e63;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
/* ===================== FOOTER ===================== */
footer {
    text-align: center;
    background: #A9B192;
    color: white;
    padding: 12px;
    margin-top: 30px;

    position: fixed;     /* Lo fija en la pantalla */
    bottom: 0;           /* Pegado abajo */
    left: 0;             /* Alineado a la izquierda */
    width: 100%;         /* Ocupa todo el ancho */
}
</style>
</head>
<header>

    <div class="logo"><a href="../index.php">
    <img src="../ECOCYTE.png" class="logo" alt="Logo CECYTE">
    </a></div>
    <nav class="menu">
        
<ul>
  <li><a href="index.php"><?php echo $txt[$lang]['menu']['inicio']; ?></a></li>
  <li><a href="nosotros.php"><?php echo $txt[$lang]['menu']['nosotros']; ?></a></li>

  <li>
    <a href="#"><?php echo $txt[$lang]['menu']['materiales']; ?></a>
    <ul class="submenu">
      <li><a href="Materiales/plastico.php"><?php echo $txt[$lang]['menu']['plastico']; ?></a></li>
      <li><a href="Materiales/papel.php"><?php echo $txt[$lang]['menu']['papel']; ?></a></li>
      <li><a href="Materiales/vidrio.php"><?php echo $txt[$lang]['menu']['vidrio']; ?></a></li>
      <li><a href="Materiales/metal.php"><?php echo $txt[$lang]['menu']['metal']; ?></a></li>
      <li><a href="Materiales/carton.php"><?php echo $txt[$lang]['menu']['carton']; ?></a></li>
      <li><a href="Materiales/organico.php"><?php echo $txt[$lang]['menu']['organico']; ?></a></li>
    </ul>
  </li>

  <li><a href="actividades.php"><?php echo $txt[$lang]['menu']['actividades']; ?></a></li>
  <li><a href="Registro.php"><?php echo $txt[$lang]['menu']['registro']; ?></a></li>

  <li>
    <a href="#"><?php echo $txt[$lang]['menu']['mas']; ?></a>
    <ul class="submenu">
      <li><a href="perfil.php"><?php echo $txt[$lang]['menu']['perfil']; ?></a></li>
      <li><a href="galeria.php"><?php echo $txt[$lang]['menu']['galeria']; ?></a></li>
      <li><a href="contacto.php"><?php echo $txt[$lang]['menu']['contacto']; ?></a></li>
      
    </ul>
  </li>
</ul>

    </nav>
         <?php
// Obtener todos los parámetros de la URL actual
$params = $_GET;

// Generar enlaces de idioma manteniendo parámetros
$params_es = $params;
$params_es['lang'] = 'es';
$link_es = $_SERVER['PHP_SELF'] . '?' . http_build_query($params_es);

$params_en = $params;
$params_en['lang'] = 'en';
$link_en = $_SERVER['PHP_SELF'] . '?' . http_build_query($params_en);
?>
<div class="language">
    <span>Cambiar idioma:</span>
    <div>
        <a href="<?= htmlspecialchars($link_es) ?>"><img src="mexicob.png" class="flag" alt="Español"></a>
        <a href="<?= htmlspecialchars($link_en) ?>"><img src="USAb.png" class="flag" alt="English"></a>
    </div>
</div>
</header>
<body>
<div class="contenido">
<h2><?= htmlspecialchars($nombre_formal_actual[$actividad['actividad']] ?? $actividad['actividad']) ?></h2>

<?php if(count($inscritos) > 0): ?>
<table>
<thead>
<tr>
    <th><?= $txt[$lang]['nombre'] ?></th>
    <th><?= $txt[$lang]['correo'] ?></th>
    <th><?= $txt[$lang]['plantel'] ?></th>
    <th><?= $txt[$lang]['semestre'] ?></th>
    <th><?= $txt[$lang]['horarios'] ?></th>
    <th><?= $txt[$lang]['estado'] ?></th>
</tr>
</thead>
<tbody>
<?php foreach($inscritos as $alumno): ?>
<tr>
    <td><?= htmlspecialchars($alumno['nombre']) ?></td>
    <td><?= htmlspecialchars($alumno['correo']) ?></td>
    <td><?= htmlspecialchars($alumno['plantel']) ?></td>
    <td><?= htmlspecialchars($alumno['semestre']) ?></td>
    <td><?= htmlspecialchars($alumno['horarios']) ?></td>
    <td>
        <button class="toggle-estado <?= $alumno['estado'] ?>" 
                data-codigo="<?= $alumno['codigo_usuario'] ?>"
                data-estado="<?= $alumno['estado'] ?>">
            <?= $txt[$lang][$alumno['estado']] ?>
        </button>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
<p><?= $txt[$lang]['no_inscritos'] ?></p>
<?php endif; ?>

<br>
<a href="perfil.php"><?= $txt[$lang]['regresar'] ?></a>
</div>
<script>
document.querySelectorAll('.toggle-estado').forEach(btn => {
    btn.addEventListener('click', () => {
        const codigo = btn.dataset.codigo;
        const estadoActual = btn.dataset.estado;
        const nuevoEstado = estadoActual === 'activo' ? 'inactivo' : 'activo';

        fetch('', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `codigo_usuario=${codigo}&estado=${nuevoEstado}`
        })
        .then(res => res.text())
        .then(res => {
            if(res === 'ok'){
                btn.textContent = nuevoEstado;
                btn.dataset.estado = nuevoEstado;
                btn.classList.remove('activo','inactivo');
                btn.classList.add(nuevoEstado);
            } else {
                alert('Error al cambiar estado');
            }
        });
    });
});
</script>

<footer>
   <?php echo $txt[$lang]['footer']; ?>
</footer>

</body>
</html>
