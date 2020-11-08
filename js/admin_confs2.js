// Accedemos al botón
var ButtonAdmin = document.getElementById('Admin_Submit');

var Selected = $('input:radio[name=customRadioInline1]:checked').val();

// evento para el input radio del "si"
document.getElementById('customRadioInline1').addEventListener('click', function(e) {
    ButtonAdmin.disabled = true;
});

// evento para el input radio del "no"
document.getElementById('customRadioInline2').addEventListener('click', function(e) {
  ButtonAdmin.disabled = false;
});