jQuery(document).ready(function($) {

	"use strict";

	var grveFeatureSliderFrame;
	var grveFeatureSliderContainer = $( "#grve-feature-slider-container" );
	grveFeatureSliderContainer.sortable();

	$('.grve-feature-slider-item-delete-button').click(function() {
		$(this).parent().remove();
	});

	$('.grve-upload-feature-slider-button').click(function() {

        if ( grveFeatureSliderFrame ) {
            grveFeatureSliderFrame.open();
            return;
        }

        grveFeatureSliderFrame = wp.media.frames.grveFeatureSliderFrame = wp.media({
            className: 'media-frame grve-media-feature-slider-frame',
            frame: 'select',
            multiple: 'toggle',
            title: grve_upload_feature_slider_texts.modal_title,
            library: {
                type: 'image'
            },
            button: {
                text:  grve_upload_feature_slider_texts.modal_button_title
            }

        });
        grveFeatureSliderFrame.on('select', function(){
			var selection = grveFeatureSliderFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#grve-upload-feature-slider-button-spinner').show();

			$.post( grve_upload_feature_slider_texts.ajaxurl, { action:'blade_grve_get_admin_feature_slider_media', attachment_ids: ids.toString() } , function( mediaHtml ) {
				grveFeatureSliderContainer.append(mediaHtml);
				$('.grve-feature-slider-item-delete-button.grve-item-new').click(function() {
					$(this).parent().remove();
				}).removeClass('grve-item-new');

				$('.grve-item-new .grve-upload-replace-image').bind("click",(function(){
					$(this).bindUploadReplaceImage();
				}));

				$('.grve-item-new .grve-upload-remove-image').bind("click",(function(e){
					$(this).bindUploadRemoveImage(e);
				}));

				$('.grve-open-slider-modal.grve-item-new').bind("click",(function(e){
					e.preventDefault();
					$(this).bindOpenSliderModal();
				})).removeClass('grve-item-new');

				$('.grve-tabs .grve-tab-links a').off("click").on("click", (function(e) {
					$(this).bindTabsMetaboxes(e);
				}));

				$('.grve-dependency-field').off("change").on("change",(function(){
					$(this).bindFieldsDependency();
				}));

				$('.postbox.grve-item-new .handlediv').on('click', function() {
					var p = $(this).parent('.postbox');

					p.removeClass('grve-item-new');
					p.toggleClass('closed');

				});

				$('.grve-slider-item.grve-item-new .wp-color-picker-field').wpColorPicker();


				$('.grve-slider-item.grve-item-new .grve-select-color-extra').change(function() {
					if( 'custom' == $(this).val() ) {
						$(this).parents('.grve-field-items-wrapper').find('.grve-wp-colorpicker').show();
					} else {
						$(this).parents('.grve-field-items-wrapper').find('.grve-wp-colorpicker').hide();
					}
				});

				$('.grve-slider-item.grve-item-new').removeClass('grve-item-new');

				$('#grve-upload-feature-slider-button-spinner').hide();

				$( "[data-dependency]" ).initFieldsDependency();

				$('.grve-admin-label-update').off("change").on("change",(function(){
					$(this).bindFieldsAdminLabelUpdate();
				}));

			});
        });
        grveFeatureSliderFrame.on('ready', function(){
			$( '.media-modal' ).addClass( 'grve-media-no-sidebar' );
        });


        grveFeatureSliderFrame.open();
    });


});