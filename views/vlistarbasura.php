<?php
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

<?php
        $contenedorMostrado = true;
    endif;
?>
        <div class="divDinamicoBasuras">
            <div class="divBasuras">
                <p>Nombre de la Basura: <span> <?php echo $basura['nombre_basura'] ?></span></p>
                <p>Descripcion de la Basura: <span> <?php echo ($basura['descripcion_basura'] === NULL) ? 'Sin Descripcion' : $basura['descripcion_basura']; ?></span> </p>
            </div>
        </div>  
<?php endforeach; ?>
    </div>
</div>

<div>
    <a href="index.php?" class="volverAlListado">Volver Atrás</a>
</div>

