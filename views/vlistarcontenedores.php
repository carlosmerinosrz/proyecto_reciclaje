<div id="listarContenedores">
    <div id="columnasContenedores">
        <?php foreach ($datos as $contenedor):;?>
                <div class="divContenedor">
                    <a href="index.php?controlador=ccontenedoresbasura&metodo=mObtenerContenedorBasura&id=<?php echo $contenedor['id_contenedor']; ?>">
                        <div class="nombreContBasu" ><?php echo $contenedor['nombre'] ?></div>
                        <div class="divImagenes">
                            <img src="data:image/jpeg;base64,<?php echo $contenedor['img'] ?>" class="imagenesContenedor" alt="Imagen del Contenedor">
                        </div>
                    </a>
                    <div class="divBotones">
                        <a class="aEditar" href="index.php?controlador=ccontenedoresbasura&metodo=obtenerContenedorModf&id=<?php echo $contenedor['id_contenedor']; ?>">Editar</a>
                        <a class="aBorrar" href="index.php?controlador=ccontenedoresbasura&metodo=borrarContenedores&id=<?php echo $contenedor['id_contenedor']; ?>">Borrar</a>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>

    <a href="index.php?controlador=ccontenedoresbasura&metodo=mostrarFormContenedores" class="volverAlJuego">ALTA DE CONTENEDORES</a> 
</div>
