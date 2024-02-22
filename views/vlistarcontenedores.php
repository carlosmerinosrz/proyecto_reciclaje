<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contenedores</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #listarContenedores {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
        }

        #columnasContenedores {
            margin-bottom: 20px;
        }

        #tablaContenedores {
            width: 100%;
            border-collapse: collapse;
        }

        #tablaContenedores th,
        #tablaContenedores td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        #tablaContenedores th {
            background-color: #f2f2f2;
        }

        .imagenesContenedor {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        .aBorrar,
        .aEditar {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #3498db;
            border-radius: 3px;
        }

        #paginacion {
            margin-top: 20px;
        }

        /* Estilo para el botón de añadir */
        #listarContenedores a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
        }

        #listarContenedores img {
            width: 50px;
            height: 50px;
        }

        #columnasContenedores{
            display: block;
        }
    </style>

<?php
echo 'Versión de PHP: ' . phpversion();
?>

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

</body>
</html>
