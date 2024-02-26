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
<div id="nuevosCampos"></div>
            <button type="submit" class="enviarFormulario">Enviar Formulario</button>
        </form>
    </div>
</div>

<div id="contenedorNegro">
    <a href="index.php?controlador=ccontenedoresbasura&metodo=listadoContenedores" class="volverAlListado">VOLVER AL LISTADO</a>
    <button type="button" id="agregarBasuraBtn">Agregar Basura</button>
</div>

<script>
    function borrarDiv(elemento) {
        var divDinamico = elemento.parentNode;
        divDinamico.parentNode.removeChild(divDinamico);
    }

    document.getElementById('agregarBasuraBtn').addEventListener('click', function () {
        var nuevosCampos = document.getElementById('nuevosCampos');
        var nuevoDivBasuras = document.createElement('div');
        nuevoDivBasuras.className = 'divDinamicoBasuras';

        nuevoDivBasuras.innerHTML = `
            <div class="divBasuras">
                <label for="nombre_basura_${Date.now()}">Nombre de la Basura:</label>
                <input type="text" id="nombre_basura_${Date.now()}" name="nombre_basura_${Date.now()}" value="">

                <label for="descripcion_basura_${Date.now()}">Descripción de la Basura:</label>
                <input type="text" id="descripcion_basura_${Date.now()}" name="descripcion_basura_${Date.now()}" value="">
            </div>
            <div class="btnBorradoBasuras">
                <button type="button" class="borrarBasura" onclick="borrarDiv(this.parentNode)">Borrar</button>
            </div>
        `;

        nuevosCampos.appendChild(nuevoDivBasuras);
    });
</script>
