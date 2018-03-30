<?php
/**
 * Standard post content
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-vc-layout' ); ?> data-post-id="<?php the_ID(); ?>">
	<?php wolf_post_start(); ?>

	<?php the_content(); ?>

	<?php wolf_post_end(); ?>

	<?php comments_template(); ?>

</article><!-- article.post -->
