<?php

// Tab
function tab_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'title' => ''
		), $atts ) );
	return '<div id="tabs-'. sanitize_title( $title ) .'">'. do_shortcode( $content ) .'</div>';
}

add_shortcode( 'tab', 'tab_shortcode' );



// Tabs Container
function tabs_container_shortcode( $atts, $content = null ) {
	
	preg_match_all( '/tab title="([^\"]+)"/i', $content, $matche, PREG_OFFSET_CAPTURE );
	
	$tab_title = array();
	
	if( isset($matche[1]) ) {
		$tab_title = $matche[1];
	}
	
	$output = '';
	
	if( count($tab_title) ) {
	    $output .= '<div class="tabs">';
		$output .= '<ul class="tabNavigation clearfix">';
		foreach( $tab_title as $tab ){
			$output .= '<li><a href="#tabs-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
		}
	    $output .= '</ul>' . do_shortcode( $content ) . '</div>';
	} else {
		$output .= do_shortcode( $content );
	}
	
	return $output;

}

add_shortcode( 'tabs_container', 'tabs_container_shortcode' );

?>