<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(class_exists('WC_Vendors') ){
$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Items Details ', 'mango' ) );
}
else{
$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );	
}

?>

<?php if ( $heading ): ?>
	<h5><?php echo $heading; ?></h5>
<?php endif; ?>

<?php $product->list_attributes(); ?>
