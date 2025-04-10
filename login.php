<?php 
session_start(); 
include "conexion.php";

// Aquí llamamos a la función para obtener la conexión
$conexion = regresarConexion();

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: logger.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: logger.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM administradora WHERE user_name='$uname' AND password='$pass'";

        // Ahora $conexion está definida y se puede usar aquí
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['id'] = $row['id'];
                header("Location: index.php");
                exit();
            } else {
                header("Location: logger.php?error=Usuario o contraseña incorrecta");
                exit();
            }
        } else {
            header("Location: logger.php?error=Usuario o contraseña incorrecta");
            exit();
        }
    }
} else {
    header("Location: logger.php");
    exit();
}
?>
