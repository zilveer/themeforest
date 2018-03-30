<?php
/**
* template part for header toolbar menu. views/header/toolbar
*
* @author 	Artbees
* @package 	jupiter/views
* @version     5.0.0
*/

echo wp_nav_menu(array(
    'theme_location' => 'toolbar-menu',
    'container' => 'nav',
    'container_class' => 'mk-toolbar-navigation',
    'fallback_cb' => '',
    'walker' => new header_icon_walker() ,
));

