<?php
require_once './db/db.php';

// Obtener categorías
$sql = "SELECT id, nombre FROM categorias";
$resultado = $conexion->query($sql);
?>

<header id="cabecera">
    <!-- LOGO -->
    <div id="logo">
        <a href="index.php">Blog de Música</a>
    </div>

    <!-- MENU -->
    <nav id="menu">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php while ($categoria = $resultado->fetch_assoc()): ?>
                <li>
                    <a href="categoria.php?id=<?= $categoria['id'] ?>">
                        <?= htmlspecialchars($categoria['nombre']) ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </nav>
</header>
