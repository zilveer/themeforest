<?php
    $phone = Handyman\Front\tl_copt('contact-phone');
?>
    <?php get_template_part( 'partials/header' , 'logo' ); ?>
    <?php if(layers_get_theme_mod('header-show-primary-navigation')): ?>
        <nav class="nav nav-horizontal">
            <?php do_action( 'layers_before_header_nav' ); ?>
            <?php wp_nav_menu(array('theme_location' => LAYERS_THEME_SLUG . '-primary',
                    'menu_class'    => 'menu',
                    'container' => false,
                    'fallback_cb' => '\Handyman\Front\tl_layers_menu_fallback')
            );
            ?>
            <?php do_action( 'layers_after_header_nav' ); ?>
            <?php get_template_part( 'partials/responsive' , 'nav-button' ); ?>
        </nav>
    <?php else: ?>
        <div class="header-contact hidden-xs">
            <?php
            set_query_var('phone', $phone);
            get_template_part('partials/content', 'contact');
            ?>
        </div>
        <?php get_template_part( 'partials/responsive' , 'nav-button' ); ?>
    <?php endif; ?>

    <div class="header-contact phone-for-mobile">
        <ul>
            <li><i class="fa fa-phone"></i></li>
            <li class="phonedigits"><?php echo apply_filters('tl/wrap_nth_word', esc_html($phone)); ?></li>
        </ul>
    </div>