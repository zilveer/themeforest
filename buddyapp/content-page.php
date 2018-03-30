<?php
/**
 * The default template for displaying content
 *
 * Used for single posts display
 *
 * @package WordPress
 * @subpackage Next
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_archive() && ! is_post_type_archive() ) : ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyapp' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php // edit_post_link( esc_html__( 'Edit', 'buddyapp' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
