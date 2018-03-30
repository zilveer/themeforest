<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


// Show Simple Thumbnail or Gallery
if ( ! get_data( 'blog_single_thumbnails' ) ) {
	return;
}

// Enqueue Nivo
wp_enqueue_script( 'nivo-lightbox' );
wp_enqueue_style( 'nivo-lightbox-default' );

?>
<div class="blog-head-holder <?php
	when_match( $featured_image_placing != 'full-width', 'nivo' ); 
?>">
	<?php include locate_template( 'tpls/post-thumbnail.php' ); ?>
</div>