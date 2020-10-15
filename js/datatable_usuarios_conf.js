$(document).ready(function() {			   
	$('#datatable2').DataTable( {	
		"scrollX": true,
        "bDeferRender": true,
		"sPaginationType": "full_numbers",				
		"columns": [
			{ "data": "Usuario" },
			{ "data": "Nombres" },
            { "data": "Apellidos" },
            { "data": "Email" },
            { "data": "Telefono" },
            { "data": "Estado" },
            { "data": "Rol" },
			{ "data": "Opciones" }
		],
		"oLanguage": {
            "sProcessing": "Procesando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="5">5</option>'+
		        '<option value="10">10</option>'+
		        '<option value="15">15</option>'+
		        '<option value="20">20</option>'+
		        '<option value="-1">All</option>'+
		        '</select> usuarios',    
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando (_START_ al _END_) / _TOTAL_ usuarios",
		    "sInfoEmpty":      "Mostrando 0 al 0 / 0 usuarios",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ usuarios)",
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