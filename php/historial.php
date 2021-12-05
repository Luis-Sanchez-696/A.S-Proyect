<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="stylesheet" href="../css/historial-styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Historial</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            include('admin-header.php');
    ?>
    <main>
        <h2 class="table-title">Historial de Retiros y Devoluciones de Dispositivos</h2>
        <div class="table-container">
            <table class="historial-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Dispositivo</th>
                        <th>Observaciones</th>
                        <th>Fecha de Retiro</th>
                        <th>Fecha de Devolución</th>
                        </tr>
                </thead>
                <tbody>
                    <?php
<<<<<<< HEAD
                        include('../php/coneccion.php');
                        $get_historial=@mysqli_query($coneccion,"SELECT DISTINCT usuarios.nombre, usuarios.apellido, computadoras.num_computadora, retiros_pc.observaciones, retiros_pc.fecha_hora_retiro, retiros_pc.fecha_hora_devolucion FROM `retiros_pc` LEFT JOIN `computadoras` ON (retiros_pc.id_computadora_f=computadoras.id_computadora) LEFT JOIN `usuarios` ON (retiros_pc.id_usuario_f=usuarios.id_usuario) ORDER BY retiros_pc.fecha_hora_retiro");
=======
                        include('coneccion.php');
                        $consulta="SELECT DISTINCT usuarios.nombre, usuarios.apellido, computadoras.num_computadora, retiros_pc.observaciones, retiros_pc.fecha_hora_retiro, retiros_pc.fecha_hora_devolucion FROM `retiros_pc` LEFT JOIN `computadoras` ON (retiros_pc.id_computadora_f=computadoras.id_computadora) LEFT JOIN `usuarios` ON (retiros_pc.id_usuario_f=usuarios.id_usuario)";
                        $get_historial=@mysqli_query($coneccion,$consulta);
>>>>>>> e885670b857b557a74ec330a4eb797abc5896914
                        while($row=mysqli_fetch_array($get_historial)){
                            $nombre=$row['nombre'];
                            $apellido=$row['apellido'];
                            $observaciones=$row['observaciones'];
                            $num_computadora=$row['num_computadora'];
                            $fecha_hora_retiro=$row['fecha_hora_retiro'];
                            $fecha_hora_devolucion=$row['fecha_hora_devolucion'];

                            if($fecha_hora_devolucion=="0000-00-00 00:00:00"){
                                $fecha_hora_devolucion="";
                            }

                            ?>
                            <tr>
                                <td><?php echo $nombre." ".$apellido?></td>
                                <td><?php echo $num_computadora?></td>
                                <td><?php echo $observaciones?></td>
                                <td><?php echo $fecha_hora_retiro?></td>
                                <td><?php echo $fecha_hora_devolucion?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
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
                <input type="checkbox" class="historial-moves" checked>
                <a class="menu section-style"  href="../php/historial.php" title="Historial">Historial</a>
                <img class="menu-icon H" src="../icons/bx-history.svg" alt="history">
                <a class="menu section-style" href="../php/no-devueltos.php" title="No Devueltos">No Devueltos</a>
                <img class="menu-icon" src="../icons/bx-block.svg" alt="block">
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