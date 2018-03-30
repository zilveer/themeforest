<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package humbleshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links pagination">' . __( 'Pages:', 'humbleshop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content clearfix -->
	<?php edit_post_link( __( 'Edit', 'humbleshop' ), '<p class="entry-meta text-center"><span class="edit-link"><small><i class="fa fa-pencil"></i> ', '</small></span></p>' ); ?>
</article><!-- #post-## -->
