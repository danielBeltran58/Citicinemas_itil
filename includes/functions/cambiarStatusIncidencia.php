<?php

require '../app.php';

$conn = conectarDB();

$incidencia = intval( $_GET['incidencia'] );
$activo = intval( $_GET['activo'] );

$sql = $conn->query("update incidencia set estado = '3' where id = '{$incidencia}'");
$sqlActivo = $conn->query("update activo set estado = '1' where id = '{$activo}'")

?>