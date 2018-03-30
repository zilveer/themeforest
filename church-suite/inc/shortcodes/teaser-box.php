<?php
function webnus_teaserbox ($atts, $content = null) {
 	extract(shortcode_atts(array(
		'type'		=>	'1',
		'img'		=>	'',
		'title'		=>	'',
		'subtitle'	=>	'',
		'link_url'	=>	'#',
		'img_alt'	=>	'',
		'target'	=>	'',
	), $atts));
	if(is_numeric($img))
		$img = wp_get_attachment_url( $img );
	$out = '';
	$out .= '<div class="teaser-box'.$type.'">';
	$has_image = $teaser_image = '';
	if ((($type==4)OR($type==5))&&(empty($subtitle))){
		$subtitle = $title;
	}
	if (($type==6)&&(empty($subtitle))){
		$subtitle = esc_html__('understand more','webnus_framework');
	}
	if($img){
		$has_image = 'has-image';
		$teaser_image ='<img class="teaser-image " src="'. $img .'" alt="' . $img_alt . '">';
	}
	$blank = ($target=='blank')?'target="_blank" ':'';
	$out .= '<a '.$blank.'href="'.$link_url.'">'.$teaser_image;
	$out .= '<h4 class="teaser-title '.$has_image.'">'.$title.'</h4>';
	if (!empty($subtitle))
		$out .= '<h5 class="teaser-subtitle">'.$subtitle.'</h5>';
	$out .= '</a></div>';
	return $out;
}
 add_shortcode('teaserbox','webnus_teaserbox');
?>