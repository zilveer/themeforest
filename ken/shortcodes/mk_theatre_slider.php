<?php

extract( shortcode_atts( array(
			'background_style' => 'desktop_style',
			'max_width' => '900',
			'host' => 'self_hosted',
			'mp4' => '',
			'webm' => '',
			'ogv' => '',
			'poster_image' => '',
			'stream_host_website' => 'youtube',
			'stream_video_id' => '',
			'video_controls' => 'true',
			'autoplay' => 'false',
			'align' => 'left',
			'loop' => 'false',
			'margin_bottom' => '25',
			'el_class' => '',
			'visibility' => '',
			'animation' => ''
		), $atts ) );

$output = $video_output = $option_control = $autoplay_option = $loop_option =  '';

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';

$style_id = Mk_Static_Files::shortcode_id();

/* control options */
/* -------------------------------------------------------------------- */

if($video_controls == 'true'){
	$option_control .= 1;
}else{
	$option_control .= 0;
}

/* autoplay options */
/* -------------------------------------------------------------------- */
($autoplay == 'true') ? $autoplay_option = ($host == 'self_hosted') ? 'autoplay' : 'autoplay=1&amp;' : '' ;


/* video output */
/* -------------------------------------------------------------------- */
if ($host == 'self_hosted'){
	$loop_option = ($loop == 'true') ? 'loop="true"' : '' ;
	$video_output .= '<div class="mk-video-theatre"><video poster="'.$poster_image.'" controls '.$loop_option.'>';
	if ( !empty( $mp4 ) ) {
		$video_output .= '<source type="video/mp4" src="'.$mp4.'" />';
	}
	if ( !empty( $webm ) ) {
		$video_output .= '<source type="video/webm" src="'.$webm.'" />';
	}
	if ( !empty( $ogv ) ) {
		$video_output .= '<source type="video/ogg" src="'.$ogv.'" />';
	}
	$video_output .= '</video></div>';

	$stream_source = $host;

} else {
	if ($stream_host_website == 'youtube'){
		$stream_source = 'youtube';
		$loop_option = ($loop == 'true') ? 'loop=1;playlist='.$stream_video_id.'' : '' ;
		$video_output = '<iframe style="" src="https://www.youtube.com/embed/'.$stream_video_id.'?rel=0;enablejsapi=1;'.$loop_option.'"></iframe>';
	} else if ($stream_host_website == 'vimeo'){
		$stream_source = 'vimeo';
		$loop_option = ($loop == 'true') ? 'loop=1' : '' ;
		$video_output = '<iframe src="//player.vimeo.com/video/'.$stream_video_id.'?badge=0&amp;api=1;'.$loop_option.'" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}
}

/* content */
/* -------------------------------------------------------------------- */


$output .= '<div id="theatre-slider-'.$style_id.'" class="theatre-slider-container '.$visibility.' '.$animation_css.$align.'-align autoplay-'.$autoplay.'" data-source="'.$stream_source.'">';

if($background_style == 'desktop_style'){

	$output .= '<div class="computer-theatre-slider">';
	$output .= '	<img src="'.THEME_DIR_URI.'/images/theatre-desktop.png" title="'.get_the_title().'" alt="'.get_the_title().'" />';
	$output .= '	<div class="player-container"><div class="player">'.$video_output.'</div></div>';
	$output .= '</div>';

	Mk_Static_Files::addCSS('
		#theatre-slider-'.$style_id.' .theatre-slider-container{
			margin-bottom: '.$margin_bottom.'px;
		}
        #theatre-slider-'.$style_id.' .computer-theatre-slider {
            max-width:'.$max_width.'px !important;
        }
	', $style_id);

}else if($background_style == 'laptop_style'){

	$output .= '<div class="laptop-theatre-slider">';
	$output .= '	<img src="'.THEME_DIR_URI.'/images/theatre-laptop.png" title="'.get_the_title().'" alt="'.get_the_title().'" />';
	$output .= '	<div class="player-container"><div class="player">'.$video_output.'</div></div>';
	$output .= '</div>';

	Mk_Static_Files::addCSS('
		#theatre-slider-'.$style_id.'{
			margin-bottom: '.$margin_bottom.'px;
		}
        #theatre-slider-'.$style_id.' .laptop-theatre-slider {
            max-width:'.$max_width.'px !important;
        }
	', $style_id);
}

$output .= '</div>';

echo $output;
