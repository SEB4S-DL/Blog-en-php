<?php
session_start();
require_once '../db/db.php'; // Archivo con la conexión a la base de datos

$usuario_id = $_SESSION['usuario_id'] ?? 1;

// Obtener datos del usuario
$sql = "SELECT nombre, email FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($nombre, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_nombre = $_POST["nombre"];
    $nuevo_email = $_POST["email"];
    $actual_pass = $_POST["actual_pass"];
    $nueva_pass = $_POST["nueva_pass"];

    // Actualizar nombre y email
    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nuevo_nombre, $nuevo_email, $usuario_id);
    $stmt->execute();
    $stmt->close();

    // Si se quiere cambiar la contraseña
    if (!empty($actual_pass) && !empty($nueva_pass)) {
        $sql = "SELECT password FROM usuarios WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->bind_result($contraseña_actual);
        $stmt->fetch();
        $stmt->close();

        // Verificar contraseña actual
        if (password_verify($actual_pass, $contraseña_actual)) {
            $nueva_pass_hash = password_hash($nueva_pass, PASSWORD_BCRYPT);
            $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nueva_pass_hash, $usuario_id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Contraseña actual incorrecta.</p>";
            exit;
        }
    }

    echo "<p style='color: green;'>Datos actualizados correctamente. Serás redirigido en 3 segundos...</p>";
    echo '<meta http-equiv="refresh" content="3;url=../index.php">';
    echo '<script>
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 3000);
          </script>';
    exit;
}
?>

<form method="POST">
    Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>
    
    <h3>Cambiar Contraseña (Opcional)</h3>
    Contraseña Actual: <input type="password" name="actual_pass"><br>
    Nueva Contraseña: <input type="password" name="nueva_pass"><br>

    <button type="submit">Actualizar</button>
</form>