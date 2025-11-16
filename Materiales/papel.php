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


        'titulo' => 'Todo sobre el Papel',
        'subtitulo' => 'Descubre su origen, impacto ambiental y cómo reciclarlo de manera efectiva.',
        'definicion_t' => '¿Qué es el Papel?',
        'definicion' => 'El papel es un material hecho a partir de fibras vegetales, principalmente de madera. Se utiliza para escribir, imprimir, empaquetar y fabricar distintos productos cotidianos. Su producción y consumo masivo tiene un impacto ambiental significativo si no se maneja de manera sostenible.',
        'impacto_t' => 'Impacto del Papel en el Medio Ambiente',
        'impacto' => 'La producción de papel requiere grandes cantidades de agua y energía, y contribuye a la deforestación si no se obtiene de fuentes sostenibles. Además, el papel desechado sin reciclar genera residuos y puede contribuir a la contaminación de suelos y cuerpos de agua.',
        'reciclaje_t' => 'Cómo Reciclar y Reutilizar el Papel',
        'reciclaje' => 'Reciclar papel consiste en recolectarlo, clasificarlo, triturarlo y transformarlo en pulpa para fabricar nuevo papel. Se puede reducir el consumo reutilizando hojas y cartones, y creando manualidades o productos ecológicos con papel usado.',
        'enlaces_t' => 'Recursos y enlaces útiles',
        'enlace1' => 'Reciclaje de papel - Ecología Verde',
        'enlace2' => 'Consejos para reducir el consumo de papel - Greenpeace',
        'enlace3' => 'ONU Medio Ambiente: Papel sostenible',
        'volver' => 'Volver al inicio',
        'cambiar_idioma' => 'Cambiar idioma',
        'footer' => '♻️ Proyecto Reciclaje © 2025 | Educando para un planeta más limpio',
    ],
    'en' => [
        'menu_inicio'   => 'Back to Home',
        'menu_papel'    => 'Paper',
        'menu_vidrio'   => 'Glass',
        'menu_plastico' => 'Plastic',
        'menu_carton'   => 'Cardboard',
        'menu_metal'    => 'Metal',
        'menu_organico' => 'Organic',

        'titulo' => 'All About Paper',
        'subtitulo' => 'Discover its origin, environmental impact, and how to recycle it effectively.',
        'definicion_t' => 'What is Paper?',
        'definicion' => 'Paper is a material made from plant fibers, mainly wood. It is used for writing, printing, packaging, and making various everyday products. Its mass production and consumption have significant environmental impact if not managed sustainably.',
        'impacto_t' => 'Environmental Impact of Paper',
        'impacto' => 'Paper production requires large amounts of water and energy, and contributes to deforestation if not sourced sustainably. Additionally, paper waste that is not recycled generates trash and can pollute soil and water bodies.',
        'reciclaje_t' => 'How to Recycle and Reuse Paper',
        'reciclaje' => 'Recycling paper involves collecting, sorting, shredding, and turning it into pulp to make new paper. Consumption can be reduced by reusing sheets and cardboard, and making crafts or eco-friendly products from used paper.',
        'enlaces_t' => 'Resources and Useful Links',
        'enlace1' => 'Paper Recycling - Ecología Verde',
        'enlace2' => 'Tips to Reduce Paper Consumption - Greenpeace',
        'enlace3' => 'UN Environment: Sustainable Paper',
        'volver' => 'Back to Home',
        'cambiar_idioma' => 'Change Language',
        'footer' => '♻️ Recycling Project © 2025 | Educating for a cleaner planet',
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
      background-color: #fff3e0;
      color: #333;
      line-height: 1.6;
      scroll-behavior: smooth;
    }

    /* 🌿 HEADER */
    header {
      position: relative;
      background: url('FONDOPAP.jpg') no-repeat center center/cover;
      color: white;
      padding: 90px 10px; 
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.5);
      animation: fadeIn 1.5s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
    }

    header::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(160, 82, 45, 0.5);
      z-index: 0;
    }

    .logo-cecyte {
      width: 90px;
      height: auto;
      position: absolute;
      top: 15px;
      left: 15px;
      z-index: 2;
    }

    header h1, header p, .language-selector {
      position: relative;
      z-index: 1;
      text-align: center;
    }

    header h1 {
      margin: 0;
      font-size: 2.8em;
      background: linear-gradient(90deg, #ffe0b2, #ffffff, #ffcc80, #fff3e0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-size: 300%;
      animation: shine 6s linear infinite;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    }

    header p {
      font-size: 1.2em;
      margin-top: 10px;
      color: #ffe0b2;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
    }

    @keyframes shine {
      0% { background-position: 200% 0; }
      100% { background-position: -200% 0; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

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

    /* 🌿 NAV MENÚ */
    nav {
      background-color: #8d6e63;
      text-align: center;
      padding: 12px 0;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    nav a {
      color: white;
      text-decoration: none;
      padding: 10px 18px;
      display: inline-block;
      transition: 0.3s;
    }

    nav a:hover {
      background-color: #d7ccc8;
      color: #5d4037;
      border-radius: 5px;
    }

    main {
      max-width: 1100px;
      margin: 30px auto;
      padding: 25px;
      background: #fff8e1;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    section { margin-bottom: 50px; }

    h2 {
      color: #6d4c41;
      border-bottom: 2px solid #d7ccc8;
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

    .enlaces ul { list-style: none; padding-left: 0; }
    .enlaces li { margin-bottom: 10px; }

    .enlaces a {
      color: #6d4c41;
      text-decoration: none;
      font-weight: bold;
    }

    .enlaces a:hover { text-decoration: underline; }

    footer {
      background-color: #8d6e63;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 40px;
      font-size: 0.9em;
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

    <div>
      <h1><?php echo $txt[$lang]['titulo']; ?></h1>
      <p><?php echo $txt[$lang]['subtitulo']; ?></p>
    </div>
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
        <img src="papel1.jpg" alt="Fábrica de papel">
        <img src="papel2.jpg" alt="Tipos de papel">
      </div>
    </section>

    <section id="impacto">
      <h2><?php echo $txt[$lang]['impacto_t']; ?></h2>
      <p><?php echo $txt[$lang]['impacto']; ?></p>
      <div class="videos">
        <iframe src="https://www.youtube.com/embed/LJ-5I5gzGxQ" title="Impacto ambiental del papel" allowfullscreen></iframe>
      </div>
    </section>

    <section id="reciclaje">
      <h2><?php echo $txt[$lang]['reciclaje_t']; ?></h2>
      <p><?php echo $txt[$lang]['reciclaje']; ?></p>
      <div class="imagenes">
        <img src="reciclaje1.jpg" alt="Reciclaje de papel">
        <img src="reciclaje2.jpg" alt="Reutilización creativa de papel">
      </div>
      <div class="videos">
        <iframe src="https://www.youtube.com/embed/pA5sRtH9H3k" title="Cómo reciclar papel en casa" allowfullscreen></iframe>
      </div>
    </section>

    <section id="enlaces" class="enlaces">
      <h2><?php echo $txt[$lang]['enlaces_t']; ?></h2>
      <ul>
        <li><a href="https://www.ecologiaverde.com/reciclaje-de-papel/" target="_blank"><?php echo $txt[$lang]['enlace1']; ?></a></li>
        <li><a href="https://www.greenpeace.org/espana/blog/como-reducir-el-consumo-de-papel/" target="_blank"><?php echo $txt[$lang]['enlace2']; ?></a></li>
        <li><a href="https://www.unep.org/es/noticias-y-reportajes/reportaje/papel-sostenible" target="_blank"><?php echo $txt[$lang]['enlace3']; ?></a></li>
      </ul>
    </section>
  </main>

  <footer>
    <?php echo $txt[$lang]['footer']; ?>
  </footer>
</body>
</html>
