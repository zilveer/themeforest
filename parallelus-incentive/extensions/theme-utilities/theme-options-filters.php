<?php
/**
 * Add custom values and settings to theme options by filter 
 */


#-----------------------------------------------------------------
# Include skins in Theme Options
#-----------------------------------------------------------------

if (is_admin() && !function_exists('theme_skin_select')) :
	function theme_skin_select( $options ) {
		global $Extm_Admin; // use Extensions Manager admin object
		
		$skins = $Extm_Admin->get_skin_css();

		if (is_array($skins)) {
			$options = $skins;
		}

		array_unshift($options, ""); // put a blank at the start

		return $options;
	}
	// add filter: [field alias]_data_options
	add_filter( 'skin_data_options', 'theme_skin_select' );
endif;


#-----------------------------------------------------------------
# Include pge list in 404 Error select for theme options
#-----------------------------------------------------------------

if (is_admin() && !function_exists('theme_404_content_select')) :
	function theme_404_content_select( $options ) {
		
		$allPages = get_pages();
		$options = array('default' => 'Default');

		if (is_array($allPages)) {
			foreach ($allPages as $page) {
				$options[$page->ID] = esc_attr($page->post_title);
			}
		}

		return $options;
	}
	// add filter: [field alias]_data_options
	add_filter( 'error-content_data_options', 'theme_404_content_select' );
endif;


#-----------------------------------------------------------------
# Layout Manager - Content Sources (select for header/footer)
#-----------------------------------------------------------------

// Header content sources
//................................................................
function layout_header_content_select( $options ) {

	$select_options = array();
	$header_options = array();
	$header_options = array_merge( 
		$header_options, 
		array( 'default' => __('Default (no content)', 'framework') ),
		layouts_default_content_sources()
	);
	foreach ($header_options as $key => $value) {
		$type = sanitize_title($key);
		if(is_array($value)) { 
			// $opt_group = $key;
			$select_options[$key] = 'OPTION_GROUP_START';
			foreach ($value as $opt_val => $opt_title) { 
			 	$select_options[$type.'@'.$opt_val] = $opt_title;
			}
			$select_options[$key.'-end'] = 'OPTION_GROUP_END';
		} else {
			$select_options[$type.'@'.$key] = $value;
		} 
	}

	if (is_array($select_options)) {
		$options = $select_options;
	}

	return $options;
}
// add filter: [field alias]_data_options
add_filter( 'header-content_data_options', 'layout_header_content_select' );
add_filter( 'header-content-2_data_options', 'layout_header_content_select' );


// Footer content sources
//................................................................
function layout_footer_content_select( $options, $default = array('default'=>'Default')) {

	$select_options = array();
	$footer_options = array();
	$footer_options = array_merge( 
		$footer_options, 
		$default,
		layouts_default_content_sources()
	);
	foreach ($footer_options as $key => $value) {
		$tmp = explode('@', $key);
		if(is_array($tmp) && isset($tmp[1])){
			$type = $tmp[0];
			$key = $tmp[1];
		}
		else{
			$type = sanitize_title($key);
		}

		if(is_array($value)) { 
			// $opt_group = $key;
			$select_options[$key] = 'OPTION_GROUP_START';
			foreach ($value as $opt_val => $opt_title) { 
				if(!isset($select_options[$type.'@'.$opt_val])){
			 		$select_options[$type.'@'.$opt_val] = $opt_title;					
				}
			}
			$select_options[$key.'-end'] = 'OPTION_GROUP_END';
		} else {
			$select_options[$type.'@'.$key] = $value;
		} 
	}

	if (is_array($select_options)) {
		$options = $select_options;
	}

	return $options;
}

function layout_footer_top_content_select( $options ) {
	return layout_footer_content_select( 
		$options, 
		array(
			'sidebar@sidebar-footer-top' =>  __('Theme Default (Footer Top Sidebar)', 'framework'),
			'' =>  __('Blank (no content)', 'framework')
		) 
	);
}
function layout_footer_bottom_content_select( $options ) {
	return layout_footer_content_select( 
		$options, 
		array( 
			'sidebar@sidebar-footer-bottom' => __('Theme Default (Footer Bottom Sidebar)', 'framework'),
			'' => __('Blank (no content)', 'framework')
		)
	);
}
// add filter: [field alias]_data_options
add_filter( 'footer-top-content_data_options', 'layout_footer_top_content_select' );
add_filter( 'footer-bottom-content_data_options', 'layout_footer_bottom_content_select' );


// Get content sources data
//................................................................
function layouts_default_content_sources() {
	
	$default_content_sources = array();

	// Static Blocks
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'static_block'
	);
	
	$posts = get_posts($args);
	$options_static_blocks = array();		
	foreach ($posts as $key => $value) { 
		$options_static_blocks[$value->ID] = $value->post_title;
	}
	$default_content_sources['Static Block'] = $options_static_blocks;

	// Sidebars
	$sidebars = $GLOBALS['wp_registered_sidebars'];			
	$options_sidebars = array();
	foreach ( $sidebars as $key => $value ) { 
		$options_sidebars[$value['id']] = $value['name'];												
	}		
	$default_content_sources['Sidebar'] = $options_sidebars;

	// Slide shows
	if (class_exists('RevSlider')) : 
		$ss = new RevSlider();
		$arrSliders = $ss->getArrSliders();
		$options_sliders = array();
		foreach($arrSliders as $ss):
			
			// Slide data
			$id    = $ss->getID();
			$title = $ss->getTitle();
			$alias = $ss->getAlias();

			// Select options
			$options_sliders['RevSlider:'.$alias] = $title;
		endforeach;
		$default_content_sources['Slide Show'] = $options_sliders;
	endif; // class_exists('RevSlider')

	return array_merge( $default_content_sources );

}


?>