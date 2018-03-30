<?php global $options_data, $woocommerce; 
$layout = $options_data['topbar_blocks']['enabled'];
if ($layout && count($layout) > 1):
$numItems = count($layout);
$ind = 0; ?>
<div id="top-bar">
	<div class="container">
		<div class="span12">
			<div class="my-table">	
			<?php foreach ($layout as $key=>$value) {
				if(++$ind === $numItems && count($layout) > 2) {
					$block_last = 'block-right';
  				} else {
  					$block_last ='';
  				}
			 switch($key) {
			    case 'contact':
			    ?>
			    <div class="my-td <?php echo $block_last;?>">
					<div class="call-us">
						<ul class="unstyled">
							<?php if($options_data['contact_address'] != '') echo "<li class='address'><i class='fa fa-map-marker'></i>".apply_filters('richer_text_translate', 'contact_address', $options_data['contact_address'])."</li>"; ?>
							<?php if($options_data['contact_phone'] != '') echo "<li class='phone'><i class='fa fa-phone'></i>".$options_data['contact_phone']."</li>"; ?>
							<?php if($options_data['contact_email'] != '') echo "<li class='email'><i class='fa fa-envelope'></i><a href='mailto:".$options_data['contact_email']."'>".$options_data['contact_email']."</a></li>"; ?>
						</ul>
					</div>
				</div>
			    <?php
			    break;
			    case 'socials':
			    ?>
			    <div class="my-td <?php echo $block_last;?>"><?php get_template_part('socials');?></div>
			    <?php
			    break;
			    case 'menu': 
			    ?>
			    <div class="my-td <?php echo $block_last;?>">
				<ul id="topnav" class="menu">
					<?php wp_nav_menu(array('theme_location' => 'top_bar_navigation', 'container' => false, 'depth' => 5, 'items_wrap'=>'%3$s', 'menu_id' => 'topnav', 'fallback_cb' => false)); 
					if(class_exists('WooCommerce') && $options_data['woocommerce_show_cart'] == 'top_bar') { ?>
					<li class="cart">
						<?php if(!$woocommerce->cart->cart_contents_count): ?>
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
					<?php if($options_data['check_searchform'] == 'top_bar') { ?>
						<li id="search-link" class="search-link">
							<a href="javascript:void(0);"><i class="fa fa-search"></i></a>
							<div id="search-area" class="search-area">
								<form action="<?php echo home_url(); ?>/" id="header-searchform" method="get">
								        <input type="text" id="header-s" name="s" value="" autocomplete="off" />
								        <button type="submit" id="header-searchsubmit" class="button default medium"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</li>
					<?php } ?>
				</ul>
				</div> 
				<?php
			    break; 
			    }

			}
			?>	
			</div>
		</div>
	</div>
</div>
<?php endif; ?>