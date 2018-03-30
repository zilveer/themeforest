jQuery(document).ready(function($){
	
	// Tabs shortcode
	var $tabs = $('.tabs');
	
	if ( $tabs.length ) {
	
		$tabs.tabs({});
	
	}
	
	// jQuery UI Accordion
	var $accordion = $('.accordion');
	
	var $accordion_collapsible = $('.accordion_collapsible');
	
	if ( $accordion.length ) {
	
		$accordion.accordion({
			autoHeight: false,
			//animate: 'easeInOutQuint',
			collapsible: false
		});
		
	}
		
	if ( $accordion_collapsible.length ) {
	
		$accordion_collapsible.accordion({
			autoHeight: false,			heightStyle: "content",			clearStyle: true,
			//animate: 'easeInOutQuint',
			collapsible: true,
			active: false
		});
		
	}

});
