<?php

class CReciclaje {
    public $vista;
    public $mensaje;
    public $palabra1;
    public $palabra2;
    public $mensajebueno;
    private $objReciclaje;

    public function __construct() {
        require_once __DIR__ . '/../models/mreciclaje.php';

        $this->objReciclaje = new MReciclaje();
    }

    public function mostrarMenuInicial(){
        $this->vista = 'vmenu';
    }
    public function sobrereciclaje(){
        $this->vista = 'sobrereciclaje';
    }

    public function eleccionGestion() {
        $this->vista = 'vseleccionarcontenedor';
        $datos = $this->objReciclaje->msacarcontenedores();
        return $datos;
    }

    public function listadoBasuraContenedorFormulario () {
        $this->vista = 'vlistarbasura';
        $id_contenedor = $_POST['id_contenedor'];
        $datosContenedor = $this->objReciclaje->mObtenerContenedorBasura($id_contenedor);
            return $datosContenedor;
    }

    public function buscadorBasuras () {
        $this->vista = 'vresultadosbusqueda';

        if (isset($_POST['busqueda'])) {
            $palabraBusqueda = $_POST['busqueda'];
        
            // Obtén las últimas dos palabras buscadas desde las cookies
            $ultimaPalabra1 = isset($_COOKIE['ultimaPalabra1']) ? $_COOKIE['ultimaPalabra1'] : '';
            $this->palabra1 = $ultimaPalabra1;
            $ultimaPalabra2 = isset($_COOKIE['ultimaPalabra2']) ? $_COOKIE['ultimaPalabra2'] : '';
            $this->palabra2 = $ultimaPalabra2;
        
            // Establece las cookies para las últimas dos palabras buscadas
            setcookie('ultimaPalabra2', $ultimaPalabra1, time() + 3600, '/');
            setcookie('ultimaPalabra1', $palabraBusqueda, time() + 3600, '/');

            $datos = $this->objReciclaje->mObtenerResultadoBuscador($palabraBusqueda);
            return $datos;
        }
    }

}
?>
