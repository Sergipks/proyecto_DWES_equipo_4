<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegurarse de que se haya proporcionado una URL de imagen válida
    if (isset($_POST['imagen_url']) && filter_var($_POST['imagen_url'], FILTER_VALIDATE_URL)) {
        // Incluir el archivo de inicialización de PDO
        require_once("DB/iniciarPDO.php");

        try {
            // Establecer la conexión a la base de datos
            $pdo = iniciarPDO();

            // Preparar la consulta para insertar el evento
            $stmt = $pdo->prepare("INSERT INTO eventos (nombre, ubicacion, tipo_terreno, fecha, tipo_evento, anfitrion, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");

            // Bind de parámetros
            $stmt->bindParam(1, $_POST['nombre']);
            $stmt->bindParam(2, $_POST['ubicacion']);
            $stmt->bindParam(3, $_POST['tipo_terreno']);
            $stmt->bindParam(4, $_POST['fecha']);
            $stmt->bindParam(5, $_POST['tipo_evento']);
            $stmt->bindParam(6, $_POST['anfitrion']);
            $stmt->bindParam(7, $_POST['imagen_url']); // Guardar la URL de la imagen

            // Ejecutar la consulta
            $stmt->execute();

            // Redireccionar después de la inserción exitosa
            header("Location: formulario_evento.php?exito=true");
            exit();
        } catch (PDOException $e) {
            // Manejar errores de conexión a la base de datos
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "La URL de la imagen proporcionada no es válida.";
    }
}
?>