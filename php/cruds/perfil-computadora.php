<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/crud/perfil-computadora.css">
    <link rel="stylesheet" href="../../css/crud/sw-modal-window.css">
    <link rel="shootcut icon" href="../../images/Logo-Santa-Fe.png">
    <title>Dispositivo</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            if(isset($_GET['id'])){
                $id_computadora=$_GET['id'];
            }
            include('../coneccion.php');
            $get_details=@mysqli_query($coneccion,"SELECT DISTINCT computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.conexion_internet, computadoras.cargador, computadoras.camara, estado_tipo.estado, computadoras.condicion FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE computadoras.id_computadora='$id_computadora'");
            $row=mysqli_fetch_array($get_details);
            $numero=$row['num_computadora'];
            $tipo=$row['tipo_pc'];
            $conexion=$row['conexion_internet'];
            $cargador=$row['cargador'];
            $camara=$row['camara'];
            $status=$row['estado'];
            $condicion=$row['condicion'];

            if($cargador==1){
                $cargador="SI";
            }
            else{
                $cargador="NO";
            }

            if($camara==1){
                $camara="SI";
            }
            else{
                $camara="NO";
            }
            if($conexion==1){
                $conexion="SI";
            }
            else{
                $conexion="NO";
            }
            $get_sw=@mysqli_query($coneccion,"SELECT DISTINCT software.id_software, software.tipo_software, software.nombre_software FROM `computadoras` LEFT JOIN `sw_instalados` ON (computadoras.id_computadora=sw_instalados.id_computadora_f) LEFT JOIN `software` ON (sw_instalados.id_software_f=software.id_software) WHERE computadoras.id_computadora='$id_computadora';")

    ?>
    <main>
        <div class="card-container">
            <div class="card">
                <div class="contenido">
                    <img class="device-description-image" src="../../images/Device Description.svg" alt="Device Description Image">
                    <h1> Perfil del Dispositivo N°:<?php echo " <div class='identificador'>$numero</div>"?></h1>
                    <ul class="list">
                        Descripción:
                        <li>
                            <u>Tipo de Dispositivo: </u> <?php echo $tipo?>
                        </li>
                        <li>
                            <u>Conexión a Internet: </u><?php echo $conexion?>
                        </li>
                        <li>
                            <u>Cargador: </u><?php echo $cargador?>
                        </li>
                        <li>
                            <u>Cámara: </u><?php echo $camara?>
                        </li>
                        <li>
                            <u>Condiciones del Dispositivo: </u> <?php echo $condicion?>
                        </li>
                        <li>
                            <u>Estado del Dispositivo: </u> <?php echo $status?>
                        </li>
                        <li>
                            <u>Software y Aplicaciones del Dispositivo:</u><br>
                            <div class="table-container">
                            <table class="sw-table">
                                <thead class="sw-table-head">
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Nombre</th>
                                        <th>Desinstalar</th>
                                    </tr>
                                </thead>
                                <tbody class="sw-table-body">
                                    <?php
                                        while($row=mysqli_fetch_array($get_sw)){
                                            $tipoSW=$row['tipo_software'];
                                            $nombreSW=$row['nombre_software'];
                                            $id_software=$row['id_software'];
                                        
                                    ?>
                                    <tr class="table-body-row">
                                        <td>
                                            <?php echo $tipoSW?>
                                        </td>
                                        <td>
                                            <?php echo $nombreSW?>
                                        </td>
                                        <td>
                                            <a title="Desinstalar Software" class="delete-sw" href="../cruds/perfil-computadora.php?id=<?php echo $id_computadora?>&id2=<?php echo $id_software?>"><img class="delete-sw-action" src="../../icons/backspace_white_24dp.svg" alt="delete software register"></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                        if(isset($_GET['id']) && isset($_GET['id2'])){
                                            echo "<input type='checkbox' name='delete-alert' id='delete-alert' class='uninstall-delete-alert' checked>";
                                            $idComputadora=$_GET['id'];
                                            $idSoftware=$_GET['id2'];
                                        }
                                    ?>
                                    <div class="uninstall-modal-window">
                                        <div class="uninstall-modal-window-content">
                                            <h2>Campus Virtual pregunta:</h2>
                                            <p>¿Está seguro que desea Desintalar este Software del Dispositivo?</p>
                                            <div class="uninstall-options-container">
                                                <a class="uninstall-modal-window-option cancel" title="Cancelar Operación" href="../cruds/perfil-computadora.php?id=<?php echo $idComputadora?>">Cancelar</label>
                                                <a title="Desinstalar Software" class="uninstall-modal-window-option delete-sw" href="../cruds/delete-software.php?id=<?php echo $idComputadora?>&id2=<?php echo $idSoftware?>">Desinstalar</a>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                                <tfoot class="sw-table-foot">
                                    <tr>
                                        <td colspan=3><label title="Instalar Nuevo Software" class="nuevo-sw" for="modal-checker">Instalar Nuevo</label></td>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <div class="actions-container">
                                <a class="action volver" href="../../php/registro-admin.php">Volver</a>
                                <a class="action agregar" href="../cruds/add-software-register.php">+ Software</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-container">
            <input type="checkbox" class="modal-input" id="modal-checker">
                <div class="modal-window">
                    <label class="close-window" for="modal-checker">X</label>
                    <h2>Lista de Software Disponibles</h2>
                    <div class="sw-option-list">
                        <?php
                            $add_new_sw=@mysqli_query($coneccion, "SELECT DISTINCT * FROM `software`");
                        ?>
                        <form class="sw-options-form" action="../cruds/install-new-sw.php?id=<?php echo $id_computadora?>" method="POST">
                            <table class="sw-options-table">
                                <tbody>
                            <?php
                                while($row=mysqli_fetch_array($add_new_sw)){
                                    $id_sw=$row['id_software'];
                                    $tipo_sw=$row['tipo_software'];
                                    $nombre_sw=$row['nombre_software'];
                                    ?>
                                        <tr>
                                            <td><?php echo $tipo_sw?></td>
                                            <td><?php echo $nombre_sw?></td>
                                            <td class="sw-option-radio">
                                                <input type="radio" name="sw-option" id="sw-option" class="sw-option-input" value="<?php echo $id_sw?>" required>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                                </tbody>
                            </table>
                            <input class="install-sw" id="install-sw" type="submit" name="enviar">
                        </form>
                    </div>
                    <label class="submit-reference" for="install-sw">Instalar</label>
                </div>
            </div>
        </div>
    </main>
    <?php
        }
        }
    ?>
</body>
</html>