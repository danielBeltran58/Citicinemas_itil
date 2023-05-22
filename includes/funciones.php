<?php

//funciones para debugear
function debugear( $nombre ) {
    echo '<pre>';
    var_dump($nombre);
    echo '</pre>';
}

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ .  '/funciones.php');
define('CONTROLLERS_URL', __DIR__ .  '/controllers');

function incluirTemplate( $nombre ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function incluirControllers( $nombre ) {
    include CONTROLLERS_URL . "/${nombre}.php";
}

function devolverVistaLogin() {
    return "/views/auth/login.php";
}

function devolverVistaGlobal( $nombre ) {
    return "/views/global/${nombre}.php";
}

function devolverVistaJefesDepartamento( $nombre ) {
    return "/views/viewsJefeDepartamento/${nombre}.php";
}

function devolverVistaTecnicos( $nombre ) {
    return "/views/viewsTecnicos/${nombre}.php";
}

//funciones generales
//devolver fecha actual
function fechaActual() {
    $date = date('Y-m-d');
    return $date;
}
//devolver arreglo de fechas
function devolverArregloFechas() {
    $date = date('Y-m-d');
    $modDate = strtotime( $date . '+ 1 day' );
    $fechas = [];
    for ( $i = 0; $i < 30; $i++ ) {
        $fechas[] = date( 'Y-m-d', strtotime( $date . "+ {$i} day" ) );
    }
    return $fechas;
}
//dar formato a fecha con nombre
function formatearFecha( $fecha ) {
    $date = DateTime::createFromFormat( 'Y-m-d', $fecha );
    return $date->format('D d M Y');
}

//models
use Models\Empleado;
use Models\Activo;
use Models\Computadora;
use Models\Impresora;
use Models\Incidencia;

function llenarEmpleado() {
    session_start();
    return new Empleado(
        $_SESSION['empleado']['id'],
        $_SESSION['empleado']['nombre'],
        $_SESSION['empleado']['apellidoP'],
        $_SESSION['empleado']['apellidoM'],
        $_SESSION['empleado']['rol'],
        $_SESSION['empleado']['areaComplejo'],
        $_SESSION['empleado']['email'],
        $_SESSION['empleado']['contrasena']
    );
}

function devolverEmpleadoPorId( $conn, $id ) {
    $empleado = null;
    $sql = $conn->query("select * from Empleado where id = '{$id}'");
    if(mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_assoc($sql)) {
            $empleado = new Empleado(
                $row['id'],
                $row['nombre'],
                $row['apellidoP'],
                $row['apellidoM'],
                $row['rol'],
                $row['areaComplejo'],
                $row['email'],
                $row['contrasena']
            );
        }
    }
    return $empleado;
}

function llenarActivos( $idAreaComplejo, $conn ) {
    $sql = $conn->query("select * from activo where activo.areaComplejo = '{$idAreaComplejo}'");
    $activos = [];
    while($activo = $sql->fetch_assoc()) {
        $activos[] = new Activo(
            $activo['id'],
            $activo['areaComplejo'],
            $activo['estado']
        );
    }
    return $activos;
}

function llenarActivosComputadoras( $idAreaComplejo, $conn ) {
    $sql = $conn->query("select * from activo inner join Computadora on activo.id = computadora.activo where activo.areaComplejo = '{$idAreaComplejo}'");
    $activos = [];
    while($activo = $sql->fetch_assoc()) {
        $activos[] = new Computadora(
            $activo['id'],
            $activo['areaComplejo'],
            $activo['estado'],
            $activo['modelo'],
            $activo['marca'],
            $activo['almacenamiento'],
            $activo['ram'],
            $activo['procesador'],
            $activo['tarjetaGrafica'],
            $activo['sistemaOperativo']
        );
    }
    return $activos;
}

function llenarActivosImpresoras( $idAreaComplejo, $conn ) {
    $sql = $conn->query("select * from activo inner join Impresora on activo.id = impresora.activo where activo.areaComplejo = '{$idAreaComplejo}'");
    $activos = [];
    while($activo = $sql->fetch_assoc()) {
        $activos[] = new Impresora(
            $activo['id'],
            $activo['areaComplejo'],
            $activo['estado'],
            $activo['marca'],
            $activo['modelo'],
            $activo['tipoConector'],
            $activo['tecnologiaImpresion'],
            $activo['velocidadImpresionMonocromatrica'],
            $activo['velocidadImpresionColor'],
        );
    }
    return $activos;
}

//funciones
//devolver empleados tecnicos por id de area
function devolverTecnicosIdArea( $idAreaComplejo, $conn ) {
    $sql = $conn->query("select * from empleado where empleado.areaComplejo = '{$idAreaComplejo}' and empleado.rol = 'TECNICO'");
    $tecnicos = [];
    while($tecnico = $sql->fetch_assoc()) {
        $tecnicos[] = new Empleado(
            $tecnico['id'],
            $tecnico['nombre'],
            $tecnico['apellidoP'],
            $tecnico['apellidoM'],
            $tecnico['rol'],
            $tecnico['areaComplejo'],
            $tecnico['email'],
            $tecnico['contrasena']
        );
    }
    return $tecnicos;
}

function devolverIncidenciasRecientesPorTecnico( $tecnico, $conn ) {
    $sql = $conn->query("select * from Incidencia where tecnico = '{$tecnico}'");
    $incidencias = [];
    while($incidencia = $sql->fetch_assoc()) {
        $incidencias[] = new Incidencia(
            $incidencia['id'],
            $incidencia['activo'],
            $incidencia['asunto'],
            $incidencia['tecnico'],
            $incidencia['inicio'],
            $incidencia['termino'],
            $incidencia['estado'],
        );
    }
    return $incidencias;
}