<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard-layout' ); ?> data-post-id="<?php the_ID(); ?>">
	<?php wolf_post_start(); ?>

	<div class="entry-content wrap">
		<?php echo wolf_post_media(); ?>
		<?php wolf_secondary_meta(); ?>
		<div class="entry-meta">
			<?php wolf_post_entry_meta(); ?>
			<?php wolf_icon_meta(); ?>
		</div>
		<?php echo wolf_no_video_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- entry-content -->

	<?php wolf_post_end(); ?>
	<?php wolf_post_nav(); ?>

	<?php
	if ( wolf_get_theme_option( 'video_comments' ) )
		comments_template();
	?>

</article><!-- article.post -->