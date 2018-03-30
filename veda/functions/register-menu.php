<?php
/* ---------------------------------------------------------------------------
 * Registers some menu location to use with navigation menus.
 * --------------------------------------------------------------------------- */
if (!function_exists('veda_navigation_menus')) {

	// register navigation menus
	function veda_navigation_menus() {
		$locations = array(
			'main-menu' 		=> esc_html__('Main Menu', 'veda'),
			'secondary-menu' 	=> esc_html__('Secondary Menu', 'veda'),
			'shortcode-menu'    => esc_html__('Shortcode Menu', 'veda'),
		);
		register_nav_menus($locations);
	}

	// hook into the 'init' action
	add_action('init', 'veda_navigation_menus');
}

/* ---------------------------------------------------------------------------
 * Main Menu
 * --------------------------------------------------------------------------- */
function veda_wp_nav_menu($depth = 0) {
	$args = array( 
		'container' 		=> 'nav',
		'container_id'		=> 'main-menu',
		'menu_class'		=> 'menu',
		'menu_id'			=> '', 
		'fallback_cb'		=> 'veda_wp_page_menu',
		'items_wrap'      	=> '<ul class="%2$s">%3$s</ul>', 
 		'theme_location'	=> 'main-menu',
		'depth' 			=> $depth,
		'walker' 			=> new Veda_FrontEndMenuWalker,
	);

	if( is_page_template('tpl-onepage.php') ):
		global $post;
		$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;

		$meta 		  = get_post_meta($page_id, '_tpl_default_settings', true);
		$args['menu'] = $meta['onepage_menu'];
	endif;
	wp_nav_menu( $args );
}

function veda_wp_page_menu() {
	echo '<nav id="main-menu" class="menu-main-container"><ul id="menu-main-menu" class="menu">';
	$args = array(
		'depth' 		=> 0,
		'title_li' 		=> '',
		'echo' 			=> 0,
		'post_type' 	=> 'page',
		'post_status' 	=> 'publish'
	);
	$pages = wp_list_pages($args);
	if ($pages)
		echo $pages;
	echo '</ul></nav>';
}

/* ---------------------------------------------------------------------------
 * Split Menu
 * --------------------------------------------------------------------------- */
function veda_wp_split_menu() {
	// Main Menu Left ----------------------------
	$args = array( 
		'container' 		=> false,
		'menu_id'         	=> false,
		'menu_class'		=> 'menu menu-left',
		'fallback_cb'		=> false, 
		'theme_location'	=> 'main-menu',
		'depth' 			=> 0,
		'walker' 			=> new Veda_FrontEndMenuWalker,
	);

	if( is_page_template('tpl-onepage.php') ):
		global $post;
		$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;

		$meta 		  = get_post_meta($page_id, '_tpl_default_settings', true);
		$args['menu'] = $meta['onepage_menu'];
	endif;
	wp_nav_menu( $args );

	// Main Menu Right ----------------------------
	$args = array( 
		'container' 		=> false,
		'menu_id'         	=> false,
		'menu_class'		=> 'menu menu-right',
		'fallback_cb'		=> false, 
		'theme_location'	=> 'secondary-menu',
		'depth' 			=> 0,
		'walker' 			=> new Veda_FrontEndMenuWalker,
	);
	wp_nav_menu( $args );
}

/* ---------------------------------------------------------------------------
 * Secondary menu
 * --------------------------------------------------------------------------- */
function veda_wp_secondary_menu() {
	$args = array(
		'container' 		=> false,
		'container_id'		=> 'secondary-menu', 
		'menu_class'		=> 'secondary-menu', 
		'fallback_cb'		=> false,
		'theme_location' 	=> 'secondary-menu',
		'depth'				=> 2,
	);
	wp_nav_menu( $args );
}?>