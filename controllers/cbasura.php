<?php
class CBasura {
    public $vista;
    public $mensaje;
    public $mensajebueno;
    private $objBasura;

    public function __construct() {
        require_once __DIR__ . '/../models/mbasuras.php';

        $this->vista = 'valtabasura';
        $this->objBasura = new MBasura();
    }

    public function listadoBasura() {
        $this->vista = 'vlistarbasura';
        $datos = $this->objBasura->listadoBasura();
        return $datos;
    }

    public function mostrarFormBasura(){
        $this->vista = 'valtabasura';
        $datos = $this->objBasura->msacarcontenedores();
        return $datos;
    }

    public function crearBasura(){
        $this->vista = 'valtabasura';

        // Imprime o verifica los datos de contenedores
        echo $datos;
    
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_contenedor = $_POST['id_contenedor'];
    
        $resultado = $this->objBasura->agregarBasura($nombre, $descripcion, $id_contenedor);
    
        if($resultado === true){
            header("Location: index.php?controlador=cbasura&metodo=listadobasura");
            exit();
        } else {
            // Renderizar la vista con los datos de contenedores
            include 'ruta_a_tu_vista.php';
        }
    }
    
    public function sacarContenedores(){
        $datos = $this->objBasura->msacarcontenedores();
        return $datos;
    }

    public function obtenerMensajeError($numeroError) {
        // Puedes personalizar este método según tus necesidades
        $this->mensaje = "Error al crear la basura. Código de error: " . $numeroError;
    }
    
    public function borrarbasura(){
        $id = $_GET['id'];
        $this->vista = 'vborrado';
    
        if (isset($_POST['confirmacion'])) {
            $respuesta = $_POST['confirmacion'];
    
            if ($respuesta === 'si') {
                $resultado = $this->objBasura->mBorrarBasura($id);
            }
            header("Location: index.php?controlador=cbasura&metodo=listadobasura");
            exit();
        }
    }
    
    public function mostrarFormModfBasura(){
        $this->vista = 'vmodifbasura';

        $id_basura = $_GET['id'];

        $datos = $this->objBasura->msacarBasura($id_basura);
        return $datos;
    }
    
    public function modifBasura(){
        
    }
}
?>
