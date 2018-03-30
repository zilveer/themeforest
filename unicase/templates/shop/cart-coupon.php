<?php if ( WC()->cart->coupons_enabled() ) { ?>
<div class="cart_coupons">
	<div class="panel panel-default">
		<div class="panel-heading transparent-bg">
		    <h3 class="panel-title"><?php esc_html_e( 'Discount Code', 'unicase' ); ?></h3>
		    <p><?php esc_html_e( 'Enter your coupon code if you have one.', 'unicase' ); ?>
		</div>
		
		<div class="panel-body">
			<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
				<div class="coupon">
	                <div class="form-group">
	                	<label class="sr-only" for="coupon_code">Coupon:</label>
					    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Your Coupon..', 'unicase' ); ?>" />
					</div> 

				     <div class="clearfix">
	                 	<div class="pull-right flip">
						    <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'unicase' ); ?>" />
						    <?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					</div>
				</div>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</form>
		</div>
	</div>
</div>
<?php } ?>