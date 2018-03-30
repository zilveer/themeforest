<?php

// [contact size={size} float={float} round={round}]{content}[/contact]
// {content} - string type
// {size} - normal:big:tiny
// {float} - left:right:none
// {round} - normal:round:roundX
function contactUsPage($atts, $content = null) {
   extract(shortcode_atts(array(
		'size' => 'normal',
		'float' => 'none',
		'round' => 'normal'
		), $atts)
	);

	$contactPage = get_option('tb_page_contact');

	if ($size == 'big') {
		$class = 'bigButton';
	} elseif ($size == 'tiny') {
		$class = 'tinyButton';
	} else {
		$class = 'button';
	}
	
	if ($float == 'left' || $float == 'right') {$class .= ' ' . $float;}
	
	if ($round == 'round') $class .= ' roundButton';
	if ($round == 'roundX') $class .= ' roundButtonX';
	
	if ($contactPage) {
		$output = '<div class="overflow10"><a href="' . get_permalink($contactPage) . '" class="' . $class . '">' . $content . '</a></div>';
	} else {
		$output = FALSE;
	}
	
	return $output;
}

add_shortcode('contact', 'contactUsPage');

?>