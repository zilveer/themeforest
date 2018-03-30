<?php
/**
 * Main class
 *
 * @author Your Inspiration Themes
 * @package YIHT WooCommerce Wishlist
 * @version 1.0.0
 */

/**
 * Checks if we are on a YIThemes.com theme or not.
 */

// Handles all ajax requests pertaining to this plugin
require_once( 'safe-wp-load.php' );

require_once( 'functions.yith-wcwl.php' );

header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1
header( "Expires: Sat, 26 Jul 1997 05:00:00 GMT" ); // Date in the past

if( !isset( $yith_wcwl ) ) {
	$yith_wcwl = new YITH_WCWL();
}

// Remove product from the wishlist
if( $_GET['action'] == 'remove_from_wishlist' ) {
    $count = yith_wcwl_count_products();

    if( $yith_wcwl->remove( $_GET['wishlist_item_id'] ) )
        { _e( 'Product successfully removed.', 'homeshop' ); }
    else {
        echo '#' . $count . '#';
        _e( 'Error. Unable to remove the product from the wishlist.', 'homeshop' );
    }

    if( !$count )
        { _e( 'No products were added to the wishlist', 'homeshop' ); }
}
// Add product in the wishlist
elseif( $_GET['action'] == 'add_to_wishlist' ) {
    $return = $yith_wcwl->add();
    $count = $yith_wcwl->count_products();
    if( $return == 'true'  )
        { echo $return . '##' . __( 'The product has been added to your wishlist!', 'homeshop' ).'##'. $count .' '. _n( 'Item', 'Items', $count, 'homeshop' );}
    elseif( $return == 'exists' )
        { echo $return . '##' . __( 'Product already in the wishlist.', 'homeshop' ).'##'. $count .' '. _n( 'Item', 'Items', $count, 'homeshop' ); }
    elseif( count( $yith_wcwl->errors ) > 0 )
        { echo $yith_wcwl->get_errors(); }
}
// Check if a product exists in the wishlist in case of variations
elseif( $_GET['action'] == 'prod_find' ) {
    if( $yith_wcwl->is_product_in_wishlist( $_POST['prod_id'] ) ) {
		echo "exists";
	}
}