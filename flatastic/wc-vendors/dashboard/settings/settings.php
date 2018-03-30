<div class="wcv-form">

	<h2><?php _e( 'Settings', 'flatastic' ); ?></h2>

	<?php if ( function_exists( 'wc_print_notices' ) ) { wc_print_notices(); } ?>

	<form method="post">

		<div class="col2-set clearfix">

			<div class="col-2">

				<?php do_action( 'wcvendors_settings_before_paypal' ); ?>

				<?php
					if ( $paypal_address !== 'false' ) {
						wc_get_template( 'paypal-email-form.php', array(
							'user_id' => $user_id,
						), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );
					}

					do_action( 'wcvendors_settings_after_paypal' );
				?>

			</div>

			<div class="col-2">

				<?php
					wc_get_template( 'shop-name.php', array(
						'user_id' => $user_id,
					), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );

					do_action( 'wcvendors_settings_after_shop_name' );
				?>

			</div>

		</div>

		<div class="col-2">

			<?php
				wc_get_template( 'seller-info.php', array(
					'global_html' => $global_html,
					'has_html'    => $has_html,
					'seller_info' => $seller_info,
				), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );

				do_action( 'wcvendors_settings_after_seller_info' );
			?>

		</div>

		<div class="col-2">

			<?php
			if ( $shop_description !== 'false' ) {
				wc_get_template( 'shop-description.php', array(
					'description' => $description,
					'global_html' => $global_html,
					'has_html'    => $has_html,
					'shop_page'   => $shop_page,
					'user_id'     => $user_id,
				), 'wc-vendors/dashboard/settings/', wcv_plugin_dir . 'templates/dashboard/settings/' );

				do_action( 'wcvendors_settings_after_shop_description' );
			}
			?>

		</div>

		<?php wp_nonce_field( 'save-shop-settings', 'wc-product-vendor-nonce' ); ?>

		<input type="submit" class="btn btn-inverse btn-small" style="float:none;" name="vendor_application_submit"  value="<?php _e( 'Save', 'flatastic' ); ?>"/>

	</form>

</div>