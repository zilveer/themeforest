<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$woo_signedin_price="";
if(jwOpt::get_option("woo_signedin_price",0) == 1) {
    $woo_signedin_price=jwOpt::get_option("woo_signedin_price",0);
}
?>

<?php
if($woo_signedin_price == 1) {
    if(is_user_logged_in()){
        if ( $price_html = $product->get_price_html() ) : ?>
                <span><?php echo $price_html; ?></span>
        <?php else: ?>        
                <span><?php echo __('Free','jawtemplates'); ?></span>
        <?php endif; 
    }
} else {
    if ( $price_html = $product->get_price_html() ) : ?>
            <span><?php echo $price_html; ?></span>
    <?php else: ?>        
            <span><?php echo __('Free','jawtemplates'); ?></span>
    <?php endif; 
}