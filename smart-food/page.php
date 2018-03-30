<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package smartfood
 */

get_header(); ?>

<section id="page-content" <?php tdp_attr( 'content' ); ?>>
	<div class="container">
		<div class="row clearfix">

			<?php if(get_field('page_layout') == 'Sidebar Left') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    
                    <?php dynamic_sidebar( 'Page Sidebar' ); ?>

                </div>

            <?php endif; ?>

			<article <?php tdp_attr( 'post' ); ?>>

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<div <?php tdp_attr( 'entry-content' ); ?>>
							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'templates/pages/content', 'page' );
							?>

							<?php if ( is_singular() && !tdp_option('disable_comments') ) : // If viewing a single post/page/CPT. ?>

								<?php comments_template( '', true ); // Loads the comments.php template. ?>

							<?php endif; // End check for single post. ?>
							
						</div><!-- .entry-content -->

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</article><!-- .entry -->

			<?php if(get_field('page_layout') == 'Sidebar Right') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    
                    <?php dynamic_sidebar( 'Page Sidebar' ); ?>

                </div>

            <?php endif; ?>

		</div>
	</div> <!-- end container -->
</section> <!-- end page content -->

<?php get_footer(); ?>