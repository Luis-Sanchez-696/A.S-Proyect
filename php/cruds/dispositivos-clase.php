<?php

    class dispositivo{
        private $connect;
        private $dbhost="localhost";
        private $dbuser="root";
        private $dbpass="";
        private $dbname="as_project";

        function __construct(){
            $this->connect_db();
        }
        public function connect_db(){
            $this->connect=mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if(mysqli_connect_error()){
                die("Conexión Fallida" . mysqli_connect_error() . mysqli_connect_errno());
            }
        }
        public function create($num_computadora, $id_tipo_pc_f, $id_estado_f, $cargador, $conexion_internet, $camara, $condicion){
            $sql="INSERT INTO `computadoras` (num_computadora, id_tipo_pc_f, id_estado_f, cargador, conexion_internet, camara, condicion) VALUES ('$num_computadora', '$id_tipo_pc_f', '$id_estado_f', '$cargador', '$conexion_internet', '$camara', '$condicion')";
            $insertar=@mysqli_query($this->connect, $sql);
            if($insertar){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        public function read(){
            $sql="SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado)";
            $read=@mysqli_query($this->connect, $sql);
            return $read;
        }
        public function getter($id_computadora){
            $sql="SELECT DISTINCT computadoras.id_computadora, computadoras.num_computadora, computadora_tipo.tipo_pc, computadoras.cargador, computadoras.conexion_internet, computadoras.camara, computadoras.condicion, estado_tipo.estado FROM `computadoras` LEFT JOIN `computadora_tipo` ON (computadoras.id_tipo_pc_f=computadora_tipo.id_tipo_pc) LEFT JOIN `estado_tipo` ON (computadoras.id_estado_f=estado_tipo.id_estado) WHERE id_computadora='$id_computadora'";
            $get=@mysqli_query($this->connect, $sql);
            $return=mysqli_fetch_object($get);
            return $return;
        }
        public function update($id_computadora, $num_computadora, $id_tipo_pc_f, $id_estado_f, $cargador, $conexion_internet, $camara, $condicion){
            $sql="UPDATE `computadoras` SET num_computadora='$num_computadora', id_tipo_pc_f='$id_tipo_pc_f', id_estado_f='$id_estado_f', cargador='$cargador', conexion_internet='$conexion_internet', camara='$camara', condicion='$condicion' WHERE id_computadora='$id_computadora'";
            $update=@mysqli_query($this->connect, $sql);
            if($update){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        public function delete($id_computadora){
            $sql="DELETE FROM `computadoras` WHERE id_computadora='$id_computadora'";
            $delete=@mysqli_query($this->connect, $sql);
            if($delete){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
    }

?>