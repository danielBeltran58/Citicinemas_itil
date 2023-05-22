<?php

require '../../includes/app.php';
incluirTemplate('header');

$conn = conectarDB();

$empleado = llenarEmpleado();
$incidencias = $empleado->devolverIncidenciasDeAreaImpresora( $conn );
$tecnicos = $empleado->devolverTecnicosPorArea( $conn );

?>

<div class="contenedor">
    <h1>Incidencias</h1>
    <div class="filtrado">
        
    </div>
    <div id="incidencias-tecnico">
        <?php foreach ( $incidencias as $i ) { ?>
            <div class="bordeado">
                <div class="informacion">
                    <div class="basico">
                        <h1>ID incidencia: <span class="id-incidencia"><?php echo $i->id ?></span></h1>
                        <h1>ID activo: <span class="id-activo"><?php echo $i->activo ?></span></h1>
                        <?php $tecnico = devolverEmpleadoPorId( $conn, $i->tecnico ); ?>
                        <h1>Técnico: <span class="nom-tecnico"><?php echo $tecnico->devolverNombreCompleto(); ?></span></h1>
                        <h1>Asunto: <span class="asunto"><?php echo $i->asunto ?></span></h1>
                    </div> 
                    <div class="fechas-estado">
                        <h1>Fecha de inicio: <span class="inicio"><?php echo $i->inicio; ?></span></h1>
                        <h1>Fecha de termino: <span class="termino"><?php echo $i->termino; ?></h1>
                        <?php if($i->devolverContextoEstadoIncidencia() === 'EN PROCESO') { ?>
                            <h1>Estado: <span class="btn estado"><?php echo 'EN PROCESO' ?></span></h1>
                        <?php } ?>
                        <?php if($i->devolverContextoEstadoIncidencia() === 'RETRASADO') { ?>
                            <h1>Estado: <span class="btn-danger estado"><?php echo 'RETRASADO' ?></span></h1>
                        <?php } ?>
                        <?php if($i->devolverContextoEstadoIncidencia() === 'COMPLETADO') { ?>
                            <h1>Estado: <span class="btn-success estado"><?php echo 'COMPLETADO' ?></span></h1>
                        <?php } ?>
                    </div>      
                </div>
                <div class="acciones">
                    <p class="btn-secondary modificar">Modificar</p>
                    <p id="" class="btn-danger eliminar">Eliminar</p>
                    <p class="btn-success completar">Completar</p>
                    <div>
                        <label for="cambiar-tecnico">Cambiar técnico</label>
                        <select id="cambiar-tecnico" class="select">
                            <?php foreach ( $tecnicos as $tec ) { ?>
                                <option value=<?php echo $tec->getId(); ?>>
                                    <?php echo $tec->devolverNombreCompleto(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="/src/js/incidencias.js"></script>