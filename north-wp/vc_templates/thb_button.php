<?php function thb_button( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_button', $atts );
  extract( $atts );
	
	if($icon) { $caption = '<span class="icon"><i class="'.$icon.'"></i></span> '.$caption; }
	
	$out = '<a class="btn '.$color.' '.$size.' '.$animation.'" href="'.$link.'" ' . ($target_blank ? ' target="_blank"' : '') .' role="button">' .$caption. '</a>';
  
  return $out;
}
add_shortcode('thb_button', 'thb_button');
