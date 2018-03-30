<?php function thb_image( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_image', $atts );
   extract( $atts );
	
	$img_id = preg_replace('/[^\d]/', '', $image);
	
	$full = $full_width == 'true' ? 'full' : '';
	$img_size = $img_size ? $img_size : 'full';
	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => $animation . ' ' . $alignment . ' '. $full ) );

	if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" />';
  $link_to = $c_lightbox = '';
  if ($lightbox == true) {
		$link_to = wp_get_attachment_image_src( $img_id, 'large');
		$link_to = $link_to[0];
		$c_lightbox = ' rel="magnific"';

  } else {
		$img_link = ( $img_link == '||' ) ? '' : $img_link;
		$link = vc_build_link( $img_link );
		
		$link_to = $link['url'];
		$a_title = $link['title'];
		$a_target = $link['target'];	
  }
  
  $out = !empty($link_to) ? '<a '.$c_lightbox.' href="'.$link_to.'" target="'.esc_attr( $a_target ).'" title="'.esc_attr( $a_title ).'">'.$img['thumbnail'].'</a>' : $img['thumbnail'];

  return $out;
}
add_shortcode('thb_image', 'thb_image');
