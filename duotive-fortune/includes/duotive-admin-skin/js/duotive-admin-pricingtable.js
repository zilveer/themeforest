jQuery(document).ready(function() {
	jQuery('html, body').animate({scrollTop:0},0);		
	jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});								   
	jQuery(".transform").jqTransform();
	jQuery("#settings div.table-row:even").addClass('table-row-alternative');
	jQuery("#settings .table-row-last").prev('div').addClass('table-row-beforelast');	
	jQuery("#create-table div.table-row:even").addClass('table-row-alternative');
	jQuery('#create-table .table-row-last').prev('div').addClass('table-row-beforelast');			
}); 
jQuery(document).ready(function($) {
	jQuery(window).bind("load", function() {
		if ( window.location.hash ) 
		{
			var target_offset = jQuery(window.location.hash).offset();
			var target_top = target_offset.top;
			jQuery('html, body').animate({scrollTop:target_top}, 500);	
		}
	});
});
	