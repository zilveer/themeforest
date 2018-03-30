<?php
$output = '';
extract(shortcode_atts(array(
	'name' 	=> '',
), $atts));
echo '<div id="'.esc_attr($name).'"></div>';