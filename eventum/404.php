<?php get_header('alternative'); 
/*
*Template Name: 404 Page Template
*/
global $themeum_options;
?>
<section class="error-page-inner">
    <div>
        <div class="container">
            <div class="row">
                <div class="error-msg">
                    <h1 class="error-code"><?php  esc_html_e( '404', 'eventum' ); ?></h1>
                    <p class="error-message"><?php  esc_html_e( 'Component not found.', 'eventum' ); ?></p>
                    <a class="btn btn-success btn-lg" href="<?php echo esc_url( site_url() ); ?>" title="HOME"><?php  esc_html_e( 'Go Back Home', 'eventum' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer('alternative'); ?>
