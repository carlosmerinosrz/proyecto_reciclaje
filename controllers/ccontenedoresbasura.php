<?php
class CcontenedoresBasura {
    public $vista;
    public $mensaje;
    public $mensajebueno;
    private $objContenedoresBasura;

    public function __construct() {
        require_once __DIR__ . '/../models/mcontenedoresbasura.php';

        $this->vista = 'valtacontenedores';
        $this->objContenedoresBasura = new MContenedoresBasura();
    }

    public function mostrarMenuInicial() {
        $this->vista = 'vmenuinicial';
    }

    public function listadoContenedores() {
        $this->vista = 'vlistarcontenedores';
        $datos = $this->objContenedoresBasura->listarContenedores();
        return $datos;
    }

    public function mostrarFormContenedores(){
        $this->vista = 'valtacontenedores';
    }

    public function procesarFormulario() {
        $this->vista = 'valtacontenedores';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
            if (isset($_FILES["image"]["tmp_name"]) && !empty($_FILES["image"]["tmp_name"])) {
                $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
            } else {
                $this->mensaje = "Error al procesar el formulario: Debes seleccionar una imagen.";
                return;
            }
            $descripcionContenedor = isset($_POST["descripcionContenedor"]) ? $_POST["descripcionContenedor"] : "";
            $nombreBasuraArray = [];
            $descripcionBasuraArray = [];
    
            for ($i = 1; $i <= 5; $i++) {
                $nombreBasura = isset($_POST["nombreBasura$i"]) ? $_POST["nombreBasura$i"] : "";
                $descripcionBasura = isset($_POST["descripcionBasura$i"]) ? $_POST["descripcionBasura$i"] : "";
    
                // Solo agregar basuras con nombre
                if (!empty($nombreBasura)) {
                    $nombreBasuraArray[] = $nombreBasura;
                    $descripcionBasuraArray[] = $descripcionBasura;
                }
            }
    
            // Verificar si al menos una basura tiene un nombre
            if (empty($nombreBasuraArray)) {
                $this->mensaje = "Error al procesar el formulario: Debes rellenar al menos una basura con nombre.";
                return;
            }
    
            try {
                $id_contenedor = $this->objContenedoresBasura->crearContenedorBasura($nombre, $imageData, $descripcionContenedor);
    
                if ($id_contenedor) {
                    for ($i = 0; $i < count($nombreBasuraArray); $i++) {
                        $this->objContenedoresBasura->agregarBasura($id_contenedor, $nombreBasuraArray[$i], $descripcionBasuraArray[$i]);
                    }
    
                    $this->mensajebueno = "Se ha creado correctamente el contenedor con sus basuras";
                    return;
                }
            } catch (Exception $mensaje) {
                $codigoError = $mensaje->getCode();
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
            }
        }
    }

    public function obtenerMensajeError($numeroError) {
        // Puedes personalizar este método según tus necesidades
        $this->mensaje = "Error al crear el contenedor. Código de error: " . $numeroError;
    }
    
    public function borrarContenedores(){
        $id = $_GET['id'];
        $this->vista = 'vborrado';
    
        if (isset($_POST['confirmacion'])) {
            $respuesta = $_POST['confirmacion'];
    
            if ($respuesta === 'si') {
                $resultado = $this->objContenedoresBasura->mBorrarContenedor($id);
            }
            header("Location: index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores");
            exit();
        }
    }

    public function mObtenerContenedorBasura(){
        $this->vista = 'informacioncontenedores';
        $id = $_GET['id'];
        $datosContenedor = $this->objContenedoresBasura->mObtenerContenedorBasura($id);
        
        return $datosContenedor;
    }
    
    public function mostrarErrorDeModificacion() {
        $this->view = 'vError'; 
        $mensajeError = $this->mensaje; 
        return $mensajeError;
    }

    public function obtenerContenedorModf(){
        $this->vista = 'vmodificarcontenedor';

        $id = $_GET['id'];
        $datosContenedor = $this->objContenedoresBasura->mObtenerContenedor($id);
        return $datosContenedor;
    }
    public function cmodificarcontenedor(){
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $id = $_GET['id'];
        if (!empty($_FILES["image"]["tmp_name"])) {
            $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
        } else {
            $this->mensaje = "Error al procesar el formulario: Debes seleccionar una imagen.";
            return;
        }
        $resultado = $this->objContenedoresBasura->mmodifcontenedor($id, $nombre, $descripcion, $imageData);
        if ($resultado === true) {
            // header("Location: index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores");
            // exit();
        } else {
            $this->mensaje = $this->obtenerMensajeError($resultado);
            $this->mostrarErrorDeModificacion();
        }
        
    }
}
?>
