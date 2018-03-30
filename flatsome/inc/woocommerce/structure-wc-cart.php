<?php


// Move Cross sell product to under cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );


// Add Content after Cart
function flatsome_html_cart_footer(){
	$content = get_theme_mod('html_cart_footer');
    echo '<div class="cart-footer-content after-cart-content relative">'.do_shortcode($content).'</div>';
}
add_action( 'woocommerce_after_cart', 'flatsome_html_cart_footer', 99);


// Add Content in cart sidebar
function flatsome_html_cart_sidebar(){
	$content = get_theme_mod('html_cart_sidebar');
	$icons = get_theme_mod('payment_icons_placement');

    echo '<div class="cart-sidebar-content relative">'.do_shortcode($content).'</div>';
    if(is_array($icons) && in_array('cart', $icons)) echo do_shortcode('[ux_payment_icons]');
}
add_action( 'flatsome_cart_sidebar', 'flatsome_html_cart_sidebar', 10);

// Continue Shopping button
function flatsome_continue_shopping(){
?>
	<div class="continue-shopping pull-left hide-for-small text-left mr-half">
	    <a class="button-continue-shopping button primary is-outline"  href="<?php echo wc_get_page_permalink( 'shop' ); ?>">
	        &#8592; <?php echo __( 'Continue Shopping', 'woocommerce' ) ?>
	    </a>
	</div>
<?php
}
add_action('woocommerce_cart_actions', 'flatsome_continue_shopping', 10);