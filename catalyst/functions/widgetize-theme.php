<?php
// Register Sidebar
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default_sidebar',
		'before_widget' => '<div class="sidebar-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
// Footer
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Single Column 1',
		'id' => 'footer_1',
		'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Single Column 2',
		'id' => 'footer_2',
		'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Double Column',
		'id' => 'footer_double',
		'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Single Column 3',
		'id' => 'footer_3',
		'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Single Column 4',
		'id' => 'footer_4',
		'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
// Footer Scripts
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer Scripts',
		'id' => 'footer_scripts',
		'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h3><a href="#">',
		'after_title' => '</a></h3>',
	)
);


for ($sidebar_count=1; $sidebar_count <=10; $sidebar_count++ ) {
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name' => 'Sidebar ' . $sidebar_count . '',
			'id' => 'sidebar_' . $sidebar_count . '',
			'before_widget' => '<div class="sidebar-widget"><aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside></div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		)
	);
}

?>