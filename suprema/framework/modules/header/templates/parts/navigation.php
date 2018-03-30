<?php do_action('suprema_qodef_before_top_navigation'); ?>

<nav class="qodef-main-menu qodef-drop-down <?php echo esc_attr($additional_class); ?>">
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
        'walker' => new SupremaQodefTopNavigationWalker()
    ));
    ?>
</nav>

<?php do_action('suprema_qodef_after_top_navigation'); ?>