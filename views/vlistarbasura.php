<div id="listarBasura">
<a href="index.php?controlador=cbasura&metodo=mostrarFormBasura" class="volverAlJuego">ALTA DE BASURAS</a> 
    <?php foreach ($datos as $basura):;?>
        <div class="divBasura">
            <div class="nombreContBasu" >
                <span class="nombre"><?php echo $basura['nombre'] ?></span>
            </div>
            <div class="divBotones1" >
                <!-- <a class="aEditar" href="index.php?controlador=cbasura&metodo=mostrarFormModfBasura&id=<?php echo $basura['id_basura']; ?>">Editar</a> -->
                <a class="aBorrar" href="index.php?controlador=cbasura&metodo=borrarbasura&id=<?php echo $basura['id_basura']; ?>">Borrar</a>
            </div>
        </div>
    <?php endforeach; ?>

    
</div>
