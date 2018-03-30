<?php

$mad_include_plugins = array(
	'post-ratings'
);

if ( mad_custom_get_option('products_filter') ) {
	$mad_include_plugins[] = 'woocommerce-products-filter';
}

foreach ($mad_include_plugins as $inc) {
	include_once MAD_INC_PLUGINS_PATH . trailingslashit($inc) . 'init' . '.php';
}