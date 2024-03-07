<?php
require_once("../DB/iniciarPDO.php");

class Evento
{
    public static function obtenerLogros($filtroAnyo = null, $filtroUbicacion = null, $filtroBeneficio = null) 
    {
        $pdo = iniciarPDO();

        // Construir la consulta base
        $query = "SELECT e.ubicacion, p.especie, e.fecha, SUM(p.cantidad) AS arboles_reforestados, es.beneficios
                    FROM eventos e
                    JOIN plantadas p ON e.id = p.evento
                    JOIN especies es ON p.especie = es.nombre";

        // Construir la cláusula WHERE según los filtros proporcionados
        $whereClauses = [];
        if ($filtroAnyo) {
            $whereClauses[] = "YEAR(e.fecha) = :anyo";
        }
        if ($filtroUbicacion) {
            $whereClauses[] = "e.ubicacion LIKE :ubicacion";
        }
        if ($filtroBeneficio) {
            $whereClauses[] = "es.beneficios LIKE :beneficio";
        }

        // Agregar la cláusula WHERE a la consulta si hay filtros aplicados
        if (!empty($whereClauses)) {
            $query .= " WHERE " . implode(" AND ", $whereClauses);
        }

        // Agrupar y ordenar los resultados
        $query .= " GROUP BY e.ubicacion, p.especie, e.fecha";

        $statement = $pdo->prepare($query);

        // Asignar valores a los parámetros de los filtros
        if ($filtroAnyo) {
            $statement->bindParam(':anyo', $filtroAnyo, PDO::PARAM_INT);
        }
        if ($filtroUbicacion) {
            $statement->bindParam(':ubicacion', $filtroUbicacion, PDO::PARAM_STR);
        }
        if ($filtroBeneficio) {
            $statement->bindParam(':beneficio', $filtroBeneficio, PDO::PARAM_STR);
        }

        $statement->execute();

        $pdo = null;

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>