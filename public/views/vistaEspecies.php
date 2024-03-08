<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuestras Especies</title>
    <!-- Bootstrap core css -->
  	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  	<!-- Bootstrap core css -->
  	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<!-- Magnific-popup css -->
  	<link rel="stylesheet" type="text/css" href="../css/magnific-popup.css">
  	<!-- Font Awesome icons -->
  	<link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">
</head>
<body>

<?php include "nav.html" ?>

    <h1>Nuestras Especies</h1>
    <table border="1">
        <tr>
            <th>Especie</th>
            <th>Clima</th>
            <th>Región</th>
            <th>Tiempo de Crecimiento</th>
            <th>Beneficios</th>
            <th>Imagen</th>
            <th>Enlace a Wikipedia</th>
        </tr>

        <?php foreach ($especies as $especie): ?>
            <tr>
                <td><?php echo $especie['nombre']; ?></td>
                <td><?php echo $especie['clima']; ?></td>
                <td><?php echo $especie['region']; ?></td>
                <td><?php echo $especie['tiempo_crecimiento']; ?></td>
                <td><?php echo $especie['beneficios']; ?></td>
                <td><img height="100px" width="100px" src="<?php echo $especie['imagen']; ?>" alt="Imagen de la especie"></td>
                <td><a href="<?php echo $especie['enlace_wikipedia']; ?>" target="_blank">Enlace a Wikipedia</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<!-- Jquery -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!-- Bootstrap core Javascript -->
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Plugins -->
<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="../js/scrollreveal.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>
