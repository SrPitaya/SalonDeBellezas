<?php
 if (!empty($_POST["btnregistrar"])) {


    if (!empty($_POST["titulo"]) and !empty($_POST["descripcion"]) and !empty($_POST["inicio"]) and !empty($_POST["fin"]) and !empty($_POST["colortexto"]) and !empty($_POST["colorfondo"]) ) {
        $id=$_POST["id"];
        $titulo=$_POST["titulo"];
        $descripcion=$_POST["descripcion"];
        $inicio=$_POST["inicio"];
        $fin=$_POST["fin"];
        $colortexto=$_POST["colortexto"];
        $colorfondo=$_POST["colorfondo"];
        $nombre=$_POST["nombre"];

        $sql=$clientescrud -> query("update eventos set titulo='$titulo', descripcion= '$descripcion', inicio = '$inicio', fin='$fin', colortexto='$colortexto', colorfondo='$colorfondo' where id='$id' ");
        if ($sql==1) {
            header("location:clientes.php");
        }else{
            echo '<div class="alert alert-danger">' . $titulo . ' no modificado correctamente</div>';
        }

    }else{
        echo '<div class="alert alert-warning">Todos los campos deben ser completados</div>';
        }
    }
?>
