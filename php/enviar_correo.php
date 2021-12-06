    <head>
    <link rel="stylesheet" href="../css/sección-atributos-pc.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Reserva</title>
    </head>
    <body>
    <?php
    session_start();
        if(isset($_SESSION['nombre']) && $_SESSION['permiso']==1){
        if($_SESSION['disponibilidad']==1){
    ?>

    <?php
        $usuario=$_SESSION['nombre'];
        $id_usuario=$_SESSION['id_usuario'];
        $id_pc=$_GET['idpc'];
        $condicion=$_GET['acertar'];
        $condicion;
    include('coneccion.php');

        $consulta="SELECT id_usuario,nombre_usuario,password_user,e_mail FROM `usuarios` WHERE id_usuario='$id_usuario' AND nombre_usuario='$usuario'";
        $datos=@mysqli_query($coneccion,$consulta); 

//-----------------------------------------------------------------------------------------

            while ($mostrar=mysqli_fetch_array($datos)) {
                $id=$mostrar['id_usuario'];
                $nombre_usuario=$mostrar['nombre_usuario'];
                $contraseña=$mostrar['password_user'];
                $email=$mostrar['e_mail'];
                }
    include("Mailer/src/PHPMailer.php");
    include("Mailer/src/SMTP.php");
    include("Mailer/src/Exception.php");
    include("Mailer/src/OAuth.php");
        $emailTo=$email;
        $subject= 'Reserva de computadora' ;
        $bodyemail="Hola ".$nombre_usuario.", has reservador el equipo N° ".$id_pc.". Para retirar el equipo debes mostrar este mensaje en el gabinete de PC. Gracias";//asunto;


        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $emailre="gabinete_computadoras@outlook.com";
        $formname="Personal del gabinete de PC";
        $host="smtp.office365.com";
        $port="587";
        $SMTPAuth="Login";
        $SMTPSecure="STARTTLS";
        $password="DomingoGusmanSilva2021";

        $mail = new PHPMailer\PHPMailer\PHPMailer();
            try {
                $mail->isSMTP();
                $mail->SMTPDebug=0;
                $mail->Host = $host;
                $mail->Port =$port;
                $mail->SMTPAuth = $SMTPAuth;
                $mail->SMTPSecure =$SMTPSecure;
                $mail->Username = $emailre;
                $mail->Password = $password;
    /*$mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>true
        )
        );
        */
        
                $mail->setfrom($emailre, $formname);
                $mail->addAddress($emailTo);//dirección de correo al cual le vamos a enviar nuestro correo
                $mail->isHTML(true);
                $mail->SubjecT = $subject; 
                $mail->Body = $bodyemail;
    ?>
    <?php  
        $reservas_counter=@mysqli_query($coneccion, "SELECT reservaciones FROM `usuarios` WHERE id_usuario='$id_usuario'");
        if($row=mysqli_fetch_array($reservas_counter)){
            $counter=$row['reservaciones'];
        }
        if($counter==0){
        if(!$mail->send()){
    ?> 
        <div class="ventana-reserva">
        <H1 class="reserva-no-realizada" > No se pudo realizar la reserva</H1>
        <h5>EL MENSAJE NO SE HA ENVIADO, CONSULTA CON EL PERSONAL DEL GABINETE DE COMPUTADORAS</h5>
        <a class="return-user-page" href="user-page.php">Volver</a>
        </div>
    <?php
        }
        else{
            $update="UPDATE `computadoras` SET id_estado_f=2 WHERE id_computadora='$id_pc'";
            $query=@mysqli_query($coneccion,$update);
            if(isset($update)){
                $set_reserva=@mysqli_query($coneccion, "UPDATE `usuarios` SET reservaciones=1 WHERE id_usuario='$id_usuario'");
            }
        }
    ?>
    <div class="ventana-reserva">
        <H1> ¡Reserva exitosa!</H1>
        <p>Te llegará un mensaje a tu email del equipo reservado.</p>
        <h5>DEBES MOSTRAR EL MENSAJE AL PERSONAL DEL GABINETE DE COMPUTADORAS</h5>
        <a class="return-user-page" href="user-page.php">Volver</a>
    </div>

    <?php    
    }
    else{
        ?>
            <div class="reserva-error">
                Lo sentimos, pero no puede realizar otra reserva hasta no devolver el dispositivo que aún tiene en posesión.
            </div>
            <?php
    }
        
    } catch(exception $e){
    
    }
        }
    }else{
    header('Location: ../php/error.php');
    die();
    }
    ?>
