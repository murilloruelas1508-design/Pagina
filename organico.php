<?php
// -----------------------------
// Configuración de idioma
// -----------------------------
$lang = 'es'; // idioma por defecto
if (isset($_GET['lang'])) {
    if ($_GET['lang'] === 'en') $lang = 'en';
    if ($_GET['lang'] === 'es') $lang = 'es';
}

// -----------------------------
// Textos traducidos
// -----------------------------
$txt = [
    'es' => [
        'titulo' => 'Todo sobre Orgánico',
        'subtitulo' => 'Aprende cómo los residuos orgánicos impactan al medio ambiente y cómo reciclarlos correctamente.',
        'definicion_t' => '¿Qué son los Residuos Orgánicos?',
        'definicion' => 'Los residuos orgánicos son materiales biodegradables provenientes de plantas, alimentos y restos de jardín. Incluyen cáscaras de frutas y verduras, restos de café, hojas, césped y ramas pequeñas. Separarlos permite convertirlos en compost o abono natural, reduciendo la basura enviada a rellenos sanitarios.',
        'impacto_t' => 'Impacto de los Residuos Orgánicos',
        'impacto' => 'Si se gestionan mal, los residuos orgánicos generan gases de efecto invernadero como el metano, contribuyendo al cambio climático. Pero cuando se reciclan mediante compostaje, se transforman en nutrientes que mejoran la fertilidad del suelo.',
        'reciclaje_t' => 'Cómo Reciclar y Reutilizar los Residuos Orgánicos',
        'reciclaje' => 'Para reciclar residuos orgánicos puedes usar un compostador doméstico, separar restos de cocina para alimentar lombrices o evitar mezclarlos con plásticos o metales.',
        'enlaces_t' => 'Recursos y enlaces útiles',
        'enlace1' => 'Cómo reciclar residuos orgánicos - Ecología Verde',
        'enlace2' => 'Greenpeace: Compostaje y reciclaje orgánico',
        'enlace3' => 'WWF: Medio ambiente y residuos',
        'volver' => 'Volver al inicio',
        'cambiar_idioma' => 'Cambiar idioma',
        'footer' => '♻️ Proyecto Reciclaje © 2025 | Cuidando el planeta hoja por hoja'
    ],
    'en' => [
        'titulo' => 'All About Organic Waste',
        'subtitulo' => 'Learn how organic waste impacts the environment and how to recycle it properly.',
        'definicion_t' => 'What is Organic Waste?',
        'definicion' => 'Organic waste includes biodegradable materials from plants, food, and gardens. It consists of fruit and vegetable peels, coffee grounds, leaves, grass, and small branches. Separating them allows composting, reducing landfill waste.',
        'impacto_t' => 'Environmental Impact of Organic Waste',
        'impacto' => 'When mismanaged, organic waste produces greenhouse gases like methane, contributing to climate change. When composted, it becomes a natural fertilizer that enriches soil and reduces the need for chemicals.',
        'reciclaje_t' => 'How to Recycle and Reuse Organic Waste',
        'reciclaje' => 'You can recycle organic waste by using a home compost bin, feeding worms with food scraps, and keeping organics separate from plastics or metals.',
        'enlaces_t' => 'Resources and Useful Links',
        'enlace1' => 'How to Recycle Organic Waste - Ecología Verde',
        'enlace2' => 'Greenpeace: Composting and Organic Recycling',
        'enlace3' => 'WWF: Environment and Waste Management',
        'volver' => 'Back to Home',
        'cambiar_idioma' => 'Change Language',
        'footer' => '♻️ Recycling Project © 2025 | Caring for the planet leaf by leaf'
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
      background-color: #f3f9f1;
      color: #333;
      line-height: 1.6;
    }

    /* 🌿 HEADER CON IMAGEN DE FONDO Y EFECTO DE BRILLO VERDE */
    header {
      position: relative;
      background: url('FONDOORG.jpg') no-repeat center center/cover;
      color: white;
      padding: 90px 10px;
      text-align: center;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.5);
      animation: fadeIn 1.5s ease-in-out;
    }

    header::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 60, 0, 0.45); /* capa verde translúcida */
      z-index: 0;
    }

    header h1, header p, .language-selector {
      position: relative;
      z-index: 1;
    }

    /* ✨ TÍTULO CON EFECTO DE BRILLO NATURAL */
    header h1 {
      margin: 0;
      font-size: 2.8em;
      letter-spacing: 1px;
      background: linear-gradient(
        90deg,
        #c9f6c4 0%,
        #ffffff 20%,
        #a2e59d 40%,
        #e8ffe3 60%,
        #c9f6c4 100%
      );
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: shine 5s linear infinite;
      background-size: 300%;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
    }

    @keyframes shine {
      0% { background-position: 200% 0; }
      100% { background-position: -200% 0; }
    }

    /* Subtítulo suave */
    header p {
      font-size: 1.2em;
      margin-top: 10px;
      color: #e8ffe3;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
    }

    /* Animación de aparición */
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
      gap: 4px;
      font-size: 0.8em;
      color: #fff;
      z-index: 2;
    }

    .flags {
      display: flex;
      gap: 5px;
    }

    .flag {
      height: 20px;
      cursor: pointer;
      border: 1px solid #fff;
      border-radius: 3px;
    }

    /* 🔹 NAV */
    nav {
      background-color: #68a354;
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
      background-color: #4e813f;
      border-radius: 5px;
    }

    /* 🔹 CONTENIDO */
    main {
      max-width: 1100px;
      margin: 30px auto;
      padding: 25px;
      background: #eaf3e8;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    section { margin-bottom: 50px; }

    h2 {
      color: #4e813f;
      border-bottom: 2px solid #a7d49b;
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

    .enlaces ul {
      list-style-type: none;
      padding-left: 0;
    }

    .enlaces li { margin-bottom: 10px; }

    .enlaces a {
      color: #4e813f;
      text-decoration: none;
      font-weight: bold;
    }

    .enlaces a:hover { text-decoration: underline; }

    footer {
      background-color: #68a354;
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
    <div class="language-selector">
      <p><?php echo $txt[$lang]['cambiar_idioma']; ?></p>
      <div class="flags">
        <a href="?lang=es"><img src="mexicob.png" class="flag" alt="Español"></a>
        <a href="?lang=en"><img src="USAb.png" class="flag" alt="English"></a>
      </div>
    </div>

    <h1><?php echo $txt[$lang]['titulo']; ?></h1>
    <p><?php echo $txt[$lang]['subtitulo']; ?></p>
  </header>

  <nav>
    <a href="index.php"><?php echo $txt[$lang]['volver']; ?></a>
    <a href="papel.php">Papel</a>
    <a href="plastico.php">Plástico</a>
    <a href="vidrio.php">Vidrio</a>
    <a href="carton.php">Cartón</a>
    <a href="metal.php">Metal</a>
  </nav>

  <main>
    <section id="definicion">
      <h2><?php echo $txt[$lang]['definicion_t']; ?></h2>
      <p><?php echo $txt[$lang]['definicion']; ?></p>
      <div class="imagenes">
        <img src="imagenes/organico1.jpg" alt="Residuos orgánicos">
        <img src="imagenes/organico2.jpg" alt="Compost natural">
      </div>
    </section>

    <section id="impacto">
      <h2><?php echo $txt[$lang]['impacto_t']; ?></h2>
      <p><?php echo $txt[$lang]['impacto']; ?></p>
      <div class="imagenes">
        <img src="imagenes/impacto_organico1.jpg" alt="Basura orgánica acumulada">
        <img src="imagenes/impacto_organico2.jpg" alt="Compost natural en jardín">
      </div>
    </section>

    <section id="reciclaje">
      <h2><?php echo $txt[$lang]['reciclaje_t']; ?></h2>
      <p><?php echo $txt[$lang]['reciclaje']; ?></p>
      <div class="videos">
        <iframe src="https://www.youtube.com/embed/3uHhbK5i3Gg" title="Cómo hacer compost en casa" allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/tGvL5O9R5EE" title="Beneficios del reciclaje orgánico" allowfullscreen></iframe>
      </div>
      <div class="imagenes">
        <img src="imagenes/reciclaje_organico1.jpg" alt="Compostaje doméstico">
        <img src="imagenes/reciclaje_organico2.jpg" alt="Jardín con abono orgánico">
      </div>
    </section>

    <section class="enlaces">
      <h2><?php echo $txt[$lang]['enlaces_t']; ?></h2>
      <ul>
        <li><a href="https://www.ecologiaverde.com/como-reciclar-residuos-organicos/" target="_blank"><?php echo $txt[$lang]['enlace1']; ?></a></li>
        <li><a href="https://www.greenpeace.org/espana/reciclaje/" target="_blank"><?php echo $txt[$lang]['enlace2']; ?></a></li>
        <li><a href="https://www.wwf.es/" target="_blank"><?php echo $txt[$lang]['enlace3']; ?></a></li>
      </ul>
    </section>
  </main>

  <footer>
    <p><?php echo $txt[$lang]['footer']; ?></p>
  </footer>

</body>
</html>
