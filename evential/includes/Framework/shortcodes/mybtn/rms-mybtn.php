<?php
function mybtn($atts, $content = null)
{
    extract(shortcode_atts(array(
        'type' 			=> '',
        'text' 			=> '',
        'link' 			=> '',
        'class'        	=> ''
    ), $atts));
	
    $mybutton_return = '';
	if($type == 'Button-Big-color'){
		$mybutton_return .= '<a class="button button-big button-dark '.esc_attr($class).'" data-scroll href="'.esc_url($link).'">'.esc_html($text).'</a>';
	} 
	elseif($type == 'Button-Small-color') {
		$mybutton_return .= '<a class="button button-dark '.esc_attr($class).'" href="'.esc_url($link).'">'.esc_html($text).'</a>';
	} 
	elseif($type == 'Button-Big-Nocolor') {
		$mybutton_return .= '<a class="button button-big button-light '.esc_attr($class).'" href="'.esc_url($link).'">'.esc_html($text).'</a>';
	}
    return $mybutton_return;
}
add_shortcode( "rms-mybtn", "mybtn" );