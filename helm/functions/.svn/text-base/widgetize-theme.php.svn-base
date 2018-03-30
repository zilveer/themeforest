<?php
// Default Sidebar
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
// Social Header Sidebar
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Social Header',
		'id' => 'social_header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);
// Dynamic Sidebar
for ($sidebar_count=1; $sidebar_count <=MAX_SIDEBARS; $sidebar_count++ ) {

	if ( of_get_option('theme_sidebar'.$sidebar_count) <> "" ) {
		if ( function_exists('register_sidebar') )
			register_sidebar(array(
				'name' => of_get_option('theme_sidebar'.$sidebar_count),
				'id' => 'sidebar_' . $sidebar_count . '',
				'before_widget' => '<div class="sidebar-widget"><aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			)
		);
	}
}

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

?>