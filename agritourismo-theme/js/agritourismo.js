
	
/* -------------------------------------------------------------------------*
 * 						WRAP PRICING TABLES	
 * -------------------------------------------------------------------------*/
 
	jQuery(document).ready(function() {
		var count = jQuery('.price-grid > div').length;
		if (!count) { count=1;};
		var columnSize = 12/count;

		var columnClass = "column"+columnSize;

		jQuery('.price-grid > div').attr('class',columnClass);
	});
	