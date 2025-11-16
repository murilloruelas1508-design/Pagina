<?php
session_start();

// Cambiar idioma si se pasa por GET
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Idioma por defecto
$lang = $_SESSION['lang'] ?? 'es';

// -----------------------------
// Textos traducidos incluyendo menú
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


        'titulo' => 'Todo sobre el Plástico',
        'subtitulo' => 'Conoce su origen, su impacto ambiental y cómo puedes ayudar a reducir su uso.',
        'definicion_t' => '¿Qué es el Plástico?',
        'definicion' => 'El plástico es un material sintético derivado del petróleo y sus compuestos. Gracias a su bajo costo, durabilidad y versatilidad, se ha convertido en uno de los materiales más utilizados del mundo, presente en envases, electrodomésticos, ropa, automóviles y más.',
        'impacto_t' => 'Impacto del Plástico en el Medio Ambiente',
        'impacto' => 'Aunque el plástico es útil, su mal manejo provoca uno de los problemas ambientales más graves. Cada año, más de 8 millones de toneladas de plástico acaban en los océanos, dañando ecosistemas y especies marinas. Los microplásticos se han encontrado en el agua, el aire y hasta en el cuerpo humano. Además, su fabricación genera emisiones de gases de efecto invernadero.',
        'reciclaje_t' => 'Cómo Reciclar y Reutilizar el Plástico',
        'reciclaje' => 'El reciclaje del plástico consiste en recolectarlo, limpiarlo y transformarlo para fabricar nuevos productos. No todos los tipos de plástico son reciclables, por lo que es vital reducir su consumo y reutilizar siempre que sea posible. Puedes transformar botellas, tapas o bolsas en objetos útiles o decorativos.',
        'enlaces_t' => 'Recursos y enlaces útiles',
        'enlace1' => 'El plástico - National Geographic',
        'enlace2' => 'Cómo reciclar plástico - Ecología Verde',
        'enlace3' => 'ONU Medio Ambiente: El plástico, un material útil pero problemático',
        'cambiar_idioma' => 'Cambiar idioma',
        'volver' => 'Volver al inicio',
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
        
        'titulo' => 'All About Plastic',
        'subtitulo' => 'Learn about its origin, environmental impact, and how you can help reduce its use.',
        'definicion_t' => 'What is Plastic?',
        'definicion' => 'Plastic is a synthetic material derived from petroleum and its compounds. Due to its low cost, durability, and versatility, it has become one of the most widely used materials in the world, found in packaging, appliances, clothing, cars, and more.',
        'impacto_t' => 'Environmental Impact of Plastic',
        'impacto' => 'Although plastic is useful, its poor management causes one of the most serious environmental problems. Every year, more than 8 million tons of plastic end up in the oceans, harming ecosystems and marine species. Microplastics have been found in water, air, and even the human body. In addition, its production emits greenhouse gases.',
        'reciclaje_t' => 'How to Recycle and Reuse Plastic',
        'reciclaje' => 'Plastic recycling involves collecting, cleaning, and transforming it to create new products. Not all plastics are recyclable, so it is vital to reduce consumption and reuse whenever possible. You can turn bottles, caps, or bags into useful or decorative objects.',
        'enlaces_t' => 'Resources and Useful Links',
        'enlace1' => 'Plastic - National Geographic',
        'enlace2' => 'How to Recycle Plastic - Ecología Verde',
        'enlace3' => 'UN Environment: Plastic, a Useful but Problematic Material',
        'cambiar_idioma' => 'Change Language',
        'footer' => '♻️ Recycling Project © 2025 | Educating for a cleaner planet'
    ]
];
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $txt[$lang]['subtitulo']; ?>">
  <title><?php echo $txt[$lang]['titulo']; ?> | Reciclaje</title>
  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e1f5fe;
    color: #333;
    line-height: 1.6;
  }

  /* ----------------------------- */
  /* HEADER */
  /* ----------------------------- */
  header {
    position: relative;
    background: url('FONDOPLAS.jpg') no-repeat center center/cover;
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
    background: rgba(0, 60, 120, 0.5);
    z-index: 0;
  }

  header h1 {
    margin: 0;
    font-size: 2.8em;
    background: linear-gradient(90deg, #aee1ff, #ffffff, #81d4fa, #e1f5fe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 300%;
    animation: shine 6s linear infinite;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    position: relative;
    z-index: 1;
  }

  header p {
    font-size: 1.2em;
    margin-top: 10px;
    color: #e3f2fd;
    text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
    position: relative;
    z-index: 1;
  }

  /* ----------------------------- */
  /* ANIMACIONES */
  /* ----------------------------- */
  @keyframes shine {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ----------------------------- */
  /* LANGUAGE SELECTOR */
  /* ----------------------------- */
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

  /* ----------------------------- */
  /* NAV MENÚ */
  /* ----------------------------- */
  nav {
    background-color: #1976d2;
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
    background-color: #64b5f6;
    border-radius: 5px;
  }

  /* ----------------------------- */
  /* MAIN */
  /* ----------------------------- */
  main {
    max-width: 1100px;
    margin: 30px auto;
    padding: 25px;
    background: #e3f2fd;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  section {
    margin-bottom: 50px;
  }

  h2 {
    color: #1565c0;
    border-bottom: 2px solid #64b5f6;
    padding-bottom: 8px;
  }

  p {
    text-align: justify;
  }

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

  /* ----------------------------- */
  /* ENLACES */
  /* ----------------------------- */
  .enlaces ul {
    list-style: none;
    padding-left: 0;
  }

  .enlaces li {
    margin-bottom: 10px;
  }

  .enlaces a {
    color: #1565c0;
    text-decoration: none;
    font-weight: bold;
  }

  .enlaces a:hover {
    text-decoration: underline;
  }

  /* ----------------------------- */
  /* FOOTER */
  /* ----------------------------- */
  footer {
    background-color: #1976d2;
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
        <img src="imagenes/plastico1.jpg" alt="Botellas de plástico">
        <img src="imagenes/plastico2.jpg" alt="Tipos de plástico">
      </div>
    </section>

    <section id="impacto">
      <h2><?php echo $txt[$lang]['impacto_t']; ?></h2>
      <p><?php echo $txt[$lang]['impacto']; ?></p>
      <div class="imagenes">
        <img src="imagenes/impacto_plastico1.jpg" alt="Contaminación marina">
        <img src="imagenes/impacto_plastico2.jpg" alt="Animales afectados por plástico">
      </div>
    </section>

    <section id="reciclaje">
      <h2><?php echo $txt[$lang]['reciclaje_t']; ?></h2>
      <p><?php echo $txt[$lang]['reciclaje']; ?></p>
      <div class="videos">
        <iframe src="https://www.youtube.com/embed/6oTuY8bJ6c8" title="Cómo reciclar plástico en casa" loading="lazy" allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/dVqVct8N2i8" title="Manualidades con botellas plásticas" loading="lazy" allowfullscreen></iframe>
      </div>
      <div class="imagenes">
        <img src="imagenes/reutilizar_plastico1.jpg" alt="Macetas recicladas">
        <img src="imagenes/reutilizar_plastico2.jpg" alt="Manualidades ecológicas">
      </div>
    </section>

    <section class="enlaces">
      <h2><?php echo $txt[$lang]['enlaces_t']; ?></h2>
      <ul>
        <li><a href="https://www.nationalgeographic.com/environment/article/plastics" target="_blank"><?php echo $txt[$lang]['enlace1']; ?></a></li>
        <li><a href="https://www.ecologiaverde.com/como-reciclar-plastico/" target="_blank"><?php echo $txt[$lang]['enlace2']; ?></a></li>
        <li><a href="https://www.unep.org/es/noticias-y-reportajes/reportajes/el-plastico-un-material-util-pero-problematico" target="_blank"><?php echo $txt[$lang]['enlace3']; ?></a></li>
      </ul>
    </section>
  </main>

  <footer>
    <p><?php echo $txt[$lang]['footer']; ?></p>
  </footer>
</body>
</html>
