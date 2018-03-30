jQuery(document).ready(function() {

	

	function admin_portfolio_reorder(){
		var portfolio_List = jQuery('#portfolio-reorder-lists');
		
		portfolio_List.sortable({
			update: function(event, ui) {
				
				opts = {
					url: ajaxurl,
					type: 'POST',
					async: true,
					cache: false,
					dataType: 'json',
					data:{
						action: 'portfolio_reorder',
						order: portfolio_List.sortable('toArray').toString() 
					},
					success: function(response) {
						return;
					},
					error: function(xhr,textStatus,e) {
						return;
					}
				};
				jQuery.ajax(opts);
			}
		});
	}

	admin_portfolio_reorder();
});