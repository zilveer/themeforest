var WolfThemeAdminParams =  WolfThemeAdminParams || {};

;( function( $ ) {

	var wolfSliderButton = '<a href="#" class="wolf-slider-insert button insert-media add_media" data-editor="content" title="Add Media"><span class="wp-media-buttons-icon"></span>' + WolfThemeAdminParams.addSlider + '</a>';
	
	$( '.wp-media-buttons' ).append( wolfSliderButton );

	$( '.wolf-slider-insert' ).click( function( event ) {
		event.preventDefault();
		event.stopPropagation();
		var wolfSliderUploader = wp.media( {
				title : WolfThemeAdminParams.createSlider,
				button : {
					text : WolfThemeAdminParams.insertSlider
				},
				multiple : true
			} )
		.on( 'select', function(){
			
			var selection = wolfSliderUploader.state().get( 'selection' ),
				attachments = [],
				wolfImagesList,
				wolfImageSliderShortcode;
			selection.map( function( attachment ){
				attachment = attachment.toJSON();
				attachments.push( attachment.id );
			} );
			wolfImagesList = attachments.join(','),
				wolfImageSliderShortcode = '[wolf_images_slider ids="' + wolfImagesList + '"]';

			if ( window.tinyMCE ) {

				window.parent.send_to_editor( wolfImageSliderShortcode );
			}
		} )
		.open();
	} );
	
} )( jQuery );