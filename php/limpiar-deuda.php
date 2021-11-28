<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/observaciones-styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Devolución</title>
</head>
<body>
    <main>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            if(isset($_GET['idComputadora']) && isset($_GET['idUsuario'])){
                $idComputadora=$_GET['idComputadora'];
                $idUsuario=$_GET['idUsuario'];
            ?>
                <div class="form-container">
                    <h1>Observaciones de la Devolución</h1>
                    <form class="form-observaciones" action="limpiar-deuda.php?idComputadora=<?php echo $idComputadora?>&idUsuario=<?php echo $idUsuario?>" method="POST">
                        <textarea class="observaciones" name="observaciones" cols="20" rows="10" placeholder="Si no desea agregar ninguna observación, solo presione ACEPTAR."></textarea>
                        <input class="obs-submit" type="submit" name="enviar" title="Aceptar" value="Aceptar">
                    </form>
                </div>
            <?php
                if(isset($_REQUEST['enviar'])){
                    $observaciones=$_REQUEST['observaciones'];
                    //--------------Validación del TextArea--------------------------------
                    $salida1="FALSE";
                    $long_text=strlen($observaciones);
                    for($i=0; $i<$long_text; $i++){
                        if(is_string($observaciones[$i])){
                            if(ctype_alnum($observaciones[$i])){
                                $salida1="TRUE";
                            }
                            else{
                                if($observaciones[$i]==' '){
                                    $salida1="TRUE";
                                }
                                else{
                                    $salida1="FALSE";
                                    break;
                                }
                            }
                        }
                        else{
                            $salida1="FALSE";
                            break;
                        }
                    }
                        //--------------------------------------------------------------------
                        if($salida1=="TRUE"){
                            $valid_observaciones=$observaciones;
                            include('../php/coneccion.php');
                            $cambio_estado=@mysqli_query($coneccion, "UPDATE `computadoras` SET id_estado_f=1 WHERE id_computadora='$idComputadora'");
                            $get_fecha_retiro=@mysqli_query($coneccion, "SELECT DISTINCT retiros_pc.fecha_hora_retiro FROM `retiros_pc` WHERE retiros_pc.id_computadora_f='$idComputadora' AND retiros_pc.id_usuario_f='$idUsuario'");
                            if($row=mysqli_fetch_array($get_fecha_retiro)){
                                $fecha_retiro=$row['fecha_hora_retiro'];
                            }
                            date_default_timezone_set('America/Argentina/Salta');
                            $fecha_devolucion=date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
                            $set_fecha_devolucion=@mysqli_query($coneccion, "UPDATE `retiros_pc` SET observaciones='$valid_observaciones', fecha_hora_retiro='$fecha_retiro', fecha_hora_devolucion='$fecha_devolucion' WHERE id_computadora_f='$idComputadora' AND id_usuario_f='$idUsuario'");
                            if($set_fecha_devolucion){
                                header("Location: ../php/no-devueltos.php?message=SI");
                                die();
                            }
                            else{
                                header("Location: ../php/no-devueltos.php?message=NO");
                                die();
                            }
                            }
                        else{
                            header("Location: ../php/limpiar-deuda.php?idComputadora=$idComputadora&idUsuario=$idUsuario&message=NO");
                        }
                }
            }
            if(isset($_GET['message'])){
                $mensaje=$_GET['message'];
                if($mensaje=="NO"){
                    ?>
                    <div class="error-deuda-message">
                        Lo sentimos, pero ha ocurrido un error durante la operación.<br>Por favor, vuelva a intentarlo y revise bien sus ingresos.
                    </div>
                    <?php
                }
            }
        }
        }
    ?>
    </main>
    <script src="../js/evitar-reenvios.js"></script>
</body>
</html>