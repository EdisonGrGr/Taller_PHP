<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\EmpleadoController;

$controller = new EmpleadoController();
$controller->crear();
?>
