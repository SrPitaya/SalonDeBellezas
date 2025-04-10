<?php
session_start(); // Iniciar sesión para poder usar $_SESSION

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario está logueado
    if (!empty($_SESSION["idclientes"])) {
        // Obtener los datos del formulario
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $inicio = $_POST["inicio"];
        $fin = $_POST["fin"];
        $colortexto = $_POST["colortexto"];
        $colorfondo = $_POST["colorfondo"];
        $nombre = $_POST["nombre"];

        // Validar los datos (aquí deberías agregar tus propias validaciones)

        // Incluir el archivo de conexión a la base de datos
        require_once 'conexionreg.php';

        // Preparar la consulta SQL para insertar la cita
        $query = "INSERT INTO eventos (titulo, descripcion, inicio, fin, colortexto, colorfondo, nombre) VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la sentencia
        $stmt = mysqli_prepare($conn, $query);

        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "sssssss", $titulo, $descripcion, $inicio, $fin, $colortexto, $colorfondo, $nombre);

        // Ejecutar la sentencia
        if (mysqli_stmt_execute($stmt)) {
            // Cita agregada exitosamente
            echo "Cita agregada exitosamente.";
            // Redirigir al usuario a la página de citas
            header("location: clientes.php");
            exit();
        } else {
            // Error al ejecutar la sentencia
            echo "Error al agregar la cita: " . mysqli_error($conn);
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
        // Cerrar la conexión
        mysqli_close($conn);
    } else {
        // El usuario no está logueado, redirigirlo a la página de inicio de sesión
        header("location: logger.php");
        exit();
    }
} else {
    // Si se intenta acceder al script sin enviar el formulario, redirigir a la página de inicio
    header("location: index.php");
    exit();
}
?>
