<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Appearance
 * Created by CMSMasters
 * 
 */


function cmsms_options_style_tabs() {
	$tabs = array();
	
	$tabs['bg'] = __('Background', 'cmsmasters');
	$tabs['header'] = __('Header', 'cmsmasters');
	$tabs['content'] = __('Content', 'cmsmasters');
	$tabs['footer'] = __('Footer', 'cmsmasters');
	
	return $tabs;
}


function cmsms_options_style_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 'bg':
		$sections = array();
		
		$sections['bg_section'] = __('Background Options', 'cmsmasters');
		
		break;
	case 'header':
		$sections = array();
		
		$sections['header_section'] = __('Header Options', 'cmsmasters');
		
		break;
	case 'content':
		$sections = array();
		
		$sections['content_section'] = __('Content Options', 'cmsmasters');
		
		break;
	case 'footer':
		$sections = array();
		
		$sections['footer_section'] = __('Footer Options', 'cmsmasters');
		
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
	case 'bg':
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_col', 
			'title' => __('Background Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#0b7104' 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_img_enable', 
			'title' => __('Background Image Visibility', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => CMSMS_SHORTNAME . '_bg_img', 
			'title' => __('Background Image', 'cmsmasters'), 
			'desc' => __('Choose your custom website background image url.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => get_template_directory_uri() . '/img/bg.jpg' 
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
		
		break;
	case 'header':
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_height', 
			'title' => __('Header Height', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '127' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_nav_right', 
			'title' => __('Header Navigation Right Position', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '0' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_custom_html', 
			'title' => __('Header Custom HTML', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => CMSMS_SHORTNAME . '_header_html', 
			'title' => '', 
			'desc' => '<strong>' . __('HTML tags are allowed!', 'cmsmasters') . '</strong>', 
			'type' => 'textarea', 
			'std' => '' 
		);
		
		break;
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_layout', 
			'title' => __('Default Layout Type', 'cmsmasters'), 
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
			'id' => CMSMS_SHORTNAME . '_breadcrumb', 
			'title' => __('Breadcrumbs Default Visibility', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_top_sidebar', 
			'title' => __('Top Sidebar Default Visibility', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_middle_sidebar', 
			'title' => __('Middle Sidebar Default Visibility', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_bottom_sidebar', 
			'title' => __('Bottom Sidebar Default Visibility', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		if (class_exists('woocommerce')) {
			$options[] = array( 
				'section' => 'content_section', 
				'id' => CMSMS_SHORTNAME . '_woocommerce_top_widgets_columns', 
				'title' => __('Woocommerce Top Sidebar Widget Column Width', 'cmsmasters'), 
				'desc' => '', 
				'type' => 'select', 
				'std' => 'one_fourth_woocommerce', 
				'choices' => array( 
					__('One Fourth', 'cmsmasters') . '|one_fourth_woocommerce', 
					__('One Third', 'cmsmasters') . '|one_third_woocommerce', 
					__('One Half', 'cmsmasters') . '|one_half_woocommerce', 
					__('One First', 'cmsmasters') . '|one_first_woocommerce'
				) 
			);
			
			$options[] = array( 
				'section' => 'content_section', 
				'id' => CMSMS_SHORTNAME . '_woocommerce_middle_widgets_columns', 
				'title' => __('Woocommerce Middle Sidebar Widget Column Width', 'cmsmasters'), 
				'desc' => '', 
				'type' => 'select', 
				'std' => 'one_fourth_woocommerce', 
				'choices' => array( 
					__('One Fourth', 'cmsmasters') . '|one_fourth_woocommerce', 
					__('One Third', 'cmsmasters') . '|one_third_woocommerce', 
					__('One Half', 'cmsmasters') . '|one_half_woocommerce', 
					__('One First', 'cmsmasters') . '|one_first_woocommerce'
				) 
			);
			
			$options[] = array( 
				'section' => 'content_section', 
				'id' => CMSMS_SHORTNAME . '_woocommerce_bottom_widgets_columns', 
				'title' => __('Woocommerce Bottom Sidebar Widget Column Width', 'cmsmasters'), 
				'desc' => '', 
				'type' => 'select', 
				'std' => 'one_fourth_woocommerce', 
				'choices' => array( 
					__('One Fourth', 'cmsmasters') . '|one_fourth_woocommerce', 
					__('One Third', 'cmsmasters') . '|one_third_woocommerce', 
					__('One Half', 'cmsmasters') . '|one_half_woocommerce', 
					__('One First', 'cmsmasters') . '|one_first_woocommerce'
				) 
			);
		}
		
		break;
	case 'footer':
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
			'id' => CMSMS_SHORTNAME . '_footer_html', 
			'title' => __('Footer Custom HTML', 'cmsmasters'), 
			'desc' => '<strong>' . __('HTML tags are allowed!', 'cmsmasters') . '</strong>', 
			'type' => 'textarea', 
			'std' => '' 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => CMSMS_SHORTNAME . '_footer_copyright', 
			'title' => __('Copyright Text', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => CMSMS_FULLNAME . ' &copy; 2013 | ' . __('All Rights Reserved', 'cmsmasters'), 
			'class' => 'nohtml' 
		);
		
		break;
	}
	
	return $options;	
}

