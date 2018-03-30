<?php 

add_action( 'widgets_init', 'etheme_widgets_init' );

function etheme_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', ETHEME_DOMAIN),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Single product sidebar.
	register_sidebar( array(
		'name' => __( 'Single product sidebar', ETHEME_DOMAIN ),
		'id' => 'product-single-widget-area',
		'description' => __( 'Product single product sidebar', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Homepage sidebar.
	register_sidebar( array(
		'name' => __( 'Home Page sidebar', ETHEME_DOMAIN ),
		'id' => 'homepage-widget-area',
		'description' => __( 'Home Page sidebar', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Products sidebar.
	register_sidebar( array(
		'name' => __( 'Product Page sidebar', ETHEME_DOMAIN ),
		'id' => 'product-widget-area',
		'description' => __( 'Product Page sidebar', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', ETHEME_DOMAIN ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. 
	register_sidebar( array(
		'name' => __( 'The First Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'first-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The First Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 5, located in the footer. 
	register_sidebar( array(
		'name' => __( 'The Second Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'second-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Second Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 6, located in the footer. 
	register_sidebar( array(
		'name' => __( 'The Third Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'third-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Third Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 7, located in the footer. 
	register_sidebar( array(
		'name' => __( 'The Fourth Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'fourth-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Fourth Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 8, located in the footer. 
	register_sidebar( array(
		'name' => __( 'Prefooter Area', ETHEME_DOMAIN ),
		'id' => 'prefooter-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Prefooter area', ETHEME_DOMAIN )
	) );
	// Area 9, located in the footer. 
	register_sidebar( array(
		'name' => __( 'Footer Twitter Area', ETHEME_DOMAIN ),
		'id' => 'footer-time-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Footer Twitter Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 10, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Payments Area', ETHEME_DOMAIN ),
		'id' => 'payments-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Payments Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 11, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Payments Area', ETHEME_DOMAIN ),
		'id' => 'payments-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Payments Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
	// Area 12, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Copyrights', ETHEME_DOMAIN ),
		'id' => 'copyrights-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Copyrights', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );

}
