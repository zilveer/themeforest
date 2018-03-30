jQuery(document).ready(function($) {
	var items = $('#testimonials_items');
	
	items.sortable({
		update: function(event, ui) {
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
				    action: 'testimonials_apply_sort',
				    order: items.sortable('toArray').toString() 
				},
				success: function(response) {
				    return;
				},
				error: function(xhr,textStatus,e) {
				    alert('There was an error saving the update.');
				    return;
				}
			});
		}
	});
});