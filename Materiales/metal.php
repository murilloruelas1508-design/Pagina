<?php
session_start();

// Cambiar idioma si se pasa por GET
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Idioma por defecto
$lang = $_SESSION['lang'] ?? 'es';


// -----------------------------
// Textos traducidos
// -----------------------------
$txt = [
    'es' => [
        'menu_inicio'   => 'Inicio',
        'menu_papel'    => 'Papel',
        'menu_vidrio'   => 'Vidrio',
        'menu_plastico' => 'Plástico',
        'menu_carton'   => 'Cartón',
        'menu_metal'    => 'Metal',
        'menu_organico' => 'Orgánico',


        'titulo' => 'Todo sobre el Metal',
        'subtitulo' => 'Conoce el valor del metal, su proceso de reciclaje y cómo puedes ayudar a conservar los recursos naturales.',
        'definicion_t' => '¿Qué es el Metal?',
        'definicion1' => 'El metal es un material sólido y resistente, extraído principalmente de minerales. Los más comunes en el uso cotidiano son el hierro, aluminio, cobre y acero.',
        'definicion2' => 'El metal está presente en casi todo: herramientas, vehículos, electrodomésticos, envases y estructuras de construcción.',
        'impacto_t' => 'Impacto del Metal en el Medio Ambiente',
        'impacto1' => 'La extracción y producción de metales generan grandes impactos ambientales. La minería destruye ecosistemas y contamina el agua.',
        'impacto2' => 'El reciclaje reduce significativamente estos daños: reciclar una tonelada de aluminio ahorra un 95% de la energía necesaria.',
        'reciclaje_t' => 'Cómo Reciclar y Reutilizar el Metal',
        'reciclaje1' => 'El reciclaje comienza con la recolección y clasificación. Luego se funden y reutilizan para nuevos productos.',
        'reciclaje2' => 'En casa, separa latas, tapas y objetos metálicos limpios, evitando mezclarlos con plásticos o residuos orgánicos.',
        'enlaces_t' => 'Recursos y enlaces útiles',
        'enlace1' => 'Reciclaje del metal - Ecología Verde',
        'enlace2' => 'Greenpeace México: Importancia del reciclaje de metales',
        'enlace3' => 'BBVA: Reciclaje del metal y economía circular',
        'volver' => 'Volver al inicio',
        'cambiar_idioma' => 'Cambiar idioma',
        'footer' => '♻️ Proyecto Reciclaje © 2025 | Forjando un futuro sostenible'
    ],
    'en' => [
        'menu_inicio'   => 'Back to Home',
        'menu_papel'    => 'Paper',
        'menu_vidrio'   => 'Glass',
        'menu_plastico' => 'Plastic',
        'menu_carton'   => 'Cardboard',
        'menu_metal'    => 'Metal',
        'menu_organico' => 'Organic',

        'titulo' => 'All About Metal',
        'subtitulo' => 'Discover the value of metal, its recycling process, and how you can help preserve natural resources.',
        'definicion_t' => 'What is Metal?',
        'definicion1' => 'Metal is a solid and durable material, mainly extracted from minerals. The most common are iron, aluminum, copper, and steel.',
        'definicion2' => 'Metal is present in almost everything: tools, vehicles, appliances, containers, and building structures.',
        'impacto_t' => 'Environmental Impact of Metal',
        'impacto1' => 'Metal extraction and production cause significant environmental impacts, destroying ecosystems and polluting water.',
        'impacto2' => 'Recycling significantly reduces this damage: recycling one ton of aluminum saves 95% of the energy needed.',
        'reciclaje_t' => 'How to Recycle and Reuse Metal',
        'reciclaje1' => 'Recycling begins with collection and sorting, then metals are melted and reused for new products.',
        'reciclaje2' => 'At home, separate clean metal cans, lids, and objects, avoiding mixing with plastics or organic waste.',
        'enlaces_t' => 'Resources and Useful Links',
        'enlace1' => 'Metal Recycling - Ecología Verde',
        'enlace2' => 'Greenpeace Mexico: Importance of Metal Recycling',
        'enlace3' => 'BBVA: Metal Recycling and Circular Economy',
        'volver' => 'Back to Home',
        'cambiar_idioma' => 'Change Language',
        'footer' => '♻️ Recycling Project © 2025 | Forging a Sustainable Future'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $txt[$lang]['titulo'] ?> | Reciclaje</title>

<style>
/* ----------------------------- */
/* Reset y tipografía */
/* ----------------------------- */
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    background: #e8e8e8;
    color: #333;
    overflow-x: hidden;
}

/* ----------------------------- */
/* Header con animación metálica */
/* ----------------------------- */
header {
    position: relative;
    background: url('FONDOMET.jpg') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 90px 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    animation: fadeIn 1.5s ease-in-out;
}

header::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 0;
}

header h1 {
    margin: 0;
    font-size: 2.8em;
    letter-spacing: 1px;
    background: linear-gradient(90deg, #d7d7d7 0%, #ffffff 20%, #b0b0b0 40%, #f0f0f0 60%, #d7d7d7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 300%;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
    animation: shine 4s linear infinite;
    position: relative;
    z-index: 1;
}

header p {
    font-size: 1.2em;
    margin-top: 10px;
    text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
    position: relative;
    z-index: 1;
}

.language-selector {
    position: absolute;
    top: 15px;
    right: 15px;
    text-align: center;
    z-index: 2;
}

.language-selector p {
    margin: 0 0 4px;
    font-size: 0.8em;
}

.flags { display: flex; gap: 5px; justify-content: center; }

.flag { height: 20px; cursor: pointer; border: 1px solid #fff; border-radius: 3px; transition: 0.3s; }
.flag:hover { transform: scale(1.1); }

/* ----------------------------- */
/* Animaciones */
/* ----------------------------- */
@keyframes shine { 0% {background-position: 200% 0;} 100% {background-position: -200% 0;} }
@keyframes fadeIn { from {opacity:0; transform:translateY(-20px);} to {opacity:1; transform:translateY(0);} }

/* ----------------------------- */
/* NAV */
/* ----------------------------- */
nav {
    background-color: #212121;
    text-align: center;
    padding: 12px 0;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 10px 18px;
    display: inline-block;
    transition: 0.3s;
}

nav a:hover { background-color: #616161; border-radius: 5px; }

/* ----------------------------- */
/* Main y secciones */
/* ----------------------------- */
main {
    max-width: 1100px;
    margin: 30px auto;
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

h2 {
    color: #424242;
    border-bottom: 2px solid #9e9e9e;
    padding-bottom: 8px;
    margin-top: 40px;
}

/* Grid de imágenes y videos */
.imagenes, .videos {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.imagenes img { width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.3); }

.videos iframe { width: 100%; max-width: 500px; height: 280px; border-radius: 10px; }

/* Enlaces */
.enlaces ul { padding-left: 20px; }
.enlaces a { color: #1565c0; text-decoration: none; transition: 0.3s; }
.enlaces a:hover { text-decoration: underline; }

/* Footer */
footer {
    background-color: #212121;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 40px;
    font-size: 0.9em;
}

/* ----------------------------- */
/* Responsivo */
/* ----------------------------- */
@media (max-width:768px){
    header h1 { font-size: 2em; }
    header p { font-size: 1em; }
    .imagenes img, .videos iframe { max-width: 100%; height: auto; }
}
        .logo-cecyte {
      width: 90px;
      height: auto;
      position: absolute;
      top: 15px;
      left: 15px;
      z-index: 2;
    }
</style>
</head>

<body>

<header>
    <a href="../index.php">
    <img src="../ECOCYTE.png" class="logo-cecyte" alt="Logo CECYTE">
    </a>

    <div class="language-selector">
        <p><?= $txt[$lang]['cambiar_idioma'] ?></p>
        <div class="flags">
            <a href="?lang=es"><img src="../mexicob.png" class="flag" alt="Español"></a>
            <a href="?lang=en"><img src="../USAb.png" class="flag" alt="English"></a>
        </div>
    </div>
    <h1><?= $txt[$lang]['titulo'] ?></h1>
    <p><?= $txt[$lang]['subtitulo'] ?></p>
</header>

<nav>
  <a href="../index.php"><?php echo $txt[$lang]['menu_inicio']; ?></a>
  <a href="papel.php"><?php echo $txt[$lang]['menu_papel']; ?></a>
  <a href="vidrio.php"><?php echo $txt[$lang]['menu_vidrio']; ?></a>
  <a href="plastico.php"><?php echo $txt[$lang]['menu_plastico']; ?></a>
  <a href="carton.php"><?php echo $txt[$lang]['menu_carton']; ?></a>
  <a href="metal.php"><?php echo $txt[$lang]['menu_metal']; ?></a>
  <a href="organico.php"><?php echo $txt[$lang]['menu_organico']; ?></a>
</nav>

<main>
    <section id="definicion">
        <h2><?= $txt[$lang]['definicion_t'] ?></h2>
        <p><?= $txt[$lang]['definicion1'] ?></p>
        <p><?= $txt[$lang]['definicion2'] ?></p>
        <div class="imagenes">
            <img src="imagenes/metal1.jpg" alt="Latas metálicas">
            <img src="imagenes/metal2.jpg" alt="Chatarra metálica">
        </div>
    </section>

    <section id="impacto">
        <h2><?= $txt[$lang]['impacto_t'] ?></h2>
        <p><?= $txt[$lang]['impacto1'] ?></p>
        <p><?= $txt[$lang]['impacto2'] ?></p>
        <div class="imagenes">
            <img src="imagenes/impacto_metal1.jpg" alt="Mina a cielo abierto">
            <img src="imagenes/impacto_metal2.jpg" alt="Contaminación industrial">
        </div>
    </section>

    <section id="reciclaje">
        <h2><?= $txt[$lang]['reciclaje_t'] ?></h2>
        <p><?= $txt[$lang]['reciclaje1'] ?></p>
        <p><?= $txt[$lang]['reciclaje2'] ?></p>
        <div class="videos">
            <iframe src="https://www.youtube.com/embed/7hQ8PBFKc2k" title="Cómo reciclar metales" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/gLaOuL1YwNc" title="Ideas creativas con metal reciclado" allowfullscreen></iframe>
        </div>
        <div class="imagenes">
            <img src="imagenes/reciclaje_metal1.jpg" alt="Fundición de metal reciclado">
            <img src="imagenes/reciclaje_metal2.jpg" alt="Decoraciones de metal reciclado">
        </div>
    </section>

    <section class="enlaces">
        <h2><?= $txt[$lang]['enlaces_t'] ?></h2>
        <ul>
            <li><a href="https://www.ecologiaverde.com/reciclaje-del-metal/" target="_blank"><?= $txt[$lang]['enlace1'] ?></a></li>
            <li><a href="https://www.greenpeace.org/mexico/blog/3762/por-que-es-importante-reciclar-los-metales/" target="_blank"><?= $txt[$lang]['enlace2'] ?></a></li>
            <li><a href="https://www.bbva.com/es/sostenibilidad/reciclaje-del-metal-un-camino-hacia-la-economia-circular/" target="_blank"><?= $txt[$lang]['enlace3'] ?></a></li>
        </ul>
    </section>
</main>

<footer>
    <p><?= $txt[$lang]['footer'] ?></p>
</footer>

</body>
</html>
