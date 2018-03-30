<?php
class HashmagMikadoWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'mkdf_woocommerce_dropdown_cart', // Base ID
			'Mikado Woocommerce Dropdown Cart', // Name
			array( 'description' => esc_html__( 'Mikado Woocommerce Dropdown Cart', 'hashmag' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		
		global $woocommerce; 
		global $hashmag_options;
		
		$cart_style = 'mkdf-with-icon';
		
		?>
		<div class="mkdf-shopping-cart-outer">
			<div class="mkdf-shopping-cart-inner">
				<div class="mkdf-shopping-cart-header">
					<a class="mkdf-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
						<span class="mkdf-cart-no"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
						<i class="icon_cart_alt"></i>
					</a>
					<div class="mkdf-shopping-cart-dropdown">
						<?php
						$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
						$list_class = array( 'mkdf-cart-list', 'product_list_widget' );
						?>
						<ul>

							<?php if ( !$cart_is_empty ) : ?>

								<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

									$_product = $cart_item['data'];

									// Only display if allowed
									if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
										continue;
									}

									// Get price
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
									?>


									<li>
										<div class="mkdf-item-image-holder">
											<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
												<?php echo wp_kses($_product->get_image(), array(
													'img' => array(
														'src' => true,
														'width' => true,
														'height' => true,
														'class' => true,
														'alt' => true,
														'title' => true,
														'id' => true
													)
												)); ?>
											</a>
										</div>
										<div class="mkdf-item-info-holder">
											<div class="mkdf-item-left">
												<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'])); ?>">
													<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
												</a>
												<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
											</div>
											<div class="mkdf-item-right">
												<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon_close"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'hashmag') ), $cart_item_key ); ?>

											</div>
										</div>
									</li>

								<?php endforeach; ?>
								<div class="mkdf-cart-bottom">
									<div class="mkdf-subtotal-holder clearfix">
										<span class="mkdf-total"><?php esc_html_e( 'Subtotal', 'hashmag' ); ?>:</span>
										<span class="mkdf-total-amount">
											<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
												'span' => array(
													'class' => true,
													'id' => true
												)
											)); ?>
										</span>
									</div>
									<div class="mkdf-btns-holder clearfix">
										<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="mkdf-btn mkdf-btn-solid mkdf-btn-large view-cart"><?php esc_html_e( 'View Cart', 'hashmag' ); ?></a>
										<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="mkdf-btn mkdf-btn-solid mkdf-btn-large checkout"><?php esc_html_e( 'Checkout', 'hashmag' ); ?></a>
									</div>
								</div>
							<?php else : ?>

								<li class="mkdf-empty-cart"><?php esc_html_e( 'No products in the cart.', 'hashmag' ); ?></li>

							<?php endif; ?>

						</ul>
						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
						

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "HashmagMikadoWoocommerceDropdownCart" );' ) );
?>
<?php
add_filter('add_to_cart_fragments', 'hashmag_mikado_woocommerce_header_add_to_cart_fragment');
function hashmag_mikado_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>
	<div class="mkdf-shopping-cart-header">
		<a class="mkdf-header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
			<span class="mkdf-cart-no"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
			<i class="icon_cart_alt"></i>
		</a>		
		<div class="mkdf-shopping-cart-dropdown">
			<?php
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
			//$list_class = array( 'mkdf-cart-list', 'product_list_widget' );
			?>
			<ul>

				<?php if ( !$cart_is_empty ) : ?>

					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

						$_product = $cart_item['data'];

						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}

						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
						?>

						<li>
							<div class="mkdf-item-image-holder">
								<?php echo wp_kses($_product->get_image(), array(
									'img' => array(
										'src' => true,
										'width' => true,
										'height' => true,
										'class' => true,
										'alt' => true,
										'title' => true,
										'id' => true
									)
								)); ?>
							</div>
							<div class="mkdf-item-info-holder">
								<div class="mkdf-item-left">
									<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
										<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
									</a>
									<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
								</div>
								<div class="mkdf-item-right">
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon_close"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'hashmag') ), $cart_item_key ); ?>

								</div>
							</div>
						</li>

					<?php endforeach; ?>
						<div class="mkdf-cart-bottom">
							<div class="mkdf-subtotal-holder clearfix">
								<span class="mkdf-total"><?php esc_html_e( 'Subtotal', 'hashmag' ); ?>:</span>
								<span class="mkdf-total-amount">
									<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
										'span' => array(
											'class' => true,
											'id' => true
										)
									)); ?>
								</span>
							</div>
							<div class="mkdf-btns-holder clearfix">
								<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="mkdf-btn mkdf-btn-solid mkdf-btn-large view-cart">
									<?php esc_html_e( 'View Cart', 'hashmag' ); ?>
								</a>
								<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="mkdf-btn mkdf-btn-solid mkdf-btn-large checkout">
									<?php esc_html_e( 'Checkout', 'hashmag' ); ?>
								</a>
							</div>
						</div>
				<?php else : ?>

					<li class="mkdf-empty-cart"><?php esc_html_e( 'No products in the cart.', 'hashmag' ); ?></li>

				<?php endif; ?>

			</ul>
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
			

			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
		</div>
	</div>

	<?php
	$fragments['div.mkdf-shopping-cart-header'] = ob_get_clean();
	return $fragments;
}
?>