<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <title>Document</title>
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
</body>
</html>