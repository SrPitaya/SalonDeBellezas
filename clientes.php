<?php
require 'conexionreg.php';
if (!empty($_SESSION["idclientes"])) {
  $idclientes = $_SESSION["idclientes"];
  $result = mysqli_query($conn, "SELECT * FROM clientes WHERE idclientes = $idclientes");
  $row = mysqli_fetch_assoc($result);
  if ($row) {
    $nombreCliente = $row["nombre"];
  } else {
    // Manejar el caso en que no se encuentre ningún cliente
    $nombreCliente = "Nombre no encontrado";
  }
} else {
  header("location: logger.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
  <script src="https://kit.fontawesome.com/81cb7f883b.js" crossorigin="anonymous"></script>


</head>

<body>
  <script>
    function eliminar() {
      var respuesta = confirm("Estas seguro de querer eliminar el registro?");
      return respuesta;
    }
  </script>

  <form class="col" action="procesarcita.php" method="POST">
    <h2 class="text-center p-3">Citas de <?php echo $nombreCliente; ?></h2>
    <div class="mb-3">
      <label for="exampleInputClavecliente" class="form-label">Titulo de cita:</label>
      <select class="form-control" name="titulo">
        <option><---></option>
        <optgroup label="Manicure">
          <option title="Incluye limado y dar forma a las uñas, recorte de cutículas, esmaltado y aplicación de brillo.">Manicure Básico</option>
          <option title="Incluye limado y dar forma a las uñas, recorte de cutículas, exfoliación, mascarilla hidratante, masaje y esmaltado con aplicación de brillo.">Manicure de Lujo</option>
          <option title="Estilo clásico que consiste en esmaltar las uñas con una base transparente y pintar las puntas de las uñas de blanco, seguido de una capa de brillo.">Manicure Francesa</option>
          <option title="Manicure personalizado para ocasiones especiales como bodas, fiestas de cumpleaños, graduaciones, etc.">Manicure para Eventos Especiales</option>
        </optgroup>
        <optgroup label="Pedicure">
          <option title="Remojo de pies, eliminación de callosidades, limado y dar forma a las uñas de los pies, recorte de cutículas, masaje y esmaltado con aplicación de brillo.">Pedicure Básico</option>
          <option title="Remojo de pies, eliminación de callosidades, limado y dar forma a las uñas de los pies, recorte de cutículas, exfoliación, mascarilla hidratante, masaje y esmaltado con aplicación de brillo.">Pedicure de Lujo</option>
          <option title="Pedicure personalizado para eventos especiales como bodas, fiestas de cumpleaños, graduaciones, etc.">Pedicure para Eventos Especiales</option>
        </optgroup>
        <optgroup label="Uñas acrílicas">
          <option title="Aplicación de uñas acrílicas para un acabado duradero y resistente.">Uñas Acrílicas</option>
          <option title="Relleno de uñas acrílicas para mantener su apariencia fresca y duradera.">Relleno de Uñas Acrílicas</option>
          <option title="Remoción segura y profesional de uñas acrílicas.">Remoción de Uñas Acrílicas</option>
        </optgroup>
        <optgroup label="Decoraciones no acrílicas">
          <option title="Decoraciones naturales de uñas, como flores, rayas, puntos, etc., utilizando esmalte de diferentes colores o técnicas.">Decoraciones Naturales</option>
          <option title="Decoraciones de uñas para eventos especiales como bodas, fiestas de cumpleaños, graduaciones, etc.">Decoraciones para Eventos Especiales</option>
        </optgroup>
      </select>
    </div>

    <div class="mb-3">
      <label for="exampleInputServicio" class="form-label">Ubicación:</label>
      <input type="text" class="form-control" name="descripcion">
    </div>
    <div class="mb-3">
      <label for="exampleInputDate" class="form-label">Fecha de Inicio:</label>
      <input type="datetime-local" class="form-control" name="inicio">
    </div>
    <div class="mb-3">
      <label for="exampleInputDate" class="form-label">Fecha de Fin:</label>
      <input type="datetime-local" class="form-control" name="fin">
    </div>
    <div class="mb-3" style="display: none;">
      <label for="exampleInputDate" class="form-label">Color de texto</label>
      <input type="color" class="form-control" name="colortexto" id="colortexto" readonly>
    </div>
    <div class="mb-3" style="display: none;">
      <label for="exampleInputDate" class="form-label">Color de fondo</label>
      <input type="color" class="form-control" name="colorfondo" id="colorfondo" readonly>
    </div>
    <div class="mb-3">
      <label for="exampleInputDueño" class="form-label">Dueño de la cita</label>
      <input type="text" class="form-control" name="nombre" value="<?php echo $nombreCliente; ?>">
    </div>

    <script>
      // Función para generar un color aleatorio hexadecimal
      function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
      }

      // Obtener elementos de input de color
      var colorTextoInput = document.getElementById('colortexto');
      var colorFondoInput = document.getElementById('colorfondo');

      // Generar colores aleatorios
      var randomColorTexto = getRandomColor();
      var randomColorFondo = getRandomColor();

      // Asignar colores aleatorios a los inputs de color
      colorTextoInput.value = randomColorTexto;
      colorFondoInput.value = randomColorFondo;
    </script>

    <div class="mb-3 text-center">
      <button type="submit" class="btn btn-primary class=" btn btn-danger" style="background-color: mediumvioletred; border-color: mediumvioletred; font-family: Poetsen One, sans-serif" name="btnregistrar" value="ok">Agendar cita</button>
    </div>
  </form>
  <div>
    <h3>Listado de clientes</h3>
    <?php
    include "clientescrud.php";
    include("eliminar_clientes.php");
    ?>
    <table class="table">
      <thead class="bg-info">
        <tr>
          <th scope="col">Titulo de cita</th>
          <th scope="col">Ubicación</th>
          <th scope="col">Inicio de cita</th>
          <th scope="col">Fin de cita</th>
          <th scope="col">Dueño de cita</th>
          <th scope="col">Eliminar o Editar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "clientescrud.php";
        // Consulta SQL modificada para filtrar solo eventos del cliente actual
        $sql = $clientescrud->query("SELECT * FROM eventos WHERE nombre = '$nombreCliente'");
        while ($datos = $sql->fetch_object()) { ?>
          <tr>
            <td> <?= $datos->titulo ?> </td>
            <td> <?= $datos->descripcion ?> </td>
            <td><?= $datos->inicio ?></td>
            <td><?= $datos->fin ?></td>
            <td><?= $datos->nombre ?></td>
            <td>
              <a href="modificar_clientes.php?id=<?= $datos->id ?>"><i class="fa-solid fa-pen-to-square fa-bounce" style="color: #000000;"></i></a>
              <a onclick="return eliminar()" href="clientes.php?id=<?= $datos->id ?>"><i class="fa-solid fa-eraser fa-bounce" style="color: #000000;"></i></a>
              <!--<a onclick="return genpdf()"><i class="fa-solid fa-file-pdf fa-bounce" style="color: #000000;"></i></a>-->
            </td>
          </tr>
        <?php }
        ?>
      </tbody>
    </table>
  </div>
  <div style="text-align: center; margin-top: 20px;">
    <a href="logout.php" class="btn btn-danger" style="background-color: mediumvioletred; border-color: mediumvioletred; font-family: Poetsen One, sans-serif">Cerrar
      sesión</a>
  </div>
</body>

</html>