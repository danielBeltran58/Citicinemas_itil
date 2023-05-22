<?php

require '../app.php';

$conn = conectarDB();

$incidencia = intval( $_GET['incidencia'] );

$sql = $conn->query("delete from incidencia where id = '{$incidencia}'");

?>