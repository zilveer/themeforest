<?php
/*
Template Name: Homepage - Video
*/
?>
<?php get_header(); ?>

<?php 
/* #Get Video URL
======================================================*/

$video_url = get_post_meta(get_the_ID(), 'ag_video_url_home', true);	

/* #If Video URL
======================================================*/
if ($video_url != '') : 

global $vendor;

$vendor = parse_url($video_url); 

/* #If Youtube */
	if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ 
 		get_template_part('youtube-home');
	}
	
/* #If Vimeo */
	if ($vendor['host'] == 'vimeo.com'){ 
 		get_template_part('vimeo-home');
	}
?>

<?php  endif;?>
<?php get_footer(); ?>