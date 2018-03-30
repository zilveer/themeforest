<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

?>
<div class="coupon-env">
	<a class="coupon-enter pull-right-md" href="#">
		<?php _e('Enter Coupon <span>To get discounts</span>', 'aurum'); ?>
	</a>

	<div class="coupon">

		<?php if( ! is_cart()): ?>
		<form id="coupon-form-checkout" method="post">
		<?php endif; ?>

		<a href="#" class="close-coupon">&times;</a>

		<input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'aurum' ); ?>" />
		<input type="submit" class="button btn btn-primary" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'aurum' ); ?>" />

		<?php do_action('woocommerce_cart_coupon'); ?>

		<?php if( ! is_cart()): ?>
		</form>
		<?php endif; ?>
	</div>
</div>


<?php # start: modified by Arlind Nushi ?>
<?php if( ! is_cart()): ?>
<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		
		jQuery( '#coupon-form-checkout' ).on( 'submit', function( e ) {
			var $form = $( this );
	
			if ( $form.is( '.processing' ) ) return false;
	
			$form.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});
	
			var data = {
				action:			'woocommerce_apply_coupon',
				security:		wc_checkout_params.apply_coupon_nonce,
				coupon_code:	$form.find( 'input[name=coupon_code]' ).val()
			};
	
			$.ajax({
				type:		'POST',
				url:		wc_checkout_params.ajax_url,
				data:		data,
				success:	function( code ) {
					$( '.woocommerce-error, .woocommerce-message' ).remove();
					$form.removeClass( 'processing' ).unblock();
	
					if ( code ) {
						
						$( '.page-title' ).before( code );
						
						$( '.coupon-env' ).removeClass( 'coupon-visible' );
	
						$( 'body' ).trigger( 'update_checkout' );
					}
				},
				dataType: 'html'
			});
	
			return false;
		} );
	} );
	
</script>
<?php endif; ?>
<?php # end: modified by Arlind Nushi ?>