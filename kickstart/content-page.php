<?php
/**
 * The template used for displaying page content.
 *
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
	
		<?php the_content(); ?>
		
		<?php 
			if ( function_exists('wp_pagenavi')) {
				wp_pagenavi( array( 'type' => 'multipart' ) );
			} else {
				wp_link_pages();
			} 
		?>

		<div class="clear"></div>
	</div><!-- .entry-content -->
</div><!-- #post-->
