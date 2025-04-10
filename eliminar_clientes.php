<?php
 if (!empty($_GET["id"])){ 
    $id=$_GET["id"];
    $sql=$clientescrud -> query("delete from eventos where id=$id");
        if ($sql==1) {
            echo '<div class="alert alert-success">Evento eliminado correctamente</div>';
        }else{
            echo '<div class="alert alert-danger">Evento no eliminado correctamente</div>';
        }
    }
?>