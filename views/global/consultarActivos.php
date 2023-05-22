<?php

require '../../includes/app.php';
incluirTemplate('header');

$conn = conectarDB();
$empleado = llenarEmpleado();
$activosComputadoras = llenarActivosComputadoras( $empleado->getAreaComplejo(), $conn );
$activosImpresoras = llenarActivosImpresoras( $empleado->getAreaComplejo(), $conn );

?>

<div class="contenedor">
    <div class="cabecera-tabla-activos">
        <h1>
            Activos : 
            <?php echo $empleado->devolverNombreAreaComplejoPorId( $conn ); ?>
        </h1>
    </div>
    <div class="contenedor-activos-computadoras">
        <?php foreach ( $activosComputadoras as $computadora ) { ?>
            <article class="articulo-activo-computadora">
                <h1>ID Activo: <?php echo $computadora->id ?></h1>
                <h1>Estado: <?php echo $computadora->devolverContextoEstado() ?> </h1>
                <div class="activo-computadora-modelo-marca">
                    <h2>Modelo: <?php echo $computadora->modelo ?> </h2>
                    <h2>Marca: <?php echo $computadora->marca ?> </h2>
                </div>
                <div class="activo-computadora-almacenamiento-ram">
                    <h2>Almacenamiento: <?php echo $computadora->almacenamiento ?> GB </h2>
                    <h2>RAM: <?php echo $computadora->ram ?> GB </h2>
                </div>
                <div class="activo-computadora-procesador-tarjeta">
                    <h2>Procesador: <?php echo $computadora->procesador ?>  </h2>
                    <h2>Tarjeta Grafica: <?php echo $computadora->tarjetaGrafica ?>  </h2>
                </div>
                <div class="activo-computadora-acciones">
                    <div>
                        <a href="" class="btn">Ver Más</a>
                    </div>
                    <div class="consultar-activos-acciones">
                        <p class="btn-danger">Eliminar</p>
                        <p class="btn-secondary">Modificar</p>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>

    <div class="contenedor-activos-impresoras">
        <?php foreach ( $activosImpresoras as $impresora ) { ?>
            <article class="articulo-activo-impresora">
                <h1>ID Activo: <?php echo $impresora->id ?></h1>
                <h1>Estado: <?php echo $impresora->devolverContextoEstado() ?> </h1>
                <div class="activo-computadora-modelo-marca">
                    <h2>Modelo: <?php echo $impresora->modelo ?> </h2>
                    <h2>Marca: <?php echo $impresora->marca ?> </h2>
                </div>
                <div class="activo-impresora-detalles">
                    <h2>Tipo de conector: <?php echo $impresora->devolverContextoTipoConector() ?> </h2>
                    <h2>
                        Tecnología de impresion: 
                        <?php echo $impresora->devolverContextoTecnologiaImpresion() ?> 
                    </h2>
                    <h2>
                        Velocidad Monocromatrica: 
                        <?php echo $impresora->velocidadImpresionMonocromatrica ?>  
                        ppm
                    </h2>
                    <h2>
                        Velocidad color: 
                        <?php echo $impresora->velocidadImpresionColor ?> 
                        ppm 
                    </h2>
                </div>
                <div class="activo-computadora-acciones">
                    <div>
                        <a href="#" class="btn">Ver Más</a>
                    </div>
                    <div class="consultar-activos-acciones">
                        <p class="btn-danger">Eliminar</p>
                        <p class="btn-secondary">Modificar</p>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</div>

<script src="../../../src/js/activo.js"></script>