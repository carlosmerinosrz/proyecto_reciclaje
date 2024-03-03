<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
    <link rel="stylesheet" href="css/style.css">
</head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="index.php?">Inicio</a>
                </li>
                <li>
                    <a href="index.php?controlador=creciclaje&metodo=sobrereciclaje">Sobre el reciclaje</a>
                </li>
                <li>
                    <a href="index.php?controlador=creciclaje&metodo=eleccionGestion">Seleccion</a>
                </li>
                <li>
                    <form action="index.php?controlador=creciclaje&metodo=buscadorBasuras" method="POST">
                            <input type="text" id="busqueda" name="busqueda" placeholder="Busca tu basura">
                            <button type="submit">Buscar</button>
                    </form>
                </li>
            </ul>
            <div class="hamburger">
            </div>
        </nav>
        <div class="menubar">
            <ul>
                <li>
                    <a href="index.php?">Inicio</a>
                </li>
                <li>
                    <a href="index.php?">Sobre el Reciclaje</a>
                </li>
                <li>
                    <a href="index.php?">Seleccion</a>
                </li>
            </ul>
        </div>
        <div>