<?php
/**
 * Single product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) { ?>
	<div class="quantity"><input type="number" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'swiftframework' ) ?>" class="input-text qty text" /></div>
<?php } else { ?>
	<div class="quantity"><input name="<?php echo $input_name; ?>" data-min="<?php echo $min_value; ?>" data-max="<?php echo $max_value; ?>" value="<?php echo $input_value; ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>
<?php } ?>
