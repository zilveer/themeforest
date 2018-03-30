jQuery(document).ready(function($) {
	
	// Error variable
	var air_form_error;

	// Add new sidebar check
	$('#air-sidebar-new').click(function() {
		// Set error variable to false
		air_form_error = false;

		// Get field
		var name = $('input[name="air-sidebar[name]"]');

		// Check name
		if(name.val() == '') {
			name.addClass('air-error');
			air_form_error = true;
		}

		// Exit if error
		if(air_form_error) { return false; }
	});

	// Update sidebar(s) check
	$('#air-sidebar-update').click(function() {
		// Set error variable to false
		air_form_error = false;

		// Loop through fields
		$('.air-table td.name input').each(function() {
			// Check name
			if($(this).val() == '') {
				$(this).addClass('air-error');
				air_form_error = true;
			}
		});

		// Exit if error
		if(air_form_error) { return false; }
	});

	// Remove link
	$('a.air-link-delete').click(function(){
		if( confirm('Are you sure you want to remove this item?')) {
			var tr = $(this).parent().parent('tr');
			tr.remove();
			return false;
		}
	});
});
