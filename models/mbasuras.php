<?php
require_once __DIR__ . '/../models/conexion.php';

class MBasura extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function agregarBasura($nombreBasura, $descripcionBasura,$id_contenedor) {
        $nombreBasura = ($nombreBasura === '') ? NULL : $nombreBasura;
        $descripcionBasura = ($descripcionBasura === '') ? NULL : $descripcionBasura;
        $stmt = $this->conexion->prepare("INSERT INTO basura (nombre, descripcion, id_contenedor) VALUES (?, ?, ?)");
        $stmt->bind_param('ssi', $nombreBasura, $descripcionBasura, $id_contenedor);
        if($stmt->execute()){
            return true;
        }
    }
    
    public function msacarcontenedores(){
        $sql = "SELECT id_contenedor, nombre FROM contenedores";
        $conexion = $this->conexion->prepare($sql);
        $conexion->execute();
        $datos = [];
    
        $result = $conexion->get_result();
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
        $conexion->close();
    
        return $datos;
    }
    

    public function listadoBasura() {
        $sql = "SELECT * FROM basura";
        $conexion = $this->conexion->prepare($sql);
        $conexion->execute();
        $datos = [];
    
        $result = $conexion->get_result();
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
        $conexion->close();
    
        return $datos;
    }

    public function mBorrarBasura($id_basura) {
        $sqlDelete = "DELETE FROM basura WHERE id_basura = ?";
        $conexion = $this->conexion->prepare($sqlDelete);
        $conexion->bind_param("i", $id_basura);
        return $conexion->execute();
    }

    
}
?>
