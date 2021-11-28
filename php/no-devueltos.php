<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="stylesheet" href="../css/historial-styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>No Devueltos</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            include('admin-header.php');
    ?>
    <main>
        <h2 class="table-title">Historial de Dispositivos No Devueltos</h2>
        <div class="table-container-two">
            <table class="historial-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Dispositivo</th>
                        <th>Fecha de Retiro</th>
                        <th>Acciones</th>
                        </tr>
                </thead>
                <tbody>
                    <?php
                        include('../php/coneccion.php');
                        $get_historial=@mysqli_query($coneccion,"SELECT DISTINCT usuarios.nombre, usuarios.apellido, computadoras.num_computadora, retiros_pc.fecha_hora_retiro, retiros_pc.id_computadora_f, retiros_pc.id_usuario_f FROM `retiros_pc` LEFT JOIN `computadoras` ON (retiros_pc.id_computadora_f=computadoras.id_computadora) LEFT JOIN `usuarios` ON (retiros_pc.id_usuario_f=usuarios.id_usuario) WHERE computadoras.id_estado_f=3 AND retiros_pc.fecha_hora_devolucion='0000-00-00 00:00:00'");
                        while($row=mysqli_fetch_array($get_historial)){
                            $id_computadora_f=$row['id_computadora_f'];
                            $id_usuario_f=$row['id_usuario_f'];
                            $nombre=$row['nombre'];
                            $apellido=$row['apellido'];
                            $num_computadora=$row['num_computadora'];
                            $fecha_hora_retiro=$row['fecha_hora_retiro'];

                            ?>
                            <tr>
                                <td><?php echo $nombre." ".$apellido?></td>
                                <td><?php echo $num_computadora?></td>
                                <td><?php echo $fecha_hora_retiro?></td>
                                <td class="acciones">
                                <a class="clean-register" title="Limpiar Deuda" href="../php/no-devueltos.php?idComputadora=<?php echo $id_computadora_f?>&idUsuario=<?php echo $id_usuario_f?>"><img class="clean-register-action" src="../icons/cleaning_services_white_24dp.svg" alt="clean register icon"></label>
                                </td>
                            </tr>
                            <?php
                        }
                        if(isset($_GET['idComputadora']) && isset($_GET['idUsuario'])){
                            echo "<input type='checkbox' class='delete-alert' checked>";
                            $idComputadora=$_GET['idComputadora'];
                            $idUsuario=$_GET['idUsuario'];
                        }
                    ?>
                    <div class="modal-window">
                        <div class="modal-window-content">
                            <h2>Campus Virtual pregunta:</h2>
                            <p>¿Está seguro que desea Limpiar esta Deuda?</p>
                            <div class="options-container">
                                <a class="modal-window-option cancel" title="Cancelar Operación" href="../php/no-devueltos.php">Cancelar</a>
                                <a class="modal-window-option" title="Limpiar Deuda" href="../php/limpiar-deuda.php?idComputadora=<?php echo $idComputadora?>&idUsuario=<?php echo $idUsuario?>">Aceptar</a>
                            </div>
                        </div>
                    </div>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php
            if(isset($_GET['message'])){
                $message=$_GET['message'];
                if($message=="SI"){
                    ?>
                    <div class="clean-deuda-message">
                        La limpieza de la deuda ha sido realizada con éxito.
                    </div>
                    <?php
                }
                elseif($message=="NO"){
                    ?>
                    <div class="error-deuda-message">
                        Lo sentimos, pero ha ocurrido un error durante la operación.<br>Por favor, vuelva a intentarlo y revise bien sus ingresos.
                    </div>
                    <?php
                }
            }
        ?>
    </main>
    <aside>
        <input class="slider-menu" type="checkbox" id="slide">
        <label for="slide"><img class="menu-icon1" src="../icons/bx-menu.svg" alt="menu"></label>
        <div class="dashboard-container">
            <div class="aside-background"> Dashboard</div>
            <label for="slide"><img class="menu-icon" src="../icons/bx-menu.svg" alt="menu"></label>
            <div class="separador"></div>
            <section class="menu-container">
                <a class=" menu section-style" href="../php/registro-admin.php" title="Dispositivos">Dispositivos</a>
                <img class="menu-icon" src="../icons/bx-card.svg" alt="card">
                <a class="menu section-style"  href="../php/historial.php" title="Historial">Historial</a>
                <img class="menu-icon" src="../icons/bx-history.svg" alt="history">
                <input type="checkbox" class="por-devolver" checked>
                <a class="menu section-style" href="../php/no-devueltos.php" title="No Devueltos">No Devueltos</a>
                <img class="menu-icon deneg" src="../icons/bx-block.svg" alt="block">
                <a class="menu section-style" href="../php/administradores.php" title="Administradores">Administradores</a>
                <img class="menu-icon" src="../icons/people_black_24dp.svg" alt="people">
            </section>
        </div>
    </aside>
    <?php
        include('footer.php');
        }
        }
        else{
            header('Location: ../php/error.php');
            die();
        }

    ?>
    
</body>
</html>