jQuery(document).ready(function(){
	"use strict";
	
	/* Drag and drop widget on sidebar */
	if(jQuery( ".widget-area > ul" ).length > 0){
		jQuery( ".widget-area > ul" ).sortable({
			placeholder: "ui-state-highlight",
			update: function(event, ui) {
				var order = jQuery(this).sortable("toArray").join();
				jQuery.cookie("drap_drop_" + jQuery(this).attr('id'), order,{expires: 7,path:'/'});
			}
		});
		// Reorder widgets
		jQuery( ".widget-area > ul" ).each(function(){
			var ul = jQuery(this);
			if(jQuery.cookie("drap_drop_" + ul.attr('id'))){
				var orderings = jQuery.cookie("drap_drop_" + ul.attr('id')).split(",");
				jQuery.each(orderings, function(index, ordering) {
					ul.find('li#' + ordering).appendTo(ul);
				});

			}
		});
	}
	
});
