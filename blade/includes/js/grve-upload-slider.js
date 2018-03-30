jQuery(document).ready(function($) {

	"use strict";

	var grveMediaSliderFrame;
	var grveMediaSliderContainer = $( "#grve-slider-container" );
	grveMediaSliderContainer.sortable();

	$('.grve-slider-item-delete-button').click(function() {
		$(this).parent().remove();
	});

	$('.grve-upload-slider-button').click(function() {

        if ( grveMediaSliderFrame ) {
            grveMediaSliderFrame.open();
            return;
        }

        grveMediaSliderFrame = wp.media.frames.grveMediaSliderFrame = wp.media({
            className: 'media-frame grve-media-slider-frame',
            frame: 'select',
            multiple: 'toggle',
            title: grve_upload_slider_texts.modal_title,
            library: {
                type: 'image'
            },
            button: {
                text:  grve_upload_slider_texts.modal_button_title
            }

        });
        grveMediaSliderFrame.on('select', function(){
			var selection = grveMediaSliderFrame.state().get('selection');
			var ids = selection.pluck('id');
			
			$('#grve-upload-slider-button-spinner').show();

			$.post( grve_upload_slider_texts.ajaxurl, { action:'blade_grve_get_slider_media', attachment_ids: ids.toString() } , function( mediaHtml ) {
				grveMediaSliderContainer.append(mediaHtml);
				$('.grve-slider-item-delete-button.grve-item-new').click(function() {
					$(this).parent().remove();
				}).removeClass('grve-item-new');
				
				$('#grve-upload-slider-button-spinner').hide();
			});
        });
        grveMediaSliderFrame.on('ready', function(){
			$( '.media-modal' ).addClass( 'grve-media-no-sidebar' );
        });


        grveMediaSliderFrame.open();
    });


});