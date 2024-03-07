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

    <h1>Logros</h1>

    <!-- Formulario de Filtros -->
    <form method="get" action="">
        <label for="filtroAnyo">Filtrar por año:</label>
        <select name="filtroAnyo" id="filtroAnyo">
            <option value="" selected>-Seleccione el año-</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
        </select>

        <label for="filtroUbicacion">Filtrar por ubicación:</label>
        <input type="text" name="filtroUbicacion" id="filtroUbicacion" placeholder="Ingrese ubicación">

        <label for="filtroBeneficio">Filtrar por beneficio:</label>
        <input type="text" name="filtroBeneficio" id="filtroBeneficio" placeholder="Ingrese beneficio">

        <button type="submit">Filtrar</button>
    </form>

    <table border="1">
        <tr>
            <th>Arboles reforestados</th>
            <th>Ubicacion</th>
            <th>Especie</th>
            <th>Fecha</th>
            <th>Beneficios</th>
        </tr>

        <?php foreach ($logros as $logro): ?>
            <tr>
                <td><?php echo $logro['arboles_reforestados']; ?></td>
                <td><?php echo $logro['ubicacion']; ?></td>
                <td><?php echo $logro['especie']; ?></td>
                <td><?php echo $logro['fecha']; ?></td>
                <td><?php echo $logro['beneficios']; ?></td>
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
