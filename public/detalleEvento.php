<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        p {
            margin: 10px 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 5px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .back-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-btn">Volver a la lista de eventos</a>
        <?php
        // Incluir el archivo de inicialización de PDO
        require_once("DB/iniciarPDO.php");

        // Verificar si se proporcionó un ID de evento en la URL
        if (isset($_GET['id'])) {
            $evento_id = $_GET['id'];

            try {
                // Establecer la conexión a la base de datos
                $pdo = iniciarPDO();

                // Consulta para obtener los detalles del evento específico
                $query = "SELECT * FROM eventos WHERE id = :id";
                $statement = $pdo->prepare($query);
                $statement->execute(array(':id' => $evento_id));
                $evento = $statement->fetch(PDO::FETCH_ASSOC);

                // Mostrar los detalles del evento
                if ($evento) {
                    echo "<h1>Detalle del Evento: {$evento['nombre']}</h1>";
                    echo "<img src='{$evento['imagen']}' alt='Imagen del Evento'>";
                    echo "<p><strong>Ubicación:</strong> {$evento['ubicacion']}</p>";
                    echo "<p><strong>Tipo de Terreno:</strong> {$evento['tipo_terreno']}</p>";
                    echo "<p><strong>Fecha:</strong> {$evento['fecha']}</p>";
                    echo "<p><strong>Tipo de Evento:</strong> {$evento['tipo_evento']}</p>";
                    echo "<p><strong>Anfitrión:</strong> {$evento['anfitrion']}</p>";

                    // Botón para modificar el evento
                    echo "<a href='modificarEvento.php?id={$evento_id}' class='btn-modificar'>Modificar Evento</a>";
                    
                } else {
                    echo "El evento no existe.";
                }
            } catch (PDOException $e) {
                // Manejar errores de conexión a la base de datos
                echo "Error de conexión: " . $e->getMessage();
            }
        } else {
            echo "ID de evento no proporcionado en la URL.";
        }
        ?>
    </div>
</body>
</html>