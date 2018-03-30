<?php

/*------------------------------------------------------------*/
/* 	Add Action
/*------------------------------------------------------------*/

add_action('init', 'sleek_register_nav_menu');



/*------------------------------------------------------------*/
/*	Register menus locations
/*------------------------------------------------------------*/

function sleek_register_nav_menu() {
	register_nav_menus(array(
		'header-menu' 		=> __('Header Menu', 'sleek'),
		// 'sidebar-menu' 		=> __('Sidebar Menu', 'sleek'),
		// 'footer-menu' 		=> __('Footer Menu', 'sleek'),
	));
}



/*------------------------------------------------------------*/
/*	Navigation Menus
/*------------------------------------------------------------*/

function sleek_nav_menu_header() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
