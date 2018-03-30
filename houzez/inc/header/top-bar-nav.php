<?php
// Pages Menu
if ( has_nav_menu( 'top-menu' ) ) :
    wp_nav_menu( array (
        'theme_location' => 'top-menu',
        'container' => 'div',
        'container_class' => 'navi top-nav',
        'menu_class' => '',
        'menu_id' => 'main-nav',
        'depth' => 4
    ));
endif;
?>
<div class="mobile-nav">
    <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
    <div class="nav-dropdown top-nav-dropdown"></div>
</div>