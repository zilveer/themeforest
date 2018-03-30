<?php 
/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 */

if ( !function_exists( 'st_widgets_init' ) ) {

function st_widgets_init() {
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
		'name' => __( 'Posts Widget Area', 'cherry' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Shown only in Blog Posts, Archives, Categories, etc.', 'cherry' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name'          => __( 'Pages Widget Area', 'cherry' ),
		'id'            => 'secondary-widget-area',
		'description'   => __( 'Shown only in Pages', 'cherry' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Portfolio Widget Area', 'cherry' ),
		'id' => 'portfolio-widget-area',
		'description' => __( 'Shown only in Portfolio with sidebar pages', 'cherry' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Contact widget
	register_sidebar( array(
		'name' => __( 'Contact Widget Area', 'cherry' ),
		'id' => 'contact-widget-area',
		'description' => __( 'Shown only in Contact page', 'cherry' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'cherry' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'cherry' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'cherry' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'cherry' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'cherry' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'cherry' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'cherry' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'cherry' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Register custom sidebards
	$sidebar_list = of_get_option('sidebar_list');
	if( isset($sidebar_list) ) {
		if( !empty($sidebar_list) ) {
			foreach ($sidebar_list as $sidebar) {
				register_sidebar(array(
					'name'=>$sidebar['name'],
					'id'=>$sidebar['id'],
					'description' => 'Custom created widget area',
					'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				));
			}
		}
	}

}
/** Register sidebars by running cherry_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'st_widgets_init' );
}
?>