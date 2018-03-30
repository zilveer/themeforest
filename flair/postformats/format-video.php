<?php 

for( $i = 0; $i < 5; $i++ ){
	if ( get_post_meta( $post->ID, "_ebor_the_video_$i", true ) ){
		if (strpos( get_post_meta( $post->ID, "_ebor_the_video_$i", true ),'soundcloud') !== false) {
			echo str_replace( array('visual=true', 'height="400"'), array('','height="166" class="soundcloud"'), wp_oembed_get( esc_url( get_post_meta( $post->ID, "_ebor_the_video_$i", true ) ) ) );
		} else {
			echo '<div class="vendor">' . wp_oembed_get( esc_url( get_post_meta( $post->ID, "_ebor_the_video_$i", true ) ) ) . '</div>';	
		}
	}
}