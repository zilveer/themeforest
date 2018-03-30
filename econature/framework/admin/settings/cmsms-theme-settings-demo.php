<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Admin Panel Theme Settings Import/Export
 * Created by CMSMasters
 * 
 */


function cmsms_options_demo_tabs() {
	$tabs = array();
	
	
	$tabs['import'] = __('Import', 'cmsmasters');
	$tabs['export'] = __('Export', 'cmsmasters');
	
	
	return $tabs;
}


function cmsms_options_demo_sections() {
	$tab = cmsms_get_the_tab();
	
	
	switch ($tab) {
	case 'import':
		$sections = array();
		
		$sections['import_section'] = __('Theme Settings Import', 'cmsmasters');
		
		
		break;
	case 'export':
		$sections = array();
		
		$sections['export_section'] = __('Theme Settings Export', 'cmsmasters');
		
		
		break;
	}
	
	
	return $sections;
} 


function cmsms_options_demo_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = cmsms_get_the_tab();
	}
	
	
	$options = array();
	
	
	switch ($tab) {
	case 'import':
		$options[] = array( 
			'section' => 'import_section', 
			'id' => CMSMS_SHORTNAME . '_demo_import', 
			'title' => __('Theme Settings', 'cmsmasters'), 
			'desc' => __("Enter your theme settings data here and click 'Import' button", 'cmsmasters'), 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		
		break;
	case 'export':
		$options[] = array( 
			'section' => 'export_section', 
			'id' => CMSMS_SHORTNAME . '_demo_export', 
			'title' => __('Theme Settings', 'cmsmasters'), 
			'desc' => __("Click here to export your theme settings data to the file", 'cmsmasters'), 
			'type' => 'button', 
			'std' => __('Export Theme Settings', 'cmsmasters'), 
			'class' => 'cmsms-demo-export' 
		);
		
		
		break;
	}
	
	
	return $options;	
}

