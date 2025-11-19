<?php
session_start();
header('Content-Type: text/plain; charset=utf-8');

/* 1) Verificar sesión */
if (!isset($_SESSION['usuario_id'])) {
    echo "nologin";
    exit;
}

/* 2) Validar método */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "invalid";
    exit;
}

$codigo_usuario = intval($_SESSION['usuario_id']);
$actividad      = trim($_POST['actividad'] ?? '');
$horario        = trim($_POST['horario'] ?? '');

if ($actividad === '' || $horario === '') {
    echo "faltan_datos";
    exit;
}

/* 3) Conexión a la BD */
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

/* 4) Verificar duplicado */
$check = $conn->prepare("SELECT 1 FROM actividades WHERE codigo_usuario=? AND actividad=? AND horario=? LIMIT 1");
$check->bind_param("iss", $codigo_usuario, $actividad, $horario);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "duplicado";
    exit;
}
$check->close();

/* 5) Insertar */
$stmt = $conn->prepare("INSERT INTO actividades (codigo_usuario, actividad, horario) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $codigo_usuario, $actividad, $horario);

echo $stmt->execute() ? "ok" : "error_insertar";

$stmt->close();
$conn->close();
