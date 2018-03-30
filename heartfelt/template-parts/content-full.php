<?php
/**
 * The template used for displaying full width page content in template-full.php
 *
 */
?>

<div class="post_wrap clearfix">

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

	<div class="full_featured_image">

		<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'full-width-thumbnails' );
			}
		?>

	</div><!-- .full_featured_image -->

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

	<footer class="entry-footer clearfix">

		<?php 
			edit_post_link( __( 'Edit', 'heartfelt' ), '<span class="edit-link">', '</span>' ); 
		?>

	</footer><!-- .entry-footer -->

</div><!-- .post_wrap -->