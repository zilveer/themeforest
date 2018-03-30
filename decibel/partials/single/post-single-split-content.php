<?php
/**
 * Splitted post content
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'split' ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php wolf_post_start(); ?>

	<div class="panel-left">
		<?php echo wolf_post_media(); ?>
		<?php wolf_entry_media(); ?>
	</div><!-- .panel-left -->

	<div class="panel-right">
		<div class="entry-content">
			<?php wolf_secondary_meta(); ?>
			<?php echo wolf_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			<p class="text-center">
				<?php wolf_icon_meta() ?>
			</p><!-- p.text-center -->

		</div><!-- entry-content -->
	</div><!-- .panel-right -->

	<div class="clear"></div>
	<?php wolf_post_end(); ?>
	<?php comments_template(); ?>

</article><!-- article.post -->
