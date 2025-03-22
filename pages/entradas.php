<?php
require_once '../db/db.php';
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Todas las Entradas</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div id="contenedor">
        <div id="principal">
            <h1>Todas las entradas</h1>

            <?php
            session_start(); 
            require_once '../db/db.php';
            // Consulta para obtener todas las entradas
            $sql = "SELECT id, titulo, descripcion, categoria_id, fecha FROM entradas ORDER BY fecha DESC";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado && mysqli_num_rows($resultado) > 0):
                while ($entrada = mysqli_fetch_assoc($resultado)): ?>
                    <article class="entrada">
                        <a href="entrada.php?id=<?= $entrada['id'] ?>">
                            <h2><?= htmlspecialchars($entrada['titulo']) ?></h2>
                            <span class="fecha"><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?> | 
                            <?= htmlspecialchars($entrada['fecha']) ?></span>
                            <p>
                                <?= htmlspecialchars(substr($entrada['descripcion'], 0, 150)) ?>...
                            </p>
                            <span class="leer-mas"><a href="verEntrada.php?id=<?= $entrada['id'] ?>">Leer más</a>
                        </a>
                    </article>
                <?php endwhile;
            else: ?>
                <p>No hay entradas disponibles.</p>
            <?php endif; ?>
        </div> <!-- fin principal -->
    </div> <!-- fin contenedor -->

    <?php include '../includes/footer.php'; ?>

</body>
</html>
