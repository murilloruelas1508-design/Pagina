<?php
session_start();

// Cambiar idioma si se pasa por GET
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Idioma por defecto
$lang = $_SESSION['lang'] ?? 'es';

// Traducciones
$txt = [
    'es' => [
        'titulo' => 'CLUB DE ECOLOGÍA',
        'subtitulo' => 'CECyTE Hermosillo IV',
        'menu' => [
            'inicio' => 'Inicio',
            'nosotros' => 'Nosotros',
            'registro' => 'Registro'
        ],
        'registro_titulo' => 'Formulario de Registro',
        'nombre' => 'Nombre completo',
        'correo' => 'Correo electrónico',
        'telefono' => 'Teléfono',
        'tipo' => 'Tipo de participante',
        'alumno' => 'Alumno',
        'docente' => 'Docente',
        'plantel' => 'Plantel / Escuela',
        'semestre' => 'Semestre o Grado actual',
        'participacion' => '¿Has participado antes en actividades del club?',
        'motivo' => 'Motivación para unirte al club',
        'intereses' => 'Áreas de interés ecológico',
        'enviar' => 'Enviar Registro'
    ],
    'en' => [
        'titulo' => 'ECOLOGY CLUB',
        'subtitulo' => 'CECyTE Hermosillo IV',
        'menu' => [
            'inicio' => 'Home',
            'nosotros' => 'About Us',
            'registro' => 'Register'
        ],
        'registro_titulo' => 'Registration Form',
        'nombre' => 'Full Name',
        'correo' => 'Email',
        'telefono' => 'Phone',
        'tipo' => 'Participant Type',
        'alumno' => 'Student',
        'docente' => 'Teacher',
        'plantel' => 'Campus / School',
        'semestre' => 'Current Semester / Grade',
        'participacion' => 'Have you participated in club activities before?',
        'motivo' => 'Motivation to join the club',
        'intereses' => 'Ecological areas of interest',
        'enviar' => 'Submit Registration'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt[$lang]['menu']['registro']; ?></title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #795548;
        }
        .logo-container img { height: 60px; }
        .titulo-header {
            flex: 1; text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 2em; font-weight: bold; color: #fff;
        }
        .titulo-header span { font-size: 1em; color: #d7ccc8; }
        .flag { height: 20px; vertical-align: middle; }
        nav.menu { background-color: #5d4037; }
        nav.menu ul { list-style: none; display: flex; margin: 0; padding: 0; }
        nav.menu li { position: relative; }
        nav.menu li a {
            display: block; padding: 12px 16px; color: white; text-decoration: none;
        }
        nav.menu li a:hover { background-color: #3e2723; }
        .language a { color: #fff; font-weight: bold; text-decoration: none; margin-left: 5px; }

        main {
            padding: 40px 80px; line-height: 1.7; background-color: #f7f3ef;
        }
        h2 { color: #4e342e; border-bottom: 2px solid #8d6e63; padding-bottom: 4px; }
        form { margin-top: 30px; }
        label { display: block; margin: 15px 0 5px; font-weight: bold; }
        input, select, textarea {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;
            font-family: Arial, sans-serif; font-size: 1em;
        }
        textarea { resize: vertical; height: 100px; }
        button {
            margin-top: 20px; padding: 12px 20px; background-color: #795548; color: white;
            border: none; border-radius: 4px; cursor: pointer; font-size: 1em;
        }
        button:hover { background-color: #5d4037; }
        footer {
            background-color: #5d4037; color: white; text-align: center; padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<header>
    <div class="logo-container">
        <a href="index.php"><img src="EcoLogo.png" alt="Logo"></a>
    </div>
    <div class="titulo-header">
        <?php echo $txt[$lang]['titulo']; ?><br>
        <span><?php echo $txt[$lang]['subtitulo']; ?></span>
    </div>
    <div class="language">
        <a href="?lang=es"><img src="mexicob.png" class="flag" alt="Español"></a>
        <a href="?lang=en"><img src="USAb.png" class="flag" alt="English"></a>
    </div>
</header>

<nav class="menu">
    <ul>
        <li><a href="index.php"><?php echo $txt[$lang]['menu']['inicio']; ?></a></li>
    </ul>
</nav>

<main>
    <section>
        <h2><?php echo $txt[$lang]['registro_titulo']; ?></h2>
        <form action="registro_submit.php" method="POST">
            <label for="nombre"><?php echo $txt[$lang]['nombre']; ?></label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo"><?php echo $txt[$lang]['correo']; ?></label>
            <input type="email" id="correo" name="correo" required>

            <label for="telefono"><?php echo $txt[$lang]['telefono']; ?></label>
            <input type="text" id="telefono" name="telefono">

            <label for="tipo"><?php echo $txt[$lang]['tipo']; ?></label>
            <select id="tipo" name="tipo">
                <option value="alumno"><?php echo $txt[$lang]['alumno']; ?></option>
                <option value="docente"><?php echo $txt[$lang]['docente']; ?></option>
            </select>

            <label for="plantel"><?php echo $txt[$lang]['plantel']; ?></label>
            <input type="text" id="plantel" name="plantel">

            <label for="semestre"><?php echo $txt[$lang]['semestre']; ?></label>
            <input type="text" id="semestre" name="semestre">

            <label for="participacion"><?php echo $txt[$lang]['participacion']; ?></label>
            <textarea id="participacion" name="participacion"></textarea>

            <label for="motivo"><?php echo $txt[$lang]['motivo']; ?></label>
            <textarea id="motivo" name="motivo"></textarea>

            <label for="intereses"><?php echo $txt[$lang]['intereses']; ?></label>
            <textarea id="intereses" name="intereses"></textarea>

            <button type="submit"><?php echo $txt[$lang]['enviar']; ?></button>
        </form>
    </section>
</main>

<footer>
    <p>© 2025 Club de Ecología - CECyTE Hermosillo IV</p>
</footer>
</body>
</html>

