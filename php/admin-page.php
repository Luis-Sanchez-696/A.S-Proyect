<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="stylesheet" href="../css/admin-user-modal-windows.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Inicio</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            if($_SESSION['disponibilidad']==1){
            include('admin-header.php');
    ?>
        <main>
            <div class="main-container">
            <div class="intro-card">
                <div class="contenido">
                    <img src="../images/welcome-admin.jpg" alt="imagen de inicion de sesión" class="welcome-image">
                    <h2>Bienvenido/a Administrador/a:</h2>
                    <h3><?php echo $_SESSION['realName']." ".$_SESSION['apellido']?></h3>
                    <ul class="list">
                        Estas serán sus herramientas:
                        <li>
                            <u>Dispositivos:</u>
                            <p>
                                En esta sección encontrará un listado de todas las notebooks y/o netbooks
                                de las que dispone la institución. Y aquí podrá realizar diversas operaciones 
                                sobre las mismas, como <u class="bold">agregar un nuevo dispositivo a la lista</u>, <u class="bold">editar información
                                de algún dispositivo</u>, o <u class="bold">eliminar un dispositivo de la lista</u>.
                            </p>
                            <a href="../php/admin-page.php?id=1" target="_self" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                        <li>
                            <u>Historial:</u>
                            <p>
                                En esta sección podrá visualizar un registro detallado de todos los retiros y devoluciones de dispositivos 
                                que se han llevado a cabo en el sistema, realizados por usuarios y administradores. 
                            </p>
                            <a href="../php/admin-page.php?id=2" target="_self" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                        <li>
                            <u>No Devueltos:</u>
                            <p>
                                En esta sección podrá encontrar un listado de todos aquellos dispositivos que han sido
                                retirados pero que aún no fueron devueltos, y se podrá dar seguimiento a los mismos y a 
                                las personan que los tienen en posesión.
                            </p>
                            <a href="../php/admin-page.php?id=3" target="_self" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                        <li>
                            <u>Administradores:</u>
                            <p>
                                En esta sección se detalla un listado de todas las cuentas de los administradores
                                del sistema, con la posibilidad de dar de baja o alta dichas cuentas en cualquier momento.
                            </p>
                            <a href="../php/admin-page.php?id=4" target="_self" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
            </div>
            <?php
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    ?>
                    <input type="checkbox" id="modal-window-check" class="modal-window-check" checked>
                    <?php
                }
                ?>
                <div class="modal-window-container">
                    <div class="modal-window">
                        <?php
                            switch($id){
                                case '1':
                                    ?>
                                    <label for="modal-window-check" title="Cerrar" class="close-window">X</label>
                                    <h2>Dispositivos</h2>
                                    <iframe class="archivo" src="../pdf/guia-dispositivos.pdf"></iframe>
                                    <?php
                                    break;
                                case '2':
                                    ?>
                                    <label for="modal-window-check" title="Cerrar" class="close-window">X</label>
                                    <h2>Historial</h2>
                                    <iframe class="archivo" src="../pdf/guia-historial-de-retiros-y-devoluciones.pdf"></iframe>
                                    <?php
                                    break;
                                case '3':
                                    ?>
                                    <label for="modal-window-check" title="Cerrar" class="close-window">X</label>
                                    <h2>No Devueltos</h2>
                                    <iframe class="archivo" src="../pdf/guia-no-devueltos.pdf"></iframe>
                                    <?php
                                    break;
                                case '4':
                                    ?>
                                    <label for="modal-window-check" title="Cerrar" class="close-window">X</label>
                                    <h2>Administradores</h2>
                                    <iframe class="archivo" src="../pdf/guia-administradores.pdf"></iframe>
                                    <?php
                                    break;
                            }
                        ?>
                    </div>
                </div>
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
                    <a class="menu section-style" href="../php/administradores.php" title="Administradores">Administradores</a>
                    <img class="menu-icon" src="../icons/people_black_24dp.svg" alt="people">
                </section>
            </div>
        </aside>
    <?php
        include('footer.php');
        }
        else{
            header('Location: ../php/error.php');
        }
        }
        else{
            header('Location: ../php/error.php');
            die();
        }
    ?>
</body>
</html>