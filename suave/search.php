<?php
/**
 * The template for displaying Search Results pages.
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
<?php if ( have_posts() ) { ?>
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header class="entry-header">
                        <h1 class="cg-page-title"><?php printf( __( 'Search Results for: %s', 'commercegurus' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header>
                </div>
            </div>
        </div>
    </div> 
<?php } else { ?>
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header class="entry-header">
                        <h1 class="cg-page-title"><?php printf( __( 'Search Results for: %s', 'commercegurus' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header>
                </div>
            </div>
        </div>
    </div> 
<?php } ?>

<div class="container">
    <div class="content">
        <div class="row">
            <?php if ( ( $cg_blog_sidebar == 'default' ) || ( $cg_blog_sidebar == '' ) ) { ?>
                <div class="col-lg-9 col-md-9 col-md-push-3 col-lg-push-3">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <div class="col-lg-12 col-md-12">
                                <?php if ( have_posts() ) : ?>
                                    <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'content', 'search' ); ?>
                                    <?php endwhile; ?>
                                    <?php wpcg_numeric_posts_nav(); ?>
                                <?php else : ?>
                                    <?php get_template_part( 'no-results', 'search' ); ?>
                                <?php endif; ?>
                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- /9 -->
                <div class="col-lg-3 col-md-3 col-md-pull-9 col-lg-pull-9">
                    <?php get_sidebar(); ?>
                </div>
            <?php } else if ( $cg_blog_sidebar == 'right' ) { ?>
                <div class="col-lg-9 col-md-9">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <div class="col-lg-12 col-md-12">
                                <?php if ( have_posts() ) : ?>
                                    <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'content', 'search' ); ?>
                                    <?php endwhile; ?>
                                    <?php wpcg_numeric_posts_nav(); ?>
                                <?php else : ?>
                                    <?php get_template_part( 'no-results', 'search' ); ?>
                                <?php endif; ?>
                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div> <!-- /9 -->
                <div class="col-lg-3 col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } else if ( $cg_blog_sidebar == 'none' ) { ?>
                <div class="col-lg-12 col-md-12">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <div class="col-lg-12 col-md-12">
                                <?php if ( have_posts() ) : ?>
                                    <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php get_template_part( 'content', 'search' ); ?>
                                    <?php endwhile; ?>
                                    <?php wpcg_numeric_posts_nav(); ?>
                                <?php else : ?>
                                    <?php get_template_part( 'no-results', 'search' ); ?>
                                <?php endif; ?>
                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!--/12 -->
            <?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>
