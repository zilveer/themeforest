<?php

// List Wrapper
function list_shortcode( $atts, $content = null ) {
	
	// type: circle / arrow / tick / cross
	
	extract( shortcode_atts( array(
			'type' => '',
		), $atts ) );
	
	if( !isset($atts['type']) ) {
		$ul = '<ul>';
	}
	
	else {
		
		if ( $atts['type'] == 'arrow' ) :
			$ul = '<ul class="list1">';
		elseif ( $atts['type'] == 'circle' ) :
			$ul = '<ul class="list2">';
		elseif ( $atts['type'] == 'tick' ) :
			$ul = '<ul class="list3">';
		elseif ( $atts['type'] == 'cross' ) :
			$ul = '<ul class="list4">';
		endif;
			
	}
	
	return $ul . do_shortcode($content) . '</ul>';

}

add_shortcode( 'list', 'list_shortcode' );

// List Items
function li_shortcode( $atts, $content = null ) {	
	return '<li>' . $content . '</li>';
}

add_shortcode( 'li', 'li_shortcode' );

?>