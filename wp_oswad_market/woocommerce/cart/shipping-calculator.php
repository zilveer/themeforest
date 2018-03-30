<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( get_option('woocommerce_enable_shipping_calc')=='no' || ! WC()->cart->needs_shipping() )
	return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="shipping_calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

	<h2 class="wd_title_cart"><a href="#" class="shipping-calculator-button heading-title"><?php _e( 'Calculate shipping', 'wpdance' ); ?></a></h2>

	<div class="shipping-calculator-form">
		<p><label><?php _e( 'Country', 'wpdance' ); ?><abbr class="required" title="required">*</abbr></label>
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
				
				<?php
					foreach( WC()->countries->get_shipping_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				?>
			</select>
		</p>
		
		<p class="form-row form-row-wide">
			
			<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );
				// Hidden Input
				if ( is_array( $states ) && empty( $states ) ) {

					?>
					<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / Province', 'wpdance' ); ?>" /><?php

				// Dropdown Input
				} elseif ( is_array( $states ) ) {

					?><span>
						<label><?php _e( 'State / Province', 'wpdance' ); ?></label>
						<select name="calc_shipping_state" id="calc_shipping_state">
		
							<?php
								foreach ( $states as $ckey => $cvalue ){
									$cvalue = sprintf( __( '%s','wpdance' ), esc_html( $cvalue ) );
									echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . $cvalue .'</option>';
								}	
							?>
						</select>
					</span><?php

				// Standard Input
				} else {
					?>
					<label><?php _e( 'State / Province', 'wpdance' ); ?><abbr class="required" title="required">*</abbr></label>
					<input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>"  name="calc_shipping_state" id="calc_shipping_state" /><?php

				}
			?>
		</p>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

			<p class="form-row form-row-wide">	
				<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'wpdance' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</p>

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
			<p><label><?php _e( 'Zip / Postal code', 'wpdance' ); ?><abbr class="required" title="required">*</abbr></label>
				<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>"  name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</p>

		<?php endif; ?>

		<p class="wd_shipping_bt"><button type="submit" name="calc_shipping" value="1" class="button"><?php _e( 'Apply Shipping', 'wpdance' ); ?></button></p>
		<p class="wd_shipping_last"><abbr class="required" title="required">*</abbr> <?php _e('required fields', 'wpdance'); ?></p>	
		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	</div>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>