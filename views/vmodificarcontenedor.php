<?php foreach ($datos as $contenedor): ?>
<form action="index.php?controlador=ccontenedoresbasura&metodo=cmodificarcontenedor&id=<?php echo $contenedor['id_contenedor'] ?>" method="post" enctype="multipart/form-data">
    <!-- Campos del contenedor -->
    <label for="nombre">Nombre del Contenedor:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $contenedor['nombre'] ?>">

    <div>Imagen Actual</div>
    <img src="data:image/jpeg;base64,<?php echo $contenedor['img'] ?>" alt="Imagen Actual">
    <label for="img">Si deseas modificar la imagen, pulsa en Examinar: </label>
    
    <input type="file" name="image" id="image" accept="image/*">

    <label for="descripcion">Descripción del Contenedor:</label>
    <textarea id="descripcion" name="descripcion" value="<?php echo $contenedor['descripcion'] ?>"></textarea>
    
    <!-- Botón de envío -->
    <input type="submit" value="Guardar">
</form>
<?php endforeach; ?>