<?php 

//Show cart count
function ebor_ajax_cart_total( $fragments ) {
	global $woocommerce;
	ob_start();
	echo '<span class="ebor-count">'. $woocommerce->cart->get_cart_contents_count() .'</span>';
	$fragments['span.ebor-count'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'ebor_ajax_cart_total');

//Show cart total price
function ebor_ajax_cart_total_price( $fragments ) {
	global $woocommerce;
	ob_start();
	echo '<span class="number ebor-number">'. $woocommerce->cart->get_cart_total() .'</span>';
	$fragments['span.number.ebor-number'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'ebor_ajax_cart_total_price');

//Show cart contents
function ebor_ajax_cart_total_contents( $fragments ) {
	global $woocommerce;
	ob_start();
?>
	<ul class="cart-overview">
	            
        <?php foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) : ?>
        
        	<?php $_product = $cart_item['data']; ?>
        	
            <li>
                <a href="<?php echo get_permalink($cart_item['product_id']); ?>">
                    <?php echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); ?>
                    <div class="description">
                        <span class="product-title"><?php echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product); ?></span>
                        <span class="price number"><?php echo woocommerce_price($_product->get_price()); ?></span>
                    </div>
                </a>
            </li>
            
        <?php endforeach; ?>

    </ul>
<?php
	$fragments['ul.cart-overview'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'ebor_ajax_cart_total_contents');

function ebor_rating_html($count = false){

	$stars = ( round($count * 2) / 2 );
		
	$stars_html = '<ul class="list-inline foundry-star-rating">';
	
	if( 0.5 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li>';	
	} elseif( 1 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li>';	
	} elseif( 1.5 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 2 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 2.5 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 3 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 3.5 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 4 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 4.5 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	} elseif( 5 == $stars ){
		$stars_html .= '<li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li><li><i class="ti-star"></i></li>';	
	}
	
	$stars_html .= '</ul>';
	return $stars_html;
}

//Remove prettyPhoto lightbox
function ebor_remove_woo_lightbox() {
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
}
add_action( 'wp_enqueue_scripts', 'ebor_remove_woo_lightbox', 99 );

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 25 );