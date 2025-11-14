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


        'titulo' => 'Todo sobre el Vidrio',
        'subtitulo' => 'Descubre su proceso de fabricación, reciclaje y su papel en el cuidado del medio ambiente.',
        'definicion_t' => '¿Qué es el Vidrio?',
        'definicion' => 'El vidrio es un material inorgánico, duro, frágil y transparente, producido principalmente a partir de arena de sílice fundida junto con otros minerales como carbonato de sodio y caliza. Es 100% reciclable y puede reprocesarse infinitamente sin perder calidad ni pureza.',
        'impacto_t' => 'Impacto del Vidrio en el Medio Ambiente',
        'impacto' => 'A diferencia de otros materiales, el vidrio no libera sustancias tóxicas y puede ser reciclado una y otra vez. Sin embargo, si no se recicla correctamente, tarda miles de años en degradarse, generando acumulación de residuos en vertederos.',
        'reciclaje_t' => 'Cómo Reciclar y Reutilizar el Vidrio',
        'reciclaje' => 'Reciclar vidrio implica recolectar, limpiar y fundir los envases para fabricar nuevos productos. Es importante separar correctamente los envases de vidrio y no mezclarlos con cerámica o cristal, que no se reciclan igual. Además, muchas botellas pueden ser reutilizadas directamente.',
        'enlaces_t' => 'Recursos y enlaces útiles',
        'enlace1' => 'Reciclaje del vidrio - Ecología Verde',
        'enlace2' => 'El vidrio y el medio ambiente - Greenpeace',
        'enlace3' => 'Datos sobre el vidrio reciclado - Fundación Vidrio España',
        'volver' => 'Volver al inicio',
        'cambiar_idioma' => 'Cambiar idioma',
        'footer' => '♻️ Proyecto Reciclaje © 2025 | Dándole nueva vida al vidrio'
    ],
    'en' => [
        'menu_inicio'   => 'Back to Home',
        'menu_papel'    => 'Paper',
        'menu_vidrio'   => 'Glass',
        'menu_plastico' => 'Plastic',
        'menu_carton'   => 'Cardboard',
        'menu_metal'    => 'Metal',
        'menu_organico' => 'Organic',



        'titulo' => 'All About Glass',
        'subtitulo' => 'Learn about its production, recycling process, and role in protecting the environment.',
        'definicion_t' => 'What is Glass?',
        'definicion' => 'Glass is an inorganic, hard, brittle, and transparent material mainly produced from melted silica sand mixed with soda and limestone. It is 100% recyclable and can be reprocessed indefinitely without losing quality or purity.',
        'impacto_t' => 'Environmental Impact of Glass',
        'impacto' => 'Unlike other materials, glass does not release toxins and can be endlessly recycled. However, if not properly recycled, it can take thousands of years to decompose, contributing to waste accumulation in landfills.',
        'reciclaje_t' => 'How to Recycle and Reuse Glass',
        'reciclaje' => 'Glass recycling involves collecting, cleaning, and melting containers to produce new items. It is important to separate glass correctly and avoid mixing it with ceramics or crystal, which cannot be recycled the same way. Many bottles can also be directly reused.',
        'enlaces_t' => 'Resources and Useful Links',
        'enlace1' => 'Glass Recycling - Ecología Verde',
        'enlace2' => 'Glass and the Environment - Greenpeace',
        'enlace3' => 'Facts About Recycled Glass - Fundación Vidrio España',
        'volver' => 'Back to Home',
        'cambiar_idioma' => 'Change Language',
        'footer' => '♻️ Recycling Project © 2025 | Giving glass a new life'
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
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #d9f7f2;
      color: #1a2e2d;
      line-height: 1.6;
    }

    /* 🧊 HEADER con fondo tipo vidrio translúcido */
    header {
      position: relative;
      background: url('FONDOVID.jpg') no-repeat center center/cover;
      color: white;
      padding: 90px 10px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.5);
      animation: fadeIn 1.5s ease-in-out;
      overflow: hidden;
    }

    header::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 80, 70, 0.5); /* capa verde cristalina */
      backdrop-filter: blur(3px);
      z-index: 0;
    }

    header h1, header p, .language-selector {
      position: relative;
      z-index: 1;
    }

    /* ✨ Efecto brillante */
    header h1 {
      margin: 0;
      font-size: 2.8em;
      background: linear-gradient(90deg, #b2dfdb, #ffffff, #80cbc4, #e0f2f1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-size: 300%;
      animation: shine 6s linear infinite;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.5);
    }

    header p {
      font-size: 1.2em;
      color: #e0f2f1;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
      margin-top: 10px;
    }

    /* 🌟 Animaciones */
    @keyframes shine {
      0% { background-position: 200% 0; }
      100% { background-position: -200% 0; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* 🔹 Selector de idioma */
    .language-selector {
      position: absolute;
      top: 15px;
      right: 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
      font-size: 0.8em;
      color: white;
      z-index: 2;
    }

    .flags {
      display: flex;
      gap: 5px;
      margin-top: 5px;
    }

    .flag {
      height: 20px;
      cursor: pointer;
      border: 1px solid #fff;
      border-radius: 3px;
    }

    /* 🔹 NAV */
    nav {
      background-color: #00796b;
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

    nav a:hover {
      background-color: #48a999;
      border-radius: 5px;
    }

    /* 🔹 CONTENIDO */
    main {
      max-width: 1100px;
      margin: 30px auto;
      padding: 25px;
      background: #e8f6f3;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    section { margin-bottom: 50px; }

    h2 {
      color: #004d40;
      border-bottom: 2px solid #48a999;
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
      width: 300px;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    .videos iframe {
      width: 100%;
      max-width: 500px;
      height: 280px;
      border-radius: 10px;
    }

    .enlaces ul { list-style-type: none; padding-left: 0; }
    .enlaces li { margin-bottom: 10px; }

    .enlaces a {
      color: #006b63;
      text-decoration: none;
      font-weight: bold;
    }

    .enlaces a:hover { text-decoration: underline; }

    footer {
      background-color: #004d40;
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

  </style>
</head>
<body>

  <header>
    <img src="../EcoLogo.png" alt="Logo CECYTE" class="logo-cecyte">

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
        <img src="imagenes/vidrio1.jpg" alt="Botellas de vidrio">
        <img src="imagenes/vidrio2.jpg" alt="Fragmentos de vidrio reciclado">
      </div>
    </section>

    <section id="impacto">
      <h2><?php echo $txt[$lang]['impacto_t']; ?></h2>
      <p><?php echo $txt[$lang]['impacto']; ?></p>
      <div class="imagenes">
        <img src="imagenes/impacto_vidrio1.jpg" alt="Vidrio en la naturaleza">
        <img src="imagenes/impacto_vidrio2.jpg" alt="Montones de vidrio para reciclar">
      </div>
    </section>

    <section id="reciclaje">
      <h2><?php echo $txt[$lang]['reciclaje_t']; ?></h2>
      <p><?php echo $txt[$lang]['reciclaje']; ?></p>
      <div class="videos">
        <iframe src="https://www.youtube.com/embed/jIXvI6S7Eic" title="Reciclaje del vidrio" allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/l0K4x2EuzGg" title="Cómo se recicla el vidrio" allowfullscreen></iframe>
      </div>
      <div class="imagenes">
        <img src="imagenes/reciclaje_vidrio1.jpg" alt="Proceso de reciclaje de vidrio">
        <img src="imagenes/reciclaje_vidrio2.jpg" alt="Botellas de vidrio reutilizadas">
      </div>
    </section>

    <section class="enlaces">
      <h2><?php echo $txt[$lang]['enlaces_t']; ?></h2>
      <ul>
        <li><a href="https://www.ecologiaverde.com/reciclaje-del-vidrio-que-es-y-como-se-hace-3202.html" target="_blank"><?php echo $txt[$lang]['enlace1']; ?></a></li>
        <li><a href="https://es.greenpeace.org/es/trabajamos-en/consumo/vidrio-y-reciclaje/" target="_blank"><?php echo $txt[$lang]['enlace2']; ?></a></li>
        <li><a href="https://www.ecovidrio.es/" target="_blank"><?php echo $txt[$lang]['enlace3']; ?></a></li>
      </ul>
    </section>
  </main>

  <footer>
    <p><?php echo $txt[$lang]['footer']; ?></p>
  </footer>
</body>
</html>
