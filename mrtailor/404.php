<?php get_header(); ?>

	<div id="primary" class="content-area">

        <div class="row">	
            <div class="large-10 large-centered columns">    
                <div id="content" class="site-content" role="main">
                
                    <section class="error-404 not-found">
                        <header class="page-header">
                            <div class="error-banner">
								<img id="error-404" class="error" alt="404-banner"  width="354" height="155"  src="<?php echo get_template_directory_uri() . '/images/error_404.png'; ?>" data-interchange="[<?php echo get_template_directory_uri() . '/images/error_404.png'; ?>, (default)], [<?php echo get_template_directory_uri() . '/images/error_404_retina.png'; ?>, (retina)]">
                            </div>
                            <h1 class="page-title"><?php _e( 'Oops 404 again! That page can&rsquo;t be found.', 'mr_tailor' ); ?></h1>
                        </header><!-- .page-header -->
        
                        <div class="page-content">
                            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'mr_tailor' ); ?></p>
        
                            <?php get_search_form(); ?>
        
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                    
                </div><!-- #content -->
            </div><!-- .large-12 .columns -->                
        </div><!-- .row -->
             
    </div><!-- #primary -->

<?php get_footer(); ?>