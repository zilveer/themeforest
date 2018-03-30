<?php
/*
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cshero
 */
get_header(); ?>
<?php global $smof_data,$breadcrumb;$blog_layout = cshero_generetor_blog_layout(); ?>
	<section  id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?><?php echo esc_attr($blog_layout->class); ?> blog-grid">
        <div class="container">
            <div class="row">
                <?php if ($blog_layout->left_col): ?>
                	<div class="left-wrap <?php echo esc_attr($blog_layout->left_col); ?>">
                		<?php get_sidebar(); ?>
                	</div>
                <?php endif; ?>
                <div class="content-wrap <?php echo esc_attr($blog_layout->blog); ?>">
                    <main id="main" class="site-main" role="main">

                        <?php if ( have_posts() ) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'framework/templates/blog/blog',get_post_format());
                                ?>

                            <?php endwhile; ?>

                            <?php cshero_paging_nav(); ?>

                        <?php else : ?>

                            <?php get_template_part( 'framework/templates/blog/blog', 'none' ); ?>

                        <?php endif; ?>

                    </main><!-- #main -->
                </div>
                <?php if ($blog_layout->right_col): ?>
                	<div class="right-wrap <?php echo esc_attr($blog_layout->right_col); ?>">
                		<?php get_sidebar(); ?>
                	</div>
                <?php endif; ?>
            </div>
        </div>
	</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
