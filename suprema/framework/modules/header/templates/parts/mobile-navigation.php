<?php do_action('suprema_qodef_before_mobile_navigation'); ?>

<nav class="qodef-mobile-nav">
    <div class="qodef-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'main-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new SupremaQodefMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php do_action('suprema_qodef_after_mobile_navigation'); ?>