<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Blog de Múica</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    </head>
    <body>
        <!-- CABECERA -->
        <header id="cabecera">
            <!-- LOGO -->
            <div id="logo">
                <a href="index.php">
                    Blog de Música
                </a>
            </div>
            
            <!-- MENU -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="index.php">{Categorias}</a>
                    </li>
                </ul>

                <div id="buscador" class="bloqueBuscar">
                    <h3>Buscar</h3>
                    <form action="buscar.php" method="POST"> 
                        <input type="text" name="busqueda" />
                        <input type="submit" value="Buscar" />
                    </form>
                </div>
            </nav>
            
            <div class="clearfix"></div>
        </header>
        
        <div id="contenedor">
            <!-- BARRA LATERAL -->
            <aside id="sidebar">

                <div class="bloqueUsuario">
                    <a href="./auth/login.php">
                        <input type="submit" value="Iniciar Sesión">
                    </a>
                    <a href="./auth/register.php">
                        <input type="submit" name="submit" value="Registrarse" />
                    </a>
                    
                </div>
                
                <div id="usuario-logueado" class="bloque">
                    <h3>Bienvenido, {Nombre Usuario}</h3>
                    <a href="crear-entradas.php" class="boton boton-verde">{Crear entradas}</a>
                    <a href="crear-categoria.php" class="boton">{Crear categoria}</a>
                    <a href="mis-datos.php" class="boton boton-naranja">{Mis datos}</a>
                    <a href="cerrar.php" class="boton boton-rojo">{Cerrar sesión}</a>
                </div>
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
        
        <!-- PIE DE PÁGINA -->
        <footer id="pie">
            <p>Desarrollado por KCKS &copy; {Año actual}</p>
        </footer>
        
    </body>
</html>