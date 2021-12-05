<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <link rel="stylesheet" href="../css/sección-atributos-pc.css">
    <title>En Posesión</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
            if($_SESSION['disponibilidad']==1){
            include('user-header.php');
            include('coneccion.php');


            $id_usuario = $_SESSION['id_usuario'];
            $nombre_usuario=$_SESSION['nombre'];
            $consulta="SELECT computadora_tipo.tipo_pc,computadoras.num_computadora,computadoras.cargador,computadoras.camara,computadoras.conexion_internet,computadoras.condicion,computadoras.id_estado_f,usuarios.id_usuario, retiros_pc.id_usuario_f,retiros_pc.id_computadora_f,retiros_pc.observaciones,retiros_pc.fecha_hora_retiro,retiros_pc.fecha_hora_devolucion FROM `retiros_pc` LEFT JOIN `computadoras` ON (computadoras.id_computadora=retiros_pc.id_computadora_f) LEFT JOIN `usuarios` ON(usuarios.id_usuario=retiros_pc.id_usuario_f) LEFT JOIN `computadora_tipo` ON(computadora_tipo.id_tipo_pc=computadoras.id_tipo_pc_f) LEFT JOIN estado_tipo ON(estado_tipo.id_estado=computadoras.id_estado_f) WHERE usuarios.id_usuario='$id_usuario' AND retiros_pc.fecha_hora_devolucion='0000-00-00 00:00:00'";
            $query=mysqli_query($coneccion,$consulta);
            $traer=mysqli_fetch_array($query);
            if($traer==true){

            

    ?>
    <main>
        <?php 
        
        $disponibilidad=$traer['id_estado_f'];
        if($disponibilidad==3){
        ?>  
            <img id="pc" src="../images/apps-pc.jpg" alt="imagen pc">
                    <table class="pc"> 
                        <h1>Computadora N°: </h1>
                        <p id="num_pc"><?php echo $traer['num_computadora'] ?></p>
                        <tr>
                        <td class="elementos-pc">Tipo PC:</td>
                        <td> <?php echo $traer['tipo_pc'] ;?></td>
                        </tr>
                
                        <tr>
                        <td class="elementos-pc">Cargador:</td>
                        <td>
                            <?php 
                                    if($traer['cargador']==1){
                                        echo "Si";}
                                    else{ 
                                    echo "No";}
                            ?>
                        </td>
                        </tr>

                        <tr>
                        <td class="elementos-pc"> Cámara:</td>
                        <td>
                            <?php 
                                    if($traer['camara']==1){
                                        echo "Si";}
                                    else{ 
                                        echo "No";}
                            ?>
                        </td>
                        </tr>

                        <tr>
                        <td class="elementos-pc">Internet:</td>
                        <td>
                            <?php 
                                    if($traer['conexion_internet']==1){
                                        echo "Si";}
                                    else{ 
                                    echo "No";}
                            ?> 
                        </td>
                        </tr>

                        <tr>
                        <td class="elementos-pc">Condición:</td>
                        <td> <?php echo $traer['condicion'] ;?></td>
                        </tr>
                        
                        <tr>
                        <td class="elementos-pc">Disponibilidad:</td>
                        <td>
                            <?php 
                                    if($traer['id_estado_f']==3){
                                        echo "Retirado";}
                            ?> 
                        </td>
                        </tr>

                        <tr>
                        <td class="elementos-pc">Fecha/Hora Retiro:</td>
                        <td> <?php echo $traer['fecha_hora_retiro'] ;?></td>
                        </tr>
                        </table>
                        <?php }?>
                        </main>
                        
        <?php
        }else{
        ?>
        <main>
        <img id="pc" src="../images/apps-pc.jpg" alt="imagen pc">
                    
        <h2><?php echo "No has retirado un equipo";}?></h2>
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
        }else{
            header('Location: ../php/error.php');
            die();
        }
    
    ?>
</body>
</html>