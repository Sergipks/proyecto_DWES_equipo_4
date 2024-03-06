<?php
require_once('../DB/iniciarPDO.php');
class Especie
{
    public static function obtenerEspecies() 
    {
        $pdo = iniciarPDO();
        $query = "SELECT * FROM especies";

        $statement = $pdo->prepare($query);
        $statement->execute();

        $pdo = null;

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>