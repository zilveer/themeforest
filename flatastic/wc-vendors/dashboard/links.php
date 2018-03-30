<div class="woocommerce">

	<a href="<?php echo $shop_page; ?>" class="button"><?php echo _e( 'View Your Store', 'flatastic' ); ?></a>
	<a href="<?php echo $settings_page; ?>" class="button"><?php echo _e( 'Store Settings', 'flatastic' ); ?></a>

	<?php if ( $can_submit ) { ?>
		<a target="_TOP" href="<?php echo $submit_link; ?>" class="button"><?php echo _e( 'Add New Product', 'flatastic' ); ?></a>
		<a target="_TOP" href="<?php echo $edit_link; ?>" class="button"><?php echo _e( 'Edit Products', 'flatastic' ); ?></a>
	<?php } ?>

</div>

<br>
