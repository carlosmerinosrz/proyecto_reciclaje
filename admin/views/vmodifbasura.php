<?php
    if (!empty($mensajeError)) {
        echo '<div class="error-message">¡' . $mensajeError . '!</div>';
    }
    if (!empty($mensajeBueno)) {
        echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
    }
    
?>
<?php foreach ($datos as $basura): ?>
    <form action="index.php?controlador=cbasura&metodo=modificarBasura" method="post">
        <!-- Campos del contenedor -->
        <label for="id">Id de la basura:</label>
        <input type="text" id="id" class="inputids" name="id" value="<?php echo $basura['id_basura'] ?>" readonly>

        <label for="nombre">Nombre de la basura:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $basura['nombre_basura'] ?>">
        
        <label for="descripcion">Descripción de la basura:</label>
        <textarea id="descripcion" name="descripcion"><?php echo $basura['descripcion_basura'] ?></textarea>
        
        <label for="id_contenedor">Contenedor de la Basura:</label>
        <select id="id_contenedor" name="id_contenedor">
            <!-- Opción preseleccionada con el contenedor actual de la basura -->
            <option value="<?php echo $basura['id_contenedor']; ?>"><?php echo ($basura['id_contenedor'] === NULL) ? 'Punto Limpio' : $basura['nombre_contenedor'];  ?></option>
            
            <!-- Mostrar todas las opciones disponibles -->
            <?php foreach ($basura['contenedores'] as $contenedor): ?>
                <option value="<?php echo $contenedor['id_contenedor']; ?>"><?php echo $contenedor['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
       
        <!-- Botón de envío -->
        <input type="submit" value="Guardar">
    </form>
<?php endforeach; ?>
