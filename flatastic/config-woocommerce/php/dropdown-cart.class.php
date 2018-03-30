<?php

if (!class_exists('MAD_DROPDOWN_CART')) {

	class MAD_DROPDOWN_CART {

		public $action_refresh_cart_fragment = 'refresh_cart_fragment';

		function __construct() {
			$this->add_actions();
			$this->add_filters();
		}

		public function add_actions() {

			add_action( 'wp_ajax_' . $this->action_refresh_cart_fragment, array(&$this, 'refresh_cart_fragment'));
			add_action( 'wp_ajax_nopriv_' . $this->action_refresh_cart_fragment, array(&$this, 'refresh_cart_fragment'));

		}

		public function add_filters() {
			add_filter('woocommerce_add_to_cart_fragments', array(&$this, 'add_to_cart_success_ajax'));
		}

		public function add_to_cart_success_ajax( $data ) {

			list( $cart_items, $cart_subtotal ) = self::get_current_cart_info();

			$data['count'] = $cart_items;
			$data['subtotal'] = $cart_subtotal;

			return $data;
		}

		public function refresh_cart_fragment() {
			$cart_ajax = new WC_AJAX();
			$cart_ajax->get_refreshed_fragments();
			exit();
		}

		public function get_current_cart_info() {
			global $woocommerce;

			$subtotal = WC()->cart->get_cart_subtotal();
			$items = count( $woocommerce->cart->get_cart() );

			return array( $items, $subtotal );
		}

		public static function mad_woocommerce_cart_dropdown() {

			global $wpdb, $woocommerce;
			$count = count( $woocommerce->cart->get_cart() );
			$view_cart = $woocommerce->cart->get_cart_url();

			ob_start(); ?>

			<div class="cart-holder clearfix">

				<ul class="cart-set">

					<?php if (mad_custom_get_option('show_wishlist')): ?>

						<?php if (defined('YITH_WCWL') && defined('MAD_WOO_CONFIG')):
							$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
							$wishlist_count = YITH_WCWL()->count_products();
						?>

						<li>
							<a class="count-wishlist" href="<?php echo esc_url(get_permalink($wishlist_page_id)); ?>">
								<span class="count"><?php echo $wishlist_count ?></span>
							</a>
						</li>

						<?php endif; ?>

					<?php endif; ?>

					<?php if (mad_custom_get_option('show_compare')):

						if (defined('YITH_WOOCOMPARE') && defined('MAD_WOO_CONFIG')):
							global $yith_woocompare;
							$count_compare = count($yith_woocompare->obj->products_list);
						?>
							<li class="product">
								<a class="count-compare compare added" href="<?php echo esc_url(add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() )) ?>">
									<span class="count"><?php echo $count_compare ?></span>
								</a>
							</li>
						<?php endif; ?>

					<?php endif; ?>

					<?php if (defined('ICL_LANGUAGE_CODE')): ?>
						<?php if (mad_custom_get_option('show_language')): ?>
							<li class="container3d">
								<?php echo MAD_WC_WPML_CONFIG::wpml_header_languages_list(); ?>
							</li>
						<?php endif; ?>
					<?php endif; ?>

					<?php
						$currency = '';
						if (function_exists( 'get_woocommerce_currency' )) {
							$currency = get_woocommerce_currency();
						}
					?>
					<?php if ($currency != ''): ?>
						<?php if (mad_custom_get_option('show_currency')): ?>
							<li class="container3d">
								<?php echo MAD_WC_CURRENCY_SWITCHER::output_switcher_html();  ?>
							</li>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (mad_custom_get_option('show_cart')): ?>
						<li id="shopping-button">

							<a class="shopping-button" href="<?php echo esc_url($view_cart); ?>">
								<span class="shop-icon">
									<span class="count"><?php echo esc_html($count); ?></span>
								</span>
								<b><?php echo WC()->cart->get_cart_subtotal(); ?></b>
							</a><!--/ .shopping-button-->

							<ul class="cart-dropdown" data-text="<?php _e('was added to the cart', 'flatastic') ?>">
								<li class="first-dropdown">
									<div class="widget_shopping_cart_content"></div>
								</li>
							</ul><!--/ .cart-dropdown-->

						</li>
					<?php endif; ?>

				</ul><!--/ .cart-set-->

			</div><!--/ .cart-holder-->

			<?php return ob_get_clean();
		}

		public static function mad_woocommerce_cart_dropdown_type_3() {

			global $wpdb, $woocommerce;
			$count = count( $woocommerce->cart->get_cart() );
			$view_cart = $woocommerce->cart->get_cart_url();

			ob_start(); ?>

			<div class="cart-holder clearfix">

				<ul class="cart-set">

					<?php if (mad_custom_get_option('show_wishlist')): ?>

						<?php if (defined('YITH_WCWL') && defined('MAD_WOO_CONFIG')):
							$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
							$wishlist_count = YITH_WCWL()->count_products();
							?>

							<li>
								<a class="count-wishlist" href="<?php echo esc_url(get_permalink($wishlist_page_id)); ?>">
									<span class="count"><?php echo $wishlist_count ?></span>
								</a>
							</li>

						<?php endif; ?>

					<?php endif; ?>

					<?php if (mad_custom_get_option('show_compare')):

						if (defined('YITH_WOOCOMPARE') && defined('MAD_WOO_CONFIG')):
							global $yith_woocompare;
							$count_compare = count($yith_woocompare->obj->products_list);
							?>
							<li class="product">
								<a class="count-compare compare added" href="<?php echo esc_url(add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() )) ?>">
									<span class="count"><?php echo $count_compare ?></span>
								</a>
							</li>
						<?php endif; ?>

					<?php endif; ?>

					<?php if (mad_custom_get_option('show_cart')): ?>
						<li id="shopping-button">

							<a class="shopping-button" href="<?php echo esc_url($view_cart); ?>">
								<span class="shop-icon">
									<span class="count"><?php echo esc_html($count); ?></span>
								</span>
								<b><?php echo WC()->cart->get_cart_subtotal(); ?></b>
							</a><!--/ .shopping-button-->

							<ul class="cart-dropdown" data-text="<?php _e('was added to the cart', 'flatastic') ?>">
								<li class="first-dropdown">
									<div class="widget_shopping_cart_content"></div>
								</li>
							</ul><!--/ .cart-dropdown-->

						</li>
					<?php endif; ?>

				</ul><!--/ .cart-set-->

			</div><!--/ .cart-holder-->

			<?php return ob_get_clean();
		}

	}

	new MAD_DROPDOWN_CART();

}


