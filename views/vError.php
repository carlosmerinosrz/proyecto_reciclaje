<div id="contenedorNegro">
        <?php
        if (!empty($mensajeError)) {
            echo '<div class="error-message">' . $mensajeError . '</div>';
        } elseif (!empty($mensajeBueno)) {
            echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
        }
        ?>
    <a href="index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores" class="volverAlListado">VOLVER AL LISTADO</a>
</div>
