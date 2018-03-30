<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

if ( sizeof( $viewed_products ) > 4 ) {
   $viewed_products = array_slice($viewed_products, -4, 4, true);
}

if (!empty($viewed_products)):	
	echo '<h2>' . __( 'Recently Viewed Products', 'woocommerce' ) . '</h2>';
	echo '<ul>';

	foreach ( $viewed_products as $vproduct ) : 
		$the_product = new WC_product($vproduct);
		echo '		
		<li>
			<a href="'.esc_url( get_permalink( $the_product->id ) ).'" title="'.esc_attr( $the_product->get_title() ).'">
				'.$the_product->get_image().'
			</a>
		</li>';
	endforeach;

	echo '</ul>';
endif;


