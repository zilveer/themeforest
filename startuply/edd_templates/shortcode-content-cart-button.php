	<div class="item-link-full-wrapper">
		<a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-sm btn-no-border base_clr_txt item-link-full">READ MORE</a>
	</div>

	<div class="item-link-buy-wrapper">
	<?php 
	global $edd_options;
	
	$button_text = (empty($edd_options['add_to_cart_text']) ? 'Add to cart' : $edd_options[ 'add_to_cart_text' ]);
	
	if ( ! edd_has_variable_prices( get_the_ID() ) ) {
		$text = edd_get_purchase_link(array(
			'download_id' => get_the_ID()));
		echo edd_get_purchase_link( array(
			'download_id' => get_the_ID(),
			'class' => 'btn btn-sm btn-solid base_clr_bg item-link-buy',
			'text' => '<span class="icon icon-shopping-18"></span>'.$button_text,
			'price' => (bool)false ) );
	} ?>
	</div>

