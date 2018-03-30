<?php
/**
 * The Last posts slider shortcode
 */
$format = get_post_format() ? get_post_format() : 'standard';
?>
<article <?php post_class( 'clearfix' ); ?>  id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
	</div>
	<div class="entry-content">
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" class="entry-link"><?php the_title(); ?></a></h3>
		<div class="entry-meta">
			<?php wolf_post_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<?php wolf_excerpt(); ?>
	</div>
</article>