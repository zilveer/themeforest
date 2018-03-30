<?php function thb_teammember( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_teammember', $atts );
   extract( $atts );
	
	$out = '';
	
	$img_id = preg_replace('/[^\d]/', '', $image);
	$img = wp_get_attachment_image_src($img_id, 'full');
	$resized = aq_resize( $img[0], 320, 340, true, false, true);
  $out .= '<aside class="team_member">';
  $out .= '<img src="'.$resized[0].'" width="'.$resized[1].'" height="'.$resized[2].'" alt="'.$name.'" />';
  $out .= '<div class="overlay"><div class="buttons">';

  	$out .= ($name ? '<h5>'.$name.'</h5>' : '');
  	$out .= ($position ? '<h6>'.$position.'</h6>' : '');
	if ($facebook || $pinterest || $twitter || $linkedin) {
		$out .= '<div class="social_links">';
		if ($facebook) {
			$out .= '<a href="'.$facebook.'" class="facebook"><i class="fa fa-facebook"></i></a>';
		}
		if ($twitter) {
			$out .= '<a href="'.$twitter.'" class="twitter"><i class="fa fa-twitter"></i></a>';
		}
		if ($pinterest) {
			$out .= '<a href="'.$pinterest.'" class="pinterest"><i class="fa fa-pinterest"></i></a>';
		}
		if ($linkedin) {
			$out .= '<a href="'.$linkedin.'" class="linkedin"><i class="fa fa-linkedin"></i></a>';
		}
		$out .= '</div>';
	}
  $out .= '</div></div>';
  $out .= '</aside>';
  return $out;
}
add_shortcode('thb_teammember', 'thb_teammember');
