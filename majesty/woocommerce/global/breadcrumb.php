<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {
	
	 // add shop home url to breadcrumbs
    if( is_product_category() || is_product_tag() || is_product() ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_home_arr = array( get_the_title($shop_page_id), get_permalink($shop_page_id));

        // insert to breadcrumbs array on second position
        array_splice($breadcrumb, 1, 0, array($shop_home_arr));
    }

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}

	}

	echo $wrap_after;

}