<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6.4
 * 
 * Admin Panel General Options
 * Created by CMSMasters
 * 
 */


function cmsms_options_general_tabs() {
	$tabs = array();
	
	$tabs['general'] = __('General', 'cmsmasters');
	$tabs['sidebar'] = __('Sidebars', 'cmsmasters');
	$tabs['sitemap'] = __('Sitemap', 'cmsmasters');
	$tabs['archive'] = __('Archive', 'cmsmasters');
	$tabs['search'] = __('Search', 'cmsmasters');
	$tabs['error'] = __('404', 'cmsmasters');
	$tabs['seo'] = __('SEO', 'cmsmasters');
	$tabs['code'] = __('Custom Codes', 'cmsmasters');
	
	if (is_plugin_active('cmsms-contact-form-builder/cmsms-contact-form-builder.php')) {
		$tabs['recaptcha'] = __('reCAPTCHA', 'cmsmasters');
	}
	
	return $tabs;
}


function cmsms_options_general_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 'general':
		$sections = array();
		
		$sections['general_section'] = __('General Options', 'cmsmasters');
		
		break;
	case 'sidebar':
		$sections = array();
		
		$sections['sidebar_section'] = __('Custom Sidebars', 'cmsmasters');
		
		break;
	case 'sitemap':
		$sections = array();
		
		$sections['sitemap_section'] = __('Sitemap Page Options', 'cmsmasters');
		
		break;
	case 'archive':
		$sections = array();
		
		$sections['archive_section'] = __('Archive Page Options', 'cmsmasters');
		
		break;
	case 'search':
		$sections = array();
		
		$sections['search_section'] = __('Search Page Options', 'cmsmasters');
		
		break;
	case 'error':
		$sections = array();
		
		$sections['error_section'] = __('404 Error Page Options', 'cmsmasters');
		
		break;
	case 'seo':
		$sections = array();
		
		$sections['seo_section'] = __('SEO Tools', 'cmsmasters');
		
		break;
	case 'code':
		$sections = array();
		
		$sections['code_section'] = __('Custom Codes', 'cmsmasters');
		
		break;
	case 'recaptcha':
		$sections = array();
		
		$sections['recaptcha_section'] = __('Form Builder Plugin reCAPTCHA Keys', 'cmsmasters');
		
		break;
	}
	
	return $sections;	
} 


function cmsms_options_general_fields($set_tab = false) {
	$cmsms_option = cmsms_get_global_options();

	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	$options = array();
	
	switch ($tab) {
	case 'general':
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_theme_color_1', 
			'title' => __('Theme Color 1', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#ff6f24' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_theme_color_2', 
			'title' => __('Theme Color 2', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#f5432a' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_theme_color_3', 
			'title' => __('Theme Color 3', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#ffc00a' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_theme_color_4', 
			'title' => __('Theme Color 4', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#419005' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_color', 
			'title' => __('Heading Background Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#72bb2a' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_image', 
			'title' => __('Heading Background Image', 'cmsmasters'), 
			'desc' => __('Choose your custom heading background image.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => get_template_directory_uri() . '/img/heading_bg.png' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_responsive', 
			'title' => __('Responsive Layout', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => CMSMS_SHORTNAME . '_retina', 
			'title' => __('High Resolution', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		break;
	case 'sidebar':
		$options[] = array( 
			'section' => 'sidebar_section', 
			'id' => CMSMS_SHORTNAME . '_sidebar', 
			'title' => __('Custom Sidebars', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'sidebar', 
			'std' => '' 
		);
		
		break;
	case 'sitemap':
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_nav', 
			'title' => __('Website Pages', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_categs', 
			'title' => __('Blog Archives by Categories', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_tags', 
			'title' => __('Blog Archives by Tags', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_month', 
			'title' => __('Blog Archives by Month', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_pj_categs', 
			'title' => __('Portfolio Archives by Categories', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => CMSMS_SHORTNAME . '_sitemap_pj_tags', 
			'title' => __('Portfolio Archives by Tags', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		break;
	case 'archive':
		$options[] = array( 
			'section' => 'archive_section', 
			'id' => CMSMS_SHORTNAME . '_archive_layout', 
			'title' => __('Archive Layout Type', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => 'r_sidebar', 
			'choices' => array( 
				__('Right Sidebar', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				__('Left Sidebar', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				__('Full Width', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'archive_section', 
			'id' => CMSMS_SHORTNAME . '_archive_right_left_sidebar', 
			'title' => __('Choose Right/Left Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => 'default' 
		);
		
		$options[] = array( 
			'section' => 'archive_section', 
			'id' => CMSMS_SHORTNAME . '_archive_top_sidebar', 
			'title' => __('Choose Top Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'archive_section', 
			'id' => CMSMS_SHORTNAME . '_archive_middle_sidebar', 
			'title' => __('Choose Middle Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'archive_section', 
			'id' => CMSMS_SHORTNAME . '_archive_bottom_sidebar', 
			'title' => __('Choose Bottom Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => '' 
		);
		
		break;
	case 'search':
		$options[] = array( 
			'section' => 'search_section', 
			'id' => CMSMS_SHORTNAME . '_search_layout', 
			'title' => __('Search Layout Type', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => 'r_sidebar', 
			'choices' => array( 
				__('Right Sidebar', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				__('Left Sidebar', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				__('Full Width', 'cmsmasters') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'search_section', 
			'id' => CMSMS_SHORTNAME . '_search_right_left_sidebar', 
			'title' => __('Choose Right/Left Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => 'default' 
		);
		
		$options[] = array( 
			'section' => 'search_section', 
			'id' => CMSMS_SHORTNAME . '_search_top_sidebar', 
			'title' => __('Choose Top Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'search_section', 
			'id' => CMSMS_SHORTNAME . '_search_middle_sidebar', 
			'title' => __('Choose Middle Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'search_section', 
			'id' => CMSMS_SHORTNAME . '_search_bottom_sidebar', 
			'title' => __('Choose Bottom Sidebar', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_sidebar', 
			'std' => '' 
		);
		
		break;
	case 'error':
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_bg_color', 
			'title' => __('Background Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#f44027' 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_bg_image', 
			'title' => __('Background Image', 'cmsmasters'), 
			'desc' => __('Choose your custom error page background image.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => get_template_directory_uri() . '/framework/admin/inc/img/image.png' 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_search', 
			'title' => __('Search Line', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_sitemap_button', 
			'title' => __('Sitemap Button', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => CMSMS_SHORTNAME . '_error_sitemap_link', 
			'title' => __('Sitemap Page URL', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '' 
		);
		
		break;
	case 'seo':
		$options[] = array( 
			'section' => 'seo_section', 
			'id' => CMSMS_SHORTNAME . '_seo', 
			'title' => __('SEO Settings', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'seo_section', 
			'id' => CMSMS_SHORTNAME . '_seo_title', 
			'title' => __('Default Title', 'cmsmasters'), 
			'desc' => __('We recommend you enter no more than 60 characters.', 'cmsmasters'), 
			'type' => 'text', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'seo_section', 
			'id' => CMSMS_SHORTNAME . '_seo_description', 
			'title' => __('Default Description', 'cmsmasters'), 
			'desc' => __('We recommend you enter no more than 160 characters.', 'cmsmasters'), 
			'type' => 'textarea', 
			'std' => '', 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'seo_section', 
			'id' => CMSMS_SHORTNAME . '_seo_keywords', 
			'title' => __('Default Keywords', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => 'nohtml' 
		);
		
		break;
	case 'code':
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_google_analytics', 
			'title' => __('Google Analytics', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_custom_css', 
			'title' => __('Custom CSS', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_custom_js', 
			'title' => __('Custom JavaScript', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_gmap_api_key', 
			'title' => __('Google Maps API key', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_api_key', 
			'title' => esc_html__('Twitter API key', 'mall'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_api_secret', 
			'title' => esc_html__('Twitter API secret', 'mall'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_access_token', 
			'title' => esc_html__('Twitter Access token', 'mall'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => CMSMS_SHORTNAME . '_access_token_secret', 
			'title' => esc_html__('Twitter Access token secret', 'mall'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);		
		break;
	case 'recaptcha':
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => CMSMS_SHORTNAME . '_recaptcha_public_key', 
			'title' => __('reCAPTCHA Public Key', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => CMSMS_SHORTNAME . '_recaptcha_private_key', 
			'title' => __('reCAPTCHA Private Key', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '' 
		);
		
		break;
	}
	
	return $options;	
}

