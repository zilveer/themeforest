<?php
/**
 * The Last posts columns shortcode
 */
$format = get_post_format() ? get_post_format() : 'standard';
$thumb_size = wolf_get_image_size( 'classic-thumb' );
?>
<article <?php post_class( 'clearfix' ); ?>  id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
	<?php if ( 'gallery' == $format ) : ?>
		<div class="entry-slider">
			<?php echo wolf_post_gallery_slider( $thumb_size ); ?>
		</div>
	<?php else : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" class="entry-link"><?php the_post_thumbnail( $thumb_size ); ?></a>
		</div>
	<?php endif; ?>
	<h3 class="entry-title">
		<?php wolf_entry_title( true, false, true ); ?>
	</h3>
	<div class="entry-meta">
		<?php wolf_post_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<?php wolf_excerpt(); ?>
	<footer class="entry-meta icon-meta-container">
		<?php wolf_icon_meta(); ?>
	</footer>
</article>
