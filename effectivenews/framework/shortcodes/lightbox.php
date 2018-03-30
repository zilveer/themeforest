<?php 
function mom_lightbox($atts, $content = null) {
	extract(shortcode_atts(array(
	'thumb' => '',
	'type' => '',
	'link' => '',
	), $atts));
	if ($link == '') {
		$link = $thumb;
	}
	
	$overlay = '';
	if ($type == 'video') {
		$overlay ='<span class="plus_overlay"><i class="plus_ov_video"></i></span>';
	} else {
		$overlay ='<span class="plus_overlay"><i></i></span>';
	}

	wp_enqueue_script('prettyPhoto');
	return '<div class="mom_lightbox"><a href="'.$link.'"><img src="'.$thumb.'" alt="">'.$overlay.'</a></div>';
}
add_shortcode("lightbox", "mom_lightbox");

?>