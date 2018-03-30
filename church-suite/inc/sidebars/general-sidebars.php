<?php

/******************************/
/*
/*		Register Sidebars
/*
/******************************/


function webnus_sidebar_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'webnus_framework' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Appears in left side in the blog page.', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="subtitle">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'webnus_framework' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Appears in right side in the blog page.', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="subtitle">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 1', 'webnus_framework' ),
		'id'            => 'top-area-1',
		'description'   => esc_html__( 'Appears in top area section 1', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 2', 'webnus_framework' ),
		'id'            => 'top-area-2',
		'description'   => esc_html__( 'Appears in top area section 2', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 3', 'webnus_framework' ),
		'id'            => 'top-area-3',
		'description'   => esc_html__( 'Appears in top area section 3', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toggle Top Area Section 4', 'webnus_framework' ),
		'id'            => 'top-area-4',
		'description'   => esc_html__( 'Appears in top area section 4', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );	
	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 1', 'webnus_framework' ),
		'id'            => 'footer-section-1',
		'description'   => esc_html__( 'Appears in footer section 1', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 2', 'webnus_framework' ),
		'id'            => 'footer-section-2',
		'description'   => esc_html__( 'Appears in footer section 2', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );

	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 3', 'webnus_framework' ),
		'id'            => 'footer-section-3',
		'description'   => esc_html__( 'Appears in footer section 3', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Section 4', 'webnus_framework' ),
		'id'            => 'footer-section-4',
		'description'   => esc_html__( 'Appears in footer section 4', 'webnus_framework' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="subtitle">',
		'after_title'   => '</h5>',
	) );



	  register_sidebar( array(
		'name' => esc_html__( 'WooCommerce Page Sidebar', 'webnus_framework' ),
		'id' => 'shop-widget-area',
		'description' => esc_html__( 'Product page widget area', 'webnus_framework' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3><div class="sidebar-line"><span></span></div>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Header Sidebar', 'webnus_framework' ),
		'id' => 'header-advert',
		'description' => esc_html__( 'Header Sidebar', 'webnus_framework' ),
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