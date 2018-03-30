<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$share = ot_get_option('pp_woo_share',array());
$shortcode = '';
$showit = false;

if (in_array("facebook", $share)) {
    $shortcode .= 'facebook="yes" ';
    $showit = true;
}
if (in_array("pinit", $share)) {
    $shortcode .= 'pinit="yes" ';
    $showit = true;
}
if (in_array("twitter", $share)) {
    $shortcode .= 'twitter="yes" ';
    $showit = true;
}
if (in_array("gplus", $share)) {
    $shortcode .= 'gplus="yes" ';
    $showit = true;
}

if ( ! $post->post_excerpt ) { ?>
<section>
    <div itemprop="description" id="product-description">

        <?php
        if(function_exists('yith_wishlist_constructor')) { echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); }
        if($showit == true){
            echo do_shortcode( '[shareit '.$shortcode.']' );
        }
        ?>
    </div>
</section>
<?php } else { ?>
<section>
    <div itemprop="description" id="product-description">
    	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );

        if(function_exists('yith_wishlist_constructor')) { echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); }
        if($showit == true){
            echo do_shortcode( '[shareit '.$shortcode.']' );
        }
       ?>
    </div>
</section>
<?php } ?>