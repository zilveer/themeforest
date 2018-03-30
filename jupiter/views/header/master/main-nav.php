<?php

/**
 * template part for Main Navigation. views/header/master
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if(isset($mk_options['hide_header_nav']) && $mk_options['hide_header_nav'] == 'false') return false;

$menu_location = !empty($view_params['menu_location']) ? $view_params['menu_location'] : mk_main_nav_location();

$menu_html = wp_nav_menu(array(
    'theme_location' => $menu_location,
    'container' => 'nav',
    'container_class' => 'mk-main-navigation js-main-nav',
    'menu_class' => 'main-navigation-ul',
    'echo' => false,
    'fallback_cb' => 'mk_link_to_menu_editor',
    'walker' => new mk_main_menu,
));


// Send logo to the middle of logo
if(isset($view_params['logo_middle']) && $view_params['logo_middle'] == 'true') {
	$menu_id = mk_get_nav_id_by_location($menu_location);

	$logo = mk_get_header_view('master', 'logo', ['is_nav_item' => true], true);

	echo mk_insert_logo_middle_of_nav($menu_id, $menu_html, $logo);	
} else {
	echo $menu_html;
}

