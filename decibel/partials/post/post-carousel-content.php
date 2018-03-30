<?php
/**
 * The Last posts carousel shortcode
 */
$format = get_post_format() ? get_post_format() : 'standard';
$thumb_size = wolf_get_image_size( 'classic-thumb' );
?>
<article <?php post_class( 'clearfix' ); ?>  id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
	<div class="entry-thumbnail">
		<?php the_post_thumbnail( $thumb_size ); ?>
	</div>
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
