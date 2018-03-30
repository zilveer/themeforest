<?php
/* Footer Products */
function thb_footer_products() {
 if(class_exists('woocommerce')) {
	 $footer_products_radio = (isset($_GET['footer_products_radio']) ? htmlspecialchars($_GET['footer_products_radio']) : ot_get_option('footer_products_radio'));
	 $footer_products_sections = ot_get_option('footer_products_sections');
	 $footer_products_cat = ot_get_option('footer_products_categories');
	 $footer_products_count = ot_get_option('footer_products_count',6);
	 $footer_columns = ot_get_option('footer_columns','fourcolumns');
 ?>
	<section id="footer_products" class="footer_products cf">
		<?php if ($footer_products_radio == 'wid') { ?>
			<aside class="sidebar">
				<?php if ($footer_columns == 'fourcolumns') { ?>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer3'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer4'); ?>
				</div>
				<?php } elseif ($footer_columns == 'threecolumns') { ?>
				<div class="small-12 medium-4 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<div class="small-12 medium-4 columns">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
				<div class="small-12 medium-4 columns">
					<?php dynamic_sidebar('footer3'); ?>
				</div>
				<?php } elseif ($footer_columns == 'twocolumns') { ?>
				<div class="small-12 medium-6 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<div class="small-12 medium-6 columns">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
				<?php } elseif ($footer_columns == 'doubleleft') { ?>
				<div class="small-12 medium-6 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer3'); ?>
				</div>
				<?php } elseif ($footer_columns == 'doubleright') { ?>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
				<div class="small-12 medium-6 columns">
					<?php dynamic_sidebar('footer3'); ?>
				</div>
				<?php } elseif ($footer_columns == 'fivecolumns') { ?>
				<div class="small-12 medium-2 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
				<div class="small-12 medium-2 columns">
					<?php dynamic_sidebar('footer3'); ?>
				</div>
				<div class="small-12 medium-3 columns">
					<?php dynamic_sidebar('footer4'); ?>
				</div>
				<div class="small-12 medium-2 columns">
					<?php dynamic_sidebar('footer5'); ?>
				</div>
				<?php } elseif ($footer_columns == 'onecolumns') { ?>
				<div class="small-12 columns">
					<?php dynamic_sidebar('footer1'); ?>
				</div>
				<?php }?>
			</aside>
		<?php } else if ($footer_products_radio == 'just') { ?>
			<?php if (is_array($footer_products_sections)) { ?>
				<aside id="footer_tabs" class="footer_tabs">
					<ul>
						<?php if (in_array('just-arrived',$footer_products_sections)) { ?>
						<li><a href="#" class="active" data-type="latest-products"><?php _e('Just Arrived','north'); ?></a></li>
						<?php } ?>
						<?php if (in_array('best-sellers',$footer_products_sections)) { ?>
						<li><a href="#" <?php if (!in_array('just-arrived',$footer_products_sections)) { ?>class="active" <?php } ?>data-type="best-sellers"><?php _e('Best Sellers','north'); ?></a></li>
						<?php } ?>
						<?php if (in_array('featured',$footer_products_sections)) { ?>
						<li><a href="#" <?php if (!in_array('just-arrived',$footer_products_sections) && !in_array('best-sellers',$footer_products_sections) ) { ?>class="active" <?php } ?>data-type="featured-products"><?php _e('Featured','north'); ?></a></li>
						<?php } ?>
					</ul>
				</aside>
			<?php } ?>
			<?php if (!empty($footer_products_sections)) { ?>
				<?php 
					if (reset($footer_products_sections) == 'featured' ) {
						$args = array(
						  	'post_type'	=> 'product',
							'post_status' => 'publish',
							'ignore_sticky_posts'	=> 1,
							'posts_per_page' => $footer_products_count,
							'meta_query' => array(
								array(
									'key' => '_visibility',
									'value' => array('catalog', 'visible'),
									'compare' => 'IN'
								),
								array(
									'key' => '_featured',
									'value' => 'yes'
								)
							),
							'no_found_rows' => true,
							'suppress_filters' => 0
						);
					} else if (reset($footer_products_sections) == 'best-sellers' ) {
						$args = array(
							'post_type' => 'product',
							'post_status' => 'publish',
							'ignore_sticky_posts'   => 1,
							'posts_per_page' => $footer_products_count,
							'meta_key' 		 => 'total_sales',
							'orderby' 		 => 'meta_value',
							'meta_query' => array(
								array(
									'key' => '_visibility',
									'value' => array( 'catalog', 'visible' ),
									'compare' => 'IN'
								)
							),
							'no_found_rows' => true,
							'suppress_filters' => 0
						);
					} else if (reset($footer_products_sections) == 'just-arrived' ) {
						$args = array(
							'post_type' => 'product',
							'post_status' => 'publish',
							'ignore_sticky_posts'   => 1,
							'posts_per_page' => $footer_products_count,
							'no_found_rows' => true,
							'suppress_filters' => 0
						);
					}
					$products = new WP_Query( $args );
				?>
				<div class="carousel-container row max_width">
						<div class="carousel products slick" data-columns="6" data-navigation="true" data-loop="true">
							<?php while ( $products->have_posts() ) : $products->the_post(); ?>
									<?php wc_get_template_part( 'content', 'product' ); ?>
								<?php endwhile; // end of the loop. ?>
						</div>
						<div class="ai-dotted ai-indicator"><span class="ai-inner1"></span><span class="ai-inner2"></span><span class="ai-inner3"></span></div>
				</div>
			<?php } ?>
		<?php } else if ($footer_products_radio == 'cat') { ?>
			<?php if (is_array($footer_products_cat)) { ?>
				<aside id="footer_tabs" class="footer_tabs">
					<ul>
						<?php $i = 0; foreach($footer_products_cat as $cat) { ?>
						<?php $category = get_term_by('id',$cat,'product_cat'); ?>
						<li><a href="#"<?php if ($i == 0) { echo ' class="active"'; } ?> data-type="<?php echo $cat; ?>"><?php echo $category->name; ?></a></li>
						<?php $i++; } ?>
					</ul>
				</aside>
			<?php } ?>
			<?php if (!empty($footer_products_cat)) { ?>
			
				<?php
	 				$category = get_term_by('id',reset($footer_products_cat),'product_cat'); 
	 				$args = array(
						'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'product_cat' => $category->slug,
						'posts_per_page' => $footer_products_count,
						'no_found_rows' => true,
						'suppress_filters' => 0
					);	
					$products = new WP_Query( $args );
				?>
				<div class="carousel-container">
					<div class="carousel products no-padding owl row" data-columns="6" data-navigation="true" data-bgcheck="false">
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
								<?php wc_get_template_part( 'content', 'product' ); ?>
						<?php endwhile; // end of the loop. ?>

					</div>
					<div class="ai-dotted ai-indicator"><span class="ai-inner1"></span><span class="ai-inner2"></span><span class="ai-inner3"></span></div>
				</div>
			<?php } ?>
		<?php } // $footer_products_radio ?>
	</section>
<?php }
}
add_action( 'thb_footer_products', 'thb_footer_products',3 );

/* Side Cart */
function thb_side_cart() {
?>
 	<nav id="side-cart"></nav>
<?php
}
add_action( 'thb_side_cart', 'thb_side_cart',3 );

/* Side Cart Update */
function thb_woocomerce_side_cart_update($fragments) {
	ob_start();
	?>
		<nav id="side-cart">
		 	<header class="item">
		 		<a href="#" class="thb-close" title="<?php _e('Close', 'north'); ?>"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="12" height="12" viewBox="1.1 1.1 12 12" enable-background="new 1.1 1.1 12 12" xml:space="preserve"><path d="M8.3 7.1l4.6-4.6c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0L7.1 5.9 2.5 1.3c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2L5.9 7.1l-4.6 4.6c-0.3 0.3-0.3 0.8 0 1.2s0.8 0.3 1.2 0L7.1 8.3l4.6 4.6c0.3 0.3 0.8 0.3 1.2 0 0.3-0.3 0.3-0.8 0-1.2L8.3 7.1z"/></svg></a>
		 		<h6><?php _e('Your Cart','north'); ?></h6>
		 	</header>
			<?php if (sizeof(WC()->cart->cart_contents)>0) : ?>
				<div class="custom_scroll" id="side-cart-scroll">
					<div>
						<ul>
						<?php foreach (WC()->cart->cart_contents as $cart_item_key => $cart_item) :
						    $_product = $cart_item['data'];
						    if ($_product->exists() && $cart_item['quantity']>0) :?>
							<li class="item">
								<figure>
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
										if ( ! $_product->is_visible() )
											echo $thumbnail;
										else
											printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
									?>
								</figure>
					
								<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">×</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __('Remove this item','north') ), $cart_item_key ); ?>
								
								<div class="list_content">
									<?php
									 $product_title = $_product->get_title();
								       echo '<h5><a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a></h5>';
								       echo '<span class="quantity">'.$cart_item['quantity'].'</span><span class="cross">×</span>';
								       echo '<div class="price">'.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ).'</div>';
								       
									?>
								</div>
							</li>
						<?php endif; endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="subtotal item">
				    <?php _e('Subtotal', 'north'); ?><span><?php echo WC()->cart->get_cart_total(); ?></span>
				</div>
				<div class="buttons item">
					<a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="btn large full"><?php _e('View Cart', 'north'); ?></a>
			
					<a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="btn large full accent"><?php _e('Checkout', 'north'); ?></a>
				</div>
			<?php else: ?>
				<div class="cart-empty text-center">
					<div>
						<figure class="item"></figure>
						<p class="message item"><?php _e( 'Your cart is currently empty.', 'north') ?></p>
						<?php do_action( 'woocommerce_cart_is_empty' ); ?>
						
						<p class="return-to-shop item"><a class="button wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'north' ) ?></a></p>
					</div>
				</div>
			<?php endif; ?>
		</nav>
	<?php
	$fragments['#side-cart'] = ob_get_clean();
	return $fragments;

}
add_filter('add_to_cart_fragments', 'thb_woocomerce_side_cart_update');

/* Header Cart */
function thb_quick_cart() {
	$header_style = ot_get_option('header_style', 'style1');
	if(class_exists('woocommerce')) {
		if ($header_style === 'style1') {
			?>
		<a id="quick_cart" data-target="open-cart" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php _e('View your Cart','north'); ?>"><svg xmlns="http://www.w3.org/2000/svg" id="cart-icon" version="1.1" x="0" y="0" width="19" height="18" viewBox="0 0 19 18" enable-background="new 0 0 19 18.006" xml:space="preserve"><path class="handle icon-fill" d="M6.5 5.3C6.5 2.9 6.9 1.8 9.5 1.8c2.6 0 3 1.2 3 3.6v0.4h1.9V5.3C14.4 1.9 13.2 0 9.5 0 5.8 0 4.6 1.9 4.6 5.3v0.4h1.9V5.3z"/><path class="icon-fill" fill-rule="evenodd" clip-rule="evenodd" d="M17 0H2c-1.4 0-2 0.8-2 2.1v13.4c0 1.3 1.2 2.4 2.6 2.4H16.4c1.4 0 2.6-1.1 2.6-2.4V2.1C19 0.8 18.4 0 17 0z"/></svg>
	
	
			<span class="float_count" id="float_count"><?php echo WC()->cart->cart_contents_count; ?></span>
		</a>
	<?php
		} else {
	?>
		<a id="quick_cart" data-target="open-cart" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php _e('View your Cart','north'); ?>"><svg xmlns="http://www.w3.org/2000/svg" id="cart-icon" version="1.1" x="0" y="0" width="19" height="18" viewBox="0 0 19 18" enable-background="new 0 0 19 18.006" xml:space="preserve"><path class="handle icon-fill" d="M6.5 5.3C6.5 2.9 6.9 1.8 9.5 1.8c2.6 0 3 1.2 3 3.6v0.4h1.9V5.3C14.4 1.9 13.2 0 9.5 0 5.8 0 4.6 1.9 4.6 5.3v0.4h1.9V5.3z"/><path class="icon-fill" fill-rule="evenodd" clip-rule="evenodd" d="M17 0H2c-1.4 0-2 0.8-2 2.1v13.4c0 1.3 1.2 2.4 2.6 2.4H16.4c1.4 0 2.6-1.1 2.6-2.4V2.1C19 0.8 18.4 0 17 0z"/></svg><span class="cart_text"><?php _e('Cart','north'); ?> (</span><span class="float_count" id="float_count"><?php echo WC()->cart->cart_contents_count; ?></span><span class="cart_text">)</span>
		</a>
	<?php
		}
	}
}
add_action( 'thb_quick_cart', 'thb_quick_cart',3 );

/* Header Wishlist */
function thb_quick_wishlist() {
 ?>
	<?php if(class_exists('YITH_WCWL')) { ?>
		<a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" title="<?php _e('Wishlist', 'north'); ?>" id="quick_wishlist"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="20" height="18" viewBox="0 0 20 18" enable-background="new 0 0 20.033 18.004" xml:space="preserve"><path d="M18.4 10l-4.4 4.6 0 0 -2.6 2.8c-0.7 0.8-1.9 0.8-2.6 0l-2.6-2.8 0 0 -4.4-4.6c-2.2-2.3-2.2-6 0-8.3 2.2-2.3 5.7-2.3 7.9 0l0.4 0.5 0.4-0.5c2.2-2.3 5.7-2.3 7.9 0C20.6 4 20.6 7.7 18.4 10L18.4 10zM17.1 3c-1.6-1.7-4.2-1.7-5.8 0l-1.2 1.3L8.8 3c-1.6-1.7-4.2-1.7-5.8 0 -1.6 1.7-2.1 3.5 0 6.1l4.2 4.4 0 0 2.5 2.6c0.2 0.2 0.6 0.2 0.8 0l3.3-3.5h0l3.3-3.5C19 6.9 18.7 4.7 17.1 3L17.1 3z"/></svg></a>
	<?php } ?>
<?php
}
add_action( 'thb_quick_wishlist', 'thb_quick_wishlist',3 );

/* Product Badges */
function thb_product_badge() {
 global $post, $product;
 	if (thb_out_of_stock()) {
		echo '<span class="badge out-of-stock">' . __( 'Out of Stock', 'north' ) . '</span>';
	} else if ( $product->is_on_sale() ) {
		if (ot_get_option('shop_sale_badge', 'text') == 'discount') {
			if ($product->product_type == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1 ->regular_price;
					$sales_price = $variable_product1 ->sale_price;
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->product_type == 'simple'){
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			} else if ($product->product_type == 'external'){
				$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.__( 'Sale','north' ).'</span>', $post, $product);
		}
	} else {
		$postdate 		= get_the_time( 'Y-m-d' );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness = ot_get_option('shop_newness', 7);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp) { // If the product was published within the newness time frame display the new badge
			echo '<span class="badge new">' . __( 'Just Arrived', 'north' ) . '</span>';
		}
		
	}
}
add_action( 'thb_product_badge', 'thb_product_badge',3 );

/* WOOCOMMERCE CART LINK */
function thb_woocomerce_ajax_cart_update($fragments) {
	if(class_exists('woocommerce')) {

		ob_start();
		?>
			<span class="float_count" id="float_count"><?php echo WC()->cart->cart_contents_count; ?></span>
		<?php
		$fragments['#float_count'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('add_to_cart_fragments', 'thb_woocomerce_ajax_cart_update');

/* Image Dimensions */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'thb_woocommerce_image_dimensions', 1 );

function thb_woocommerce_image_dimensions() {
  $catalog = array(
		'width' 	=> '720',	// px
		'height'	=> '900',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '1000',	// px
		'height'	=> '1000',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '90',	// px
		'height'	=> '90',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
/* WishList Button*/
function thb_wishlist_button() {

	global $product; 
	
	if ( class_exists( 'YITH_WCWL_UI' ) )  {
		$url = YITH_WCWL()->get_wishlist_url();
		$product_type = $product->product_type;
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		
		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}

		$exists = YITH_WCWL()->is_product_in_wishlist( $product->id, $default_wishlist );
		
		
		$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
		
		$html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'.$product->id.'">'; 
    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
    
    $html .= $exists ? ' hide" style="display:none;"' : ' show"';
    
    $html .= '><a href="' . htmlspecialchars(YITH_WCWL()->get_addtowishlist_url()) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><span class="text"><i>'.__( "Add To Wishlist", 'north' ).'</i></span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="wishlist_icon" x="0" y="0" width="12.6" height="11" viewBox="0 0 12.6 11" enable-background="new 0 0 12.584 11" xml:space="preserve"><path fill="#010101" d="M6.3 10.5c0 0 0 0-0.1 0C4.1 9 0.5 6 0.5 4 0.5 2.3 1.8 0.5 3.7 0.5c0.9 0 1.6 0.3 2.2 1l0.4 0.5 0.4-0.5C7.2 0.8 8 0.5 8.9 0.5c1.9 0 3.2 1.8 3.2 3.5 0 2-3.6 5.1-5.7 6.5L6.3 10.5z"/></svg>
    </a>';
    $html .= '</div>';
		
		$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url($url) . '"><span class="text"><i>'.__( "Added to Wishlist", 'north' ).'</i></span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="wishlist_icon" x="0" y="0" width="12.6" height="11" viewBox="0 0 12.6 11" enable-background="new 0 0 12.584 11" xml:space="preserve"><path fill="#010101" d="M6.3 10.5c0 0 0 0-0.1 0C4.1 9 0.5 6 0.5 4 0.5 2.3 1.8 0.5 3.7 0.5c0.9 0 1.6 0.3 2.2 1l0.4 0.5 0.4-0.5C7.2 0.8 8 0.5 8.9 0.5c1.9 0 3.2 1.8 3.2 3.5 0 2-3.6 5.1-5.7 6.5L6.3 10.5z"/></svg></a></div>';
		
		$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url($url) . '"><span class="text"><i>'.__( "View Wishlist", 'north' ).'</i></span><svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="wishlist_icon" x="0" y="0" width="12.6" height="11" viewBox="0 0 12.6 11" enable-background="new 0 0 12.584 11" xml:space="preserve"><path fill="#010101" d="M6.3 10.5c0 0 0 0-0.1 0C4.1 9 0.5 6 0.5 4 0.5 2.3 1.8 0.5 3.7 0.5c0.9 0 1.6 0.3 2.2 1l0.4 0.5 0.4-0.5C7.2 0.8 8 0.5 8.9 0.5c1.9 0 3.2 1.8 3.2 3.5 0 2-3.6 5.1-5.7 6.5L6.3 10.5z"/></svg></a></div>';
		
		$html .= '</div>';
		
		echo $html;
		
	}

}

function thb_sizing_guide() {
	$sizing_guide = get_post_meta(get_the_ID(), 'sizing_guide', true);
	$sizing_guide_content = get_post_meta(get_the_ID(), 'sizing_guide_content', true);
	$sizing_guide_text = get_post_meta(get_the_ID(), 'sizing_guide_text', true);
	
	$text = $sizing_guide_text ? $sizing_guide_text : __("VIEW SIZING GUIDE", 'north');
	
	if ($sizing_guide == 'on') {
		echo '<a href="#sizing-popup" rel="inline" class="sizing_guide" data-class="upsell-popup">'.$text.'</a>';
		
		?>
		<aside id="sizing-popup" class="mfp-hide theme-popup text-left">
				<?php echo do_shortcode($sizing_guide_content); ?>
		</aside>
		<?php
	}
}

/* Menu Icon Modification */
function thb_new_menu_items( $items ) {
		unset($items['dashboard']);
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'thb_new_menu_items' );

/* Shop Headers */
add_action( 'woocommerce_before_main_content', function() { if (is_shop() || is_archive()) { return get_template_part( 'inc/header/header-shop' ); } }, 5 );

/* Shop Page - Remove orderby & breadcrumb */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'thb_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'thb_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

/* Shop Page - Remove Breadcrumb */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/* Category Text */
function thb_before_subcategory_title() {
	echo '<div>';
}
add_action( 'woocommerce_before_subcategory_title', 'thb_before_subcategory_title', 15 );
function thb_subcategory_title() {
	echo '<span>'.esc_html__('Explore Now','north').'</span>';
}
add_action( 'woocommerce_shop_loop_subcategory_title', 'thb_subcategory_title', 15 );
function thb_after_subcategory_title() {
	echo '</div>';
}
add_action( 'woocommerce_after_subcategory_title', 'thb_after_subcategory_title', 15 );

/* Change Category Thumbnail Size */
function thb_template_loop_category_link_open($category) {
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full'  );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}
	echo '<a href="' . get_term_link( $category, 'product_cat' ) . '" style="background-image:url('.esc_url($image).')">';
}
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
add_action( 'woocommerce_before_subcategory', 'thb_template_loop_category_link_open', 10);

/* Cart Page - Move Crosssells */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );