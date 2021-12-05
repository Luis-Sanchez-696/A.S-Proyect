<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Estilos-del-Login.css">
    <link rel="shotcut icon" href="../images/Logo-Santa-Fe.png">
    <title>Login</title>
</head>
<body>
    <form class="login" action="../php/validacion-de-usuario.php" method="POST">
        <h1 class="validar">Iniciar Sesión</h1>
        <input class="form1 username" name="username" type="text" placeholder="Nombre de Usuario" required>
        <img class="login-icon" src="../icons/bx-user.svg" alt="key">
        <input class="form1 password" name="password" type="password" placeholder="Contraseña" required >
        <img class="login-icon" src="../icons/bxs-key.svg" alt="key">
        <a class="restore-password" href="../php/recuperacion.php">¿Olvidaste tu Contraseña?</a>
        <input class="form1 submitlogin" type="submit" value="Iniciar" title="Iniciar Sesión" name="validar">
    </form>
</body>
</html>