<?php

$coneccion= @mysqli_connect('localhost', 'root', '', 'as_project');
if(!$coneccion){
    echo "error de coneccion<br>";
}

?>