<?php
    $contenedorMostrado = false;

    foreach ($datos as $basura):
        if (!$contenedorMostrado):
?>
        <div id="informacionContenedor">
            <div id="infCont">

                    <img src="data:image/jpeg;base64,<?php echo $basura['imagen_contenedor'] ?>" class="imagenesContenedor" alt="Imagen del Contenedor">

                <div class="nombreContBasu">
                    <?php echo $basura['nombre_contenedor'] ?>
                </div>
                <div id="descripCont">
                    <?php echo $basura['descripcion_contenedor'] ?>
                </div>
            </div>
            <div id="divBasurasInf">
<?php
        $contenedorMostrado = true;
    endif;
?>
                <div class="divBasuras">
                    <div class="nombreContBasu"><?php echo $basura['nombre_basura'] ?></div>
                    <div><?php  echo $basura['descripcion_basura'] ?></div>
                </div>
<?php endforeach; ?>
            </div>
        </div>
