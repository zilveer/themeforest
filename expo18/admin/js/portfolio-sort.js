jQuery(document).ready(function($) {
	var portfolioItems = $('#portfolio_items');
	
	portfolioItems.sortable({
		update: function(event, ui) {
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
				    action: 'portfolio_apply_sort',
				    order: portfolioItems.sortable('toArray').toString() 
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