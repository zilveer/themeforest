<?php 

	global $post;
	
	$i=0; 
	while( $i < 5 ){
		$i++;
		
		if ( get_post_meta( $post->ID, "_ebor_the_video_$i", true ) ) 
			echo apply_filters('the_content', get_post_meta( $post->ID, "_ebor_the_video_$i", true ));
		
	}