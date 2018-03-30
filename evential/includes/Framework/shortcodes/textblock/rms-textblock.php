<?php
function textblock($atts, $content = null)
{
    extract(shortcode_atts(array(
        'text' 				=> '',
        'content' 			=> '',
        'icon' 				=> '',
        'class' 			=> '',
        'link' 				=> '',
        'texts' 			=> '',
		'align'             => ''
    ), $atts));
	
	$results ='';
	$results .= '
		<div style="text-align:'.esc_attr($align).'">
			<i class="fa fa-3x '.esc_attr($icon).'"></i>
			<h4>'.esc_html($text).'</h4>
			<p class="conference">'.esc_html($content).'</p>
			<a class="button button-dark '.esc_attr($class).'" href="'.esc_url($link).'">'.esc_html($texts).'</a>
		</div>';
	
    return $section_mybtn = force_balance_tags( $results );
}
add_shortcode( "rms-textblock", "textblock" );