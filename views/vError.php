<div id="contenedorNegro">
    <h1 class="main-title-white">ERROR</h1>
    <div class="error-message">
        <?php
        if (!empty($mensajeError)) {
            echo '<div class="error-message">' . $mensajeError . '</div>';
        } else {
            echo "Ha ocurrido un error desconocido.";
        }
        ?>
    </div>
    <a href="index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores" class="volverAlJuego">VOLVER AL LISTADO</a>
</div>
