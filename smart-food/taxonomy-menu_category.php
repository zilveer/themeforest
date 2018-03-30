<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package smartfood
 */

get_header(); 

?>

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

					<div class="menu-box">
						<div class="menu-box-border">
							<div class="title"><?php echo single_cat_title( '', true ); ?></div>
							<div class="restaurant"><?php echo category_description(); ?></div>
						</div>
					</div>

					<?php while ( have_posts() ) : the_post(); ?>

						<div <?php tdp_attr( 'entry-content' ); ?>>
							
						<?php

							do_action( 'wprm_menu_content_start' );

							get_template_part( 'templates/wprm/single', 'item' );

							do_action( 'wprm_menu_content_end' );

						?>

						</div><!-- .entry-content -->

					<?php endwhile; ?>

				<?php else : ?>
					asd
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
