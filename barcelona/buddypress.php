<?php

get_header();

?>
<div class="<?php echo esc_attr( barcelona_single_class() ); ?>">

	<div class="<?php echo esc_attr( barcelona_row_class() ); ?>">

		<main id="main" class="<?php echo esc_attr( barcelona_main_class() ); ?>">

			<?php if ( have_posts() ): while( have_posts() ): the_post(); ?>

				<article id="post-<?php echo intval( get_the_ID() ); ?>" <?php post_class(); ?> role="article">

					<section class="barcelona-buddypress">
						<?php the_content(); ?>
					</section><!-- .post-content -->

				</article>

			<?php endwhile; endif; ?>

		</main>

		<?php get_sidebar(); ?>

	</div><!-- .row -->

</div><!-- .container -->
<?php

get_footer();