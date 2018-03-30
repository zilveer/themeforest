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

//Get blog page id
$page_id = get_option('page_for_posts');

get_header(); ?>

<section id="page-content" <?php tdp_attr( 'content' ); ?>>
	<div class="container">
		<div class="row clearfix">

			<?php if(get_field('page_layout', $page_id) == 'Sidebar Left') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    <?php dynamic_sidebar( 'blog_sidebar' ); ?>
                </div>

            <?php endif; ?>

			<section id="blog-posts" class="<?php echo tdp_get_blog_layout_class();?>">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<div <?php tdp_attr( 'entry-content' ); ?>>
							
							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'templates/pages/content', get_post_format() );
							?>

						</div><!-- .entry-content -->

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

			</section><!-- .entry -->

			<?php if(get_field('page_layout', $page_id) == 'Sidebar Right') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    <?php dynamic_sidebar( 'blog_sidebar' ); ?>
                </div>

            <?php endif; ?>

		</div>
	</div> <!-- end container -->
</section> <!-- end page content -->

<?php get_footer(); ?>
