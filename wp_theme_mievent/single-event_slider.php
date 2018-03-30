<?php
/**
 * The Template for displaying hero backgrounds
 *
 * @package MiEvent
 * @subpackage MiEvent
 * @since MiEvent 1.0
 */

get_header();
the_post();

$event_slider=get_the_ID();
if(!empty($event_slider))
{
	echo '<div id="home_slider">';
	echo do_shortcode('[hero_background slider_id="'.$event_slider.'"]');
	echo '</div>';
}
get_footer();