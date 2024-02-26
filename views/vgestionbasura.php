<div id="contenedorNegro">
    <form action="index.php?controlador=cbasura&metodo=listadoBasuraContenedor" method="POST">
        <label for="contenedor">Selecciona un Contenedor:</label>
        <select id="id_contenedor" name="id_contenedor">
            <option value='NULL'>Punto Limpio</option>
            <?php foreach ($datos as $contenedor): ?>
            <option value="<?php echo $contenedor['id_contenedor']; ?>"><?php echo $contenedor['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Administrar Basuras">
    </form>
    <a href="index.php?controlador=cbasura&metodo=listadoBasura" class="volverAlListado">Listado Completo</a>
</div>

