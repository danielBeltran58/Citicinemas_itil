const contenido = document.getElementById('incidencias-tecnico');
const btn_eliminar = document.getElementsByClassName('eliminar');
const incidencias = contenido.children;

const eliminarIncidencia = ( idIncidencia ) => {
    let url = 'http://localhost:4000/includes/functions/eliminarIncidencia.php';
    if( idIncidencia === '') {
        return;
    } else {
        let peticion = new XMLHttpRequest();
        peticion.onreadystatechange = () => {
            if( peticion.readyState === 4 && peticion.status === 200 ) {
                console.log('incidencia eliminada :)');
            }
        }
        peticion.open(
            "GET", 
            url + '?incidencia=' + idIncidencia,
            true
        );
        peticion.send();
    }
}

const completarIncidencia = ( idIncidencia, idActivo ) => {
    if( idIncidencia === '') {
        return;
    } else {
        let url = 'http://localhost:4000/includes/functions/cambiarStatusIncidencia.php';
        let peticion = new XMLHttpRequest();
        peticion.onreadystatechange = () => {
            if( peticion.readyState === 4 && peticion.status === 200 ) {
                console.log('incidencia modificada :)');
            }
        }
        peticion.open(
            "GET",
            url + '?incidencia=' + idIncidencia + '&activo=' + idActivo,
            true
        );
        peticion.send();
    }
}

const cambiarTecnico = ( idIncidencia, tecnico ) => {
    let url = ''
}

for( let i = 0; i < incidencias.length; i++ ) {
    const incidencia = incidencias[i];
    const objIncidencia = {
        idActivo: incidencia.querySelector('.id-activo').textContent,
        idIncidencia: incidencia.querySelector('.id-incidencia').textContent,
        tecnico: incidencia.querySelector('.nom-tecnico').textContent,
        asunto: incidencia.querySelector('.asunto').textContent,
        inicio: incidencia.querySelector('.inicio').textContent,
        termino: incidencia.querySelector('.termino').textContent,
        estado: incidencia.querySelector('.estado').textContent
    }
    incidencia.querySelector('.eliminar').addEventListener('click', () => {
        eliminarIncidencia( objIncidencia.idIncidencia );
    });
    incidencia.querySelector('.completar').addEventListener('click', () => {
        completarIncidencia( objIncidencia.idIncidencia, objIncidencia.idActivo );
    });
    incidencia.querySelector('#cambiar-tecnico').addEventListener('click', () => {
        
    })
}