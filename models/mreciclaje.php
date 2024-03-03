<?php
require_once __DIR__ . '/../models/conexion.php';

class MReciclaje extends Conexion{

    public function __construct(){
        parent::__construct();
    }

    public function listadoBasuraContenedor($id_contenedor) {
        if ($id_contenedor === 'NULL'){
            $sql = "SELECT b.id_basura, b.nombre AS nombre_basura, b.descripcion AS descripcion_basura, c.id_contenedor, c.nombre AS nombre_contenedor
            FROM basura b LEFT JOIN contenedores c ON b.id_contenedor = c.id_contenedor
            WHERE c.id_contenedor IS NULL;";
        }else{
            $sql = "SELECT b.id_basura, b.nombre AS nombre_basura, b.descripcion AS descripcion_basura, c.id_contenedor, c.nombre AS nombre_contenedor
            FROM basura b LEFT JOIN contenedores c ON b.id_contenedor = c.id_contenedor
            WHERE c.id_contenedor = $id_contenedor;";
        }
        
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

    public function mObtenerContenedorBasura($id) {
        if($id === 'NULL')
            $sql = "SELECT contenedores.id_contenedor, contenedores.nombre AS nombre_contenedor, contenedores.img AS imagen_contenedor,
            contenedores.descripcion AS descripcion_contenedor,
            basura.id_basura, basura.nombre AS nombre_basura, basura.descripcion AS descripcion_basura 
            FROM basura LEFT JOIN contenedores ON basura.id_contenedor = contenedores.id_contenedor
            WHERE basura.id_contenedor IS null;";
        else
            $sql = "SELECT contenedores.id_contenedor, contenedores.nombre AS nombre_contenedor, contenedores.img AS imagen_contenedor,
            contenedores.descripcion AS descripcion_contenedor,
            basura.id_basura, basura.nombre AS nombre_basura, basura.descripcion AS descripcion_basura FROM contenedores
            LEFT JOIN basura ON contenedores.id_contenedor = basura.id_contenedor
            WHERE contenedores.id_contenedor = $id";

        $conexion2 = $this->conexion->prepare($sql);
        $conexion2->execute();
    
        $resultados = array();
        
        $datos = $conexion2->get_result();
        
        while ($fila = $datos->fetch_assoc()) {
            $resultados[] = $fila;
        }
        return $resultados;
    }

    public function mObtenerResultadoBuscador($palabra){
        $sql = "SELECT b.id_basura, b.nombre AS nombre_basura, b.descripcion AS descripcion_basura, c.id_contenedor, c.nombre AS nombre_contenedor
        FROM basura b LEFT JOIN contenedores c ON b.id_contenedor = c.id_contenedor
        WHERE b.nombre LIKE '%$palabra%' OR b.descripcion LIKE '%$palabra%' OR c.nombre LIKE '%$palabra%'";

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
}
?>
