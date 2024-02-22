<?php
require_once __DIR__ . '/../models/conexion.php';

class MBasura extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function agregarBasura($nombreBasura, $descripcionBasura,$id_contenedor) {
        try {
            $conexion = $this->conexion->prepare("INSERT INTO basura (nombre, descripcion, id_contenedor) VALUES (?, ?, ?)");
            $conexion->bind_param('ssi', $nombreBasura, $descripcionBasura, $id_contenedor);
            if ($conexion->execute()){
                $conexion->close();
                return true;
            } else {
                throw new Exception($conexion->error, $conexion->errno);
            }
        } catch (Exception $error) {
            $numeroError = $error->getCode();
            return $numeroError;
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
        $resultado = $conexion->execute();
        $conexion->close();
    
        return $resultado;
    }
    

    public function msacarBasura($id_basura) {
        $sql = "SELECT * FROM basura WHERE id_basura = ?";
        $conexion = $this->conexion->prepare($sql);
        $conexion->bind_param("i", $id_basura);
        $conexion->execute();
        $datos = [];
    
        $result = $conexion->get_result();
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
        $conexion->close();
    
        return $datos;
    }
    
}
?>
