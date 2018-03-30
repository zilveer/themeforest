<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="quantity buttons_added">
	<?php if(is_cart()) : ?>
		<input type="number" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Quantity', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" />
		<input type="button" value="+" class="plus hidden-xs">
		<input type="button" value="-" class="minus hidden-xs">
	<?php else : ?>
		<input type="button" value="-" class="minus hidden-xs">
		<input type="number" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Quantity', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" />
		<input type="button" value="+" class="plus hidden-xs">
	<?php endif; ?>
</div>