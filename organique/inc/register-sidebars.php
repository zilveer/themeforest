<?php
/**
 * Register sidebars for Organique
 *
 * @package Organique
 */

function add_my_sidebars() {
	// blog sidebar
	register_sidebar(
		array(
			'name'          => _x( 'Blog Sidebar', 'backend', 'organique_wp' ),
			'id'            => 'blog-sidebar',
			'description'   => _x( 'Sidebar on the blog layout', 'backend', 'organique_wp' ),
			'class'         => 'blog sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3><hr>'
		)
	);

	// regular page
	register_sidebar(
		array(
			'name'          => _x( 'Regular Page Sidebar', 'backend', 'organique_wp' ),
			'id'            => 'regular-page-sidebar',
			'description'   => _x( 'Sidebar on the regular page', 'backend', 'organique_wp' ),
			'class'         => 'sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="underlined"><h3>',
			'after_title'   => '</h3><hr></div>'
		)
	);

	// shop filters
	register_sidebar(
		array(
			'name'          => _x( 'Shop Filter Sidebar', 'backend', 'organique_wp' ),
			'id'            => 'shop-page-sidebar',
			'description'   => _x( 'Sidebar on the shop page', 'backend', 'organique_wp' ),
			'class'         => 'sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="underlined"><h3>',
			'after_title'   => '</h3><hr></div>'
		)
	);

	// footer
	register_sidebar(
		array(
			'name'          => _x( 'Footer', 'backend', 'organique_wp' ),
			'id'            => 'footer-sidebar-top',
			'description'   => _x( 'Footer area accepts 4 widgets', 'backend', 'organique_wp' ),
			'before_widget' => '<div class="col-xs-12  col-sm-3  push-down-60"><div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="footer-wdgets__heading--line"><h4 class="footer-widgets__heading">',
			'after_title'   => '</h4></div>'
		)
	);
}
add_action( "widgets_init", "add_my_sidebars" );