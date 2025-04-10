<?php
require("conexionreg.php");
if (!empty($_SESSION["idclientes"])) {
    header("location: clientes.php");
}
if (isset($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $apodo = $_POST["apodo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $duplicate = mysqli_query($conn, "SELECT * FROM clientes where email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "taken email";
    } else {
        $query = "INSERT INTO clientes VALUES (' ','$nombre', '$apodo', '$edad', '$email', '$password')";
        mysqli_query($conn, $query);
        header("location: clientes.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - AleNails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap');

        body {
            background: #c89bb4;
            background: linear-gradient(to right, #fef8a8)
        }

        .bg {
            background-image: url(img/alenails.png);
            background-position: center center;
        }

        /* Cambia el color de fondo del checkbox */
        .custom-control-input:checked~.custom-control-label::before {
            background-color: mediumvioletred !important;
        }

        /* Cambia el color de la palomita */
        .custom-control-input:checked~.custom-control-label::after {
            background-color: white !important;
        }
    </style>
</head>

<body>

    <div class="container w-75 bg-primary my-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

            </div>
            <div class="col bg-white p-5 rounded-end">
                <div class="text-end">
                    <img src="img/maalobsoft.png" width="48" alt=" ">
                </div>
                <h2 class="fw-bold text-center pt-5 mb-5" style="font-family: 'Poetsen One', sans-serif; color: mediumvioletred;">Registrarse en AleNails</h2>
                <form action="" method="POST">
                    <div class="mb-4">
                        <label for="nombres" class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" name="edad" id="edad" class="form-control" min="18" max="105">
                    </div>
                    <div class="mb-4">
                        <label for="apodo" class="form-label">Apodo</label>
                        <input type="text" name="apodo" id="apodo" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <!-- Otros campos de registro que desees agregar -->

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="submit" style="background-color:mediumvioletred; border:mediumvioletred;">Registrarse</button>
                    </div>
                    <div class="my-3">
                        <span>¿Ya tienes cuenta? <a href="logger.php" style="color: mediumvioletred;">Inicia Sesión</a></span>
                    </div>
                </form>
                <!-- Otras opciones de registro, como registro con redes sociales, aquí -->
                <div class="container w-100 my-5">
                    <div class="row text-center">
                        <div class="col-12">Inicia sesión también con:</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-outline-primary w-100 my-1" onclick="redirectToFacebook()">
                                <div class="row align-items-center">
                                    <div class="col-2 d-none d-md-block">
                                        <img src="img/fb.png" alt="32" srcset="">
                                    </div>
                                    <div class="col-10 text-center">
                                        Facebook
                                    </div>
                                </div>
                            </button>
                            <script>
                                function redirectToFacebook() {
                                    window.location.href = "https://www.facebook.com/login"; // URL de inicio de sesión de Facebook
                                }
                            </script>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-danger w-100 my-1" onclick="redirectToGoogle()">
                                <div class="row align-items-center">
                                    <div class="col-2 d-none d-md-block">
                                        <img src="img/google.png" alt="32" srcset="">
                                    </div>
                                    <div class="col-10 text-center">
                                        Google
                                    </div>
                                </div>
                            </button>

                            <script>
                                function redirectToGoogle() {
                                    window.location.href = "https://accounts.google.com"; // Cambia esto por la URL de inicio de sesión de Google
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>