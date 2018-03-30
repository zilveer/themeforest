<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default_sidebar',
		'description' => 'This is the default sidebar. You can choose from the theme\'s options page where the widgets from this sidebar will be shown.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));

	register_sidebar(array(
		'name' => 'Footer First Widget',
		'id' => 'footer_first',
		'description' => 'Placeholder for First Footer Widget.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));

	register_sidebar(array(
		'name' => 'Footer Second Widget',
		'id' => 'footer_second',
		'description' => 'Placeholder for Second Footer Widget.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));

	register_sidebar(array(
		'name' => 'Footer Third Widget',
		'id' => 'footer_third',
		'description' => 'Placeholder for Third Footer Widget.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	));
}