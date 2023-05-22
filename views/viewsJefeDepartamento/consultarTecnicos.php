<?php

require '../../includes/app.php';
incluirTemplate('header');

$conn = conectarDB();
$empleado = llenarEmpleado();
$tecnicos = $empleado->devolverTecnicosPorArea($conn);

?>

<div id="consultar-tecnicos" class="contenedor">
    <div class="barra-superior">
        <h1>Técnicos</h1>
        <h3>Departamento: <?php echo $empleado->devolverNombreAreaComplejoPorId($conn) ?></h3>
    </div>
    <div class="lista-tecnicos">
        <?php foreach ($tecnicos as $tec) { ?>
            <article class="card-tecnico bordeado">
                <div class="card-tecnico-informacion">
                    <div class="card-tecnico-informacion-nombres">
                        <h3><?php echo $tec->devolverNombreCompleto() ?></h3>
                    </div>
                    <div class="card-tecnico-informacion-actividad">
                    <?php $incidencias = devolverIncidenciasRecientesPorTecnico($tec->getId(), $conn); ?>
                    <h3>Incidencias</h3>
                        <div>
                            <?php foreach ( $incidencias as $incidencia ) { ?>
                                <h4>
                                    <?php 
                                    echo $incidencia->inicio .
                                    ' ' . $incidencia->asunto;
                                    ?>
                                </h4>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="desplazar-abajo">
                    <img 
                    class="icono-desplazar-abajo"
                    src="/build/assets/icono-desplazar-abajo.svg" 
                    alt="icono-desplazar-abajo"
                    >
                </div>
            </article>
        <?php } ?>
    </div>
</div>
<script src="/src/js/tecnicos.js"></script>