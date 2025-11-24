<?php
session_start();

// ================== LANG ==================
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';

// ================== TEXTOS ==================
$txt = [
    'es' => [
        'titulo' => 'Galería de Evidencias',
        'subtitulo' => 'Sube y administra tus evidencias',
        'subir' => 'Subir evidencia',
        'actividad' => 'Actividad',
        'fecha' => 'Fecha',
        'descripcion' => 'Descripción',
        'archivo' => 'Archivo',
        'boton_subir' => 'Subir evidencia',
        'galeria_titulo' => 'Tus evidencias',
        'eliminar' => 'Eliminar',
        'msg_sube_ok' => 'Evidencia subida correctamente.',
        'msg_elim_ok' => 'Evidencia eliminada correctamente.',
        'msg_no_permiso' => 'No tienes permiso para eliminar esta evidencia.',
        'footer'=>'© 2025 ECOCYTE – Proyecto ecológico',
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
            'perfil' => 'Perfil'
        ],
    ],
    'en' => [
        'titulo' => 'Gallery of Evidences',
        'subtitulo' => 'Upload and manage your evidences',
        'subir' => 'Upload Evidence',
        'actividad' => 'Activity',
        'fecha' => 'Date',
        'descripcion' => 'Description',
        'archivo' => 'File',
        'boton_subir' => 'Upload Evidence',
        'galeria_titulo' => 'Your Evidences',
        'eliminar' => 'Delete',
        'msg_sube_ok' => 'Evidence uploaded successfully.',
        'msg_elim_ok' => 'Evidence deleted successfully.',
        'msg_no_permiso' => 'You do not have permission to delete this evidence.',
        'footer'=>'© 2025 ECOCYTE – Ecology Project',
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
            'perfil' => 'Profile'
        ],
    ]
];

// ================== SESIÓN ==================
if (!isset($_SESSION['usuario_id'])) {
    die("No has iniciado sesión.");
}

$codigo_usuario = $_SESSION['usuario_id'];

// ================== CONEXIÓN ==================
$conn = new mysqli("localhost", "root", "", "ECOCYTE");
if ($conn->connect_error) die("Error BD: " . $conn->connect_error);

// ================== CARPETA UPLOADS ==================
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

// ================== ELIMINAR ==================
if (isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $res = $conn->query("SELECT archivo, codigo_usuario FROM galeria WHERE id=$delete_id");
    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();
        if ($row['codigo_usuario'] == $codigo_usuario) {
            $filePath = $uploadDir . $row['archivo'];
            if (file_exists($filePath)) unlink($filePath);
            $conn->query("DELETE FROM galeria WHERE id=$delete_id");
            $mensaje = $txt[$lang]['msg_elim_ok'];
        } else {
            $mensaje = $txt[$lang]['msg_no_permiso'];
        }
    }
}

// ================== SUBIR ==================
if (isset($_POST['submit'])) {
    $actividad = $conn->real_escape_string($_POST['actividad']);
    $fecha = $_POST['fecha'];
    $descripcion = $conn->real_escape_string($_POST['descripcion']);

    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $nombreArchivo = time() . "_" . basename($_FILES['archivo']['name']);
        $rutaDestino = $uploadDir . $nombreArchivo;

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaDestino)) {
            $sql = "INSERT INTO galeria (codigo_usuario, actividad, fecha, descripcion, archivo) 
                    VALUES ('$codigo_usuario', '$actividad', '$fecha', '$descripcion', '$nombreArchivo')";
            $conn->query($sql);
            $mensaje = $txt[$lang]['msg_sube_ok'];
        }
    }
}

// ================== OBTENER EVIDENCIAS ==================
$result = $conn->query("SELECT * FROM galeria WHERE codigo_usuario=$codigo_usuario ORDER BY fecha_subida DESC");

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8">
<title><?php echo $txt[$lang]['titulo']; ?></title>
<!-- AQUÍ PUEDES PONER TU CSS DEL MENU Y BODY -->
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
        <a href="<?= htmlspecialchars($link_es) ?>"><img src="mexicob.png" class="flag" alt="Español"></a>
        <a href="<?= htmlspecialchars($link_en) ?>"><img src="USAb.png" class="flag" alt="English"></a>
    </div>
</div>

</header>

<main>
<h2><?php echo $txt[$lang]['subir']; ?></h2>

<?php if (!empty($mensaje)) echo "<p style='color:green;'>$mensaje</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    <label><?php echo $txt[$lang]['actividad']; ?></label>
    <input type="text" name="actividad" required><br>

    <label><?php echo $txt[$lang]['fecha']; ?></label>
    <input type="date" name="fecha" required><br>

    <label><?php echo $txt[$lang]['descripcion']; ?></label>
    <textarea name="descripcion" rows="4" required></textarea><br>

    <label><?php echo $txt[$lang]['archivo']; ?></label>
    <input type="file" name="archivo" accept="image/*" required><br><br>

    <button type="submit" name="submit"><?php echo $txt[$lang]['boton_subir']; ?></button>
</form>

<h2><?php echo $txt[$lang]['galeria_titulo']; ?></h2>
<div class="galeria" style="display:flex; flex-wrap:wrap; gap:20px;">
<?php while ($row = $result->fetch_assoc()): ?>
    <div class="galeria-item" style="border:1px solid #ccc; padding:10px; width:200px; position:relative;">
        <img src="uploads/<?php echo htmlspecialchars($row['archivo']); ?>" style="width:100%; height:auto;"><br>
        <strong><?php echo $txt[$lang]['actividad']; ?>:</strong> <?php echo htmlspecialchars($row['actividad']); ?><br>
        <strong><?php echo $txt[$lang]['fecha']; ?>:</strong> <?php echo $row['fecha']; ?><br>
        <p><?php echo nl2br(htmlspecialchars($row['descripcion'])); ?></p>

        <form method="POST" style="margin-top:5px;">
            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
            <button>
                <?php echo $txt[$lang]['eliminar']; ?>
            </button>
        </form>
    </div>
<?php endwhile; ?>
</div>

</main>

<footer>
   <?php echo $txt[$lang]['footer']; ?>
</footer>

</body>
</html>
