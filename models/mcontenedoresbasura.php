<?php
require_once __DIR__ . '/../models/conexion.php';

class MContenedoresBasura extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function crearContenedorBasura($nombre, $imageData, $descripcionContenedor) {
        $base64Image = base64_encode($imageData);
        $nombre = ($nombre === '') ? NULL : $nombre;
        $descripcionContenedor = ($descripcionContenedor === '') ? NULL : $descripcionContenedor;
        $imageData = ($imageData === '') ? NULL : $imageData;
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
        $stmt = $this->conexion->prepare("INSERT INTO basura (nombre, descripcion, id_contenedor) VALUES (?, ?, ?)");
        $stmt->bind_param('ssi', $nombreBasura, $descripcionBasura, $idContenedor);
        $stmt->execute();
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
        $sqlSelect = "SELECT contenedores.id_contenedor, contenedores.nombre AS nombre_contenedor, contenedores.img AS imagen_contenedor,
            contenedores.descripcion AS descripcion_contenedor,
            basura.id_basura, basura.nombre AS nombre_basura, basura.descripcion AS descripcion_basura FROM contenedores
            INNER JOIN basura ON contenedores.id_contenedor = basura.id_contenedor
            WHERE contenedores.id_contenedor = ?";
        $conexion2 = $this->conexion->prepare($sqlSelect);
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
        try{
            $base64Image = base64_encode($imageData);
            $nombre = ($nombre === '') ? NULL : $nombre;
            $descripcion = ($descripcion === '') ? NULL : $descripcion;
            $base64Image = ($base64Image === '') ? NULL : $base64Image;
        
            $sql = "UPDATE contenedores SET nombre = ?, img = ?, descripcion = ? WHERE id_contenedor = ?";
            $conexion = $this->conexion->prepare($sql);
            $conexion->bind_param("sssi", $nombre, $base64Image, $descripcion, $id);
            // echo 'Consulta: ' . $sql . ' con valores: nombre=' . (($nombre === NULL) ? 'vacio' : $nombre) . ', descripcion=' . $descripcion . ', id_contenedor=' . $id;
        
            if ($conexion->execute()){
                $conexion->close();
                return true;
            } else {
                throw new Exception($consulta->error, $consulta->errno);
            }
        } catch (Exception $error) {
            $numeroError = $error->getCode();
            return $numeroError;
        }
    }  
}
?>
