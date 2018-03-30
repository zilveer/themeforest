<?php
/**
 * The Template for displaying an attachment.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php 
	if ( have_posts() ) {
		while ( have_posts() ) { the_post();
			if ( wp_attachment_is_image() ) {
				echo wp_get_attachment_image( $post->ID, 'full' );
			}
			the_content();
		}
	}
?>