<?php

register_nav_menus(
	array(
	  'ci_main_menu' => __('Main Menu', 'ci_theme')
	)
);

// Add ID and Class attributes to the first <ul> occurence in wp_page_menu
if( !function_exists('mainmenu_add_ul_atributes') ):
function mainmenu_add_ul_atributes($menu, $args) {
	return preg_replace('/<ul>/', '<ul id="navigation" class="nav sf-menu">', $menu, 1);
}
endif;
add_filter('wp_page_menu','mainmenu_add_ul_atributes', 10, 2);


?>