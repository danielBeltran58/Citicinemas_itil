<?php

require '../../includes/app.php';
incluirTemplate('header');

use Models\Computadora;

$conn = conectarDB();
$empleado = llenarEmpleado();

$computadoraModelo = $_POST['computadoraModelo'];
$computadoraMarca = $_POST['computadoraMarca'];
$computadoraSistemaOperativo = $_POST['computadoraSistemaOperativo'];
$computadoraAlmacenamiento = $_POST['computadoraAlmacenamiento'];
$computadoraRAM = $_POST['computadoraRAM'];
$computadoraProcesador = $_POST['computadoraProcesador'];
$computadoraTarjetaGrafica = $_POST['computadoraTarjetaGrafica'];
$areaComplejo = $empleado->getAreaComplejo();

if( !empty($computadoraModelo) && !empty($computadoraMarca) && !empty($computadoraSistemaOperativo) && !empty($computadoraAlmacenamiento) && !empty($computadoraRAM) && !empty($computadoraProcesador) && !empty($computadoraTarjetaGrafica) ) {
    $computadora = new Computadora(
        null,
        $areaComplejo,
        null,
        $computadoraModelo,
        $computadoraMarca,
        $computadoraAlmacenamiento,
        $computadoraRAM,
        $computadoraProcesador,
        $computadoraTarjetaGrafica,
        $computadoraSistemaOperativo
    );
    $computadora->registrarComputadora( $conn );
    header( "Location: " . devolverVistaGlobal('consultarActivos') );
} else {
    echo 'Campos incompletos';
}

?>

<div class="contenedor">
    <h1>Nuevo activo</h1>
    <form action="#" method="post" id="formulario-nuevo-activo">
        <fieldset>
            <legend>Información básica</legend>
            <div class="informacion-basica">
                <div>
                    <label for="computadoraModelo">Modelo</label>
                    <input 
                    type="text"
                    name="computadoraModelo"
                    class="input-text"
                    >
                </div>
                <div>
                    <label for="computadoraMarca">Marca</label>
                    <select 
                    name="computadoraMarca"
                    class="select"
                    >
                        <option value="HP">HP</option>
                        <option value="APPLE">APPLE</option>
                        <option value="ACER">ACER</option>
                    </select>
                </div>
                <div>
                    <label for="computadoraSistemaOperativo">Sistema operativo</label>
                    <select 
                    name="computadoraSistemaOperativo"
                    class="select"
                    >
                        <option value="WINDOWS 10">WINDOWS 10</option>
                        <option value="WINDOWS 11">WINDOWS 11</option>
                        <option value="MACOS">MACOS</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Especificaciones tecnicas</legend>
            <div class="especificaciones-tecnicas">
                <div>
                    <label for="computadoraAlmacenamiento">Almacenamiento (GB)</label>
                    <select 
                    name="computadoraAlmacenamiento"
                    class="select"
                    >
                        <option value="256">256</option>
                        <option value="512">512</option>
                        <option value="1012">1012</option>
                    </select>
                </div>
                <div>
                    <label for="computadoraRAM">RAM (GB)</label>
                    <select 
                    name="computadoraRAM"
                    class="select"
                    >
                        <option value="8">8</option>
                        <option value="16">16</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div>
                    <label for="computadoraProcesador">Procesador</label>
                    <input 
                    type="text"
                    name="computadoraProcesador"
                    class="input-text"
                    >
                </div>
                <div>
                    <label for="computadoraTarjetaGrafica">Tarjeta gráfica</label>
                    <input 
                    type="text"
                    name="computadoraTarjetaGrafica"
                    class="input-text"
                    >
                </div>
            </div>
        </fieldset>
        <input 
        type="submit"
        class="btn"
        >
    </form>
</div>