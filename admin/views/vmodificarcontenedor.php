<?php
if (!empty($mensajeError)) {
    echo '<div class="error-message">¡' . $mensajeError . '!</div>';
}
if (!empty($mensajeBueno)) {
    echo '<div class="bueno-message">¡' . $mensajeBueno . '!</div>';
}
$contenedorMostrado = false;
foreach ($datos as $basura):
    if (!$contenedorMostrado):
?>
    <div id="informacionContenedor">
        <form action="index.php?controlador=ccontenedoresbasura&metodo=cmodificarcontenedor&id=<?php echo $basura['id_contenedor'] ?>" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre del Contenedor:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $basura['nombre_contenedor'] ?>">

            <div>Imagen Actual</div>
            <img src="data:image/jpeg;base64,<?php echo $basura['imagen_contenedor'] ?>" alt="Imagen Actual">
            <label for="img">Si deseas modificar la imagen, pulsa en Examinar: </label>
            <input type="file" name="image" id="image" accept="image/*">

            <label for="descripcion">Descripción del Contenedor:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $basura['descripcion_contenedor'] ?></textarea>
<?php
        $contenedorMostrado = true;
    endif;
?>
            <div class="divDinamicoBasuras">
                <div class="divBasuras">
                    <label for="nombre_basura_<?php echo $basura['id_basura'] ?>">Nombre de la Basura:</label>
                    <input type="text" id="nombre_basura_<?php echo $basura['id_basura'] ?>" name="nombre_basura_<?php echo $basura['id_basura'] ?>" value="<?php echo $basura['nombre_basura'] ?>">

                    <label for="descripcion_basura_<?php echo $basura['id_basura'] ?>">Descripción de la Basura:</label>
                    <input type="text" id="descripcion_basura_<?php echo $basura['id_basura'] ?>" name="descripcion_basura_<?php echo $basura['id_basura'] ?>" value="<?php echo $basura['descripcion_basura'] ?>">
                </div>
            </div>
<?php endforeach; ?>
            <button type="submit" class="enviarFormulario">Enviar Formulario</button>
        </form>
    </div>
<div id="contenedorNegro">
    <a href="index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores" class="volverAlListado">VOLVER AL LISTADO</a>
</div>