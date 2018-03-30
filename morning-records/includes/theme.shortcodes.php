<?php
if (!function_exists('morning_records_theme_shortcodes_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_theme_shortcodes_setup', 1 );
	function morning_records_theme_shortcodes_setup() {
		add_filter('morning_records_filter_googlemap_styles', 'morning_records_theme_shortcodes_googlemap_styles');
	}
}


// Add theme-specific Google map styles
if ( !function_exists( 'morning_records_theme_shortcodes_googlemap_styles' ) ) {
	function morning_records_theme_shortcodes_googlemap_styles($list) {
		$list['simple']		= esc_html__('Simple', 'morning-records');
		$list['greyscale']	= esc_html__('Greyscale', 'morning-records');
		$list['inverse']	= esc_html__('Inverse', 'morning-records');
		return $list;
	}
}
?>