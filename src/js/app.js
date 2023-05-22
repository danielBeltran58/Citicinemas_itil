const icono_burger = document.querySelector('#icono-burger');
const menu_lateral = document.querySelector('#menu-lateral');

icono_burger.addEventListener('click', () => {
    menu_lateral.classList.contains('no-visible') ? 
    menu_lateral.classList.remove('no-visible') :
    menu_lateral.classList.add('no-visible');
});