
const burger = document.getElementById('burger');
const menu = document.getElementById('menu');

    burger.addEventListener('click', () => {
        if(menu.style.display == 'none'){
            menu.style.display ='block';
        }
        else{
            menu.style.display ='none';
        }     
});