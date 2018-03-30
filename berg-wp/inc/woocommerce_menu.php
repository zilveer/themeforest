<div class="visible-xs visible-sm col-md-12 woocommerce-mobile-menu">
<?php
global $woocommerce;
$before = $after = '';
if (has_nav_menu('woocommerce')) {
	wp_nav_menu( array(
		'theme_location' => 'woocommerce',
		'walker'         => new Walker_Nav_Menu_Dropdown(),
		'items_wrap'     => '<div class="mobile-menu select-btn"><form><select onchange="if (this.value) window.location.href=this.value"><option>'.__('Navigation', 'BERG').'</option>%3$s</select></form></div>',
	) );
}

$args = array(
	'taxonomy'     => 'product_cat',
	'orderby'      => 'name',
	'show_count'   => 0,
	'pad_counts'   => 0,
	'hierarchical' => 1,
	'title_li'     => '',
	'hide_empty'   => 1
);

$all_categories = get_categories($args);

echo '<div class="mobile-menu select-btn">';

if (is_shop()) {
	// onchange="jQuery(\'.mixitup\').mixItUp(\'filter\', this.value)"
	echo '<select class="filter" onchange="jQuery(this.value).velocity(\'scroll\', { offset: -80})">';
	echo "\n<option value=\"all\">".__('Show all', 'BERG')."</option>\n";
} else {
	echo '<select onchange="if (this.value) window.location.href=this.value">';
	echo "\n<option value=\"".get_permalink(woocommerce_get_page_id('shop'))."\">".__('Show all', 'BERG')."</option>\n";
}

foreach ($all_categories as $cat) {
	if ($cat->category_parent == 0) {
		if (is_shop()) {
			echo "\n<option value=\".category-".$cat->term_id."\">".$cat->name."</option>\n";
		} else {
			echo "\n<option value=\"".get_permalink(woocommerce_get_page_id('shop'))."#category-".$cat->term_id."\">".$cat->name."</option>\n";
		}
	}
}

echo '</select></div>';
?>

	<div class="mobile-menu select-btn"><a class="btn btn-dark col-xs-12 " href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php echo __('View Cart', 'woocommerce');?></a></div>
</div>
<?php if(YSettings::g('woocommerce_sticky_category') == 1) { $sticky_class = 'filter-sticky'; } else { $sticky_class = ''; } ;?>
<div class="woo-fixed list-category-wrapper hidden-xs hidden-sm <?php echo $sticky_class ;?>">
<?php

if (has_nav_menu('woocommerce')) {
	if(YSettings::g('woocommerce_filters') == 1) {
		// if (is_shop()) {
		// 	$before = "\n<li><span class=\"filter\" data-filter=\"all\">".__('Show all', 'BERG')."</span></li>\n";
		// } else {
		// 	$before = "\n<li><span class=\"filter\" data-filter=\"all\"><a href=\"".get_permalink(woocommerce_get_page_id('shop'))."\">".__('Show all', 'BERG')."</a></span></li>\n";
		// }

		$before = '';
		if (is_shop()) {
			foreach ($all_categories as $cat) {
				if ($cat->category_parent == 0) {
					$before .= "\n<li><span class=\"filter\" data-filter=\".category-".$cat->term_id."\">".$cat->name."</span></li>\n";
				}
			}
		} else {

			foreach ($all_categories as $cat) {
				if ($cat->category_parent == 0) {
					$before .= "\n<li><span class=\"product-filter-link filter\" data-filter=\".category-".$cat->term_id."\"><a href=\"".get_post_type_archive_link('product')."#category-".$cat->term_id."\">".$cat->name."</a></span></li>\n";
					// print_r(get_term($cat));
					// print_r(get_post_type_archive_link('product'));
				}
			}	
		}
		$before .= "<li class=\"shop-list\"><ul>";

		$after = '';

		global $woocommerce;
	}

	// Add dynamic cart menu on end

	if (YSettings::g("woocommerce_dynamic_cart", "1") == "1") {
		$after .= '<li class="shopping-cart"><a href="'.$woocommerce->cart->get_cart_url().'" class="cart">'.__('Cart', 'BERG').' <span class="shipping-cart-count">'.$woocommerce->cart->cart_contents_count.'</span></a>';
		$after .= '<ul class="show-cart">';
	
		if ( sizeof( $woocommerce->cart->cart_contents ) == 0 ) {
			$after .= '<li class="product">'. __( 'Your cart is currently empty.', 'BERG').'</li>';
		} else {
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ($_product->is_sold_individually()) {
					$product_quantity = "1";
				} else {
					$product_quantity = $cart_item['quantity'];
				}

				$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($_product->id), 'menu_thumb' );
				
				if(empty($thumb_url)) {
					$thumb_url = THEME_DIR_URI.'/img/placeholder.png';
				} else {
					$thumb_url = $thumb_url[0];
				}
				$after .= '<li class="product">
					<a href="'.$_product->get_permalink().'" class="img-product">
						<figure><img src="'.$thumb_url.'" alt="" /></figure>
					</a>

					<div class="list-product">
						<a href="' . $_product->get_permalink() . '"><h5>' . $_product->get_title() . '</h5></a>
						<div class="quantity buttons_added header-font-family">' . $product_quantity . '</div>
						<div class="price-product header-font-family">' . strip_tags(WC()->cart->get_product_price( $_product )) . '</div>
						<a class="remove-product" title="'.__( 'Remove this item', 'BERG').'" href="'.esc_url( WC()->cart->get_remove_url( $cart_item_key ) ).'"><i class="icon-close"></i></a>
					</div>
				</li>';
			}

			// subtotal
			global $woocommerce;
			$cart_url = $woocommerce->cart->get_cart_url();
			$checkout_url = $woocommerce->cart->get_checkout_url();

			$after .= '<li class="summation">
				<div class="summation-subtotal">
					<span>'.__('Subtotal', 'woocommerce').':</span>
					<span class="amount header-font-family">' . WC()->cart->get_cart_subtotal() . '</span>
				</div>
				<div class="btn-cart">
					<a class="btn btn-sm btn-default" href="'.$cart_url.'">'.__('View Cart', 'woocommerce').'</a>
					<a class="btn btn-sm btn-dark" href="'.$checkout_url.'">'.__('Checkout', 'woocommerce').'</a>
				</div>
			</li>';
			}
		$after .= '</ul></li>';
	}

	$after .= "</ul></li>";

	$woomenu = wp_nav_menu(array(
		'theme_location'  => 'woocommerce',
		'menu'            => '',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'list-category menu',
		'menu_id'         => '',
		'echo'            => false,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s hidden-xs hidden-sm">[::BEFORE::]%3$s[::AFTER::]</ul>',
		'depth'           => 1,
		'walker'          => new Woocommerce_Menu()
	));

	$woomenu = str_replace('[::BEFORE::]', $before, $woomenu);
	$woomenu = str_replace('[::AFTER::]', $after, $woomenu);
	

	echo $woomenu;
	
	

} ?>
</div>
