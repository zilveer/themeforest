jQuery(document).ready(function($) {

	"use strict";

	var grveMediaImageFrame;
	var grveMediaImageContainer = $( "#grve-feature-image-container" );


	$('.grve-image-item-delete-button').click(function() {
		$(this).parent().remove();
		$('.grve-upload-image-button').removeAttr('disabled').removeClass('disabled');
	});


	$('.grve-upload-image-button').click(function() {

        if ( grveMediaImageFrame ) {
            grveMediaImageFrame.open();
            return;
        }
        grveMediaImageFrame = wp.media.frames.grveMediaImageFrame = wp.media({
            className: 'media-frame grve-media-frame',
            frame: 'select',
            multiple: false,
            title: grve_upload_image_texts.modal_title,
            library: {
                type: 'image'
            },
            button: {
                text:  grve_upload_image_texts.modal_button_title
            }
        });
        grveMediaImageFrame.on('select', function(){
			var selection = grveMediaImageFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#grve-upload-image-button-spinner').show();
			$('.grve-upload-image-button').attr('disabled','disabled').addClass('disabled');

			$.post( grve_upload_image_texts.ajaxurl, { action:'blade_grve_get_image_media', attachment_id: ids.toString() } , function( mediaHtml ) {

				grveMediaImageContainer.html(mediaHtml);

				$('.grve-image-item-delete-button.grve-item-new').click(function() {
					$(this).parent().remove();
					$('.grve-upload-image-button').removeAttr('disabled').removeClass('disabled');
				}).removeClass('grve-item-new');
				$('.grve-open-image-modal.grve-item-new').bind("click",(function(e){
					e.preventDefault();
					$(this).bindOpenImageModal();
				})).removeClass('grve-item-new');
				$('.grve-upload-replace-image.grve-item-new').bind("click",(function(){
					$(this).bindUploadReplaceImage();
				})).removeClass('grve-item-new');

				$('#grve-upload-image-button-spinner').hide();
			});

        });

        grveMediaImageFrame.open();
    });


});