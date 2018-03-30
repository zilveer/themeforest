<?php

// Check if shortcodes settings are now used
if ( !function_exists( 'morning_records_shortcodes_is_used' ) ) {
	function morning_records_shortcodes_is_used() {
		return morning_records_options_is_used() 															// All modes when Theme Options are used
			|| (is_admin() && isset($_POST['action']) 
					&& in_array($_POST['action'], array('vc_edit_form', 'wpb_show_edit_form')))		// AJAX query when save post/page
			|| (is_admin() && morning_records_strpos($_SERVER['REQUEST_URI'], 'vc-roles')!==false)			// VC Role Manager
			|| (function_exists('morning_records_vc_is_frontend') && morning_records_vc_is_frontend());			// VC Frontend editor mode
	}
}

// Width and height params
if ( !function_exists( 'morning_records_shortcodes_width' ) ) {
	function morning_records_shortcodes_width($w="") {
		return array(
			"title" => esc_html__("Width", 'morning-records'),
			"divider" => true,
			"value" => $w,
			"type" => "text"
		);
	}
}
if ( !function_exists( 'morning_records_shortcodes_height' ) ) {
	function morning_records_shortcodes_height($h='') {
		return array(
			"title" => esc_html__("Height", 'morning-records'),
			"desc" => wp_kses_data( __("Width and height of the element", 'morning-records') ),
			"value" => $h,
			"type" => "text"
		);
	}
}

// Return sc_param value
if ( !function_exists( 'morning_records_get_sc_param' ) ) {
	function morning_records_get_sc_param($prm) {
		return morning_records_storage_get_array('sc_params', $prm);
	}
}

// Set sc_param value
if ( !function_exists( 'morning_records_set_sc_param' ) ) {
	function morning_records_set_sc_param($prm, $val) {
		morning_records_storage_set_array('sc_params', $prm, $val);
	}
}

// Add sc settings in the sc list
if ( !function_exists( 'morning_records_sc_map' ) ) {
	function morning_records_sc_map($sc_name, $sc_settings) {
		morning_records_storage_set_array('shortcodes', $sc_name, $sc_settings);
	}
}

// Add sc settings in the sc list after the key
if ( !function_exists( 'morning_records_sc_map_after' ) ) {
	function morning_records_sc_map_after($after, $sc_name, $sc_settings='') {
		morning_records_storage_set_array_after('shortcodes', $after, $sc_name, $sc_settings);
	}
}

// Add sc settings in the sc list before the key
if ( !function_exists( 'morning_records_sc_map_before' ) ) {
	function morning_records_sc_map_before($before, $sc_name, $sc_settings='') {
		morning_records_storage_set_array_before('shortcodes', $before, $sc_name, $sc_settings);
	}
}

// Compare two shortcodes by title
if ( !function_exists( 'morning_records_compare_sc_title' ) ) {
	function morning_records_compare_sc_title($a, $b) {
		return strcmp($a['title'], $b['title']);
	}
}



/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_shortcodes_settings_theme_setup' ) ) {
//	if ( morning_records_vc_is_frontend() )
	if ( (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline') )
		add_action( 'morning_records_action_before_init_theme', 'morning_records_shortcodes_settings_theme_setup', 20 );
	else
		add_action( 'morning_records_action_after_init_theme', 'morning_records_shortcodes_settings_theme_setup' );
	function morning_records_shortcodes_settings_theme_setup() {
		if (morning_records_shortcodes_is_used()) {

			// Sort templates alphabetically
			$tmp = morning_records_storage_get('registered_templates');
			ksort($tmp);
			morning_records_storage_set('registered_templates', $tmp);

			// Prepare arrays 
			morning_records_storage_set('sc_params', array(
			
				// Current element id
				'id' => array(
					"title" => esc_html__("Element ID", 'morning-records'),
					"desc" => wp_kses_data( __("ID for current element", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
			
				// Current element class
				'class' => array(
					"title" => esc_html__("Element CSS class", 'morning-records'),
					"desc" => wp_kses_data( __("CSS class for current element (optional)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
			
				// Current element style
				'css' => array(
					"title" => esc_html__("CSS styles", 'morning-records'),
					"desc" => wp_kses_data( __("Any additional CSS rules (if need)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
			
			
				// Switcher choises
				'list_styles' => array(
					'ul'	=> esc_html__('Unordered', 'morning-records'),
					'ol'	=> esc_html__('Ordered', 'morning-records'),
					'iconed'=> esc_html__('Iconed', 'morning-records')
				),

				'yes_no'	=> morning_records_get_list_yesno(),
				'on_off'	=> morning_records_get_list_onoff(),
				'dir' 		=> morning_records_get_list_directions(),
				'align'		=> morning_records_get_list_alignments(),
				'float'		=> morning_records_get_list_floats(),
				'hpos'		=> morning_records_get_list_hpos(),
				'show_hide'	=> morning_records_get_list_showhide(),
				'sorting' 	=> morning_records_get_list_sortings(),
				'ordering' 	=> morning_records_get_list_orderings(),
				'shapes'	=> morning_records_get_list_shapes(),
				'sizes'		=> morning_records_get_list_sizes(),
				'sliders'	=> morning_records_get_list_sliders(),
				'controls'	=> morning_records_get_list_controls(),
				'categories'=> morning_records_get_list_categories(),
				'columns'	=> morning_records_get_list_columns(),
				'images'	=> array_merge(array('none'=>"none"), morning_records_get_list_files("images/icons", "png")),
				'icons'		=> array_merge(array("inherit", "none"), morning_records_get_list_icons()),
				'locations'	=> morning_records_get_list_dedicated_locations(),
				'filters'	=> morning_records_get_list_portfolio_filters(),
				'formats'	=> morning_records_get_list_post_formats_filters(),
				'hovers'	=> morning_records_get_list_hovers(true),
				'hovers_dir'=> morning_records_get_list_hovers_directions(true),
				'schemes'	=> morning_records_get_list_color_schemes(true),
				'animations'		=> morning_records_get_list_animations_in(),
				'margins' 			=> morning_records_get_list_margins(true),
				'blogger_styles'	=> morning_records_get_list_templates_blogger(),
				'forms'				=> morning_records_get_list_templates_forms(),
				'posts_types'		=> morning_records_get_list_posts_types(),
				'googlemap_styles'	=> morning_records_get_list_googlemap_styles(),
				'field_types'		=> morning_records_get_list_field_types(),
				'label_positions'	=> morning_records_get_list_label_positions()
				)
			);

			// Common params
			morning_records_set_sc_param('animation', array(
				"title" => esc_html__("Animation",  'morning-records'),
				"desc" => wp_kses_data( __('Select animation while object enter in the visible area of page',  'morning-records') ),
				"value" => "none",
				"type" => "select",
				"options" => morning_records_get_sc_param('animations')
				)
			);
			morning_records_set_sc_param('top', array(
				"title" => esc_html__("Top margin",  'morning-records'),
				"divider" => true,
				"value" => "inherit",
				"type" => "select",
				"options" => morning_records_get_sc_param('margins')
				)
			);
			morning_records_set_sc_param('bottom', array(
				"title" => esc_html__("Bottom margin",  'morning-records'),
				"value" => "inherit",
				"type" => "select",
				"options" => morning_records_get_sc_param('margins')
				)
			);
			morning_records_set_sc_param('left', array(
				"title" => esc_html__("Left margin",  'morning-records'),
				"value" => "inherit",
				"type" => "select",
				"options" => morning_records_get_sc_param('margins')
				)
			);
			morning_records_set_sc_param('right', array(
				"title" => esc_html__("Right margin",  'morning-records'),
				"desc" => wp_kses_data( __("Margins around this shortcode", 'morning-records') ),
				"value" => "inherit",
				"type" => "select",
				"options" => morning_records_get_sc_param('margins')
				)
			);

			morning_records_storage_set('sc_params', apply_filters('morning_records_filter_shortcodes_params', morning_records_storage_get('sc_params')));

			// Shortcodes list
			//------------------------------------------------------------------
			morning_records_storage_set('shortcodes', array());
			
			// Register shortcodes
			do_action('morning_records_action_shortcodes_list');

			// Sort shortcodes list
			$tmp = morning_records_storage_get('shortcodes');
			uasort($tmp, 'morning_records_compare_sc_title');
			morning_records_storage_set('shortcodes', $tmp);
		}
	}
}
?>