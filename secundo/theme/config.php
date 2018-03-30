<?php
register_nav_menus(array(
	'primary_navigation' => __('Primary Navigation', 'ct_theme'),
));

// Register widgetized areas
register_sidebar(array(
	'name' => __('Primary Sidebar', 'ct_theme'),
	'id' => 'sidebar-primary',
	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
	'after_widget' => '</div></section>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => __('Footer column 1', 'ct_theme'),
	'id' => 'sidebar-footer1',
	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
	'after_widget' => '</div></section>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => __('Footer column 2', 'ct_theme'),
	'id' => 'sidebar-footer2',
	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
	'after_widget' => '</div></section>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => __('Footer column 3', 'ct_theme'),
	'id' => 'sidebar-footer3',
	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
	'after_widget' => '</div></section>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => __('Footer column 4', 'ct_theme'),
	'id' => 'sidebar-footer4',
	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
	'after_widget' => '</div></section>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));
