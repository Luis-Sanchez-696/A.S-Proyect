<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <link rel="stylesheet" href="../css/lista-usuario.css">
    <link rel="stylesheet" href="../css/style-modal.css">
    <title>Dispositivos</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
            include('user-header.php');
    ?>
    <?php
        include('coneccion.php');
        $consulta="SELECT computadoras.id_computadora,computadora_tipo.tipo_pc, computadoras.num_computadora, computadoras.cargador, computadoras.camara, computadoras.conexion_internet, computadoras.condicion,estado_tipo.estado,estado_tipo.id_estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadora_tipo.id_tipo_pc=computadoras.id_tipo_pc_f) LEFT JOIN `estado_tipo` ON (estado_tipo.id_estado=computadoras.id_estado_f)";
        $resultado=@mysqli_query($coneccion,$consulta);
        ?> 
    <main>
    <table class="list-pc">
        <thead class="list-head">
            <tr>
                <td class="td-head">Tipo de PC</td>
                <td>Número PC</td>
                <td>Cargador</td>
                <td>Cámara</td>
                <td>Internet</td>
                <td>Condición</td>
                <td>Disponibilidad</td>
                <td>Ver más</td>
            </tr>
        </thead>
        <tbody>   
        <?php
            while($registro=mysqli_fetch_array($resultado)){
                if($registro['id_estado']==1){
        ?>
            <tr>
                <td><?php echo $registro['tipo_pc'];?></td>
                <td><?php echo $registro['num_computadora'];?></td>
                <td>
                    <?php 
                    if($registro['cargador']==1){
                        echo "Si";}
                        else{ 
                        echo "No";}
                    ?>
                </td>
                <td> 
                    <?php 
                    if($registro['camara']==1){
                        echo "Si";}
                        else{ 
                        echo "No";}
                    ?>
                </td>
                <td>
                <?php 
                    if($registro['conexion_internet']==1){
                        echo "Si";}
                        else{ 
                        echo "No";}
                    ?> 
                </td>
                <td><?php echo $registro['condicion'];?></td>
                <td>
                <?php if($registro['id_estado']==1){;
                ?>
                <p id="disponibilidad1"><?php echo $registro['estado'];}?></p>
                </td> 
                <td class="ver-aplicaciones">
                    <?php $registro['id_computadora'];?>
                    <a title="Ver Aplicaciones" href="Atributos-de-pc.php?idpc=<?php echo $registro['id_computadora'];?>" id="boton-apps" target="_self" ><img src="../icons/bx-info-circle.svg"></a>
                </td>
            <?php                           
            }
                }?>
        </tbody>
        <tfoot class="list-foot">
            <td colspan="10"></td>
        </tfoot>
    </table>   
    </main>
    <aside>
        <!----------------------       
        SLIDER        ---------------------------->
        <input class="slider-menu" type="checkbox" id="slide">
        <label for="slide"><img class="menu-icon1" src="../icons/bx-menu.svg" alt="menu"></label>
        <div class="dashboard-container">
            <div class="aside-background"> Dashboard</div>
            <label for="slide"><img class="menu-icon" src="../icons/bx-menu.svg" alt="menu"></label>
            <div class="separador"></div>
            <section class="menu-container">
                <input type="checkbox" class="registro-pc" checked>
                <a class=" menu section-style" href="../php/registro-usuario.php" title="Dispositivos">Dispositivos</a>
                <img class="menu-icon pc" src="../icons/bx-card.svg" alt="card">
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