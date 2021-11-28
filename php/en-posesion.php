<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>En Posesión</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
            if($_SESSION['disponibilidad']==1){
            include('user-header.php');
    ?>
    <main>
        <img class="fondo" src="../images/Fondo-Login.jpg" alt="">
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
                <input type="checkbox" class="posesion" checked>
                <a class="menu section-style"  href="../php/en-posesion.php" title="En Posesión">En Posesión</a>
                <img class="menu-icon poseido" src="../icons/bxs-backpack.svg" alt="backapck">
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