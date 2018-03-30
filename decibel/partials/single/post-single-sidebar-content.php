<?php
/**
 * Post with sidebar content
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-with-sidebar' ); ?> data-post-id="<?php the_ID(); ?>">
	<?php wolf_post_start(); ?>

	<div class="entry-media">
		<?php echo wolf_post_media(); ?>
		<?php wolf_entry_media(); ?>
	</div><!-- .entry-media -->

	<div class="entry-content">
		<?php wolf_secondary_meta(); ?>
		<?php echo wolf_no_media_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- entry-content -->

	<p class="text-center">
		<?php wolf_icon_meta() ?>
	</p><!-- p.text-center -->

	<?php wolf_post_end(); ?>
	<?php comments_template(); ?>
</article><!-- article.post -->
