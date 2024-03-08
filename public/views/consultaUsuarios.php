<?php
        include_once "../controllers/error.php";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../controllers/consultas.php" method="post" name="formConsulta">
        <label for="tipo">Buscar por:</label>
        <select name="tipo">
            <option value="correo">Email</option>
            <option value="nick">Nickname</option>
            <option value="karma">Karma</option>
        </select>
        <?php
            echo "$valorEmpty $valorInt";
        ?>
        <label for="valor">Búsqueda</label>
        <input type="text" name="valor" required>
        <input type="submit" name="btnSumit" value="Buscar">
    </form>
</body>
</html>
