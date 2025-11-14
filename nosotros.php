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
        'titulo_nosotros' => 'Sobre Nosotros',
        'intro' => 'El Club de Ecología del CECyTE Hermosillo IV es una comunidad estudiantil comprometida con el cuidado y la preservación del medio ambiente. Nuestra misión es crear conciencia ecológica en la escuela y en la sociedad a través de acciones, proyectos y campañas que promuevan un estilo de vida sostenible.',
        'mision_titulo' => 'Nuestra Misión',
        'mision_texto' => 'Promover la responsabilidad ambiental mediante actividades prácticas, talleres y proyectos ecológicos que fomenten el respeto por la naturaleza y el uso responsable de los recursos.',
        'vision_titulo' => 'Nuestra Visión',
        'vision_texto' => 'Ser un club reconocido por inspirar a las nuevas generaciones a actuar con conciencia ecológica, impulsando un cambio positivo dentro y fuera del plantel.',
        'valores_titulo' => 'Nuestros Valores',
        'valores' => [
            'Respeto por la naturaleza y los seres vivos.',
            'Responsabilidad ambiental.',
            'Trabajo en equipo.',
            'Solidaridad y empatía.',
            'Innovación ecológica y compromiso social.'
        ],
        'equipo_titulo' => 'Nuestro Equipo',
        'equipo_texto' => 'El Club de Ecología está conformado por estudiantes entusiastas y docentes guías que trabajan juntos para planear actividades que impacten positivamente en nuestro entorno. Cada integrante aporta su energía, ideas y pasión por cuidar el planeta.',
        'proyectos_titulo' => 'Proyectos y Actividades',
        'proyectos_texto' => 'Entre nuestras principales actividades se encuentran las campañas de reforestación, jornadas de limpieza, reciclaje de materiales, talleres educativos, y la creación de huertos ecológicos dentro del plantel.',
        'galeria_titulo' => 'Galería del Club',
        'footer' => '© 2025 Club de Ecología - CECyTE Hermosillo IV'
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
        'titulo_nosotros' => 'About Us',
        'intro' => 'The Ecology Club of CECyTE Hermosillo IV is a student community dedicated to caring for and preserving the environment. Our mission is to raise ecological awareness at school and in society through actions, projects, and campaigns that promote sustainable living.',
        'mision_titulo' => 'Our Mission',
        'mision_texto' => 'To promote environmental responsibility through practical activities, workshops, and ecological projects that encourage respect for nature and the responsible use of resources.',
        'vision_titulo' => 'Our Vision',
        'vision_texto' => 'To be a club recognized for inspiring new generations to act with ecological awareness, driving positive change inside and outside the school.',
        'valores_titulo' => 'Our Values',
        'valores' => [
            'Respect for nature and all living beings.',
            'Environmental responsibility.',
            'Teamwork.',
            'Solidarity and empathy.',
            'Ecological innovation and social commitment.'
        ],
        'equipo_titulo' => 'Our Team',
        'equipo_texto' => 'The Ecology Club is made up of enthusiastic students and guiding teachers working together to plan activities that positively impact our environment. Each member contributes their energy, ideas, and passion for protecting the planet.',
        'proyectos_titulo' => 'Projects and Activities',
        'proyectos_texto' => 'Our main activities include reforestation campaigns, clean-up events, material recycling, educational workshops, and the creation of ecological gardens within the campus.',
        'galeria_titulo' => 'Club Gallery',
        'footer' => '© 2025 Ecology Club - CECyTE Hermosillo IV'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt[$lang]['menu']['nosotros']; ?></title>
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
            flex: 1;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 2em;
            font-weight: bold;
            color: #fff;
        }
        .titulo-header span { font-size: 1em; color: #d7ccc8; }
        .flag { height: 20px; vertical-align: middle; }
        nav.menu { background-color: #5d4037; }
        nav.menu ul { list-style: none; display: flex; margin: 0; padding: 0; }
        nav.menu li { position: relative; }
        nav.menu li a {
            display: block;
            padding: 12px 16px;
            color: white;
            text-decoration: none;
        }
        nav.menu li a:hover { background-color: #3e2723; }
        nav.menu .submenu {
            display: none;
            position: absolute;
            background-color: #6d4c41;
            top: 100%; left: 0;
            list-style: none; padding: 0; margin: 0;
            min-width: 150px;
        }
        nav.menu li:hover .submenu { display: block; }
        nav.menu .submenu li a { padding: 10px 16px; color: white; }
        .language a { color: #fff; font-weight: bold; text-decoration: none; margin-left: 5px; }

        main {
            padding: 40px 80px;
            line-height: 1.7;
            background-color: #f7f3ef;
        }
        main h2 {
            color: #4e342e;
            border-bottom: 2px solid #8d6e63;
            padding-bottom: 4px;
        }
        main p {
            margin-bottom: 25px;
            text-align: justify;
        }
        ul { margin-left: 30px; }
        footer {
            background-color: #5d4037;
            color: white;
            text-align: center;
            padding: 15px;
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
        <li><a href="Registro.php"><?php echo $txt[$lang]['menu']['registro']; ?></a></li>
    </ul>
</nav>

<main>
    <section>
        <h2><?php echo $txt[$lang]['titulo_nosotros']; ?></h2>
        <p><?php echo $txt[$lang]['intro']; ?></p>

        <h2><?php echo $txt[$lang]['mision_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['mision_texto']; ?></p>

        <h2><?php echo $txt[$lang]['vision_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['vision_texto']; ?></p>

        <h2><?php echo $txt[$lang]['valores_titulo']; ?></h2>
        <ul>
            <?php foreach ($txt[$lang]['valores'] as $valor) echo "<li>$valor</li>"; ?>
        </ul>

        <h2><?php echo $txt[$lang]['equipo_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['equipo_texto']; ?></p>

        <h2><?php echo $txt[$lang]['proyectos_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['proyectos_texto']; ?></p>

        <h2><?php echo $txt[$lang]['galeria_titulo']; ?></h2>
        <img src="EcoFoto.jpg" alt="Club de Ecología" width="700px">
    </section>
</main>

<footer>
    <p><?php echo $txt[$lang]['footer']; ?></p>
</footer>
</body>
</html>
