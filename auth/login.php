<?php
session_start();
require '../db/db.php'; 

$error = ""; // Variable para almacenar errores

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Consultar usuario en la base de datos
        $stmt = $conexion->prepare("SELECT id, email, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email); // 's' indica que es un string
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && password_verify($password, $usuario['password'])) {
            // Inicio de sesión exitoso
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header("Location: ../index.php"); // Redirige al index
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    } else {
        $error = "Todos los campos son obligatorios";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <title>Blog de Música</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .alerta-error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <div id="login" class="bloque">
            <h3>Inicia Sesión</h3>
            
            <!-- Mostrar error si existe -->
            <?php if (!empty($error)): ?>
                <div class="alerta alerta-error">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" required />
                <label for="password">Contraseña</label>
                <input type="password" name="password" required />
                <input type="submit" value="Entrar" />
            </form>
        </div>
    </div>
</body>

</html>
