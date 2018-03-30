<?php
/**
 * Thank You Page
 * @package by Theme Record
 * @auther: MattMao
*/

add_shortcode('shopping_thank_you', 'shortcode_shopping_thank_you');

#
#Shopping Thank You
#
function shortcode_shopping_thank_you( $atts, $content = null)
{
	global $tr_config;
	$thank_you_text = $tr_config['thank_you_page_text'];

	$output = '<div class="shopping-thank-you">'. $thank_you_text .'</div>';

	return $output;
}
?>