jQuery(document).ready(function($) {

	"use strict";

	var grveMediaFrame;
	var grveMediaInputField;
	var grveMediaInputType;


	$('.grve-remove-simple-media-button').click(function() {
		$(this).bindRemoveSimpleMedia();
	});
	$('.grve-upload-simple-media-button').click(function() {
		$(this).bindUploadSimpleMedia();
	});

	$.fn.bindRemoveSimpleMedia = function(){
		$(this).parent().find('.grve-upload-simple-media-field').val('');
		$(this).parent().find('.grve-upload-simple-media-field').change();
		
	}

	$.fn.bindUploadSimpleMedia = function(){
		grveMediaInputField = $(this).parent().find('.grve-upload-simple-media-field');
		grveMediaInputType = $(this).data('media-type');
		
        grveMediaFrame = wp.media.frames.grveMediaFrame = wp.media({
            className: 'media-frame grve-media-frame',
            frame: 'select',
            multiple: false,
            title: grve_upload_media_texts.modal_title,
            library: {
                type: grveMediaInputType
            },
            button: {
                text:  grve_upload_media_texts.modal_button_title
            }
        });
        grveMediaFrame.on('select', function(){
            var mediaAttachment = grveMediaFrame.state().get('selection').first().toJSON();
            grveMediaInputField.val( mediaAttachment.url );
			grveMediaInputField.change();
        });

        grveMediaFrame.open();
    }


});