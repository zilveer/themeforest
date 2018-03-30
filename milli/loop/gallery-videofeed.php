<?php 

	/**
	 * If attachments exist, decalare post and get ready to process attachments
	 */
	global $post;
	
	$videos = get_post_meta( $post->ID, '_ebor_video_gallery_url', true);
	$titles = get_post_meta( $post->ID, '_ebor_video_gallery_title', true);
	$descriptions = get_post_meta( $post->ID, '_ebor_video_gallery_description', true);
		
	foreach( $videos as $key => $video ) {
	
		$video = esc_url( $video );
		echo apply_filters('the_content', $video);
		
		if( isset($titles[$key]) )
			echo '<h2 class="article-title">'. strip_tags( $titles[$key] ) .'</h2>';
		
		if( isset($descriptions[$key]) )
			echo wpautop( $descriptions[$key] );
		
		if( isset($titles[$key]) || isset($descriptions[$key]) )
			echo '<div class="break-30"></div>';
		
	}