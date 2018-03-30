<div class="inline-left-nav">
        <?php wp_nav_menu( array( 'theme_location'  => LAYERS_THEME_SLUG . '-primary' ,
                                  'container'       => 'nav',
                                  'container_class' => 'nav nav-horizontal'));
        ?>
</div>
<div class="inline-site-logo"><?php get_template_part( 'partials/header' , 'logo' ); ?></div>
<div class="inline-right-nav">
    <?php
        do_action( 'layers_before_header_nav' );
        wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-primary-right' ,
                             'container' => 'nav',
                             'container_class' => 'nav nav-horizontal',
                             'fallback_cb' => create_function('', 'echo "&nbsp";') ) );

       //get_template_part( 'partials/responsive' , 'nav-button' );
       do_action( 'layers_after_header_nav' ); ?>
</div>