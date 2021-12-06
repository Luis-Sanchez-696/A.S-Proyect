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
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
            if($_SESSION['disponibilidad']==1){
            include('user-header.php');
    ?>
    <main>
        <div class="intro-card">
            <div class="contenido">
            <img src="../images/welcome-user.jpg" alt="imagen de inicion de sesión" class="welcome-image">
                    <h2>Bienvenido/a Usuario/a:</h2>
                    <h3><?php echo $_SESSION['realName']." ".$_SESSION['apellido']?></h3>
                    <ul class="list">
                        Estas serán sus herramientas:
                        <li>
                            <u>Dispositivos:</u>
                            <p>
                                En esta sección encontrará un listado de todas las notebooks y/o netbooks
                                de las que dispone la institución, con un detalle de sus condiciones y caracteristicas particulares.
                                Así como tambien podrá realizar aquí la reserva de las mismas en cualquier momento, siempre y cuando
                                se encuentren disponibles.
                            </p>
                            <a href="../php/user-page.php?id=1" target="_self" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                        <li>
                            <u>En Posesión:</u>
                            <p>
                                En esta sección encontrará el detalle del dispositivo que retiró y/o tiene en posesión. 
                                Solo podrá retirar un dispositivo a la vez, y mientras tenga uno cargado en esta sección,
                                no podrá retirar otro.
                                <br>
                                Es por eso que en esta sección, tambien cuenta con la opción de <u class="bold">devolver el dispositivo</u> en posesión.
                            </p>
                            <a href="../php/user-page.php?id=2" target="_self" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                </ul>
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
                                <iframe class="archivo" src="../pdf/guia-dispositivos-usuarios.pdf"></iframe>
                                <?php
                                break;
                            case '2':
                                ?>
                                <label for="modal-window-check" title="Cerrar" class="close-window">X</label>
                                <h2>En Posesión</h2>
                                <iframe class="archivo" src="../pdf/guia-en-posesion-usuario.pdf"></iframe>
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
            <section class="menu-container">
                <a class=" menu section-style" href="../php/registro-usuario.php" title="Dispositivos">Dispositivos</a>
                <img class="menu-icon" src="../icons/bx-card.svg" alt="card">
                <a class="menu section-style"  href="../php/en-posesion.php" title="En Posesión">En Posesión</a>
                <img class="menu-icon" src="../icons/bxs-backpack.svg" alt="backpack">
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