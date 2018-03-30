<?php do_action('libero_mikado_before_top_navigation'); ?>

<nav class="mkd-main-menu mkd-drop-down <?php echo esc_attr($additional_class); ?>">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'main-navigation' ,
        'container'  => '',
        'container_class' => '',
        'menu_class' => 'clearfix',
        'menu_id' => '',
        'fallback_cb' => 'top_navigation_fallback',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'walker' => new LiberoStickyNavigationWalker()
    ));
    ?>
</nav>

<?php do_action('libero_mikado_after_top_navigation'); ?>