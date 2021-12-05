<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/recuperacion-styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Recuperación de Contraseña</title>
</head>
<body>
    <main>
        <div class="form-container">
            <h1>Recuperación de Contraseña</h1>
            <form action="../php/recuperacion.php" method="POST">
                <input class="input" name="correo" id="correo" type="email" placeholder="Correo Electronico" required>
                <input class="input" type="password" name="pass1" placeholder="Nueva Contraseña" required>
                <input class="input" type="password" name="pass2" placeholder="Repetir la Contraseña" required>
                <input class="submit" type="submit" title="Enviar" name="enviar" class="send-email">
            </form>
        </div>
        <?php 
            if(isset($_REQUEST['enviar'])){
                $correo=$_REQUEST['correo'];
                $pass1=$_REQUEST['pass1'];
                $pass2=$_REQUEST['pass2'];

                //----------Validación del Correo-------------------------
                $salida="FALSE";
                $long_correo=strlen($correo);
                for($i=0; $i<$long_correo; $i++){
                    if(is_string($correo[$i])){
                        if(ctype_alnum($correo[$i])){
                            $salida="TRUE";
                        }
                        else{
                            if($correo[$i]=="@"){
                            $salida="TRUE";
                            }
                            else{
                                if($correo[$i]=="-"){
                                    $salida="TRUE";
                                }
                                else{
                                    if($correo[$i]=="_"){
                                        $salida="TRUE";
                                    }
                                    else{
                                        if($correo[$i]=="."){
                                            $salida="TRUE";
                                        }
                                        else{
                                            $salida="FALSE";
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else{
                        $salida="FALSE";
                        break;
                    }
                }
                //--------------------------------------------------------
                //-----------------Validación de la Contraseña------------
                if($salida=="TRUE"){
                $salida2_1="FALSE";
                $salida2_2="FALSE";
                $long_pass_a=strlen($pass1);
                $long_pass_b=strlen($pass2);
                if($pass1==$pass2){
                    for($i=0; $i<$long_pass_a; $i++){
                        if(is_string($pass1[$i])){
                            if($pass1[$i]!=" "){
                                if(ctype_alnum($pass1[$i])){
                                    $salida2_1="TRUE";
                                }
                                else{
                                    $salida2_1="FALSE";
                                    break;
                                }
                            }
                            else{
                                $salida2_1="FALSE";
                                break;
                            }
                        }
                        else{
                            $salida2_1="FALSE";
                            break;
                        }
                    }
                    for($i=0; $i<$long_pass_b; $i++){
                        if(is_string($pass2[$i])){
                            if($pass2[$i]!=" "){
                                if(ctype_alnum($pass2[$i])){
                                    $salida2_2="TRUE";
                                }
                                else{
                                    $salida2_2="FALSE";
                                    break;
                                }
                            }
                            else{
                                $salida2_2="FALSE";
                                break;
                            }
                        }
                        else{
                            $salida2_2="FALSE";
                            break;
                        }
                    }
                    if($salida2_1=="TRUE" && $salida2_2=="TRUE"){
                        include('../php/coneccion.php');
                        $get_id=@mysqli_query($coneccion, "SELECT DISTINCT id_usuario FROM `usuarios` WHERE e_mail='$correo'");
                        if($row=mysqli_fetch_array($get_id)){
                            $idUsuario=$row['id_usuario'];
                        }
                        $new_password=password_hash($pass2, PASSWORD_DEFAULT, ['cost'=>5]);
                        $set_new_password=@mysqli_query($coneccion, "UPDATE `usuarios` SET password_user='$new_password' WHERE id_usuario='$idUsuario'");
                        if($set_new_password){
                            ?>
                            <div class="set-password-confirm">
                                Su contraseña ha sido cambiada con éxito.
                            </div>
                            <a class="return-login" href="../php/index.php" title="Volver al Login"><img src="../icons/arrow_back_white_24dp.svg" alt="retur-to-login-icon"></a>
                            <?php
                        }
                        else{
                            ?>
                            <div class="new-password-error">
                                Lo sentimos, pero ha ocurrido un error con el ingreso de la nueva contraseña. <br>Por favor, intentelo de nuevo aseguresé de que la contraseña sea la misma en ambos campos.
                            </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="new-password-error">
                            Lo sentimos, pero ha ocurrido un error con el ingreso de la nueva contraseña. <br>Por favor, intentelo de nuevo aseguresé de que la contraseña sea la misma en ambos campos.
                        </div>
                        <?php
                    }
                }
                else{
                    ?>
                    <div class="new-password-error">
                        Lo sentimos, pero ha ocurrido un error con el ingreso de la nueva contraseña. <br>Por favor, intentelo de nuevo aseguresé de que la contraseña sea la misma en ambos campos.
                    </div>
                    <?php
                }
                }
                else{
                    ?>
                    <div class="new-password-error">
                        Lo sentimos, pero ha ocurrido un error con el ingreso de correo electrónico. <br>Por favor, intentelo de nuevo aseguresé de que el correo sea el mismo con el cual se encuentra registrado en el sistema.
                    </div>
                    <?php
                }
                //--------------------------------------------------------
            }
        ?>
    </main>
    <script src="../js/evitar-reenvios.js"></script>
</body>
</html>