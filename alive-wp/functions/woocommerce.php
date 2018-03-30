<?php


function is_woocommerce_enabled()
{
	if (defined("WOOCOMMERCE_VERSION")) { return true; }
	return false;
}


//check if the plugin is enabled, otherwise stop the script
if(!is_woocommerce_enabled()) { return false; }


//register my own styles, remove wootheme stylesheet
if(!is_admin()){
	add_action('init', 'theme_woocommerce_register_assets');
}

function theme_woocommerce_register_assets()
{	
global $post;
	wp_enqueue_style('theme-woocommerce', THEME_URL . '/css/woocommerce.css');
	//wp_enqueue_script('theme-woocommerce-js', THEME_URL . '/js/woocommerce.js', array('woocommerce'), null, true);
	
	remove_action( 'wp_enqueue_scripts', array($GLOBALS['woocommerce'], 'frontend_scripts') );
	
	$suffix = "";
	$lightbox_en 			= get_option('woocommerce_enable_lightbox') == 'yes' ? true : false;
	$chosen_en 				= get_option( 'woocommerce_enable_chosen' ) == 'yes' ? true : false;
	$frontend_script_path 	= THEME_URL . '/js/woocommerce/';
	
	// Register any scipts for later use, or used as dependencies
	wp_enqueue_script( 'chosen', $GLOBALS['woocommerce']->plugin_url() . '/assets/js/chosen/chosen.jquery' . $suffix . '.js', array( 'jquery' ), '1.6', true );
	wp_register_script( 'jquery-ui', $GLOBALS['woocommerce']->plugin_url() . '/assets/js/jquery-ui' . $suffix . '.js', array( 'jquery' ), '1.6', true );
	wp_register_script( 'jquery-plugins', $GLOBALS['woocommerce']->plugin_url() . '/assets/js/jquery-plugins' . $suffix . '.js', array( 'jquery' ), '1.6', true );
	
	//wp_enqueue_style( 'woocommerce_chosen_styles', $GLOBALS['woocommerce']->plugin_url() . '/assets/css/chosen.css' );
	
	// Global frontend scripts
	wp_enqueue_script( 'woocommerce', $frontend_script_path . 'woocommerce' . $suffix . '.js', array( 'jquery', 'jquery-plugins' ), '1.6', true );
	
	// Variables for JS scripts
	$woocommerce_params = array(
		'countries' 					=> json_encode( $GLOBALS['woocommerce']->countries->states ),
		'select_state_text' 			=> __( 'Select an option&hellip;', 'woocommerce' ),
		'plugin_url' 					=> $GLOBALS['woocommerce']->plugin_url(),
		'ajax_url' 						=> $GLOBALS['woocommerce']->ajax_url(),
		'required_rating_text'			=> esc_attr__( 'Please select a rating', 'woocommerce' ),
		'review_rating_required'		=> get_option( 'woocommerce_review_rating_required' ),
		'required_text'					=> esc_attr__( 'required', 'woocommerce' ),
		'update_order_review_nonce' 	=> wp_create_nonce( "update-order-review" ),
		'apply_coupon_nonce' 			=> wp_create_nonce( "apply-coupon" ),
		'option_guest_checkout'			=> get_option( 'woocommerce_enable_guest_checkout' ),
		'checkout_url'					=> add_query_arg( 'action', 'woocommerce-checkout', $GLOBALS['woocommerce']->ajax_url() ),
		'is_checkout'					=> is_page( woocommerce_get_page_id( 'checkout' ) ) ? 1 : 0,
		'update_shipping_method_nonce' 	=> wp_create_nonce( "update-shipping-method" ),
		'add_to_cart_nonce' 			=> wp_create_nonce( "add-to-cart" )
	);
	
	
	$woocommerce_params['locale'] = json_encode( $GLOBALS['woocommerce']->countries->get_country_locale() );
	
	wp_localize_script( 'woocommerce', 'woocommerce_params', apply_filters( 'woocommerce_params', $woocommerce_params ) );
}

define('WOOCOMMERCE_USE_CSS', false);


/*-----------------------------------------------------------------------------------*/
/* Hook in on activation */
/*-----------------------------------------------------------------------------------*/

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'theme_woocommerce_image_dimensions', 1);

/*-----------------------------------------------------------------------------------*/
/* Define image sizes / hard crop */
/*-----------------------------------------------------------------------------------*/

function theme_woocommerce_image_dimensions() {

// Image sizes
update_option( 'woocommerce_thumbnail_image_width', '90' ); // Image gallery thumbs
update_option( 'woocommerce_thumbnail_image_height', '90' );
update_option( 'woocommerce_single_image_width', '500' ); // Featured product image
update_option( 'woocommerce_single_image_height', '300' ); 
update_option( 'woocommerce_catalog_image_width', '250' ); // Product category thumbs
update_option( 'woocommerce_catalog_image_height', '250' );

// Hard Crop [0 = false, 1 = true]
update_option( 'woocommerce_thumbnail_image_crop', 1 );
update_option( 'woocommerce_single_image_crop', 0 ); 
update_option( 'woocommerce_catalog_image_crop', 1 );

}




######################################################################
# config
######################################################################

//set woocommerce page options, including columns and product count, meta etc..



######################################################################
# Create the correct template html structure
######################################################################

//remove woo defaults
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
//single page removes
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30, 2 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 2);

remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action( 'woocommerce_before_single_product', 'woocommerce_show_messages', 10);




//add theme actions && filter
add_action( 'woocommerce_before_main_content', 'theme_woocommerce_before_main_content', 10);
add_action( 'woocommerce_after_main_content', 'theme_woocommerce_after_main_content', 10);
add_action( 'woocommerce_before_shop_loop', 'theme_woocommerce_before_shop_loop', 1);
add_action( 'woocommerce_after_shop_loop', 'theme_woocommerce_after_shop_loop', 10);
add_action( 'woocommerce_before_shop_loop_item', 'theme_woocommerce_thumbnail', 10);
add_action( 'woocommerce_before_subcategory_title', 'theme_woocommerce_subcategory_thumbnail', 10);
add_action( 'woocommerce_after_shop_loop_item_title', 'theme_woocommerce_overview_excerpt', 10);
add_filter( 'loop_shop_columns', 'theme_woocommerce_loop_columns');
add_filter( 'loop_shop_per_page', 'theme_woocommerce_product_count' );
add_filter( 'woocommerce_cart_item_remove_link', 'theme_woocommerce_cart_remove',10, 2 );

//single page adds
//add_action( 'woocommerce_before_single_product', 'check_theme_title', 1);
add_action( 'woocommerce_before_single_product', 'theme_single_product_heading', 10);
add_action( 'woocommerce_before_single_product_summary', array($woocommerce, 'show_messages'), 10);
add_action( 'woocommerce_single_product_summary', 'theme_woocommerceproduct_prev_image', 10,  2);
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 30);
add_action( 'woocommerce_single_product_summary', 'theme_woocommerce_output_related_products', 60);
add_action( 'woocommerce_single_product_summary', 'theme_woocommerce_output_upsells', 70);

//add_action( 'woocommerce_before_single_product_summary', 'theme_add_summary_div', 2);
//add_action( 'woocommerce_after_single_product_summary',  'theme_close_summary_div', 1000);
add_action( 'theme_add_to_cart', 'woocommerce_template_single_add_to_cart', 30, 2 );

//add_action( 'woocommerce_product_thumbnails', 'theme_woocommerceproduct_prev_image_after', 1000 );

add_filter( 'single_product_small_thumbnail_size', 'theme_woocommerce_thumb_size');




######################################################################
# FUNCTIONS
######################################################################




function theme_add_summary_div()
{

	echo "<div>";
}

function theme_close_summary_div()
{
	echo "</div>";
}

function theme_woocommerce_cart_remove($html, $cart_item_key) {
	global $woocommerce;
	return sprintf('<a href="%s" class="external remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') );
	
}



function theme_single_product_heading($post)
{
	$heading_text = (get_post_meta(get_the_ID(), THEME_METABOX . "heading_text", true) == "") ? get_the_title() : get_post_meta(get_the_ID(), THEME_METABOX . "heading_text", true);
	$heading_size = (get_post_meta(get_the_ID(), THEME_METABOX . "heading_size", true) == "") ? "80" : get_post_meta(get_the_ID(), THEME_METABOX . "heading_size", true);

	echo '<h1 class="pageHeading" style="font-size: ' . $heading_size . 'px;">'.$heading_text. '</h1>';
}


#
# single page thumbnail modifications
#
function theme_woocommerceproduct_prev_image($post)
{
	
	global $product;
	

	echo '<div class="col2-set topMargin">';
	echo '<div class="col-1">';
	echo "<div class='mediaContainer gallery twoCol'>";
	if ($product->is_on_sale()) : 
	
		echo apply_filters('woocommerce_sale_flash', '<div class="onsale">'.__('Sale!', 'woocommerce').'</div>', $post, $product);
	
	endif;			
	echo '<a class="_image __gallery'.get_the_ID().'" href="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ).'">';
	echo "<div class='_rollover'>";
	echo "<div class='mediaCaption'>";
	echo "</div>";
	echo "</div>";
	echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
	echo "</a>";
	echo "</div>";
	echo "<div class='product_thumbnails'>";
	$args = array(
	   'post_type' => 'attachment',
	   'numberposts' => -1,
	   'post_status' => null,
	   'post_parent' => get_the_ID()
	);

  	$attachments = get_posts( $args );
    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
       		echo '<a class="_image __gallery'.get_the_ID().'" href="'.wp_get_attachment_url( $attachment->ID, 'large' ).'">';
           	echo wp_get_attachment_image( $attachment->ID, 'shop_thumbnail' );
 			echo '</a>';
          }
     }
	echo "</div>";
	echo "</div>";
	echo '<div class="col-2">';
	echo "<div class='price_container'>";
	echo '<h3>'.get_the_title(). '</h3>';
	woocommerce_template_single_price($post, $product);
	echo "</div>";
	the_excerpt();
	theme_add_to_cart($post, $product );
	echo "</div>";
	echo "</div>";

	//get_sidebar();
	wp_reset_query();
}


function theme_add_to_cart($post, $_product )
{
	echo "<div class='theme_cart theme_cart_".$_product->product_type."'>";
	do_action( 'theme_add_to_cart', $post, $_product );
	echo "</div>";
}


function theme_woocommerce_thumb_size()
{
	return 'shop_single';
}


#
# creates the theme framework container arround the shop pages
#
function theme_woocommerce_before_main_content()
{
	echo "<div id='contentWrapper'>";
		echo "<div id='content'>";
		
}


#
# creates the theme framework content container arround the shop loop
#
function theme_woocommerce_before_shop_loop()
{	
	woocommerce_catalog_ordering();	
	ob_start();
	echo "<div>";
	$content = ob_get_clean();
	echo $content;
	ob_start();
}

#
# closes the theme framework content container arround the shop loop
#
function theme_woocommerce_after_shop_loop()
{
	echo "</div>"; //end content
}


#
# closes the theme framework container arround the shop pages
#
function theme_woocommerce_after_main_content()
{	
	//reset all previous queries
	wp_reset_query();
	
	//get the sidebar
	if(!is_singular())
	get_sidebar();
			
}




#
# creates the post image for each post
#
function theme_woocommerce_thumbnail($asdf)
{
	//circumvent the missing post and product parameter in the loop_shop template
	global $post, $product;
	//$rating = $_product->get_rating_html(); //rating is removed for now since the current implementation requires wordpress to do 2 queries for each post which is not that cool on overview pages
	ob_start();
	
	echo "<div class='mediaContainer gallery'>";
	if ($product->is_on_sale()) : 
	
		echo apply_filters('woocommerce_sale_flash', '<div class="onsale">'.__('Sale!', 'woocommerce').'</div>', $post, $product);
	
	endif;			

	echo "<div class='_rollover'>";
	echo "<div class='mediaCaption'>";
	woocommerce_template_loop_add_to_cart($post, $product);
	echo "<a class='button ".of_get_option('blog_button_color')." small' href='" . get_permalink($post->ID) . "'>Item Details</a>";
	echo "</div>";
	echo "</div>";
	echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );

	echo "</div>";

}

#
# echo the excerpt
#
function theme_woocommerce_overview_excerpt()
{
	
	echo "<div class='product_excerpt'>";
	the_excerpt();
	echo "</div>";
	
}




#
# modify shop overview column count
#
function theme_woocommerce_loop_columns() 
{

	$cols = of_get_option("shop_columns");
	if ($cols < 1) {
		$cols = 1;
	}
	return $cols;
}


#
# modify shop overview product count
#

function theme_woocommerce_product_count() 
{

	return 9999;
}



#
# display upsells and related products
#
function theme_woocommerce_output_related_products()
{	
	global $woocommerce_loop;
	$woocommerce_loop['loop'] = 0;
	echo "<div>";
	ob_start();
	woocommerce_related_products(3,3); // 3 products, 3 columns
	$content = ob_get_clean();
	if($content)
	{
		echo $content;
	}


	echo "</div>";
	wp_reset_query();
}

function theme_woocommerce_output_upsells() 
{
	global $woocommerce_loop;
	$woocommerce_loop['loop'] = 0;
	echo "<div>";
	ob_start();
	woocommerce_upsell_display(3,3); // 3 products, 3 columns
	$content = ob_get_clean();
	if($content)
	{
		echo $content;
	}
	echo "</div>";
	wp_reset_query();
}

#
# display subcategory pagination
#
function theme_woocommerce_product_subcategories( $args = array() ) {
	global $woocommerce, $wp_query, $_chosen_attributes;
	
	$defaults = array(
		'before'  => '',
		'after'  => '',
		'force_display' => false
	);

	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	// Main query only
	if ( ! is_main_query() && ! $force_display ) return;
	
	// Don't show when filtering
	if ( sizeof( $_chosen_attributes ) > 0 || ( isset( $_GET['max_price'] ) && isset( $_GET['min_price'] ) ) ) return; 
	
	// Don't show when searching or when on page > 1 and ensure we're on a product archive
	if ( is_search() || is_paged() || ( ! is_product_category() && ! is_shop() ) ) return;
	
	// Check cateogries are enabled
	if ( is_product_category() && get_option( 'woocommerce_show_subcategories' ) == 'no' ) return;
	if ( is_shop() && get_option( 'woocommerce_shop_show_subcategories' ) == 'no' ) return;

	// Find the category + category parent, if applicable
	if ( $product_cat_slug = get_query_var( 'product_cat' ) ) {
		$product_cat = get_term_by( 'slug', $product_cat_slug, 'product_cat' );
		$product_category_parent = $product_cat->term_id;
	} else {
		$product_category_parent = 0;
	}

	// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( http://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
	$args = array(
		'child_of'		=> $product_category_parent,
		'menu_order'	=> 'ASC',
		'hide_empty'	=> 1,
		'hierarchical'	=> 1,
		'taxonomy'		=> 'product_cat',
		'pad_counts'	=> 1
	);
	$product_categories = get_categories( $args  );
	
	$product_category_found = false;

	if ( $product_categories ) {
		
		$item_count = 0;
		$items_per_page = (of_get_option("shop_products") == "") ? 6 : of_get_option("shop_products");
		
		foreach ( $product_categories as $category ) {
			
			if ($item_count == 0) {
				echo '<li><ul class="products">';
			}
					
			if ( $category->parent != $product_category_parent ) 
				continue;
			
			if ( ! $product_category_found ) {
				// We found a category
				$product_category_found = true;
				echo $before;
			}
			
			woocommerce_get_template( 'content-product_cat.php', array(
				'category' => $category
			) );
			
			$item_count++;
			if ($item_count == $items_per_page) {
				echo '</ul></li>';
				$item_count = 0;		
			}
		}
		
		if ($item_count != $items_per_page) {
			echo '</ul></li>';		
		}

	}
	
	// If we are hiding products disable the loop and pagination
	if ( $product_category_found == true && get_option( 'woocommerce_hide_products_when_showing_subcategories' ) == 'yes' ) {
		$wp_query->post_count = 0;
		$wp_query->max_num_pages = 0;
	}
		
	if ( $product_category_found ) {
		echo $after;
		return true;
	}
	
}

#
# display subcategory thumbnail
#

function theme_woocommerce_subcategory_thumbnail( $category  ) {
	global $woocommerce;

	$thumbnail_id  = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image_src = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog'  );
		$image_src = $image_src[0];
	} else {
		$image_src = woocommerce_placeholder_img_src();
	}

	
	$image = '<img src="' . $image_src . '" alt="' . $category->name . '" />';
	
	echo "<div class='mediaContainer gallery'>";

	echo "<div class='_rollover'>";
	echo "<div class='mediaCaption'>";
	echo "</div>";
	echo "</div>";

	echo $image;

	echo "</div>";
}
