<?php
/**
 * The template for displaying posts in the Image post format
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-section'); ?>>
	<?php truethemes_post_thumbnail(); ?>
		<?php
			// Let's check if this image post has any content - if so, display it.
			$pc = get_the_content();
			if(!empty($pc)) {
		?>
		<div class="entry-content tt-image-post">
		<?php 
			the_content();
		?>
		</div><!-- .entry-content -->
		<?php } // end check for post content ?>
</article><!-- .masonry-section -->