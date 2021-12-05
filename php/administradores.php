<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="stylesheet" href="../css/admins-styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Administradores</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            include('admin-header.php');
            ?>
        <main>
            <div class="admin-search">
                <form action="../php/administradores.php" method="POST">
                    <input name="dni" type="number" class="admin-dni" placeholder="Ingrese Número de DNI:">
                    <button title="Buscar" name="enviar" class="admin-search-button" type="submit"><img src="../icons/search_white_24dp.svg" alt="search-icon"></button>
                </form>
            </div>
            <div class="table-container">
                <table class="admins-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Usuario</th>
                            <th>DNI</th>
                            <th>Tel Móvil</th>
                            <th>E-Mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
<<<<<<< HEAD
                            include('../php/coneccion.php');
                            if(isset($_REQUEST['enviar'])){
                                if(isset($_REQUEST['dni'])){
                                $search=$_REQUEST['dni'];
                                $get_data=@mysqli_query($coneccion, "SELECT DISTINCT usuarios.id_usuario, usuarios.nombre, usuarios.apellido, usuarios.nombre_usuario, usuarios.dni, usuarios.tel_movil, usuarios.e_mail FROM `usuarios` WHERE (usuarios.id_rango_f=2 AND usuarios.disponibilidad=1) AND usuarios.dni='$search'");
                                while($row=mysqli_fetch_array($get_data)){
                                    $nombre=$row['nombre'];
                                    $apellido=$row['apellido'];
                                    $usuario=$row['nombre_usuario'];
                                    $dni=$row['dni'];
                                    $tel_movil=$row['tel_movil'];
                                    $e_mail=$row['e_mail'];
                                    $id_usuario=$row['id_usuario'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nombre?></td>
                                        <td><?php echo $apellido?></td>
                                        <td><?php echo $usuario?></td>
                                        <td><?php echo $dni?></td>
                                        <td><?php echo $tel_movil?></td>
                                        <td class="email"><?php echo $e_mail?></td>
                                        <td class="acciones">
                                            <a class="baja-admin" title="Dar de Baja" href="../php/administradores.php?id=<?php echo $id_usuario?>"><img class="baja-admin-icon" src="../icons/disabled_by_default_white_24dp.svg" alt="baja-cuenta-admin-icon"></a>
                                        </td>
                                    </tr>
                                    <?php
                                }

                                }
                            }
                            else{
                                $get_data=@mysqli_query($coneccion, "SELECT DISTINCT usuarios.id_usuario, usuarios.nombre, usuarios.apellido, usuarios.nombre_usuario, usuarios.dni, usuarios.tel_movil, usuarios.e_mail FROM `usuarios` WHERE usuarios.id_rango_f=2 AND usuarios.disponibilidad=1");
                                while($row=mysqli_fetch_array($get_data)){
=======
                            include('coneccion.php');
                            $get_data=@mysqli_query($coneccion, "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.apellido, usuarios.nombre_usuario, usuarios.dni, usuarios.tel_movil, usuarios.e_mail FROM `usuarios` WHERE usuarios.id_rango_f=2 AND usuarios.disponibilidad=1;");
                            while($row=mysqli_fetch_array($get_data)){
>>>>>>> e885670b857b557a74ec330a4eb797abc5896914
                                $nombre=$row['nombre'];
                                $apellido=$row['apellido'];
                                $usuario=$row['nombre_usuario'];
                                $dni=$row['dni'];
                                $tel_movil=$row['tel_movil'];
                                $e_mail=$row['e_mail'];
                                $id_usuario=$row['id_usuario'];
                                ?>
                                <tr>
                                    <td><?php echo $nombre?></td>
                                    <td><?php echo $apellido?></td>
                                    <td><?php echo $usuario?></td>
                                    <td><?php echo $dni?></td>
                                    <td><?php echo $tel_movil?></td>
                                    <td><?php echo $e_mail?></td>
                                    <td class="acciones">
                                        <a class="baja-admin" title="Dar de Baja" href="../php/administradores.php?id=<?php echo $id_usuario?>"><img class="baja-admin-icon" src="../icons/disabled_by_default_white_24dp.svg" alt="baja-cuenta-admin-icon"></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            if(isset($_GET['id'])){
                                $id_usuario=$_GET['id'];
                                echo "<input type='checkbox' class='delete-alert' checked>";
                            }
                        ?>
                        <div class="modal-window">
                        <div class="modal-window-content">
                            <h2>Campus Virtual pregunta:</h2>
                            <p>¿Está seguro que desea Dar de Baja esta Cuenta de Administrador?</p>
                            <div class="options-container">
                                <a class="modal-window-option cancel" title="Cancelar Operación" href="../php/administradores.php">Cancelar</a>
                                <a class="modal-window-option" title="Dar de Baja" href="../php/disable-admin-account.php?id=<?php echo $id_usuario?>">Aceptar</a>
                            </div>
                        </div>
                    </div>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php
            if(isset($_REQUEST['enviar'])){
                ?>
                <div class="search-message">
                    Resultados encontrados. Presione <b>F5</b> si desea volver al registro inicial, o si lo desea puede realizar otras búsquedas.
                </div>
                <?php
            }
                if(isset($_GET['message'])){
                    $mensaje=$_GET['message'];
                    if($mensaje=="SI"){
                        ?>
                        <div class="disable-confirm-message">
                            La baja del usuario ha sido realizada con éxito.
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="disable-error-message">
                            Lo sentimos, pero ha ocurrido un error durante la operación.<br>Por favor, vuelva a intentarlo.
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
                <!---->
                <section class="menu-container">
                    <a class=" menu section-style" href="../php/registro-admin.php" title="Dispositivos">Dispositivos</a>
                    <img class="menu-icon" src="../icons/bx-card.svg" alt="card">
                    <a class="menu section-style"  href="../php/historial.php" title="Historial">Historial</a>
                    <img class="menu-icon" src="../icons/bx-history.svg" alt="history">
                    <a class="menu section-style" href="../php/no-devueltos.php" title="No Devueltos">No Devueltos</a>
                    <img class="menu-icon" src="../icons/bx-block.svg" alt="block">
                    <input type="checkbox" class="admin-check" checked>
                    <a class="menu section-style" href="../php/administradores.php" title="Administradores">Administradores</a>
                    <img class="menu-icon admin" src="../icons/people_black_24dp.svg" alt="people">
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
    <script src="../js/evitar-reenvios.js"></script>
</body>
</html>