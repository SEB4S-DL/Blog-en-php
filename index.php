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

    <?php include './includes/header.php'; ?> <!-- Se incluye el header dinámico -->

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
                    <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
                    <a href="./pages/categories.php" class="boton">Crear categoría</a>
                    <a href="./pages/myData.php" class="boton boton-naranja">Mis datos</a>
                    <a href="./auth/logout.php" class="boton boton-rojo">Cerrar sesión</a>
                </div>
            <?php endif; ?>

        </aside>
        
        <!-- CAJA PRINCIPAL -->
        <div id="principal">
            <h1>Últimas entradas</h1>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2>{Titulo Entrada}</h2>
                    <span class="fecha">{Categoria} | {Fecha de publicación}</span>
                    <p>
                        {Descripcion de entrada}
                    </p>
                </a>
            </article>
            
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2>{Titulo Entrada}</h2>
                    <span class="fecha">{Categoria} | {Fecha de publicación}</span>
                    <p>
                        {Descripcion de entrada}
                    </p>
                </a>
            </article>
            
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2>{Titulo Entrada}</h2>
                    <span class="fecha">{Categoria} | {Fecha de publicación}</span>
                    <p>
                        {Descripcion de entrada}
                    </p>
                </a>
            </article>
            
            <div id="ver-todas">
                <a href="entradas.php">Ver todas las entradas</a>
            </div>
        </div> <!--fin principal-->
        
    </div> <!-- fin contenedor -->
    
    ...
    </div> <!-- fin contenedor -->

    <?php include './includes/footer.php'; ?> <!-- Se incluye el footer -->

</body>
</html>

    
</body>
</html>
