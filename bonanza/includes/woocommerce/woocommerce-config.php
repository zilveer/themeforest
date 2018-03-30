<?php

add_action('init', 'icore_woocommerce_image_dimensions', 1);

/***  Define Image Sizes  ***/
function icore_woocommerce_image_dimensions() {

    //Single Image
	update_option( 'shop_single_image_size', array('height'=>'642', 'width' => '642', 'crop' => 0 ));
	
    //Thumbnail Image
	update_option( 'shop_thumbnail_image_size', array('height'=>'138', 'width' => '138', 'crop' => 1 ));
	
	//Catalog Image
	update_option( 'shop_catalog_image_size', array('height'=>'400', 'width' => '400', 'crop' => 1 ));

	
}

// Set Woocommerce Options to False
$option_set_false = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');
foreach ($option_set_false as $option) { update_option($option, false); }


global $woocommerce_loop;
$icore = array();
$woocommerce_loop['columns'] = 3;
$icore['shop_single_column'] 	 = 4;		 // columns for related products and upsells
$icore['shop_single_column_items'] 	 = 4;	// number of items for related products and upsells   


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);  
add_action( 'woocommerce_after_single_product_summary', 'icore_woocommerce_output_related_products', 20);

// display upsells and related products
function icore_woocommerce_output_related_products()
{	
	global $icore;
	echo "<div class='product_column product_column_".$icore['shop_single_column']."'>";
	woocommerce_related_products( array( "columns" => 4 ) ); // 5 products, 5 columns
	echo "</div>";
}

remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display');  
add_action( 'woocommerce_single_product_summary', 'icore_woocommerce_output_upsells', 70); 

function icore_woocommerce_output_upsells() 
{
	global $icore;
	echo "<div class='product_column product_column_".$icore['shop_single_column']."'>";
	woocommerce_upsell_display(4,4); // 5 products, 5 columns
	echo "</div>";
}


//remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
//remove_action('woocommerce_cart_sidebar', 'woocommerce_get_sidebar');

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item', 'icore_woocommerce_thumbnails', 10);

function icore_woocommerce_thumbnails()
{
	//circumvent the missing post and product parameter in the loop_shop template
	global $post, $product, $woocommerce;
	$_product = $product;
	$small_thumbnail_size = apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail');
	$large_thumbnail_size = apply_filters('single_product_large_thumbnail_size', 'shop_single');
	
	echo "<div class='product-thumb-wrap'>";
	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		?>	
			<div class="flexslider">
				<ul class="slides">
					<?php

					$loop = 0;

					foreach ( $attachment_ids as $id ) {

						$attachment_url = wp_get_attachment_url( $id );
						$large_image = wp_get_attachment_image($id, $large_thumbnail_size);

						if ( ! $attachment_url )
							continue;
						?>
				 		<li>                                      
		            		<div class="archive-product-image">
		            			<?php echo '<a href="'. get_permalink() .'" >'; ?>
		            			<?php echo $large_image; ?>
								<?php echo '</a>'; ?>
		            		</div>
						</li>
						<?php

						$loop++;

					} ?>

				</ul><!-- .slides -->

			</div><!-- .flexslider -->


	<?php

	} else {

		if (has_post_thumbnail()) : $thumb_id = get_post_thumbnail_id();  ?>
	        <div class="archive-product-image">
	  		<a href="<?php echo get_permalink(); ?>" ><?php echo get_the_post_thumbnail($post->ID, array(650,440)); ?></a>
	        </div>
	  	<?php else : ?>
	  		<img src="<?php echo $woocommerce->plugin_url() ?>/assets/images/placeholder.png" alt="Placeholder" />
	  	<?php endif;
	}
	echo "</div>";
}




/*-----------------------------------------------------------------------------------*/
/* WooCommerce Template Hooks */
/*-----------------------------------------------------------------------------------*/

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
add_action( 'woocommerce_before_single_product_summary', 'icore_show_product_images', 20); 
	
if (!function_exists('icore_show_product_images')) {
	function icore_show_product_images() {
	    get_template_part('includes/woocommerce/single-product/product-thumbnails');
	}
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart'); 

//add_action('wp', create_function("", "if (is_singular(array('product'))) remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);") );


 
/*-----------------------------------------------------------------------------------*/
/* WooCommerce Options Hooks */
/*-----------------------------------------------------------------------------------*/ 

add_filter('woocommerce_general_settings','icore_woocommerce_general_settings_filter'); 

function icore_woocommerce_general_settings_filter($theme_options)
{  
	$remove   = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');
	
	foreach ($theme_options as $key => $option)
	{
		if( isset($option['id']) && in_array($option['id'], $remove) ) 
		{  
			unset($theme_options[$key]); 
		}
	}

	return $theme_options;
}


/*-----------------------------------------------------------------------------------*/
/* Shopping Cart Header Menu */
/*-----------------------------------------------------------------------------------*/

function icore_woocommerce_cart_menu()
{
	global $woocommerce;
	
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$cart_link = $woocommerce->cart->get_cart_url();
	$checkout_link = $woocommerce->cart->get_checkout_url();
	$my_account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
	ob_start();
	if ( WOOCOMMERCE_VERSION < '2.0' ) {
		the_widget('WooCommerce_Widget_Cart', '', array('widget_id'=>'cart-dropdown',
	        'before_widget' => '',
	        'after_widget' => '',
	        'before_title' => '<span class="hidden">',
	        'after_title' => '</span>'
	    ));
	} else {
    	the_widget('WC_Widget_Cart', '', array('widget_id'=>'cart-dropdown',
	        'before_widget' => '',
	        'after_widget' => '',
	        'before_title' => '<span class="hidden">',
	        'after_title' => '</span>'
	    ));	
	}
    $widget = ob_get_clean();
	
	$output = '';
	$output = "<div id='cart-menu-inner'>";	
	$output .= "<ul class = 'cart_dropdown' data-success='".__('Product added', 'Bonanza')."'><li class='cart_dropdown_first'>";	
	$output .= "<a class='cart_dropdown_link menu-link' href='#'>".__('Cart:', 'Bonanza')."</a><span class='cart_subtotal'>".$cart_subtotal."</span>";
	$output .= '<span class="hidecart-icon">Hide Cart</span>';
	$output .= "<div class='dropdown_widget dropdown_widget_cart'>";
	$output .= $widget;
	$output .= "</div>";
	$output .= "</li></ul>";
	$output .= "</div>";
	  	
	
	return $output;
}


remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

// WooCommerce BreadCrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
add_action( 'woo_breadcrumbs', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woo_ordering', 'woocommerce_catalog_ordering', 30 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// Remove Star Rating from archive products
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

function woo_related_products_limit() {
  global $product, $orderby, $related;

	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> 4,
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> 'rand',
		'post__in'            	=> $related,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
?>