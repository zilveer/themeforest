<?php
function weddingteam_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'type'  => 'rose',
	'img'=>'',
	'name' => '',
	'title' =>'',
	'text'=>'',
	'mirror'=>'',
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
	$desc = (!empty($text))? '<p>'. $text .'</p>' : '';
	$out = '<div class="wedding-team-'.$type.$mirror.'">';
	$out .= '<img class="team-img" src="'. $img .'" alt="">';
	if($type=='rose')
	$out .= '<div class="w-frame"></div>';
	$out .= '<div class="team-cap"><h3>'. $name .'</h3>';
	$out .= '<h4>'. $title .'</h4>'.$desc.'</div>';
	$out .= '<div class="social-team">';
	$out .= (!empty($first_url)) ? '<a href="'. $first_url .'"><i class="fa-'. $first_social .'"></i></a>' : '' ;
	$out .= (!empty($second_url)) ? '<a href="'. $second_url .'"><i class="fa-'. $second_social .'"></i></a>' : '' ;
	$out .= (!empty($third_url)) ? '<a href="'. $third_url .'"><i class="fa-'. $third_social .'"></i></a>' : '' ;
	$out .= (!empty($fourth_url)) ? '<a href="'. $fourth_url .'"><i class="fa-'. $fourth_social .'"></i></a>' : '' ;
	$out .= '</div></div>';

return $out;
}
add_shortcode('weddingteam','weddingteam_shortcode');

?>