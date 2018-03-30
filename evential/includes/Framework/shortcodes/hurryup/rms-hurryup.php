<?php
function hurryup($atts, $content = null)
{
    extract(shortcode_atts(array(
        'type' 			=> '',
        'seatleft' 		=> '',
        'text' 			=> '',
        'texts' 		=> '',
        'buttontext' 	=> '',
        'content' 		=> '',
        'link' 			=> ''
    ), $atts));
	
    $hurryup_return = '';
	if($type == 'Hummry-Up-Style1'){
		$hurryup_return .= '
		<div class="col-lg-8 col-lg-offset-2 text-center">
			<h3>'.esc_html($text).' <span class="timer" data-to="'.esc_attr($seatleft).'" data-speed="10000"></span> '.esc_html($texts).'</h3>
			<a class="button button-big button-dark" data-scroll href="'.esc_attr($link).'">'.esc_html($buttontext).'</a>
		</div>';
	}
	elseif($type == 'Hummry-Up-Style2'){
		$hurryup_return .= '
		<div class="col-lg-12 text-center">
			<p class="lead">'.esc_html($text).' <span class="timer" data-to="'.esc_attr($seatleft).'" data-speed="10000"></span> '.esc_html($texts).'</p>
			<p>'.esc_html($content).'</p>
			<button class="button button-big button-light" data-toggle="modal" data-target="#rms_contact">'.$buttontext.'</button>
		</div>';
	}
    return $hurryup_return;
}
add_shortcode( "rms-hurryup", "hurryup" );