<?php 
require_once('../models/Evento.php');

// Obtener los valores de los filtros del formulario
$filtroAnyo = isset($_GET['filtroAnyo']) ? $_GET['filtroAnyo'] : null;
$filtroUbicacion = isset($_GET['filtroUbicacion']) ? '%' . $_GET['filtroUbicacion'] . '%' : null;
$filtroBeneficio = isset($_GET['filtroBeneficio']) ? '%' . $_GET['filtroBeneficio'] . '%' : null;

$logros = Evento::obtenerLogros($filtroAnyo, $filtroUbicacion, $filtroBeneficio);
include('../views/vistaLogros.php');
?>