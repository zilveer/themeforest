<?php 
#WooCommerce Theme Support
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

#Disable WooCommerce Styles
if ( version_compare( get_option('woocommerce_version'), "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

#Product has Gallery
if(!is_admin())
	add_filter( 'post_class', 'product_has_gallery' );

function product_has_gallery( $classes ) {
	global $product;
	
	$post_type = get_post_type( get_the_ID() );
	if ( $post_type == 'product' ) {
		$attachment_ids = $product->get_gallery_attachment_ids();
		if ( $attachment_ids ) {
			$classes[] = 'pif-has-gallery';
		}
	}
	return $classes;
}

#Change Image Sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'dt_woocommerce_image_dimensions', 1 );
function dt_woocommerce_image_dimensions() {
	$catalog = array('width' => '520', 'height'	=> '520', 'crop' => 1);
    $single = array('width' => '520', 'height' => '535', 'crop'	=> 1);
	$thumbnail = array('width' => '90', 'height'	=> '90', 'crop' => 1);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );
	update_option( 'shop_single_image_size', $single );
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}

#No.of Products per row
add_filter( 'loop_shop_columns', 'dt_woocommerce_loop_columns' );	
if (!function_exists('dt_woocommerce_loop_columns')) {
	function dt_woocommerce_loop_columns() {
		
		$shop_layout = dt_theme_option('woo',"shop-page-product-layout");
		$columns = "";
		switch($shop_layout) {
			case "one-half-column":
				$columns = 2;
				break;
			case "one-third-column":
				$columns = 3;
				break;				
			case "one-fourth-column":
				$columns = 4;
				break;				
			default:
				$columns = 4;
		}
		return $columns;
	}
}

#No.of Products per page
add_filter( 'loop_shop_per_page', 'dt_woocommerce_product_count' );
if (!function_exists('dt_woocommerce_product_count')) {
	function dt_woocommerce_product_count() {
		$shop_product_per_page = trim(stripslashes(dt_theme_option('woo','shop-product-per-page')));
		$shop_product_per_page = !empty( $shop_product_per_page)  ? $shop_product_per_page : 10;
		return $shop_product_per_page;
	}
}

#Add / Remove WooCommerce actions
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); #remove rating
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); //remove woo pagination

#Adjust WooCommerce pages markup
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10); # To remove add to cart in shop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );

#Hide page title
add_action( 'woocommerce_show_page_title', 'dt_woocommerce_show_page_title', 10);
if( !function_exists('dt_woocommerce_show_page_title') ) {
	function dt_woocommerce_show_page_title() {
		return false;
	}
}

#Before main content
add_action( 'woocommerce_before_main_content', 'dt_woocommerce_before_main_content', 10);
if( !function_exists('dt_woocommerce_before_main_content') ) {
	function dt_woocommerce_before_main_content() {
		
		if( is_shop() ):
			#Page Settings
			$tpl_default_settings = get_post_meta( get_option('woocommerce_shop_page_id') ,'_tpl_default_settings',TRUE);
			$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
		
			$page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
			$show_sidebar = false;
			
		elseif( is_product() ):
			$page_layout = dt_theme_option('woo',"product-layout");
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
			
		elseif( is_product_category() ):
			$page_layout = dt_theme_option('woo',"product-category-layout");
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		elseif( is_product_tag() ):
			$page_layout = dt_theme_option('woo',"product-tag-layout");
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
		endif;
		
		if(!is_front_page() and !is_home()):
			if(dt_theme_option('general', 'disable-breadcrumb') != "on"): ?>
                <!-- breadcrumb starts here -->
                <section class="breadcrumb-wrapper">
                    <div class="container">
                        <h1><?php
                        	if (is_post_type_archive('product')) _e("Products", 'iamd_text_domain');
							elseif(is_singular('product')) the_title();
							elseif(taxonomy_exists('product_cat')){ _e('Archive of : ', 'iamd_text_domain'); echo single_cat_title(); } ?></h1>
                        <?php new dt_theme_breadcrumb; ?>
                    </div>                      
                </section>
                <!-- breadcrumb ends here --><?php
			endif;
		endif;
		
		echo '<div class="content">';
		echo '<div class="container">';
				echo '<section class="'.$page_layout.'" id="primary">';
	}
}

#After main content
add_action( 'woocommerce_after_main_content', 'dt_woocommerce_after_main_content', 20);
if( !function_exists('dt_woocommerce_after_main_content') ) {
	function dt_woocommerce_after_main_content() {

		 echo "</section>";		

		if( is_shop() ):
		
			#Page Settings
			$tpl_default_settings = get_post_meta( get_option('woocommerce_shop_page_id') ,'_tpl_default_settings',TRUE);
			$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
			
			$page_layout  = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "content-full-width";
			
		elseif( is_product() ):
			$page_layout = dt_theme_option('woo',"product-layout");
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

		elseif( is_product_category() ):
			$page_layout = dt_theme_option('woo',"product-category-layout");
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
			
		elseif( is_product_tag() ):
			$page_layout = dt_theme_option('woo',"product-tag-layout");
			$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
			
		endif;


		$show_sidebar = false;
		$sidebar_class= "";
			
		switch($page_layout):
			case 'with-left-sidebar':
				$show_sidebar 	= 	true;
				$sidebar_class 	=	"left-sidebar";
			break;
			
			case 'with-right-sidebar':
				$show_sidebar 	= 	true;
			break;
		endswitch;

		if($show_sidebar):
			echo "<section id='secondary' class='{$sidebar_class}'>";
				if($sidebar_class == 'left-sidebar')
					get_sidebar('left');
				else
					get_sidebar('right');
			echo '</section>';
		endif;

		echo '</div>';
	echo '</div>';
	}
}

#Category Loop
#
# wrap the product categories with column class
#
add_action( 'woocommerce_before_subcategory', 'dt_woocommerce_before_subcategory', 5);
function dt_woocommerce_before_subcategory() {
	global $woocommerce_loop;

	$class = $out = "";

	if( is_shop() ):
		$column = dt_theme_option('woo', "shop-page-product-layout");
		switch($column) {
			case "one-half-column":
				$class .= " dt-sc-one-half column ";
				break;

			case "one-third-column":
				$class .= " dt-sc-one-third column ";
				break;

			case "one-fourth-column":
				$class .= " dt-sc-one-fourth column ";
				break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
				break;	
		}	
	else:
		$column = $woocommerce_loop['columns'];		
		switch($column) {
			case 2:
				$class .= " dt-sc-one-half column ";
				break;

			case 3:
				$class .= " dt-sc-one-third column ";
				break;

			case 4:
				$class .= " dt-sc-one-fourth column ";
				break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
				break;
		}
	endif;

	$out .= "<div class='{$class}'>";
	$out .= "<div class='product-wrapper'>";
	echo $out;
}

#End loop of product category
add_action( 'woocommerce_after_subcategory', 'dt_woocommerce_after_subcategory', 10);
function dt_woocommerce_after_subcategory() {
	echo '</div></div>';
}

#Prodcut Loop
#
# wrap products on overview pages into an extra div for improved styling options. adds "product_on_sale" class if prodct is on sale
#
add_action( 'woocommerce_before_shop_loop_item', 'dt_woocommerce_shop_overview_extra_div', 5);
function dt_woocommerce_shop_overview_extra_div() {
	global $product, $woocommerce_loop;
	
	$class = $out = "";
	
	if( is_shop() ):
		$column = dt_theme_option('woo', "shop-page-product-layout");
		switch($column) {
			case "one-half-column":
				$class .= " dt-sc-one-half column ";
				break;

			case "one-third-column":
				$class .= " dt-sc-one-third column ";
				break;

			case "one-fourth-column":
				$class .= " dt-sc-one-fourth column ";
				break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
				break;	
		}	
	else:
		$column = $woocommerce_loop['columns'];		
		switch($column) {
			case 2:
				$class .= " dt-sc-one-half column ";
				break;

			case 3:
				$class .= " dt-sc-one-third column ";
				break;

			case 4:
				$class .= " dt-sc-one-fourth column ";
				break;
			
			default:
				$class .= " dt-sc-one-fourth column ";
				break;	
		}
	endif;		
	
	if( $product->is_featured() )
		$class .= " featured-product ";
		
	if( $product->is_on_sale() )
		$class .= " on-sale-product ";

	if( $product->is_in_stock() )
		$class .= " in-stock-product ";
	else	
		$class .= " out-of-stock-product ";
	
	$out .= "<div class='{$class}'>";
	$out .= "<div class='product-wrapper'>";
	echo $out;
}

#Before products title markups (featured, on sale, out of stock etc...)
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'dt_woocommerce_show_product_loop_sale_flash', 10 );
function dt_woocommerce_show_product_loop_sale_flash() {
	global $product;
	$out = "";
	if( $product->is_on_sale() and $product->is_in_stock() )
		$out = '<span class="onsale"><span>'.__('Sale!','iamd_text_domain').'</span></span>';
		
	elseif(!$product->is_in_stock())
		$out = '<span class="out-of-stock">'.__('Out of Stock','iamd_text_domain').'</span>';
	
	if( $product->is_featured() )
		$out .= '<span class="featured-tag"><span>'.__('Featured','iamd_text_domain').'</span></span>';
	
	echo $out;
}

#Products loop thumbnail markup
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'dt_woocommerce_template_loop_product_thumbnail', 10);
function dt_woocommerce_template_loop_product_thumbnail() {
	global $product;
	
	$out = "";
	$out .= "<div class='product-thumb'>";
	
	$id = get_the_ID();
	$image =  get_the_post_thumbnail( $id, 'shop_catalog' );
	$image = !empty( $image ) ? $image : "<img src='http".dt_theme_ssl()."://placehold.it/520x520' alt='product-thumb' />";

	$attachment_ids = $product->get_gallery_attachment_ids();
	$secondary_image_id = @$attachment_ids['0'];

	$image1 = wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
	
	$out .= $image.$image1;
	
	if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) )
		$out.= do_shortcode('[yith_wcwl_add_to_wishlist]');
	
	$out .= "</div>";
	
	echo $out;
}

add_action( 'woocommerce_before_shop_loop_item_title', 'dt_woocommerce_before_shop_loop_item_title', 10);
function dt_woocommerce_before_shop_loop_item_title() {
	$out = '';
	$out .= '<div class="product-title">';
	$out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
	echo $out;
}

add_action( 'woocommerce_after_shop_loop_item_title', 'dt_woocommerce_after_shop_loop_item_title', 10);
function dt_woocommerce_after_shop_loop_item_title() {
	$out = '';
	$out .= '</a>';
	$out .= '</div>';
	echo $out;
}

add_action( 'woocommerce_after_shop_loop_item', 'dt_woocommerce_shop_overview_show_price', 10);
function dt_woocommerce_shop_overview_show_price() {
	
	$out = "";
	global $product;
	
	ob_start();
	woocommerce_template_loop_price();
	$price = ob_get_clean();
	
	$out .= "<div class='product-details'>";	
	$out .= $price;
	echo $out;
}

add_action( 'woocommerce_after_shop_loop_item', 'dt_woocommerce_shop_overview_extra_div_close', 10);
function dt_woocommerce_shop_overview_extra_div_close() {

	$out = "";	
	global $product;
	if ($product->product_type == 'bundle' ){
		$product = new WC_Product_Bundle($product->id);
	}

	ob_start();
	woocommerce_template_loop_add_to_cart();
	$add_to_cart = ob_get_clean();
	
	if( !empty($add_to_cart) ) {
		$add_to_cart = str_replace(' class="',' class="small ',$add_to_cart);
	}

	$out .= $add_to_cart;

	$out .= '</div>';
	$out .= '</div>';	
	echo $out;
}

#Pagination hook
add_action( 'woocommerce_after_shop_loop', 'dt_woocommerce_after_shop_loop', 10);
function dt_woocommerce_after_shop_loop() {
	global $wp_query; ?>
	<div class="pagination-wrapper">
		<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
    </div><?php    
}

#SingleProduct
#Showing Releated Products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'dt_woocommerce_output_related_products', 20);

function dt_woocommerce_output_related_products() {
	
	$page_layout = dt_theme_option('woo',"product-layout");
	$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
	
	$related_products = ( $page_layout === "content-full-width" ) ? 4 : 3;
	
	$output = "";
	ob_start();
	woocommerce_related_products(array('posts_per_page' => $related_products, 'columns' => $related_products)); // X products, X columns
	$content = ob_get_clean();
	if($content):
		$content =  str_replace('<h2>','<h2 class="hr-title"><span>', $content);
        $content =  str_replace('</h2>','</span></h2>', $content);
		$output .= "<div class='related-products-container'>{$content}</div>";
	endif;
	echo $output;
}

#Showing Upsell Products( You may also like)
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'dt_woocommerce_output_upsells', 21); // needs to be called after the "related product" function to inherit columns and product count
function dt_woocommerce_output_upsells() {
	
	$page_layout = dt_theme_option('woo',"product-layout");
	$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";
	
	$upsell_products = ( $page_layout === "content-full-width" ) ? 4 : 3;
	
	$output = "";
	ob_start();
	woocommerce_upsell_display($upsell_products,$upsell_products); // X products, X columns
	$content = ob_get_clean();
	if($content):
		$content =  str_replace('<h2>','<h2 class="hr-title"><span>', $content);
        $content =  str_replace('</h2>','</span></h2>', $content);
		$output .= "<div class='upsell-products-container'>{$content}</div>";
	endif;
	echo $output;
}

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action('woocommerce_before_single_product_summary','dt_woocommerce_show_product_sale_flash',10);
function dt_woocommerce_show_product_sale_flash() {
	global $product;
	$out = "";
	
	$out .= '<div class="product-thumb-wrapper">';
		
	if( $product->is_on_sale() and $product->is_in_stock() )
		$out .= '<span class="onsale"><span>'.__('Sale!','woocommerce').'</span></span>';
		
	elseif(!$product->is_in_stock())
		$out .= '<span class="out-of-stock">'.__('Out of Stock','iamd_text_domain').'</span>';
	
	if($product->is_featured())
		$out .= '<span class="featured-tag"><span>'.__('Featured','iamd_text_domain').'</span></span>';

	echo $out;
}

add_action('woocommerce_after_single_product_summary','dt_woocommerce_close_product_wrapper',10);
function dt_woocommerce_close_product_wrapper() {
	$out = '</div>';
	echo $out;
} ?>