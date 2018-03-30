<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/cart/shipping-calculator.php
 * @sub-package WooCommerce/Templates/cart/shipping-calculator.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php 
	if ( get_option('woocommerce_enable_shipping_calc')=='no' || ! $woocommerce->cart->needs_shipping() ) return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="shipping_calculator" action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
	<h3><em class="icon-th-grid"></em> <a href="#" class="shipping-calculator-button"><?php _e('Calculate Shipping', 'woocommerce'); ?> <em class="icon-down-open"></em></a></h3>
	<section class="shipping-calculator-form">
		<div class="six columns mobile-two">
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
				<option value=""><?php _e('Select a country&hellip;', 'woocommerce'); ?></option>
				<?php
					foreach( $woocommerce->countries->get_allowed_countries() as $key => $value )
						echo '<option value="' . $key . '"' . selected( $woocommerce->customer->get_shipping_country(), $key, false ) . '>' . $value . '</option>';
				?>
			</select>
		</div>
		<div class="six columns mobile-two">
			<?php
				$current_cc = $woocommerce->customer->get_shipping_country();
				$current_r = $woocommerce->customer->get_shipping_state();

				$states = $woocommerce->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {

					// Hidden
					?>
					<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" />
					<?php

				} elseif ( is_array( $states ) ) {

					// Dropdown
					?>
					<span>
						<select name="calc_shipping_state" id="calc_shipping_state"><option value=""><?php _e('Select a state&hellip;', 'woocommerce'); ?></option><?php
							foreach ( $states as $ckey => $cvalue )
								echo '<option value="' . $ckey . '" '.selected( $current_r, $ckey, false ) .'>' . $cvalue .'</option>';
						?></select>
					</span>
					<?php

				} else {

					// Input
					?>
					<input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e('State', 'woocommerce'); ?>" name="calc_shipping_state" id="calc_shipping_state" />
					<?php

				}
			?>
		</div>
		<div class="six columns mobile-two">
		<input type="text" class="input-text" value="<?php echo esc_attr( $woocommerce->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e('Postcode/Zip', 'woocommerce'); ?>" title="<?php _e('Postcode', 'woocommerce'); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
		</div>
		<div class="six columns mobile-two">
		<button type="submit" name="calc_shipping" value="1" class="button info"><?php _e('Update Totals', 'woocommerce'); ?></button>
		<?php $woocommerce->nonce_field('cart') ?>
		</div>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
