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
            'actividades' => 'Actividades',
            'registro' => 'Registro'
        ],
        'actividades_titulo' => 'Nuestras Actividades',
        'introduccion' => 'El Club de Ecología organiza diversas actividades que promueven el cuidado del medio ambiente y la participación activa de los estudiantes.',
        'limpieza_titulo' => 'Campañas de Limpieza',
        'limpieza_texto' => 'Realizamos jornadas de limpieza dentro y fuera del plantel, fomentando la responsabilidad ecológica y la separación adecuada de residuos.',
        'reciclaje_titulo' => 'Talleres de Reciclaje y Reutilización',
        'reciclaje_texto' => 'Enseñamos a crear objetos útiles a partir de materiales reciclados como botellas, papel, cartón y metal.',
        'reforestacion_titulo' => 'Reforestación',
        'reforestacion_texto' => 'Organizamos jornadas de plantación de árboles y cuidado de áreas verdes en la escuela y la comunidad.',
        'conferencias_titulo' => 'Conferencias y Charlas Ambientales',
        'conferencias_texto' => 'Invitamos a especialistas para hablar sobre sostenibilidad, cambio climático y hábitos ecológicos.',
        'eventos_titulo' => 'Eventos Especiales',
        'eventos_texto' => 'Participamos en ferias ecológicas, días ambientales y concursos de innovación verde.',
        'video_titulo' => 'Video de Actividades del Club',
        'footer' => '© 2025 Club de Ecología - CECyTE Hermosillo IV'
    ],
    'en' => [
        'titulo' => 'ECOLOGY CLUB',
        'subtitulo' => 'CECyTE Hermosillo IV',
        'menu' => [
            'inicio' => 'Home',
            'nosotros' => 'About Us',
            'actividades' => 'Activities',
            'registro' => 'Register'
        ],
        'actividades_titulo' => 'Our Activities',
        'introduccion' => 'The Ecology Club organizes various activities that promote environmental care and student participation.',
        'limpieza_titulo' => 'Clean-up Campaigns',
        'limpieza_texto' => 'We conduct clean-up days inside and outside the campus, encouraging ecological responsibility and proper waste separation.',
        'reciclaje_titulo' => 'Recycling and Reuse Workshops',
        'reciclaje_texto' => 'We teach how to create useful objects from recycled materials such as bottles, paper, cardboard, and metal.',
        'reforestacion_titulo' => 'Reforestation',
        'reforestacion_texto' => 'We organize tree planting and green area maintenance days at school and in the community.',
        'conferencias_titulo' => 'Environmental Talks and Conferences',
        'conferencias_texto' => 'We invite specialists to talk about sustainability, climate change, and eco-friendly habits.',
        'eventos_titulo' => 'Special Events',
        'eventos_texto' => 'We participate in eco fairs, environmental days, and green innovation contests.',
        'video_titulo' => 'Club Activities Video',
        'footer' => '© 2025 Ecology Club - CECyTE Hermosillo IV'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt[$lang]['menu']['actividades']; ?></title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        body { margin: 0; background-color: #f7f3ef; font-family: Arial, sans-serif; }
        header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 20px; background-color: #795548;
        }
        .logo-container img { height: 60px; }
        .titulo-header {
            flex: 1; text-align: center; font-size: 2em; font-weight: bold;
            color: #fff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .titulo-header span { font-size: 1em; color: #d7ccc8; }
        .flag { height: 20px; vertical-align: middle; }
        nav.menu { background-color: #5d4037; }
        nav.menu ul { list-style: none; display: flex; margin: 0; padding: 0; justify-content: center; }
        nav.menu li { position: relative; }
        nav.menu li a {
            display: block; padding: 12px 16px; color: white; text-decoration: none;
        }
        nav.menu li a:hover { background-color: #3e2723; }
        main {
            padding: 40px 80px; line-height: 1.7; color: #3e2723;
        }
        h2 {
            color: #4e342e; margin-top: 50px; border-bottom: 2px solid #8d6e63; padding-bottom: 5px;
        }
        .actividad {
            margin-top: 30px; background-color: #fff; border-radius: 10px;
            padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .actividad img {
            width: 100%; max-width: 700px; display: block; margin: 10px auto; border-radius: 8px;
        }
        video {
            display: block; margin: 20px auto; border-radius: 10px;
        }
        footer {
            background-color: #5d4037; color: white; text-align: center;
            padding: 15px; margin-top: 40px;
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
</nav>

<main>
    <h2><?php echo $txt[$lang]['actividades_titulo']; ?></h2>
    <p><?php echo $txt[$lang]['introduccion']; ?></p>

    <div class="actividad">
        <h3><?php echo $txt[$lang]['limpieza_titulo']; ?></h3>
        <p><?php echo $txt[$lang]['limpieza_texto']; ?></p>
        <img src="limpieza.jpg" alt="Campaña de Limpieza">
    </div>

    <div class="actividad">
        <h3><?php echo $txt[$lang]['reciclaje_titulo']; ?></h3>
        <p><?php echo $txt[$lang]['reciclaje_texto']; ?></p>
        <img src="reciclaje.jpg" alt="Taller de Reciclaje">
    </div>

    <div class="actividad">
        <h3><?php echo $txt[$lang]['reforestacion_titulo']; ?></h3>
        <p><?php echo $txt[$lang]['reforestacion_texto']; ?></p>
        <img src="reforestacion.jpg" alt="Reforestación">
    </div>

    <div class="actividad">
        <h3><?php echo $txt[$lang]['conferencias_titulo']; ?></h3>
        <p><?php echo $txt[$lang]['conferencias_texto']; ?></p>
        <img src="conferencia.jpg" alt="Conferencias Ambientales">
    </div>

    <div class="actividad">
        <h3><?php echo $txt[$lang]['eventos_titulo']; ?></h3>
        <p><?php echo $txt[$lang]['eventos_texto']; ?></p>
        <img src="eventos.jpg" alt="Eventos Especiales">
    </div>

    <h3 style="margin-top:50px;"><?php echo $txt[$lang]['video_titulo']; ?></h3>
    <video width="700" height="400" controls>
        <source src="actividades.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</main>

<footer>
    <p><?php echo $txt[$lang]['footer']; ?></p>
</footer>
</body>
</html>
