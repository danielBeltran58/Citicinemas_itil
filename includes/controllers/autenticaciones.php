<?php

function login( $email, $contrasena, $conn ) : bool {
    $conn = conectarDB();
    $sql = $conn->query( "select * from Empleado where email = '{$email}' and contrasena = '{$contrasena}'" );
    if( $sql->num_rows > 0 ) {
        session_start();
        $_SESSION['empleado'] = $sql->fetch_assoc();
        return true;
    } else {
        return false;
    }
}

function cerrarSesion() {
    session_destroy();
    header( "Location: " . devolverVistaLogin() );
}