<?php
/* **********************************************************
 * Rms testimonial
 * **********************************************************/
function rms_partners( $params, $content = null) {
    extract( shortcode_atts( array(
    	'id' => rand(100,1000),
        'title' => ''
    ), $params ) );
		
	$scontent = do_shortcode($content);
	if(trim($scontent) != ""){
		$output = '<div class="col-lg-12 text-center">';	
		$output .= '<h3 class="uppercase">'.esc_html($title).'</h3>';	
		$output .= '<div class="sponsor-slider">'.$scontent.'</div>';	
		$output .= '<div class="clearfix"></div>';
		$output .= '</div>';	
		
		return $output;
	} else {
		return "";
	}
}
add_shortcode( 'rms-partners', 'rms_partners' );

function rms_partner( $params, $content = null) {
    extract( shortcode_atts( array(
        'logo' => ''
    ), $params ) );
    
    return '<img class="img-responsive" src="'.esc_url($logo).'" alt="logo">';
	
}
add_shortcode( 'rms-partner', 'rms_partner' );