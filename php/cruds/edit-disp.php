<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/crud/create-disp.css">
    <link rel="stylesheet" href="../../css/Sections-Styles.css">
    <link rel="stylesheet" href="../../css/noti-alert.css">
    <link rel="shotcut icon" href="../../images/Logo-Santa-Fe.png">
    <title>Editar Dispositivo</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            if(isset($_GET['id'])){
                $id_computadora=$_GET['id'];
                include('../cruds/dispositivos-clase.php');
                $get_disp_data= new dispositivo();
                $disp_data=$get_disp_data->getter($id_computadora);
                $num_computadora=$disp_data->num_computadora;
                $tipo_pc=$disp_data->tipo_pc;
                $conexion_interner=$disp_data->conexion_internet;
                $cargador=$disp_data->cargador;
                $camara=$disp_data->camara;
                $condicion=$disp_data->condicion;
                $estado=$disp_data->estado;
            }
    ?>
        <main>
            <div class="form-container">
                <form action="update-disp-register.php?id=<?php echo $id_computadora ?>" method="post">
                    <h1>Editar Dispositivo <u class="num-dispositivo"><?php echo $num_computadora?></u> </h1>
                    <p class="first-p">Número de Dispositivo:</p>
                    <input type="number" class="input" name="num_computadora" placeholder="Número de Dispositivo" value="<?php  echo $num_computadora?>" requiered>
                    <p>Tipo de Dispositivo:</p>
                    <div class="input-container">
                    <p class="option">&#164 Notebook:</p> <input type="radio" name="id_tipo_pc_f" value=1 class="input-radius" <?php if($tipo_pc=="Notebook"){?> checked <?php } ?> required>
                    <p class="option">&#164 Netbook:</p> <input type="radio" name="id_tipo_pc_f" value=2 class="input-radius" <?php if($tipo_pc=="Netbook"){?> checked <?php } ?> required>
                    </div>
                    <p>Internet:</p>
                    <div class="input-container">
                    <p class="option">&#164 SI:</p> <input type="radio" name="conexion_internet" value=1 class="input-radius" <?php if($conexion_interner==1){?> checked <?php } ?> required>
                    <p class="option">&#164 NO:</p><input type="radio" name="conexion_internet" value=0 class="input-radius" <?php if($conexion_interner==0){?> checked <?php } ?> required>
                    </div>
                    <p>Cargador:</p>
                    <div class="input-container">
                    <p class="option">&#164 SI:</p> <input type="radio" name="cargador" value=1 class="input-radius" <?php if($cargador==1){?> checked <?php } ?> required>
                    <p class="option">&#164 NO:</p><input type="radio" name="cargador" value=0 class="input-radius" <?php if($cargador==0){?> checked <?php } ?> required>
                    </div>
                    <p>Cámara:</p>
                    <div class="input-container">
                    <p class="option">&#164 SI:</p> <input type="radio" name="camara" value=1 class="input-radius" <?php if($camara==1){?> checked <?php } ?> required>
                    <p class="option">&#164 NO:</p><input type="radio" name="camara" value=0 class="input-radius" <?php if($camara==0){?> checked <?php } ?> required>
                    </div>
                    <p>Estatus:</p>
                    <div class="input-container">
                    <p class="option">&#164 Disponible:</p> <input type="radio" name="id_estado_f" value=1 class="input-radius" <?php if($estado=="Disponible"){?> checked <?php } ?> required>
                    <p class="option">&#164 Reservado:</p><input type="radio" name="id_estado_f" value=2 class="input-radius" <?php if($estado=="Reservado"){?> checked <?php } ?> required>
                    <p class="option">&#164 Retirado:</p> <input type="radio" name="id_estado_f" value=3 class="input-radius" <?php if($estado=="Retirado"){?> checked <?php } ?> required>
                    <p class="option">&#164 No Disponible:</p><input type="radio" name="id_estado_f" value=4 class="input-radius" <?php if($estado=="No Disponible"){?> checked <?php } ?> required><br>
                    </div>
                    <p>Condición del Dispositivo:</p>
                    <textarea placeholder="Descripción de la Condición" class="input-textarea" name="condicion" cols="30" rows="10"><?php echo $condicion ?></textarea><br>
                    <input type="hidden" name="id_computadora" value="<?php echo $id_computadora?>">
                    <input class="submit" type="submit" name="enviar" value="Actualizar" title="Actualizar Dispositivo">
                    <a class="volver" href="../../php/registro-admin.php" title="Volver">Volver</a>
                </form>
            </div>
            <?php
                if(isset($_GET['message'])){
                    $mensaje=$_GET['message'];
                    if($mensaje=="SI"){
                        ?>
                        <div class="notification">Actualización realizada con éxito.</div>
                        <?php
                    }
                    elseif($mensaje=="NO"){
                        ?>
                        <div class='alert'>
                            Lo sentimos, pero la operación que intentó realizar no pudo ser procesada.<br>
                            Por favor, vuelva a intentarlo y aseguresé de que los datos que ingresó son correctos, y no contienen simbolos o caracteres especiales.
                        </div>
                        <?php
                    }
                }
            ?>
        </main>
    <?php
    }
    }
    ?>
    <script src="../../js/evitar-reenvios.js"></script>
</body>
</html>