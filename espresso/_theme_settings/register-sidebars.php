<?php
if (function_exists('register_sidebar')) {
	
	// Default
	register_sidebar(array(
		'name' => __('Default Sidebar','espresso'),
		'id'   => 'default-sidebar',
		'description'   => __('The default sidebar for pages.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	// Page Block 1
	register_sidebar(array(
		'name' => __('Page Widget Block A','espresso'),
		'id'   => 'page-block-1',
		'description'   => __('These widgets show up on pages that have widgets active. This is block #1.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	// Page Block 2
	register_sidebar(array(
		'name' => __('Page Widget Block B','espresso'),
		'id'   => 'page-block-2',
		'description'   => __('These widgets show up on pages that have widgets active. This is block #2.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	// Page Block 3
	register_sidebar(array(
		'name' => __('Page Widget Block C','espresso'),
		'id'   => 'page-block-3',
		'description'   => __('These widgets show up on pages that have widgets active. This is block #3.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	// Bottom Widget Block 1
	register_sidebar(array(
		'name' => __('Bottom Widget Block A','espresso'),
		'id'   => 'bottom-footer-1',
		'description'   => __('These widgets show up in the footer. This is block #1.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	// Bottom Widget Block 2
	register_sidebar(array(
		'name' => __('Bottom Widget Block B','espresso'),
		'id'   => 'bottom-footer-2',
		'description'   => __('These widgets show up in the footer. This is block #2.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	// Bottom Widget Block 1
	register_sidebar(array(
		'name' => __('Bottom Widget Block C','espresso'),
		'id'   => 'bottom-footer-3',
		'description'   => __('These widgets show up in the footer. This is block #3.','espresso'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><article>',
		'after_widget'  => '</article></div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
}
?>