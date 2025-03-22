<?php
session_start();
require_once '../db/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$entrada_id = $_GET['id'];

// Obtener la entrada desde la base de datos
$sql = "SELECT * FROM entradas WHERE id = $entrada_id";
$resultado = mysqli_query($conexion, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $entrada = mysqli_fetch_assoc($resultado);
} else {
    echo "Error: La entrada no existe.";
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title><?= htmlspecialchars($entrada['titulo']) ?></title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style3.css" />
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div id="contenedor">
        <div id="principal3">
            <h1><?= htmlspecialchars($entrada['titulo']) ?></h1>
            <span class="fecha"><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?> | 
            <?= htmlspecialchars($entrada['fecha']) ?></span>
            <p><?= nl2br(htmlspecialchars($entrada['descripcion'])) ?></p>
            <a href="../index.php">Volver al inicio</a>
        </div>
    </div>

    <footer id="pie">
        <p>Desarrollado por KCKS &copy; <?= date('Y'); ?></p>
    </footer>

</body>
</html>
