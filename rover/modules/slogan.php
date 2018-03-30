<?php
/**
 * Slogan
 * @package by Theme Record
 * @auther: MattMao
*/
add_shortcode('slogan', 'theme_site_slogan');

function theme_site_slogan($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
			'dotted_line' => 'yes',
    ), $atts));

	if($dotted_line == 'yes')
	{
		$class = ' slogan-dotted-line';
	}
	else
	{
		$class = '';
	}

	$output = '<div class="site-slogan'.$class.'">';
	$output .= '<p>'.theme_shortcode_text($content).'</p>';
	$output .= '</div>';

	return $output;
}

?>