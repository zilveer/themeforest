<?php

/* Register Sidebars
 ------------------------------------------------------------------------*/
function r_widgets_init() {
	
	global $r_option;

	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name'          => _x('Default', 'Sidebars', SHORT_NAME),
			'id'            => 'default-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar(array(
			'name'          => _x('Category', 'Sidebars', SHORT_NAME),
			'id'            => 'category-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar(array(
			'name'          => _x('Archive', 'Sidebars', SHORT_NAME),
			'id'            => 'archive-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar(array(
			'name'          => _x('Footer Column 1', 'Sidebars', SHORT_NAME),
			'id'            => 'sidebar-footer-col-1',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar(array(
			'name'          => _x('Footer Column 2', 'Sidebars', SHORT_NAME),
			'id'            => 'sidebar-footer-col-2',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar(array(
			'name'          => _x('Footer Column 3', 'Sidebars', SHORT_NAME),
			'id'            => 'sidebar-footer-col-3',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		register_sidebar(array(
			'name'          => _x('Shop', 'Sidebars', SHORT_NAME),
			'id'            => 'sidebar-shop',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		));
		if (isset($r_option['custom_sidebars'])) {
			
			foreach($r_option['custom_sidebars'] as $sidebar) {
				$id = sanitize_title_with_dashes( $sidebar[ 'name' ] );
				register_sidebar(array(
									   'name' => $sidebar['name'],
									   'id'            => $id,
									   'before_widget' => '<div class="widget %2$s">',
									   'after_widget' => '</div>',
									   'before_title' => '<h3 class="sidebar">',
									   'after_title' => '</h3>'
				));
			}
		}
	}
}
add_action('widgets_init', 'r_widgets_init');
?>