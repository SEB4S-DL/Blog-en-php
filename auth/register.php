<?php
require '../db/db.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $fecha = date("Y-m-d");

    if (empty($nombre) || empty($apellidos) || empty($email) || empty($password)) {
        $mensaje = "<div class='alerta alerta-error'>Todos los campos son obligatorios</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "<div class='alerta alerta-error'>El email no es válido</div>";
    } else {
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $mensaje = "<div class='alerta alerta-error'>El email ya está registrado</div>";
        } else {
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, fecha) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nombre, $apellidos, $email, $passwordHashed, $fecha);

            if ($stmt->execute()) {
                $mensaje = "<div class='alerta alerta-exito'>Se registró correctamente. <a href='login.php'>Iniciar sesión</a></div>";
            } else {
                $mensaje = "<div class='alerta alerta-error'>Error al registrar usuario</div>";
            }
        }

        $stmt->close();
    }
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <title>Blog de Música</title>
</head>

<body>
    <div class="contenedor">

        <div id="register" class="bloque">
            <h3>Registrarse</h3>

            <?= $mensaje; ?>

            <form action="register.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required />

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" required />

                <label for="email">Email</label>
                <input type="email" name="email" required />

                <label for="password">Contraseña</label>
                <input type="password" name="password" required />

                <input type="submit" name="submit" value="Registrar" />
            </form>
        </div>

    </div>
</body>

</html>
