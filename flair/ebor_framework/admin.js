jQuery(document).ready(function($) {
	
jQuery('.icon-selector').each(function(){
	var $this = jQuery(this),
		icon = jQuery(':selected', this).attr('data-icon');
		
	$this.prev().html(' ').html('<i class="'+ icon +'"></i>');
});

jQuery('body').on('change', '.icon-selector', function(){
	var $this = jQuery(this),
		icon = jQuery(':selected', this).attr('data-icon');
		
	$this.prev().html(' ').html('<i class="'+ icon +'"></i>');
});

jQuery( "ul.blocks" ).bind( "sortstop", function(event, ui) {
	
	//if moving column inside column, cancel it
	if(ui.item.hasClass('block-container')) {
		$parent = ui.item.parent()
		if( $parent.hasClass('block-container') || $parent.hasClass("column-blocks") ) { 
			jQuery(this).sortable('cancel');
			return false;
		}
	}

});

jQuery('.ebor-column-content').slideUp();

jQuery('.column-close').click(function(){
	jQuery(this).parent().next().slideToggle();
	return false;
});

function show_boxes(){

	//POST FORMAT GALLERY METABOXES
	if ( jQuery('input#post-format-gallery').is(':checked') || jQuery('input#post-format-image').is(':checked') ) {
		jQuery('#gallery_metabox').show();
	}
	else {
		jQuery('#gallery_metabox').hide();
	}
	
	
	//POST FORMAT LINK METABOXES
	if ( jQuery('input#post-format-link').is(':checked') ) {
		jQuery('#link_metabox').show();
	}
	else {
		jQuery('#link_metabox').hide();
	}
	
	
	//POST FORMAT QUOTE METABOXES
	if ( jQuery('input#post-format-quote').is(':checked') ) {
		jQuery('#quote_metabox').show();
	}
	else {
		jQuery('#quote_metabox').hide();
	}
	
	
	//POST FORMAT VIDEO METABOXES
	if ( jQuery('input#post-format-video').is(':checked') || jQuery('input#post-format-audio').is(':checked') ) {
		jQuery('#video_metabox').show();
	}
	else {
		jQuery('#video_metabox').hide();
	}
	
	
	//POST FORMAT ASIDE METABOXES
	if ( jQuery('input#post-format-aside').is(':checked') ) {
		jQuery('#aside_metabox').show();
	}
	else {
		jQuery('#aside_metabox').hide();
	}
	
	
	//POST FORMAT STATUS METABOXES
	if ( jQuery('input#post-format-status').is(':checked') ) {
		jQuery('#status_metabox').show();
	}
	else {
		jQuery('#status_metabox').hide();
	}
	
	
	//POST FORMAT CHAT METABOXES
	if ( jQuery('input#post-format-chat').is(':checked') ) {
		jQuery('#chat_metabox').show();
	}
	else {
		jQuery('#chat_metabox').hide();
	}

};

//CALL SHOW_BOXES
show_boxes();

//CALL SHOW_BOXES AGAIN ON INPUT CLICK
jQuery('input').click(function(){
	show_boxes();
});
	
});