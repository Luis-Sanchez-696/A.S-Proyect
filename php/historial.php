<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Historial</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            include('admin-header.php');
    ?>
    <main>
        <div class="mai-container">
            <img class="fondo" src="../images/Fondo-Login.jpg" alt="">
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
        else{
            header('Location: ../php/error.php');
            die();
        }
    ?>
</body>
</html>