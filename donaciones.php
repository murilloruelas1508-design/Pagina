<?php
// Puedes agregar lógica PHP aquí si después necesitas procesar formularios
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Donaciones - EcoCyTES</title>
    <link rel="stylesheet" href="styles.css"> <!-- Opcional -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f7f3;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2d6a4f;
            color: white;
            padding: 15px;
            text-align: center;
        }
        nav {
            background: #40916c;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            font-weight: bold;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 30px;
            margin-top: 25px;
            box-shadow: 0 0 10px #c4c4c4;
            border-radius: 8px;
        }
        h2 {
            color: #1b4332;
        }
        .boton {
            background: #2d6a4f;
            color: white;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 5px;
            text-decoration: none;
        }
        .boton:hover {
            background: #1b4332;
        }
    </style>
</head>
<body>

<header>
    <h1>EcoCyTES - Donaciones</h1>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="donaciones.php">Donaciones</a>
    <!-- Puedes agregar más secciones aquí -->
</nav>

<div class="container">
    <h2>Apoya un futuro más verde</h2>
    <p>Tu donación ayuda a financiar proyectos ecológicos en los planteles CECyTES: reforestación, reciclaje, huertos estudiantiles y más.</p>

    <h3>¿Por qué donar?</h3>
    <ul>
        <li>🌳 Reforestación en los planteles</li>
        <li>♻️ Programas de reciclaje</li>
        <li>💧 Sistemas de ahorro de agua</li>
        <li>🌞 Energías limpias para los centros</li>
        <li>🌱 Talleres de educación ambiental</li>
    </ul>

    <h3>Formas de donar</h3>
    <p><strong>Transferencia bancaria:</strong></p>
    <ul>
        <li>Nombre de la cuenta: EcoCyTES</li>
        <li>Número de cuenta: __________</li>
        <li>CLABE: __________</li>
        <li>Banco: __________</li>
    </ul>

    <p><a class="boton" href="#">Donar con tarjeta</a></p>

    <h3>Contacto</h3>
    <p>📧 Correo: contacto@ecocytes.org</p>
    <p>📱 Teléfono: (000) 000 0000</p>
</div>

</body>
</html>
