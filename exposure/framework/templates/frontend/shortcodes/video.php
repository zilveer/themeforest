<?php

$code = '';

/**
 * The video ID
 */
$id = 'thb_video_' . THB_Shortcode::$instance_number;

/**
 * Video code
 */
$video_code = thb_get_video_code($url);

/**
 * Video ratio
 */
$ratio = empty($ratio) ? '16/9' : $ratio;

/**
 * Video class
 */
$class = !empty($class) ? $class : '';

/**
 * Video width and height
 */
if( isset($width) && isset($height) ) {
	$class .= ' thb-noFit';
}
else {
	list( $width, $height ) = explode('/', $ratio);
}

$data = array(
	'ratio'        => $ratio,
	'fixed_height' => $fixed_height,
	'fixed_width'  => $fixed_width
);

$attributes = array(
	'class'                 => $class . ' thb_video',
	'id'                    => $id,
	'frameborder'           => '0',
	'webkitallowfullscreen' => '',
	'mozallowfullscreen'    => '',
	'allowfullscreen'       => '',
	'width'					=> $width,
	'height'				=> $height
);

/**
 * YouTube
 */
if( thb_video_is_youtube($url) ) {
	$data['type'] = 'youtube';

	$src_querystring = array(
		'wmode'          => 'transparent',
		'enablejsapi'    => '1',
		'modestbranding' => '1',
		'showinfo'       => '0'
	);
	if( $controls == '0' ) {
		$src_querystring['controls'] = '0';
	}
	if( $autoplay == '1' ) { $src_querystring['autoplay'] = '1'; }
	if( $loop == '1' ) { $src_querystring['loop'] = '1'; }

	$src_querystring = thb_get_querystring($src_querystring);

	$attributes['src'] = 'http://www.youtube.com/embed/' . $video_code . '?' . $src_querystring;

	$attributes = thb_get_attributes($attributes);
	$data = thb_get_data_attributes($data);

	$code = "<iframe $attributes $data></iframe>";
}
/**
 * Vimeo
 */
elseif( thb_video_is_vimeo($url) ) {
	$data['type'] = 'vimeo';

	$src_querystring = array(
		'title'     => '0',
		'byline'    => '0',
		'portrait'  => '0',
		'api'       => '1',
		'player_id' => $id,
		'color'		=> 'ffffff',
		'loop'		=> $loop,
		'autoplay'	=> $autoplay
	);
	if( $autoplay == '1' ) { $src_querystring['autoplay'] = '1'; }

	$src_querystring = thb_get_querystring($src_querystring);

	$attributes['src'] = 'http://player.vimeo.com/video/' . $video_code . '?' . $src_querystring;

	$attributes = thb_get_attributes($attributes);
	$data = thb_get_data_attributes($data);

	$code = "<iframe $attributes $data></iframe>";
}
/**
 * Self hosted
 */
else {
	$attrs = array(
		// 'src'     => $url,
		'width'    => '100%',
		'height'   => '100%',
		'preload'  => 'metadata',
		'class'    => $class . " mejs-thb thb_video_selfhosted thb_video_controls_{$controls}",
		'id'       => $id
	);

	if( $controls == '1' ) { $attrs['controls'] = '1'; }
	if( $autoplay == '1' ) { $attrs['autoplay'] = '1'; }
	if( $loop == '1' ) { $attrs['loop'] = '1'; }

	$attributes = thb_get_attributes($attrs);

	$code = "<video $attributes>";
		$code .= "<source type='video/mp4' src='$url' />";
		$code .= "<object type='application/x-shockwave-flash' data='flashmediaelement.swf'>";
			$code .= "<param name='allowFullScreen' value='true'></param>";
			$code .= "<param name='movie' value='flashmediaelement.swf' />";
			$code .= "<param name='flashvars' value='controls=true&file=$url' />";
			// $code .= "<img src='myvideo.jpg' title='No video playback capabilities' />";
		$code .= "</object>";
	$code .= "</video>";
}

echo $code;