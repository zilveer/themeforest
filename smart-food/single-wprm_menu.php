<?php
/**
 * The template for displaying all single posts.
 *
 * @package smartfood
 */

get_header(); ?>

<section id="page-content" <?php tdp_attr( 'content' ); ?>>

	<div class="container">
		<div class="row clearfix">

			<?php if(tdp_option('food_menu_page_layout') == 'sidebar_left') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    <?php dynamic_sidebar( 'food_sidebar' ); ?>
                </div>

            <?php endif; ?>

			<section id="blog-posts" class="<?php echo tdp_get_blog_layout_class();?>">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<div <?php tdp_attr( 'entry-content' ); ?>>
							
						<?php the_content();?>

						</div><!-- .entry-content -->

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</section><!-- .entry -->

			<?php if(tdp_option('food_menu_page_layout') == 'sidebar_right') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    <?php dynamic_sidebar( 'food_sidebar' ); ?>
                </div>

            <?php endif; ?>

		</div>
	</div> <!-- end container -->
</section> <!-- end page content -->

<?php get_footer(); ?>