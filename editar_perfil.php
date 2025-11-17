<?php
// Iniciar sesión solo si no hay ninguna activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once('registro_submit.php'); // asegúrate que este archivo cree $conn

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: Registro.php'); // o login.php según tu sistema
    exit;
}

// Obtener ID del usuario logueado
$user_id = $_SESSION['usuario_id'];

// Obtener datos actuales del usuario
$stmt = $conn->prepare("SELECT nombre, correo, telefono, tipo, plantel, semestre, participacion, motivo, intereses FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Procesar formulario al enviar cambios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE usuarios SET nombre = ?, correo = ?, telefono = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $correo, $telefono, $user_id);
    $stmt->execute();

    // Redirigir al perfil después de guardar
    header("Location: perfil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar perfil</title>
<style>
body { font-family: Arial; background: #f5f5f5; }
main { max-width: 700px; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
h2 { color: #4e342e; }
label { display: block; margin-top: 10px; }
input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin-top: 4px; }
input[type="submit"] { margin-top: 15px; padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
</style>
</head>
<body>
<main>
<h2>Editar perfil</h2>

<form method="post">
    <label>Nombre:
        <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>
    </label>
    <label>Correo:
        <input type="email" name="correo" value="<?= htmlspecialchars($user['correo']) ?>" required>
    </label>
    <label>Teléfono:
        <input type="text" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>">
    </label>
    <input type="submit" value="Guardar cambios">
</form>

<!-- Enlace para volver al perfil -->
<p style="margin-top:20px;">
    <a href="perfil.php" style="text-decoration:none; color:#4CAF50;">&lar
s