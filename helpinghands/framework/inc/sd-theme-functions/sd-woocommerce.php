<?php
/**
 * Theme WooCommerce Functions
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// Add WooCommerce support
add_theme_support( 'woocommerce' );

// Remove styling

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Number of products to display on the shop page

if ( !function_exists( 'sd_prods_nr' ) ) {
	function sd_prods_nr() {

		global $sd_data;
		
		$number_of_prods = ( ! empty( $sd_data['sd_products_nr'] ) ? $sd_data['sd_products_nr'] : '21' );

		$prods_nr = 'return ' . $number_of_prods . ';';
		
		add_filter( 'loop_shop_per_page', create_function( '$cols', $prods_nr ), 20 );
	}
	add_action( 'init', 'sd_prods_nr' );
}
// Change number of upsells per row and columns

if ( !function_exists( 'sd_woo_related_products_limit' ) ) {
	function sd_woo_related_products_limit() {
	  global $product;
	
		$args['posts_per_page'] = 4;
		return $args;
	}
}

if ( !function_exists( 'sd_related_products_args' ) ) {
	function sd_related_products_args( $args ) {

		$args['posts_per_page'] = 4;
		$args['columns'] = 4;
		return $args;
	}
	add_filter( 'woocommerce_output_related_products_args', 'sd_related_products_args' );
}

// Change number of upsells per row

if ( !function_exists( 'sd_woo_upsells' ) ) {
	function sd_woo_upsells() {
			woocommerce_upsell_display( 4, 4 );
	}
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'sd_woo_upsells', 15 );
} 

// Change number of cross sells per row

if ( !function_exists ( 'sd_woo_cross_sells' ) ) {
	function sd_woo_cross_sells( $columns ) {

		return 4;
	}
	add_filter( 'woocommerce_cross_sells_columns', 'sd_woo_cross_sells', 10, 1 );
}

// Change number of products per row

if ( !function_exists( 'sd_loop_columns' ) ) {
	function sd_loop_columns() {
		
		global $sd_data;
		 
		if ( $sd_data['sd_shop_page_sidebar'] == 1 ) {
			return 3;
		} else {
			return 4;	
		}
	}
	add_filter( 'loop_shop_columns', 'sd_loop_columns' );
}

// Rearrange content product

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Rearrange single product

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 29 );

// on single product pages

if ( !function_exists( 'sd_woo_custom_cart_button_text' ) ) {
	function sd_woo_custom_cart_button_text() {
	
	  global $woocommerce;
		
		foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
		
			if( get_the_ID() == $_product->id ) {
				return __('Add Again?', 'sd-framework');
			}
		}
		
		return __('Add to cart', 'sd-framework');
	}
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'sd_woo_custom_cart_button_text' );
}

// on product archive

if ( !function_exists( 'sd_woo_archive_custom_cart_button_text' ) ) {
	function sd_woo_archive_custom_cart_button_text() {
	
		global $woocommerce;
		
		foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
		
			if( get_the_ID() == $_product->id ) {
				return __('Add Again?', 'sd-framework');
			}
		}
		
		return __('Add to cart', 'sd-framework');
	}
	
	add_filter( 'woocommerce_product_add_to_cart_text', 'sd_woo_archive_custom_cart_button_text' );
}

// Alter price html

if ( !function_exists( 'sd_price_html' ) ) {
	function sd_price_html( $price, $product ){
		return str_replace( '</del>', '</del><br />', $price );
	}
	add_filter( 'woocommerce_get_price_html', 'sd_price_html', 100, 2 );
}

// display out of stock

if ( !function_exists( 'sd_out_of_stock' ) ) {
	function sd_out_of_stock()  {
		global $product;
	
		if ( !$product->is_in_stock() ) {
			echo '<span class="sd-soldout"><span>' . __( 'Sold Out', 'woocommerce' ) . '</span></span>';
		}
	}
	add_action( 'woocommerce_before_shop_loop_item_title', 'sd_out_of_stock' );
	add_action( 'woocommerce_before_single_product_summary', 'sd_out_of_stock' );
}
// change sale badge
if ( !function_exists( 'sd_sale_badge' ) ) {
	function sd_sale_badge( $html ) {
		$out = '<span class="onsale"><span>' . __( 'Sale!', 'woocommerce' ) . ' </span></span>';
		
		return $out;
	}
	add_filter( 'woocommerce_sale_flash', 'sd_sale_badge' );
}

// remove sale badge from single product

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// remove breadcrumbs
if ( !function_exists( 'sd_remove_woo_breadcrumbs' ) ) {
	function sd_remove_woo_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
	add_action( 'init', 'sd_remove_woo_breadcrumbs' );
}

// Add share icons to single product

if ( !function_exists ( 'sd_single_product_share_icons' ) ) {
	function sd_single_product_share_icons() {
		
		global $post;
		
		$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );
?>
		<ul>
			<li>
				<a class="sd-link-trans" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>&amp;t=<?php echo urlencode( get_the_title() ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'sd-framework' ) ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>
			</li>
			
			<li>
				<a class="sd-link-trans" href="http://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>: <?php echo urlencode( get_permalink() ); ?>" title="<?php esc_attr_e( 'Share on Twitter', 'sd-framework' ) ?>" target="_blank" rel="nofollow" ><i class="fa fa-twitter"></i></a>
			</li>
			
			<li>
				<a class="sd-link-trans" href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" title="<?php esc_attr_e( 'Share on Google Plus', 'sd-framework' ) ?>" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a>
			</li>
			<li>
				<a class="sd-link-trans" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink() ); ?>&amp;media=<?php echo $product_image[0]; ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>" title="<?php esc_attr_e( 'Pin on Pinterest', 'sd-framework' ) ?>" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a>
			</li>			
			<li>
				<a class="sd-link-trans" href="mailto:?subject=<?php echo urlencode( get_the_title() );?>&amp;body=<?php echo urlencode( get_permalink() ); ?>" title="<?php esc_attr_e( 'Share on E-Mail', 'sd-framework' ) ?>" target="_blank" rel="nofollow"><i class="fa fa-envelope"></i></a>
			</li>
		</ul>	
		
<?php	
	}
	//add_action('woocommerce_share','sd_single_product_share_icons');
}

// Change category thumb to full size

function sd_cat_thumb( $category ) {
    
	$small_thumbnail_size = apply_filters( 'single_product_small_thumbnail_size', 'full' );
    $dimensions = wc_get_image_size( $small_thumbnail_size );
    $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
     
    if ( $thumbnail_id ) {
        $image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
        $image = $image[0];
    } else {
        $image = wc_placeholder_img_src();
    }
     
    if ( $image ) { 
        $image = str_replace( ' ', '%20', $image );
        echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
    }
}


// Set image dimensions upon theme activation
if ( !function_exists ( 'sd_woo_image_dimensions' ) ) {
	function sd_woo_image_dimensions() {
		global $pagenow;
	 
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}
	
		$catalog = array(
			'width' 	=> '262',	// px
			'height'	=> '305',	// px
			'crop'		=> 1 		// true
		);
	
		$single = array(
			'width' 	=> '460',	// px
			'height'	=> '530',	// px
			'crop'		=> 1 		// true
		);
	
		$thumbnail = array(
			'width' 	=> '120',	// px
			'height'	=> '120',	// px
			'crop'		=> 1 		// false
		);
	
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}

	add_action( 'after_switch_theme', 'sd_woo_image_dimensions', 1 );
}

// Ajax header cart

if ( ! function_exists( 'sd_add_to_cart_fragment' ) ) {
	function sd_add_to_cart_fragment( $fragments ) {
	
		global $woocommerce;
	
		ob_start();
?>

			<div class="sd-minicart-modal mfp-with-anim mfp-hide">
				<div class="sd-minicart clearfix">
					<ul class="sd-header-cart-list">
						<li>
							<?php if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ) { ?>
								<h4>
									<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php esc_attr_e('View shopping cart', 'sd-framework'); ?>">
										<?php printf( _n( '%d item in the cart', '%d items in the cart', $woocommerce->cart->cart_contents_count, 'sd-framework' ), $woocommerce->cart->cart_contents_count); ?> (<?php echo $woocommerce->cart->get_cart_total(); ?>)
									</a>
								</h4>
				
								<?php foreach ( $woocommerce->cart->cart_contents as $sd_item_key => $sd_item ) { ?>
									
									<?php
										$sd_cart_item = $sd_item['data']; 
										$sd_product_title = $sd_cart_item->get_title(); 
									?>
									
									<?php if ( $sd_cart_item->exists() && $sd_item['quantity'] > 0 ) { ?>
										
										<div class="sd-header-cart-wrapper clearfix">
											<a href="<?php echo get_permalink( $sd_item['product_id'] ); ?>"><?php echo $sd_cart_item->get_image(); ?></a>
											
											<div class="sd-header-cart-content">	
												<h5><a href="<?php echo get_permalink( $sd_item['product_id'] ); ?>"> <?php echo apply_filters( 'woocommerce_cart_widget_product_title', $sd_product_title, $sd_cart_item ); ?></a></h5>
												<span class="sd-top-cart-price">
													<?php _e( 'Price:', 'sd-framework' ); ?>
													<?php echo woocommerce_price( $sd_cart_item->get_price() ); ?>
												</span>
												
												<span class="sd-top-cart-quant">
													<?php _e('Quantity:', 'sd-framework'); ?>
													<?php echo $sd_item['quantity']; ?>
												</span>
						
												<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="sd-remove-from-cart" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $sd_item_key ) ), __( 'Remove item', 'woocommerce' ) ), $sd_item_key ); ?>
											</div>
											<!-- sd-header-cart-content -->
										</div>
										<!-- sd-header-cart-wrapper -->
									<?php } ?>
								<?php } ?>
				
				
								<a class="sd-header-view-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">	<?php _e( 'View cart', 'sd-framework' ); ?>	</a>
								<a class="sd-header-checkout sd-opacity-trans" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>">	<?php _e( 'Go to checkout', 'sd-framework' ); ?></a>
				
				
							<?php } else { ?>
							
								<h4><?php _e('Your shopping cart is empty.', 'sd-framework' ); ?></h4>
							
								<?php $sd_shop_page_url = get_permalink( get_option( 'woocommerce_shop_page_id' ) ); ?>
								
								<a class="sd-header-view-cart" href="<?php echo esc_url( $sd_shop_page_url ); ?>"> <?php _e( 'Go to the shop', 'sd-framework' ); ?></a>
							<?php } ?>
						</li>
					</ul>
				</div>
				<!-- sd-minicart -->
				<button class="mfp-close sd-bg-trans" type="button" title="<?php esc_attr_e( 'Close', 'sd-framework' ); ?> (Esc)">×</button>
			</div>
			<!-- sd-minicart-modal -->
		<?php
			$fragments['.sd-minicart-modal'] = ob_get_clean();
	
			return $fragments;
				
	}
	add_filter('add_to_cart_fragments', 'sd_add_to_cart_fragment');
}

if ( !function_exists( 'sd_add_to_cart_fragment_menu' ) ) {
	function sd_add_to_cart_fragment_menu( $fragments ) {
	
		global $woocommerce;
	
		ob_start();
?>
		<?php 
			if ( sizeof( $woocommerce->cart->cart_contents ) > 0 ) {
			$count = $woocommerce->cart->cart_contents_count;
			$nr = '<span class="sd-nr sidr-class-sd-nr"><span class="sd-items-count">' . $count . '</span></span>';
		} else {
			$nr = '<span class="sd-nr sidr-class-sd-nr"></span>';	
		}
		?>
			<?php echo $nr; ?>
		<?php
			$fragments['.sidr-class-sd-nr'] = ob_get_clean();
	
			return $fragments;
				
	}
	add_filter('add_to_cart_fragments', 'sd_add_to_cart_fragment_menu');
}

// check if empty array value

if ( ! function_exists ( 'sd_is_empty' ) ) {
	function sd_is_empty( $array ) {
		foreach ( $array as $k => $v ) {
			if ( empty( $v['image_src'] ) ) {
				return false;
			} else {
				return true;	
			}
		}
	}
}