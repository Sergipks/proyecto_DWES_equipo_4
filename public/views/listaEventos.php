<style>
    .evento img {
        width: 100%;
        height: auto;
        max-width: 100%;
        max-height: 200px;
    }
</style>
<div class="eventos">
    <div class="row">
    <?php
    // Incluir el archivo de inicialización de PDO
    require_once("iniciarPDO.php");

    try {
        // Establecer la conexión a la base de datos
        $pdo = iniciarPDO();

        // Consulta para obtener los eventos de la base de datos
        $query = "SELECT id, nombre, imagen FROM eventos";
        $statement = $pdo->query($query);
        $eventos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Contador para controlar el número de eventos por fila
        $count = 0;

        // Iterar sobre los eventos y mostrarlos en filas y columnas
        foreach ($eventos as $evento) {
            // Si es el primer evento de una fila, abre un nuevo div de fila
            if ($count % 4 == 0) {
                echo '<div class="row">';
            }

            echo '<div class="evento col-md-3">';
            echo '<a href="detalleEvento.php?id=' . $evento["id"] . '">';
            echo '<img src="' . $evento["imagen"] . '" alt="' . $evento["nombre"] . '">';
            echo '</a>';
            echo '<p>' . $evento["nombre"] . '</p>';
            echo '</div>';

            // Si es el cuarto evento de la fila, cierra el div de la fila
            if ($count % 4 == 3) {
                echo '</div>';
            }
            $count++;
        }

        // Si el número total de eventos no es múltiplo de 4, cierra el div de la fila
        if ($count % 4 != 0) {
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
    ?>
    </div>
</div>