<?php

$args = array();

extract(shortcode_atts($args, $atts));

//init variables
$html 			    = '';


$html .= '<div class="qode-pricing-list">';
	$html .='<div class="qode-pricing-list-holder">';
		$html .= do_shortcode($content);
	$html .='</div>';
$html .= '</div>';

print $html;