<?php 

global $post;

$attachments = get_post_meta( $post->ID, '_ebor_gallery_list', true );
$count = count($attachments);

if ( $attachments ){
	foreach( $attachments as $attachment ){
		echo '<img class="lazyOwl" src="'. esc_url($attachment) .'" alt="'. $post->title .'">';
	}	
}