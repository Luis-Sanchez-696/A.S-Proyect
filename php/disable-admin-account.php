<?php
    session_start();
    if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
        if($_SESSION['disponibilidad']==1){
        if(isset($_GET['id'])){
            $idUsuario=$_GET['id'];
            include('../php/coneccion.php');
            $baja_admin=@mysqli_query($coneccion, "UPDATE `usuarios` SET disponibilidad=0 WHERE id_usuario='$idUsuario'");
            if($baja_admin){
                header('Location: ../php/administradores.php?message=SI');
                die();
            }
            else{
                header('Location: ../php/administradores.php?message=NO');
                die();
            }
        }
    }
    }
?>