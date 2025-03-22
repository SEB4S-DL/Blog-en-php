<?php
session_start();
require_once '../db/db.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT id, nombre, apellidos, email, password FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        
        
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'], 
                'apellidos' => $usuario['apellidos'], 
                'email' => $usuario['email']
            ];
            header("Location: ../index.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "El usuario no existe.";
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
        .contenedorLogin {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .bloqueLogin {
            width: 90%;
            max-width: 400px;
            background: white;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="contenedorLogin">
        <div id="login" class="bloqueLogin">
            <h3>Inicia Sesión</h3>
            <?php if (!empty($mensaje)): ?>
                <div class="alerta alerta-error">
                    <?= $mensaje; ?>
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
