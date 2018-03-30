<?php

/**
 * Ebor Framework
 * Menus & Widgets
 * @since version 1.0
 * @author TommusRhodus
 */
 
/**
 * Ebor Framework
 * Register theme menus
 * @since version 1.0
 * @author TommusRhodus
 */
function register_ebor_menus() {
  register_nav_menus( array(
  	'primary' => __( 'Standard Navigation', 'ebor_starter' )
  ) );
}
add_action( 'init', 'register_ebor_menus' );

/**
 * Ebor Framework
 * Register theme sidebars
 * @since version 1.0
 * @author TommusRhodus
 */
function ebor_register_sidebars() {

	register_sidebar(
		array(
			'id' => 'header',
			'name' => __( 'Header Sidebar', 'ebor_starter' ),
			'description' => __( 'Widgets to be displayed in the header sidebar.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Blog Sidebar', 'ebor_starter' ),
			'description' => __( 'Widgets to be displayed in the blog sidebar.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'page',
			'name' => __( 'Page With Sidebar, Sidebar', 'ebor_starter' ),
			'description' => __( 'Widgets to be displayed in the page with sidebar, sidebar.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'gallery',
			'name' => __( 'Gallery Sidebar', 'ebor_starter' ),
			'description' => __( 'Widgets to be displayed in the gallery sidebar.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'shop',
			'name' => __( 'Shop Sidebar', 'ebor_starter' ),
			'description' => __( 'Widgets to be displayed in the page with sidebar, sidebar.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer1',
			'name' => __( 'Footer Column 1', 'ebor_starter' ),
			'description' => __( 'This will appear in 1,2,3 & 4 column settings.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title upper">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer2',
			'name' => __( 'Footer Column 2', 'ebor_starter' ),
			'description' => __( 'This will appear in 2,3 & 4 column settings.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title upper">',
			'after_title' => '</h3>'
		)
	);
	
	
	register_sidebar(
		array(
			'id' => 'footer3',
			'name' => __( 'Footer Column 3', 'ebor_starter' ),
			'description' => __( 'This will appear in 3 & 4 column settings.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title upper">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer4',
			'name' => __( 'Footer Column 4', 'ebor_starter' ),
			'description' => __( 'This will only appear in 4 column setting.', 'ebor_starter' ),
			'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="section-title widget-title upper">',
			'after_title' => '</h3>'
		)
	);

}
add_action( 'widgets_init', 'ebor_register_sidebars' );