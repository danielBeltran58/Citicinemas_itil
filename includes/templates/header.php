<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <?php

    $conn = conectarDB();
    $empleado = llenarEmpleado();
    $enlacesBarraLateral = null;
    $enlacesBarraSuperior = null;

    switch ( $empleado->getRol() ) {
        case 'JEFE':
            $enlacesBarraSuperior = [
                [ 'Activos', devolverVistaGlobal('consultarActivos') ],
                [ 'Tecnicos', devolverVistaJefesDepartamento('consultarTecnicos') ],
                [ 'Incidencias', devolverVistaJefesDepartamento('consultarIncidencias') ]
            ];
            $enlacesBarraLateral = [
                [ 'Levantar incidencia', devolverVistaGlobal('levantarIncidencia') ],
                [ 'Nueva computadora', devolverVistaJefesDepartamento('nuevaComputadora') ],
                [ 'Nueva impresora', devolverVistaJefesDepartamento('nuevaImpresora') ]
            ];
            break;
        case 'TECNICO':
            $enlacesBarraSuperior = [
                [ 'Incidencias asignadas', devolverVistaTecnicos('incidenciasAsignadas') ]
            ];
            $enlacesBarraLateral = [];
            break;
    }

    ?>
    <header class="header">
        <div class="contenedor contenedor-header">
            <img 
            class="img-header"
            src="/build/assets/Logo.webp" 
            alt="Citicinemas"
            >
            <nav class="navegacion-header">
                <?php foreach ( $enlacesBarraSuperior as $enlace ) { ?>
                    <a href=<?php echo $enlace[1] ?> >
                        <?php echo $enlace[0] ?>
                    </a>
                <?php } ?>
                <img 
                src="/build/assets/icono-burger.svg" alt="menu"
                id="icono-burger"
                >
            </nav>
        </div>
    </header>
    <div id="menu-lateral" class="no-visible">
        <div id="perfil">
            <div id="foto">
                <img src="/build/assets/icono-perfil.svg" alt="imagen perfil">
            </div>
            <div id="nombre">
                <p> 
                    <?php 
                    echo $empleado->devolverNombreCompleto();
                    ?> 
                </p>
            </div>
            <div id="lugar-trabajo">
                <div>
                    <p>Corporativo: </p>
                    <p>
                        <?php echo $empleado->devolverNombreComplejo( $conn ) ?>
                    </p>
                </div>
                <div>
                    <p>Departamento: </p>
                    <p>
                        <?php echo $empleado->devolverNombreAreaComplejoPorId( $conn ); ?>
                    </p>
                </div>
                <div>
                    <p><?php echo $empleado->getRol(); ?></p>
                </div>
            </div>
        </div>
        <div id="navegacion">
            <nav>
                <?php foreach ( $enlacesBarraLateral as $enlace ) { ?>
                    <a href=<?php echo $enlace[1] ?> >
                        <?php echo $enlace[0] ?>
                    </a>
                <?php } ?>
            </nav>
        </div>
        <div id="sesion">
            <div class="sesion-parte">
                <img src="/build/assets/icono-cerrar-sesion.svg" alt="">
                <p onclick="">Cerrar Sesión</p>
            </div>
        </div>
    </div>
    <script src="/src/js/app.js"></script>
</body>
</html>