<div class="st-format-gallery-holder">

	<?php if ( !defined( 'ABSPATH' ) ) exit;
	/*
	
		Post format: Gallery
	
	*/
	
	
	/*===============================================
	
		G A L L E R Y
		With different sizes dipends of some reasons
	
	===============================================*/

		if ( empty( $st_Settings['shortcodes'] ) || isset( $st_Settings['shortcodes'] ) && $st_Settings['shortcodes'] != 'no' ) {

			$st_['ids'] = st_get_post_meta( $post->ID, 'gallery_value', true, '' );
	
			if ( $st_['ids'] ) {
				echo do_shortcode( '[st-gallery ids="' . $st_['ids'] . '"]' ); }

		}


	?>

</div>