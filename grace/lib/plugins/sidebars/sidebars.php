<?php

if ( !function_exists( 'st_widgets_init' ) ) {

function st_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Default Sidebar', 'grace' ),
		'id' => 'default',
		'description' => __( 'Default Sidebar', 'grace' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 1', 'grace' ),
		'id' => 'footer1',
		'description' => __( 'The first footer widget area', 'grace' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 2', 'grace' ),
		'id' => 'footer2',
		'description' => __( 'The second footer widget area', 'grace' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 3', 'grace' ),
		'id' => 'footer3',
		'description' => __( 'The third footer widget area', 'grace' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer 4', 'grace' ),
		'id' => 'footer4',
		'description' => __( 'The fourth footer widget area', 'grace' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Highlight', 'grace' ),
		'id' => 'highlight',
		'description' => __( 'Highlight Area', 'grace' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}

add_action( 'widgets_init', 'st_widgets_init' );

}
    
?>