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

        $segunda_consulta="SELECT computadoras.id_computadora,computadoras.num_computadora, computadora_tipo.id_tipo_pc,computadora_tipo.tipo_pc FROM computadoras LEFT JOIN `computadora_tipo` ON(computadora_tipo.id_tipo_pc=computadoras.id_tipo_pc_f) WHERE computadoras.id_computadora='$id_pc'";
        $consulta="SELECT id_usuario,nombre_usuario,password_user,e_mail FROM `usuarios` WHERE id_usuario='$id_usuario' AND nombre_usuario='$usuario'";
        $datos=@mysqli_query($coneccion,$consulta); 
        $datos_pc=@mysqli_query($coneccion, $segunda_consulta);

//-----------------------------------------------------------------------------------------

            while ($mostrar=mysqli_fetch_array($datos)) {
                $id=$mostrar['id_usuario'];
                $nombre_usuario=$mostrar['nombre_usuario'];
                $contraseña=$mostrar['password_user'];
                $email=$mostrar['e_mail'];
                }

            $regisro_pc=mysqli_fetch_array($datos_pc); 
            $num_pc=$regisro_pc['num_computadora'];
            $tipo_pc=$regisro_pc['tipo_pc'];

    include("Mailer/src/PHPMailer.php");
    include("Mailer/src/SMTP.php");
    include("Mailer/src/Exception.php");
    include("Mailer/src/OAuth.php");
        $emailTo=$email;
        $subject= 'Reserva de computadora' ;
        $bodyemail="Hola ".$nombre_usuario.", has reservado la ".$tipo_pc." Numero ".$num_pc.". Para retirar el equipo debes mostrar este mensaje en el gabinete de PC. Gracias";//asunto;


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
            <div class="ventana-reserva">
            <H1  id="ya-reservado"> YA HAS RESERVADO UN EQUIPO</H1>
            <p id="text-reserva-no-realizada">SI DESEA OTRO EQUIPO, ENVÍA UN MAIL AL PERSONAL DEL GABINETE PARA DAR DE BAJA LA RESERVA ACTUAL, O DEVUELVE EL EQUIPO EN POSESIÓN</p>
            <a class="return-user-page" href="user-page.php">Volver</a>
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
