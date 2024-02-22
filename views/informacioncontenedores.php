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
        <div id="infCont">
            <img src="data:image/jpeg;base64,<?php echo $basura['imagen_contenedor'] ?>" class="imagenesInfContenedor" alt="Imagen del Contenedor">
            <div class="nombreContBasu">
                <?php echo $basura['nombre_contenedor'] ?>
            </div>
            <div id="descripCont">
                <?php echo ($basura['descripcion_contenedor'] === NULL) ? 'Sin Descripcion' : $basura['descripcion_contenedor']; ?>
            </div>
        </div>
        <div id="divBasurasInf">
            <form class="modfBasuCont" action="index.php?controlador=ccontenedoresbasura&metodo=crearBasurasNuevas&id=<?php echo $basura['id_contenedor'] ?>" method="post">
                <!-- Agrega el formulario para las basuras -->
<?php
        $contenedorMostrado = true;
    endif;
?>
        <div class="divDinamicoBasuras">
            <div class="divBasuras">
                <label for="nombre_basura_<?php echo $basura['id_basura'] ?>_<?php echo $basura['id_contenedor'] ?>">Nombre de la Basura:</label>
                <input type="text" id="nombre_basura_<?php echo $basura['id_basura'] ?>_<?php echo $basura['id_contenedor'] ?>" name="nombre_basura_<?php echo $basura['id_basura'] ?>_<?php echo $basura['id_contenedor'] ?>" value="<?php echo $basura['nombre_basura'] ?>" >

                <label for="descripcion_basura_<?php echo $basura['id_basura'] ?>_<?php echo $basura['id_contenedor'] ?>">Descripción de la Basura:</label>
                <input type="text" id="descripcion_basura_<?php echo $basura['id_basura'] ?>_<?php echo $basura['id_contenedor'] ?>" name="descripcion_basura_<?php echo $basura['id_basura'] ?>_<?php echo $basura['id_contenedor'] ?>" value="<?php echo $basura['descripcion_basura'] ?>" >
            </div>
            <div class="btnBorradoBasuras">
                <button type="button" class="borrarBasura" onclick="borrarDiv(this.parentNode)">Borrar</button>
            </div>
        </div>  
<?php endforeach; ?>
            <button type="submit" class="enviarFormulario">Enviar Formulario</button>
        </form>

    </div>

    <script>
    function borrarDiv(elemento) {
        // Elimina el divDinamicoBasuras al que pertenece el botón de borrado
        var divDinamico = elemento.parentNode;
        divDinamico.parentNode.removeChild(divDinamico);
    }
</script>
