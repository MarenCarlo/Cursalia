//$( function() {
//    $.datepicker.setDefaults({ dateFormat: 'dd/mm/yy' });
/*    $("#datepicker").datepicker({
        minDate: -0,
        maxDate: +30,
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true
    });
});*/

$('#datepicker').datepicker({
    format: "dd/mm/yyyy", 
    autoclose: true,
    minDate: -0,
    maxDate: +30,
    showButtonPanel: true,
    changeMonth: true,
    changeYear: true
}).on('changeDate', function(ev) {
    //funcion_que_se_ejecutara();
});