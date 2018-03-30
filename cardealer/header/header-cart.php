<?php if ( class_exists('woocommerce') && tmm_show_header_cart() ) { ?>

	<div  class="header-cart">
		<a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="icon-basket"></a>
		<span class="cart-products-count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>

		<?php if(!is_cart() && !is_checkout()){ ?>
		<div class="woocommerce cart-content">
			<?php
			$title = TMM::get_option('tmm_cart_widget_title');
			the_widget( 'WC_Widget_Cart', array('title' => esc_html($title), 'hide_if_empty' => true) );
			?>
		</div>
		<?php } ?>

	</div><!-- .header-cart-->

<?php } ?>