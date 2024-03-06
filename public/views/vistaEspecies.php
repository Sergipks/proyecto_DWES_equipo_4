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

<nav class="navbar navbar-fixed-top navbar-default">
     <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a  class="navbar-brand page-scroll" href="#page-top">
              <span>[PHOTO]</span>
            </a>
         </div>
         <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
              <li class=" lien"><a href="../index.php"><i class="fa fa-home sr-icons"></i> Home</a></li>
              <li class=" lien"><a href="#"><i class="fa fa-bookmark sr-icons"></i> About</a></li>
              <li class=" lien"><a href="#"><i class="fa fa-file-text sr-icons"></i> Blog</a></li>
              <li class=" lien"><a href="#"><i class="fa fa-phone-square sr-icons"></i> Contact</a></li>
              <li class=" active"><a href="#"><i class="fa fa-tree sr-icons"></i> Nuestras especies</a></li>
            </ul>
         </div>
     </div>
   </nav>

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
</body>
</html>
