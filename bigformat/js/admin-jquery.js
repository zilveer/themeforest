// JavaScript Document
jQuery(window).load(function(){ 
								
	if (jQuery('.nohide').is(':checked') ) {
		jQuery('.postbox .hidden').show();
	}

	jQuery('.nohide').click( function() {
		jQuery('.postbox .hidden').css('display', 'table-row');
	});
		
	jQuery('.hide').click( function() {
		jQuery('.postbox .hidden').css('display', 'none');
	});
	

});