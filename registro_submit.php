<?php
session_start();

$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ECOCYTE";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) die("Error: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password_raw = $_POST["password"];
    $telefono = $_POST["telefono"];
    $tipo = $_POST["tipo"];
    $plantel = $_POST["plantel"];
    $semestre = $_POST["semestre"];
    $participacion = $_POST["participacion"];
    $motivo = $_POST["motivo"];
    $intereses = $_POST["intereses"];

    // Hashear contraseña
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

    // Insertar usuario con la columna CORRECTA = password
    $stmt = $conn->prepare("
        INSERT INTO usuarios 
        (nombre, correo, password, telefono, tipo, plantel, semestre, participacion, motivo, intereses)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssssssssss", 
        $nombre, $correo, $password_hashed, $telefono, $tipo, $plantel, $semestre, $participacion, $motivo, $intereses
    );

    if ($stmt->execute()) {
        $_SESSION["usuario_id"] = $stmt->insert_id;
        $_SESSION["usuario_nombre"] = $nombre;
        header("Location: perfil.php");
        exit;
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
?>
