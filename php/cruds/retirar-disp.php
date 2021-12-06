<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/crud/retirar-disp-styles.css">
    <link rel="shotcut icon" href="../../images/Logo-Santa-Fe.png">
    <title>Retirar Dispositivo</title>
</head>
<body>
    <main>
    <?php
    session_start();
    if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
        if($_SESSION['disponibilidad']==1){
            if($_GET['id']){
                $id_computadora=$_GET['id'];
                include('../coneccion.php');
                $get_pc_number=@mysqli_query($coneccion, "SELECT DISTINCT num_computadora FROM `computadoras` WHERE id_computadora='$id_computadora'");
                if($row=mysqli_fetch_array($get_pc_number)){
                    $numero=$row['num_computadora'];
                }
                ?>
                <div class="form-container">
                    <h1>Retiro del Dispositivo: <u><?php echo $numero?></u></h1>
                    <form class="retiro-form" action="../cruds/retirar-disp.php?id=<?php echo $id_computadora?>" method="POST">
                        Ingrese el número de DNI del usuario retirante:
                        <input class="form-input dni" type="number" name="dni" placeholder="Número de DNI" required>
                        Observaciones previas al retiro (opcional):
                        <textarea class="form-input observaciones" name="observaciones" cols="30" rows="10" placeholder="Si no desea agregar nada, solo presione Espacio y luego Retirar."></textarea>
                        <input class="form-input retiro-submit" type="submit" value="Retirar" name="enviar">
                    </form>
                    <a class="return-register" href="../../php/registro-admin.php" title="Volver al Registro"><img src="../../icons/arrow_back_white_24dp.svg" alt="retur-dip-register-icon"></a>
                </div>
                <?php
                if(isset($_REQUEST['enviar'])){
                    $dni=$_REQUEST['dni'];
                    $observaciones=$_REQUEST['observaciones'];
                    //--------------Validacion del DNI--------------------
                    $num_long=strlen($dni);
                    $salida1="FALSE";
                    for($i=0; $i<$num_long; $i++){
                        if(is_numeric($dni[$i])){
                            $salida1="TRUE";
                        }
                        else{
                            $salida1="FALSE";
                            break;
                        }
                    }
                    //----------------------------------------------------
                    //--------------Validación del TextArea---------------
                    $salida2="FALSE";
                    $long_text=strlen($observaciones);
                    for($i=0; $i<$long_text; $i++){
                        if(is_string($observaciones[$i])){
                            if(ctype_alnum($observaciones[$i])){
                                $salida2="TRUE";
                            }
                            else{
                                if($observaciones[$i]==' '){
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
                    //----------------------------------------------------
                    if($salida1=="TRUE" && $salida2=="TRUE"){
                        $get_user_id=@mysqli_query($coneccion, "SELECT DISTINCT id_usuario FROM `usuarios` WHERE dni='$dni'");
                        if($get_user_id){
                            if($row=mysqli_fetch_array($get_user_id)){
                                $id_usuario=$row['id_usuario'];
                            }
                            date_default_timezone_set('America/Argentina/Salta');
                            $fecha_hora_retiro=date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
                            $set_historial_register=@mysqli_query($coneccion, "INSERT INTO `retiros_pc` (id_computadora_f, id_usuario_f, observaciones, fecha_hora_retiro, fecha_hora_devolucion) VALUES ('$id_computadora', '$id_usuario', '$observaciones', '$fecha_hora_retiro', '1111-11-11 00:00:00')");
                            if($set_historial_register){
                                $set_retiro=@mysqli_query($coneccion, "UPDATE `computadoras` SET id_estado_f='3' WHERE id_computadora='$id_computadora'");
                                ?>
                                <div class="retiro-confirm-message">
                                    El retiro del dispositivo se ha realizado con éxito.
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <div class="retiro-error-message">
                                    Lo sentimos, pero ha ocurrido un error durante la operación.<br>Por favor, vuelva a intentarlo y revise bien sus ingresos.
                                </div>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <div class="retiro-error-message">
                                Lo sentimos, pero ha ocurrido un error durante la operación.<br>Por favor, vuelva a intentarlo y revise bien sus ingresos.
                            </div>
                            <?php
                        }
                    }
                }
            }
        }
    }
?>
</main>
<script src="../../js/evitar-reenvios.js"></script>
</body>
</html>