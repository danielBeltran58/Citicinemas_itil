const computadoras = document.getElementsByClassName('articulo-activo-computadora');
const impresoras = document.getElementsByClassName('articulo-activo-impresora');

const mostrarActivo = () => {
    let peticion = new XMLHttpRequest();
    peticion.open( 'GET', 'consultarActivos.php', true );
    peticion.setRequestHeader('Content-Type','application/x-ww-form-urlencode');
    peticion.onreadystatechange = () => {
        console.log(peticion.responseText);
    }
    peticion.send();
}

computadoras[0].addEventListener('click', mostrarActivo())