<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package commercegurus
 */
get_header();
?>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="content-area">
                    <main id="main" class="site-main" role="main">
                        <section class="error-404 not-found">
                            <header class="page-header">
                                <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'commercegurus' ); ?></h1>
                            </header><!-- .page-header -->
                            <div class="page-content">
                                <p><?php _e( 'Sorry but the page you are looking for cannot be found. Please make sure you have typed the current url.', 'commercegurus' ); ?></p>
                                <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Back to homepage</a></p>
                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!--/row -->
        </div><!--/content -->
    </div><!--/container -->
</div>
<?php get_footer(); ?>