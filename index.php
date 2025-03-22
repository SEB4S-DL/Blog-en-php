<?php
session_start();
require_once './db/db.php';
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Blog de Música</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div id="contenedor">
        <!-- BARRA LATERAL -->
        <aside id="sidebar">
            
            <?php if (!isset($_SESSION['usuario'])): ?>
                <!-- Mostrar si NO está autenticado -->
                <div class="bloqueUsuario">
                    <a href="./auth/login.php">
                        <input type="submit" value="Iniciar Sesión">
                    </a>
                    <a href="./auth/register.php">
                        <input type="submit" name="submit" value="Registrarse" />
                    </a>
                </div>
            <?php else: ?>
                <!-- Mostrar si está autenticado -->
                <div id="usuario-logueado" class="bloque">
                    <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos']; ?></h3>

                    <a href="./pages/entries.php" class="boton boton-verde">Crear entradas</a>
                    <a href="./pages/categories.php" class="boton">Crear categoría</a>
                    <a href="./pages/myData.php" class="boton boton-naranja">Mis datos</a>

                    <a href="./auth/logout.php" class="boton boton-rojo">Cerrar sesión</a>
                </div>
            <?php endif; ?>

        </aside>
        
        <!-- CAJA PRINCIPAL -->

        <!-- CAJA PRINCIPAL -->
        <?php
            require_once './db/db.php';

            // Consulta para obtener las entradas
            $sql = "SELECT id, titulo, descripcion, categoria_id, fecha FROM entradas ORDER BY fecha DESC LIMIT 3";
            $resultado = mysqli_query($conexion, $sql);

            // Verificar si hay resultados
            // Consulta para obtener las entradas con el nombre del autor
            $sql = "SELECT e.id, e.titulo, e.descripcion, e.fecha, u.nombre AS autor 
            FROM entradas e 
            JOIN usuarios u ON e.usuario_id = u.id 
            ORDER BY e.fecha DESC 
            LIMIT 3";

            $resultado = mysqli_query($conexion, $sql);

            $entradas = [];
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                $entradas[] = $fila;
                }
            }
        ?>
        <div id="principal">
            <h1>Últimas entradas</h1>

            <?php if (!empty($entradas)): ?>
                <?php foreach ($entradas as $entrada): ?>
                    <article class="entrada">
                        <a href="entrada.php?id=<?= $entrada['id'] ?>">
                            <h2><?= htmlspecialchars($entrada['titulo']) ?></h2>
                            <span class="fecha">
                                <?= htmlspecialchars($entrada['autor']) ?> | 
                                <?= htmlspecialchars($entrada['fecha']) ?>
                            </span>
                            <p>
                                <?= htmlspecialchars(substr($entrada['descripcion'], 0, 200)) ?>...
                                <a href="pages/verEntrada.php?id=<?= $entrada['id'] ?>">Leer más</a>
                            </p>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay entradas disponibles.</p>
            <?php endif; ?>

            <div id="ver-todas">
                <a href="pages/entradas.php">Ver todas las entradas</a>
            </div>

        </div> <!-- fin principal -->
    </div> <!-- fin contenedor -->
    
    <?php include 'includes/footer.php'; ?>
    
</body>
</html>
