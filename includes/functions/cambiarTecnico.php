<?php

require '../app.php';

$conn = conectarDB();

$incidencia = intval( $_GET['incidencia'] );
$tecnico = intval( $_GET['tecnico'] );

?>