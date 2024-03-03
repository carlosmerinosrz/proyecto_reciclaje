<div id="listarContenedores">
    <?php if (!empty($datos)): ?>
        <h2>Listado de Basuras del contenedor "<?php echo ($datos[0]['nombre_contenedor']=== NULL)? 'Punto Limpio' : $datos[0]['nombre_contenedor']; ?>"</h2>
        <div id="columnasContenedores">
            
            <form action="index.php?controlador=cbasura&metodo=borrarBasurasSeleccionadas&id_contenedor=<?php echo $datos[1]['id_contenedor']; ?>" method="post">
                <input type="submit" value="Eliminar Basuras Seleccionadas" class="enlacesPdf">
                <a href="index.php?controlador=cbasura&metodo=generarPdf" target="_blank" class="enlacesPdf">Generar Pdf</a>
                <a href="index.php?controlador=cbasura&metodo=mostrarFormBasura" class="enlacesAlta">Alta de Basuras</a>
                <table id="tablaContenedores">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $basura): ?>
                            <tr>
                                <td><input type="checkbox" name="seleccionar[]" value="<?php echo $basura['id_basura']; ?>"></td>
                                <td><?php echo $basura['id_basura'] ?></td>
                                <td><?php echo $basura['nombre_basura'] ?></td>
                                <td><?php echo ($basura['descripcion_basura'] === NULL) ? 'Sin Descripcion' : $basura['descripcion_basura']; ?></td>
                                <td>
                                    <a class="aBorrar" href="index.php?controlador=cbasura&metodo=borrarbasura&id=<?php echo $basura['id_basura']; ?>&id_contenedor=<?php echo $basura['id_contenedor']; ?>">Borrar</a>
                                    <a class="aEditar" href="index.php?controlador=cbasura&metodo=mostrarFormModfBasura&id=<?php echo $basura['id_basura']; ?>&id_cont_sin=<?php echo $basura['id_contenedor']; ?>">Editar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
            <div id="paginacion"></div>
        </div>
    <?php else: ?>
        <p>No hay datos disponibles.</p>
        <a href="index.php?controlador=cbasura&metodo=mostrarFormBasura" class="enlacesAlta">Alta de Basuras</a>
    <?php endif; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
  $('#tablaContenedores').DataTable({
      "pageLength": 10
  });
});
</script>