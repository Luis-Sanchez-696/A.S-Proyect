
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <link rel="stylesheet" href="../css/sección-atributos-pc.css">
    <title>Atributos de PC</title>
</head>
    <?php
        session_start();
            if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
            if($_SESSION['disponibilidad']==1){

        include('coneccion.php');
        $consulta2="SELECT computadoras.id_computadora,computadora_tipo.tipo_pc, computadoras.num_computadora,software.tipo_software,software.nombre_software FROM `computadoras` LEFT JOIN `sw_instalados` ON(sw_instalados.id_computadora_f=computadoras.id_computadora) LEFT JOIN `software` ON(software.id_software=sw_instalados.id_software_f) LEFT JOIN `computadora_tipo` ON (computadora_tipo.id_tipo_pc=computadoras.id_tipo_pc_f) GROUP BY computadoras.num_computadora,software.nombre_software";
        $result=@mysqli_query($coneccion,$consulta2);
        $consulta="SELECT computadoras.id_computadora,computadora_tipo.tipo_pc, computadoras.num_computadora, computadoras.cargador, computadoras.camara, computadoras.conexion_internet, computadoras.condicion,estado_tipo.estado,estado_tipo.id_estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadora_tipo.id_tipo_pc=computadoras.id_tipo_pc_f) LEFT JOIN `estado_tipo` ON (estado_tipo.id_estado=computadoras.id_estado_f)";
        $resultado=@mysqli_query($coneccion,$consulta);
        $id=$_GET['idpc'];
    ?>
        <body>
            <main>
                <img id="pc" src="../images/apps-pc.jpg">
                    <table class="pc"> 
                        <h1>Computadora N°: </h1>
    <?php
            while ($registro=mysqli_fetch_array($resultado)) {
                    if($id==$registro['id_computadora']){
    ?>
                        <p id="num_pc"><?php echo $registro['num_computadora'] ?></p>

                        <tr>
                        <td class="elementos-pc">Tipo PC:</td>
                        <td> <?php echo $registro['tipo_pc'] ;?></td>
                        </tr>
                
                        <tr>
                        <td class="elementos-pc">Cargador:</td>
                        <td>
                            <?php 
                                    if($registro['cargador']==1){
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
                                    if($registro['camara']==1){
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
                                    if($registro['conexion_internet']==1){
                                        echo "Si";}
                                    else{ 
                                    echo "No";}
                            ?> 
                        </td>
                        </tr>
    <?php
            }
    }?>
                    </table>

                    <table class="apps-pc"> 
                    <h3>Aplicaciones:</h3>
    <?php
            while($software=mysqli_fetch_array($result)){
                if($id==$software['id_computadora']){
    ?>
            <tr>
            <td class="elementos-pc"><?php echo $software['tipo_software'].":";?></td>
            <td><?php echo $software['nombre_software'];?></td>
            </tr>
                <?php   
                    }
                }
                
                ?>
        </table>
                    <a href="registro-usuario.php" class="volver">Volver</a>
                    <a href="#modal" class="reservar">Reservar</a>
                    <div id="modal" class="modal">
                        <div class="container">
                        <header>
                            <section>
                                <p id="pregunta">¿Está seguro de reservar este dispositivo?</p>
                                <a href="#" class="cerrar">No</a>
                                <?php $acertar="si"?>
                                <a href="enviar_correo.php?acertar=<?php echo $acertar ?>&idpc=<?php echo $id ?>" class="aceptar-reserva">Si</a>
                            </section>
                        </header>  
                        </div>
                    </div>
<?php
}
else{
    header('Location: ../php/error.php');
    die();
}
?>
            </main>
            <?php }else{
                header('Location:../php/error.php');
                die();
                }
                ?>
    </body>
</html>