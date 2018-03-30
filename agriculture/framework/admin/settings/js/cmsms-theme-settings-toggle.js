/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Toggles Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	/* General '404' Tab Fields Load */
	if (jQuery('#agriculture_error_sitemap_button').is(':not(:checked)')) {
		jQuery('#agriculture_error_sitemap_link').closest('tr').hide();
	}
	
	/* General '404' Tab Fields Change */
	jQuery('#agriculture_error_sitemap_button').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#agriculture_error_sitemap_link').closest('tr').show();
		} else {
			jQuery('#agriculture_error_sitemap_link').closest('tr').hide();
		}
	} );
	
	
	
	/* General 'SEO' Tab Fields Load */
	if (jQuery('#agriculture_seo').is(':not(:checked)')) {
		jQuery('#agriculture_seo_title').closest('tr').hide();
		jQuery('#agriculture_seo_description').closest('tr').hide();
		jQuery('#agriculture_seo_keywords').closest('tr').hide();
	}
	
	/* General 'SEO' Tab Fields Change */
	jQuery('#agriculture_seo').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#agriculture_seo_title').closest('tr').show();
			jQuery('#agriculture_seo_description').closest('tr').show();
			jQuery('#agriculture_seo_keywords').closest('tr').show();
		} else {
			jQuery('#agriculture_seo_title').closest('tr').hide();
			jQuery('#agriculture_seo_description').closest('tr').hide();
			jQuery('#agriculture_seo_keywords').closest('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Background' Tab Fields Load */
	if (jQuery('#agriculture_bg_img_enable').is(':not(:checked)')) {
		jQuery('#agriculture_bg_img').closest('tr').hide();
		jQuery('label[for="agriculture_bg_rep"]').closest('tr').hide();
		jQuery('label[for="agriculture_bg_pos_v"]').closest('tr').hide();
		jQuery('label[for="agriculture_bg_pos_h"]').closest('tr').hide();
		jQuery('label[for="agriculture_bg_att"]').closest('tr').hide();
	}
	
	/* Appearance 'Background' Tab Fields Change */
	jQuery('#agriculture_bg_img_enable').bind('change', function () { 
		if (jQuery('#agriculture_bg_img_enable').is(':checked')) {
			jQuery('#agriculture_bg_img').closest('tr').show();
			jQuery('label[for="agriculture_bg_rep"]').closest('tr').show();
			jQuery('label[for="agriculture_bg_pos_v"]').closest('tr').show();
			jQuery('label[for="agriculture_bg_pos_h"]').closest('tr').show();
			jQuery('label[for="agriculture_bg_att"]').closest('tr').show();
		} else {
			jQuery('#agriculture_bg_img').closest('tr').hide();
			jQuery('label[for="agriculture_bg_rep"]').closest('tr').hide();
			jQuery('label[for="agriculture_bg_pos_v"]').closest('tr').hide();
			jQuery('label[for="agriculture_bg_pos_h"]').closest('tr').hide();
			jQuery('label[for="agriculture_bg_att"]').closest('tr').hide();
		}
	} );
	
	
	
	/* Appearance 'Footer' Tab Fields Load */
	if (jQuery('input[name^="cmsms_options_agriculture_style_footer"]:checked').val() !== 'text') {
		jQuery('#agriculture_footer_html').closest('tr').hide();
	}
	
	/* Appearance 'Footer' Tab Fields Change */
	jQuery('input[name^="cmsms_options_agriculture_style_footer"]').bind('change', function () { 
		if (jQuery('input[name^="cmsms_options_agriculture_style_footer"]:checked').val() === 'text') {
			jQuery('#agriculture_footer_html').closest('tr').show();
		} else {
			jQuery('#agriculture_footer_html').closest('tr').hide();
		}
	} );
	
	
	
	
	/* Header Checkbox Field Load */
	if (jQuery('#agriculture_header_custom_html').is(':not(:checked)')) {
		jQuery('#agriculture_header_html').closest('tr').hide();
	}
	
	/* Header Checkbox Field Change */
	jQuery('#agriculture_header_custom_html').bind('change', function () { 
		if (jQuery('#agriculture_header_custom_html').is(':not(:checked)')) {
			jQuery('#agriculture_header_html').closest('tr').hide();
		} else {
			jQuery('#agriculture_header_html').closest('tr').show();
		}
	} );
	
	
	
	/* Archive & Search Layout Sidebar Field Load */
	if (jQuery('input[name="cmsms_options_agriculture_archive[agriculture_archive_layout]"]:checked').val() !== 'fullwidth') {
		jQuery('#agriculture_archive_right_left_sidebar').closest('tr').show();
	} else {
		jQuery('#agriculture_archive_right_left_sidebar').closest('tr').hide();
	}
	if (jQuery('input[name="cmsms_options_agriculture_search[agriculture_search_layout]"]:checked').val() !== 'fullwidth') {
		jQuery('#agriculture_search_right_left_sidebar').closest('tr').show();
	} else {
		jQuery('#agriculture_search_right_left_sidebar').closest('tr').hide();
	}
	
	/* Archive & Search Layout Change */
	jQuery('input[name="cmsms_options_agriculture_archive[agriculture_archive_layout]"]').bind('change', function () { 
		if (jQuery(this).val() === 'fullwidth') {
			jQuery('#agriculture_archive_right_left_sidebar').closest('tr').hide();
		} else {
			jQuery('#agriculture_archive_right_left_sidebar').closest('tr').show();
		}
	} );
	jQuery('input[name="cmsms_options_agriculture_search[agriculture_search_layout]"]').bind('change', function () { 
		if (jQuery(this).val() === 'fullwidth') {
			jQuery('#agriculture_search_right_left_sidebar').closest('tr').hide();
		} else {
			jQuery('#agriculture_search_right_left_sidebar').closest('tr').show();
		}
	} );
	
	
	
	/* Logo 'Text Logo' Tab Fields Load */
	if (jQuery('#agriculture_text_logo').is(':not(:checked)')) {
		jQuery('#agriculture_text_logo_title').closest('tr').hide();
		jQuery('#agriculture_text_logo_title_color').closest('tr').hide();
		jQuery('#agriculture_text_logo_subtitle').closest('tr').hide();
		jQuery('#agriculture_text_logo_subtitle_text').closest('tr').hide();
		jQuery('#agriculture_text_logo_subtitle_color').closest('tr').hide();
	} else {
		if (jQuery('#agriculture_text_logo_subtitle').is(':not(:checked)')) {
			jQuery('#agriculture_text_logo_subtitle_text').closest('tr').hide();
			jQuery('#agriculture_text_logo_subtitle_color').closest('tr').hide();
		}
	}
	
	/* Logo 'Text Logo' Tab Fields Change */
	jQuery('#agriculture_text_logo').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#agriculture_text_logo_title').closest('tr').show();
			jQuery('#agriculture_text_logo_title_color').closest('tr').show();
			jQuery('#agriculture_text_logo_subtitle').closest('tr').show();
			
			if (jQuery('#agriculture_text_logo_subtitle').is(':checked')) {
				jQuery('#agriculture_text_logo_subtitle_text').closest('tr').show();
				jQuery('#agriculture_text_logo_subtitle_color').closest('tr').show();
			}
		} else {
			jQuery('#agriculture_text_logo_title').closest('tr').hide();
			jQuery('#agriculture_text_logo_title_color').closest('tr').hide();
			jQuery('#agriculture_text_logo_subtitle').closest('tr').hide();
			jQuery('#agriculture_text_logo_subtitle_text').closest('tr').hide();
			jQuery('#agriculture_text_logo_subtitle_color').closest('tr').hide();
		}
	} );
	
	/* Logo 'Text Logo' Tab 'Logo Subtitle' Field Change */
	jQuery('#agriculture_text_logo_subtitle').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#agriculture_text_logo_subtitle_text').closest('tr').show();
			jQuery('#agriculture_text_logo_subtitle_color').closest('tr').show();
		} else {
			jQuery('#agriculture_text_logo_subtitle_text').closest('tr').hide();
			jQuery('#agriculture_text_logo_subtitle_color').closest('tr').hide();
		}
	} );
	
	
	
	/* Logo 'Favicon' Tab Fields Load */
	if (jQuery('#agriculture_favicon').is(':not(:checked)')) {
		jQuery('#agriculture_favicon_url').closest('tr').hide();
	}
	
	/* Logo 'Favicon' Tab Fields Change */
	jQuery('#agriculture_favicon').bind('change', function () { 
		if (jQuery(this).is(':checked')) {
			jQuery('#agriculture_favicon_url').closest('tr').show();
		} else {
			jQuery('#agriculture_favicon_url').closest('tr').hide();
		}
	} );
} );

