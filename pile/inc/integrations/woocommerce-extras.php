<?php
/**
 * WooCommerce Compatibility File.
 *
 * @link https://wordpress.org/plugins/woocommerce/
 *
 * @package Pile
 * @since Pile 2.0
 */

/**
 * Declare Woocommerce support
 */
add_theme_support( 'woocommerce' );

/**
 * Assets
 */
function pile_load_woocommerce_assets() {

	// enqueue this script on all pages if the option in Customize > Theme Options > WooCommerce is checked
	if ( ! pile_option( 'enable_woocommerce_support' ) ) {
		return;
	}

	$lightbox_en = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;

	if ( $lightbox_en ) {
		wp_enqueue_style( 'woocommerce_prettyPhoto_css' );
	}

	wp_enqueue_style( 'pile-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(
		'pile-main-style'
	), pile_cachebust_string( get_template_directory() . '/assets/css/woocommerce.css' ) );

	wp_enqueue_script( 'pile-woocommerce-scripts', get_template_directory_uri() . '/assets/js/woocommerce.js', array(
		'jquery',
		'jquery-cookie',
		'wp-util'
	), pile_cachebust_string( get_template_directory() . '/assets/js/woocommerce.js' ), true );

	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );


	wc_get_template( 'single-product/add-to-cart/variation.php' );

	wp_localize_script( 'pile-woocommerce-scripts', 'wc_add_to_cart_variation_params', apply_filters( 'wc_add_to_cart_variation_params', array(
		'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ),
		'i18n_make_a_selection_text'       => esc_attr__( 'Select product options before adding this product to your cart.', 'woocommerce' ),
		'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' )
	) ) );
}
add_action( 'wp_enqueue_scripts', 'pile_load_woocommerce_assets', 9999991 );


// add woocommerce urls to djax ignore list
function pile_localize_ajax_ignored_woo_links() {

	$pile_non_ajax_links = array();
	$checkout_page_url  = get_permalink( wc_get_page_id( 'checkout' ) );
	if ( ! empty( $checkout_page_url ) ) {
		$pile_non_ajax_links[] = $checkout_page_url;
	}

	$cart_page_url = get_permalink( wc_get_page_id( 'cart' ) );
	if ( ! empty( $cart_page_url ) ) {
		$pile_non_ajax_links[] = $cart_page_url;
	}

	// now lets search all the pages that have the pile_disable_ajax_on_page active
	$args = array(
		'post_type' => 'any',
		'posts_per_page' => '-1',
		'meta_query' => array(
			array(
				'key' => 'pile_disable_ajax_on_page',
				'value' => 'on',
				'compare' => '=',
			)
		)
	);

	$posts = get_posts($args);

	if ( ! empty( $posts ) ) {
		foreach ( $posts as $nr => $post ) {
			$link = get_permalink( $post );
			if ( ! is_wp_error( $link ) && ! empty( $link ) ) {
				$pile_non_ajax_links[] = $link;
			}
		}
	}

	if ( ! empty ( $pile_non_ajax_links ) ) {
		wp_localize_script( 'pile-main-scripts', 'pile_non_ajax_links', $pile_non_ajax_links );
	}
}

add_action( 'wp_enqueue_scripts', 'pile_localize_ajax_ignored_woo_links' );

function pile_woo_change_cat_thumb_size() {
	return "small-size";
}
add_filter( 'single_product_small_thumbnail_size', 'pile_woo_change_cat_thumb_size', 9999 );

/**
 * Override the number of products with our theme option
 */
function add_woocommerce_products_per_page( $cols ) {
	return pile_option( 'woocommerce_products_numbers', 12 );
}

add_filter( 'loop_shop_per_page', 'add_woocommerce_products_per_page', 20 );

/**
 * Removing the output of product thumbnail on shop archive
 * because we manually output it
 * @hooked woocommerce_template_loop_product_thumbnail - 10
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );

// customize breadcrumb howevah
function pile_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '<span class="breadcrumb__item">',
		'after'       => '</span>',
		'home'        => _x( 'Shop', 'breadcrumb', 'pile' )
	);
}
add_filter( 'woocommerce_breadcrumb_defaults', 'pile_woocommerce_breadcrumbs' );

// change the "Home" url into the shop's one
function pile_custom_breadrumb_home_url() {
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
	if ( ! empty( $shop_page_url ) ) {
		return $shop_page_url;
	}

	return get_home_url();
}

add_filter( 'woocommerce_breadcrumb_home_url', 'pile_custom_breadrumb_home_url' );

// move the breadcrumb before title
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 3, 0 );

// we are removing the sale badge from here and display it inside the main-image wrapper
// in woocommerce/single-product/product-image.php:37
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
/**
 * Custom Add To Cart Messages
 * Add this to your theme functions.php file
 **/
function custom_archive_add_to_cart_message( $params ) {
	$params['i18n_view_cart'] = esc_attr__( 'Product Added', 'pile' );

	return $params;
}

add_filter( 'wc_add_to_cart_params', 'custom_archive_add_to_cart_message' );

function pile_add_pagination_on_shop_archive() {
	pile_the_next_prev_nav();
}
add_action( 'woocommerce_after_shop_loop', 'pile_add_pagination_on_shop_archive', 20 );

// Remove standard pagination from WooCommerce archive
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Remove Add to cart link from WooCommerce archive items
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Remove rating from shop archive
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Remove the results count on shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// remove single meta since we get the template outside the `summary` wrapper
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 15 );

// force the title to be hidden on shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

function pile_return_empty_array() {
	return array();
}
// no upsells for pile
add_filter( 'woocommerce_product_upsell_ids', 'pile_return_empty_array' );
add_filter( 'woocommerce_product_crosssell_ids', 'pile_return_empty_array' );

// no heading in additional info
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// pile doesn't need a sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// replace the original coupon form with an empty one
// and move its fields in the new desired location (which is inside the billing form)
if ( ! function_exists('pile_checkout_coupon_form') ) {
	function pile_checkout_coupon_form() {
		echo '<form id="pile-checkout-coupon-form" hidden></form>';
	}
}

if ( ! function_exists('pile_checkout_coupon_form_fields') ) {
	function pile_checkout_coupon_form_fields() {
		echo apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' ); ?>
		<div class="checkout_coupon" method="post" style="display:none">
			<p class="form-row form-row-first">
				<input type="text" name="coupon_code" form="pile-checkout-coupon-form" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
			</p>
			<p class="form-row form-row-last">
				<input type="submit" class="button" form="pile-checkout-coupon-form" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />
			</p>
		</div>
	<?php }
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_before_checkout_form', 'pile_checkout_coupon_form', 10 );
add_action( 'woocommerce_checkout_billing', 'pile_checkout_coupon_form_fields', 10 );

if ( ! function_exists( 'pile_enquiry_text' ) ) {
	function pile_enquiry_text() {
		$enquiry_text = pile_option('product_enquiry_text');
		if ( ! empty( $enquiry_text ) ) {
			echo '<div class="entry-content">' . $enquiry_text . '</div>';
		}
	}
}
add_action( 'woocommerce_after_add_to_cart_form', 'pile_enquiry_text', 10 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

/* add sharing icons on single product page */
if ( ! function_exists( 'pile_product_share' ) ) {
	function pile_product_share() {
		$product_single_show_share_links = pile_option( 'product_single_show_share_links' );
		if ( ! empty( $product_single_show_share_links ) ) { ?>
			<div class="product__sharing  js-share-icons  addthis_default_style"
			     addthis:url="<?php echo get_permalink(); ?>"
			     addthis:title="<?php wp_title( '|', true, 'right' ); ?>"
			     addthis:description="<?php echo trim( strip_tags( get_the_excerpt() ) ) ?>" >
				<?php get_template_part( 'template-parts/addthis-social-popup' ); ?>
			</div>
		<?php } else { ?>
			<div class="product__sharing"></div>
		<?php }
	}
}
add_action( 'woocommerce_share', 'pile_product_share' );

// we don't need their bad CSS
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );
	return $enqueue_styles;
}

/**
 * When WooCommerce adds a notice on a single page, let's add this class
 * @param $notice
 *
 * @return mixed
 */
function pile_woo_add_notice_classes( $notice, $product_id ){

	if ( ! empty( $product_id ) ) {

		function pile_woo_add_single_product_class( $classes ) {

			$classes[] = 'js-open-cart hide-notification';

			return $classes;
		}

		add_filter( 'body_class', 'pile_woo_add_single_product_class' );
	}
	return $notice;
}
add_filter( 'wc_add_to_cart_message', 'pile_woo_add_notice_classes', 10 ,2 );

/**
 * Add the CSS class for 3D effect of the shop or products grid, if the option is activated
 * This filter is applied only on shop or a product taxonomy page.
 * Also this function removes the 'pile_portfolio_3d_classes' filter since it does its own thing
 *
 * @param $classes
 *
 * @return array
 */
function pile_product_portfolio_3d_classes( $classes ) {

	if ( is_shop() || is_product_taxonomy() ) {
		// this filter cannot apply here since we have a separate option for this
		remove_filter( 'pile_portfolio_classes', 'pile_portfolio_3d_classes', 15 );

		$products_pile_3d_effect = pile_option( 'products_pile_3d_effect' );
		// Should we apply a drop-dead-when-you-see-it 3D effect?
		if ( empty( $products_pile_3d_effect ) ) {
			$classes[] = 'pile--no-3d';
		} else {
			$classes[] = ' pile--' . pile_option( 'products_pile_3d_target_rule' );
			$classes[] = ' pile--' . pile_option( 'products_pile_3d_target' );
		}
	}

	return $classes;
}
add_filter( 'pile_portfolio_classes', 'pile_product_portfolio_3d_classes', 10, 1 );

function pile_products_column_sizes_classes( $classes ) {

	if ( is_shop() || is_product_taxonomy() ) {
		$large_no  = pile_option( 'products_pile_large_columns' );
		//apply the default if nothing else
		if ( empty( $large_no ) ) {
			$large_no = 3;
		}
		$classes[] = 'pile-large-col-' . $large_no;

		$medium_no = pile_option( 'products_pile_medium_columns' );
		//apply the default if nothing else
		if ( empty( $medium_no ) ) {
			$medium_no = 2;
		}
		$classes[] = 'pile-medium-col-' . $medium_no;

		$small_no  = pile_option( 'products_pile_small_columns' );
		//apply the default if nothing else
		if ( empty( $small_no ) ) {
			$small_no = 1;
		}
		$classes[] = 'pile-small-col-' . $small_no;

		remove_filter( 'pile_portfolio_classes', 'pile_portfolio_column_sizes_classes', 20 );

	}

	return $classes;
}
add_filter( 'pile_portfolio_classes', 'pile_products_column_sizes_classes', 10, 1 );
