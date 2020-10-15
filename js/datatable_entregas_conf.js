$(document).ready(function() {			   
	$('#datatable').DataTable( {	
		"scrollX": true,
        "bDeferRender": true,
		"sPaginationType": "full_numbers",				
		"columns": [
			{ "data": "Codigo" },
			{ "data": "Usuario" },
			{ "data": "Nombres" },
			{ "data": "Apellidos" },
			{ "data": "Entrega" },
			{ "data": "Calificacion" },
			{ "data": "Puntaje" },
			{ "data": "Opciones" }
		],
		"oLanguage": {
            "sProcessing": "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="20">20</option>'+
		        '<option value="30">30</option>'+
		        '<option value="40">40</option>'+
		        '<option value="50">50</option>'+
		        '<option value="-1">All</option>'+
		        '</select> alumnos',    
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando (_START_ al _END_) / _TOTAL_ alumnos",
		    "sInfoEmpty":      "Mostrando 0 al 0 / 0 alumnos",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ alumnos)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Filtrar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Por favor espere - cargando...",
		    "oPaginate": {
		        "sFirst":    "|<",
		        "sLast":     ">|",
		        "sNext":     ">",
		        "sPrevious": "<"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
        }
	});
});