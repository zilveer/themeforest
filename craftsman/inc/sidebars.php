<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Register sidebars
*	--------------------------------------------------------------------- 
*/

function mnky_sidebars() {
	register_sidebar( array(
		'name' => __( 'Blog/Post Sidebar', 'craftsman' ),
		'id' => 'blog-sidebar',
		'description' => __( 'Appears on blog layout and posts', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'craftsman' ),
		'id' => 'default-sidebar',
		'description' => __( 'Appears as default sidebar on pages', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
	if( ot_get_option('top_bar') != 'off' ) {
		register_sidebar( array(
			'name' => __( 'Top Bar Sidebar Left', 'craftsman' ),
			'id' => 'top-left-widget-area',
			'description' => __( 'Top bar widget area (align left)', 'craftsman' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<li class="widget-title">',
			'after_title' => '</li>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Top Bar Sidebar Right', 'craftsman' ),
			'id' => 'top-right-widget-area',
			'description' => __( 'Top bar widget area (align right)', 'craftsman' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<li class="widget-title">',
			'after_title' => '</li>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 1', 'craftsman' ),
		'id' => 'footer-widget-area-1',
		'description' => __( 'Appears in the footer section', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 2', 'craftsman' ),
		'id' => 'footer-widget-area-2',
		'description' => __( 'Appears in the footer section', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 3', 'craftsman' ),
		'id' => 'footer-widget-area-3',
		'description' => __( 'Appears in the footer section', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 4', 'craftsman' ),
		'id' => 'footer-widget-area-4',
		'description' => __( 'Appears in the footer section', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Copyright Area', 'craftsman' ),
		'id' => 'copyright-widget-area',
		'description' => __( 'Appears in the footer section', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'WooCommerce Page Sidebar', 'craftsman' ),
		'id' => 'shop-widget-area',
		'description' => __( 'Product page widget area', 'craftsman' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}

add_action( 'widgets_init', 'mnky_sidebars' );