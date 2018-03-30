<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Fonts Options
 * Created by CMSMasters
 * 
 */


function cmsms_options_font_tabs() {
	$tabs = array();
	
	$tabs['content'] = __('Content', 'cmsmasters');
	$tabs['link'] = __('Links', 'cmsmasters');
	$tabs['nav'] = __('Navigation', 'cmsmasters');
	$tabs['h1'] = __('H1', 'cmsmasters');
	$tabs['h2'] = __('H2', 'cmsmasters');
	$tabs['h3'] = __('H3', 'cmsmasters');
	$tabs['h4'] = __('H4', 'cmsmasters');
	$tabs['h5'] = __('H5', 'cmsmasters');
	$tabs['h6'] = __('H6', 'cmsmasters');
	$tabs['other'] = __('Other', 'cmsmasters');
	
	return $tabs;
}


function cmsms_options_font_sections() {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	case 'content':
		$sections = array();
		
		$sections['content_section'] = __('Content Font Options', 'cmsmasters');
		
		break;
	case 'link':
		$sections = array();
		
		$sections['link_section'] = __('Links Font Options', 'cmsmasters');
		
		break;
	case 'nav':
		$sections = array();
		
		$sections['nav_section'] = __('Navigation Font Options', 'cmsmasters');
		
		break;
	case 'h1':
		$sections = array();
		
		$sections['h1_section'] = __('H1 Font Options', 'cmsmasters');
		
		break;
	case 'h2':
		$sections = array();
		
		$sections['h2_section'] = __('H2 Font Options', 'cmsmasters');
		
		break;
	case 'h3':
		$sections = array();
		
		$sections['h3_section'] = __('H3 Font Options', 'cmsmasters');
		
		break;
	case 'h4':
		$sections = array();
		
		$sections['h4_section'] = __('H4 Font Options', 'cmsmasters');
		
		break;
	case 'h5':
		$sections = array();
		
		$sections['h5_section'] = __('H5 Font Options', 'cmsmasters');
		
		break;
	case 'h6':
		$sections = array();
		
		$sections['h6_section'] = __('H6 Font Options', 'cmsmasters');
		
		break;
	case 'other':
		$sections = array();
		
		$sections['other_section'] = __('Other Fonts Options', 'cmsmasters');
		
		break;
	}
	
	return $sections;
} 


function cmsms_options_font_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	
	$cmsms_option = cmsms_get_global_options();
	
	
	$options = array();
	
	switch ($tab) {
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_content_font', 
			'title' => __('Main Content Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => '', 
				'font_color' => '#252525', 
				'font_size' => '12', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => CMSMS_SHORTNAME . '_widget_content_font', 
			'title' => __('Widgets Content Font Size', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'font_size' => '11', 
				'line_height' => '20'
			), 
			'choices' => array( 
				'font_size', 
				'line_height'
			) 
		);
		
		break;
	case 'link':
		$options[] = array( 
			'section' => 'link_section', 
			'id' => CMSMS_SHORTNAME . '_link_font', 
			'title' => __('Links Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => '', 
				'font_color' => '#61200c',
				'font_size' => '12', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal'
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'link_section', 
			'id' => CMSMS_SHORTNAME . '_link_font_hover', 
			'title' => __('Links Font Hover Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#252525'
		);
		
		break;
	case 'nav':
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => CMSMS_SHORTNAME . '_nav_title_font', 
			'title' => __('Navigation Title Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif",  
				'google_font' => 'BenchNine:400,700', 
				'font_color' => '#483601',
				'font_size' => '18', 
				'line_height' => '20', 
				'font_weight' => 'bold', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => CMSMS_SHORTNAME . '_nav_title_font_hover', 
			'title' => __('Navigation Title Hover Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#ffffff'
		);
		
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => CMSMS_SHORTNAME . '_nav_dropdown_font', 
			'title' => __('Navigation Dropdown Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 'BenchNine:400,700',
				'font_color' => '#ffffff', 
				'font_size' => '15', 
				'line_height' => '20', 
				'font_weight' => 'bold', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => CMSMS_SHORTNAME . '_nav_dropdown_font_hover', 
			'title' => __('Navigation Dropdown Hover Color', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => '#ffcb32'
		);
		
		break;
	case 'h1':
		$options[] = array( 
			'section' => 'h1_section', 
			'id' => CMSMS_SHORTNAME . '_h1_font', 
			'title' => __('H1 Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 'BenchNine:400,700',
				'font_color' => '#252525', 
				'font_size' => '36', 
				'line_height' => '54', 
				'font_weight' => 'bold', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'h2':
		$options[] = array( 
			'section' => 'h2_section', 
			'id' => CMSMS_SHORTNAME . '_h2_font', 
			'title' => __('H2 Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif",
				'google_font' => 'Headland+One',
				'font_color' => '#252525', 
				'font_size' => '24', 
				'line_height' => '36', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'h3':
		$options[] = array( 
			'section' => 'h3_section', 
			'id' => CMSMS_SHORTNAME . '_h3_font', 
			'title' => __('H3 Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif",
				'google_font' => 'Headland+One',
				'font_color' => '#252525', 
				'font_size' => '18', 
				'line_height' => '36', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'h4':
		$options[] = array( 
			'section' => 'h4_section', 
			'id' => CMSMS_SHORTNAME . '_h4_font', 
			'title' => __('H4 Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif",
				'google_font' => 'Headland+One',
				'font_color' => '#252525', 
				'font_size' => '15', 
				'line_height' => '24', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'h5':
		$options[] = array( 
			'section' => 'h5_section', 
			'id' => CMSMS_SHORTNAME . '_h5_font', 
			'title' => __('H5 Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif",
				'google_font' => 'Headland+One',
				'font_color' => '#252525', 
				'font_size' => '14', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal'
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'h6':
		$options[] = array( 
			'section' => 'h6_section', 
			'id' => CMSMS_SHORTNAME . '_h6_font', 
			'title' => __('H6 Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif",
				'google_font' => 'Headland+One',
				'font_color' => '#252525', 
				'font_size' => '13', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal'
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'other':
		$options[] = array( 
			'section' => 'other_section', 
			'id' => CMSMS_SHORTNAME . '_quote_font', 
			'title' => __('Blockquote Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 'Headland+One', 
				'font_color' => '#252525', 
				'font_size' => '15', 
				'line_height' => '24', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => CMSMS_SHORTNAME . '_dropcap_font', 
			'title' => __('Dropcap Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 'Headland+One', 
				'font_color' => '#252525', 
				'font_size' => '36', 
				'line_height' => '36', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => CMSMS_SHORTNAME . '_code_font', 
			'title' => __('Code Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => '', 
				'font_color' => '#252525', 
				'font_size' => '13', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => CMSMS_SHORTNAME . '_small_font', 
			'title' => __('Small Tag Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => '', 
				'font_color' => '#252525', 
				'font_size' => '11', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => CMSMS_SHORTNAME . '_input_font', 
			'title' => __('Text Fields Font', 'cmsmasters'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => array( 
				'system_font' => "Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => '', 
				'font_color' => '#252525', 
				'font_size' => '12', 
				'line_height' => '18', 
				'font_weight' => 'normal', 
				'font_style' => 'normal' 
			), 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_color', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	}
	
	return $options;	
}

