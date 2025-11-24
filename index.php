<?php
session_start();

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'es';

$txt = [
    'es' => [
        'titulo' => 'ECOCYTES – Ecología CECyTES',
        'subtitulo' => 'Proyecto ecológico inter-planteles',
        'menu' => [
            'inicio' => 'Inicio','nosotros'=>'Nosotros','materiales'=>'Todo sobre tus Materiales ▾','cambiar_idioma'=>'Cambiar idioma',
            'plastico'=>'Plástico','papel'=>'Papel','vidrio'=>'Vidrio','metal'=>'Metal','carton'=>'Cartón','organico'=>'Orgánico',
            'actividades'=>'Actividades','manualidades'=>'Manualidades','conferencias'=>'Conferencias','registro'=>'Registro',
            'mas'=>'Más ▾','galeria'=>'Galería','contacto'=>'Contacto', 'perfil'=>'Perfil'
        ],
        'intro_titulo'=>'La Importancia del Reciclaje',
        'intro_reciclaje'=>'Reutilizar materiales ayuda a reducir la contaminación, aprovechar mejor los recursos y disminuir los residuos que dañan el entorno. Con pequeñas acciones podemos generar un impacto positivo en el planeta.',
        'quienes'=>'¿Quiénes somos?',
        'quienes_texto'=>'Somos un grupo de estudiantes del plantel CECyTE Hermosillo IV comprometidos con el cuidado del medio ambiente. Promovemos conciencia ecológica mediante campañas y proyectos.',
        'objetivos'=>'Objetivos',
        'objetivos_texto'=>'• Fomentar una cultura ecológica.<br>• Reducir residuos.<br>• Promover reforestación.<br>• Implementar proyectos sostenibles.<br>• Involucrar estudiantes.',
        'actividades'=>'Actividades',
        'actividades_texto'=>'• Limpiezas.<br>• Talleres.<br>• Reforestación.<br>• Conferencias.<br>• Eventos especiales.',
        'proyectos'=>'Proyectos',
        'proyectos_texto'=>'',
        'footer'=>'© 2025 ECOCYTE – Proyecto ecológico'
    ],

    'en' => [
        'titulo'=>'ECOCYTES – Ecology Project',
        'subtitulo'=>'Inter-campus environmental project',
        'menu'=>[
            'inicio'=>'Home','nosotros'=>'About Us','materiales'=>'All About Your Materials ▾','cambiar_idioma'=>'Change language',
            'plastico'=>'Plastic','papel'=>'Paper','vidrio'=>'Glass','metal'=>'Metal','carton'=>'Cardboard','organico'=>'Organic',
            'actividades'=>'Activities','manualidades'=>'Crafts','conferencias'=>'Conferences','registro'=>'Register',
            'mas'=>'More ▾','galeria'=>'Gallery','contacto'=>'Contact', 'perfil'=>'Perfil'
        ],
        'intro_titulo'=>'The Importance of Recycling',
        'intro_reciclaje'=>'Recycling reduces pollution and waste while improving resource use. Small actions make a positive impact.',
        'quienes'=>'Who Are We?',
        'quienes_texto'=>'We are students from CECyTE Plantel IV promoting environmental awareness through campaigns and activities.',
        'objetivos'=>'Objectives',
        'objetivos_texto'=>'• Promote ecological culture.<br>• Reduce waste.<br>• Reforestation.<br>• Sustainable projects.<br>• Student involvement.',
        'actividades'=>'Activities',
        'actividades_texto'=>'• Clean-ups.<br>• Workshops.<br>• Reforestations.<br>• Conferences.<br>• Ecological events.',
        'proyectos'=>'Projects','proyectos_texto'=>'',
        'footer'=>'© 2025 ECOCYTE – Ecology Project'
    ]
];
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <link rel="stylesheet" href=".css">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $txt[$lang]['titulo']; ?></title>
<style>
/* =========================
   RESET Y ESTILOS BASE
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    color: #333;
}

/* =========================
   HEADER
========================= */
header {
    position: relative;
    height: 300px;
    background: url('FONDOECO.jpg') center/cover no-repeat;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;

    /* Animación fadeIn para todo el header */
    opacity: 0;               /* inicial invisible */
    animation: fadeIn 1.5s ease forwards;
}


header::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(3px);
}

header h1 {
    position: relative;
    z-index: 2;
    font-size: 2.8rem;
    background: linear-gradient(90deg, #dcedc8, #ffffff, #a5d6a7, #e8f5e9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 300%;
    animation: shine 6s linear infinite, fadeIn 1.2s ease forwards;
    text-shadow: 2px 2px 6px #000;
}

header span {
    position: relative;
    z-index: 2;
    display: block;
    margin-top: 5px;
    color: #e0f2f1;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
}

/* Logo y cambio de idioma */
.logo {
    position: absolute;
    left: 15px;
    top: 15px;
    width: 90px;
    z-index: 3;
    animation: shine 4s linear infinite; 
}

.lang {
    position: absolute;
    right: 15px;
    top: 30px; /* antes estaba 15px, ahora más abajo */
    color: white;
    z-index: 3;
    font-size: 0.9rem; /* tamaño de letra más grande */
    text-align: center;
}


.lang img {
    width: 35px;
    border: 1px solid #fff;
    border-radius: 3px;
    margin: 3px;
    margin-top: 30px;
}

/* Animación del brillo */
@keyframes shine {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
 }
 @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes shine {
  0% { filter: brightness(1); }
  50% { filter: brightness(1.6); }
  100% { filter: brightness(1); }
}



/* =========================
   NAV
========================= */
nav {
    background: #A9B192;
    padding: 12px 0;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 10px;
}

nav li {
    position: relative;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 10px 18px;
    display: block;
}

nav a:hover {
    background: white;
}

/* Submenú */
.submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #677559;
    min-width: 150px;
}

li:hover .submenu {
    display: block;
}

.submenu a {
    padding: 10px;
}

/* =========================
   MAIN
========================= */
main {
    max-width: 1100px;
    margin: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* Introducción con texto y video */
.intro-section {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.intro-text {
    flex: 1;
    min-width: 280px;
}

.intro-video {
    flex: 1;
    min-width: 280px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.intro-video video {
    width: 100%;
    border-radius: 10px;
}

/* Sección de información */
.info-section {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* =========================
   TITULOS Y PÁRRAFOS
========================= */
h2 {
    margin-bottom: 10px;
    border-left: 5px solid #A9B192;
    padding-left: 8px;
    color: #2e3b2f;
}

p {
    margin-bottom: 12px;
}

/* =========================
   FOOTER
========================= */
footer {
    text-align: center;
    background: #A9B192;
    color: white;
    padding: 12px;
    margin-top: 30px;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    .intro-section {
        flex-direction: column;
    }

    .intro-video,
    .intro-text {
        width: 100%;
    }
}

</style>
</head>
<body>
<header>
<a href="../index.php">
    <img src="../ECOCYTE.png" class="logo" alt="Logo CECYTE">
 </a>
<div class="lang">
<?php echo $txt[$lang]['menu']['cambiar_idioma']; ?><br>
<a href="?lang=es"><img src="../mexicob.png"></a>
<a href="?lang=en"><img src="../USAb.png"></a>
</div>
<div>
<h1><?php echo $txt[$lang]['titulo']; ?></h1>
<span><?php echo $txt[$lang]['subtitulo']; ?></span>
</div>
</header>


<nav>
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
      <li><a href="galeria.php"><?php echo $txt[$lang]['menu']['galeria']; ?></a></li>
      <li><a href="contacto.php"><?php echo $txt[$lang]['menu']['contacto']; ?></a></li>
      <li><a href="perfil.php"><?php echo $txt[$lang]['menu']['perfil']; ?></a></li>
    </ul>
  </li>
</ul>
</nav>


<main>
<div class="info-section">
<h2><?php echo $txt[$lang]['quienes']; ?></h2>
<p><?php echo $txt[$lang]['quienes_texto']; ?></p>
<h2><?php echo $txt[$lang]['objetivos']; ?></h2>
<p><?php echo $txt[$lang]['objetivos_texto']; ?></p>
<h2><?php echo $txt[$lang]['actividades']; ?></h2>
<p><?php echo $txt[$lang]['actividades_texto']; ?></p>
<h2><?php echo $txt[$lang]['proyectos']; ?></h2>
<p><?php echo $txt[$lang]['proyectos_texto']; ?></p>
</div>

<div class="intro-section">
<div class="intro-text">
<h2><?php echo $txt[$lang]['intro_titulo']; ?></h2>
<p><?php echo $txt[$lang]['intro_reciclaje']; ?></p>
</div>
<div class="intro-video">
<video controls>
<source src="EcoVidio.mp4" type="video/mp4">
</video>
</div>
</div>


</main>
<footer>
<?php echo $txt[$lang]['footer']; ?>
</footer>
</body>
</html>