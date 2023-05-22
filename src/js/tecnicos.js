const icono_desplazar_abajo = document.getElementsByClassName('icono-desplazar-abajo');

let peticion = new XMLHttpRequest();

const tecnico = {
    id: null,
    nombre: null,
    apellidoP: null,
    apellidoM: null,
    rol: null,
    areaComplejo: null,
    email: null,
    contrasena: null,
    incidenciasAsignadas: []
}

//recolectar informacion del tecnico al hacer click
const informacionTecnico = () => {
    peticion.open('GET', '', true);
}