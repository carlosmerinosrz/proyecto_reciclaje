<div class="container">
    <?php 
    $totalResultados = count($datos);
    $i = 1; 
    ?>
    <p>Se han obtenido <?php echo $totalResultados; ?> resultados en total</p>
    <!-- Muestra las últimas dos palabras buscadas -->
    <?php if (!empty($ultimaPalabra1) && !empty($ultimaPalabra2)): ?>
        <p><span>Últimas dos palabras buscadas: <?php echo $ultimaPalabra1 . ', ' . $ultimaPalabra2; ?></span></p>
    <?php endif; ?>

    <?php foreach ($datos as $resultado): ?>
        <div class="result">
            <h2>Resultado <?php echo $i; ?></h2>
            <p><?php echo $resultado['nombre_basura']; ?></p>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>
</div>
