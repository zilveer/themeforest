<?php

//REGISTER CUSTOM MENUS
function register_ebor_menus() {
  register_nav_menus( 
  	array(
  		'primary' => __( 'Standard Navigation', 'flair' ),
  	) 
  );
}
add_action( 'init', 'register_ebor_menus' );

//REGISTER SIDEBARS
function ebor_register_sidebars() {

	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Blog Sidebar', 'flair' ),
			'description' => __( 'Widgets to be displayed in the blog sidebar.', 'flair' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget %2$s">',
			'after_widget' => '</div><div class="pad30"></div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'page',
			'name' => __( 'Page With Sidebar, Sidebar', 'flair' ),
			'description' => __( 'Widgets to be displayed in the page with sidebar, sidebar.', 'flair' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer1',
			'name' => __( 'Footer Column 1', 'flair' ),
			'description' => __( 'If this is set, your footer will be 1 column', 'flair' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div><div class="pad30"></div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer2',
			'name' => __( 'Footer Column 2', 'flair' ),
			'description' => __( 'If this & column 1 are set, your footer will be 2 columns.', 'flair' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div><div class="pad30"></div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>'
		)
	);
	
	
	register_sidebar(
		array(
			'id' => 'footer3',
			'name' => __( 'Footer Column 3', 'flair' ),
			'description' => __( 'If this & column 1 & column 2 are set, your footer will be 3 columns.', 'flair' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div><div class="pad30"></div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer4',
			'name' => __( 'Footer Column 4', 'flair' ),
			'description' => __( 'If this & column 1 & column 2 & column 3 are set, your footer will be 4 columns.', 'flair' ),
			'before_widget' => '<div id="%1$s" class="sidebox widget clearfix %2$s">',
			'after_widget' => '</div><div class="pad30"></div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>'
		)
	);
	
}
add_action( 'widgets_init', 'ebor_register_sidebars' );