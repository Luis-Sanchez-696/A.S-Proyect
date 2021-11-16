<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shotcut icon" href="../../images/Logo-Santa-Fe.png">
    <link rel="stylesheet" href="../../css/crud/create-disp.css">
    <link rel="stylesheet" href="../../css/Sections-Styles.css">
    <link rel="stylesheet" href="../../css/noti-alert.css">
    <title>Agregar Dispositivo</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
    ?>
        <main>
            <div class="form-container">
                <form action="create-disp.php" method="post">
                    <h1>Nuevo Dispositivo</h1>
                    <p class="first-p">Número de Dispositivo:</p>
                    <input type="number" class="input" name="num_computadora" placeholder="Número de Dispositivo" requiered>
                    <p>Tipo de Dispositivo:</p>
                    <div class="input-container">
                    <p class="option">&#164 Notebook:</p> <input type="radio" name="id_tipo_pc_f" value=1 class="input-radius" required>
                    <p class="option">&#164 Netbook:</p> <input type="radio" name="id_tipo_pc_f" value=2 class="input-radius" required>
                    </div>
                    <p>Accesorios:</p>
                    <div class="input-container">
                    <p class="option">&#164 SI:</p> <input type="radio" name="cargador" value=1 class="input-radius" required>
                    <p class="option">&#164 NO:</p><input type="radio" name="cargador" value=0 class="input-radius" required>
                    </div>
                    <p>Internet:</p>
                    <div class="input-container">
                    <p class="option">&#164 SI:</p> <input type="radio" name="conexion_internet" value=1 class="input-radius" required>
                    <p class="option">&#164 NO:</p><input type="radio" name="conexion_internet" value=0 class="input-radius" required>
                    </div>
                    <p>Cámara:</p>
                    <div class="input-container">
                    <p class="option">&#164 SI:</p> <input type="radio" name="camara" value=1 class="input-radius" required>
                    <p class="option">&#164 NO:</p><input type="radio" name="camara" value=0 class="input-radius" required>
                    </div>
                    <p>Estatus:</p>
                    <div class="input-container">
                    <p class="option">&#164 Disponible:</p> <input type="radio" name="id_estado_f" value=1 class="input-radius" required>
                    <p class="option">&#164 Reservado:</p><input type="radio" name="id_estado_f" value=2 class="input-radius" required>
                    <p class="option">&#164 Retirado:</p> <input type="radio" name="id_estado_f" value=3 class="input-radius" required>
                    <p class="option">&#164 No Disponible:</p><input type="radio" name="id_estado_f" value=4 class="input-radius" required><br>
                    </div>
                    <p>Condición del Dispositivo:</p>
                    <textarea placeholder="Descripción de la Condición" class="input-textarea" name="condicion" cols="30" rows="10"></textarea><br>
                    <input class="submit" type="submit" name="enviar" value="Agregar Nuevo" title="Agregar Nuevo">
                    <a class="volver" href="../../php/registro-admin.php" title="Volver">Volver</a>
                </form>
            </div>
            <?php
                if(isset($_REQUEST['enviar'])){
                    include('dispositivos-clase.php');
                    $dispositivo= new dispositivo();
                    $num_computadora=$_REQUEST['num_computadora'];
                    $id_tipo_pc_f=$_REQUEST['id_tipo_pc_f'];
                    $cargador=$_REQUEST['cargador'];
                    $conexion_internet=$_REQUEST['conexion_internet'];
                    $camara=$_REQUEST['camara'];
                    $id_estado_f=$_REQUEST['id_estado_f'];
                    $condicion=$_REQUEST['condicion'];
                    /*
                    Validación completa de todas las entradas del formulario:
                        ... 
                        ... 
                        ... 
                    */
                    $create=$dispositivo->create($num_computadora, $id_tipo_pc_f, $id_estado_f, $cargador, $conexion_internet, $camara, $condicion);
                    if($create){
                        $mensaje="<div class='notification'>Operación realizada con éxito.</div>";
                    }
                    else{
                        $mensaje="<div class='alert'>Lo sentimos, pero la operación que intentó realizar no pudo ser procesada.<br>
                        Por favor, vuelva a intentarlo y aseguresé de que los datos que ingresó son correctos, y no contienen simbolos o caracteres especiales.
                        </div>";
                    }
                    echo $mensaje;
                }
            ?>
        </main>
    <?php
        }
    ?>
    
</body>
</html>