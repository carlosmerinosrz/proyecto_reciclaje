<?php
require_once '../librerias/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

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

    public function eleccionGestion() {
        $this->vista = 'vgestionbasura';
        $datos = $this->objBasura->msacarcontenedores();
        return $datos;
    }

    public function listadoBasura() {
        $this->vista = 'vlistarbasura';
        $datos = $this->objBasura->listadoBasura();
        return $datos;
    }

    public function listadoBasuraContenedor() {
        $this->vista = 'vlistarbasura';
        $id_contenedor = $_GET['id_contenedor'];
        if($id_contenedor === ''){
            $id_contenedor = 'NULL';
		}
        $datos = $this->objBasura->listadoBasuraContenedor($id_contenedor);
        return $datos;
    }

    public function listadoBasuraContenedorFormulario() {
        $this->vista = 'vlistarbasura';
        $id_contenedor = $_POST['id_contenedor'];
        $datos = $this->objBasura->listadoBasuraContenedor($id_contenedor);
        return $datos;
    }

    public function mostrarFormBasura(){
        $this->vista = 'valtabasura';
        $datos = $this->objBasura->msacarcontenedores();
        return $datos;
    }

    public function crearBasura(){
        $this->vista = 'valtabasura';
    
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_contenedor = $_POST['id_contenedor'];

        $nombre = ($nombre === '') ? NULL : $nombre;
        $descripcion = ($descripcion === '') ? NULL : $descripcion;
    
        $resultado = $this->objBasura->agregarBasura($nombre, $descripcion, $id_contenedor);
    
        if($resultado === true){
            header("Location: index.php?controlador=cbasura&metodo=listadoBasuraContenedor&id_contenedor=".$id_contenedor);
            exit();
        }else{
            $this->obtenerMensajeError($resultado, $id_contenedor);
        }
        
    }

    public function obtenerMensajeError($codigoError, $id_contenedor) {
        $this->vista = 'vError'; 
        $this->mensaje = "Error. Código de error: " . $codigoError;

        switch ($codigoError) {
            case 1048:
                $this->mensaje = "Error al procesar el formulario: No puede haber campos vacíos.";
                break;
            case 1406:
                $this->mensaje = "Error al procesar el formulario: Los campos exceden la longitud máxima.";
                break;
            case 1062:
                $this->mensaje = "Error al procesar el formulario: Ya existe una basura con ese nombre.";
                break;  
            default:
                if (is_numeric($codigoError)) {
                    $this->mensaje = "Error al crear contenedor. Código de error: $codigoError";
                } else {
                    $this->mensaje = $codigoError;
                }
                break;
        }
        return $this->mensaje;
    }
    
    public function sacarContenedores(){
        $datos = $this->objBasura->msacarcontenedores();
        return $datos;
    }

    
    public function borrarbasura(){
        $id = $_GET['id'];
        $id_contenedor = $_GET['id_contenedor'];
        $this->vista = 'vborrado';
    
        if (isset($_POST['confirmacion'])) {
            $respuesta = $_POST['confirmacion'];
    
            if ($respuesta === 'si') {
                $this->objBasura->mBorrarBasura($id);
            }
            
            header("Location: index.php?controlador=cbasura&metodo=listadoBasuraContenedor&id_contenedor=".$id_contenedor);
            exit();
        }
    }
    
    public function mostrarFormModfBasura(){
        $this->vista = 'vmodifbasura';

        $id_basura = $_GET['id'];

        $datos = $this->objBasura->msacarBasura($id_basura);
        return $datos;
    }
    
    public function modificarBasura(){
        $id_basura = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_contenedor = $_POST['id_contenedor'];

        $nombre = ($nombre === '') ? NULL : $nombre;
        $descripcion = ($descripcion === '') ? NULL : $descripcion;

        $resultado = $this->objBasura->mmodificarBasura($id_basura, $nombre, $descripcion, $id_contenedor);
    
        if($resultado === true){
            header("Location: index.php?controlador=cbasura&metodo=listadoBasuraContenedor&id_contenedor=".$id_contenedor);
            exit();
        }else{
            $this->obtenerMensajeError($resultado);
        }
    }

    public function borrarBasurasSeleccionadas() {
        // $this->vista = 'vborrado';
        $id_contenedor = $_GET['id_contenedor'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $basurasSeleccionadas = isset($_POST['seleccionar']) ? $_POST['seleccionar'] : [];
            if($basurasSeleccionadas !== []){
                $this->objBasura->borrarBasurasSeleccionadas($basurasSeleccionadas);
                header("Location: index.php?controlador=cbasura&metodo=listadoBasuraContenedor&id_contenedor=".$id_contenedor);
                exit();
            }   
            else{
                $this->vista = 'vError';
                $this->mensaje = "Por favor, selecciona al menos una basura.";
            }
        
            
        }
    }

    public function generarPdf() {
        $datos = $this->objBasura->listadoBasura();
        $this->generarVistaPdf($datos);
    }
    
    public function generarVistaPdf($datos) {
        ob_start();
        include 'views/generarBasuraPdf.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'protrait');
        $dompdf->render();
        $dompdf->stream("listado_basura_carlos_merino.pdf");
    }
}
?>
