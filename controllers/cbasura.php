<?php
require_once 'librerias/dompdf/vendor/autoload.php';
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
    
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_contenedor = $_POST['id_contenedor'];

        $nombre = ($nombre === '') ? NULL : $nombre;
        $descripcion = ($descripcion === '') ? NULL : $descripcion;
    
        $resultado = $this->objBasura->agregarBasura($nombre, $descripcion, $id_contenedor);
    
        if($resultado === true){
                // header("Location: index.php?controlador=cbasura&metodo=listadobasura");
                // exit();
        }else{
            $this->obtenerMensajeError($resultado);
        }
        
    }

    public function obtenerMensajeError($codigoError) {
        $this->vista = 'vError'; 
        $this->mensaje = "Error. Código de error: " . $codigoError;

        switch ($codigoError) {
            case 1048:
                $this->mensaje = "Error al procesar el formulario: No puede haber campos vacíos.";
                break;
            case 1406:
                $this->mensaje = "Error al procesar el formulario: Los campos exceden la longitud máxima.";
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
    
    public function modificarBasura(){
        $id_basura = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_contenedor = $_POST['id_contenedor'];

        $nombre = ($nombre === '') ? NULL : $nombre;
        $descripcion = ($descripcion === '') ? NULL : $descripcion;

        $resultado = $this->objBasura->mmodificarBasura($id_basura, $nombre, $descripcion, $id_contenedor);
    
        if($resultado === true){
            header("Location: index.php?controlador=cbasura&metodo=listadobasura");
            exit();
        }else{
            $this->obtenerMensajeError($resultado);
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
