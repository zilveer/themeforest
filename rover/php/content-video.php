<?php
/**
 * Video
 * @package by Theme Record
 * @auther: MattMao
*/
if ( !function_exists( 'theme_post_video' ) )
{
	function theme_post_video($type) 
	{
		$embed_player = get_meta_option('embed_player');
		$video_id = get_meta_option('video_embed_id');
		$video_ogv = get_meta_option('video_ogv');
		$video_mp4 = get_meta_option('video_mp4');
		$video_webm = get_meta_option('video_webm');
		$video_poster_image = get_meta_option('video_poster_image');
		$video_height = get_meta_option('video_height');
		

		//Type
		if($type == 'portfolio')
		{
			$video_width = 940;
		}
		elseif($type == 'blog')
		{
			$video_width = 460;
		}

		if($video_height == '') { $video_height = $video_width * 9/16; }

		echo '<div class="post-entry-video">'."\n";
		if($embed_player == 'youtube')
		{
			if($video_id) { echo '<iframe class="video" width="'.$video_width.'" height="'.$video_height.'" src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>'."\n"; }
		}
		elseif($embed_player == 'vimeo')
		{
			if($video_id) { echo '<iframe class="video" src="http://player.vimeo.com/video/'.$video_id.'" width="'.$video_width.'" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'."\n"; }
		}
		elseif($embed_player == 'self-hosted')
		{
			if($video_ogv || $video_mp4 || $video_webm)
			{
				echo '<video class="video-js vjs-default-skin" poster="'.$video_poster_image.'" data-aspect-ratio="1.78" data-setup="{}" controls>'."\n";
				if($video_mp4) { echo '<source src="'.$video_mp4.'" type="video/mp4" />'."\n"; }
				if($video_webm) { echo '<source src="'.$video_webm.'" type="video/webm" />'."\n"; }
				if($video_ogv) { echo '<source src="'.$video_ogv.'" type="video/ogg" />'."\n"; }
				echo '</video>';
			}
		}
		echo '</div>'."\n";		
	}
}

?>