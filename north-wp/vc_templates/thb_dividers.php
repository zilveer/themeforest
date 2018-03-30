<?php function thb_dividers( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_dividers', $atts );
	extract( $atts );
	
	$out = '<aside class="styled_dividers '.$style.' "><span></span></aside>';
	
	return $out;
}
add_shortcode('thb_dividers', 'thb_dividers');
