<?php

function conectarDB() {
    $conn = new mysqli( 'localhost', 'root', '', 'itil_v2' );
    return $conn;
}