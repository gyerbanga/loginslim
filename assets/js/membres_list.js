/* exported dt_config */
/*const dt_config = {
	'membres': {
		'columnDefs': [{
			'targets': [0],
			'searchable': false,
			'orderable': false,
			'width': '1%',
			'className': 'dt-body-center',
		}, {
			'targets': [2, 3],
			'className': 'dt-body-center',
		}, {
			'targets': [9],
			'width': '10%',
			'className': 'dt-body-center',
		}],
	}
};*/

$('#membres').dataTable( {
	'ajax': 'assets/ajax/ajax_membres.php',  //fichier json
	'columnDefs': [{
			'targets': [0],
			'searchable': false,
			'orderable': false,
			'width': '1%',
			'className': 'dt-body-center',
		}, {
			'targets': [2, 3],
			'className': 'dt-body-center',
		}, {
			'targets': [9],
			'width': '10%',
			'className': 'dt-body-center',
		}],
} );
/*jQuery(document).ready(function() {
	App.setPage('table_managed');
	App.init();
});*/
