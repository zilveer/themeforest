<?php

/*
 * Register sidebars which are created from theme options
 */
function barcelona_register_sidebars() {

	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'barcelona' ),
		'id'            => 'barcelona-default-sidebar',
		'description'   => esc_html__( 'This is default sidebar.', 'barcelona' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h2 class="title">',
		'after_title'   => '</h2></div>'
	) );

	$barcelona_opts = barcelona_get_options( array(
		'sidebars',
		'show_footer_sidebars'
	) );

	if ( is_array( $barcelona_opts['sidebars'] ) ) {

		foreach ( $barcelona_opts['sidebars'] as $k => $v ) {

			register_sidebar( array(
				'name'          => esc_html( $v['title'] ),
				'id'            => 'barcelona-sidebar-' . intval( $k + 1 ),
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h2 class="title">',
				'after_title'   => '</h2></div>'
			) );

		}

	}

	if ( $barcelona_opts['show_footer_sidebars'] == 'on' ) {

		for ( $i = 1; $i <= 3; $i++ ) {

			register_sidebar( array(
				'name'          => sprintf( esc_html__( 'Footer Sidebar %d', 'barcelona' ),  $i ),
				'id'            => 'barcelona-footer-sidebar-'. intval( $i ),
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h2 class="title">',
				'after_title'   => '</h2></div>'
			) );

		}

	}

	if ( function_exists('buddypress') ) {

		register_sidebar( array(
			'name'          => esc_html__( 'BuddyPress Sidebar', 'barcelona' ),
			'id'            => 'barcelona-buddypress-sidebar',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="sidebar-widget bp-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h2 class="title">',
			'after_title'   => '</h2></div>'
		) );

	}

	if ( class_exists('bbPress') ) {

		register_sidebar( array(
			'name'          => esc_html__( 'bbPress Sidebar', 'barcelona' ),
			'id'            => 'barcelona-bbpress-sidebar',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="sidebar-widget bbp-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h2 class="title">',
			'after_title'   => '</h2></div>'
		) );

	}

	if ( class_exists( 'Woocommerce' ) ) {

		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce Sidebar', 'barcelona' ),
			'id'            => 'barcelona-woocommerce-sidebar',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="sidebar-widget wc-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h2 class="title">',
			'after_title'   => '</h2></div>'
		) );

	}

}
add_action( 'widgets_init', 'barcelona_register_sidebars' );

/*
 * Register widgets
 */
function barcelona_register_widgets() {

	$barcelona_widgets = array(
		'posts'              => 'Barcelona_Widget_Posts',
		'slider-posts'       => 'Barcelona_Widget_Slider_Posts',
		'facebook-box'       => 'Barcelona_Widget_Facebook_Box',
		'google-plus-box'    => 'Barcelona_Widget_Google_Plus_Box',
		'instagram-feed'     => 'Barcelona_Widget_Instagram_Feed',
		'social-media-icons' => 'Barcelona_Widget_Social_Media_Icons',
		'about-me'           => 'Barcelona_Widget_About_Me'
	);

	foreach ( $barcelona_widgets as $k => $v ) {
		include_once BARCELONA_SERVER_PATH .'includes/widgets/barcelona-'. sanitize_key( $k ) .'.php';
		register_widget( $v );
	}

}
add_action( 'widgets_init', 'barcelona_register_widgets' );

/*
 * Unregister widgets
 */
function barcelona_unregister_widgets() {

	unregister_widget( 'EV_Widget_Entry_Views' );

}
add_action( 'widgets_init', 'barcelona_unregister_widgets', 99 );