<?php

class WPV_Tribe_Events {
	public function __construct() {
		add_shortcode('wpv_tribe_events', array(__CLASS__, 'shortcode'));
	}

	public static function shortcode($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'layout' => 'single',
			'style' => 'light',
			'count' => 1,
			'ongoing' => '',
			'lead_text' => '',
			'view_all_text' => '',
			'view_all_link' => '',
			'read_more_text' => '',
			'cat' => '',
		), $atts));

		if ( ! function_exists( 'tribe_get_events' ) ) {
			return '';
		}

		$query = array(
			'posts_per_page' => (int)$count,
			'eventDisplay' => 'list',
		);

		$cat = empty($cat) ?
				array() :
				(is_array($cat) ? $cat : explode(',', $cat));

		if ( ! empty( $cat ) && ! empty( $cat[0] ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'tribe_events_cat',
					'field' => 'slug',
					'terms' => $cat,
				)
			);
		}

		$events = tribe_get_events( $query );

		ob_start();

		$layout_file = explode('-', $layout);

		include locate_template("templates/shortcodes/events/{$layout_file[0]}.php");

		return ob_get_clean();
	}
}

new WPV_Tribe_Events;
