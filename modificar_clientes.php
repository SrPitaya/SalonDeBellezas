<?php
include "clientescrud.php";
$id = $_GET["id"];
$sql = $clientescrud->query("select * from eventos where id= $id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Eventos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/81cb7f883b.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modificar Eventos</h4>
        </div>
        <div class="modal-body">
            <form class="col-12" method="POST">
                <!-- Your form content here -->
                <!-- Make sure to replace your existing form with this one -->
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>" <?php
                                                                            include "modificar_cliente1.php";
                                                                            while ($datos = $sql->fetch_object()) { ?> <div class="mb-3">
                <label for="exampleInputClavecliente" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?= $datos->titulo ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputServicio" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" value="<?= $datos->descripcion ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Fecha de inicio</label>
            <input type="datetime-local" class="form-control" name="inicio" value="<?= $datos->inicio ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Fecha de fin</label>
            <input type="datetime-local" class="form-control" name="fin" value="<?= $datos->fin ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Color del texto</label>
            <input type="color" class="form-control" name="colortexto" value="<?= $datos->colortexto ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Color de fondo</label>
            <input type="color" class="form-control" name="colorfondo" value="<?= $datos->colorfondo ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputDate" class="form-label">Dueño de la cita</label>
            <input type="nombre" class="form-control" name="colorfondo" value="<?= $datos->nombre ?>" disabled>
        </div>

    <?php } ?>
    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Modificar cliente</button>
    </div>
    </form>
    </div>
    </div>

    </div>
    </div>

</body>

</html>