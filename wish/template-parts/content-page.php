<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Wish
 */
?>



	<div class="wish-content animated" data-animation="fadeInUp" data-animation-delay="300">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wish' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'wish' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

