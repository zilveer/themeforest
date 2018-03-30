<?php
defined( 'ABSPATH' ) or die;

if ( ! empty( $audio_poster ) ): ?>
	<img class="audio-poster-image" src="<?php echo $audio_poster ?>"/>
<?php endif;

$mp3_attr = '';
$ogg_attr = '';
$m4a_attr = '';
if(!empty($audio_mp3)) {
	$mp3_attr = 'mp3="'.$audio_mp3 .'"';
}
if(!empty($audio_ogg)) {
	$ogg_attr = 'ogg="'.$audio_ogg .'"';
}
if(!empty($audio_m4a)) {
	$m4a_attr = 'ogg="'.$audio_m4a .'"';
}

echo(do_shortcode('[audio '.$mp3_attr.' '.$ogg_attr.' '.$m4a_attr.'][/audio]'));
