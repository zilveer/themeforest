<?php
function webnus_parallax($attributes, $content) {
	extract(shortcode_atts(array(
		"img" => '',
		"height" => '',
		'padding_top' => 0,
		'padding_bottom' => 0,
		'bg_attachment' => 'false',
		'bgcover' => 'true',
		'repeat' => 'no-repeat',
		'dark' => 'false',
		'speed'=>'6',
		'class' => '',
		'row_pattern'=>'',
		'row_color'=>'',
		'id'=>''
		),
	 $attributes));
	  	if(is_numeric($img)){
		$img = wp_get_attachment_url( $img );
	}
	$fixed = ($bg_attachment == 'true')? 'fixed center top':'center';
	$background_style = !empty($img)?" background: url('{$img}') {$repeat} {$fixed}; ":'';
	$background_size = 	($bgcover=='true')? 'background-size: cover;':''; 
	$w_height = ltrim ($height);
	if(substr($w_height,-2,2)=="px")
		$height_style = " min-height:{$w_height}; ";
	else
		$height_style = " min-height:{$w_height}px; ";
	$padding_top = ltrim ($padding_top);
	$padding_top = (substr($padding_top,-2,2)=="px")? $padding_top : $padding_top.'px';
	$padding_bottom = ltrim ($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2)=="px")? $padding_bottom : $padding_bottom.'px';
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	$is_dark = ('true' == $dark) ? ' dark ' : '';
	$section_id = (!empty($id))? 'id="'.$id.'"' : '';
	$color_overlay = 'background-color:' . $row_color;
	$speed = ($speed > 1)? $speed/10 : $speed;
	$out = '</div></section><section '.$section_id.' class="parallax-sec '.$is_dark.' blox ' . $class .' '.$row_pattern . '" style="' . $padding_style . $background_style . $background_size . $height_style . '" data-stellar-background-ratio="'.$speed. '"><div class="max-overlay" style="'.  $color_overlay .'"></div><div data-stellar-ratio="1" class="wpb_row vc_row-fluid "><div class="container">';
	$out .= do_shortcode($content);
	$out .= '</div></div></section><section class="container"><div class="row-wrapper-x">';
	return $out;
}
add_shortcode('parallax', 'webnus_parallax');
?>