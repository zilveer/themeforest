<?php
/**
 * Unicase Widget Functions
 *
 * Widget related functions and widget registration
 *
 * @author 		Transvelo
 * @package 	Unicase/Functions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'unicase_register_widgets' ) ) {
	/**
	 * Register Widgets
	 *
	 * @since 1.0.0
	 */
	function unicase_register_widgets() {

		if( class_exists( 'WP_Nav_Menu_Widget' ) ) {
			// Unicase Custom Menu Widget
			include_once get_template_directory() . '/inc/widgets/class-uc-custom-menu-widget.php';
			register_widget( 'UC_WP_Nav_Menu_Widget' );
		}

		if ( is_woocommerce_activated() ) {
			// Unicase Display Product Filter Widget
			include_once get_template_directory() . '/inc/widgets/class-uc-product-filter-widget.php';
			register_widget( 'UC_Products_Filter_Widget' );
		
			// Unicase Display Products Carousel Widget
			include_once get_template_directory() . '/inc/widgets/class-uc-product-carousel-widget.php';
			register_widget( 'UC_Widget_Products_Carousel' );
		}

	}
}

add_action( 'widgets_init', 'unicase_register_widgets' );