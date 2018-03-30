if(typeof(yourFunctionName) != 'function') {
	function om_items_sort(selector, action) {
		var portfolioItems = jQuery(selector);
		
		portfolioItems.sortable({
			update: function(event, ui) {
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					async: true,
					cache: false,
					dataType: 'json',
					data:{
					    action: action,
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
	}
}