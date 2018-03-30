<?php function thb_gap( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_gap', $atts );
  extract( $atts );
	
	$out = '';
  $out .= '<aside class="gap cf" style="height:'.$height.'px;"></aside>';
  return $out;
}
add_shortcode('thb_gap', 'thb_gap');
