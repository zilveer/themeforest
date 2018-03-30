<?php

extract( shortcode_atts( array(
			'size' => '40',
			'visibility' => '',
		), $atts ) );


$output = '<div class="clearboth"></div>';
$output .= '<div class="mk-shortcode mk-padding-shortcode '.$visibility.'" style="height:'.$size.'px"></div><div class="clearboth"></div>';
echo $output;
