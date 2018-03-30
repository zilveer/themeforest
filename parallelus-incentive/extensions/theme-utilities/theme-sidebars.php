<?php

#-----------------------------------------------------------------
# Default Sidebars
#-----------------------------------------------------------------

function theme_default_sidebars() {
	// Default sidebar
	register_sidebar( array(
		'name' => __( 'Default Sidebar', 'framework' ),
		'id' => 'sidebar-default',
		'description' => __( 'The default sidebar.', 'framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Top (above the page)
	register_sidebar( array(
		'name' => __( 'Top - Above Page', 'framework' ),
		'id' => 'sidebar-top',
		'description' => __( 'The default content area shown above the page.', 'framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Header (right)
	register_sidebar( array(
		'name' => __( 'Header - Right', 'framework' ),
		'id' => 'sidebar-header',
		'description' => __( 'The default content area shown on the right side of the header (masthead).', 'framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Footer Top
	register_sidebar( array(
		'name' => __( 'Footer - Top Section', 'framework' ),
		'id' => 'sidebar-footer-top',
		'description' => __( 'The default content of the footer top section. If your footer content is not coming from this location, look for it inside the Static Content (static blocks) menu of your admin.', 'framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Footer Bottom
	register_sidebar( array(
		'name' => __( 'Footer - Bottom Section', 'framework' ),
		'id' => 'sidebar-footer-bottom',
		'description' => __( 'The default content of the footer bottom section. If your footer content is not coming from this location, look for it inside the Static Content (static blocks) menu of your admin.', 'framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'theme_default_sidebars' );

?>