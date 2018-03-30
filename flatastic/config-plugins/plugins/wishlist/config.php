<?php

if (!class_exists('MAD_WISHLIST_MOD')) {

	class MAD_WISHLIST_MOD {

		function __construct() {

			if ( !defined( 'YITH_WCWL' ) ) return;

			if ( get_option( 'yith_wcwl_enabled' ) == 'yes' ) {
				add_action( 'product-actions-before', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ) );
			}

			add_action( 'wp_ajax_mad_add_count_products', array( $this, 'ajax_count_products' ) );
			add_action( 'wp_ajax_nopriv_mad_add_count_products', array( $this, 'ajax_count_products' ) );

		}

		public function ajax_count_products() {
			echo YITH_WCWL()->count_products();
		}

	}

}