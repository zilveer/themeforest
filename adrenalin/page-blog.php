<?php
/**
 * Template Name: Blog 
 * @package commercegurus
 */
global $cg_options;
$cg_blog_sidebar = '';
if ( isset( $cg_options['cg_blog_sidebar'] ) ) {
    $cg_blog_sidebar = $cg_options['cg_blog_sidebar'];
}

if ( isset( $_GET['blogsidebar'] ) ) {
    $cg_blog_sidebar = $_GET['blogsidebar'];
}

get_header();
?>
<?php echo cg_get_blog_page_title(); ?>

<div class="container">
    <div class="content">

        <div class="row">
            <?php if ( ( $cg_blog_sidebar == 'default' ) || ( $cg_blog_sidebar == '' ) ) { ?>
                <div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3 col-lg-push-3">
                    <div id="primary" class="content-area cg-blog-layout">
                        <main id="main" class="site-main" role="main">
                            <?php

                            $args = array(
                                'post_status' => 'publish',
                                'post_type' => 'post',
                                'paged' => get_query_var( 'paged' ),
                            );
                            $recent_posts = new WP_Query( $args );

                             if ( $recent_posts->have_posts() ) : ?>
                                <?php /* Start the Loop */ ?>
                                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                                    <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', get_post_format() );
                                    ?>
                                <?php endwhile; ?>
                                <?php 
                                $temp_query = $wp_query;
                                $wp_query   = NULL;
                                $wp_query   = $recent_posts;
                                wpcg_numeric_posts_nav(); ?>
                            <?php else : ?>
                                <?php get_template_part( 'no-results', 'index' ); ?>
                            <?php endif; ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!--/9 -->
                <div class="col-lg-3 col-md-3 col-md-pull-9 col-lg-pull-9">
                    <?php get_sidebar(); ?>
                </div>
            <?php } else if ( $cg_blog_sidebar == 'right' ) { ?>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <div id="primary" class="content-area cg-blog-layout">
                        <main id="main" class="site-main" role="main">
                            <?php

                            $args = array(
                                'post_status' => 'publish',
                                'post_type' => 'post',
                                'paged' => get_query_var( 'paged' ),
                            );
                            $recent_posts = new WP_Query( $args );
                    
                             if ( $recent_posts->have_posts() ) : ?>
                                <?php /* Start the Loop */ ?>
                                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                                    <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', get_post_format() );
                                    ?>
                                <?php endwhile; ?>
                                <?php 
                                $temp_query = $wp_query;
                                $wp_query   = NULL;
                                $wp_query   = $recent_posts;
                                wpcg_numeric_posts_nav(); ?>
                            <?php else : ?>
                                <?php get_template_part( 'no-results', 'index' ); ?>
                            <?php endif; ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!--/9 -->
                <div class="col-lg-3 col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } else if ( $cg_blog_sidebar == 'none' ) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="primary" class="content-area cg-blog-layout">
                        <main id="main" class="site-main" role="main">
                            <?php

                            $args = array(
                                'post_status' => 'publish',
                                'post_type' => 'post',
                                'paged' => get_query_var( 'paged' ),
                            );
                            $recent_posts = new WP_Query( $args );
                    
                             if ( $recent_posts->have_posts() ) : ?>
                                <?php /* Start the Loop */ ?>
                                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                                    <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', get_post_format() );
                                    ?>
                                <?php endwhile; ?>
                                <?php 
                                $temp_query = $wp_query;
                                $wp_query   = NULL;
                                $wp_query   = $recent_posts;
                                wpcg_numeric_posts_nav(); ?>
                            <?php else : ?>
                                <?php get_template_part( 'no-results', 'index' ); ?>
                            <?php endif; ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!--/12 -->
            <?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>