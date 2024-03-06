<?php 
require_once('../models/Especie.php');
$especies = Especie::obtenerEspecies();
include('../views/vistaEspecies.php');
?>