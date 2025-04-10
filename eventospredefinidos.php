<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Administracion de Eventos Predefinidos</title>

  <!-- Scripts CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/datatables.min.css">
  <link rel="stylesheet" href="css/bootstrap-clockpicker.css">

  <!-- Scripts JS -->
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/datatables.min.js"></script>
  <script src="js/bootstrap-clockpicker.js"></script>
  <script src="js/moment-with-locales.js"></script>

</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 style="text-align:center"> Administracion de eventos predefinidos </h2>
        <table id="tabla1">
          <thead>
            <tr>
              <td>Evento</td>
              <td>Titulo</td>
              <td>Color de texto</td>
              <td>Color de fondo</td>
              <td>Hora de inicio</td>
              <td>Hora de fin</td>
              <td>Borrar</td>
            </tr>
          </thead>
        </table>

        <div style="text-align:center">
          <button type="button" id="BotonAgregar" class="btn btn-success"> Agregar Evento Predefinido</button>
          <button type="button" id="BotonSalir" class="btn btn-success">Regresar al Calendario</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Formulario para agragar eventos predefinidos -->
  <div class="modal fade" id="FormularioEventosPredefinidos" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
            <span aria-hidden="true">x</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-row">
            <div class="form-group col-12">
              <label>Evento Predefinido:</label>
              <input type="text" id="Titulo" name="Titulo" class="form-control" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label>Color de fondo:</label>
            <input type="color" value="#3788D8" id="ColorFondo" class="form-control" style="height:36px">
          </div>
          <div class="form-group">
            <label>Color de texto:</label>
            <input type="color" value="#FFFFFF" id="ColorTexto" class="form-control" style="height:36px">
          </div>
          <div class="form-group">
            <label>Hora de Inicio:</label>
            <div class="input-group" data-autoclose="true">
              <input type="time" id="HoraInicio" class="form-control" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label>Hora de Fin:</label>
            <div class="input-group" data-autoclose="true">
              <input type="time" id="HoraFin" class="form-control" autocomplete="off">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" id="BotonConfirmarAgregar" class="btn btn-success">Confirmar</button>
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
        </div>

  
      </div>
    </div>
  </div>

  <script>

    document.addEventListener('DOMContentLoaded', function () {

      $('.clockpicker').clockpicker();

      let tabla1 = $('#tabla1').DataTable({
        "ajax": {
          url: 'datoseventospredefinidos.php?accion=listar',
          dataSrc: ""
        },
        "columns": [{
          "data": "id"
        },
        {
          "data": "titulo"
        },
        {
          "data": "colortexto"
        },
        {
          "data": "colorfondo"
        },
        {
          "data": "horainicio"
        },
        {
          "data": "horafin"
        },
        {
          "data": null,
          "orderable": false
        }
        ],
        columnDefs: [{
          targets: -1,
          className: 'dt-body-center',
          "defaultContent": "<button class='btn btn-sm btn-danger botonborrar'> Borrar </button>",
          data: null
        },
        {
          targets: 1,
          className: 'dt-body-center'
        },
        {
          targets: 2,
          className: 'dt-body-center'
        }],
        'rowCallback': function (row, data, index) {
          $(row).find('td:eq(1)').css('color', data.colortexto);
          $(row).find('td:eq(1)').css('background-color', data.colorfondo);
        },
        "languaje": {
          "url": "datatables/spanish.json"
        },
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"]

        ],
      });

      $('#tabla1 tbody').on('click', 'button.botonborrar', function () {
        if (confirm("¿Seguro que quieres eliminar este evento?")) {
          let registro = tabla1.row($(this).parents('tr')).data();
          borrarRegistro(registro);
        }
      });

      //Eventos de botones de la aplicacion

      $('#BotonAgregar').click(function () {
        $('#FormularioEventosPredefinidos').modal('show');
      });

      $('#BotonConfirmarAgregar').click(function () {
        let registro = recuperarDatosFormulario();
        agregarRegistro(registro);
        $('#FormularioEventosPredefinidos').modal('hide');
      });

      $('#BotonSalir').click(function () {
        window.location = "index.php";
      });

      //funciones para comunicarse con el server via AJAX
      function agregarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventospredefinidos.php?accion=agregar',
          data: registro,
          success: function (msg) {
            tabla1.ajax.reload();
          },
          error: function (error) {
            alert("Hubo un error al agregar el evento: " + error);
          }
        });
      }

      function borrarRegistro(registro) {
        $.ajax({
          type: 'POST',
          url: 'datoseventospredefinidos.php?accion=borrar',
          data: registro,
          success: function (msg) {
            tabla1.ajax.reload();
          },
          error: function (error) {
            alert("Hubo un error al borrar el evento: " + error);
          }
        });
      }

      //funciones para el formulario de eventos
      function limpiarFormulario() {
        $('#Titulo').val(' ');
        $('#HoraInicio').val(' ');
        $('#HoraFin').val(' ');
        $('#ColorFondo').val(' ');
        $('#ColorTexto').val(' ');
      }

      function recuperarDatosFormulario() {
        let registro = {
          titulo: $('#Titulo').val(),
          horainicio: $('#HoraInicio').val(),
          horafin: $('#HoraFin').val(),
          colorfondo: $('#ColorFondo').val(),
          colortexto: $('#ColorTexto').val()
        };
        return registro;
      }


    });

  </script>

</body>

</html>
<?php
} else {
  header("Location: logger.php");
  exit();
}
?>