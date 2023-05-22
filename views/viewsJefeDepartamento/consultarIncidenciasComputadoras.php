<?php

require '../../includes/app.php';
incluirTemplate('header');

$conn = conectarDB();

$empleado = llenarEmpleado();
$incidencias = $empleado->devolverIncidenciasDeAreaComputadora( $conn );
$tecnicos = $empleado->devolverTecnicosPorArea( $conn );

?>