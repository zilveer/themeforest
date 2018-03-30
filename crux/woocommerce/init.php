<?php
/**
 * Modify WooCommerce features according to Crux uses.
 *
 * @package StagFramework
 * @subpackage Crux
 */

/**
 * Check if WooCommerce is active.
 *
 * @return boolean
 */
function stag_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) return true;
	return false;
}

/**
 * WooCommerce Image Dimensions.
 *
 * @return void
 */
function stag_woocommerce_image_dimensions() {
	$thumbnail = array( 'width' => 110, 'height' => 110 );
	$catalog   = array( 'width' => 270, 'height' => 330 );
	$single    = array( 'width' => 470, 'height' => 999, 'crop' => false );

	update_option( 'shop_catalog_image_size', $catalog );
	update_option( 'shop_single_image_size', $single );
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
	add_action( 'init', 'stag_woocommerce_image_dimensions', 1 );
}

// Check if WooCommerce is active, otherwise stop the script
if ( ! stag_is_woocommerce_active() ) return;

/**
 * Enqueue WooCommerce related scripts and styles
 *
 * @return void
 */
function stag_woocommerce_script_styles() {
	wp_register_script( 'favico', get_template_directory_uri() . '/assets/js/favico.min.js', 'jquery', '0.3.4', true );

	if ( 'on' == stag_get_option( 'shop_favicon_badge' ) )
		wp_enqueue_script( 'favico' );

	/* Don't use WooCommerce default CSS */
	wp_dequeue_style( 'woocommerce-general' );
	wp_dequeue_style( 'woocommerce-layout' );

	wp_enqueue_style( 'crux-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.css', '', STAG_THEME_VERSION, 'all' );
	wp_enqueue_script( 'crux-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.js', array( 'jquery' ), STAG_THEME_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'stag_woocommerce_script_styles' );

/** Hide WooCommerce store text in footer as it's already displayed in header.php */
remove_action( 'wp_footer', 'woocommerce_demo_store' );

/**
 * Get the password form if post password is required.
 *
 * @return Password form.
 */
if ( ! function_exists( 'stag_woocommerce_echo_password' ) ) :
	function stag_woocommerce_echo_password() {
		if ( post_password_required() )
			echo get_the_password_form();
	}
endif;

/**
 * Edit OnSale Product text
 *
 * @return string
 */
function stag_edit_onsale_text() {
	return '<span class="onsale">' . __( 'Sale', 'stag' ) .'</span>';
}
add_filter( 'woocommerce_sale_flash', 'stag_edit_onsale_text' );

function stag_edit_breadcrumb_delimiter() {
	return array(
		'delimiter'   => '<span class="divider">&#92;</span>',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	);
}
add_filter( 'woocommerce_breadcrumb_defaults', 'stag_edit_breadcrumb_delimiter' );

function crux_single_product_page_navigation(){
	?>

	<nav class="paging-navigation--wrapper single-product-navigation navigation">
		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="fa fa-angle-left"></span>' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="fa fa-angle-right"></span>' ); ?>
	</nav><!-- .single-product-navigation -->

	<?php
}
add_action( 'woocommerce_before_single_product', 'crux_single_product_page_navigation', 2 );


function stag_woocommerce_cart_dropdown() {
	global $woocommerce;
	$cart_subtotal    = $woocommerce->cart->get_cart_subtotal();
	$link             = $woocommerce->cart->get_cart_url();
	$cart_items_count = $woocommerce->cart->cart_contents_count;

	$output = '';
	$output .= '<ul class="cart_dropdown"><li class="cart_dropdown_first">';
	$output .= "<a class='cart_dropdown_link' href='" . $link . "'><span>" . __( 'Cart', 'stag' ) . "</span><span class='count'>" . $cart_items_count . "</span></a><!--<span class='cart_subtotal'>" . $cart_subtotal ."</span>-->";
	$output .= '<div class="dropdown_widget dropdown_widget_cart">';
	$output .= '<div class="widget_shopping_cart_content"></div>';
	$output .= '</div>';
	$output .= '</li></ul>';

	echo $output;
}
add_action( 'crux_middle_header', 'stag_woocommerce_cart_dropdown' );

function stag_woocommerce_header_cart_fragments( $fragments ) {
	global $woocommerce;

	$cart_subtotal    = $woocommerce->cart->get_cart_subtotal();
	$link             = $woocommerce->cart->get_cart_url();
	$cart_items_count = $woocommerce->cart->cart_contents_count;

	ob_start(); ?>

	<a class='cart_dropdown_link' href='<?php echo $link; ?>'><span><?php _e( 'Cart', 'stag' ) ?></span><span class='count'><?php echo $cart_items_count; ?></span></a><!--<span class='cart_subtotal'><?php echo $cart_subtotal; ?></span>-->

	<script type="text/javascript">
	// <![CDATA[
	jQuery(function($){
		if ( "on" === stag.show_favicon_badge ) {
			favicon.badge(<?php echo $woocommerce->cart->cart_contents_count; ?>);
		}
	});
	// ]]>
	</script>

	<?php

	$fragments['a.cart_dropdown_link'] = ob_get_clean();

	return $fragments;
}

add_filter( 'add_to_cart_fragments', 'stag_woocommerce_header_cart_fragments' );


// Add rating on right position in shop loop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

if ( 'on' == stag_get_option( 'shop_ratings' ) ) {
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
}

// Pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'stag_content_nav', 0, 1 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail' );


function opening_inside_div(){
	echo '<div class="after-content-wrapper">';
}
function closing_inside_div(){
	echo '</div>';
}

function stag_woocommerce_thumbnail() {
	global $product;

	$rating = $product->get_rating_html();
	$size   = 'shop_catalog';

	ob_start(); ?>

	<div class="thumbnail-container">
		<?php echo get_the_post_thumbnail( get_the_ID(), $size ); ?>

		<?php if ( ! empty( $rating ) ) : ?>
			<span class="rating-container"><?php echo $rating; ?></span>
		<?php endif; ?>

		<?php do_action( 'product_thumbnail_container' ); ?>
	</div><!-- .thumbnail-container -->

	<?php

	$output = ob_get_clean();
	echo $output;
}

/**
 * Unhook WooCommerce theme wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'stag_woocommerce_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'stag_woocommerce_wrapper_end', 10 );

function stag_woocommerce_theme_wrapper_start() {
	echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">';
}

function stag_woocommerce_wrapper_end() {
	echo '</main><!-- #main --></div><!-- #primary -->';
}

/**
 * Change theme tabs title and headings
 */
function crux_default_tab_description_title() {
	return __( 'Product Description', 'stag' );
}
add_filter( 'woocommerce_product_description_tab_title', 'crux_default_tab_description_title' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

function crux_default_tab_information_title() {
	return __( 'Additional Details', 'stag' );
}
add_filter( 'woocommerce_product_additional_information_tab_title', 'crux_default_tab_information_title' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

function crux_default_tab_reviews_title() {
	return __( 'Customer Reviews', 'stag' );
}
add_filter( 'woocommerce_product_reviews_tab_title', 'crux_default_tab_reviews_title' );

function crux_change_order_button_text() {
	return __( 'Proceed to Checkout', 'stag' );
}
add_filter( 'woocommerce_order_button_text', 'crux_change_order_button_text' );

/**
 * Remove product information on password protected products.
 *
 * @return void
 */
if ( ! function_exists( 'stag_remove_woocommerce_hooks' ) ) :

	add_action( 'woocommerce_before_single_product', 'stag_remove_woocommerce_hooks' );

	function stag_remove_woocommerce_hooks() {
		// Remove content if post password required
		if ( post_password_required() ) {
			add_action( 'woocommerce_after_single_product_summary', 'stag_woocommerce_echo_password', 1 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
			remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
			remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );

			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		}
	}

endif;

function stag_woocommerce_add_category_fields() {
	?>

	<div class="form-field">
		<label for="display_sidebar"><?php _e( 'Page Layout', 'stag' ); ?></label>
		<select id="display_sidebar" name="display_sidebar" class="postform">
			<option value=""><?php _e( 'Default - Set in Crux > Sidebar', 'stag' ); ?></option>
			<option value="no-sidebar"><?php _e( 'No Sidebar', 'stag' ); ?></option>
			<option value="left-sidebar"><?php _e( 'Left Sidebar', 'stag' ); ?></option>
			<option value="right-sidebar"><?php _e( 'Right Sidebar', 'stag' ); ?></option>
		</select>
		<p><?php _e( 'Select the desired page layout.', 'stag' ); ?></p>
	</div>

	<?php
}
add_action( 'product_cat_add_form_fields', 'stag_woocommerce_add_category_fields' );

function stag_woocommerce_edit_category_fields( $term, $taxonomy ) {
	global $woocommerce;

	$display_sidebar = get_woocommerce_term_meta( $term->term_id, 'display_sidebar', true );

	?>

	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e( 'Page Layout', 'stag' ); ?></label></th>
		<td>
			<select id="display_sidebar" name="display_sidebar" class="postform">
				<option value="" <?php selected( '', $display_sidebar ); ?>><?php _e( 'Default - Set in Crux > Sidebar', 'stag' ); ?></option>
				<option value="no-sidebar" <?php selected( 'no-sidebar', $display_sidebar ); ?>><?php _e( 'No Sidebar', 'stag' ); ?></option>
				<option value="left-sidebar" <?php selected( 'left-sidebar', $display_sidebar ); ?>><?php _e( 'Left Sidebar', 'stag' ); ?></option>
				<option value="right-sidebar" <?php selected( 'right-sidebar', $display_sidebar ); ?>><?php _e( 'Right Sidebar', 'stag' ); ?></option>
			</select>
			<br>
			<span class="description"><?php _e( 'Select the desired page layout.', 'stag' ); ?></span>
		</td>
	</tr>

	<?php
}
add_action( 'product_cat_edit_form_fields', 'stag_woocommerce_edit_category_fields', 10, 2 );

function stag_woocommerce_category_fields_save( $term_id, $tt_id, $taxonomy ) {
	if ( isset( $_POST['display_sidebar'] ) )
		update_woocommerce_term_meta( $term_id, 'display_sidebar', esc_attr( $_POST['display_sidebar'] ) );

	delete_transient( 'wc_term_counts' );
}

add_action( 'created_term', 'stag_woocommerce_category_fields_save', 10, 3 );
add_action( 'edit_term', 'stag_woocommerce_category_fields_save', 10, 3 );

/**
 * Add custom product info on product single page.
 *
 * @global $product
 * @global $post
 * @return void
 */
function stag_woocommerce_template_single_product_info() {
	global $product, $post;

	// Return if ratings on review are disabled from settings
	if ( 'no' == get_option( 'woocommerce_enable_review_rating' ) ) return;

	?>

	<div class="product_info">
		<span class="review-count">
			<?php echo sprintf( __( 'Customer Rating <a href="%s">(%d)</a>', 'stag' ), get_comments_link( $post->id ), get_comments_number( $post->id ) ); ?>
		</span>

		<?php echo $product->get_rating_html(); ?>

		<?php echo sprintf( __( '<a href="#review_form" class="show_review_form">Submit a Review</a>', 'stag' ), get_comments_link( $post->id ) ); ?>
	</div>

	<?php
}
add_action( 'woocommerce_single_product_summary', 'stag_woocommerce_template_single_product_info', 30 );

function stag_woocommerce_products_per_page( $cols ) {
	$cols = (int) stag_get_option( 'shop_products_per_page' );

	return $cols;
}
add_filter( 'loop_shop_per_page', 'stag_woocommerce_products_per_page', 20 );

function stag_woocommerce_add_to_cart_message( $product_id ) {
	$product_id_normal = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
	$product_id_ajax =  isset( $_POST['product_id'] ) ? apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) ) : $product_id_normal;

	$product_id = $product_id_normal;

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) $product_id = $product_id_ajax;

	if ( is_array( $product_id ) ) {

		$titles = array();

		foreach ( $product_id as $id ) {
			$titles[] = get_the_title( $id );
		}

		$added_text = sprintf( __( 'Added &quot;%s&quot; to your cart.', 'woocommerce' ), join( __( '&quot; and &quot;', 'woocommerce' ), array_filter( array_merge( array( join( '&quot;, &quot;', array_slice( $titles, 0, -1 ) ) ), array_slice( $titles, -1 ) ) ) ) );

	} else {
		$added_text = sprintf( __( '&ldquo;%s&rdquo; was successfully added to your cart.', 'woocommerce' ), get_the_title( $product_id ) );
	}

	// Output success messages
	if ( 'yes' == get_option( 'woocommerce_cart_redirect_after_add' ) ) :

		$return_to 	= apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );

		$message 	= sprintf( '<span>%3$s</span> <a href="%1$s" class="button">%2$s</a>', $return_to, __( 'Continue Shopping &rarr;', 'woocommerce' ), $added_text );

	else :

		$message 	= sprintf( '<span>%3$s</span> <a href="%1$s" class="button">%2$s</a>', get_permalink( woocommerce_get_page_id( 'cart' ) ), __( 'View Cart', 'stag' ), $added_text );

	endif;

	return $message;
}
add_filter( 'woocommerce_add_to_cart_message', 'stag_woocommerce_add_to_cart_message', 10, 1 );
add_filter( 'wc_add_to_cart_message', 'stag_woocommerce_add_to_cart_message', 10, 1 );


function woocommerce_output_related_products() {
	woocommerce_related_products( array(
		'posts_per_page' => 4,
		'columns'        => 4,
	) );
}

/**
 * Below are the function added after WooCommerce 2.1
 *
 * WooCommerce 2.1 was a major release with a number of modifications in its
 * functionalities, stylings etc.
 *
 * @since 1.2
 */
function crux_is_older_than_2_1() {
	global $woocommerce;
	if ( version_compare( $woocommerce->version, '2.1', '<' ) ) {
		return true;
	} else {
		return false;
	}
}

if ( ! crux_is_older_than_2_1() ) :

	function crux_before_shipping_title() {
		echo '<h3 id="payment_method_heading">' . __( 'Payment Method', 'stag' ) . '</h3>';
	}
	add_action( 'woocommerce_review_order_before_payment', 'crux_before_shipping_title' );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

endif; // crux_is_older_than_2_1 check
