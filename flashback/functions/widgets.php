<?php

// Widgets



if ( function_exists("register_sidebar") ) {
	
	// Widgets Column 1
	register_sidebar(array(
		"name" => "Widgets Column 1",
		"id" => "widgets_1",
		"before_widget" => '<div id="%1$s" class="widget %2$s clearfix">',
		"after_widget" => "</div>",
		"before_title" => "<h5 class='widget-title'>",
		"after_title" => "</h5>",
	));
	
	// Widgets Column 2
	register_sidebar(array(
		"name" => "Widgets Column 2",
		"id" => "widgets_2",
		"before_widget" => '<div id="%1$s" class="widget %2$s clearfix">',
		"after_widget" => "</div>",
		"before_title" => "<h5 class='widget-title'>",
		"after_title" => "</h5>",
	));
	
	// Widgets Column 3
	register_sidebar(array(
		"name" => "Widgets Column 3",
		"id" => "widgets_3",
		"before_widget" => '<div id="%1$s" class="widget %2$s clearfix">',
		"after_widget" => "</div>",
		"before_title" => "<h5 class='widget-title'>",
		"after_title" => "</h5>",
	));

}