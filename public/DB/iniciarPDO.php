<?php
function iniciarPDO(): PDO {
    $env = parse_ini_file('../.env');
    $host = $env["IP"];
    $dbname = $env["DATABASE"];
    $user = $env["USUARIO"];
    $pass = $env["PASSWORD"];

    //Inicia la conexion a la DB
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    return $pdo;
}
?>