<?php

if ( ! class_exists( 'Tribe__Events__Main' ) ) return;

add_filter('tribe_event_meta_venue_map', '__return_false');

/**
 * Modify the events listing date headers
 *
 * @param  string $html        original html
 * @param  string $event_month original month
 * @param  string $event_year  original year
 * @return string              extended html
 */
function wpv_tribe_events_list_the_date_headers($html, $event_month, $event_year) {
	if(empty($html)) return '';

	if(!isset($GLOBALS['wpv_pretty_tribe_date_headers'])) return $html;

	if(!$GLOBALS['wpv_pretty_tribe_date_headers_first']) {
		$html = '</section>'.$html;
	}

	return $html.'<section class="wpv-tribe-events-block clearfix">';
}
add_filter('tribe_events_list_the_date_headers',  'wpv_tribe_events_list_the_date_headers', 100, 3);

function wpv_tribe_events_integration() {
	if(!is_singular(Tribe__Events__Main::POSTTYPE)) return;

	// large map
	$GLOBALS['wpv_single_event_id'] = get_the_ID();
	function wpv_tribe_single_gmap() {
		$the_id = tribe_get_venue_id($GLOBALS['wpv_single_event_id']);
		$the_address = Tribe__Events__Main::instance()->fullAddressString($the_id);

		if(get_post_meta( $GLOBALS['wpv_single_event_id'], '_EventShowMap', true ) == '1') {
			echo WPV_Gmap::shortcode(array(
				'address' => $the_address,
				'height' => 500,
				'html' => $the_address,
				'popup' => true,
				'scrollwheel' => false
			));
		}
	}
	add_action( 'wpv_tribe_events_after_sidebars-1', 'wpv_tribe_single_gmap' );

	// upcoming events
	if(wpv_get_option('events-after-sidebars-2-content') !== '') {
		function wpv_tribe_single_upcoming() {
			echo do_shortcode(wpv_get_option('events-after-sidebars-2-content'));
		}
		add_action( 'wpv_tribe_events_after_sidebars-2', 'wpv_tribe_single_upcoming' );
	}

	// single event media
	function wpv_tribe_media() {
		get_template_part('tribe-events/single-event', 'media');
	}
	add_action( 'wpv_inside_main', 'wpv_tribe_media' );

	function wpv_tribe_events_get_event_link($link) {
		return str_replace('a href', 'a class="wpv-tribe-sibling" href', $link);
	}
	add_filter('tribe_events_get_event_link', 'wpv_tribe_events_get_event_link');
}
add_action('template_redirect', 'wpv_tribe_events_integration');
