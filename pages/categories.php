<?php
session_start();
require_once '../db/db.php'; // Archivo de conexión a la base de datos

// Procesar el formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_categoria = trim($_POST["nombre_categoria"]);

    if (!empty($nombre_categoria)) {
        // Insertar en la base de datos
        $sql = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $nombre_categoria);
        $stmt->execute();
        $stmt->close();

        echo "<p style='color: green;'>Categoria creada correctamente, Serás redirigido en 3 segundos...</p>";
        echo '<meta http-equiv="refresh" content="3;url=../index.php">';
        echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 3000);
          </script>';
    exit;
    } else {
        $_SESSION['mensaje'] = "El nombre de la categoría no puede estar vacío.";
    }
}

// Obtener todas las categorías
$sql = "SELECT id, nombre FROM categorias";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
</head>
<body>


<?php
// Mostrar mensaje si existe
if (isset($_SESSION['mensaje'])) {
    echo "<p style='color: green;'>" . $_SESSION['mensaje'] . "</p>";
    unset($_SESSION['mensaje']);
}
?>
<form method="POST">
    <h2>Agregar Nueva Categoría</h2>
    Nombre de la Categoría: <input type="text" name="nombre_categoria" required>
    <button type="submit">Agregar</button>
</form>

<h2>Lista de Categorías</h2>
<ul>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
        <li><?= htmlspecialchars($fila['nombre']) ?></li>
    <?php endwhile; ?>
</ul>

</body>
</html>