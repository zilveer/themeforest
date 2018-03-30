<?php

$videohost = get_post_meta($post->ID,'epic_video_host',true);
$image = get_post_meta($post->ID,'epic_video_preview',true);
$m4v = get_post_meta($post->ID,'epic_video_url_m4v',true);
$ogv = get_post_meta($post->ID,'epic_video_url_ogv',true);
$webmv = get_post_meta($post->ID,'epic_video_url_webmv',true);
$video_id_vimeo = get_post_meta($post->ID,'epic_video_id_vimeo',true);
$video_id_youtube = get_post_meta($post->ID,'epic_video_id_youtube',true);



if($videohost == 'youtube'){$id = $video_id_youtube;}
if($videohost == 'vimeo'){ $id = $video_id_vimeo;}


$atts ='';
echo epic_video(
				array(
				'type' 		=> $videohost,
				'poster' 	=> $image,
				'm4v' 		=> $m4v,
				'ogv' 		=> $ogv,
				'webmv' 	=> $webmv,
				'id' 		=> $id,
								 
				), $atts);

?>