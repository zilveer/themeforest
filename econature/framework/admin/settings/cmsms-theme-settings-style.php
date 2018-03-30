<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.1.0
 * 
 * Admin Panel Appearance
 * Created by CMSMasters
 * 
 */


function cmsms_options_style_tabs() {
	$cmsms_option = cmsms_get_global_options();
	
	$tabs = array();
	
	$tabs['logo'] = esc_attr__('Logo', 'cmsmasters');
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_theme_layout'] === 'boxed') {
		$tabs['bg'] = esc_attr__('Background', 'cmsmasters');
	}
	
	$tabs['header'] = esc_attr__('Header', 'cmsmasters');
	$tabs['content'] = esc_attr__('Content', 'cmsmasters');
	$tabs['footer'] = esc_attr__('Footer', 'cmsmasters');
	$tabs['icon'] = esc_attr__('Social Icons', 'cmsmasters');
	
	return $tabs;
}


function cmsms_options_style_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 'logo':
		$sections = array();
		
		$sections['logo_section'] = esc_attr__('Logo Options', 'cmsmasters');
		
		break;
	case 'bg':
		$sections = array();
		
		$sections['bg_section'] = esc_attr__('Background Options', 'cmsmasters');
		
		break;
	case 'header':
		$sections = array();
		
		$sections['header_section'] = esc_attr__('Header Options', 'cmsmasters');
		
		break;
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_attr__('Content Options', 'cmsmasters');
		
		break;
	case 'footer':
		$sections = array();
		
		$sections['footer_section'] = esc_attr__('Footer Options', 'cmsmasters');
		
		break;
	case 'icon':
		$sections = array();
		
		$sections['icon_section'] = esc_attr__('Social Icons', 'cmsmasters');
		
		break;
	}
	
	return $sections;
} 


function cmsms_options_style_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	$options = array();
	
	switch ($tab) {
	case 'logo':
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_type', 
			'title' => __('Logo Type', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'image', 
			'choices' => array( 
				__('Image', 'cmsmasters') . '|image', 
				__('Text', 'cmsmasters') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_url', 
			'title' => __('Logo Image', 'cmsmasters'), 
			'desc' => __('Choose your website logo image.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '|' . get_template_directory_uri() . '/img/logo.png', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_url_retina', 
			'title' => __('Retina Logo Image', 'cmsmasters'), 
			'desc' => __('Choose logo image for retina displays.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '|' . get_template_directory_uri() . '/img/logo_retina.png', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_title', 
			'title' => __('Logo Title', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => ((get_bloginfo('name')) ? get_bloginfo('name') : CMSMS_FULLNAME), 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_subtitle', 
			'title' => __('Logo Subtitle', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_custom_color', 
			'title' => __('Custom Text Colors', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_title_color', 
			'title' => __('Logo Title Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => '#3d3d3d|100' 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_logo_subtitle_color', 
			'title' => __('Logo Subtitle Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => '#3d3d3d|100' 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_favicon', 
			'title' => __('Favicon', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'logo_section', 
			'id' => CMSMS_SHORTNAME . '_favicon_url', 
			'title' => __('Favicon URL', 'cmsmasters'), 
			'desc' => __('Choose your website favicon image url.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '|' . get_template_directory_uri() . '/img/favicon.ico', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		break;
	case 'bg':
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_col', 
			'title' => __('Background Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#ffffff' 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_img_enable', 
			'title' => __('Background Image Visibility', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_img', 
			'title' => __('Background Image', 'cmsmasters'), 
			'desc' => __('Choose your custom website background image url.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_rep', 
			'title' => __('Background Repeat', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'no-repeat', 
			'choices' => array( 
				__('No Repeat', 'cmsmasters') . '|no-repeat', 
				__('Repeat Horizontally', 'cmsmasters') . '|repeat-x', 
				__('Repeat Vertically', 'cmsmasters') . '|repeat-y', 
				__('Repeat', 'cmsmasters') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_pos', 
			'title' => __('Background Position', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => 'top center', 
			'choices' => array( 
				__('Top Left', 'cmsmasters') . '|top left', 
				__('Top Center', 'cmsmasters') . '|top center', 
				__('Top Right', 'cmsmasters') . '|top right', 
				__('Center Left', 'cmsmasters') . '|center left', 
				__('Center Center', 'cmsmasters') . '|center center', 
				__('Center Right', 'cmsmasters') . '|center right', 
				__('Bottom Left', 'cmsmasters') . '|bottom left', 
				__('Bottom Center', 'cmsmasters') . '|bottom center', 
				__('Bottom Right', 'cmsmasters') . '|bottom right' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_att', 
			'title' => __('Background Attachment', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'scroll', 
			'choices' => array( 
				__('Scroll', 'cmsmasters') . '|scroll', 
				__('Fixed', 'cmsmasters') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_size', 
			'title' => __('Background Size', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'cover', 
			'choices' => array( 
				__('Auto', 'cmsmasters') . '|auto', 
				__('Cover', 'cmsmasters') . '|cover', 
				__('Contain', 'cmsmasters') . '|contain' 
			) 
		);
		
		break;
	case 'header':
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_fixed_header', 
			'title' => __('Fixed Header', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_top_line', 
			'title' => __('Top Line', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_top_height', 
			'title' => __('Top Height', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '35', 
			'min' => '30' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_top_line_short_info', 
			'title' => __('Top Short Info', 'cmsmasters'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'cmsmasters') . '</strong>', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_top_line_add_cont', 
			'title' => __('Top Additional Content', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'social', 
			'choices' => array( 
				__('None', 'cmsmasters') . '|none', 
				__('Top Line Social Icons', 'cmsmasters') . '|social', 
				__('Top Line Navigation', 'cmsmasters') . '|nav' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_styles', 
			'title' => __('Header Styles', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'default', 
			'choices' => array( 
				__('Default Style', 'cmsmasters') . '|default', 
				__('Compact Style Left Navigation', 'cmsmasters') . '|l_nav', 
				__('Compact Style Right Navigation', 'cmsmasters') . '|r_nav', 
				__('Compact Style Center Navigation', 'cmsmasters') . '|c_nav'
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_mid_height', 
			'title' => __('Header Middle Height', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '95', 
			'min' => '80' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_bot_height', 
			'title' => __('Header Bottom Height', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '45', 
			'min' => '40' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_search', 
			'title' => __('Header Search', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_add_cont', 
			'title' => __('Header Additional Content', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'cust_html', 
			'choices' => array( 
				__('None', 'cmsmasters') . '|none', 
				__('Header Social Icons', 'cmsmasters') . '|social', 
				__('Header Custom HTML', 'cmsmasters') . '|cust_html' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_add_cont_cust_html', 
			'title' => __('Header Custom HTML', 'cmsmasters'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'cmsmasters') . '</strong>', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		break;
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_layout', 
			'title' => __('Layout Type by Default', 'cmsmasters'), 
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
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_alignment', 
			'title' => __('Heading Alignment by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'left', 
			'choices' => array( 
				__('Left', 'cmsmasters') . '|left', 
				__('Right', 'cmsmasters') . '|right', 
				__('Center', 'cmsmasters') . '|center' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_scheme', 
			'title' => __('Heading Custom Color Scheme by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => 'default', 
			'choices' => cmsms_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_image_enable', 
			'title' => __('Heading Background Image Visibility by Default', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_image', 
			'title' => __('Heading Background Image by Default', 'cmsmasters'), 
			'desc' => __('Choose your custom heading background image by default.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_repeat', 
			'title' => __('Heading Background Repeat by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'no-repeat', 
			'choices' => array( 
				__('No Repeat', 'cmsmasters') . '|no-repeat', 
				__('Repeat Horizontally', 'cmsmasters') . '|repeat-x', 
				__('Repeat Vertically', 'cmsmasters') . '|repeat-y', 
				__('Repeat', 'cmsmasters') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_attachment', 
			'title' => __('Heading Background Attachment by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'scroll', 
			'choices' => array( 
				__('Scroll', 'cmsmasters') . '|scroll', 
				__('Fixed', 'cmsmasters') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_size', 
			'title' => __('Heading Background Size by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'cover', 
			'choices' => array( 
				__('Auto', 'cmsmasters') . '|auto', 
				__('Cover', 'cmsmasters') . '|cover', 
				__('Contain', 'cmsmasters') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_color', 
			'title' => __('Heading Background Color Overlay by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#000000' 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_bg_color_opacity', 
			'title' => __('Heading Background Color Overlay Transparency by Default', 'cmsmasters'), 
			'desc' => __('percentage', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '0', 
			'min' => '0', 
			'max' => '100' 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_heading_height', 
			'title' => __('Heading Height by Default', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '70', 
			'min' => '0' 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_breadcrumbs', 
			'title' => __('Breadcrumbs Visibility by Default', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_breadcrumbs_alignment', 
			'title' => __('Breadcrumbs Alignment by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'right', 
			'choices' => array( 
				__('Left', 'cmsmasters') . '|left', 
				__('Right', 'cmsmasters') . '|right', 
				__('Center', 'cmsmasters') . '|center' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_bottom_scheme', 
			'title' => __('Bottom Custom Color Scheme', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => 'default', 
			'choices' => cmsms_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_bottom_sidebar', 
			'title' => __('Bottom Sidebar Visibility by Default', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_bottom_sidebar_layout', 
			'title' => __('Bottom Sidebar Layout by Default', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => '131313', 
			'choices' => array( 
				'1/1|11', 
				'1/2 + 1/2|1212', 
				'1/3 + 2/3|1323', 
				'2/3 + 1/3|2313', 
				'1/4 + 3/4|1434', 
				'3/4 + 1/4|3414', 
				'1/3 + 1/3 + 1/3|131313', 
				'1/2 + 1/4 + 1/4|121414', 
				'1/4 + 1/2 + 1/4|141214', 
				'1/4 + 1/4 + 1/2|141412', 
				'1/4 + 1/4 + 1/4 + 1/4|14141414' 
			) 
		);
		
		break;
	case 'footer':
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_scheme', 
			'title' => __('Footer Custom Color Scheme', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => 'footer', 
			'choices' => cmsms_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_type', 
			'title' => __('Footer Type', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'default', 
			'choices' => array( 
				__('Default', 'cmsmasters') . '|default', 
				__('Small', 'cmsmasters') . '|small' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_additional_content', 
			'title' => __('Footer Additional Content', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => 'social', 
			'choices' => array( 
				__('None', 'cmsmasters') . '|none', 
				__('Footer Navigation', 'cmsmasters') . '|nav', 
				__('Social Icons', 'cmsmasters') . '|social', 
				__('Custom HTML', 'cmsmasters') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_fixed_footer', 
			'title' => __('Fixed Footer', 'cmsmasters'), 
			'desc' => __('enable', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_height', 
			'title' => __('Footer Height', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '450', 
			'min' => '200' 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_logo', 
			'title' => __('Footer Logo', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_logo_url', 
			'title' => __('Footer Logo', 'cmsmasters'), 
			'desc' => __('Choose your website footer logo image.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '|' . get_template_directory_uri() . '/img/logo_footer.png', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_logo_url_retina', 
			'title' => __('Footer Logo for Retina', 'cmsmasters'), 
			'desc' => __('Choose your website footer logo image for retina.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => '|' . get_template_directory_uri() . '/img/logo_footer_retina.png', 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_nav', 
			'title' => __('Footer Navigation', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_social', 
			'title' => __('Footer Social Icons', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_html', 
			'title' => __('Footer Custom HTML', 'cmsmasters'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'cmsmasters') . '</strong>', 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_copyright', 
			'title' => __('Copyright Text', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => CMSMS_FULLNAME . ' &copy; 2014 | ' . __('All Rights Reserved', 'cmsmasters'), 
			'class' => 'nohtml' 
		);
		
		break;
	case 'icon':
		$options[] = array( 
			'section' => 'icon_section', 
			'id' => CMSMS_SHORTNAME . '_social_icons', 
			'title' => __('Social Icons', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'social', 
			'std' => array( 
				'cmsms-icon-twitter-circled|#|' . __('Twitter', 'cmsmasters') . '|true', 
				'cmsms-icon-facebook-circled|#|' . __('Facebook', 'cmsmasters') . '|true', 
				'cmsms-icon-gplus-circled|#|' . __('Google+', 'cmsmasters') . '|true', 
				'cmsms-icon-vimeo-circled|#|' . __('Vimeo', 'cmsmasters') . '|true', 
				'cmsms-icon-skype-circled|#|' . __('Skype', 'cmsmasters') . '|true' 
			) 
		);
		
		break;
	}
	
	return $options;	
}

