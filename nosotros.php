<?php
session_start();

// Cambiar idioma si se pasa por GET
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Idioma por defecto
$lang = $_SESSION['lang'] ?? 'es';

$txt = [
    'es' => [
        'titulo' => 'ECOCYTE – Proyecto Ecológico',
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
            'contacto' => 'Contacto',
            'perfil'=>'Perfil'
        ],
        'nosotros_titulo' => 'Sobre Nosotros',
        'nosotros_texto' => 'Somos un grupo de estudiantes de CECyTE comprometidos con la preservación del medio ambiente. Promovemos conciencia ecológica mediante acciones, proyectos y campañas sostenibles.',
        'mision_titulo' => 'Nuestra Misión',
        'mision_texto' => 'Promover la responsabilidad ambiental mediante actividades, talleres y proyectos ecológicos.',
        'vision_titulo' => 'Nuestra Visión',
        'vision_texto' => 'Ser un proyecto reconocido que inspire a nuevas generaciones a actuar con conciencia ecológica.',
        'valores_titulo' => 'Nuestros Valores',
        'valores' => [
            'Respeto por la naturaleza y los seres vivos.',
            'Responsabilidad ambiental.',
            'Trabajo en equipo.',
            'Solidaridad y empatía.',
            'Innovación ecológica y compromiso social.'
        ],
        'equipo_titulo' => 'Nuestro Equipo',
        'equipo_texto' => 'Estudiantes y docentes trabajando juntos para planear actividades que impacten positivamente en nuestro entorno.',
        'proyectos_titulo' => 'Proyectos y Actividades',
        'proyectos_texto' => 'Campañas de reforestación, limpieza, reciclaje, talleres educativos y huertos ecológicos.',
        'galeria_titulo' => 'Galería del Proyecto',
        'footer' => '© 2025 ECOCYTE – Proyecto Ecológico'
    ],
    'en' => [
        'titulo' => 'ECOCYTE – Ecology Project',
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
            'contacto' => 'Contact',
            'perfil'=>'Perfil'
        ],
        'nosotros_titulo' => 'About Us',
        'nosotros_texto' => 'We are a group of CECyTE students committed to preserving the environment. We promote ecological awareness through actions, projects, and sustainable campaigns.',
        'mision_titulo' => 'Our Mission',
        'mision_texto' => 'Promote environmental responsibility through activities, workshops, and ecological projects.',
        'vision_titulo' => 'Our Vision',
        'vision_texto' => 'To be a recognized project that inspires new generations to act with ecological awareness.',
        'valores_titulo' => 'Our Values',
        'valores' => [
            'Respect for nature and living beings.',
            'Environmental responsibility.',
            'Teamwork.',
            'Solidarity and empathy.',
            'Ecological innovation and social commitment.'
        ],
        'equipo_titulo' => 'Our Team',
        'equipo_texto' => 'Students and teachers working together to plan activities that positively impact our environment.',
        'proyectos_titulo' => 'Projects and Activities',
        'proyectos_texto' => 'Reforestation campaigns, cleaning, recycling, educational workshops, and ecological gardens.',
        'galeria_titulo' => 'Project Gallery',
        'footer' => '© 2025 ECOCYTE – Ecology Project'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $txt[$lang]['titulo']; ?></title>

<style>
/* ===================== RESET Y BASE ===================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    color: #362624ff;
}

/* ===================== HEADER FIJO ===================== */
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #A9B192;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 20px;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

/* Logo con animación */
.logo img {
    height: 60px;
    animation: shine 4s linear infinite;
}

/* ===================== MENÚ ===================== */
nav.menu {
    flex: 1;
    text-align: center;
}
nav.menu ul {
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 15px;
}
nav.menu li {
    position: relative;
}
nav.menu li a {
    display: block;
    padding: 8px 12px;
    font-weight: bold;
    color: white;
    text-decoration: none;
    transition: 0.3s;
}
nav.menu li a:hover {
    background: #A9B192;
    border-radius: 4px;
}

/* Submenú */
nav.menu .submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #677559;
    min-width: 180px;
}
nav.menu li:hover .submenu {
    display: block;
}
nav.menu .submenu li a {
    padding: 8px 12px;
}

/* ===================== CAMBIO DE IDIOMA ===================== */
.language {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: bold;
    color: white;
    font-size: 0.9rem;
    gap: 5px;
}
.language span {
    font-size: 0.85rem;
}
.language .flags {
    display: flex;
    gap: 5px;
}
.language .flag {
    width: 30px;
    cursor: pointer;
    vertical-align: middle;
}

/* ===================== ANIMACIONES ===================== */
@keyframes shine {
    0% { filter: brightness(1); }
    50% { filter: brightness(1.5); }
    100% { filter: brightness(1); }
}

/* ===================== MAIN ===================== */
main {
    max-width: 1100px;
    margin: 120px auto 40px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    gap: 30px;
}
main h2 {
    margin-bottom: 10px;
    color: #4e342e;
    border-left: 5px solid #8d6e63;
    padding-left: 8px;
}
label {
    display: block;
    margin: 15px 0 5px;
    font-weight: bold;
}
input, select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    font-family: Arial;
}
textarea {
    resize: vertical;
    height: 100px;
}
button {
    margin-top: 20px;
    padding: 12px 20px;
    background-color: #8d6e63;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background-color: #A1887F;
}

/* ===================== FOOTER ===================== */
footer {
    text-align: center;
    background: #A9B192;
    color: white;
    padding: 12px;
    margin-top: 30px;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 768px) {
    nav.menu ul {
        flex-direction: column;
        gap: 0;
    }
    nav.menu li a {
        padding: 10px;
    }
    .language {
        flex-direction: row;
        font-size: 0.8rem;
        gap: 10px;
    }
    .language .flag {
        width: 25px;
    }
}

</style>
</head>
<body>

<header>

    <div class="logo"><a href="../index.php">
    <img src="../ECOCYTE.png" class="logo" alt="Logo CECYTE">
    </a></div>
    <nav class="menu">
        
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
      <li><a href="perfil.php"><?php echo $txt[$lang]['menu']['perfil']; ?></a></li>
      <li><a href="galeria.php"><?php echo $txt[$lang]['menu']['galeria']; ?></a></li>
      <li><a href="contacto.php"><?php echo $txt[$lang]['menu']['contacto']; ?></a></li>
      
    </ul>
  </li>
</ul>

    </nav>
   <div class="language">
    <span>Cambiar idioma:</span>
    <div>
        <a href="?lang=es"><img src="mexicob.png" class="flag" alt="Español"></a>
        <a href="?lang=en"><img src="USAb.png" class="flag" alt="English"></a>
    </div>
</div>

</header>

<main>
    <section>
        <h2><?php echo $txt[$lang]['nosotros_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['nosotros_texto']; ?></p>
    </section>

    <section>
        <h2><?php echo $txt[$lang]['mision_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['mision_texto']; ?></p>
    </section>

    <section>
        <h2><?php echo $txt[$lang]['vision_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['vision_texto']; ?></p>
    </section>

    <section>
        <h2><?php echo $txt[$lang]['valores_titulo']; ?></h2>
        <ul>
            <?php foreach($txt[$lang]['valores'] as $valor) echo "<li>$valor</li>"; ?>
        </ul>
    </section>

    <section>
        <h2><?php echo $txt[$lang]['equipo_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['equipo_texto']; ?></p>
    </section>

    <section>
        <h2><?php echo $txt[$lang]['proyectos_titulo']; ?></h2>
        <p><?php echo $txt[$lang]['proyectos_texto']; ?></p>
    </section>

    <section>
        <h2><?php echo $txt[$lang]['galeria_titulo']; ?></h2>
        <img src="EcoFoto.jpg" alt="Galería ECOCYTE" style="width:100%; max-width:700px; border-radius:8px; margin-top:10px;">
    </section>
</main>

<footer><?php echo $txt[$lang]['footer']; ?></footer>

</body>
</html>
