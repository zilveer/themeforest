<?php
function gen_height($width) {
	$height = intval($width * 9 / 16);
	return $height;
	}
	
function gen_width($height) {
	$width = intval($height * 16 / 9);
	return $width;
	}
	
/*Flash Video ShortCode*/
function gen_flash_video($atts) {
	extract(shortcode_atts(array(
		'src' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'play'			=> 'false',
		'flashvars' => '',
	), $atts));
	
	if (!$width) $width = MAX_CONTENT_WIDTH;
	if (!$height && $width) $height=gen_height($width);
	if (!$width && $height) $width=gen_width($height);

	$uri = MTHEME_PATH;
	if (!empty($src)){
		return <<<HTML
<div class="video_frame">
<object width="{$width}" height="{$height}" type="application/x-shockwave-flash" data="{$src}">
	<param name="movie" value="{$src}" />
	<param name="allowFullScreen" value="true" />
	<param name="allowscriptaccess" value="always" />
	<param name="expressInstaller" value="{$uri}/swf/expressInstall.swf"/>
	<param name="play" value="{$play}"/>
	<param name="wmode" value="opaque" />
	<embed src="$src" type="application/x-shockwave-flash" wmode="opaque" allowscriptaccess="always" allowfullscreen="true" width="{$width}" height="{$height}" />
</object>
</div>
HTML;
	}
}
add_shortcode( 'flash_video', 'gen_flash_video' );

/*Youtube Video ShortCode*/
function gen_youtube_video( $atts ) {
   extract( shortcode_atts( array(
		'id' => null,
		'width' 	=> false,
		'height' 	=> false,
		'rel' => null,
		'ytlogo' => null,
		'theme' => null,
		'info' => null,
		'hd' => '1',
		'playlist' => null,
		'time' => '0',
		'border' => '0',
      ), $atts ) );
	  
	if (!$width) $width = MAX_CONTENT_WIDTH;
	if (!$height && $width) $height=gen_height($width);
	if (!$width && $height) $width=gen_width($height);
 
   return '<iframe class="youtube-player" type="text/html" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="http://www.youtube.com/embed/' . esc_attr($id) . '/?wmode=transparent&amp;hd='. esc_attr($hd) . '&amp;theme=' . esc_attr($theme) . '&amp;autohide=1&amp;rel=' . esc_attr($rel) . '&amp;showinfo=' . esc_attr($info) . 'playlist=' . esc_attr($playlist) . '&amp;start=' . esc_attr($time) . '" frameborder="' . esc_attr($border) . '" ></iframe>';
}
add_shortcode( 'youtube_video', 'gen_youtube_video' );

/*Google Video ShortCote*/
function gen_google_video( $atts ) {
   extract( shortcode_atts( array(
		'id' => null,
		'width' 	=> false,
		'height' 	=> false,
      ), $atts ) );
	  
	if (!$width) $width = MAX_CONTENT_WIDTH;
	if (!$height && $width) $height=gen_height($width);
	if (!$width && $height) $width=gen_width($height);
 
   return '<embed id=VideoPlayback src=http://video.google.com/googleplayer.swf?docid=' . esc_attr($id) . '&amp;hl=en&amp;fs=true style=width:' . esc_attr($width) . 'px;height:' . esc_attr($height) . 'px allowFullScreen=true allowScriptAccess=always type=application/x-shockwave-flash> </embed>';
}
add_shortcode( 'google_video', 'gen_google_video' );

/*Vimeo Video Shortcode*/
function gen_vimeo_video( $atts ) {
   extract( shortcode_atts( array(
		'id' => null,
		'width' => false,
		'height' => false,
		'title' => '0',
		'byline' => '0',
		'portrait' => '0',
		'border' => '0',
      ), $atts ) );
	  
	if (!$width) $width = MAX_CONTENT_WIDTH;
	if (!$height && $width) $height=gen_height($width);
	if (!$width && $height) $width=gen_width($height);
 
   return '<iframe src="http://player.vimeo.com/video/' . esc_attr($id) . '?title=' . esc_attr($title) . '&amp;byline=' . esc_attr($byline) . '&amp;portrait=' . esc_attr($portrait) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" frameborder="' . esc_attr($border) . '"></iframe>';
}
add_shortcode( 'vimeo_video', 'gen_vimeo_video' );

/*DailyMotion Video ShortCode*/
function gen_dailymotion_video( $atts ) {
   extract( shortcode_atts( array(
      'id' => null,
      'border' => '0',
		'width' 	=> false,
		'height' 	=> false,
      ), $atts ) );
	  
	if (!$width) $width = MAX_CONTENT_WIDTH;
	if (!$height && $width) $height=gen_height($width);
	if (!$width && $height) $width=gen_width($height);
 
   return '<iframe frameborder="' . esc_attr($border) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="http://www.dailymotion.com/embed/video/' . esc_attr($id) . '"></iframe>';
}
add_shortcode( 'dailymotion_video', 'gen_dailymotion_video' );

/*Facebook Video ShortCode*/
function gen_facebook_video( $atts ) {
   extract( shortcode_atts( array(
      'id' => null,
		'width' 	=> false,
		'height' 	=> false,
      ), $atts ) );
	  
	if (!$width) $width = MAX_CONTENT_WIDTH;
	if (!$height && $width) $height=gen_height($width);
	if (!$width && $height) $width=gen_width($height);
 
   return '<object width="' . esc_attr($width) . '" height="' . esc_attr($height) . '"><param name="movie" value="http://www.facebook.com/v/' . esc_attr($id) . '"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.facebook.com/v/' . esc_attr($id) . '" type="application/x-shockwave-flash" allowfullscreen="true" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '"></embed></object>';
}
add_shortcode( 'facebook_video', 'gen_facebook_video' );
?>
