<?php

function brideorgroom_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'gender' => 'bride',
	'type'  => 'rose',
	'img'=>'',
	'name' => '',
	'color' =>'',
	'text'=>'',
	'link_text'	=>'',
	'link_url'	=>'',
	'first_social'=>'twitter',
	'first_url'=>'',
	'second_social'=>'facebook',
	'second_url'=>'',
	'third_social'=>'google-plus',
	'third_url'=>'',
	'fourth_social'=>'linkedin',
	'fourth_url'=>'',
	), $atts));
	
	if(is_numeric($img)){
		$img = wp_get_attachment_url( $img );
	}
	
	$out = '<article class="brideorgroom-'.$type.' w-'.$gender.'">';
	if($type=="jasmine")
		$out .= '<div class="w-overlay"><div class="w-icon"></div><p><span>' . $name . '</span><br>[The '.$gender.']</p></div>';
	$out .= '<div class="w-content">';
	$out .= '<div class="w-figure"><img src="'. $img .'" alt="">';
	if($type=="rose")
		$out .= '<div class="w-frame"></div>';
	$out .= '</div><h2>'. $name .'</h2>';
	$out .= '<p>'. $text .'</p>';
	$out .= '<div class="social-team">';
	$out .= (!empty($first_url)) ? '<a href="'. $first_url .'"><i class="fa-'. $first_social .'"></i></a>' : '' ;
	$out .= (!empty($second_url)) ? '<a href="'. $second_url .'"><i class="fa-'. $second_social .'"></i></a>' : '' ;
	$out .= (!empty($third_url)) ? '<a href="'. $third_url .'"><i class="fa-'. $third_social .'"></i></a>' : '' ;
	$out .= (!empty($fourth_url)) ? '<a href="'. $fourth_url .'"><i class="fa-'. $fourth_social .'"></i></a>' : '' ;
	$out .= '</div>';
	$out .= (!empty($link_url)) ? '<a href="' . $link_url . '" class="link-text w-button">' . $link_text . '</a>' : '';
	$out .= '</div>';
	$out .= '</article>';

return $out;
}
add_shortcode('brideorgroom','brideorgroom_shortcode');


?>