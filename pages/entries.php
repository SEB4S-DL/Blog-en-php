<?php
session_start();
require_once '../db/db.php';

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario']['id'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'warning',
                title: 'Debes iniciar sesión',
                text: 'Debes iniciar sesión para crear una entrada.',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false, // Evita que se cierre al hacer clic afuera
                heightAuto: false, 
                customClass: { popup: 'small-alert', confirmButton: 'green-button' }
            }).then(() => {
                window.location.href = '../index.php';
            });
        });
    </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $categoria_id = isset($_POST['categoria']) ? (int) $_POST['categoria'] : 0;
    $usuario_id = $_SESSION['usuario']['id'];
    $fecha = date('Y-m-d');

    if (!empty($titulo) && !empty($descripcion) && $categoria_id) {
        $sql = "INSERT INTO entradas (usuario_id, categoria_id, titulo, descripcion, fecha) 
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("iisss", $usuario_id, $categoria_id, $titulo, $descripcion, $fecha);

            if ($stmt->execute()) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Entrada creada correctamente.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false,
                            heightAuto: false,
                            confirmButtonColor: '#28a745', 
                            customClass: { popup: 'small-alert', Button: 'green-button' }
                        }).then(() => {
                            window.location.href = '../index.php';
                        });
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al crear la entrada.',
                            confirmButtonText: 'Intentar de nuevo',
                            allowOutsideClick: false,
                            heightAuto: false, 
                            customClass: { popup: 'small-alert', confirmButton: 'green-button' }
                        });
                    });
                </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la preparación de la consulta.',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                        heightAuto: false, 
                        customClass: { popup: 'small-alert', confirmButton: 'green-button' }
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos incompletos',
                    text: 'Todos los campos son obligatorios.',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    heightAuto: false, 
                    customClass: { popup: 'small-alert', confirmButton: 'green-button' }
                });
            });
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style2.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <title>Crear Nueva Entrada</title>
</head>
<body>

    <form method="POST" action="entries.php">
        <h2>Crear Nueva Entrada</h2>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria" required>
            <?php
            $sql_categorias = "SELECT id, nombre FROM categorias";
            $resultado_categorias = mysqli_query($conexion, $sql_categorias);

            while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                echo "<option value='" . $categoria['id'] . "'>" . htmlspecialchars($categoria['nombre']) . "</option>";
            }
            ?>
        </select>

        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="5" required></textarea>

        <button type="submit">Publicar</button>
    </form>

    <!-- Script para ejecutar SweetAlert2 -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?= $mensaje ?>  
        });
    </script>

</body>
</html>
