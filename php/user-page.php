<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Inicio</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
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
                            <a href="#" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
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
                            <a href="#" class="mas-informacion" title="Más Información" target="_blank">Ver Más</a>
                        </li>
                        <hr>
                </ul>
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
        else{
            header('Location: ../php/error.php');
            die();
        }

    ?>
</body>
</html>