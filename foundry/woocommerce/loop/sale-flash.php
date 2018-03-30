<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	
	global $post, $product;
	
	if ( $product->is_on_sale() )
		echo apply_filters( 'woocommerce_sale_flash', '<span class="label">' . __( 'Sale!', 'foundry' ) . '</span>', $post, $product );