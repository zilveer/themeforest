<?php
/**
 * The template for displaying all single posts.
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
								
								/* Display adjacent posts links */
								if(tdp_option('display_posts_adjacent_links')) : 
									get_template_part( 'templates/blog/posts', 'links' );
								endif;

								/* Display authorbox */
								if(tdp_option('display_author_box')) : 
									get_template_part( 'templates/blog/posts', 'author' );
								endif;

							?>
							<div class="col-md-12 column">
							<?php
		                        // If comments are open or we have at least one comment, load up the comment template
		                        if ( comments_open() || '0' != get_comments_number() )
		                            comments_template();
		                    ?>
		                    </div>

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