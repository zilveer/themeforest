<?php

if (!function_exists('mad_filter_constructor')) {

	function mad_filter_constructor() {

		global $woocommerce;
		if ( ! isset( $woocommerce ) ) { return; }

		define('MAD_WOOF_PATH', trailingslashit(dirname(__FILE__)));
		define('MAD_WOOF_LINK', trailingslashit(MAD_BASE_URI . 'inc/plugins/woocommerce-products-filter'));

		include MAD_WOOF_PATH . 'helper.php';
		include MAD_WOOF_PATH . 'classes/storage.php';
		include MAD_WOOF_PATH . 'classes/counter.php';

		include MAD_WOOF_PATH . 'class.woof.php';
		include MAD_WOOF_PATH . 'widgets/class.woocommerce-filter.php';

		// Let's start the game!
		global $MAD_WOOF;
		$MAD_WOOF = new MAD_WOOF();

		add_action( 'init', array( $MAD_WOOF, 'init' ), 1 );

	}

	mad_filter_constructor();

}


