<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn-back {
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            text-align: center;
            display: block;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h2>Crear Nuevo Evento</h2>
    <form action="../procesarEvento.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="ubicacion">Ubicación:</label><br>
        <input type="text" id="ubicacion" name="ubicacion" required><br>

        <label for="tipo_terreno">Tipo de Terreno:</label><br>
        <input type="text" id="tipo_terreno" name="tipo_terreno" required><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="tipo_evento">Tipo de Evento:</label><br>
        <input type="text" id="tipo_evento" name="tipo_evento" required><br>

        <label for="anfitrion">Anfitrión:</label><br>
        <select id="anfitrion" name="anfitrion" required>
            <option value="">Seleccionar Anfitrión</option>
            <?php
            // Incluir el archivo de inicialización de PDO
            require_once("../DB/iniciarPDO.php");

            try {
                // Establecer la conexión a la base de datos
                $pdo = iniciarPDO();

                // Consulta para obtener la lista de usuarios
                $query = "SELECT * FROM usuarios";
                $statement = $pdo->query($query);
                $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($usuarios as $usuario) {
                    echo "<option value='{$usuario['nick']}'>{$usuario['nombre']}</option>";
                }
            } catch (PDOException $e) {
                // Manejar errores de conexión a la base de datos
                echo "Error de conexión: " . $e->getMessage();
            }
            ?>
        </select><br>

        <label for="imagen_url">URL de la Imagen:</label><br>
        <input type="text" id="imagen_url" name="imagen_url" required><br>

        <input type="submit" value="Crear Evento">
    </form>
    <a href="../index.php" class="btn-back">Volver</a>
</body>
</html>