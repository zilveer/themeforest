<?php

/**
 * template part for sub-footer navigation. views/footer
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */


wp_nav_menu(array(
    'theme_location' => 'footer-menu',
    'container' => 'nav',
    'container_id' => 'mk-footer-navigation',
    'container_class' => 'footer_menu',
    'fallback_cb' => '',
));
