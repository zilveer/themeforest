<?php

if (function_exists('register_sidebar')) {
	
	register_sidebar(array(
		'name' => 'Blog Sidebar Widgets',
		'id'   => 'blog-sidebar-widgets',
		'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
	
	register_sidebar(array(
		'name' => 'Page Sidebar Widgets',
		'id'   => 'page-sidebar-widgets',
		'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
	
	register_sidebar(array(
	   'name' => 'Footer Widgets',
	   'id'   => 'footer-widgets',
	   'before_widget' => '<div id="%1$s" class="widget %2$s col-4">',
	   'after_widget' => '</div>',
	   'before_title' => '<h2>',
	   'after_title' => '</h2>'
   	));
}

?>