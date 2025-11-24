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
            'contacto' => 'Contacto',
            'perfil'=>'Perfil'
        ],
        'registro_titulo' => 'Formulario de Registro',
        'nombre' => 'Nombre completo',
        'correo' => 'Correo electrónico',
        'contraseña' => 'Contraseña',
        'telefono' => 'Teléfono',
        'tipo' => 'Tipo de participante',
        'alumno' => 'Alumno',
        'docente' => 'Docente',
        'directivo' => 'Directivo',
        'administrativo' => 'Administrativo',
        'otros' => 'Otros',
        'plantel' => 'Plantel / Escuela',
        'semestre' => 'Semestre o Grado actual',
        'participacion' => '¿Has participado antes en actividades del club?',
        'motivo' => 'Motivación para unirte al club',
        'intereses' => 'Áreas de interés ecológico',
        'enviar' => 'Enviar Registro',
        'cuenta' => '¿Ya tienes cuenta?',
        'iniciar' => 'Iniciar sesion',
        'footer'=>'© 2025 ECOCYTE – Proyecto ecológico'
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
            'contacto' => 'Contact',
            'perfil'=>'Perfil'
        ],
        'registro_titulo' => 'Registration Form',
        'nombre' => 'Full Name',
        'correo' => 'Email',
        'contraseña' => 'Password',
        'telefono' => 'Phone',
        'tipo' => 'Participant Type',
        'alumno' => 'Student',
        'docente' => 'Teacher',
        'directivo' => 'Director',
        'administrativo' => 'Administrative',
        'otros' => 'Other',
        'plantel' => 'Campus / School',
        'semestre' => 'Current Semester / Grade',
        'participacion' => 'Have you participated in club activities before?',
        'motivo' => 'Motivation to join the club',
        'intereses' => 'Ecological areas of interest',
        'enviar' => 'Submit Registration',
        'cuenta' => 'Do you already have an account?',
        'iniciar' => 'Login',
        'footer'=>'© 2025 ECOCYTE – Ecology Project'
    ]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $txt[$lang]['menu']['registro']; ?></title>
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
    color: #3e2723;
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
    background: #8d6e63;
    border-radius: 4px;
}

/* Submenú */
nav.menu .submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #A9B192;
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
    <div class="logo">
        <a href="index.php"><img src="../ECOCYTE.png" alt="Logo"></a>
    </div>
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
<h2><?php echo $txt[$lang]['registro_titulo']; ?></h2>

<form action="registro_submit.php" method="POST">
    <label for="nombre"><?php echo $txt[$lang]['nombre']; ?></label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="correo"><?php echo $txt[$lang]['correo']; ?></label>
    <input type="email" id="correo" name="correo" required>

    <label><?= $txt[$lang]['contraseña'] ?></label>
    <input type="password" name="password" required>    

    <label for="telefono"><?php echo $txt[$lang]['telefono']; ?></label>
    <input type="text" id="telefono" name="telefono">

    <label for="tipo"><?php echo $txt[$lang]['tipo']; ?></label>
    <select id="tipo" name="tipo">
        <option value="alumno"><?php echo $txt[$lang]['alumno']; ?></option>
        <option value="docente"><?php echo $txt[$lang]['docente']; ?></option>
        <option value="directivo"><?php echo $txt[$lang]['directivo']; ?></option>
        <option value="administrativo"><?php echo $txt[$lang]['administrativo']; ?></option>
        <option value="otros"><?php echo $txt[$lang]['otros']; ?></option>
    </select>

    <label for="plantel"><?php echo $txt[$lang]['plantel']; ?></label>
    <input type="text" id="plantel" name="plantel">

    <label for="semestre"><?php echo $txt[$lang]['semestre']; ?></label>
    <input type="text" id="semestre" name="semestre">

    <label for="participacion"><?php echo $txt[$lang]['participacion']; ?></label>
    <textarea id="participacion" name="participacion"></textarea>

    <label for="motivo"><?php echo $txt[$lang]['motivo']; ?></label>
    <textarea id="motivo" name="motivo"></textarea>

    <label for="intereses"><?php echo $txt[$lang]['intereses']; ?></label>
    <textarea id="intereses" name="intereses"></textarea>

    <button type="submit"><?php echo $txt[$lang]['enviar']; ?></button>


</form>
  <label><?php echo $txt[$lang]['cuenta']; ?>

    <a href="iniciar_sesion.php">
       <button type="submit"><?php echo $txt[$lang]['iniciar']; ?></button>
    </a>
</label>
</main>

<footer>
<?php echo $txt[$lang]['footer']; ?>
</footer>

</body>
</html>
