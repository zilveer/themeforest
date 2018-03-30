<?php
/**
 * Morning records Framework: Theme options custom fields
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_options_custom_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_options_custom_theme_setup' );
	function morning_records_options_custom_theme_setup() {

		if ( is_admin() ) {
			add_action("admin_enqueue_scripts",	'morning_records_options_custom_load_scripts');
		}
		
	}
}

// Load required styles and scripts for custom options fields
if ( !function_exists( 'morning_records_options_custom_load_scripts' ) ) {
	//add_action("admin_enqueue_scripts", 'morning_records_options_custom_load_scripts');
	function morning_records_options_custom_load_scripts() {
		morning_records_enqueue_script( 'morning_records-options-custom-script',	morning_records_get_file_url('core/core.options/js/core.options-custom.js'), array(), null, true );	
	}
}


// Show theme specific fields in Post (and Page) options
if ( !function_exists( 'morning_records_show_custom_field' ) ) {
	function morning_records_show_custom_field($id, $field, $value) {
		$output = '';
		switch ($field['type']) {
			case 'reviews':
				$output .= '<div class="reviews_block">' . trim(morning_records_reviews_get_markup($field, $value, true)) . '</div>';
				break;
	
			case 'mediamanager':
				wp_enqueue_media( );
				$output .= '<a id="'.esc_attr($id).'" class="button mediamanager morning_records_media_selector"
					data-param="' . esc_attr($id) . '"
					data-choose="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'morning-records') : esc_html__( 'Choose Image', 'morning-records')).'"
					data-update="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Add to Gallery', 'morning-records') : esc_html__( 'Choose Image', 'morning-records')).'"
					data-multiple="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? 'true' : 'false').'"
					data-linked-field="'.esc_attr($field['media_field_id']).'"
					>' . (isset($field['multiple']) && $field['multiple'] ? esc_html__( 'Choose Images', 'morning-records') : esc_html__( 'Choose Image', 'morning-records')) . '</a>';
				break;
		}
		return apply_filters('morning_records_filter_show_custom_field', $output, $id, $field, $value);
	}
}
?>