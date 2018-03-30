<?php
/**
 * The template for displaying Author bios.
 */
?>
<div class="author-info clearfix">
	<div class="author-avatar">
		<span class="vcard"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?></span>
		<h5 class="author-name"><?php wolf_the_author(); ?></h5>
	</div><!-- .author-avatar -->
	<p class="author-socials"><?php wolf_display_author_socials(); ?><p>
	<div class="author-description">
		<p>
			<?php the_author_meta( 'description' ); ?>
		</p>
		<?php if ( ! is_author() ) : ?>
			<a class="author-link wolf-button small border-button-accent-hover" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wolf' ), wolf_the_author( false ) ); ?>
			</a>
		<?php endif; ?>
	</div><!-- .author-description -->
</div><!-- .author-info -->