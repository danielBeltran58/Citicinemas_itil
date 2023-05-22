<?php

require '../../includes/app.php';
incluirTemplate('header');

use Models\Impresora;

$conn = conectarDB();
$empleado = llenarEmpleado();

$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$tipoConector = $_POST['tipoConector'];
$tecnologiaImpresion = $_POST['tecnologiaImpresion'];
$velocidadColor = $_POST['velocidadColor'];
$velocidadMonocromatrica = $_POST['velocidadMonocromatrica'];
$areaComplejo = $empleado->getAreaComplejo();

if( !empty($modelo) && !empty($marca) && !empty($tipoConector) && !empty($tecnologiaImpresion) && !empty($velocidadColor) && !empty($velocidadMonocromatrica) ) {
    $impresora = new Impresora(
        null,
        $areaComplejo,
        null,
        $marca,
        $modelo,
        $tipoConector,
        $tecnologiaImpresion,
        $velocidadMonocromatrica,
        $velocidadColor
    );
    $impresora->registrarImpresora( $conn );
    header( "Location: " . devolverVistaGlobal('consultarActivos') );
} else {
    echo 'Campos incompletos';
}

?>

<div class="contenedor">
    <h1>Nueva Impresora</h1>
    <form action="#" method="post" id="formulario-nuevo-activo">
        <fieldset>
            <legend>Información básica</legend>
            <div class="informacion-basica">
                <div>
                    <label for="modelo">Modelo</label>
                    <input 
                    type="text"
                    name="modelo"
                    class="input-text"
                    >
                </div>
                <div>
                    <label for="marca">Marca</label>
                    <select 
                    name="marca"
                    class="select"
                    >
                        <option value="HP">HP</option>
                    </select>
                </div>
                <div>
                    <label for="tipoConector">Tipo de conector</label>
                    <select 
                    name="tipoConector"
                    class="select"
                    >
                        <option value="1">USB</option>
                        <option value="2">BLUETOOTH</option>
                        <option value="3">USB Y BLUETOOTH</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Especificaciones tecnicas</legend>
            <div class="especificaciones-tecnicas">
                <div>
                    <label for="tecnologiaImpresion">Tecnología de impresión</label>
                    <select 
                    name="tecnologiaImpresion"
                    class="select"
                    >
                        <option value="1">INYECCION DE TINTA</option>
                        <option value="2">LASER</option>
                        <option value="3">TERMICA</option>
                    </select>
                </div>
                <div>
                    <label for="velocidadColor">Velocidad a color</label>
                    <input 
                    type="text"
                    name="velocidadColor"
                    class="input-text"
                    >
                </div>
                <div>
                    <label for="velocidadMonocromatrica">Velocidad monocromatrica</label>
                    <input 
                    type="text"
                    name="velocidadMonocromatrica"
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