<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Sections-Styles.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <link rel="stylesheet" href="../css/crud/crud-style.css">
    <link rel="stylesheet" href="../css/crud/disp-crud.css">
    <title>Dispositivos</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==2){
            include('admin-header.php');
    ?>
    <main>
    <a title="Agregar Registro" class="create" href="../php/cruds/create-disp.php">Agregar Nuevo</a>
        <div class="main-container">
        <table class="crud">
            <thead class="crud-head">
                <tr>
                    <th>Dispositivo</th>
                    <th>Tipo</th>
                    <th>Internet</th>
                    <th>Cargador</th>
                    <th>Cámara</th>
                    <th>Condiciones</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="crud-body">
                    <?php
                        include('../php/cruds/dispositivos-clase.php');
                        $dispositivo= new dispositivo();
                        $vista=$dispositivo->read();
                        while($row=mysqli_fetch_object($vista)){
                            $num_computadora=$row->num_computadora; 
                            $tipo_pc=$row->tipo_pc; 
                            $estado=$row->estado;
                            $cargador=$row->cargador;
                            $conexion_internet=$row->conexion_internet;
                            $camara=$row->camara;
                            $condicion=$row->condicion;
                            $id_computadora=$row->id_computadora;
                            if($cargador==0){
                                $cargador="NO";
                            }
                            elseif($cargador==1){
                                $cargador="SI";
                            }
                            if($camara==0){
                                $camara="NO";
                            }
                            elseif($camara==1){
                                $camara="SI";
                            }
                            if($conexion_internet==0){
                                $conexion_internet="NO";
                            }
                            elseif($conexion_internet==1){
                                $conexion_internet="SI";
                            }
                    ?>
                        <tr>
                            <td><?php echo $num_computadora?></td>
                            <td><?php echo $tipo_pc?></td>
                            <td><?php echo $conexion_internet?></td>
                            <td><?php echo $cargador?></td>
                            <td><?php echo $camara?></td>
                            <td><?php echo $condicion?></td>
                            <td><?php echo $estado?></td>
                            <td>
                                <a title="Editar Registro" class="edit" href="../php/cruds/edit-disp.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/edit_white_24dp.svg" alt="edit"></a>
                                <a title="Eliminar Registro" class="delete" href="registro-admin.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/delete_white_24dp.svg" alt="delete"></a>
                            </td>
                        </tr>
                    <?php
                        }
                        if(isset($_GET['id'])){
                            echo "<input type='checkbox' name='delete-alert' id='delete-alert' class='delete-alert' checked>";
                            $id_computadora=$_GET['id'];
                        }
                    ?>
                    <div class="modal-window">
                        <div class="modal-window-content">
                            <h2>Campus Virtual pregunta:</h2>
                            <p>¿Está seguro que desea eliminar este Dispositivo?</p>
                            <div class="options-container">
                                <label class="modal-window-option" title="Cacelar Operación" for="delete-alert">Cancelar</label>
                                <a class="modal-window-option" title="Eliminar Registro" href="../php/cruds/delete-disp.php?id=<?php echo $id_computadora?>">Aceptar</a>
                            </div>
                        </div>
                    </div>
            </tbody>
            <tfoot class="crud-foot">
                <tr>
                    <td colspan="8"></td>
                </tr>
            </tfoot>
        </table>
        </div>
    </main>
    <aside>
        <input class="slider-menu" type="checkbox" id="slide">
        <label for="slide"><img title="Menú" class="menu-icon1" src="../icons/bx-menu.svg" alt="menu"></label>
        <div class="dashboard-container">
            <div class="aside-background"> Dashboard</div>
            <label for="slide"><img title="Menú" class="menu-icon" src="../icons/bx-menu.svg" alt="menu"></label>
            <div class="separador"></div>
            <section class="menu-container">
                <input type="checkbox" class="registro-pc" checked>
                <a class=" menu section-style" href="../php/registro-admin.php" title="Dispositivos">Dispositivos</a>
                <img class="menu-icon pc" src="../icons/bx-card.svg" alt="card">
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
            die();
        }
    ?>
    
</body>
</html>