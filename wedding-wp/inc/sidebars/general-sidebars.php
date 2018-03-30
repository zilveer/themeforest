<?php

/******************************/
/*
/*		Register Widgets
/*
/******************************/


function webnus_sidebar_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'left-sidebar',
		'description'   => __( 'Appears in left side in the blog page.', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="subtitle">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'right-sidebar',
		'description'   => __( 'Appears in right side in the blog page.', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="subtitle">',
		'after_title'   => '</h4>',
	) );
		
	// register_sidebar(array(
    // 'name' => 'Home Slider',
    // 'id'=>'home-slider',
    // 'before_widget' => '',
    // 'after_widget' => '',
	// ));

	register_sidebar( array(
		'name'          => __( 'Toggle Top Area Section 1', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'top-area-1',
		'description'   => __( 'Appears in top area section 1', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );	
	
	register_sidebar( array(
		'name'          => __( 'Toggle Top Area Section 2', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'top-area-2',
		'description'   => __( 'Appears in top area section 2', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );	
	
	register_sidebar( array(
		'name'          => __( 'Toggle Top Area Section 3', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'top-area-3',
		'description'   => __( 'Appears in top area section 3', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Toggle Top Area Section 4', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'top-area-4',
		'description'   => __( 'Appears in top area section 4', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );	
	
	
	register_sidebar( array(
		'name'          => __( 'Footer Section 1', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'footer-section-1',
		'description'   => __( 'Appears in footer section 1', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Section 2', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'footer-section-2',
		'description'   => __( 'Appears in footer section 2', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	
	register_sidebar( array(
		'name'          => __( 'Footer Section 3', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'footer-section-3',
		'description'   => __( 'Appears in footer section 3', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Section 4', 'WEBNUS_TEXT_DOMAIN' ),
		'id'            => 'footer-section-4',
		'description'   => __( 'Appears in footer section 4', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );



	  register_sidebar( array(
		'name' => __( 'WooCommerce Page Sidebar', 'WEBNUS_TEXT_DOMAIN' ),
		'id' => 'shop-widget-area',
		'description' => __( 'Product page widget area', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3><div class="sidebar-line"><span></span></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Header Sidebar', 'WEBNUS_TEXT_DOMAIN' ),
		'id' => 'header-advert',
		'description' => __( 'Header Sidebar', 'WEBNUS_TEXT_DOMAIN' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="subtitle">',
		'after_title' => '</h5>',
	) );
	
	    if(function_exists('is_woocommerce')) {

        register_sidebar(array(
            'name' => 'WooCommerce Header Widget Area',
            'id' => 'woocommerce_header',
            'description' => 'This widget area should be used only for WooCommerce header cart widget',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        ));
}
	
}
add_action( 'widgets_init', 'webnus_sidebar_init' );

?>