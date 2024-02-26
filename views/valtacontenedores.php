<?php
    if (!empty($mensajeError)) {
        echo '<div class="error-message">¡' . $mensajeError . '!</div>';
    }
    if (!empty($mensajeBueno)) {
        echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
    }
?>
<form action="index.php?controlador=ccontenedoresbasura&metodo=procesarFormulario" method="post" enctype="multipart/form-data">
    <!-- Campos del contenedor -->
    <label for="nombre">Nombre del Contenedor:</label>
    <input type="text" id="nombre" name="nombre" >
    
    <label for="img">Subir Imagen:</label>
    <input type="file" name="image" id="image" accept="image/*" >

    
    <label for="descripcionContenedor">Descripción del Contenedor:</label>
    <textarea id="descripcionContenedor" name="descripcionContenedor"></textarea>
    
    <!-- Campos de la basura -->
    <h2>Basura</h2>
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <label for="nombreBasura<?= $i ?>">Nombre de Basura <?= $i ?>:</label>
        <input type="text" id="nombreBasura<?= $i ?>" name="nombreBasura<?= $i ?>">
        
        <label for="descripcionBasura<?= $i ?>">Descripción de Basura <?= $i ?>:</label>
        <textarea id="descripcionBasura<?= $i ?>" name="descripcionBasura<?= $i ?>"></textarea>
    <?php endfor; ?>
   
    <!-- Botón de envío -->
    <input type="submit" value="Guardar">
</form>
<div id="contenedorNegro">
    <a href="index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores" class="volverAlListado">VOLVER AL LISTADO</a>
</div>

