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

$video_type = get_field('mpc_video_type');
$video_mp4_file = get_field('mpc_video_mp4_file');
$video_ogg_file = get_field('mpc_video_ogg_file');
$video_embed_src = get_field('mpc_video_embed_src');

if ($video_type == 'upload') {
	echo '<div class="mpcth-video-wrap mpcth-video-shortcode">';
		$mp4 = isset($video_mp4_file['url']) ? ' mp4="' . $video_mp4_file['url'] . '"' : '';
		$ogg = isset($video_ogg_file['url']) ? ' ogv="' . $video_ogg_file['url'] . '"' : '';
		echo do_shortcode('[video' . $mp4 . $ogg . ']');
	echo '</div>';
} elseif ($video_type == 'embed') {
	echo '<div class="mpcth-video-wrap mpcth-video-embed">';
		echo $video_embed_src;
	echo '</div>';
}