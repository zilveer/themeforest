<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Logo Options
 * Created by CMSMasters
 * 
 */


function cmsms_options_logo_tabs() {
	$tabs = array();
	
	$tabs['image'] = __('Image Logo', 'cmsmasters');
	$tabs['text'] = __('Text Logo', 'cmsmasters');
	$tabs['favicon'] = __('Favicon', 'cmsmasters');
	
	return $tabs;
}


function cmsms_options_logo_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 'image':
		$sections = array();
		
		$sections['image_section'] = __('Image Logo Options', 'cmsmasters');
		
		break;
	case 'text':
		$sections = array();
		
		$sections['text_section'] = __('Text Logo Options', 'cmsmasters');
		
		break;
	case 'favicon':
		$sections = array();
		
		$sections['favicon_section'] = __('Favicon Options', 'cmsmasters');
		
		break;
	}
	
	return $sections;
} 


function cmsms_options_logo_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	$options = array();
	
	switch ($tab) {
	case 'image':
		$options[] = array( 
			'section' => 'image_section', 
			'id' => CMSMS_SHORTNAME . '_logo_url', 
			'title' => __('Custom Logo Image', 'cmsmasters'), 
			'desc' => __('Choose your custom website logo image.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => get_template_directory_uri() . '/img/logo.png' 
		);
		
		$options[] = array( 
			'section' => 'image_section', 
			'id' => CMSMS_SHORTNAME . '_logo_width', 
			'title' => __('Logo Image Width', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '188' 
		);
		
		$options[] = array( 
			'section' => 'image_section', 
			'id' => CMSMS_SHORTNAME . '_logo_height', 
			'title' => __('Logo Image Height', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '29' 
		);
		
		$options[] = array( 
			'section' => 'image_section', 
			'id' => CMSMS_SHORTNAME . '_logo_top', 
			'title' => __('Logo Top Position', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '53' 
		);
		
		$options[] = array( 
			'section' => 'image_section', 
			'id' => CMSMS_SHORTNAME . '_logo_left', 
			'title' => __('Logo Left Position', 'cmsmasters'), 
			'desc' => __('pixels', 'cmsmasters'), 
			'type' => 'number', 
			'std' => '45' 
		);
		
		break;
	case 'text':
		$options[] = array( 
			'section' => 'text_section', 
			'id' => CMSMS_SHORTNAME . '_text_logo', 
			'title' => __('Text Logo', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'text_section', 
			'id' => CMSMS_SHORTNAME . '_text_logo_title', 
			'title' => __('Custom Logo Title', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => ((get_bloginfo('name')) ? get_bloginfo('name') : 'Agriculture'), 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'text_section', 
			'id' => CMSMS_SHORTNAME . '_text_logo_title_color', 
			'title' => __('Custom Logo Title Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#483601'
		);
		
		$options[] = array( 
			'section' => 'text_section', 
			'id' => CMSMS_SHORTNAME . '_text_logo_subtitle', 
			'title' => __('Logo Subtitle', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 0 
		);
		
		$options[] = array( 
			'section' => 'text_section', 
			'id' => CMSMS_SHORTNAME . '_text_logo_subtitle_text', 
			'title' => __('Custom Logo Subtitle', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => ((get_bloginfo('description')) ? get_bloginfo('description') : 'Corporate &amp; Business'), 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'text_section', 
			'id' => CMSMS_SHORTNAME . '_text_logo_subtitle_color', 
			'title' => __('Custom Logo Subtitle Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#483601'
		);
		
		break;
	case 'favicon':
		$options[] = array( 
			'section' => 'favicon_section', 
			'id' => CMSMS_SHORTNAME . '_favicon', 
			'title' => __('Favicon', 'cmsmasters'), 
			'desc' => __('show', 'cmsmasters'), 
			'type' => 'checkbox', 
			'std' => 1 
		);
		
		$options[] = array( 
			'section' => 'favicon_section', 
			'id' => CMSMS_SHORTNAME . '_favicon_url', 
			'title' => __('Custom Favicon URL', 'cmsmasters'), 
			'desc' => __('Choose your custom website favicon image url.', 'cmsmasters'), 
			'type' => 'upload', 
			'std' => get_template_directory_uri() . '/img/favicon.ico' 
		);
		
		break;
	}
	
	return $options;	
}

