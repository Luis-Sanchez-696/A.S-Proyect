<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shotcut icon" href="../../images/Logo-Santa-Fe.png">
    <link rel="stylesheet" href="../../css/crud/add-software-styles.css">
    <title>Agregar Nuevo Software</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
        
    ?>
    <main>
        <div class="card-container">
            <div class="card">
                <div class="contenido">
                    <h1>&#164 Agregar Nuevo Software a la Lista &#164</h1>
                    <div class="list-form-container">
                        <div class="form-container">
                            <h2>Nuevo Software</h2>
                            <form class="new-sw-form" action="../cruds/add-software-register.php" method="POST">
                                Categoría del Nuevo Software:
                                <input type="text" name="tipo-software" placeholder="Ejemplo: Sistema Operativo, Aplicación, Navegador, etc." title="Tipo de Software" required>
                                Nombre del Nuevo Software:
                                <input type="text" name="nombre-software" placeholder="Ejemplo: Wndows 10, Access, Chrome, etc." title="Nombre del Software" required>
                                <input title="Agregar Registro" class="submit" type="submit" name="enviar" value="Agregar Nuevo">
                            </form>
                        </div>
                        <div class="sw-list-container">
                            <h2>Software Registrados</h2>
                            <table class="sw-list">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include('../coneccion.php');
                                        $sw_list=mysqli_query($coneccion,"SELECT DISTINCT * FROM `software`");
                                        while($row=mysqli_fetch_array($sw_list)){
                                            $tipo_sw=$row['tipo_software'];
                                            $nombre_sw=$row['nombre_software'];
                                        ?>
                                        <tr>
                                            <td><?php echo $tipo_sw?></td>
                                            <td><?php echo $nombre_sw?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a class="return-crud" title="Volver al Registro de Dispositivos" href="../registro-admin.php">Volver al Registro</a>
                </div>
            </div>
        </div>
    </main>
    <?php
        $mensaje="";
        if(isset($_REQUEST['enviar'])){
            $tipo=$_REQUEST['tipo-software'];
            $nombre=$_REQUEST['nombre-software'];

            $salida1="FALSE";
            $salida2="FALSE";

            $long_name=strlen($nombre);
            $long_type=strlen($tipo);

            //------------Validación del Tipo de SW----------------------------
            for($i=0; $i<$long_type; $i++){
                if(is_string($tipo[$i])){
                    if(ctype_alnum($tipo[$i])){
                        $salida1="TRUE";
                    }
                    else{
                        if($tipo[$i]==' '){
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
            //------------------------------------------------------------------

            //------------Validación del Nombre del SW--------------------------
            for($i=0; $i<$long_name; $i++){
                if(is_string($nombre[$i])){
                    if(ctype_alnum($nombre[$i])){
                        $salida2="TRUE";
                    }
                    else{
                        if($nombre[$i]==' '){
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
            //------------------------------------------------------------------
            if($salida1=="TRUE" && $salida2=="TRUE"){
                $registrar=mysqli_query($coneccion,"INSERT INTO `software` (tipo_software, nombre_software) VALUES ('$tipo', '$nombre')");
                if($registrar){
                    $mensaje="La Carga del Nuevo tipo de Software se ha Realizado con Éxito<br> Presiona <u>F5</u> para Actualizar.";
                }
                else{
                    $mensaje="Lo sentimos, pero ha ocurrido un error al cargar el nuevo tipo de Software.<br>Por favor, intentelo de nuevo y revise que sus ingresos no contengan caracteres especiales.";
                }
            }
            else{
                $mensaje="Lo sentimos, pero ha ocurrido un error al cargar el nuevo tipo de Software.<br>Por favor, intentelo de nuevo y revise que sus ingresos no contengan caracteres especiales.";
            }
            if($mensaje=="La Carga del Nuevo tipo de Software se ha Realizado con Éxito<br> Presiona <u>F5</u> para Actualizar."){
                ?>
                <div class="sw-load-confirm">
                    <div class="confirm-alert-content">
                        <?php echo $mensaje?>
                    </div>
                </div>
                <?php
            }
            elseif($mensaje=="Lo sentimos, pero ha ocurrido un error al cargar el nuevo tipo de Software.<br>Por favor, intentelo de nuevo y revise que sus ingresos no contengan caracteres especiales."){
                ?>
                <div class="sw-load-error">
                    <div class="error-alert-content">
                        <?php echo $mensaje?>
                    </div>
                </div>
                <?php
            }
        }
        }
        }
    ?>
    <script src="../../js/evitar-reenvios.js"></script>
</body>
</html>