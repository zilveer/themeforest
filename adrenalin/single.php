<?php
/**
 * The Template for displaying all single posts.
 *
 * @package commercegurus
 */
global $cg_options;
$cg_blog_sidebar = '';
if ( isset( $cg_options['cg_blog_sidebar'] ) ) {
    $cg_blog_sidebar = $cg_options['cg_blog_sidebar'];
}

get_header();
?>
<?php cg_get_page_title(); ?>
<div class="container">
    <div class="content">
        <div class="row">
            <?php if ( ( $cg_blog_sidebar == 'default' ) || ( $cg_blog_sidebar == '' ) ) { ?>
                <div class="col-lg-9 col-md-9 col-md-push-3 col-lg-push-3">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'content', 'single' ); ?>
                                <?php cg_content_nav( 'nav-below' ); ?>

                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();
                                ?>
                            <?php endwhile; // end of the loop.  ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
                <div class="col-lg-3 col-md-3 col-md-pull-9 col-lg-pull-9">
                    <?php get_sidebar(); ?>
                </div>
            <?php } else if ( $cg_blog_sidebar == 'right' ) { ?>
                <div class="col-lg-9 col-md-9">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'content', 'single' ); ?>
                                <?php cg_content_nav( 'nav-below' ); ?>
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();
                                ?>
                            <?php endwhile; // end of the loop.  ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
                <div class="col-lg-3 col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } else if ( $cg_blog_sidebar == 'none' ) { ?>
                <div class="col-lg-12 col-md-12">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'content', 'single' ); ?>
                                <?php cg_content_nav( 'nav-below' ); ?>
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();
                                ?>
                            <?php endwhile; // end of the loop.  ?>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
            <?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>