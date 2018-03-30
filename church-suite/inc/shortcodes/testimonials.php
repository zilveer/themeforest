<?php
function webnus_testimonial ($atts, $content = null) {
 	extract(shortcode_atts(array(
	'testimonial_content'=>'',
	'img'=>'',
	'name'=>'',
	'subtitle' => '',
	), $atts));
	
	
	$out = '';
	
	if(is_numeric($img)){
		
		$img = wp_get_attachment_url( $img );
		
	}
	$out .= '<div class="testimonial">';
	$out .= '<div class="testimonial-content">';
	$out .= '<h4><q>'. $testimonial_content .'</q></h4>';
	$out .= '<div class="testimonial-arrow"></div>';
	$out .= '</div>';
	$out .= '<div class="testimonial-brand"><img src="'.$img.'" alt="Testimonial '.$name.'" />';
	$out .= '<h5><strong>'.$name.'</strong><br><em>'.$subtitle.'</em></h5></div>';
	$out .= '</div>';

return $out;
}
 add_shortcode('testimonial','webnus_testimonial');
?>