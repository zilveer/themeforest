<?php get_header(); ?>

<section class="fullscreen">
    <div class="container v-align-transform">
    
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="text-center">
                    <i class="ti-receipt icon icon-lg mb24 mb-xs-0"></i>
                    <h1 class="large"><?php esc_html_e('Page Not Found','foundry'); ?></h1>
                    <p><?php esc_html_e("The page you requested couldn't be found - this could be due to a spelling error in the URL or a removed page.",'foundry'); ?></p>
                    <a class="btn" href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Go Back Home','foundry'); ?></a>
                </div>
            </div>
        </div>

        <div class="embelish-icons">
            <i class="ti-help-alt"></i>
            <i class="ti-cross"></i>
            <i class="ti-support"></i>
            <i class="ti-announcement"></i>
            <i class="ti-signal"></i>
            <i class="ti-pulse"></i>
            <i class="ti-marker"></i>
            <i class="ti-pulse"></i>
            <i class="ti-alert"></i>
            <i class="ti-help-alt"></i>
            <i class="ti-alert"></i>
            <i class="ti-pulse"></i>
        </div>
        
    </div>
</section>

<?php get_footer();