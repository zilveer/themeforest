/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.1.0
 * 
 * Admin Panel Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	/* General 'General' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_preload').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_preload_bg').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_preload_color').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_preload_effect').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_preload_percentage').parents('tr').hide();
	}
	
	if ($('#' + cmsms_settings.shortname + '_preload_effect').val() !== 'grow' && $('#' + cmsms_settings.shortname + '_preload_effect').val() !== 'fade') {
		$('#' + cmsms_settings.shortname + '_preload_percentage').parents('tr').hide();
	}
	
	/* General 'General' Tab Fields Change */
	$('#' + cmsms_settings.shortname + '_preload').bind('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsms_settings.shortname + '_preload_bg').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_preload_color').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_preload_effect').parents('tr').show();
			
			if ($('#' + cmsms_settings.shortname + '_preload_effect').val() === 'grow' || $('#' + cmsms_settings.shortname + '_preload_effect').val() === 'fade') {
				$('#' + cmsms_settings.shortname + '_preload_percentage').parents('tr').show();
			}
		} else {
			$('#' + cmsms_settings.shortname + '_preload_bg').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_preload_color').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_preload_effect').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_preload_percentage').parents('tr').hide();
		}
	} );
	
	$('#' + cmsms_settings.shortname + '_preload_effect').bind('change', function () { 
		if ($(this).val() === 'grow' || $(this).val() === 'fade') {
			$('#' + cmsms_settings.shortname + '_preload_percentage').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_preload_percentage').parents('tr').hide();
		}
	} );
	
	
	
	/* General '404' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_error_sitemap_button').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_error_sitemap_link').parents('tr').hide();
	}
	
	/* General '404' Tab Fields Change */
	$('#' + cmsms_settings.shortname + '_error_sitemap_button').bind('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsms_settings.shortname + '_error_sitemap_link').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_error_sitemap_link').parents('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Logo' Tab Fields Load */
	if ($('input[id^="' + cmsms_settings.shortname + '_logo_type"]:checked').val() === 'image') {
		$('#' + cmsms_settings.shortname + '_logo_title').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_logo_subtitle').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_logo_custom_color').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_logo_title_color').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
	} else if ($('input[id^="' + cmsms_settings.shortname + '_logo_type"]:checked').val() === 'text') {
		$('#' + cmsms_settings.shortname + '_logo_url').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_logo_url_retina').parents('tr').hide();
		
		if ($('#' + cmsms_settings.shortname + '_logo_custom_color').is(':not(:checked)')) {
			$('#' + cmsms_settings.shortname + '_logo_title_color').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
		}
	}
	
	/* Appearance 'Logo' Tab 'Logo Type' Field Change */
	$('input[id^="' + cmsms_settings.shortname + '_logo_type"]').bind('change', function () { 
		if ($(this).is(':checked') && $(this).val() === 'image') {
			$('#' + cmsms_settings.shortname + '_logo_url').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_logo_url_retina').parents('tr').show();
			
			$('#' + cmsms_settings.shortname + '_logo_title').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_subtitle').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_custom_color').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_title_color').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
		} else if ($(this).is(':checked') && $(this).val() === 'text') {
			$('#' + cmsms_settings.shortname + '_logo_title').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_logo_subtitle').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_logo_custom_color').parents('tr').show();
			
			if ($('#' + cmsms_settings.shortname + '_logo_custom_color').is(':checked')) {
				$('#' + cmsms_settings.shortname + '_logo_title_color').parents('tr').show();
				$('#' + cmsms_settings.shortname + '_logo_subtitle_color').parents('tr').show();
			}
			
			$('#' + cmsms_settings.shortname + '_logo_url').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_url_retina').parents('tr').hide();
		}
	} );
	
	/* Appearance 'Logo' Tab 'Custom Text Colors' Field Change */
	$('#' + cmsms_settings.shortname + '_logo_custom_color').bind('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsms_settings.shortname + '_logo_title_color').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_logo_subtitle_color').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_logo_title_color').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_logo_subtitle_color').parents('tr').hide();
		}
	} );
	
	/* Appearance 'Favicon' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_favicon').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_favicon_url').parents('tr').hide();
	}
	
	/* Appearance 'Favicon' Tab Fields Change */
	$('#' + cmsms_settings.shortname + '_favicon').bind('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsms_settings.shortname + '_favicon_url').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_favicon_url').parents('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Background' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_bg_img_enable').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_bg_img').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_bg_rep"]').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_bg_pos"]').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_bg_att"]').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_bg_size"]').parents('tr').hide();
	}
	
	/* Appearance 'Background' Tab Fields Change */
	$('#' + cmsms_settings.shortname + '_bg_img_enable').bind('change', function () { 
		if ($('#' + cmsms_settings.shortname + '_bg_img_enable').is(':checked')) {
			$('#' + cmsms_settings.shortname + '_bg_img').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_bg_rep"]').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_bg_pos"]').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_bg_att"]').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_bg_size"]').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_bg_img').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_bg_rep"]').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_bg_pos"]').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_bg_att"]').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_bg_size"]').parents('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Header' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_header_top_line').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_header_top_scheme').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_header_top_height').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_header_top_line_short_info').parents('tr').hide();
		$('input[name*="' + cmsms_settings.shortname + '_header_top_line_add_cont"]').parents('tr').hide();
	}
	
	if ($('input[name*="' + cmsms_settings.shortname + '_header_styles"]:checked').val() === 'default') {
		$('#' + cmsms_settings.shortname + '_header_bot_height').parents('tr').hide();
		$('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
	}
	
	if ($('input[name*="' + cmsms_settings.shortname + '_header_styles"]:checked').val() === 'c_nav') {
		$('#' + cmsms_settings.shortname + '_header_search').parents('tr').hide();
		$('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
	}
	
	if ($('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]:checked').val() !== 'cust_html') {
		$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
	}
	
	
	/* Appearance 'Header' Tab Fields Change */
	$('#' + cmsms_settings.shortname + '_header_top_line').bind('change', function () { 
		if ($('#' + cmsms_settings.shortname + '_header_top_line').is(':checked')) {
			$('#' + cmsms_settings.shortname + '_header_top_scheme').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_header_top_height').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_header_top_line_short_info').parents('tr').show();
			$('input[name*="' + cmsms_settings.shortname + '_header_top_line_add_cont"]').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_header_top_scheme').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_header_top_height').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_header_top_line_short_info').parents('tr').hide();
			$('input[name*="' + cmsms_settings.shortname + '_header_top_line_add_cont"]').parents('tr').hide();
		}
	} );
	
	$('input[name*="' + cmsms_settings.shortname + '_header_styles"]').bind('change', function () { 
		if ($('input[name*="' + cmsms_settings.shortname + '_header_styles"]:checked').val() === 'default') {
			$('#' + cmsms_settings.shortname + '_header_bot_height').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_header_search').parents('tr').show();
			$('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
		} else if ($('input[name*="' + cmsms_settings.shortname + '_header_styles"]:checked').val() === 'c_nav') {
			$('#' + cmsms_settings.shortname + '_header_bot_height').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_header_search').parents('tr').hide();
			$('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
		} else {
			$('#' + cmsms_settings.shortname + '_header_bot_height').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_header_search').parents('tr').show();
			$('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]').parents('tr').show();
			if ($('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]:checked').val() === 'cust_html') {
				$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').show();
			}
		}
	} );
	
	$('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]').bind('change', function () { 
		if ($('input[name*="' + cmsms_settings.shortname + '_header_add_cont"]:checked').val() === 'cust_html') {
			$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_header_add_cont_cust_html').parents('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Content' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_heading_bg_image_enable').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_heading_bg_image').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_heading_bg_repeat"]').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_heading_bg_attachment"]').parents('tr').hide();
		$('label[for="' + cmsms_settings.shortname + '_heading_bg_size"]').parents('tr').hide();
	}
	
	/* Appearance 'Content' Tab Fields Change */
	$('#' + cmsms_settings.shortname + '_heading_bg_image_enable').bind('change', function () { 
		if ($('#' + cmsms_settings.shortname + '_heading_bg_image_enable').is(':checked')) {
			$('#' + cmsms_settings.shortname + '_heading_bg_image').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_heading_bg_repeat"]').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_heading_bg_attachment"]').parents('tr').show();
			$('label[for="' + cmsms_settings.shortname + '_heading_bg_size"]').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_heading_bg_image').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_heading_bg_repeat"]').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_heading_bg_attachment"]').parents('tr').hide();
			$('label[for="' + cmsms_settings.shortname + '_heading_bg_size"]').parents('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Footer' Tab Fields Load */
	if ($('input[name*="' + cmsms_settings.shortname + '_footer_type"]:checked').val() !== 'small') {
		$('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').show();
		
		
		if ($('#' + cmsms_settings.shortname + '_footer_logo').is(':not(:checked)')) {
			$('#' + cmsms_settings.shortname + '_footer_logo_url').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
		}
	} else {
		$('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]').parents('tr').show();
	
		$('#' + cmsms_settings.shortname + '_fixed_footer').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_height').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_logo').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_logo_url').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_nav').parents('tr').hide();
		$('#' + cmsms_settings.shortname + '_footer_social').parents('tr').hide();
		
		if ($('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]:checked').val() !== 'text') {
			$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').hide();
		}
	}
	
	
	/* Appearance 'Footer' Tab Fields Change */
	$('input[name*="' + cmsms_settings.shortname + '_footer_type"]').bind('change', function () { 
		if ($('input[name*="' + cmsms_settings.shortname + '_footer_type"]:checked').val() === 'small') {
			$('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]').parents('tr').show();
	
			$('#' + cmsms_settings.shortname + '_fixed_footer').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_height').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_logo').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_logo_url').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_nav').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_social').parents('tr').hide();
			
			
			if ($('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]:checked').val() === 'text') {
				$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').show();
			} else {
				$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').hide();
			}
		} else {
			$('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]').parents('tr').hide();
	
			$('#' + cmsms_settings.shortname + '_fixed_footer').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_height').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_logo').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_logo_url').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_logo_url_retina').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_nav').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_social').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').show();
		}
	} );
	
	
	/* Appearance 'Footer' Tab 'Footer Logo' Field Change */
	$('#' + cmsms_settings.shortname + '_footer_logo').bind('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsms_settings.shortname + '_footer_logo_url').parents('tr').show();
			$('#' + cmsms_settings.shortname + '_footer_logo_url_retina').parents('tr').show();
		} else if ($(this).is(':not(:checked)')) {
			$('#' + cmsms_settings.shortname + '_footer_logo_url').parents('tr').hide();
			$('#' + cmsms_settings.shortname + '_footer_logo_url_retina').parents('tr').hide();
		}
	} );
	
	
	/* Appearance 'Footer' Tab 'Additional Content' Change */
	$('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]').bind('change', function () { 
		if ($('input[name*="' + cmsms_settings.shortname + '_footer_type"]:checked').val() === 'small') {
			if ($('input[name*="' + cmsms_settings.shortname + '_footer_additional_content"]:checked').val() === 'text') {
				$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').show();
			} else {
				$('#' + cmsms_settings.shortname + '_footer_html').parents('tr').hide();
			}
		}
	} );
	
	
	
	/* Single Posts 'Project' Tab Fields Load */
	if ($('#' + cmsms_settings.shortname + '_portfolio_project_link').is(':not(:checked)')) {
		$('#' + cmsms_settings.shortname + '_portfolio_project_link_text').parents('tr').hide();
	}
	
	/* Single Posts 'Project' Tab 'Project Link' Field Change */
	$('#' + cmsms_settings.shortname + '_portfolio_project_link').bind('change', function () { 
		if ($(this).is(':checked')) {
			$('#' + cmsms_settings.shortname + '_portfolio_project_link_text').parents('tr').show();
		} else {
			$('#' + cmsms_settings.shortname + '_portfolio_project_link_text').parents('tr').hide();
		}
	} );
} )(jQuery);

