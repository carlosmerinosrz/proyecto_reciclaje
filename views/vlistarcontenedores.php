<div id="listarContenedores">
    <div id="columnasContenedores">
        <a href="index.php?controlador=ccontenedoresbasura&metodo=generarPdf" target="_blank" class="enlacesPdf" >Generar Pdf</a>
        <a href="index.php?controlador=ccontenedoresbasura&metodo=mostrarFormContenedores" class="enlacesAlta" >Alta Contenedor</a>
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
                            <a class="aModfBasura" href="index.php?controlador=ccontenedoresbasura&metodo=mObtenerContenedorBasura&id=<?php echo $contenedor['id_contenedor']; ?>">Modf Basuras</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="paginacion"></div>

    </div>
</div>
<form action="index.php?controlador=ccontenedoresbasura&metodo=insertarCSV" method="POST" enctype="multipart/form-data"/>
            <div class="file-input text-center">
                <input  type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".csv"/>
                <label class="file-input__label" for="file-input">
                <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
                <span>Elegir Archivo CSV</span></label
                >
            </div>
            <div class="text-center mt-5">
                <input type="submit" name="subir" class="btn-enviar" value="Subir Archivo CSV"/>
            </div>
        </form>

<!-- Agrega las bibliotecas de jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tablaContenedores').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Contenedores",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "pageLength": 5
        });
    });
</script>
