<?php
session_start();

// Cambiar idioma si se pasa por GET
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Idioma por defecto
$lang = $_SESSION['lang'] ?? 'es';

// Textos traducidos
$txt = [
    'es' => [
        'menu_inicio'   => 'Inicio',
        'menu_papel'    => 'Papel',
        'menu_vidrio'   => 'Vidrio',
        'menu_plastico' => 'Plástico',
        'menu_carton'   => 'Cartón',
        'menu_metal'    => 'Metal',
        'menu_organico' => 'Orgánico',


        'titulo' => 'Todo sobre el Cartón',
        'subtitulo' => 'Aprende sobre su uso, impacto ambiental y cómo reciclarlo correctamente.',
        'definicion_t' => '¿Qué es el Cartón?',
        'definicion' => 'El cartón es un material hecho a base de papel, generalmente formado por varias capas prensadas. Es resistente, ligero y ampliamente utilizado para embalajes, cajas y envases de productos.',
        'impacto_t' => 'Impacto del Cartón en el Medio Ambiente',
        'impacto' => 'El cartón es biodegradable y reciclable, pero cuando se mezcla con plásticos o contaminantes pierde su potencial de reciclaje. Además, la producción de cartón implica consumo de recursos naturales como madera y agua.',
        'reciclaje_t' => 'Cómo Reciclar y Reutilizar el Cartón',
        'reciclaje' => 'Reciclar cartón es sencillo: separa cajas limpias y secas, quita cintas adhesivas o plásticos y deposítalas en el contenedor correspondiente. También puedes reutilizar cajas para almacenamiento o manualidades.',
        'enlaces_t' => 'Recursos y enlaces útiles',
        'enlace1' => 'Cómo reciclar cartón - Ecología Verde',
        'enlace2' => 'Reciclaje de papel y cartón - National Geographic',
        'enlace3' => 'ONU Medio Ambiente: Reciclaje de papel y cartón',
        'volver' => 'Volver al inicio',
        'cambiar_idioma' => 'Cambiar idioma',
        'footer' => '♻️ Proyecto Reciclaje © 2025 | Educando para un planeta más limpio'
    ],
    'en' => [
        'menu_inicio'   => 'Back to Home',
        'menu_papel'    => 'Paper',
        'menu_vidrio'   => 'Glass',
        'menu_plastico' => 'Plastic',
        'menu_carton'   => 'Cardboard',
        'menu_metal'    => 'Metal',
        'menu_organico' => 'Organic',

        'titulo' => 'All About Cardboard',
        'subtitulo' => 'Learn about its use, environmental impact, and how to recycle it properly.',
        'definicion_t' => 'What is Cardboard?',
        'definicion' => 'Cardboard is a material made from paper, generally formed by several pressed layers. It is strong, lightweight, and widely used for packaging, boxes, and product containers.',
        'impacto_t' => 'Environmental Impact of Cardboard',
        'impacto' => 'Cardboard is biodegradable and recyclable, but when mixed with plastics or contaminants it loses its recycling potential. Additionally, cardboard production requires natural resources such as wood and water.',
        'reciclaje_t' => 'How to Recycle and Reuse Cardboard',
        'reciclaje' => 'Recycling cardboard is simple: separate clean, dry boxes, remove tape or plastics, and place them in the correct bin. You can also reuse boxes for storage or crafts.',
        'enlaces_t' => 'Resources and Useful Links',
        'enlace1' => 'How to Recycle Cardboard - Ecología Verde',
        'enlace2' => 'Recycling Paper and Cardboard - National Geographic',
        'enlace3' => 'UN Environment: Paper and Cardboard Recycling',
        'volver' => 'Back to Home',
        'cambiar_idioma' => 'Change Language',
        'footer' => '♻️ Recycling Project © 2025 | Educating for a Cleaner Planet'
    ]
];
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $txt[$lang]['titulo']; ?> | Reciclaje</title>

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
/* Header con animación metálica y fondo animado */
/* ----------------------------- */
header {
    position: relative;
    background: url('FONDOCART.jpg') center/cover no-repeat;
    color: white;
    text-align: center;
    display: flex;
    padding: 90px 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    animation: fadeIn 1.5s ease-in-out;

    display: flex; 
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
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

/* Animación de fondo */
@keyframes bgMove {
    0%   { background-size: 100% 100%; background-position: center top; transform: scale(1); }
    50%  { background-size: 110% 110%; background-position: center center; transform: scale(1.05); }
    100% { background-size: 100% 100%; background-position: center bottom; transform: scale(1); }
}

/* ----------------------------- */
/* NAV */
/* ----------------------------- */
nav {
    background-color: #8c5e3c;
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

nav a:hover { background-color: #d1a67a; border-radius: 5px; color: #333; }

/* ----------------------------- */
/* Main y secciones */
/* ----------------------------- */
main {
    max-width: 1100px;
    margin: 30px auto;
    padding: 25px;
    background: #d6b88f;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

section { margin-bottom: 50px; }

h2 {
    color: #6e4f36;
    border-bottom: 2px solid #d1a67a;
    padding-bottom: 8px;
}

p { text-align: justify; }

.imagenes, .videos {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.imagenes img {
    width: 100%;
    max-width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    animation: imgFloat 6s ease-in-out infinite alternate;
}

.videos iframe {
    width: 100%;
    max-width: 500px;
    height: 280px;
    border-radius: 10px;
}

/* Animación de imágenes */
@keyframes imgFloat {
    0%   { transform: translateY(0px); }
    50%  { transform: translateY(-10px) scale(1.02); }
    100% { transform: translateY(0px); }
}

/* Enlaces */
.enlaces ul { list-style-type: none; padding-left: 0; }
.enlaces li { margin-bottom: 10px; }
.enlaces a { color: #6e4f36; font-weight: bold; text-decoration: none; }
.enlaces a:hover { text-decoration: underline; }

/* Footer */
footer {
    background-color: #8c5e3c;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 40px;
    font-size: 0.9em;
}
    .logo-cecyte {
      width: 90px;
      height: auto;
      position: absolute;
      top: 15px;
      left: 15px;
      z-index: 2;
    }


/* Responsivo */
@media (max-width:768px){
    header h1 { font-size: 2em; }
    header p { font-size: 1em; }
    .imagenes img, .videos iframe { max-width: 100%; height: auto; }
}
</style>
</head>
<body>

<header>
     <a href="../index.php">
    <img src="../ECOCYTE.png" class="logo-cecyte" alt="Logo CECYTE">
    </a>

  <div class="language-selector">
    <p><?php echo $txt[$lang]['cambiar_idioma']; ?></p>
    <div class="flags">
      <a href="?lang=es"><img src="../mexicob.png" class="flag" alt="Español"></a>
      <a href="?lang=en"><img src="../USAb.png" class="flag" alt="English"></a>
    </div>
  </div>

  <h1><?php echo $txt[$lang]['titulo']; ?></h1>
  <p><?php echo $txt[$lang]['subtitulo']; ?></p>
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
    <h2><?php echo $txt[$lang]['definicion_t']; ?></h2>
    <p><?php echo $txt[$lang]['definicion']; ?></p>
    <div class="imagenes">
      <img src="imagenes/carton1.jpg" alt="Cajas de cartón">
      <img src="imagenes/carton2.jpg" alt="Cartón reciclado">
    </div>
  </section>

  <section id="impacto">
    <h2><?php echo $txt[$lang]['impacto_t']; ?></h2>
    <p><?php echo $txt[$lang]['impacto']; ?></p>
    <div class="imagenes">
      <img src="imagenes/impacto_carton1.jpg" alt="Residuos de cartón">
      <img src="imagenes/impacto_carton2.jpg" alt="Reciclaje de cartón">
    </div>
  </section>

  <section id="reciclaje">
    <h2><?php echo $txt[$lang]['reciclaje_t']; ?></h2>
    <p><?php echo $txt[$lang]['reciclaje']; ?></p>
    <div class="videos">
      <iframe src="https://www.youtube.com/embed/ABC123xyz" title="Reciclaje de cartón" allowfullscreen></iframe>
    </div>
    <div class="imagenes">
      <img src="imagenes/reutilizar_carton1.jpg" alt="Manualidades con cartón">
      <img src="imagenes/reutilizar_carton2.jpg" alt="Cajas reutilizadas">
    </div>
  </section>

  <section class="enlaces">
    <h2><?php echo $txt[$lang]['enlaces_t']; ?></h2>
    <ul>
      <li><a href="https://www.ecologiaverde.com/como-reciclar-carton/" target="_blank"><?php echo $txt[$lang]['enlace1']; ?></a></li>
      <li><a href="https://www.nationalgeographic.com/environment/article/recycling-paper-and-cardboard" target="_blank"><?php echo $txt[$lang]['enlace2']; ?></a></li>
      <li><a href="https://www.unep.org/es/noticias-y-reportajes/reportajes/el-reciclaje-del-papel-y-carton" target="_blank"><?php echo $txt[$lang]['enlace3']; ?></a></li>
    </ul>
  </section>
</main>

<footer>
  <p><?php echo $txt[$lang]['footer']; ?></p>
</footer>

</body>
</html>
