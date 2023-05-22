<?php

require '../../includes/app.php';
incluirTemplate('header');

use Models\Incidencia;

$conn = conectarDB();
$empleado = llenarEmpleado();
$activosComputadoras = llenarActivosComputadoras( $empleado->getAreaComplejo(), $conn );
$activosImpresoras = llenarActivosImpresoras( $empleado->getAreaComplejo(), $conn );
$activos = array_merge( $activosComputadoras, $activosImpresoras );
$tecnicos = devolverTecnicosIdArea( $empleado->getAreaComplejo(), $conn );
$fechas = devolverArregloFechas();

$activo = $_POST['activo'];
$tecnico = $_POST['tecnico'];
$asunto = $_POST['asunto'];
$inicio = fechaActual();
$termino = $_POST['termino'];
$estado = '1';

if( $activo != null && $tecnico != null && $asunto != null && $termino != null ) {
    $incidencia = new Incidencia(
        null,
        $activo,
        strtoupper( $asunto ),
        $tecnico,
        $inicio,
        $termino,
        $estado
    );
    $incidencia->registrarIncidencia( $conn );
    $conn->close();
    header( "Location: " . devolverVistaGlobal('consultarActivos') );
} else {
    echo 'Campos incompletos';
}

?>

<div class="contenedor">
    <h1 class="levantar-incidencia-titulo">Nueva Incidencia</h1>
    <form action="#" method="POST" id="formulario-nueva-incidencia">
        <fieldset class="nueva-incidencia-activo">
            <legend>Activo</legend>
            <div>
                <label for="activo">Activo</label>
                <select name="activo" class="select">
                    <?php foreach ( $activos as $activo ) { ?>
                        <option value=<?php echo $activo->id ?>>
                            <?php echo $activo->devolverInformacionSelect() ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="tecnico">Técnico</label>
                <select name="tecnico" class="select">
                    <?php foreach ( $tecnicos as $tecnico ) { ?>
                        <option value=<?php echo $tecnico->getId(); ?>>
                            <?php echo $tecnico->devolverNombreCompleto(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <h2>
                Departamento de 
                <?php echo $empleado->devolverNombreAreaComplejoPorId( $conn ) ?>
            </h2>
        </fieldset>
        <fieldset class="nueva-incidencia-general">
            <legend>General</legend>
            <div>
                <label for="asunto">Asunto</label>
                <textarea name="asunto"></textarea>
            </div>
            <div class="nueva-incidencia-general-fechas">
                <div>
                    <p>Fecha de inicio</p>
                    <p><?php echo fechaActual(); ?></p>
                </div>
                <div>
                    <label for="termino">Fecha de Termino</label>
                    <select name="termino" class="select">
                        <?php foreach ($fechas as $fecha) { ?>
                            <option value=<?php echo $fecha ?>>
                                <?php echo $fecha ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <input 
        class="btn"
        type="submit" 
        value="Enviar"
        >
    </form>
</div>