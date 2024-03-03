<?php
require_once __DIR__ . '/../models/conexion.php';

class MContenedoresBasura extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function crearContenedorBasura($nombre, $imageData, $descripcionContenedor) {
        $base64Image = base64_encode($imageData);
        try {
            $sql = "INSERT INTO contenedores (nombre, img, descripcion) VALUES (?, ?, ?)";
            $conexion = $this->conexion->prepare($sql);
            $conexion->bind_param("sss", $nombre, $base64Image, $descripcionContenedor);
        
            if ($conexion->execute())
                return $this->conexion->insert_id;
        } catch (Exception $e) {
            throw $e; 
        }
    }

    public function agregarBasura($idContenedor, $nombreBasura, $descripcionBasura) {
        $descripcionBasura = ($descripcionBasura === '') ? NULL : $descripcionBasura;
        $consulta = $this->conexion->prepare("INSERT INTO basura (nombre, descripcion, id_contenedor) VALUES (?, ?, ?)");
        $consulta->bind_param('ssi', $nombreBasura, $descripcionBasura, $idContenedor);
        $consulta->execute();
    }
    
    public function listarContenedores() {
        $sql = "SELECT * FROM contenedores";
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

    public function mBorrarContenedor($id) {
        $sqlDelete = "DELETE FROM contenedores WHERE id_contenedor = ?";
        $conexion2 = $this->conexion->prepare($sqlDelete);
        $conexion2->bind_param("i", $id);
        return $conexion2->execute();
    }

    public function mObtenerContenedorBasura($id) {
        $sql = "SELECT contenedores.id_contenedor, contenedores.nombre AS nombre_contenedor, contenedores.img AS imagen_contenedor,
            contenedores.descripcion AS descripcion_contenedor,
            basura.id_basura, basura.nombre AS nombre_basura, basura.descripcion AS descripcion_basura FROM contenedores
            LEFT JOIN basura ON contenedores.id_contenedor = basura.id_contenedor
            WHERE contenedores.id_contenedor = ?";
        $conexion2 = $this->conexion->prepare($sql);
        $conexion2->bind_param("i", $id);
        $conexion2->execute();
    
        $resultados = array();
        
        $datos = $conexion2->get_result();
        
        while ($fila = $datos->fetch_assoc()) {
            $resultados[] = $fila;
        }
        return $resultados;
    }

    public function mObtenerContenedor($id){
        $sql = "SELECT * FROM contenedores WHERE id_contenedor = ?";
        $conexion = $this->conexion->prepare($sql);
        $conexion->bind_param("i", $id);
        $conexion->execute();

        $datos = $conexion->get_result();
        while ($fila = $datos->fetch_assoc()){
            $resultados[] = $fila;
        }
        return $resultados;
    }
    
    public function mmodifcontenedor($id, $nombre, $descripcion, $imageData){
        try {
            $base64Image = ($imageData !== NULL) ? base64_encode($imageData) : NULL;
            $sql = "UPDATE contenedores SET nombre = ?, descripcion = ?";
     
            if($base64Image !== NULL){
                $sql .= ", img = ?";
            }
            $sql .= " WHERE id_contenedor = ?";
            $conexion = $this->conexion->prepare($sql);
    
            if ($base64Image !== null) {
                $conexion->bind_param("sssi", $nombre, $descripcion, $base64Image, $id);
            } else {
                $conexion->bind_param("ssi", $nombre, $descripcion, $id);
            }
            
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
    
    
    public function borrarBasurasContenedores($id){
        $sql = "DELETE FROM basura WHERE id_contenedor = ?";
        $conexion = $this->conexion->prepare($sql);
        $conexion->bind_param("i", $id);
        $resultado = $conexion->execute();
        $conexion->close();
        return $resultado;
    }
    
    public function crearBasurasNuevas($nombreBasura, $descripcionBasura, $idContenedor) {
        $sql = "INSERT INTO basura (nombre, descripcion, id_contenedor) VALUES (?, ?, ?)";
        $conexion = $this->conexion->prepare($sql);
        $conexion->bind_param('ssi', $nombreBasura, $descripcionBasura, $idContenedor);
        $resultado = $conexion->execute();
        $conexion->close();
        return $resultado;
    }
    
    public function crearContenedorSinBasura($nombre, $imageData, $descripcionContenedor) {
        $base64Image = base64_encode($imageData);
        try {
            $sql = "INSERT INTO contenedores (nombre, img, descripcion) VALUES (?, ?, ?)";
            $conexion = $this->conexion->prepare($sql);
            $conexion->bind_param("sss", $nombre, $base64Image, $descripcionContenedor);
        
            if($conexion->execute()){
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
}
?>
