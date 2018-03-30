<?php
/**
 * Woocommerce support
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!function_exists('dfd_woocommerce_disable_styles')) {
	function dfd_woocommerce_disable_styles() {
		add_filter( 'woocommerce_enqueue_styles', 'dfd_woocommerce_disable_styles_filter', 11 );
	}
}

if (!function_exists('dfd_woocommerce_template_path')) {
	function dfd_woocommerce_template_path() {
		global $dfd_ronneby;
		if(isset($dfd_ronneby['dfd_woocommerce_templates_path']) && !empty($dfd_ronneby['dfd_woocommerce_templates_path']))
			return 'woocommerce'.$dfd_ronneby['dfd_woocommerce_templates_path'].'/';
		
		return 'woocommerce/';
	}
}

if (!function_exists('dfd_woocommerce_disable_styles_filter')) {
	function dfd_woocommerce_disable_styles_filter($in) {
		return array();
	}
}

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	$args = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);
	woocommerce_related_products($args); // Display 4 products in rows of 4
}

if ( ! function_exists( 'wc_product_rating_overview' ) ) {
	function wc_product_rating_overview() {
		global $product;
		echo '<span class="show">' . $product->get_rating_html() . '</span>';
	}
}

if(!function_exists('dfd_woocommerce_image_size_options')) {
	function dfd_woocommerce_image_size_options() {
		$image_dimenions = array();
		$image_dimenions['catalog'] = array(
			'width' 	=> '400',	// px
			'height'	=> '480',	// px
			'crop'		=> 1 		// true
		);

		$image_dimenions['single'] = array(
			'width' 	=> '590',	// px
			'height'	=> '600',	// px
			'crop'		=> 1 		// true
		);

		$image_dimenions['thumbnail'] = array(
			'width' 	=> '140',	// px
			'height'	=> '140',	// px
			'crop'		=> 1 		// true
		);
		return $image_dimenions;
	}
}

/**
 * Define image sizes
 */
if (!function_exists('dfd_kadabra_woocommerce_image_dimensions')) {
	function dfd_kadabra_woocommerce_image_dimensions() {
		
		$image_dimentions = dfd_woocommerce_image_size_options();

		// Image sizes
		update_option( 'shop_catalog_image_size', $image_dimentions['catalog'] ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $image_dimentions['single'] ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $image_dimentions['thumbnail'] ); 	// Image gallery thumbs
	}
}

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$fragments['a.woo-cart-contents'] = dfd_a_woo_cart_contents();

	return $fragments;

}

function dfd_a_woo_cart_contents() {
	global $woocommerce;
	$href = $woocommerce->cart->get_cart_url();
	$title = '';

	$items_count = $woocommerce->cart->cart_contents_count;

	ob_start();
	?>
	<a class="woo-cart-contents" href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($title); ?>">
		<span class="woo-cart-items">
			<i class="dfd-icon-shopping_bag_2"></i>
			<!-- <span class="dfd-header-cart-handle"></span> -->
		</span>
		<span class="woo-cart-details">
			<?php echo $items_count; ?>
		</span>
	</a>
	<?php
	return ob_get_clean();
}

function dfd_woocommerce_total_cart() {
	global $dfd_ronneby;
	if (!is_plugin_active('woocommerce/woocommerce.php')) 
		return;
	
	if(isset($dfd_ronneby['show_header_cart']) && $dfd_ronneby['show_header_cart'] == 'off')
		return;
	
	$cart_style = (isset($dfd_ronneby['header_cart_style']) && $dfd_ronneby['header_cart_style'] != '') ? $dfd_ronneby['header_cart_style'] : 'simple';
	
	ob_start();
	?>
	<div class="total_cart_header <?php echo esc_attr($cart_style) ?>">
		<?php echo dfd_a_woo_cart_contents(); ?>

		<div class="shopping-cart-box">
			<div class="shopping-cart-box-content">
				<div class="widget_shopping_cart_content"></div>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

function dfd_wishlist_link() {
	if (!is_plugin_active('yith-woocommerce-wishlist/init.php')) 
		return;
	global $yith_wcwl;
	$href = $yith_wcwl->get_wishlist_url();

	ob_start();
	?>
	<div class="header-wishlist-link-wrap">
		<a class="header-wishlist-link" href="<?php echo esc_url($href); ?>" title=""><?php _e('My wishlist', 'dfd'); ?></a>
	</div>
	<?php
	return ob_get_clean();
}

function dfd_wishlist_button() {
	if (!is_plugin_active('yith-woocommerce-wishlist/init.php')) 
		return;
	
	global $yith_wcwl;

	if(is_object($yith_wcwl)) {
		$items_in_wishlist = $yith_wcwl->count_products();

		$href = $yith_wcwl->get_wishlist_url();
		$title = __('View your wishlist', 'dfd');

		ob_start();
		?>
			<a class="header-wishlist-button dfd-tablet-hide" href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($title); ?>">
				<i class="dfd-icon-heart2"></i>
				<span class="wishlist-details"><?php echo $items_in_wishlist; ?></span>
			</a>
		<?php
		return ob_get_clean();
	}
}

function dfd_wishlist_total() {
	if (!is_plugin_active('yith-woocommerce-wishlist/init.php')) 
		return;

	global $wpdb, $yith_wcwl;


	ob_start();
	?>
	<div class="total_wishlist_header">
		<?php echo dfd_wishlist_button(); ?>
		<?php 
			if( isset( $_GET['user_id'] ) && !empty( $_GET['user_id'] ) ) {
				$user_id = $_GET['user_id'];
			} elseif( is_user_logged_in() ) {
				$user_id = get_current_user_id();
			}
			if( is_user_logged_in() || ( isset( $user_id ) && !empty( $user_id ) ) ) {
				$wishlist_items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s", $user_id ), ARRAY_A );
			} elseif( yith_usecookies() ) {
				$wishlist_items = yith_getcookie( 'yith_wcwl_products' ); 
			} else {
				$wishlist_items = isset( $_SESSION['yith_wcwl_products'] ) ? $_SESSION['yith_wcwl_products'] : array();
			} ?>
			<div class="header-wishlist-details">
			<?php if(count($wishlist_items) > 0) { ?>
				<ul>
					<?php foreach($wishlist_items as $item) {
						if( !is_user_logged_in() && !isset( $_GET['user_id'] ) ) {
							if( isset( $item['add-to-wishlist'] ) && is_numeric( $item['add-to-wishlist'] ) ) {
								$item['prod_id'] = $item['add-to-wishlist'];
								$item['ID'] = $item['add-to-wishlist'];
							} else {
								$item['prod_id'] = $item['product_id'];
								$item['ID'] = $item['product_id'];
							}
						}
						$product = get_product($item['prod_id']);
						if($product != false && $product->exists()) { ?>
							<li class="header-wishlist-item">
								<div class="image-thumb">
									<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
										<?php echo $product->get_image() ?>
									</a>
								</div>
								<div class="box-name">
									<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a>
								</div>
								<?php echo !empty($item['quantity']) ? '<div class="header-wishlist-items-quantity">'.$item['quantity'].'</div>' : ''; ?>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			<?php } else { ?>
				<div class="wishlist-empty">No products in the wishlist</div>
			<?php } ?>
				<p class="wishlist-button">
					<a href="<?php echo $yith_wcwl->get_wishlist_url(); ?>" title="<?php _e('Wishlist button', 'dfd'); ?>" class="button">
						<i class="infinityicon-shop_cart"></i>
						<?php _e('View wishlist', 'dfd') ?>
					</a>
				</p>
				<p class="total">
					<strong><?php _e('Total:', 'dfd') ?></strong>
					<span class="amount"><?php echo (count($wishlist_items) > 0) ? $yith_wcwl->count_products() : '0'; ?></span><span> items</span>
				</p>
			</div>
	</div>
	<?php
	return ob_get_clean();
}

function woocommerce_template_loop_product_thumbnail($color = '', $align = '') {
	//echo woocommerce_get_product_thumbnail();
	global $post, $product, $dfd_ronneby;
	
	$buttons_class = '';
	
	$options = array(
		'woo_products_buttons_color_scheme' => $color,
		'woo_category_content_alignment' => $align,
	);
	
	foreach($options as $k => $v) {
		if($v == '' && isset($dfd_ronneby[$k]) && !empty($dfd_ronneby[$k])) {
			$buttons_class .= ' '.$dfd_ronneby[$k];
		} else {
			$buttons_class .= ' '.$v;
		}
	}
	

	$attachment_ids = $product->get_gallery_attachment_ids();
	/* Thumb */
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		array_unshift($attachment_ids, $thumbnail_id);
		array_unique($attachment_ids);
	}
	
	$catalogue_mode = (isset($dfd_ronneby['woocommerce_catalogue_mode']) && $dfd_ronneby['woocommerce_catalogue_mode']);
	$slideshow_speed = (isset($dfd_ronneby['woocommerce_archive_slideshow_speed']) && $dfd_ronneby['woocommerce_archive_slideshow_speed']) ? $dfd_ronneby['woocommerce_archive_slideshow_speed'] : 2000;
	
	ob_start();
	$unique_id = uniqid('product_slider_');
	if(function_exists('wc_get_image_size')) {
		$image_size = wc_get_image_size('shop_catalog');
	} else {
		$image_dimentions = dfd_woocommerce_image_size_options();
		$image_size = $image_dimentions['catalog'];
	}
	?>

	<div id="<?php echo esc_attr($unique_id); ?>" class="woo-entry-thumb" data-speed="<?php echo esc_attr($slideshow_speed) ?>">
		
		<div class="woo-entry-thumb-carousel">

		<?php 
		foreach ( $attachment_ids as $attachment_id ) {
			$image_url = wp_get_attachment_image_src( $attachment_id, 'large' );
			$image_src = dfd_aq_resize($image_url[0], $image_size['width'], $image_size['height'], $image_size['crop'], true, true);
			if(!$image_src) {
				$image_src = $image_url[0];
			}
			$image = '<img src="'.esc_url($image_src).'" alt="" />';
			/* Should be used to enable pretty-photo lightbox */
			
			$image_link = wp_get_attachment_url( $attachment_id );
			if ( ! $image_link ) { continue; }
			$classes = array();
			$image_class = esc_attr( implode( ' ', $classes ) );
			//$image_title = esc_attr( get_the_title( $attachment_id ) );

			$tmpl = '<div class="%s">%s</div>';
			echo apply_filters(
				'woocommerce_single_product_image_thumbnail_html', 
				sprintf( $tmpl, 
					$image_class,
					//$image_link,
					//'',//$image_title,
					//$post->ID,
					$image
				),
				$attachment_id,
				$post->ID,
				$image_class
			);
		}
		?>

		</div>
		<?php
			$preview_thumb_url = wp_get_attachment_image_src($attachment_ids[0], 'large');
			$preview_thumb_src = dfd_aq_resize($preview_thumb_url[0], $image_size['width'], $image_size['height'], $image_size['crop'], true, true);
			if(!$preview_thumb_src) {
				$preview_thumb_src = $preview_thumb_url[0];
			}
		?>
		<div class="preview-thumb">
			<img src="<?php echo esc_url($preview_thumb_src); ?>" alt="" />
		</div>
	</div>
	<div class="buttons-wrap <?php echo esc_attr($buttons_class) ?>">
		<div>
			<?php if(!$catalogue_mode): ?>
				<?php
				if(function_exists('woocommerce_template_loop_add_to_cart')) {
					woocommerce_template_loop_add_to_cart();
				}
				?>
				<?php wc_get_template('loop/share.php'); ?>
			<?php endif ?>
			<a href="<?php echo wp_get_attachment_url( $attachment_ids[0] ); ?>" title="" class="dfd-prod-lightbox" data-rel="prettyPhoto[product-gallery-<?php echo $post->ID; ?>]">
				<i class="dfd-icon-zoom"></i>
			</a>
		</div>
	</div>

	<?php
	echo ob_get_clean();
}

add_action('init', 'dfd_woocommerce_actions_order');
if(!function_exists('dfd_woocommerce_actions_order')) {
	function dfd_woocommerce_actions_order() {
		global $dfd_ronneby;
		
		if(isset($dfd_ronneby['dfd_woocommerce_templates_path']) && $dfd_ronneby['dfd_woocommerce_templates_path'] == '_old')
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		else {
			add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_template_single_sharing_bottom', 63 );
			add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_sharing', 16 );
		}
	}
}
/*
 * WooCommerce Actions
 */

// price and rating places changed
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );
//add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );

// variable product hook customization
// since wc 2.4
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'dfd_woocommerce_single_variation_add_to_cart_button', 20 );


// rating added

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_before_single_summary', 4 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_before_single_price_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_after_single_price_rating', 25 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
add_action( 'woocommerce_before_add_to_cart_button', 'dfd_woocommerce_before_add_to_cart_button');
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_after_add_to_cart_button', 'dfd_woocommerce_after_add_to_cart_button');
//add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_wishlist_size_quide', 40 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 60 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_after_single_summary', 65 );

//add_action( 'woocommerce_after_single_product_summary', 'dfd_woocommerce_after_product_summary', 15 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_sharing', 16 );

if(!function_exists('dfd_woocommerce_single_variation_add_to_cart_button')) {
	function dfd_woocommerce_single_variation_add_to_cart_button() {
		global $product;
		?>
		<div class="variations_button">
			<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
			<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
			<?php if(function_exists('dfd_woocommerce_wishlist_size_quide')) {
				dfd_woocommerce_wishlist_size_quide();
			} ?>
		</div>
		<?php
	}
}

if(!function_exists('dfd_woocommerce_before_single_price_rating')) {
	function dfd_woocommerce_before_single_price_rating() {
		echo '<div class="dfd-price-rating-wrap clearfix">';
	}
}

if(!function_exists('dfd_woocommerce_after_single_price_rating')) {
	function dfd_woocommerce_after_single_price_rating() {
		echo '</div>';
	}
}

if(!function_exists('sb_woocommerce_template_single_price_rating_wrap_end')) {
	function sb_woocommerce_template_single_price_rating_wrap_end() {
		echo '</div>';
	}
}

if(!function_exists('sb_woocommerce_template_single_rating')) {
	function sb_woocommerce_template_single_rating() {
		if ( function_exists('wc_get_template') ) {
			wc_get_template( 'loop/rating.php' );
		}
	}
}

if (!function_exists('dfd_kadabra_use_default_gallery_style_filter')) {
	function dfd_kadabra_use_default_gallery_style_filter($existing_code) {
		return false; //return $existing_code;
	}
}

if (!function_exists('dfd_woocommerce_before_single_summary')) {
	function dfd_woocommerce_before_single_summary() {
		global $dfd_ronneby;
		$columns_var = (isset($dfd_ronneby['woo_single_columns_config']) && !empty($dfd_ronneby['woo_single_columns_config'])) ? $dfd_ronneby['woo_single_columns_config'] : 7 ;

		$columns = dfd_num_to_string_full($columns_var, true);
		echo '<div class="'.esc_attr($columns).' columns">';
	}
}

if (!function_exists('dfd_woocommerce_after_single_summary')) {
	function dfd_woocommerce_after_single_summary() {
		echo '</div>';
		echo '<div class="clear"></div>';
	}
}

if (!function_exists('dfd_woocommerce_before_add_to_cart_button')) {
	function dfd_woocommerce_before_add_to_cart_button() {
		echo '<div class="single-product-buttons">';
			echo '<div class="single_add_to_cart_button_wrap">';
	}
}

if (!function_exists('dfd_woocommerce_after_add_to_cart_button')) {
	function dfd_woocommerce_after_add_to_cart_button() {
			echo '</div>';
		echo '</div>';
	}
}

if (!function_exists('dfd_woocommerce_after_product_summary')) {
	function dfd_woocommerce_after_product_summary() {
			echo '</div>';
		echo '</div>';
	}
}

if (!function_exists('dfd_woocommerce_wishlist_size_quide')) {
	function dfd_woocommerce_wishlist_size_quide() {
		if (!is_plugin_active('yith-woocommerce-wishlist/init.php')) 
			return;
		$position = get_option( 'yith_wcwl_button_position' );
		if($position == 'shortcode') {
			echo '<div class="single-product-wishlist-wrap">';
				wc_get_template_part('add-to-wishlist-button');
			echo '</div>';
		}
		/*
		do_shortcode('[dfd_wishlist_button_shortcode]');
		$dfd_product_size_guide = get_post_meta(get_the_ID(), "dfd_product_size_guide", true );
		if (!empty($dfd_product_size_guide)) {
			echo '<div class="single-product-size-guide-wrap">';
				echo '<a class="dfd_product_size_guide" href="'.esc_url($dfd_product_size_guide).'" data-rel="prettyPhoto">';
					echo '<span>'.__('Size guide', 'dfd').'</span>';
					echo '<i class="infinityicon-coathanger"></i>';
				echo '</a>';
			echo '</div>';
		}*/
	}
}

if (!function_exists('dfd_woocommerce_before_single_price')) {
	function dfd_woocommerce_before_single_price() {
		echo '<div class="six columns right-section">';
	}
}

if (!function_exists('dfd_woocommerce_after_wishlist_size_quide')) {
	function dfd_woocommerce_after_wishlist_size_quide() {
			echo '</div>';
		echo '</div>';
	}
}

if (!function_exists('dfd_woocommerce_template_single_sharing_bottom')) {
	function dfd_woocommerce_template_single_sharing_bottom() {
		echo '<div class="dfd-share-cover dfd-woo-single-share-bottom">';
			get_template_part('templates/entry-meta/mini','share-blog');
		echo '</div>';
	}
}

// related_products removed
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//add_action( 'woocommerce_after_single_product_summary', 'sb_woocommerce_output_best_selling_products', 20 );
//
//function sb_woocommerce_output_best_selling_products() {
//	echo do_shortcode('[sb_best_selling_products columns="3" show_title="true"]');
//}

add_filter('woocommerce_page_title', 'sb_woocommerce_page_title');

if (!function_exists('sb_woocommerce_page_title')) {
	function sb_woocommerce_page_title($page_title) {
		global $dfd_ronneby;
		if ( /*empty($page_title) && */ isset($dfd_ronneby['shop_title']) && $dfd_ronneby['shop_title']) {
			$page_title = $dfd_ronneby['shop_title'];
		}

		return $page_title;
	}
}

# Single product footer
//add_action( 'dfd_woocommerce_single_product_footer', 'dfd_woocommerce_single_product_footer', 10 );
/* Not in use now, shows custom page under woocommerce single product */
function dfd_woocommerce_single_product_footer() {
	global $dfd_ronneby;
	$woocommerce_page_product_bottom = isset($dfd_ronneby['woocommerce_page_product_bottom']) ? $dfd_ronneby['woocommerce_page_product_bottom'] : '';
	if (!empty($woocommerce_page_product_bottom)) {
		$product_bottom_page_id = intval($woocommerce_page_product_bottom);
		$page_data = get_page($product_bottom_page_id);

		if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status, 'publish') === 0) {
			global $wp_the_query;

			$wp_the_query_backup = $wp_the_query;

			$args = array(
				'page_id' => $product_bottom_page_id,
			);

			$wp_the_query = new WP_Query($args);
				
			if ($wp_the_query->have_posts()) {
				$wp_the_query->the_post();

				$content = get_the_content();

				if (function_exists('mvb_the_content')) {
					echo mvb_the_content($content);
				} else {
					echo $content;
				}

				$wp_the_query = $wp_the_query_backup;
				wp_reset_postdata();
			}
		}
	}
}

add_filter( 'woocommerce_sale_flash', 'dfd_woocommerce_custom_sales_price', 10, 3 );
function dfd_woocommerce_custom_sales_price($text, $post, $product ) {
	$percentage = '';
	if(!is_null($product->regular_price) && $product->regular_price != 0) {
		$percentage = '-'.round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 ) . '%';
	}
	return sprintf( __('<span class="onsale">' . __( '%s Sale!', 'woocommerce' ) . '</span>', 'woocommerce' ), $percentage );
}

add_filter( 'loop_shop_per_page', 'dfd_woocommerce_custom_products_number', 20 );
function dfd_woocommerce_custom_products_number() {
	global $dfd_ronneby;
	$products_number = 10;
	if(isset($dfd_ronneby['woo_category_products_number']) && !empty($dfd_ronneby['woo_category_products_number'])) {
		$products_number = $dfd_ronneby['woo_category_products_number'];
	}
	return $products_number;
}

add_filter('yith_wcwl_add_to_cart_label', 'dfd_wishlist_add_to_cart', 10);
add_filter('variable_add_to_cart_text', 'dfd_wishlist_add_to_cart', 10);

function dfd_wishlist_add_to_cart($label) {
	return '<i class="dfd-icon-shopping_bag_1"></i><span>'.$label.'</span>';
}