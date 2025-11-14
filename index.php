<?php
session_start();

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'es';

$txt = [
    'es' => [
        'titulo' => 'CLUB DE ECOLOGÍA',
        'subtitulo' => 'CECyTE Hermosillo IV',
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
            'contacto' => 'Contacto'
        ],
        'quienes' => '¿Quiénes somos?',
        'quienes_texto' => 'Somos un grupo que promueve el cuidado del medio ambiente y la conciencia ecológica.',
        'objetivos' => 'Objetivos',
        'objetivos_texto' => 'Fomentar el reciclaje, la reforestación y el uso responsable de los recursos naturales.',
        'actividades' => 'Actividades',
        'actividades_texto' => 'Realizamos campañas de limpieza, talleres ecológicos y jornadas de plantación de árboles.',
        'proyectos' => 'Proyectos',
        'proyectos_texto' => 'Trabajamos en proyectos como huertos escolares, reciclaje de materiales y cuidado de áreas verdes.',
        'video' => 'Video "QUÉ ES EL RECICLAJE Y SU IMPORTANCIA"',
        'footer' => '© 2025 Club de Ecología'
    ],
    'en' => [
        'titulo' => 'ECOLOGY CLUB',
        'subtitulo' => 'CECyTE Hermosillo IV',
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
            'contacto' => 'Contact'
        ],
        'quienes' => 'Who We Are',
        'quienes_texto' => 'We are a group that promotes environmental care and ecological awareness.',
        'objetivos' => 'Objectives',
        'objetivos_texto' => 'Promote recycling, reforestation, and responsible use of natural resources.',
        'actividades' => 'Activities',
        'actividades_texto' => 'We carry out clean-up campaigns, ecological workshops, and tree planting events.',
        'proyectos' => 'Projects',
        'proyectos_texto' => 'We work on projects such as school gardens, material recycling, and green area maintenance.',
        'video' => 'Video "WHAT IS RECYCLING AND ITS IMPORTANCE"',
        'footer' => '© 2025 Ecology Club'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt[$lang]['titulo']; ?></title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        /* HEADER CON IMAGEN DE FONDO */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            
            /* Imagen de fondo */
            background-image: url('FONDOECO.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
            position: relative; /* necesario para la capa */
            color: #fff;
        }

        /* Capa semi-transparente para mejorar legibilidad del texto */
        header::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(103, 117, 89, 0.6);
            z-index: 0;
        }

        header > * {
            position: relative; /* contenido sobre la capa */
            z-index: 1;
        }

        .logo-container img { height: 60px; }
        .titulo-header {
            flex: 1; text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 2em; font-weight: bold;
            color: #fff;
        }
        .titulo-header span { font-size: 1em; color: #d7ccc8; }
        .flag { height: 20px; vertical-align: middle; }
        nav.menu { background-color: #A9B192; }
        nav.menu ul { list-style: none; display: flex; margin: 0; padding: 0; }
        nav.menu li { position: relative; }
        nav.menu li a {
            display: block; padding: 12px 16px;
            color: white; text-decoration: none;
        }
        nav.menu li a:hover { background-color: #677559; }
        nav.menu .submenu {
            display: none; position: absolute;
            background-color: #677559;
            top: 100%; left: 0;
            list-style: none; padding: 0; margin: 0;
            min-width: 150px;
        }
        nav.menu li:hover .submenu { display: block; }
        nav.menu .submenu li a { padding: 10px 16px; color: white; }
        .language a { color: #fff; font-weight: bold; text-decoration: none; margin-left: 5px; }
    </style>
</head>
<body>
<header>
    <div class="logo-container">
        <img src="EcoLogo.png" alt="Logo">
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
        <li><a href="nosotros.php"><?php echo $txt[$lang]['menu']['nosotros']; ?></a></li>
        <li class="dropdown">
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
        <li><a href="#"><?php echo $txt[$lang]['menu']['manualidades']; ?></a></li>
        <li><a href="#"><?php echo $txt[$lang]['menu']['conferencias']; ?></a></li>
        <li><a href="Registro.php"><?php echo $txt[$lang]['menu']['registro']; ?></a></li>
        <li class="dropdown">
            <a href="#"><?php echo $txt[$lang]['menu']['mas']; ?></a>
            <ul class="submenu">
                <li><a href="#"><?php echo $txt[$lang]['menu']['galeria']; ?></a></li>
                <li><a href="#"><?php echo $txt[$lang]['menu']['contacto']; ?></a></li>
            </ul>
        </li>
    </ul>
</nav>

<main>
    <section>
        <img src="EcoFoto.jpg" alt="Último evento" class="imagen">

        <h2><?php echo $txt[$lang]['quienes']; ?></h2>
        <p><?php echo $txt[$lang]['quienes_texto']; ?></p>

        <h2><?php echo $txt[$lang]['objetivos']; ?></h2>
        <p><?php echo $txt[$lang]['objetivos_texto']; ?></p>

        <h2><?php echo $txt[$lang]['actividades']; ?></h2>
        <p><?php echo $txt[$lang]['actividades_texto']; ?></p>

        <h2><?php echo $txt[$lang]['proyectos']; ?></h2>
        <p><?php echo $txt[$lang]['proyectos_texto']; ?></p>

        <h2><?php echo $txt[$lang]['video']; ?></h2>
        <video width="700px" height="400px" controls>
            <source src="EcoVidio.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
</main>

<footer>
    <p><?php echo $txt[$lang]['footer']; ?></p>
</footer>
</body>
</html>