<?php
function validate_name(){
    global $nombre;
    global $salida1;
    global $long_name;
    for($i=0; $i<$long_name;$i++){
        if(is_string($nombre[$i])){
            if($nombre[$i]==" "){
                $salida1="FALSE";
            }
            if(is_numeric($nombre[$i])){
                $salida1="TRUE";
            }
            if(!ctype_alnum($nombre[$i])){
                $salida1="FALSE";
            }
        }
        else{
            $salida1="FALSE";
        }
    }
    return $salida1;
}

include('../php/coneccion.php');

$nombre=$_REQUEST['username'];
$password=$_REQUEST['password'];

$long_name=strlen($nombre);
$long_pass=strlen($password);

$salida1;
$salida2;
$salida3;
//-----------------Validacion del Username------------------------
for($i=0; $i<$long_name; $i++){
    if(is_string($nombre[$i])){
        if($nombre[$i]!=" "){
            if(ctype_alnum($nombre[$i])){
                $salida1="TRUE";
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
    }
    else{
        header('Location: ../php/error.php');
        die();
    }
}
//----------------Validacion del Password------------------------
for($i=0; $i<$long_pass; $i++){
    if(is_string($password[$i])){
        if($password[$i]!=" "){
            if(ctype_alnum($password[$i])){
                $salida2="TRUE";
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
    }
    else{
        header('Location: ../php/error.php');
        die();
    }
}

//------------------Encriptación del Password Ingresado----------------------
if($salida1=="TRUE" && $salida2=="TRUE"){
    $getPassword=mysqli_query($coneccion, "SELECT password_user FROM `usuarios` WHERE nombre_usuario='$nombre'");
    if(mysqli_num_rows($getPassword)==1){
        $row=mysqli_fetch_array($getPassword);
        $criptPassword=$row['password_user'];
    }
    if(password_verify($password, $criptPassword)){
        $salida3="TRUE";
    }
    else{
        $salida3="FALSE";
    }
}
//---------------------------------------------------------------------------

if($salida3=="TRUE"){
    
    $ejecutar= mysqli_query($coneccion, "SELECT * FROM `usuarios` WHERE nombre_usuario='$nombre' AND password_user='$criptPassword'");

    while ($mostrar=mysqli_fetch_array($ejecutar)){
        $rango= $mostrar['id_rango_f'];
        $nombre= $mostrar['nombre_usuario'];
        $contra= $mostar['password_user'];
        $real_name=$mostrar['nombre'];
        $apellido=$mostrar['apellido'];
    }

    if($rango==2){
        session_start();
        $_SESSION['nombre']=$nombre;
        $_SESSION['password']=$contra;
        $_SESSION['permiso']=$rango;
        $_SESSION['realName']=$real_name;
        $_SESSION['apellido']=$apellido;
        header('Location:../php/admin-page.php');
        die();
    }
    elseif($rango==1){
        session_start();
        $_SESSION['nombre']=$nombre;
        $_SESSION['password']=$contra;
        $_SESSION['permiso']=$rango;
        $_SESSION['realName']=$real_name;
        $_SESSION['apellido']=$apellido;
        header('Location: ../php/user-page.php');
        die();
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
