<?php
    require_once 'config/config.php';


    if(!isset($_GET["controlador"])) $_GET["controlador"] = constant("CONTROLADOR_DEFECTO");
    if(!isset($_GET["metodo"])) $_GET["metodo"] = constant("METODO_DEFECTO");

    $controlador = $_GET['controlador'];
    require_once 'controllers/'.$controlador.'.php';
    $objControlador = new $controlador();
    
    $metodo = $_GET['metodo'];
    $datos = $objControlador->$metodo(); //Sacar los datos que devuelve los controladores
    $mensajeError = $objControlador->mensaje;
    $mensajeBueno = $objControlador->mensajebueno;

    //Existen dos vistas html o php
    $vistasHtlm = __DIR__ . '/views/' . $objControlador->vista . '.html';
    $vistasPhp = __DIR__ . '/views/' . $objControlador->vista . '.php';

    require_once __DIR__ .'/views/template/header.php';

    if(file_exists($vistasPhp))
        require_once($vistasPhp);
    elseif(file_exists($vistasHtml))
        require_once($vistasHtml);
    else
        require_once __DIR__ . '/views/vError404.html';

    require_once __DIR__ .'/views/template/footer.php';
?>