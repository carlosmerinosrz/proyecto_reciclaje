<?php

class Conexion {
    public $conexion;

    public function __construct(){
        require_once __DIR__ . '/../config/configdb.php';

        $this->conexion = new mysqli(SERVIDOR, USUARIO, CONTRASENIA, BBDD);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    
        $this->conexion->set_charset("utf8");

        // Activar el modo estricto en esta conexión
        $this->conexion->query("SET SESSION sql_mode = 'STRICT_ALL_TABLES'");
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }
}

?>
