<div id="listarContenedores">
    <div id="columnasContenedores">
        <a href="index.php?controlador=cbasura&metodo=generarPdf" target="_blank" class="enlacesPdf">Generar Pdf</a>
        <a href="index.php?controlador=cbasura&metodo=mostrarFormBasura" class="enlacesAlta">Alta de Basuras</a> 
        <table id="tablaContenedores">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $basura):;?>
                    <tr>
                        <td><?php echo $basura['id_basura'] ?></td>
                        <td><?php echo $basura['nombre'] ?></td>
                        <td><?php echo ($basura['descripcion'] === NULL) ? 'Sin Descripcion' : $basura['descripcion']; ?></td>
                        <td>
                            <a class="aBorrar" href="index.php?controlador=cbasura&metodo=borrarbasura&id=<?php echo $basura['id_basura']; ?>">Borrar</a>
                            <a class="aEditar" href="index.php?controlador=cbasura&metodo=mostrarFormModfBasura&id=<?php echo $basura['id_basura']; ?>">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="paginacion"></div>
    </div>
</div>

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
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
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
            "pageLength": 10
        });
    });
</script>