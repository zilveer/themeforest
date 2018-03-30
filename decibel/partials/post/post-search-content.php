<?php
/**
 * The search results
 *
 */
$obj = get_post_type_object( get_post_type() );
$post_type_name = ( is_object( $obj ) ) ? $obj->labels->singular_name : '';
$post_type_name = ( $post_type_name ) ? " ($post_type_name)" : '';
?>
<article <?php post_class( 'clearfix wrap small-width' ); ?>  id="post-<?php the_ID(); ?>">
	<div class="entry-summary">
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" class="entry-link">
			<?php the_title(); ?><?php echo sanitize_text_field( $post_type_name ); ?></a>
		</h3>
		<div class="entry-meta">
			<?php wolf_post_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<?php wolf_excerpt(); ?>
	</div>
</article>
