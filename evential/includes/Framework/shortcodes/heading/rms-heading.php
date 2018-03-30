<?php
function heading($atts)
{
    extract(shortcode_atts(array(
        'text'               	=> '',
        'content'               => '',
        'icon'               	=> '',
        'type'               	=> ''
    ), $atts));
    
    $result ='';
    if($type == 'Header-Big')
    {
        $result .= '
		<div class="col-lg-12 text-center">
			<i class="fa fa-4x '.esc_attr($icon).'"></i>
			<h2 class="uppercase">'.esc_attr($text).'</h2>
			<p class="lead col-lg-10 col-lg-offset-1">'.esc_html($content).'</p>
		</div>';
    }
    elseif($type == 'Header-Center')
    {
        $result .= '
		<h2 class="uppercase text-center">'.esc_html($text).'</h2>';
    }
	elseif($type == 'Header-Left')
    {
        $result .= '
		<h3>'.esc_html($text).'</h3>';
    }
    return $section_heading = force_balance_tags( $result );
}
add_shortcode( "rms-heading", "heading" );