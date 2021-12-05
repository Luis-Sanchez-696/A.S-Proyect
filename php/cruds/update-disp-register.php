<?php    
session_start();
if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
    if($_SESSION['disponibilidad']==1){
    if(isset($_REQUEST['enviar'])){
        $num_computadora=$_REQUEST['num_computadora'];
        $id_tipo_pc_f=$_REQUEST['id_tipo_pc_f'];
        $cargador=$_REQUEST['cargador'];
        $conexion_internet=$_REQUEST['conexion_internet'];
        $camara=$_REQUEST['camara'];
        $id_estado_f=$_REQUEST['id_estado_f'];
        $condicion=$_REQUEST['condicion'];
        $id_computadora=$_REQUEST['id_computadora'];

        //-------------Validación del Numero de Computadora--------------------
        $num_long=strlen($num_computadora);
        $salida1="FALSE";
        for($i=0; $i<$num_long; $i++){
            if(is_numeric($num_computadora[$i])){
                $salida1="TRUE";
            }
            else{
                $salida1="FALSE";
                break;
            }
        }
        //---------------------------------------------------------------------

        //--------------Validación del TextArea--------------------------------
        $salida2="FALSE";
        $long_text=strlen($condicion);
        for($i=0; $i<$long_text; $i++){
            if(is_string($condicion[$i])){
                if(ctype_alnum($condicion[$i])){
                    $salida2="TRUE";
                }
                else{
                    if($condicion[$i]==' '){
                        $salida2="TRUE";
                    }
                    else{
                        $salida2="FALSE";
                        break;
                    }
                }
            }
            else{
                $salida2="FALSE";
                break;
            }
        }
        //---------------------------------------------------------------------

        if($salida1=="TRUE" && $salida2=="TRUE"){
            include('../cruds/dispositivos-clase.php');
            $update_disp= new dispositivo();
            $update=$update_disp->update($id_computadora, $num_computadora, $id_tipo_pc_f, $id_estado_f, $cargador, $conexion_internet, $camara, $condicion);
            if($update){
                header("Location: ../cruds/edit-disp.php?id=$id_computadora&message=SI");
                die();
            }
            else{
                header("Location: ../cruds/edit-disp.php?id=$id_computadora&message=NO");
                die();
            }
        }
        else{
            header("Location: ../cruds/edit-disp.php?id=$id_computadora&message=NO");
            die();
        }
    }
}
}
?>