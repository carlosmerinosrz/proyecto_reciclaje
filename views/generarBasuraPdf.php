<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #listarContenedores {
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        #tablaContenedores {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #tablaContenedores th, #tablaContenedores td {
            border: 1px solid #ddd;
            padding: 12px;
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
    </style>
</head>
<body>

<div id="listarContenedores">
    <div id="columnasContenedores">
        <table id="tablaContenedores">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $basura):;?>
                    <tr>
                        <td><?php echo $basura['id_basura'] ?></td>
                        <td><?php echo $basura['nombre'] ?></td>
                        <td><?php echo ($basura['descripcion'] === NULL) ? 'Sin Descripcion' : $basura['descripcion']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
