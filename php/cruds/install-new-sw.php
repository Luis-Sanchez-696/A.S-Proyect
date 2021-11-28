<?php
    session_start();
    if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
        if($_session['disponibilidad']==1){
        if(isset($_REQUEST['enviar'])){
            include('../coneccion.php');
            if(isset($_GET['id'])){
                $id_computadora=$_GET['id'];
            }
            $id_sw_selected=$_REQUEST['sw-option'];
            $install=@mysqli_query($coneccion, "INSERT INTO `sw_instalados` (id_computadora_f, id_software_f) VALUES ('$id_computadora', '$id_sw_selected')");
            header("Location: ../cruds/perfil-computadora.php?id=$id_computadora");
            die();
        }
        }
    }
?>