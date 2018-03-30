<?php
/**
 * Register Theme Sidebars
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
if ( !function_exists( 'sd_register_sidebars' ) ) {
 	function sd_register_sidebars() {
		
		// main sidebar
		
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'sd-framework' ),
			'id' => 'main-sidebar',
			'description'   => __( 'Main sidebar of the site.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="sd-sidebar-widget-title">',
			'after_title' => '</h3>',
			) 
		);
		
		// footer sidebars
		register_sidebar( array(
			'name' => __( 'Footer Sidebar One', 'sd-framework' ),
			'id' => 'footer-sidebar-one',
			'description'   => __( 'The first sidebar of the footer.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( 'Footer Sidebar Two', 'sd-framework' ),
			'id' => 'footer-sidebar-two',
			'description'   => __( 'The second sidebar of the footer.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( 'Footer Sidebar Three', 'sd-framework' ),
			'id' => 'footer-sidebar-three',
			'description'   => __( 'The third sidebar of the footer.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( 'Footer Sidebar Four', 'sd-framework' ),
			'id' => 'footer-sidebar-four',
			'description'   => __( 'The fourth sidebar of the footer.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		// woocommerce sidebar
		
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'name' => __( 'WooCommerce Sidebar', 'sd-framework' ),
				'id' => 'woocommerce-sidebar',
				'description'   => __( 'Sidebar used on WooCommerce pages.', 'sd-framework' ),
				'before_widget' => '<aside id="%1$s" class="sd-sidebar-widget sd-woocommerce-sidebar-widget clearfix %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
				) 
			);
		}
		
		// 404 sidebars
		
		register_sidebar( array(
			'name' => __( '404 Sidebar One', 'sd-framework' ),
			'id' => 'error-sidebar-one',
			'description'   => __( 'The first sidebar of the 404 page.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-404-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-404-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( '404 Sidebar Two', 'sd-framework' ),
			'id' => 'error-sidebar-two',
			'description'   => __( 'The second sidebar of the 404 page.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-404-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-404-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( '404 Sidebar Three', 'sd-framework' ),
			'id' => 'error-sidebar-three',
			'description'   => __( 'The third sidebar of the 404 page.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-404-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-404-widget-title">',
			'after_title' => '</h4>',
			) 
		);
		
		// 404 page sidebars
	}
	add_action( 'widgets_init', 'sd_register_sidebars' );
}