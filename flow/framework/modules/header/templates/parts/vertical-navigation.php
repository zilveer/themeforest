<?php do_action('flow_elated_before_top_navigation'); ?>

    <nav data-navigation-type='dropdown-toggle-click' class="eltd-vertical-menu eltd-vertical-dropdown-toggle">
        <?php
        wp_nav_menu(array(
            'theme_location'  => 'main-navigation',
            'container'       => '',
            'container_class' => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'fallback_cb'     => 'top_navigation_fallback',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker'          => new FlowTopNavigationWalker()
        ));
        ?>
    </nav>

<?php do_action('flow_elated_after_top_navigation'); ?>