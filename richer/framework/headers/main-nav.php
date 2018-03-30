<?php global $options_data, $woocommerce; ?>
<ul id="nav" class="menu">
	<?php wp_nav_menu(array('theme_location' => 'main_navigation', 'container' => false, 'menu_id' => 'nav', 'items_wrap'=>'%3$s', 'fallback_cb' => false));
	if(class_exists('WooCommerce') && $options_data['woocommerce_show_cart'] == 'main_nav') { ?>
	<li class="cart-main menu-item">
		<?php if(empty($woocommerce->cart->cart_contents)): ?>
		<a class="my-cart-link" href="javascript:void(0);"></a>
		<div class="cart-contents">
		</div>
		<?php else: ?>
		<a class="my-cart-link my-cart-link-active" href="javascript:void(0);"></a>
		<div class="cart-contents">
			<?php foreach($woocommerce->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
			<div class="cart-content">
				<a href="<?php echo get_permalink($cart_item['product_id']); ?>">
				<?php echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); ?>
				<div class="cart-desc">
					<span class="cart-title"><?php echo $cart_item['data']->post->post_title; ?></span>
					<span class="product-quantity"><?php echo $cart_item['quantity']; ?> &times; <?php echo $woocommerce->cart->get_product_subtotal($cart_item['data'], $cart_item['quantity']); ?></span>
				</div>
				</a>
			</div>
			<?php endforeach; ?>
			<div class='cart-subtotal'>
				<?php $cart_subtotal = $woocommerce->cart->get_cart_subtotal();
				echo "<strong>".__('Subtotal:','richer')."</strong><span class='amount'>".$cart_subtotal."</span>"
				?>
			</div>
			<div class="cart-checkout">
				<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('View Cart', 'richer'); ?></a></div>
				<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><?php _e('Checkout', 'richer'); ?></a></div>
			</div>
		</div>
		<?php endif; ?>
	</li>
<?php } ?>
<?php if($options_data['check_searchform'] == 'main_nav') { ?>
	<li class="search-link menu-item">
		<a href="javascript:void(0);"><i class="fa fa-search"></i></a>
		<div class="search-area">
			<form action="<?php echo esc_url(home_url()); ?>/" id="header-searchform" method="get">
			        <input type="text" id="header-s" name="s" value="" autocomplete="off" />
			        <button type="submit" id="header-searchsubmit" class="button default medium"><i class="fa fa-search"></i></button>
			</form>
		</div>
	</li>
<?php } ?>
</ul>