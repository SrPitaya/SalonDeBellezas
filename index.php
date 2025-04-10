<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap');

      :root {
        /* Estilo fiusha */
        --fc-button-text-color: #fff;
        --fc-button-bg-color: #FF007F;
        /* Fiusha */
        --fc-button-border-color: #FF007F;
        /* Fiusha */

        /* Estilo rosa */
        --fc-button-hover-bg-color: #FF69B4;
        /* Rosa */
        --fc-button-hover-border-color: #FF69B4;
        /* Rosa */

        /* Tonos pastel */
        --fc-button-active-bg-color: #F0A6CA;
        /* Rosa pastel */
        --fc-button-active-border-color: #FFCCCC;
        /* Rosa pastel */
      }

      .fc-daygrid.fc-dayGridMonth-view.fc-view .fc-day {
        border-width: 3px;
      }

      .fc-timegrid.fc-timeGridWeek-view.fc-view .fc-day {
        border-width: 3px;
      }

      .fc-dayGridMonth-button.fc-button.fc-button-primary {
        font-family: 'Poetsen One', sans-serif;
      }

      .fc-timeGridWeek-button.fc-button.fc-button-primary {
        font-family: 'Poetsen One', sans-serif;
      }

      .fc-timeGridDay-button.fc-button.fc-button-primary {
        font-family: 'Poetsen One', sans-serif;
      }

      .fc-today-button.fc-button.fc-button-primary {
        font-family: 'Poetsen One', sans-serif;
      }

      .fc-toolbar-title {
        color: black;
        text-align: center;
        display: block;
        font-family: "Poetsen One", sans-serif;
        text-transform: capitalize;
        font-size: 24px;
      }

      .fc-col-header-cell-cushion {
        color: black;
        text-align: center;
        display: block;
        text-decoration: none;
        font-family: "Poetsen One", sans-serif;
        text-transform: capitalize;
        font-size: 20px;
        letter-spacing: 0.5px;
      }

      .fc-col-header-cell-cushion:hover {
        color: pink;
      }

      .fc-daygrid-day-number {
        color: black;
        text-align: center;
        display: block;
        text-decoration: none;
        font-family: "Poetsen One", sans-serif;
        text-transform: capitalize;
      }


      .fc-daygrid-day-number:hover {
        color: pink;
      }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Eventos</title>

    <!-- Scripts CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="fullcalendar/main.css">

    <!-- Scripts JS -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/bootstrap-clockpicker.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="fullcalendar/main.js"></script>
    <script src="fullcalendar/locales/es.js"></script>


  </head>

  <body>

    <div class="container-fluid">
      <section class="content-header">
        <h1 style="font-size: 60px; color: black;">
          <center><small style="font-family: Poetsen One, sans-serif; color: mediumvioletred"> Calendario AleNails</small></center>
        </h1>
      </section>

      <div class="row">
        <div class="col-10">
          <div id="Calendario1" style="border: 3px solid #000; padding:2px; border-radius: 10px ;border-color: mediumvioletred"></div>
        </div>
        <div class="col-2">
          <div id="external-events" style="margin-bottom:1em; height:350px; border: 3px solid #000; overflow: auto; padding:1em; border-radius: 10px;border-color: mediumvioletred">
            <h4 class="text-center" style="font-family: Poetsen One, sans-serif">Eventos predefinidos</h4>
            <div id="listaeventospredefinidos">
              <?php

              require("conexion.php");
              $conexion = regresarConexion();

              $datos = mysqli_query($conexion, "SELECT id,titulo,horainicio,horafin,colortexto,colorfondo FROM eventospredefinidos");
              $ep = mysqli_fetch_all($datos, MYSQLI_ASSOC);

              foreach ($ep as $fila) {
                echo "<button class='btn btn-dark fc-event' data-titulo='$fila[titulo]' data-horafin='$fila[horafin]' data-horainicio='$fila[horainicio]' data-colorfondo='$fila[colorfondo]' data-colortexto='$fila[colortexto]' 
                      style='border-color:$fila[colorfondo];color:$fila[colortexto];background-color:$fila[colorfondo];margin:10px'>
                      $fila[titulo] [" . substr($fila['horainicio'], 0, 5) . " a " . substr($fila['horafin'], 0, 5) . "]</button>";
              }


              ?>

            </div>
          </div>
          <hr>
          <div class="" style="text-align:center">
            <button style="background-color:mediumvioletred; border-color:mediumvioletred;font-family: Poetsen One, sans-serif" type="button" id="BotonEventosPredefinidos" class="btn btn-success">
              Administrar eventos predefinidos
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario de Eventos -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close" style="text-align: left" ;>
            </button>
          </div>

          <div class="modal-body">
            <input type="hidden" id="Id">
            <div class="form-row">
              <div class="form-group col-12">
                <label>Titulo de cita:</label>
                <div class="input-group" data-autoclose="true">
                  <input type="text" id="Titulo" value="" class="form-control">
                </div>
                <select id="optionsSelect" class="form-control mt-2">
                  <option selected disabled>Selecciona una opción predeterminada</option>
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
            </div>

            <script>
              document.getElementById("optionsSelect").addEventListener("change", function() {
                var selectedOption = this.value;
                document.getElementById("Titulo").value = selectedOption;
              });
            </script>


            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Fecha de inicio:</label>
                <div class="input-group" data-autoclose="true">
                  <input type="date" id="FechaInicio" value="" class="form-control">
                </div>
              </div>
              <div class="form-group col-md-6" id="TituloHoraInicio">
                <label>Hora de inicio:</label>
                <div class="input-group" data-autoclose="true">
                  <input type="time" id="HoraInicio" value="" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="">Fecha de fin:</label>
                <div class="input-group" data-autoclose="true">
                  <input type="date" id="FechaFin" class="form-control" value="">
                </div>
              </div>
              <div class="form-group col-md-6" id="TituloHoraFin">
                <label for="">Hora de fin:</label>
                <div class="input-group " data-autoclose="true">
                  <input type="time" id="HoraFin" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="form-row">
              <label for="">Ubicación:</label>
              <textarea id="Descripcion" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-row">
              <label for="">Color de fondo:</label>
              <input type="color" value="#3788D8" id="ColorFondo" class="form-control" style="height:36px;">
            </div>
            <div class="form-row">
              <label for="">Color de texto:</label>
              <input type="color" value="#ffffff" id="ColorTexto" class="form-control" style="height:36px;">
            </div>
            <div class="form-row">
              <select id="nombre" class="form-control">
                <option selected disabled>Selecciona un cliente</option>
                <?php
                // Incluir el archivo de conexión
                require("clientescrud.php");

                // Consulta para obtener los clientes
                $sql = "SELECT idclientes, nombre FROM clientes";
                $resultado = $clientescrud->query($sql);

                // Imprimir opciones para cada cliente
                while ($fila = $resultado->fetch_assoc()) {
                  echo "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
                }

                // Cerrar conexión
                $clientescrud->close();
                ?>
              </select>
            </div>




          </div>

          <div class="modal-footer">
            <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
            <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
            <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
          </div>

        </div>
      </div>

    </div>


    <script>
      document.addEventListener("DOMContentLoaded", function() {

        new FullCalendar.Draggable(document.getElementById('listaeventospredefinidos'), {
          itemSelector: '.fc-event',
          eventData: function(eventEl) {
            return {
              title: eventEl.innerText.trim()
            }
          }
        });

        $('.clockpicker').clockpicker();

        let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'), {
          locale: 'es',
          droppable: true,
          height: 850,
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
          },
          editable: true,
          customButtons: {
            custom1: {
              text: 'custom1',
              click: function() {
                alert('Click');
              }
            }
          },
          events: 'datoseventos.php?accion=listar',
          dateClick: function(info) {
            limpiarFormulario();
            $('#BotonAgregar').show();
            $('#BotonModificar').hide();
            $('#BotonBorrar').hide();

            if (info.allDay) {
              $('#FechaInicio').val(info.dateStr);
              $('#FechaFin').val(info.dateStr);
            } else {
              let fechaHora = info.dateStr.split("T");
              $('#FechaInicio').val(fechaHora[0]);
              $('#FechaFin').val(fechaHora[0]);
              $('#HoraInicio').val(fechaHora[1].substring(0, 5));
            }
            $("#FormularioEventos").modal('show');
          },
          eventClick: function(info) {
            $('#BotonAgregar').hide();
            $('#BotonModificar').show();
            $('#BotonBorrar').show();
            $('#Id').val(info.event.id);
            $('#Titulo').val(info.event.title);
            $('#Descripcion').val(info.event.extendedProps.descripcion);
            $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
            $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
            $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
            $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
            $('#ColorFondo').val(info.event.backgroundColor);
            $('#ColorTexto').val(info.event.textColor);
            $('#nombre').val(info.event.extendedProps.nombre);
            $("#FormularioEventos").modal('show');
          },
          eventResize: function(info) {
            $('#Id').val(info.event.id);
            $('#Titulo').val(info.event.title);
            $('#Descripcion').val(info.event.extendedProps.descripcion);
            $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
            $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
            $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
            $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
            $('#ColorFondo').val(info.event.backgroundColor);
            $('#ColorTexto').val(info.event.textColor);
            $('#nombre').val(info.event.extendedProps.nombre);
            let registro = recuperarDatosFormulario();
            modificarRegistro(registro);
          },
          eventDrop: function(info) {
            $('#Id').val(info.event.id);
            $('#Titulo').val(info.event.title);
            $('#Descripcion').val(info.event.extendedProps.descripcion);
            $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
            $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
            $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
            $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
            $('#ColorFondo').val(info.event.backgroundColor);
            $('#ColorTexto').val(info.event.textColor);
            $('#nombre').val(info.event.extendedProps.nombre);
            let registro = recuperarDatosFormulario();
            modificarRegistro(registro);
          },
          drop: function(info) {
            limpiarFormulario();
            $('#ColorFondo').val(info.draggedEl.dataset.colorfondo);
            $('#ColorTexto').val(info.draggedEl.dataset.colortexto);
            $('#Titulo').val(info.draggedEl.dataset.titulo);
            $('#nombre').val(info.draggedEl.dataset.nombre);
            let fechaHora = info.dateStr.split("T");
            $('#FechaInicio').val(fechaHora[0]);
            $('#FechaFin').val(fechaHora[0]);
            if (info.allDay) {
              $('#HoraInicio').val(info.draggedEl.dataset.horainicio);
              $('#HoraFin').val(info.draggedEl.dataset.horafin);
            } else {
              $('#HoraInicio').val(fechaHora[1].substring(0, 5));
              $('#HoraFin').val(moment(fechaHora[1].substring(0, 5)).add(1, 'hours'));
            }
            let registro = recuperarDatosFormulario();
            agregarEventoPredefinido(registro);
          }
        });

        calendario1.render();

        //Eventos de botones de la aplicacion
        $('#BotonAgregar').click(function() {
          let registro = recuperarDatosFormulario();
          agregarRegistro(registro);
          $('#FormularioEventos').modal('hide');
        });

        $('#BotonModificar').click(function() {
          let registro = recuperarDatosFormulario();
          modificarRegistro(registro);
          $('#FormularioEventos').modal('hide');
        });

        $('#BotonBorrar').click(function() {
          let registro = recuperarDatosFormulario();
          borrarRegistro(registro);
          $('#FormularioEventos').modal('hide');
        });

        $('#BotonEventosPredefinidos').click(function() {
          window.location = "eventospredefinidos.php";
        });


        //funciones para comunicarse con el servidor AJAX!
        function agregarRegistro(registro) {
          $.ajax({
            type: 'POST',
            url: 'datoseventos.php?accion=agregar',
            data: registro,
            success: function(msg) {
              calendario1.refetchEvents();
            },
            error: function(error) {
              alert("Hubo un error al agregar el evento: " + error);
            }
          });
        }

        function modificarRegistro(registro) {
          $.ajax({
            type: 'POST',
            url: 'datoseventos.php?accion=modificar',
            data: registro,
            success: function(msg) {
              calendario1.refetchEvents();
            },
            error: function(error) {
              alert("Hubo un error al modificar el evento: " + error);
            }
          });
        }

        function borrarRegistro(registro) {
          $.ajax({
            type: 'POST',
            url: 'datoseventos.php?accion=borrar',
            data: registro,
            success: function(msg) {
              calendario1.refetchEvents();
            },
            error: function(error) {
              alert("Hubo un error al borrar el evento: " + error);
            }
          });
        }

        function agregarEventoPredefinido(registro) {
          $.ajax({
            type: 'POST',
            url: 'datoseventos.php?accion=agregar',
            data: registro,
            success: function(msg) {
              calendario1.removeAllEvents();
              calendario1.refetchEvents();
            },
            error: function(error) {
              alert("Hubo un error al agregar evento ep: " + error);
            }
          });
        }


        //funciones que interactuan con el FormularioEventos

        function limpiarFormulario() {
          $('#Id').val('');
          $('#Titulo').val('');
          $('#Descripcion').val('');
          $('#FechaFin').val('');
          $('#FechaInicio').val('');
          $('#HoraInicio').val('');
          $('#HoraFin').val('');
          $('#ColorFondo').val('#3788D8');
          $('#ColorTexto').val('#ffffff');
          $('#nombre').val('');
        }

        function recuperarDatosFormulario() {
          let registro = {
            id: $('#Id').val(),
            titulo: $('#Titulo').val(),
            descripcion: $('#Descripcion').val(),
            inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),
            fin: $('#FechaFin').val() + ' ' + $('#HoraFin').val(),
            colorfondo: $('#ColorFondo').val(),
            colortexto: $('#ColorTexto').val(),
            nombre: $('#nombre').val()
          }
          return registro;
        }

      });
    </script>


  </body>
  <div style="text-align: center; margin-top: 20px;">
    <a href="logout.php" class="btn btn-danger" style="background-color: mediumvioletred; border-color: mediumvioletred; font-family: Poetsen One, sans-serif">Cerrar sesión</a>
  </div>

  </html>
<?php
} else {
  header("Location: logger.php");
  exit();
}
?>