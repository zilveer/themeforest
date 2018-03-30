<?php get_header(); ?>
<div class="gdlr-content">

	<?php 
		global $gdlr_sidebar, $theme_option;
		$gdlr_sidebar = array(
			'type'=> 'no-sidebar',
			'left-sidebar'=> '', 
			'right-sidebar'=> ''
		); 
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
		
		$donator = get_option('gdlr_paypal', array());
		$our_donator = $donator[$_GET['invoice']];
		$cause_option = json_decode(gdlr_decode_preventslashes(get_post_meta($our_donator['post-id'], 'post-option', true)), true);
		if( !empty($cause_option['donation-form']) ){
				$shortcode = trim($cause_option['donation-form']);
		}
		if( empty($shortcode) ){
			$shortcode = trim($theme_option['cause-donation-form']);
		}
		$atts = shortcode_parse_atts($shortcode);
	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container">
			<div class="with-sidebar-left <?php echo esc_attr($gdlr_sidebar['outer']); ?> columns">
				<div class="with-sidebar-content <?php echo esc_attr($gdlr_sidebar['center']); ?> columns">
					<div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
<form action="" method="POST" class="gdlr-single-payment-form" id="stripe-payment-form" data-ajax="<?php echo AJAX_URL; ?>" data-invoice="<?php echo esc_attr($_GET['invoice']); ?>" >
	<p class="gdlr-form-half-left">
		<label><span><?php _e('Card Holder Name', 'gdlr'); ?></span></label>
		<input type="text" size="20" data-stripe="name"/>
	</p>
	<div class="clear" ></div>

	<p class="gdlr-form-half-left">
		<label><span><?php _e('Card Number', 'gdlr'); ?></span></label>
		<input type="text" size="20" data-stripe="number"/>
	</p>
	<div class="clear" ></div>
	
	<p class="gdlr-form-half-left">
		<label><span><?php _e('CVC', 'gdlr'); ?></span></label>
		<input type="text" size="4" data-stripe="cvc"/>
	</p>
	<div class="clear" ></div>

	<p class="gdlr-form-half-left gdlr-form-expiration">
		<label><span><?php _e('Expiration (MM/YYYY)', 'gdlr'); ?></span></label>
		<input type="text" size="2" data-stripe="exp-month"/>
		<span class="gdlr-separator" >/</span>
		<input type="text" size="4" data-stripe="exp-year"/>
	</p>
	<div class="clear" ></div>
	<div class="gdlr-form-error payment-errors" style="display: none;"></div>
	<div class="gdlr-form-loading gdlr-form-instant-payment-loading"><?php _e('Loading...', 'gdlr'); ?></div>
	<div class="gdlr-form-notice gdlr-form-instant-payment-notice"></div>
	<input type="submit" class="gdlr-form-button cyan" value="<?php _e('Submit Payment', 'gdlr'); ?>" >
</form>
<script type="text/javascript">
Stripe.setPublishableKey('<?php echo esc_js($atts['stripe_publishable_key']); ?>');

jQuery(function($){
	function stripeResponseHandler(status, response) {
		var form = $('#stripe-payment-form');

		if (response.error) {
			form.find('.payment-errors').text(response.error.message).slideDown();
			form.find('input[type="submit"]').prop('disabled', false);
			form.find('.gdlr-form-loading').slideUp();
		}else{
			// response contains id and card, which contains additional card details
			$.ajax({
				type: 'POST',
				url: form.attr('data-ajax'),
				data: {'action':'gdlr_stripe_payment','token': response.id, 'invoice': form.attr('data-invoice')},
				dataType: 'json',
				error: function(a, b, c){ 
					console.log(a, b, c); 
					form.find('.gdlr-form-loading').slideUp(); 
				},
				success: function(data){
					form.children().not('.gdlr-form-notice').slideUp();
					form.find('.gdlr-form-notice').removeClass('success failed')
						.addClass(data.status).html(data.message).slideDown();
					
					if( data.status == 'failed' ){
						form.find('input[type="submit"]').prop('disabled', false);
					}
				}
			});	
		}
	}	

	$('#stripe-payment-form').submit(function(event){
		var form = $(this);

		if( $(this).find('[data-stripe="name"]').val() == "" ){
			form.find('.payment-errors').text('<?php _e('Please fill the card holder name', 'gdlr'); ?>').slideDown();
			return false;
		}		
		
		// Disable the submit button to prevent repeated clicks
		form.find('input[type="submit"]').prop('disabled', true);
		form.find('.payment-errors, .gdlr-form-notice').slideUp();
		form.find('.gdlr-form-loading').slideDown();
		
		Stripe.card.createToken(form, stripeResponseHandler);

		// Prevent the form from submitting with the default action
		return false;
	});
});
</script>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>				
	</div>				

</div><!-- gdlr-content -->
<?php get_footer(); ?>