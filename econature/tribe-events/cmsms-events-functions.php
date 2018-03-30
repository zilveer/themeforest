<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * Website Events Functions
 * Created by CMSMasters
 * 
 */


/* Replace Styles */

function replace_tribe_events_calendar_stylesheet() {
	$styleUrl = '';

	return $styleUrl;
}

add_filter('tribe_events_stylesheet_url', 'replace_tribe_events_calendar_stylesheet');


/* Replace Pro Styles */

function replace_tribe_events_calendar_pro_stylesheet() {
	$styleUrl = '';

	return $styleUrl;
}
add_filter('tribe_events_pro_stylesheet_url', 'replace_tribe_events_calendar_pro_stylesheet');


/* Replace Widget Styles */

function replace_tribe_events_calendar_widget_stylesheet() {
	$styleUrl = '';

	return $styleUrl;
}
add_filter('tribe_events_pro_widget_calendar_stylesheet_url', 'replace_tribe_events_calendar_widget_stylesheet');


/* Replace Responsive Styles */

function customize_tribe_events_breakpoint() {
    return 749;
}
add_filter('tribe_events_mobile_breakpoint', 'customize_tribe_events_breakpoint');


add_filter('tribe_events_kill_responsive', '__return_true');

