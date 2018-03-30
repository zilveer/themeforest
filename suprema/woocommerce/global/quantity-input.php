<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="quantity qodef-quantity-buttons">
	<input type="text" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'suprema' ) ?>" class="input-text qty text qodef-quantity-input" size="4" />
	<div class="qodef-quantity-buttons-holder">
		<span class="qodef-quantity-plus"><i class="fa fa-angle-up"></i></span>
		<span class="qodef-quantity-minus"><i class="fa fa-angle-down"></i></span>
	</div>
</div>

<!--<input type="number" step="--><?php //echo esc_attr( $step ); ?><!--" --><?php //if ( is_numeric( $min_value ) ) : ?><!--min="--><?php //echo esc_attr( $min_value ); ?><!--"--><?php //endif; ?><!-- --><?php //if ( is_numeric( $max_value ) ) : ?><!--max="--><?php //echo esc_attr( $max_value ); ?><!--"--><?php //endif; ?><!-- name="--><?php //echo esc_attr( $input_name ); ?><!--" value="--><?php //echo esc_attr( $input_value ); ?><!--" title="--><?php //echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'suprema' ) ?><!--" class="input-text qty text" size="4" />-->
