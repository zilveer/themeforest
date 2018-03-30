<?php
/* **********************************************************
 * Rms Fun Fact Counter
 * **********************************************************/
function rms_funs( $params, $content = null) {
    extract( shortcode_atts( array(
    	'id' => rand(100,1000)
    ), $params ) );
		
	$scontent = do_shortcode($content);
	if(trim($scontent) != ""){
		$output = '<div id="milestone">
                        <div class="col-lg-12 text-center">
                            <div class="row">'.$scontent.'</div>';
		$output .= '</div></div>';
		
		
		return $output;
	} else {
		return "";
	}
}
add_shortcode( 'rms-funs', 'rms_funs' );

function rms_fun( $params, $content = null) {
    extract( shortcode_atts( array(
        'icon' => '',
        'count' => '',
        'text' => '',
        'id' => rand(100,1000)
    ), $params ) );
    
    return '
			<div class="fact col-xs-12 col-md-3 col-lg-3">
				<p class="timer" data-to="'.esc_attr($count).'" data-speed="10000"></p>
				<i class="fa fa-2x '.esc_attr($icon).'"></i>
				<p>'.$content.'</p>
			</div>';
	
}
add_shortcode( 'rms-fun', 'rms_fun' );