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

if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() )
	return;
?>
<div class="col-lg-7 col-md-7 col-sm-6">
<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="shipping_calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

	<h3 class="animate-onscroll"><?php _e( 'Calculate Shipping', 'candidate' ); ?></h3>

	<section class="shipping-calculator-form" >

		
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state chosen-select" rel="calc_shipping_state">
				<option value=""><?php _e( 'Select a country&hellip;', 'candidate' ); ?></option>
				<?php
					foreach( WC()->countries->get_shipping_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				?>
			</select>
		
		
		<div class="row inline-inputs">
		
		

		<div class="col-lg-6 col-md-6 col-sm-6">
			<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );

				// Hidden Input
				if ( is_array( $states ) && empty( $states ) ) {

					?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'candidate' ); ?>" /><?php

				// Dropdown Input
				} elseif ( is_array( $states ) ) {

					?>
						<select  name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'candidate' ); ?>">
							<option value=""><?php _e( 'Select a state&hellip;', 'candidate' ); ?></option>
							<?php
								foreach ( $states as $ckey => $cvalue )
									echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' .  esc_html( $cvalue ) .'</option>';
							?>
						</select>
					<?php

				// Standard Input
				} else {

					?><input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e( 'State / county', 'candidate' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php

				}
			?>
		</div>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

			<div class="col-lg-6 col-md-6 col-sm-6">
				<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'candidate' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</div>

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

			<div class="col-lg-6 col-md-6 col-sm-6">
				<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e( 'Postcode / Zip', 'candidate' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</div>

		<?php endif; ?>

		
		</div>
		
		
		
		
		<button type="submit" name="calc_shipping" value="1" class="button"><?php _e( 'Update Totals', 'candidate' ); ?></button>

		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
</div>

