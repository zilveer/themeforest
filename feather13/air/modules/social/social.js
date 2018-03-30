jQuery(document).ready(function($) {
	
	// Error variable
	var air_form_error;

	// Icons tabs
	$('#air-icons-tabs').tabs();

	// Check for input
	$('#air-social-submit').click(function() {
		// Clear errors
		$('.bandit-sb-form input').removeClass('error');
		air_form_error = false;

		// Get field values
		var url = $('input[name="air-social[url]"]');
		var name = $('input[name="air-social[name]"]');
		var icon = $('input[name="air-social[icon]"]');

		// Check URL
		if( url.val() == '' || url.val() == 'http://' ) {
			url.addClass('air-error');
			air_form_error = true;
		}

		// Check Name
		if(name.val() == '') {
			name.addClass('air-error');
			air_form_error = true;
		}

		// Check Icon
		if(icon.val() == '') {
			icon.addClass('air-error');
			air_form_error = true;
		}

		// Exit if error
		if(air_form_error) { return false; }
	});

	// Add icon URL to icon text field
	$('.air-social-icons li img').click(function() {
		icon_url = $(this).attr('src');
		$('input[name="air-social[icon]"]').val(icon_url);
	});

	// Sortable links
	$('.sortable').sortable({
		handle: 'a.air-link-move',
		helper: function(e, tr) {
			var originals = tr.children();
			var helper = tr.clone();
			helper.children().each(function(index) {
		  		// Set helper cell sizes to match the original sizes
		  		$(this).width(originals.eq(index).width() + 15)
			});
			return helper;
		}
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