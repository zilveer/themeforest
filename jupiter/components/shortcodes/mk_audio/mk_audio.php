<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();
$id = $id + get_the_ID();

//$output = $has_image = '';
//$audio_id = uniqid();
$player = pq('.mk-audio-section');
$player->attr('id', 'mk-audio-section-'.$id);
$player->addClass($large_player_class);
$player->addClass($el_class);

if ( $thumb && $remove_thumb == 'false') {
	$image_src = Mk_Image_Resize::resize_by_url($thumb, $img_dimension, $img_dimension, $crop = true, $dummy = true);
	$player->find('.audio-thumb')
		->attr('src', $image_src)
		->attr('alt', $audio_author)
		->attr('width', $img_dimension)
		->attr('height', $img_dimension)
		->attr('title', $audio_author);
	$player->find('.jp-audio')
		->addClass('audio-has-img');
}else {
	$player->find('.audio-thumb')
		->remove();
}

$player->find('.jp-jplayer')
	->attr('id', 'jquery_jplayer_'.$id );
if($mp3_file != '') {
	$player->find('.jp-jplayer')
		->attr('data-mp3', $mp3_file);
}
if($ogg_file != '') {
	$player->find('.jp-jplayer')
		->attr('data-ogg', $ogg_file);
}
$player->find('.jp-audio')
	->attr('id', 'jp_container_'.$id );
if( $audio_author != '' )	{
	$player->find('.mk-audio-author')
		->html($audio_author);
}else {
	$player->find('.mk-audio-author')
		->remove();
}

if( $player_background == '') {
	$audio_box_color  = array( '#00c8d7', '#e1ba05', '#da4c26', '#f56a5f', '#00b89a', '#95c76a', '#acacac', '#d19760' );
	$random_colors = array_rand( $audio_box_color, 1 );
	$player_color = $audio_box_color[$random_colors];
}else {
	$player_color = $player_background;
}

$player->find('.jp-volume-bar')->append(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-moon-volume-mute'));
$player->find('.jp-play')->append(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-play'));
$player->find('.jp-pause')->append(Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-pause'));

/**
 * Custom CSS Output
 * ==================================================================================
 */
$app_styles = '
	#mk-audio-section-'.$id.' {
		background-color: '.$player_color.';
	}
';

 Mk_Static_Files::addCSS($app_styles, $id);



print $html;
