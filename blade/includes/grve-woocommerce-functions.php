<?php

/*
*	Woocommerce helper functions and configuration
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Helper function to check if woocommerce is enabled
 */
function blade_grve_woocommerce_enabled() {

	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;

}

function blade_grve_is_woo_shop() {
	if ( blade_grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		return true;
	}
	return false;
}

function blade_grve_is_woo_tax() {
	if ( blade_grve_woocommerce_enabled() && is_product_taxonomy() ) {
		return true;
	}
	return false;
}

function blade_grve_is_woo_category() {
	if ( blade_grve_woocommerce_enabled() && is_product_category() ) {
		return true;
	}
	return false;
}

function blade_grve_is_woo_tag() {
	if ( blade_grve_woocommerce_enabled() && is_product_tag() ) {
		return true;
	}
	return false;
}




//If woocomerce plugin is not enabled return
if ( !blade_grve_woocommerce_enabled() ) {
	return false;
}

//Add Theme support for woocommerce
add_theme_support( 'woocommerce' );

/**
 * Helper function to get shop custom fields with fallback
 */
function blade_grve_post_meta_shop( $id, $fallback = false ) {
	$post_id = wc_get_page_id( 'shop' );
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

/**
 * Helper function to skin Product Search
 */
function blade_grve_woo_product_search( $form ) {
	$new_custom_id = uniqid( 'grve_product_search_' );
	$form =  '<form class="grve-search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn grve-custom-btn"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield" id="' . esc_attr( $new_custom_id ) . '" value="' . get_search_query() . '" name="s" placeholder="' . esc_attr__( 'Search for ...', 'blade' ) . '" />';
	$form .= '  <input type="hidden" name="post_type" value="product" />';
	$form .= '</form>';
	return $form;
}

/**
 * Helper function to notify about Shop Pages in Admin Pages
 */
function blade_grve_woo_admin_notice() {
	global $post;

	$woo_page_found = false;
	$notify_out = '';

	$woo_page_ids = array(
		'shop' => wc_get_page_id( 'shop' ),
		'cart' => wc_get_page_id( 'cart' ),
		'checkout' => wc_get_page_id( 'checkout' ),
		'myaccount' => wc_get_page_id( 'myaccount' ),
	);

	if ( isset( $post->ID ) ) {
		$current_page_id = $post->ID;
		$woo_page_found = in_array( $current_page_id, $woo_page_ids );
	}

	if ( $woo_page_found  ) {
		$notify_out .= '<div class="updated">';
		$notify_out .= '  <p>';

		if ( $current_page_id == $woo_page_ids['shop'] ) {
			$notify_out .= esc_html__( 'This page is assigned from WooCommerce: Product Archive / Shop Page', 'blade' );
		} else if ( $current_page_id == $woo_page_ids['cart'] ) {
			$notify_out .= esc_html__( 'This page is assigned from WooCommerce: Cart Page', 'blade' );
		} else if ( $current_page_id == $woo_page_ids['checkout'] ) {
			$notify_out .= esc_html__( 'This page is assigned from WooCommerce: Checkout Page', 'blade' );
		} else if ( $current_page_id == $woo_page_ids['myaccount'] ) {
			$notify_out .= esc_html__( 'This page is assigned from WooCommerce: My Account Page', 'blade' );
		}

		$notify_out .= '  </p>';
		$notify_out .= '</div>';
	}

	echo wp_kses_post( $notify_out );
}
add_action( 'admin_notices', 'blade_grve_woo_admin_notice' );

/**
 * Helper function to update cart count on header icon via ajax
 */

function blade_grve_woo_mini_cart( $args = array() ) {

	$defaults = array(
		'list_class' => ''
	);

	$args = wp_parse_args( $args, $defaults );

	wc_get_template( 'cart/grve-mini-cart.php', $args );
}

function blade_grve_woo_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
?>
	<span class="grve-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
<?php
	$fragments['span.grve-purchased-items'] = ob_get_clean();

	ob_start();
	blade_grve_woo_mini_cart();
	$mini_cart = ob_get_clean();

	$fragments['div.grve-shopping-cart-content'] = '<div class="grve-shopping-cart-content">' . $mini_cart . '</div>';

	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'blade_grve_woo_header_add_to_cart_fragment');


function blade_grve_woo_product_review_comment_form_args( $comment_form ) {
	$comment_form['id_submit'] = 'grve-woo-review-submit';
	return $comment_form;
}
add_filter( 'woocommerce_product_review_comment_form_args', 'blade_grve_woo_product_review_comment_form_args' );



/**
 * Function to modify columns number on product thumbnails
 */
function blade_grve_woo_product_thumbnails_columns() {
	return 4;
}

/**
 * Function to add before main woocommerce content
 */
function blade_grve_woo_before_main_content() {

	if ( is_shop() && !is_search() ) {
		blade_grve_print_header_title( 'page' );
		blade_grve_print_header_breadcrumbs( 'page' );
		blade_grve_print_anchor_menu( 'page' );
	} elseif( is_product() ) {
		blade_grve_print_header_title( 'product' );
		blade_grve_print_header_breadcrumbs( 'product' );
		blade_grve_print_anchor_menu( 'product' );
	}  elseif( is_product_taxonomy() ) {
		blade_grve_print_header_title( 'product_tax' );
		blade_grve_print_header_breadcrumbs( 'product' );
	} else {
		blade_grve_print_header_title( 'page' );
		blade_grve_print_header_breadcrumbs( 'page' );
	}
?>

	<!-- CONTENT -->
	<div id="grve-content" class="clearfix <?php echo blade_grve_sidebar_class( 'shop' ); ?>">
		<div class="grve-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="grve-main-content" role="main">
				<div class="grve-main-content-wrapper clearfix">
<?php
		if( !is_product() ) {
?>
					<div class="grve-container">
<?php
		}

}

/**
 * Function to add after main woocommerce content
 */
function blade_grve_woo_after_main_content() {
		if( !is_product() ) {
?>
					</div>
<?php
		}
?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php blade_grve_set_current_view( 'shop' ); ?>
			<?php get_sidebar(); ?>
		</div>
	</div>
	<!-- END CONTENT -->
<?php
}

/**
 * Functions to add content wrapper
 */
function blade_grve_woo_before_container() {
?>
	<div class="grve-container">
<?php
}
function blade_grve_woo_after_container() {
?>
	</div>
<?php
}

function blade_grve_woo_single_title() {
?>
	<div itemprop="name" class="grve-hidden product_title entry-title"><?php the_title(); ?></div>
<?php
}


function blade_grve_woo_add_to_cart_class( $product ) {

	return implode( ' ', array_filter( array(
			'product_type_' . $product->product_type,
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
	) ) );

}

function blade_grve_woo_loop_add_to_cart_args( $args, $product ) {

	$ajax_add = '';
	if ( method_exists( 'WC_Product', 'supports' ) ) {
		$ajax_add = $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '';
	}

	$args['class'] = implode( ' ', array_filter( array(
			'product_type_' . $product->product_type,
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$ajax_add
	) ) );
	return $args;

}
add_filter( 'woocommerce_loop_add_to_cart_args', 'blade_grve_woo_loop_add_to_cart_args', 10, 2 );

/**
 * WooCommerce loop actions and filters
 */
function blade_grve_woo_loop_columns( $columns ) {
	$columns = blade_grve_option( 'product_loop_columns', '4' );
	return $columns;
}
add_filter('loop_shop_columns', 'blade_grve_woo_loop_columns');


function blade_grve_woo_loop_shop_per_page( $items ) {
	$items = blade_grve_option( 'product_loop_shop_per_page', '12' );
	return $items;
}
add_filter( 'loop_shop_per_page', 'blade_grve_woo_loop_shop_per_page', 20 );


function blade_grve_woo_before_shop_loop() {
	$columns = blade_grve_option( 'product_loop_columns', '4' );
	echo '<div class="woocommerce columns-' . esc_attr( $columns ) . '">';
}
add_action( 'woocommerce_before_shop_loop', 'blade_grve_woo_before_shop_loop', 99 );

function blade_grve_woo_after_shop_loop() {
	echo '</div>';
}
add_action( 'woocommerce_after_shop_loop', 'blade_grve_woo_after_shop_loop', 5 );


/**
 * Overwrite the WooCommerce actions and filters
 */

//Remove Content Wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
//Add Content Wrappers
add_action('woocommerce_before_main_content', 'blade_grve_woo_before_main_content', 10);
add_action('woocommerce_after_main_content', 'blade_grve_woo_after_main_content', 10);

//Remove Archive/Shop/{Product Title Description
add_filter( 'woocommerce_show_page_title', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );


//Wrapper woocommerce_upsell_display
add_action( 'woocommerce_after_single_product_summary', 'blade_grve_woo_before_container', 14 );
add_action( 'woocommerce_after_single_product_summary', 'blade_grve_woo_after_container', 16 );

//General Woo
add_filter( 'get_product_search_form', 'blade_grve_woo_product_search' );
add_filter( 'woocommerce_product_thumbnails_columns', 'blade_grve_woo_product_thumbnails_columns' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
