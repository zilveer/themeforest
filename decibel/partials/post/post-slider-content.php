<?php
/**
 * The Last posts slider shortcode
 */
?>
<li id="post-<?php the_ID(); ?>" <?php post_class( array( 'slide' ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php the_post_thumbnail( wolf_get_image_size( 'classic-thumb' ) ); ?>
	<span class="slide-inner">
		<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<div class="entry-meta">
			<?php wolf_post_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<?php wolf_excerpt(); ?>
		<footer class="entry-meta icon-meta-container">
			<?php wolf_icon_meta(); ?>
		</footer>
	</span>
</li>
