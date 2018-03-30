/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * Script for Admin Panel
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function() { 
	(function ($) { 
		/* Icons Lightbox Start */
		var cmsmsLightbox = $('body').cmsmsLightbox().data('cmsmsLightbox');
		
		
		/* Open Icons Lightbox */
		$('body').on('click', '.cmsms_icon_choose_button', function () { 
			var icon_input = $(this).parent().find('.icon_upload_image');
			
			
			cmsmsLightbox.methods.openLightbox( { 
				index : 	icon_input.attr('id'), 
				val : 		icon_input.val() 
			} );
		} );
		
		
		/* Selected Icon Remove */
		$('body').on('click', '.cmsms_remove_icon', function () { 
			var social_container = $(this).parents('div').eq(0).find('.icon_upload_link');
			
			
			$(this).parent().find('.icon_upload_image').val('').trigger('change');
			
			
			$(this).parent().find('.icon_upload_image').next('span').removeAttr('class').hide();
			
			
			$(this).hide();
			
			
			if (social_container.length > 0) {
				social_container.hide();
				
				
				social_container.nextAll('input.button').removeAttr('data-id').hide();
				
				
				social_container.find('input').each(function () { 
					if ($(this).attr('type') !== 'checkbox') {
						$(this).val('');
					} else {
						$(this).prop('checked', false);
					}
				} );
			}
			
			
			return false;
		} );
		
		
		/* Uploaded Image Remove */
		$('body').on('click', '.cmsms_upload .cmsms_upload_cancel', function () { 
			$(this).parent().fadeOut(500, function () {
				$(this).removeAttr('style').find('.cmsms_preview_image').attr('src', '');
				
				
				$(this).next().val('').trigger('change');
			} );
			
			
			return false;
		} );
	} )(jQuery);
} );

