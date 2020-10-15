//$(document).ready(function(){
//    if (screen.width < 1340){
//        document.getElementById('Derecha').classList.remove('col-sm-10');
//        document.getElementById('Derecha').classList.add('col-sm-12');
//    }
//});

const BtnToggle1 = document.querySelector('.contenido');

BtnToggle1.addEventListener('click', function(){
    document.getElementById('SectionIzq').classList.toggle('active');
});

//const BtnToggle2 = document.querySelector('.contenido1');
//BtnToggle2.addEventListener('click', function(){
//    document.getElementById('SectionDer').classList.toggle('active');
//});