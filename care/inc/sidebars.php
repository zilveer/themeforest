<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Register sidebars
*	--------------------------------------------------------------------- 
*/

function mnky_sidebars() {
	register_sidebar( array(
		'name' => __( 'Blog/Post Sidebar', 'care' ),
		'id' => 'blog-sidebar',
		'description' => __( 'Appears on blog layout and posts', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'care' ),
		'id' => 'default-sidebar',
		'description' => __( 'Appears as default sidebar on pages', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
	if( ot_get_option('top_bar') != 'off' ) {
		register_sidebar( array(
			'name' => __( 'Top Bar Sidebar Left', 'care' ),
			'id' => 'top-left-widget-area',
			'description' => __( 'Top bar widget area (align left)', 'care' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<li class="widget-title">',
			'after_title' => '</li>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Top Bar Sidebar Right', 'care' ),
			'id' => 'top-right-widget-area',
			'description' => __( 'Top bar widget area (align right)', 'care' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<li class="widget-title">',
			'after_title' => '</li>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 1', 'care' ),
		'id' => 'footer-widget-area-1',
		'description' => __( 'Appears in the footer section', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 2', 'care' ),
		'id' => 'footer-widget-area-2',
		'description' => __( 'Appears in the footer section', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 3', 'care' ),
		'id' => 'footer-widget-area-3',
		'description' => __( 'Appears in the footer section', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Sidebar 4', 'care' ),
		'id' => 'footer-widget-area-4',
		'description' => __( 'Appears in the footer section', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Copyright Area', 'care' ),
		'id' => 'copyright-widget-area',
		'description' => __( 'Appears in the footer section', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'WooCommerce Page Sidebar', 'care' ),
		'id' => 'shop-widget-area',
		'description' => __( 'Product page widget area', 'care' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}

add_action( 'widgets_init', 'mnky_sidebars' );

?>