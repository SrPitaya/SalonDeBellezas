<?php
require 'conexionreg.php';

$error_message = ""; // Variable para almacenar el mensaje de error

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM clientes WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $_SESSION["logger"] = true;
            $_SESSION["idclientes"] = $row["idclientes"];
            header("Location: clientes.php");
            exit; // Salir del script después de redireccionar
        } else {
            $error_message = "Contraseña incorrecta";
        }
    } else {
        $error_message = "Usuario no encontrado";
    }

    // Mostrar el modal de error
    echo '<script type="text/javascript">
            window.onload = function() {
                var myModal = new bootstrap.Modal(document.getElementById("errorModal"));
                myModal.show();
            };
          </script>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AleNails</title>
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
                <h2 class="fw-bold text-center pt-5 mb-5" style="font-family: 'Poetsen One', sans-serif; color: mediumvioletred;">Iniciar Sesión en AleNails</h2>
                <form action="" method="POST">
                    <div class="mb-4">
                        <label for="Email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="Password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="submit" id="submit" style="background-color:mediumvioletred; border:mediumvioletred;">Iniciar Sesión</button>
                        <h3> </h3>
                    </div>
                    <div class="my-3">
                        <span>¿No tienes cuenta? <a href="register.php" style="color: mediumvioletred;">Regístrate</a></span>
                    </div>
                </form>
                <!-- INICIAR SESIÓN CON REDES SOCIALES -->
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
                    <div class="col">
                        <button class="btn btn-outline-success w-100 my-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <div class="row align-items-center">
                                <div class="col-2 d-none d-md-block">
                                    <img src="img/cadmin.png" alt="32" srcset="">
                                </div>
                                <div class="col-10 text-center">
                                    Credenciales de Admministradora
                                </div>
                            </div>
                        </button>
                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel" style="background-color: mediumvioletred;">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel" style="font-family: 'Poetsen One', sans-serif; color: white;">Inicia sesión como Administradora</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
                                    <div class="card p-4" style="max-width: 400px; border: 2px solid white; border-radius: 10px; background-color: white;">
                                        <div class="text-center mb-4">
                                            <img src="img\nailpor.png" class="img-fluid" style="width: 150px; height: 150px;" alt="Imagen de perfil">
                                        </div>
                                        <form action="login.php" method="post">
                                            <?php
                                            if (isset($_GET['error'])) {
                                                echo '<p>Error: ' . htmlspecialchars($_GET['error']) . '</p>';
                                            }
                                            ?>
                                            <div class="mb-4">
                                                <label for="Email" class="form-label">Correo electrónico</label>
                                                <input type="email" name="uname" class="form-control" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="Password" class="form-label">Contraseña</label>
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                            <div class="mb-4 form-check">
                                                <input type="checkbox" class="form-check-input" id="rememberMe2">
                                                <label class="form-check-label" for="rememberMe">Recuérdame</label>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary" id="BotonLogin" style="background-color: mediumvioletred; border: mediumvioletred;">Iniciar Sesión</button>
                                            </div>
                                            <div class="my-3">
                                                <a href="register.php" style="color: mediumvioletred;">¿Perdiste tu contraseña o cuenta?</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <div class="modal" id="errorModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error de autenticación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $error_message; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>