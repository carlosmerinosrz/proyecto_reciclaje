<?php
    if (!empty($mensajeBueno)) {
            echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
    }
    if (!empty($mensajeError)) {
        echo '<div class="error-message">¡' . $mensajeError . '!</div>';
    }
?>