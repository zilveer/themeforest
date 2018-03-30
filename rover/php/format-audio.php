<?php 
/**
 * Audio Content
 * @package by Theme Record
 * @auther: MattMao
 */

function theme_content_audio() 
{
	#Get meta
	$ogg = get_meta_option('audio_ogg');
	$mp3 = get_meta_option('audio_mp3');

	if($ogg || $mp3)
	{
		echo '<div class="entry-audio">'."\n";

		echo '<audio class="audio-inner AudioPlayerV1" data-fallback="'.ASSETS_URI.'/flash/audio-player.swf">'."\n";
		if($mp3) { echo '<source type="audio/mpeg" src="'.$mp3.'" />'."\n"; }
		if($ogg) { echo '<source type="audio/ogg" src="'.$ogg.'" />'."\n"; }
		echo '</audio>'."\n";

		echo '</div>'."\n";
	}
}
?>