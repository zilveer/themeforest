<?php

if ( function_exists( 'register_sidebar' ) ) {
		
	register_sidebar( array(
		'name' => __( "Bottom 1", 'onioneye' ),
		'id' => 'bottom-1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 2", 'onioneye' ),
		'id' => 'bottom-2',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 3", 'onioneye' ),
		'id' => 'bottom-3',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Bottom 4", 'onioneye' ),
		'id' => 'bottom-4',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Sidebar Pages", 'onioneye' ),
		'id' => 'sidebar-pages',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	
	register_sidebar( array(
		'name' => __( "Sidebar Blog", 'onioneye' ),
		'id' => 'sidebar-blog',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	
}

?>
