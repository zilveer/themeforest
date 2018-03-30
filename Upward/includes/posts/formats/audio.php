<div class="st-format-audio-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Audio
	
	*/
	

		$st_['mp3'] = st_get_post_meta( $post->ID, 'mp3_value', true, '' ) ? ' mp3="' . st_get_post_meta( $post->ID, 'mp3_value', true, '' ) . '"' : '';
		$st_['ogg'] = st_get_post_meta( $post->ID, 'ogg_value', true, '' ) ? ' ogg="' . st_get_post_meta( $post->ID, 'ogg_value', true, '' ) . '"' : '';
		$st_['audio'] = st_get_post_meta( $post->ID, 'audio_value', true, '' );


		/*--- Audio -----------------------------*/
	
		if ( $st_['audio'] ) {
			echo $st_['audio']; }

		elseif ( $st_['mp3'] || $st_['ogg'] ) {
			echo do_shortcode('[audio' . $st_['mp3'] . $st_['ogg'] . ' preload=none]'); }

	
	?>

</div>