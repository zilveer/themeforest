<?php
/**
 * Top Cart
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Templates/Header
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ){
    exit;
}

?>
<div class="top-cart-row-container">
    <div class="wishlist-compare-holder">
    <?php
        if( is_yith_wcwl_activated() ) {
            mc_header_wishlist_link();            
        }

        if( is_yith_woocompare_activated() ) {
            mc_header_compare_link();
        }
    ?>
    </div><!-- /.wishlist-compare-holder -->

    <?php mc_mini_cart(); ?>
    
</div><!-- /.top-cart-row-container -->