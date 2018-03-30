<?php
/**
 * Mobile Menu alternative.
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.0.0
 */ ?>

<div id="mobile-menu-alternative" class="wpex-hidden">
    <?php wp_nav_menu( array(
        'theme_location' => 'mobile_menu_alt',
        'menu_class'     => 'dropdown-menu',
        'fallback_cb'    => false,
    ) ); ?>
</div><!-- #mobile-menu-alternative -->