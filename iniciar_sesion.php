<?php
session_start();

/* ==========================
      SISTEMA DE IDIOMAS
========================== */
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'es';

$txt = [
    'es' => [
        'titulo' => 'Iniciar Sesión',
        'correo' => 'Correo electrónico',
        'password' => 'Contraseña',
        'boton' => 'Ingresar',
        'crear_cuenta' => 'Registrarse',
        'error_pass' => 'Contraseña incorrecta',
        'error_correo' => 'Correo no registrado',
        'idioma' => 'Cambiar idioma:',

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
        ]
    ],

    'en' => [
        'titulo' => 'Login',
        'correo' => 'Email address',
        'password' => 'Password',
        'boton' => 'Log in',
        'crear_cuenta' => 'Register',
        'error_pass' => 'Incorrect password',
        'error_correo' => 'Email not registered',
        'idioma' => 'Change language:',

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
        ]
    ]
];

/* ==========================
        LOGIN
========================== */

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = $_POST["correo"];
    $password = $_POST["password"];

    // Conexión BD
    $conn = new mysqli("localhost", "root", "", "ECOCYTE");
    if ($conn->connect_error) die("Error en BD: " . $conn->connect_error);

    // Buscar usuario
    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si existe
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {

            $_SESSION["usuario_id"] = $user["id"];
            $_SESSION["usuario_nombre"] = $user["nombre"];

            header("Location: perfil.php");
            exit;

        } else {
            $error = $txt[$lang]['error_pass'];
        }
    } else {
        $error = $txt[$lang]['error_correo'];
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8">
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

</style><script type="module" src=""></script>
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
            <li><a href="#"><?php echo $txt[$lang]['menu']['manualidades']; ?></a></li>
            <li><a href="#"><?php echo $txt[$lang]['menu']['conferencias']; ?></a></li>
            <li><a href="Registro.php"><?php echo $txt[$lang]['menu']['registro']; ?></a></li>

            <li>
                <a href="#"><?php echo $txt[$lang]['menu']['mas']; ?></a>
                <ul class="submenu">
                    <li><a href="galeria.php"><?php echo $txt[$lang]['menu']['galeria']; ?></a></li>
                    <li><a href="contacto.php"><?php echo $txt[$lang]['menu']['contacto']; ?></a></li>
                </ul>
            </li>
        </ul>
    </nav>
     <div class="language">
        <span><?php echo ($lang=='es'?'Cambiar idioma:':'Language:'); ?></span>
        <div>
            <a href="?lang=es"><img src="mexicob.png" class="flag"></a>
            <a href="?lang=en"><img src="USAb.png" class="flag"></a>
        </div>
    </div>
    </header>
<main>

    <h2><?php echo $txt[$lang]['titulo']; ?></h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">

        <label><?php echo $txt[$lang]['correo']; ?></label>
        <input type="email" name="correo" required>

        <label><?php echo $txt[$lang]['password']; ?></label>
        <input type="password" name="password" required>

        <button type="submit"><?php echo $txt[$lang]['boton']; ?></button>
    </form>

    <a href="Registro.php"><?php echo $txt[$lang]['crear_cuenta']; ?></a>

</main>

<footer>
<p>© 2025 Club de Ecología - CECyTE Hermosillo IV</p>
</footer>

</body>
</html>
