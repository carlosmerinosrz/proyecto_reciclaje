<?php
    if (!empty($mensajeError)) {
        echo '<div class="error-message">¡' . $mensajeError . '!</div>';
    }
    if (!empty($mensajeBueno)) {
        echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
    }
?>
<?php foreach ($datos as $basura): ?>
<form action="index.php?controlador=cbasura&metodo=modifBasura" method="post">
    <!-- Campos del contenedor -->
    <label for="id">Id de la basura:</label>
    <input type="text" id="id" name="id" value="<?php echo $basura['id'] ?>">

    <label for="nombre">Nombre de la basura:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $basura['nombre'] ?>">
    
    <label for="descripcion">Descripción de la basura:</label>
    <textarea id="descripcion" name="descripcion" value="<?php echo $basura['descripcion'] ?>"></textarea>
    
    <label for="id_contenedor">Contenedor de la Basura:</label>
    <select id="id_contenedor" name="id_contenedor">
            <option value="<?php echo $basura['id_contenedor']; ?>"><?php echo ($basura['id_contenedor'] === NULL) ? 'Punto Limpio' : $basura['id_contenedor'];  ?></option>
    </select>
   
    <!-- Botón de envío -->
    <input type="submit" value="Guardar">
</form>
<?php endforeach; ?>