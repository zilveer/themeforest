<?php global $data, $woocommerce, $current_user; ?>
<div class="myaccount_user">
	<h4 class="username">
	<?php
	printf(
		__( 'Hello, %s:', 'richer' ),
		$current_user->display_name
	);
	?>
	</h4>
	<?php if($data['woo_acc_msg_1']): ?>
	<p class="msg">
		<?php echo $data['woo_acc_msg_1']; ?>
	</p>
	<?php endif; ?>
	<?php if($data['woo_acc_msg_2']): ?>
	<p class="msg">
		<?php echo $data['woo_acc_msg_2']; ?>
	</p>
	<?php endif; ?>
	<p class="view-cart">
		<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" class="button medium default"><i class="icon fa fa-shopping-cart"></i> <?php _e('View Cart','richer');?></a>
	</p>
</div>