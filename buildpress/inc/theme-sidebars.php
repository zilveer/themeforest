<?php
/**
 * Register sidebars for BuildPress
 *
 * @package BuildPress
 */

function buildpress_sidebars() {
	// Blog Sidebar
	register_sidebar(
		array(
			'name'          => _x( 'Blog Sidebar', 'backend', 'buildpress_wp' ),
			'id'            => 'blog-sidebar',
			'description'   => _x( 'Sidebar on the blog layout.', 'backend', 'buildpress_wp' ),
			'class'         => 'blog  sidebar',
			'before_widget' => '<div class="widget  %2$s  push-down-30">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="sidebar__headings">',
			'after_title'   => '</h4>'
		)
	);

	// Regular Page Sidebar
	register_sidebar(
		array(
			'name'          => _x( 'Regular Page Sidebar', 'backend', 'buildpress_wp' ),
			'id'            => 'regular-page-sidebar',
			'description'   => _x( 'Sidebar on the regular page.', 'backend', 'buildpress_wp' ),
			'class'         => 'sidebar',
			'before_widget' => '<div class="widget  %2$s  push-down-30">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="sidebar__headings">',
			'after_title'   => '</h4>'
		)
	);

	// woocommerce shop sidebar
	if ( is_woocommerce_active() ) {
		register_sidebar(
			array(
				'name'          => _x( 'Shop Sidebar', 'backend' , 'buildpress_wp'),
				'id'            => 'shop-sidebar',
				'description'   => _x( 'Sidebar for the shop page', 'backend' , 'buildpress_wp'),
				'class'         => 'sidebar',
				'before_widget' => '<div class="widget  %2$s  push-down-30">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="sidebar__headings">',
				'after_title'   => '</h4>'
			)
		);
	}

	// Header
	register_sidebar(
		array(
			'name'          => _x( 'Header', 'backend', 'buildpress_wp' ),
			'id'            => 'header-widgets',
			'description'   => _x( 'Header area for Icon Box and Social Icons widgets.', 'backend', 'buildpress_wp' ),
			'before_widget' => '<div class="widget  %2$s">',
			'after_widget'  => '</div>'
		)
	);

	// Footer
	$footer_widgets_num = (int)get_theme_mod( 'footer_widgets_num', 3 );

	// only register if not 0
	if ( $footer_widgets_num > 0 ) {
		register_sidebar(
			array(
				'name'          => _x( 'Footer', 'backend', 'buildpress_wp' ),
				'id'            => 'footer-widgets',
				'description'   => sprintf( _x( 'Footer area works best with %d widgets. This number can be changed in the Appearance &rarr; Customize &rarr; Theme Options &rarr; Footer.', 'backend', 'buildpress_wp' ), $footer_widgets_num ),
				'before_widget' => sprintf( '<div class="col-xs-12  col-md-%d"><div class="widget  %%2$s  push-down-30">', round( 12 / $footer_widgets_num ) ),
				'after_widget'  => '</div></div>',
				'before_title'  => '<h6 class="footer__headings">',
				'after_title'   => '</h6>'
			)
		);
	}
}
add_action( 'widgets_init', 'buildpress_sidebars' );