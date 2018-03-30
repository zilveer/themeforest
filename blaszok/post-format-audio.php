<?php
/**
 * The Standard post header base for MPC Themes
 *
 * Displays the thumbnail for posts in the Standard post format.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

$audio_type = get_field('mpc_audio_type');
$audio_mp3_file = get_field('mpc_audio_mp3_file');
$audio_ogg_file = get_field('mpc_audio_ogg_file');
$audio_embed_src = get_field('mpc_audio_embed_src');

if ($audio_type == 'upload') {
	echo '<div class="mpcth-audio-wrap mpcth-audio-shortcode">';
		$mp3 = isset($audio_mp3_file['url']) ? ' mp3="' . $audio_mp3_file['url'] . '"' : '';
		$ogg = isset($audio_ogg_file['url']) ? ' ogg="' . $audio_ogg_file['url'] . '"' : '';
		echo do_shortcode('[audio' . $mp3 . $ogg . ']');
	echo '</div>';
} elseif ($audio_type == 'embed') {
	echo '<div class="mpcth-audio-wrap mpcth-audio-embed">';
		echo $audio_embed_src;
	echo '</div>';
}