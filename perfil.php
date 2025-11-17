<?php
session_start();

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'es';


// ========================= TEXTOS =========================
$txt = [
    'es' => [
        'titulo' => 'Perfil de Usuario',
        'bienvenido' => 'Bienvenido',
        'correo' => 'Correo',
        'telefono' => 'Teléfono',
        'tipo' => 'Tipo de participante',
        'plantel' => 'Plantel / Escuela',
        'semestre' => 'Semestre',
        'participacion' => 'Participación previa',
        'motivo' => 'Motivación',
        'intereses' => 'Áreas de interés',
        'editar' => 'Editar perfil',
        'cerrar' => 'Cerrar sesión',

        // menú
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
        'titulo' => 'User Profile',
        'bienvenido' => 'Welcome',
        'correo' => 'Email',
        'telefono' => 'Phone',
        'tipo' => 'Participant Type',
        'plantel' => 'Campus / School',
        'semestre' => 'Semester',
        'participacion' => 'Previous Participation',
        'motivo' => 'Motivation',
        'intereses' => 'Areas of Interest',
        'editar' => 'Edit Profile',
        'cerrar' => 'Log Out',

        // menú
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

// ========================= RESTRICCIÓN =========================
if (!isset($_SESSION['usuario_id'])) {
    header("Location: Registro.php");
    exit;
}

// ========================= BD =========================
$conn = new mysqli("localhost", "root", "", "ECOCYTE");
if ($conn->connect_error) die("Error BD: " . $conn->connect_error);

$id = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
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

<h2><?php echo $txt[$lang]['bienvenido']; ?>, <?php echo $usuario['nombre']; ?></h2>

<p><strong><?php echo $txt[$lang]['correo']; ?>:</strong> <?= $usuario['correo']; ?></p>
<p><strong><?php echo $txt[$lang]['telefono']; ?>:</strong> <?= $usuario['telefono']; ?></p>
<p><strong><?php echo $txt[$lang]['tipo']; ?>:</strong> <?= $usuario['tipo']; ?></p>
<p><strong><?php echo $txt[$lang]['plantel']; ?>:</strong> <?= $usuario['plantel']; ?></p>
<p><strong><?php echo $txt[$lang]['semestre']; ?>:</strong> <?= $usuario['semestre']; ?></p>
<p><strong><?php echo $txt[$lang]['participacion']; ?>:</strong> <?= $usuario['participacion']; ?></p>
<p><strong><?php echo $txt[$lang]['motivo']; ?>:</strong> <?= $usuario['motivo']; ?></p>
<p><strong><?php echo $txt[$lang]['intereses']; ?>:</strong> <?= $usuario['intereses']; ?></p>

<br>
<a href="cerrar_sesion.php" class="btn logout"><?php echo $txt[$lang]['cerrar']; ?></a>

</main>

<footer>
<p>© 2025 Club de Ecología - CECyTE Hermosillo IV</p>
</footer>

</body>
</html>
