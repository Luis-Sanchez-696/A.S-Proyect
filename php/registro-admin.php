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
            if($_SESSION['disponibilidad']==1){
            include('admin-header.php');
    ?>
    <main>
        <div class="head-options-container">
        <div class="disp-search">
            <form action="../php/registro-admin.php">
                <input type="text" name="search" class="disp-search-input" placeholder="Búsqueda" required>
                <select class="disp-search-input" name="filtro" id="filtro" required>
                    <option value="numero" >Número de Dispositivo</option>
                    <option value="tipo">Tipo de Dispositivo</option>
                    <option value="estado">Estado del Dispositivo</option>
                </select>
                <button title="Buscar" type="submit" name="enviar" class="disp-search-button"><img src="../icons/search_white_24dp.svg" alt="disp-search-icon"></button>
            </form>
        </div>
        <a title="Agregar Registro" class="create" href="../php/cruds/create-disp.php">Agregar Nuevo</a>
        </div>
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
                    if(isset($_REQUEST['enviar'])){
                        include('../php/coneccion.php');
                        $search=$_REQUEST['search'];
                        $filter=$_REQUEST['filtro'];
                        switch($filter){
                            case 'numero':
                                $numero_salida="FALSE";
                                $long_search=strlen($search);
                                for($i=0; $i<$long_search; $i++){
                                    if(is_string($search[$i])){
                                        if(is_numeric($search[$i])){
                                            $numero_salida="TRUE";
                                        }
                                        else{
                                            $numero_salida="FALSE";
                                            break;
                                        }
                                    }
                                    else{
                                        $numero_salida="FALSE";
                                        break;
                                    }
                                }
                                if($numero_salida=="TRUE" && ($search>0 && $search<999)){
                                    $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE computadoras.num_computadora='$search'");
                                    if($get_register){
                                        while($row=mysqli_fetch_array($get_register)){
                                            $num_computadora=$row['num_computadora']; 
                                            $tipo_pc=$row['tipo_pc']; 
                                            $estado=$row['estado'];
                                            $cargador=$row['cargador'];
                                            $conexion_internet=$row['conexion_internet'];
                                            $camara=$row['camara'];
                                            $condicion=$row['condicion'];
                                            $id_computadora=$row['id_computadora'];
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
                                                    <?php
                                                        if($estado=="Reservado"){
                                                            ?>
                                                            <a title="Retirar" class="retiro" href="../php/registro-admin.php?id2=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/check_circle_white_24dp.svg" alt="retirar-disp-icon"></a>
                                                            <?php
                                                        }
                                                    ?>
                                                        <a title="Ver Detalles" class="perfil" href="../php/cruds/perfil-computadora.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/info_white_24dp.svg" alt="perfil-pc"></a>
                                                        <a title="Editar Registro" class="edit" href="../php/cruds/edit-disp.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/edit_white_24dp.svg" alt="edit"></a>
                                                        <a title="Eliminar Registro" class="delete" href="registro-admin.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/delete_white_24dp.svg" alt="delete"></a>                            </td>
                                                </tr>
                                            <?php
                                        }
                                        if(isset($id_computadora)){
                                            $mensaje="La búsqueda del dispositivo ha sido realizada con éxito.";
                                        }
                                        else{
                                            $mensaje="Lo sentimos, pero el dispositivo no fue encontrado. <br> Es posible que el mismo no se encuentre cargado al sistema.";
                                        }
                                    }
                                    else{
                                        $mensaje="Lo sentimos, pero el dispositivo no pudo encontrarse. Puede que el mismo no se encuentre registrado en el sistema.";
                                    }
                                }
                                else{
                                    $mensaje="Lo sentimos, pero el dispositivo no pudo encontrarse. Puede que se introdujera un valor erroneo en la búsqueda. <br> Por favor, intentelo de nuevo y revise bien sus ingresos en la búsqueda.";
                                }
                                break;
                            case 'estado':
                                $estado_salida="FALSE";
                                $long_search=strlen($search);
                                for($i=0; $i<$long_search; $i++){
                                    if(is_string($search[$i])){
                                        if(ctype_alnum($search[$i])){
                                            $estado_salida="TRUE";
                                        }
                                        else{
                                            if($search[$i]==' '){
                                                $estado_salida="TRUE";
                                            }
                                            else{
                                                $estado_salida="FALSE";
                                                break;
                                            }
                                        }
                                    }
                                    else{
                                        $estado_salida="FALSE";
                                        break;
                                    }
                                }
                                if($estado_salida=="TRUE"){
                                    $search=strtolower($search);
                                    switch($search){
                                        case 'disponible':
                                            $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE estado_tipo.estado='Disponible'");
                                            break;
                                        case 'reservado':
                                            $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE estado_tipo.estado='Reservado'");
                                            break;
                                        case 'retirado':
                                            $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE estado_tipo.estado='Retirado'");
                                            break;
                                        case 'no disponible':
                                            $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE estado_tipo.estado='No Disponible'");
                                            break;
                                        default:
                                            $get_register=0;
                                            break;
                                    }
                                    if($get_register){
                                        while($row=mysqli_fetch_array($get_register)){
                                            $num_computadora=$row['num_computadora']; 
                                            $tipo_pc=$row['tipo_pc']; 
                                            $estado=$row['estado'];
                                            $cargador=$row['cargador'];
                                            $conexion_internet=$row['conexion_internet'];
                                            $camara=$row['camara'];
                                            $condicion=$row['condicion'];
                                            $id_computadora=$row['id_computadora'];
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
                                                    <?php
                                                        if($estado=="Reservado"){
                                                            ?>
                                                            <a title="Retirar" class="retiro" href="../php/registro-admin.php?id2=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/check_circle_white_24dp.svg" alt="retirar-disp-icon"></a>
                                                            <?php
                                                        }
                                                    ?>
                                                        <a title="Ver Detalles" class="perfil" href="../php/cruds/perfil-computadora.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/info_white_24dp.svg" alt="perfil-pc"></a>
                                                        <a title="Editar Registro" class="edit" href="../php/cruds/edit-disp.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/edit_white_24dp.svg" alt="edit"></a>
                                                        <a title="Eliminar Registro" class="delete" href="registro-admin.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/delete_white_24dp.svg" alt="delete"></a>                            </td>
                                                </tr>
                                            <?php
                                        }
                                        if(isset($id_computadora)){
                                            $mensaje="La búsqueda del dispositivo ha sido realizada con éxito.";
                                        }
                                        else{
                                            $mensaje="Lo sentimos, pero el dispositivo no fue encontrado. <br> Es posible que el mismo no se encuentre cargado al sistema.";
                                        }
                                    }
                                    else{
                                        $mensaje="Lo sentimos, pero el dispositivo no pudo encontrarse. Puede que el mismo no se encuentre registrado en el sistema.";
                                    }
                                }
                                else{
                                    $mensaje="Lo sentimos, pero el dispositivo no pudo encontrarse. Puede que se introdujera un valor erroneo en la búsqueda. <br> Por favor, intentelo de nuevo y revise bien sus ingresos en la búsqueda.";
                                }
                                break;
                            case 'tipo':
                                $tipo_salida="FALSE";
                                $long_search=strlen($search);
                                for($i=0; $i<$long_search; $i++){
                                    if(is_string($search[$i])){
                                        if(ctype_alnum($search[$i])){
                                            $tipo_salida="TRUE";
                                        }
                                        else{
                                            $tipo_salida="FALSE";
                                        }
                                    }
                                    else{
                                        $tipo_salida="FALSE";
                                    }
                                }
                                if($tipo_salida=="TRUE"){
                                    $search=strtolower($search);
                                    switch($search){
                                        case 'notebook':
                                            $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE computadora_tipo.tipo_pc='Notebook'");
                                            break;
                                        case 'netbook':
                                            $get_register=@mysqli_query($coneccion, "SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE computadora_tipo.tipo_pc='Netbook'");
                                            break;
                                        default:
                                            $get_register=0;
                                            break;
                                    }
                                    if($get_register){
                                        while($row=mysqli_fetch_array($get_register)){
                                            $num_computadora=$row['num_computadora']; 
                                            $tipo_pc=$row['tipo_pc']; 
                                            $estado=$row['estado'];
                                            $cargador=$row['cargador'];
                                            $conexion_internet=$row['conexion_internet'];
                                            $camara=$row['camara'];
                                            $condicion=$row['condicion'];
                                            $id_computadora=$row['id_computadora'];
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
                                                    <?php
                                                        if($estado=="Reservado"){
                                                            ?>
                                                            <a title="Retirar" class="retiro" href="../php/registro-admin.php?id2=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/check_circle_white_24dp.svg" alt="retirar-disp-icon"></a>
                                                            <?php
                                                        }
                                                    ?>
                                                        <a title="Ver Detalles" class="perfil" href="../php/cruds/perfil-computadora.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/info_white_24dp.svg" alt="perfil-pc"></a>
                                                        <a title="Editar Registro" class="edit" href="../php/cruds/edit-disp.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/edit_white_24dp.svg" alt="edit"></a>
                                                        <a title="Eliminar Registro" class="delete" href="registro-admin.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/delete_white_24dp.svg" alt="delete"></a>                            </td>
                                                </tr>
                                            <?php
                                        }
                                        if(isset($id_computadora)){
                                            $mensaje="La búsqueda del dispositivo ha sido realizada con éxito.";
                                        }
                                        else{
                                            $mensaje="Lo sentimos, pero el dispositivo no fue encontrado. <br> Es posible que el mismo no se encuentre cargado al sistema.";
                                        }
                                    }
                                    else{
                                        $mensaje="Lo sentimos, pero el dispositivo no pudo encontrarse. Puede que el mismo no se encuentre registrado en el sistema.";
                                    }
                                }
                                else{
                                    $mensaje="Lo sentimos, pero el dispositivo no pudo encontrarse. Puede que se introdujera un valor erroneo en la búsqueda. <br> Por favor, intentelo de nuevo y revise bien sus ingresos en la búsqueda.";
                                }
                                break;
                        }
                    }
                    else{
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
                                    <?php
                                        if($estado=="Reservado"){
                                            ?>
                                            <a title="Retirar" class="retiro" href="../php/registro-admin.php?id2=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/check_circle_white_24dp.svg" alt="retirar-disp-icon"></a>
                                            <?php
                                        }
                                    ?>
                                    <a title="Ver Detalles" class="perfil" href="../php/cruds/perfil-computadora.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/info_white_24dp.svg" alt="perfil-pc"></a>
                                    <a title="Editar Registro" class="edit" href="../php/cruds/edit-disp.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/edit_white_24dp.svg" alt="edit"></a>
                                    <a title="Eliminar Registro" class="delete" href="registro-admin.php?id=<?php echo $id_computadora?>"><img class="crud-action" src="../icons/delete_white_24dp.svg" alt="delete"></a>                            </td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
            </tbody>
            <tfoot class="crud-foot">
                <tr>
                    <td colspan="8"></td>
                </tr>
            </tfoot>
        </table>
        <?php
            if(isset($_GET['id'])){
                echo "<input type='checkbox' name='delete-alert' id='delete-alert' class='delete-alert' checked>";
                $id_computadora=$_GET['id'];
            }
        ?>
        <div class="modal-window">
            <div class="modal-window-content">
                <h2>Campus Virtual pregunta:</h2>
                <p>¿Está seguro que desea Eliminar este Dispositivo?</p>
                <div class="options-container">
                    <a class="modal-window-option cancel" title="Cancelar Operación" href="../php/registro-admin.php">Cancelar</label>
                    <a class="modal-window-option" title="Eliminar Registro" href="../php/cruds/delete-disp.php?id=<?php echo $id_computadora?>">Aceptar</a>
                </div>
            </div>
        </div>
        <?php
            if(isset($_GET['id2'])){
                echo "<input type='checkbox' name='retiro-alert' id='retiro-alert' class='retiro-alert' checked>";
                $idComputadora=$_GET['id2'];
            }
        ?>
        <div class="modal-window-two">
            <div class="modal-window-content">
                <h2>Campus Virtual pregunta:</h2>
                <p>¿Está seguro que desea Retirar este Dispositivo?</p>
                <div class="options-container">
                    <a class="modal-window-option cancel" title="Cancelar Operación" href="../php/registro-admin.php">Cancelar</a>
                    <a class="modal-window-option" title="Retirar Dispositivo" href="../php/cruds/retirar-disp.php?id=<?php echo $idComputadora?>">Aceptar</a>
                </div>
            </div>
        </div>
        </div>
        <?php
            if(isset($mensaje)){
                if($mensaje=="La búsqueda del dispositivo ha sido realizada con éxito."){
                    ?>
                    <div class="search-confirm-message">
                        <?php echo $mensaje;?>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="search-error-message">
                        <?php echo $mensaje;?>
                    </div>
                    <?php
                }
            }
        ?>
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
        }
        else{
            header('Location: ../php/error.php');
            die();
        }
    ?>
    <script src="../js/evitar-reenvios.js"></script>
</body>
</html>