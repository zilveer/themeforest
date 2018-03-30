<?php
/**
 * Add WooCommerce support.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'flow_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'flow_woocommerce_wrapper_end', 10 );

function flow_woocommerce_wrapper_start() {
	echo '<div class="site-content site-woocommerce clearfix" role="main">';
}

function flow_woocommerce_wrapper_end() {
	echo '</div>';
}

add_theme_support( 'woocommerce' );

function flow_woocommerce_body_class( $classes ) {

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$classes[] = 'flow-woocommerce-shop';
	}

	return $classes;
}
add_action( 'body_class', 'flow_woocommerce_body_class' );

function flow_woocommerce_related_products_args( $args ) {
	$args['posts_per_page'] = 5;
	$args['columns'] = 5;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'flow_woocommerce_related_products_args' );

function flow_woocommerce_product_thumbnails_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'flow_woocommerce_product_thumbnails_columns' );

function flow_woocommerce_scripts() {
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', false, true );
	wp_enqueue_script( 'flow-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'owl-carousel', 'jquery-magnific-popup' ), false, true );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'jquery-magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
	wp_enqueue_style( 'flow-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array( 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general', 'jquery-magnific-popup', 'owl-carousel', 'flow-style' ) );
}
add_filter( 'wp_enqueue_scripts', 'flow_woocommerce_scripts' );

/**
 * This is an experimental side panel cart in development.
 */
/* function flow_woocommerce_wp_footer() {
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		if ( apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() ) ) {
			return;
		}
		echo '<div class="side-panel-right">';
			the_widget( 'WC_Widget_Cart', array( 'title' => __( 'Cart', 'flowthemes' ) ) );
			echo '<style>
			.side-panel-right { display: none; position: fixed; right: 0; top: 0; width: 430px; height: 100%; background-color: #fff; z-index: 100000; padding: 90px 45px 45px 45px; }
			.side-panel-right-open { display: block; }
			.side-panel-right .cart-title { line-height: 0.75; text-align: center; }
			.side-panel-right .woocommerce.widget_shopping_cart .widgettitle { line-height: 0.75; text-align: center; }
			.side-panel-right .woocommerce.widget_shopping_cart { height: 100%; }
			.side-panel-right .woocommerce.widget_shopping_cart .widget_shopping_cart_content { display: flex; flex-direction: column; height: 100%; }
			.side-panel-right .woocommerce ul.cart_list { flex: 1; }
			.side-panel-right .woocommerce.widget_shopping_cart .cart_list li { padding-left: 0; padding-bottom: 23px; border-bottom: 2px dotted #c8c8c8; margin-bottom: 23px; }
			.side-panel-right .woocommerce.widget_shopping_cart .cart_list li:last-child { padding-bottom: 0; border-bottom: 0 none; margin-bottom: 0; }
			.side-panel-right .woocommerce.widget_shopping_cart .cart_list li .quantity { color: #acacac; font-weight: bold; }
			.side-panel-right .woocommerce.widget_shopping_cart .cart_list li .quantity .amount { color: #c8aa6e; }
			.side-panel-right .woocommerce ul.cart_list li img { float: left; margin-left: 0; margin-right: 20px; width: 70px; }
			.side-panel-right .woocommerce.widget_shopping_cart .cart_list li a.remove { top: 14px; left: auto; right: 0; width: 26px; height: 26px; color: #b8b8b8 !important; border: 1px solid #b8b8b8; font-size: 22px; }
			.side-panel-right .woocommerce.widget_shopping_cart .cart_list li a.remove:hover { background-color: transparent !important; color: #191919 !important; border: 1px solid #191919; }
			
			.side-panel-right .woocommerce.widget_shopping_cart .total { position: relative; padding-top: 28px; border-top: 2px dotted #ddd; margin-top: 28px; margin-bottom: 21px; }
			.side-panel-right .woocommerce.widget_shopping_cart .total strong { position: absolute; top: 28px; color: #c9c9c9; font-size: 11px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }
			.side-panel-right .woocommerce.widget_shopping_cart .total .amount { display: block; color: #c8aa6e; font-size: 20px; line-height: 1; text-align: right; }
			
			.side-panel-right .widget.widget_shopping_cart .buttons { margin-bottom: 45px; }
			.side-panel-right .widget.widget_shopping_cart .buttons .button:first-child { display: none; }
			.side-panel-right .widget.widget_shopping_cart .buttons .button { width: 100%; padding: 17px; margin: 0; background-color: #c8aa6e; font-size: 13px; font-weight: 600; letter-spacing: 1px; text-align: center; text-transform: uppercase; white-space: normal; }
			.side-panel-right .widget.widget_shopping_cart .buttons .button:hover { background-color: #191919; }
			</style>';
		echo '</div>';
	}
}
add_filter( 'wp_footer', 'flow_woocommerce_wp_footer' ); */
