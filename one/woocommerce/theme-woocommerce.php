<?php

/**
 * Load custom script for the WooCommerce customization
 */

thb_theme()->getFrontend()->addScript( get_template_directory_uri() . '/woocommerce/js/thb-theme-woocommerce.js' );

if( !function_exists('thb_woocommerce_body_classes') ) {
	/**
	 * THB custom body classes
	 */
	function thb_woocommerce_body_classes( $classes ) {
		return $classes;
	}

	add_filter('body_class', 'thb_woocommerce_body_classes');
}

/**
 * Change the before and after WooCommerce hooks
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_woocommerce_theme_before_content') ) {
	function thb_woocommerce_theme_before_content() { ?>
		<?php thb_page_before(); ?>
			<div id="page-content">
				<?php thb_page_start(); ?>
					<?php
						$page_title = null;
						$page_subtitle = null;
						$show_featured_image = null;

						if ( is_shop() || is_tax() ) {
							$page_title = thb_woo_get_page_title();
							$show_featured_image = false;
						}
						if ( is_tax() ) {
							$page_subtitle = __( 'Category', 'thb_text_domain' );
						}
						if ( is_product() ) {
							add_filter( 'thb_pageheader_disable', '__return_true' );
							$show_featured_image = false;
						}
					?>
					<?php thb_get_template_part('partials/partial-pageheader', array( 'thb_title' => $page_title, 'thb_subtitle' => $page_subtitle, 'show_featured_image' => $show_featured_image ) ); ?>

					<div class="thb-section-container">
						<div id="main-content">
	<?php }
}

if( !function_exists('thb_woocommerce_theme_after_content') ) {
	function thb_woocommerce_theme_after_content() { ?>
							</div><!-- /#main-content -->

					<?php if ( is_shop() || is_tax() ) : ?>
						<?php thb_page_sidebar(); ?>
					<?php endif; ?>

					</div><!-- /.thb-section-container -->
				<?php thb_page_end(); ?>
			</section><!-- /#page-content -->
		<?php thb_page_after(); ?>
	<?php }
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_filter( 'woocommerce_before_main_content', 'thb_woocommerce_theme_before_content', 10 );
add_filter( 'woocommerce_after_main_content', 'thb_woocommerce_theme_after_content', 20 );

/**
 * Remove the Shop default page title in the page content
 * -----------------------------------------------------------------------------
 */
add_filter('woocommerce_show_page_title', '__return_false', 99);

/**
 * Shop loop product wrapping
 * -----------------------------------------------------------------------------
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

if( !function_exists('thb_loop_product_start') ) {
	function thb_loop_product_start() {
		global $product;

		if ( $product->is_in_stock() ) {
			woocommerce_show_product_loop_sale_flash();
		}
		echo "<div class='thb-product-image-wrapper item-thumb'>";
			if ( ! $product->is_in_stock() ) {
				echo "<span class='thb-out-of-stock'>";
					_e('Out of stock', 'woocommerce');
				echo "</span>";
			}

			echo "<a href='". get_permalink() ."'>";
				woocommerce_template_loop_product_thumbnail();

				woocommerce_template_loop_rating();

				woocommerce_template_loop_add_to_cart();
			echo "</a>";
		echo "</div>";
		echo "<div class='thb-product-description'>";
	}

	add_action( 'woocommerce_before_shop_loop_item', 'thb_loop_product_start', 999 );
}
if( !function_exists('thb_loop_product_end') ) {
	function thb_loop_product_end() {
			global $post, $product;
			$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			echo $product->get_categories( ', ', '<span class="posted_in">' . _n( '', '', $size, 'woocommerce' ) . ' ', '</span>' );

			echo '<div class="thb-add-to-cart-wrapper">';
				woocommerce_template_loop_price();
			echo "</div>";
		echo "</div>";
	}

	add_action( 'woocommerce_after_shop_loop_item', 'thb_loop_product_end', 999 );
}

/**
 * Cart
 * -----------------------------------------------------------------------------
 */

if( !function_exists('thb_woocommerce_cross_sells_columns_number') ) {
	function thb_woocommerce_cross_sells_columns_number() {
		return 3;
	}

	add_filter( 'woocommerce_cross_sells_columns', 'thb_woocommerce_cross_sells_columns_number' );
}

/**
 * Single product
 * -----------------------------------------------------------------------------
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_description_panel', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product_summary', 'thb_woocommerce_output_related_products', 20 );

if( !function_exists('thb_single_product_summary') ) {
	function thb_single_product_summary() {
		?>
		<div class="thb-product-header">
			<?php
				thb_pagination();
				woocommerce_breadcrumb();
				woocommerce_template_single_title();
				woocommerce_template_loop_rating();
				woocommerce_template_single_price();
			?>
		</div>
		<div class="thb-product-description">
			<?php
				woocommerce_template_single_excerpt();
				woocommerce_template_single_add_to_cart();
			?>
		</div>
		<?php
	}

	add_action('woocommerce_single_product_summary', 'thb_single_product_summary');
}

/**
 * Cart
 * -----------------------------------------------------------------------------
 */

if( !function_exists('thb_mini_cart_fragments') ) {
	function thb_mini_cart_fragments( $fragments ) {
		global $woocommerce;

		$cart_class = '';

		if( sizeof($woocommerce->cart->cart_contents) > 0 ) {
			$cart_class = 'minicart-full';
		}

		$fragments['.thb-product-numbers'] = "<span class='thb-product-numbers " . $cart_class . "'>" . $woocommerce->cart->cart_contents_count . "</span>";

		return $fragments;
	}

	add_filter('add_to_cart_fragments', 'thb_mini_cart_fragments');
}

if( !function_exists('thb_woo_cart') ) {
	function thb_woo_cart() {
		global $woocommerce, $cart_class;

		echo "<div class='thb-mini-cart-icon-wrapper'>";
			echo "<div class='thb-mini-cart-icon ". $cart_class ."'>";
				echo "<a href='" . $woocommerce->cart->get_cart_url() . "' id='thb-cart-trigger'><span class='thb-product-numbers'>" . $woocommerce->cart->cart_contents_count . "</span>Cart</a>";
				echo "<div class='thb_mini_cart_wrapper'>";
					echo "<div class='widget_shopping_cart_content'>";
						woocommerce_mini_cart();
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	}
}

if( !function_exists('thb_cart_fix') ) {
	function thb_cart_fix() {
		echo "<div class='thb-cart-fix'></div>";
	}
}

if( !function_exists('thb_woo_cart_actions') ) {
	function thb_woo_cart_actions(  ) {
		if ( thb_get_logo_position() == 'logo-left' ) {
			add_action( 'thb_nav_after', 'thb_woo_cart', 20 );
		} else {
			add_action( 'thb_nav_before', 'thb_woo_cart' );
		}
	}

	add_action( 'wp_head', 'thb_woo_cart_actions' );
}

if( ! function_exists('thb_woo_cart_content') ) {
	function thb_woo_cart_content( $classes ) {
		global $woocommerce;

		if( sizeof( $woocommerce->cart->get_cart() ) == 0 ) {
			$classes[] = 'thb-woocommerce-cartempty';
		}

		return $classes;
	}

	add_filter('body_class', 'thb_woo_cart_content');
}

if( !function_exists('thb_order_button_custom') ) {
	function thb_order_button_custom(  ) {
		$order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) );

		return '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_attr( $order_button_text ) . '</button>';
	}

	add_filter( 'woocommerce_order_button_html', 'thb_order_button_custom' );
}

remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 10 );