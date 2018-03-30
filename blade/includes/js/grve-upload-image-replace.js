jQuery(document).ready(function($) {

	"use strict";

	var grveMediaImageReplaceFrame;
	var grveMediaImageReplaceContainer;
	var grveMediaImageReplaceMode;
	var grveMediaImageReplaceImage;
	var grveMediaImageFieldName;

	$('.grve-upload-replace-image').bind("click",(function(){
		$(this).bindUploadReplaceImage();
	}));
	
	$('.grve-upload-remove-image').bind("click",(function(e){
		$(this).bindUploadRemoveImage(e);
	}));

	$.fn.bindUploadRemoveImage = function(e){
		e.preventDefault();
		$(this).parent().find('.grve-upload-media-id').val('0');
		$(this).parent().removeClass('grve-visible');
	}

	$.fn.bindUploadReplaceImage = function(){

		grveMediaImageReplaceContainer = $(this).parent().find('.grve-thumb-container');
		grveMediaImageReplaceMode = grveMediaImageReplaceContainer.data('mode');
		grveMediaImageFieldName = grveMediaImageReplaceContainer.data('field-name');
		grveMediaImageReplaceImage = $(this).parent().find('.grve-thumb');

        if ( grveMediaImageReplaceFrame ) {
            grveMediaImageReplaceFrame.open();
            return;
        }


        grveMediaImageReplaceFrame = wp.media.frames.grveMediaImageReplaceFrame = wp.media({
            className: 'media-frame grve-media-replace-image-frame',
            frame: 'select',
            multiple: false,
            title: grve_upload_image_replace_texts.modal_title,
            library: {
                type: 'image'
            },
            button: {
                text:  grve_upload_image_replace_texts.modal_button_title
            }

        });

        grveMediaImageReplaceFrame.on('select', function(){
			var selection = grveMediaImageReplaceFrame.state().get('selection');
			var ids = selection.pluck('id');
			$('.grve-upload-replace-image').unbind("click").css({ 'cursor': 'wait' });
			grveMediaImageReplaceImage.remove();
			grveMediaImageReplaceContainer.addClass('grve-visible grve-loading');
			$.post( grve_upload_image_replace_texts.ajaxurl, { action:'blade_grve_get_replaced_image', attachment_id: ids.toString(), attachment_mode: grveMediaImageReplaceMode, field_name: grveMediaImageFieldName } , function( mediaHtml ) {
				grveMediaImageReplaceContainer.html(mediaHtml).removeClass('grve-loading');
				$('.grve-upload-replace-image').bind("click",(function(){
					$(this).bindUploadReplaceImage();
				})).css({ 'cursor': 'pointer' });
				
				$('.grve-upload-remove-image').bind("click",(function(e){
					$(this).bindUploadRemoveImage(e);
				}));				
			});
        });

        grveMediaImageReplaceFrame.open();
    }


});