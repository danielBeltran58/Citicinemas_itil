<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <?php

    require '../../includes/app.php';

    $conn = conectarDB();
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    if(!empty($email) && !empty($contrasena)) {
        if( login( $email, $contrasena, $conn ) ) {
            switch ( $_SESSION['empleado']['rol'] ) {
                case 'JEFE':
                    header( "Location: " . devolverVistaGlobal('consultarActivos') );
                    break;
                case 'TECNICO': 
                    header( "Location: " . devolverVistaTecnicos('incidenciasAsignadas') );
                    break;
            }
        } else {
            echo 'error';
        }
    }

    ?>
    <div class="contenedor">
        <img 
        class="img-login"
        src="/build/assets/Logo.webp" 
        alt="Citicinemas"
        >
        <form action="#" method="POST" id="formulario-login">
            <fieldset>
                <legend>Iniciar Sesión</legend>
                <div class="campo-label-input">
                    <label for="email">email</label>
                    <input 
                    type="email" 
                    name="email"
                    class="input-text"
                    >
                </div>
                <div class="campo-label-input">
                    <label for="password">Contraseña</label>
                    <input 
                    type="password" 
                    name="contrasena"
                    class="input-text"
                    >
                </div>
                <input 
                class="btn"
                type="submit" 
                value="Enviar"
                >
            </fieldset>
        </form>
    </div>
</body>
</html>