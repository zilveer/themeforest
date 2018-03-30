<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if( ! in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
	return;

# Shop Constants
define("SHOP_SIDEBAR", get_data('shop_sidebar') != 'hide');

$shop_columns = SHOP_SIDEBAR ? 3 : 4;

switch(get_data('shop_product_columns'))
{
	case "six":
		$shop_columns = 6;
		break;

	case "five":
		$shop_columns = 5;
		break;

	case "four":
		$shop_columns = 4;
		break;

	case "three":
		$shop_columns = 3;
		break;

	case "two":
		$shop_columns = 2;
		break;
}
define("SHOP_COLUMNS", $shop_columns);

define("SHOP_SINGLE_SIDEBAR", get_data('shop_single_sidebar') != 'hide');

# Remove Actions
remove_action( 'woocommerce_before_main_content', 			'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_shop_loop', 				'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 				'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 	'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop', 				'woocommerce_pagination', 10 );
remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 	'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_subcategory_title', 		'woocommerce_subcategory_thumbnail', 10 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );

add_action( 'woocommerce_before_main_content', 'wc_print_notices', 10 );


# Custom Filters & Actions
add_filter( 'loop_shop_per_page', 'laborator_woocommerce_loop_shop_per_page', 1000 );

add_filter( 'single_product_large_thumbnail_size', laborator_immediate_return_fn( 'shop-thumb-main' ) );
add_filter( 'single_product_small_thumbnail_size', laborator_immediate_return_fn( 'shop-thumb-main' ) );
add_filter( 'option_woocommerce_enable_lightbox', laborator_immediate_return_fn( 'no' ) );
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'laborator_single_product_image_thumbnail_html' );

#add_filter( 'woocommerce_product_review_list_args', 'laborator_woocommerce_reviews_list_comments_arr' );

	# Move Price Below description
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

	# Remove add to cart on "Catalog mode"
	if(get_data('shop_catalog_mode'))
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

	# Remove product meta
	if(get_data('shop_single_meta_show') == false)
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

	# Share Item
	if(get_data('shop_share_product'))
		add_action('woocommerce_share', 'laborator_woocommerce_share');

	# Related Products
	add_filter('woocommerce_output_related_products_args', 'laborator_woocommerce_related_products_args');


# Wrapping Custom Pages
//add_action('woocommerce_before_template_part', 'laborator_before_template_part');
//add_action('woocommerce_after_template_part', 'laborator_after_template_part');


# Before Wrapper
function laborator_woocommerce_before()
{
	?>
	<section class="shop<?php echo is_single() ? ' shop-item-single' : ''; ?>">
		<div class="container woocommerce">

	<?php
}

# After Wrapper
function laborator_woocommerce_after()
{
	?>
		</div>
	</section>
	<?php
}

# Products per Page
function laborator_woocommerce_loop_shop_per_page()
{
	$rows_count = absint(get_data('shop_products_per_page'));
	$rows_count = $rows_count > 0 ? $rows_count : 4;

	return SHOP_COLUMNS * $rows_count;
}


// Aurum-styled Minicart Contents
function laborator_woocommerce_get_mini_cart_contents()
{
	ob_start();

	get_template_part('tpls/woocommerce-mini-cart');

	return ob_get_clean();
}


# Share Product Item
function laborator_woocommerce_share()
{
	global $product;

	$as_icons = get_data( 'shop_share_product_icons' );
	?>
	<div class="share-post <?php echo $as_icons ? ' share-post-icons' : ''; ?>">
		<h3><?php _e('Share this item:', 'aurum'); ?></h3>
		<div class="share-product share-post-links list-unstyled list-inline">
		<?php
		$share_product_networks = get_data('shop_share_product_networks');
		
		if ( $as_icons ) {
			add_filter( 'aurum_shop_product_single_share', '__return_true', 100 );
		}

		if(is_array($share_product_networks)):

			foreach($share_product_networks['visible'] as $network_id => $network):

				if($network_id == 'placebo')
					continue;

				share_story_network_link($network_id, $product->id, false);

			endforeach;

		endif;
		?>
		</div>
	</div>
	<?php
}


# Related Product Counts
function laborator_woocommerce_related_products_args($args)
{
	$args['posts_per_page']    = get_data('shop_related_products_per_page');
	$args['columns']           = $args['posts_per_page'];

	return $args;
}



# Content Wrappers
global $laborator_woocommerce_wrap_pages;

$laborator_woocommerce_wrap_pages = array(
	'cart/cart.php',
	'checkout/form-checkout.php',
	'myaccount/form-login.php',
	'myaccount/my-account.php',
	'myaccount/form-edit-address.php',
	'myaccount/form-edit-account.php',
	'myaccount/form-lost-password.php',
	'myaccount/view-order.php',
	'checkout/thankyou.php',
	'order/form-tracking.php',
	'order/tracking.php',
);


function laborator_before_template_part($template_name)
{
	global $laborator_woocommerce_wrap_pages;

	foreach($laborator_woocommerce_wrap_pages as $template)
	{
		if($template == $template_name)
		{
			laborator_woocommerce_before();
		}
	}
}

function laborator_after_template_part($template_name)
{
	global $laborator_woocommerce_wrap_pages;

	foreach($laborator_woocommerce_wrap_pages as $template)
	{
		if($template == $template_name)
		{
			laborator_woocommerce_after();
		}
	}
}


function laborator_single_product_image_thumbnail_html($html)
{
	$html = str_replace('data-rel="prettyPhoto[product-gallery]"', 'data-lightbox-gallery="shop-gallery"', $html);
	return $html;
}


# Payment Method Title
add_action('woocommerce_review_order_before_payment', 'laborator_woocommerce_review_order_before_payment');

function laborator_woocommerce_review_order_before_payment()
{
	?>
	<div class="vspacer"></div>
	<h2 id="payment_method_heading"><?php _e('Payment Method', 'aurum'); ?></h2>
	<?php
}


# Remove WooCommerce styles and scripts.
function laborator_woocommerce_remove_lightboxes()
{
	// Styles
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

	// Scripts
	wp_dequeue_script( 'prettyPhoto' );
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_script( 'fancybox' );
	wp_dequeue_script( 'enable-lightbox' );
}

add_action( 'wp_enqueue_scripts', 'laborator_woocommerce_remove_lightboxes', 99 );


# Temporary remove title bug in WooCommerce
remove_filter('the_title', 'wc_page_endpoint_title');


# YITH Wishlist Supported
function is_yith_wishlist_supported()
{
	return function_exists('yith_wishlist_constructor');
}



# Custom YITH Wishlist Button for Oxygen theme
function laborator_yith_wcwl_add_to_wishlist()
{
	global $yith_wcwl, $product;

	$url           = $yith_wcwl->get_wishlist_url();
	$product_type  = $product->product_type;
	$exists        = $yith_wcwl->is_product_in_wishlist( $product->id );

	$url_to_add    = $yith_wcwl->get_addtowishlist_url();

	?>
	<span class="wishlist <?php echo $exists ? ' wishlisted' : ''; ?>">
		<span class="yith-add-to-wishlist fa fa-heart" data-listid="<?php echo $url_to_add; ?>"></span>
	</span>
	<?php
}



# Cart Page (when empty)
if( function_exists( 'is_cart' ) )
{
	add_action( 'wp_head', 'lab_wc_check_cart_page' );
}

function lab_wc_check_cart_page()
{
	if ( is_cart() )
	{
		if( WC()->cart->cart_contents_count == 0 )
		{
			add_filter( 'body_class', create_function( '$a', '$a[] = "wc-cart-empty"; return $a;' ) );
		}
		
	}
}

# WooCommerce Pagination change place 
if( get_data( 'shop_loop_masonry' ) ) {	
	add_action( 'woocommerce_after_main_content', 'woocommerce_pagination' );
}
add_action( 'wp_enqueue_scripts', 'laborator_woocommerce_remove_lightboxes', 99 );


// Variation Images
function change_wc_variation_image_size( $child_id, $instance, $variation ) {
	$attachment_id         = get_post_thumbnail_id( $variation->get_variation_id() );
	$attachment            = wp_get_attachment_image_src( $attachment_id, 'shop-thumb-main' );
	$image_src             = $attachment ? current( $attachment ) : '';
	$child_id['image_src'] = $image_src;
	
	return $child_id;
}

add_filter( 'woocommerce_available_variation', 'change_wc_variation_image_size', 10, 3 );

// Wishlist Title
add_filter( 'yith_wcwl_wishlist_title', 'yith_wcwl_wishlist_title_replace' );

function yith_wcwl_wishlist_title_replace( $title ) {
	
	$subtitle = '<small>' . __('Your favorite list of products', 'aurum') . '</small>';
	
	?>
	<div class="page-title">
		<?php echo str_replace( '</h2>', $subtitle . '</h2>', $title ); ?>
	</div>
	<?php
}


// Shop Item Thumbnail
function aurum_shop_loop_item_thumbnail() {
	?>
	<div class="item-image">
		<?php get_template_part('tpls/woocommerce-item-thumbnail'); ?>

		<?php if(get_data('shop_item_preview_type') != 'none'): ?>
		<div class="bounce-loader">
			<div class="loading loading-0"></div>
			<div class="loading loading-1"></div>
			<div class="loading loading-2"></div>
		</div>
		<?php endif; ?>
	</div>
	<?php
}

add_action( 'woocommerce_before_shop_loop_item', 'aurum_shop_loop_item_thumbnail' );

// Remove Item Link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Show Product Title (Loop)
function aurum_shop_loop_item_title() {
	global $product;
	
	$id = $product->get_ID();
	?>
	<div class="item-info">
		<?php do_action( 'aurum_before_shop_loop_item_title' ); ?>
		
		<h3<?php echo ! get_data('shop_add_to_cart_listing') ? ' class="no-right-margin"' : ''; ?>>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if(get_data('shop_product_category_listing')): ?>
		<span class="product-terms">
			<?php the_terms($id, 'product_cat'); ?>
		</span>
		<?php endif; ?>
		
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>	
	<?php
}

add_action( 'woocommerce_shop_loop_item_title', 'aurum_shop_loop_item_title', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 20 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Remove price and rating below the product
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );



// Shop Category Item
function aurum_shop_loop_category_thumbnail( $category ) {
	
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	$thumbnail_url = wc_placeholder_img_src();

	if($thumbnail_id)
	{
		$thumbnail_url_custom = wp_get_attachment_image_src( $thumbnail_id, apply_filters('laborator_wc_category_thumbnail_size', 'shop-category-thumb') );

		if($thumbnail_url_custom)
			$thumbnail_url = $thumbnail_url_custom[0];
	}

	echo '<img src="'.$thumbnail_url.'" alt="category-shop" />';
}

add_action( 'woocommerce_before_subcategory_title', 'aurum_shop_loop_category_thumbnail' );

// Shop Category Count
if ( ! get_data('shop_category_count') ) {
	add_filter( 'woocommerce_subcategory_count_html', laborator_immediate_return_fn( '' ) );
}

// Shop Loop Clearing
function aurum_woocommerce_shop_loop_clear_row( $shop_columns, $item_colums ) {
	global $woocommerce_loop;
	
	if ( $shop_columns && $item_colums ) {
		echo $woocommerce_loop['loop'] % $shop_columns == 0 ? '<div class="clear-md"></div>' : '';
		echo $woocommerce_loop['loop'] % 2 == 0 ? '<div class="clear-sm"></div>' : '';
	}
}

add_action( 'aurum_woocommerce_shop_loop_clear_row', 'aurum_woocommerce_shop_loop_clear_row', 10, 2 );



// Account Navigation
function aurum_woocommerce_before_account_navigation() {
	global $current_user;
	
	$account_page_id    = wc_get_page_id( 'myaccount' );
	$account_url        = get_permalink( $account_page_id );
	$logout_url         = wp_logout_url( $account_url );
	
	?>
	<div class="wc-my-account-tabs">
		
		<div class="user-profile">
			<a class="image">
				<?php echo get_avatar( $current_user->ID, 128 ); ?>
			</a>
			<div class="user-info">
				<a class="name" href="<?php echo the_author_meta( 'user_url', $current_user->ID ); ?>"><?php echo $current_user->display_name; ?></a>
				<a class="logout" href="<?php echo $logout_url; ?>"><?php _e( 'Logout', 'aurum' ); ?></a>
			</div>
		</div>
	<?php
}

function aurum_woocommerce_after_account_navigation() {
	?>
	</div>
	<?php
}

add_action( 'woocommerce_before_account_navigation', 'aurum_woocommerce_before_account_navigation' );
add_action( 'woocommerce_after_account_navigation', 'aurum_woocommerce_after_account_navigation' );



// Mini Cart
function aurum_woocommerce_mini_cart_fragments( $fragments ) {
	$fragments['aurumMinicart']     = laborator_woocommerce_get_mini_cart_contents();
	$fragments['aurumCartItems']    = WC()->cart->get_cart_contents_count();
	$fragments['aurumCartSubtotal'] = WC()->cart->get_cart_subtotal();
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'aurum_woocommerce_mini_cart_fragments' );