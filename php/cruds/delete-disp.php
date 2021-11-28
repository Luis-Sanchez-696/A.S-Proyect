<?php
    session_start();
    if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
        if($_SESSION['disponibilidad']==1){
        if(isset($_GET['id'])){
            include('../cruds/dispositivos-clase.php');
            $dispositivo= new dispositivo();
            $id=$_GET['id'];
            $delete=$dispositivo->delete($id);
                if($delete){
                    header('Location: ../registro-admin.php');
                    die();
                }
                else{
                    echo "Eliminación del registro fallida<br>";
                }
        }
        }
    }
?>