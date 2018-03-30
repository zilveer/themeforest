<div class="st-format-video-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Video
	
	*/
	

		$st_['mp4'] = st_get_post_meta( $post->ID, 'mp4_value', true, '' ) ? ' mp4="' . st_get_post_meta( $post->ID, 'mp4_value', true, '' ) . '"' : '';
		$st_['ogv'] = st_get_post_meta( $post->ID, 'ogv_value', true, '' ) ? ' ogv="' . st_get_post_meta( $post->ID, 'ogv_value', true, '' ) . '"' : '';
		$st_['webm'] = st_get_post_meta( $post->ID, 'webm_value', true, '' ) ? ' webm="' . st_get_post_meta( $post->ID, 'webm_value', true, '' ) . '"' : '';
		$st_['video'] = st_get_post_meta( $post->ID, 'video_value', true, '' );


		/*--- Video -----------------------------*/
	
		if ( $st_['video'] ) {
			echo $st_['video']; }

		elseif ( $st_['mp4'] || $st_['ogv'] || $st_['webm'] ) {

			$st_['poster'] = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$st_['poster'] = $st_['poster'] ? ' poster=' . $st_['poster'][0] : '';

			echo do_shortcode('[video' . $st_['mp4'] . $st_['ogv'] . $st_['webm'] . ' preload=none ' . $st_['poster'] . ' width="' . $content_width . '" height="' . ( 9 / 16 * $content_width ) . '"]');

		}

	
	?>

</div>