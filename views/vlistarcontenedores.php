<div id="listarContenedores">
    <div id="columnasContenedores">
        <a href="index.php?controlador=ccontenedoresbasura&metodo=generarPdf" target="_blank">Generar Pdf</a>
        <table id="tablaContenedores">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $contenedor):;?>
                    <tr>
                        <td><?php echo $contenedor['id_contenedor']; ?></td>
                        <td><?php echo $contenedor['nombre']; ?></td>
                        <td><img src="data:image/jpeg;base64,<?php echo $contenedor['img'] ?>" class="imagenesContenedor" alt="Imagen del Contenedor"></td>
                        <td><?php echo ($contenedor['descripcion'] === NULL) ? 'Sin Descripcion' : $contenedor['descripcion']; ?></td>
                        <td>
                            <a class="aBorrar" href="index.php?controlador=ccontenedoresbasura&metodo=borrarContenedores&id=<?php echo $contenedor['id_contenedor']; ?>">Borrar</a>
                            <a class="aEditar" href="index.php?controlador=ccontenedoresbasura&metodo=obtenerContenedorModf&id=<?php echo $contenedor['id_contenedor']; ?>">Editar</a>
                            <a class="aEditar" href="index.php?controlador=ccontenedoresbasura&metodo=mObtenerContenedorBasura&id=<?php echo $contenedor['id_contenedor']; ?>">Modf Basuras</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="paginacion"></div>

        <a href="index.php?controlador=ccontenedoresbasura&metodo=mostrarFormContenedores">
            <img src="css/añadir.png" alt="">
        </a>
    </div>
</div>

<!-- Agrega las bibliotecas de jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tablaContenedores').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "pageLength": 5
        });
    });
</script>
