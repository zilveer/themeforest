<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package cshero
 */

get_header(); ?>
<?php global $smof_data,$pagetitle; $blog_layout = cshero_generetor_blog_layout(); ?>
    <section id="primary" class="content-area<?php if(!$pagetitle){ echo ' no_breadcrumb';} ?><?php echo esc_attr($blog_layout->class); ?> blog-grid">
        <div class="container">
            <div class="row">
                <?php if ($blog_layout->left_col): ?>
                    <div class="<?php echo esc_attr($blog_layout->left_col); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
                <div class="<?php echo esc_attr($blog_layout->blog); ?>">

                    <main id="main" class="site-main" role="main">

                        <?php if ( have_posts() ) : ?>
                            <?php if($smof_data["search_heading"] == '1'): ?>
                            <header class="page-header">
                                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', THEMENAME ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                            </header><!-- .page-header -->
                            <?php endif; ?>
                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                /**
                                 * Run the loop for the search to output the results.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-search.php and that will be used instead.
                                 */
                                get_template_part( 'framework/templates/blog/vertical/blog',get_post_format());
                                ?>

                            <?php endwhile; ?>

                            <?php cshero_paging_nav(); ?>

                        <?php else : ?>

                            <?php get_template_part( 'framework/templates/blog/vertical/blog', 'none' ); ?>

                        <?php endif; ?>

                    </main><!-- #main -->

                </div>
                <?php if ($blog_layout->right_col): ?>
                    <div class="<?php echo esc_attr($blog_layout->right_col); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section><!-- #primary -->
<?php get_footer(); ?>
