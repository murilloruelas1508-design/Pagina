<?php
session_start();
header('Content-Type: text/plain; charset=utf-8');

/* ===== Idioma ===== */
$lang = $_SESSION['lang'] ?? 'es';

function msg($es, $en) {
    global $lang;
    return ($lang === 'en') ? $en : $es;
}

/* =========================
   Conexión a la BD
   ========================= */
$servername = "localhost";
$dbuser     = "root";
$dbpass     = "";
$dbname     = "ECOCYTE";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    echo "error_conexion";
    exit;
}
$conn->set_charset("utf8");

/* =========================
   Lista oficial de actividades
   ========================= */
$actividades_oficiales = [
    'limpieza'       => 'Campañas de Limpieza',
    'reciclaje'      => 'Talleres de Reciclaje y Reutilización',
    'reforestacion'  => 'Reforestación',
    'conferencias'   => 'Conferencias y Charlas Ambientales',
    'eventos'        => 'Eventos Especiales'
];

/* =========================
   Verificar sesión
   ========================= */
if (!isset($_SESSION['usuario_id'])) {
    echo "nologin";
    $conn->close();
    exit;
}

$codigo_usuario = intval($_SESSION['usuario_id']);
$tipo_usuario = $_SESSION['usuario_tipo'] ?? 'alumno'; // ejemplo: 'alumno', 'directivo', etc.

/* =========================
   Validar datos enviados
   ========================= */
$actividad_id = trim($_POST['actividad'] ?? '');
$horario = trim($_POST['horario'] ?? '');

if ($actividad_id === '' || $horario === '') {
    echo "error_datos";
    $conn->close();
    exit;
}

/* Validar actividad */
$actividad = $actividades_oficiales[$actividad_id] ?? null;
if ($actividad === null) {
    echo "actividad_invalida";
    $conn->close();
    exit;
}

/* =========================
   Verificar duplicado
   ========================= */
$stmt = $conn->prepare("
    SELECT id FROM actividades
    WHERE codigo_usuario = ? AND actividad = ? AND horario = ?
");
if (!$stmt) {
    echo "error_sql_prepare";
    $conn->close();
    exit;
}
$stmt->bind_param("iss", $codigo_usuario, $actividad, $horario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "duplicado";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

/* =========================
   Obtener plantel del alumno
   ========================= */
$stmtPlantel = $conn->prepare("SELECT plantel FROM usuarios WHERE codigo_usuario = ?");
$stmtPlantel->bind_param("i", $codigo_usuario);
$stmtPlantel->execute();
$stmtPlantel->bind_result($plantel_alumno);
$stmtPlantel->fetch();
$stmtPlantel->close();

/* =========================
   Buscar encargado aprobado del mismo plantel
   ========================= */
$codigo_encargado = null;
$stmtEnc = $conn->prepare("
    SELECT se.codigo_usuario
    FROM solicitudes_encargado se
    INNER JOIN usuarios u ON se.codigo_usuario = u.codigo_usuario
    WHERE se.actividad = ? AND se.estado = 'aprobado' AND u.plantel = ?
    LIMIT 1
");
if (!$stmtEnc) {
    echo "error_sql_prepare";
    $conn->close();
    exit;
}
$stmtEnc->bind_param("ss", $actividad, $plantel_alumno);
$stmtEnc->execute();
$stmtEnc->bind_result($enc);
$stmtEnc->fetch();
$stmtEnc->close();

if (!empty($enc)) {
    $codigo_encargado = $enc;
}

/* =========================
   Bloquear inscripción si no hay encargado y el usuario es alumno
   ========================= */
if ($codigo_encargado === null) {
    echo msg(
        "No puedes participar si aún no hay un encargado para esta actividad.",
        "You cannot participate until a coordinator has been assigned to this activity."
    );
    $conn->close();
    exit;
}



/* =========================
   Insertar actividad
   ========================= */
$stmtIns = $conn->prepare("
    INSERT INTO actividades (codigo_usuario, actividad, horario, codigo_encargado)
    VALUES (?, ?, ?, ?)
");
if (!$stmtIns) {
    echo "error_sql_prepare";
    $conn->close();
    exit;
}
$stmtIns->bind_param("issi", $codigo_usuario, $actividad, $horario, $codigo_encargado);

/* Ejecutar e informar resultado */
if ($stmtIns->execute()) {
    echo "ok";
} else {
    echo "error_sql: " . $stmtIns->error;
}

$stmtIns->close();
$conn->close();
?>
