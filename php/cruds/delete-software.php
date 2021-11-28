<?php
    session_start();
    if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
        if($_SESSION['disponibilidad']==1){
        if(isset($_GET['id'])){
            $id_computadora=$_GET['id'];
        }
        if(isset($_GET['id2'])){
            $id_sw=$_GET['id2'];
        }
        include('../coneccion.php');
        $eliminar="DELETE FROM `sw_instalados` WHERE sw_instalados.id_computadora_f='$id_computadora' AND sw_instalados.id_software_f='$id_sw'";
        $delete=mysqli_query($coneccion, $eliminar);
        if($delete){
            header("Location: ../cruds/perfil-computadora.php?id=$id_computadora");
            die();
        }
        else{
            echo "ERROR DE ELIMINACIÓN DEL REGISTRO";
        }
        }
    }
?>