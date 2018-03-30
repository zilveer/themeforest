jQuery(document).ready( function() {
	jQuery('#switch').click( function () {
		if ( jQuery(this).hasClass('close') ) {
			jQuery('.thumb-list').slideDown("slow");
			jQuery(this).removeClass('close');
		} else {
			jQuery('.thumb-list').slideUp("slow");
			jQuery(this).addClass('close');
		}	
	});	
	jQuery('.regular-text1').change(function(){
		var hex = this.value;
		var id = this.id;
		jQuery('#' + id).css('backgroundColor', '#' + hex);
	 });
	 jQuery('#tab-container').easytabs();
});