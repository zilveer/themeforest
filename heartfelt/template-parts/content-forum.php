<?php
/**
 * The template used for displaying page content in bbress.php
 *
 */
?>

<div class="post_wrap clearfix">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content clearfix">

			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'heartfelt' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-## -->

</div><!-- .post_wrap -->