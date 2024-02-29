<?php
if (!empty($mensajeBueno)) {
            echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
        }
?>
<div class="alert-container">
    <form method="post">
        <p>¿Estás seguro de eliminarlo?</p>
        <div class="confirmation-buttons">
            <button type="submit" name="confirmacion" value="si" class="button button-yes">Sí</button>
            <button type="submit" name="confirmacion" value="no" class="button button-no">No</button>
        </div>
    </form>
</div>