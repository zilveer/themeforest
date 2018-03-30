<?php


//=============================
// Youtube Video Player
//=============================
function newidea_youtube_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'width' => '600',
		  'height' => '360',
		  ), $atts ) );
		  
	$output = '<div class="video-youtube"><iframe title="YouTube Video Player" src="http://www.youtube.com/embed/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0" allowfullscreen></iframe></div>';
		
	return $output;
}
add_shortcode('youtube', 'newidea_youtube_func');

//=============================
// Vimeo Video Player
//=============================
function newidea_vimeo_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'width' => '600',
		  'height' => '360',
		  ), $atts ) );
		  
	$output = '<div class="video-vimeo"><iframe title="Vimeo Video Player" src="http://player.vimeo.com/video/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe></div>';
		
	return $output;
}
add_shortcode('vimeo', 'newidea_vimeo_func');

//=============================
// Soundcloud Audio Player
//=============================
function newidea_soundcloud_func($atts, $content = null){
	extract( shortcode_atts( array(
		  	'url' => '',
			'iframe' => 'true',
			'width' => '100%',
			'height' => 166,
			'auto_play' => 'true',
			'show_comments' => 'true',
			'color' => 'ff7700',
			'theme_color' => 'ff6699',
		  ), $atts ) );
	
	// use iframe
	if($iframe == 'true'){
		$url = 'http://w.soundcloud.com/player?' . http_build_query($atts);
		return '<div class="sound-sl"><iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="'.$url.'"></iframe></div>';
	}else{
	// use flash
		$url = 'http://player.soundcloud.com/player.swf?' . http_build_query($atts);
		return '<div class="sound-sl"><object width="'.$width.'" height="'.$height.'">
                                <param name="movie" value="'.$url.'"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="'.$width.'" height="'.$height.'" src="'.$url.'" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object></div>';
	}
	return '';
}

add_shortcode('soundcloud', 'newidea_soundcloud_func');