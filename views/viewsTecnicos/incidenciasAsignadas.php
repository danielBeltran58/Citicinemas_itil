<?php

require '../../includes/app.php';
incluirTemplate('header');

$conn = conectarDB();
$empleado = llenarEmpleado();
$incidencias = $empleado->devolverIncidenciasDeTecnico($conn);
$estadoContexto = '';

?>

<div id="incidencias-asignadas-tecnico" class="contenedor">
    <div class="barra-superior">
        <div>
            <h1>Incidencias Asignadas</h1>
            <h2>Tecnico: <?php echo $empleado->devolverNombreCompleto(); ?> </h2>
        </div>
        <div>
            <h1>Departamento: <?php echo $empleado->devolverNombreAreaComplejoPorId($conn); ?></h1>
        </div>
    </div>
    <div class="contenedor-incidencias">
        <?php foreach ( $incidencias as $inc ) { ?>
            <div class="incidencia bordeado">
                <h3>Activo: <?php echo $inc->activo; ?></h3>
                <p><?php echo $inc->asunto; ?></p>
                <div class="fechas">
                    <p><span>Fecha de inicio: </span> <?php echo formatearFecha($inc->inicio); ?></p>
                    <p><span>Fecha de termino: </span><?php echo formatearFecha($inc->termino); ?></p>
                </div>
                <div class="estado-incidencia">
                    <h3>Estado: </h3>
                    <?php 
                    switch ($inc->devolverContextoEstadoIncidencia()) {
                        case 'EN PROCESO':
                            $estadoContexto = 'estado-warning';
                            break;
                        case 'COMPLETADO':
                            $estadoContexto = 'estado-success';
                            break;
                        case 'RETRASADO':
                            $estadoContexto = 'estado-danger';
                            break;
                    }
                    ?>
                    <h3 class=<?php echo $estadoContexto ?>>
                        <?php echo $inc->devolverContextoEstadoIncidencia() ?>
                    </h3>
                </div>
            </div>
        <?php } ?>
    </div>
</div>