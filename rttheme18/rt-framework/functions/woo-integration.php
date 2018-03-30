<?php
#-----------------------------------------
#	RT-Theme woo-integration.php
#	version: 1.0
#-----------------------------------------



#-----------------------------------------
#	remove woo actions
#-----------------------------------------

global $woocommerce, $suffix;
//remove woo styles
if(!is_admin()){
	add_action("wp_enqueue_scripts", "load_css_in_order", 20 );
}

//breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );	// remove breadcrumb

//pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

//remove woo sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); // remove woo sidebar

//remove woo thumbs
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10); 
 
//remove after shop hooks
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

//remove the add to cart button from loop items
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' ); 

//remove the after shop loop item title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


#-----------------------------------------
#	add woo actions
#-----------------------------------------
 
//paginatin
add_action( 'woocommerce_after_shop_loop', 'rt_woocommerce_pagination', 10 ); // add new rt-pagination
 
//add custom thumbs
add_action( 'woocommerce_before_shop_loop_item_title', 'rt_woocommerce_template_loop_product_thumbnail', 10);
 
//add embedded cart button
add_action( 'rt_woocommerce_template_loop_add_to_cart', 'rt_woocommerce_embedded_cart_buttton', 10 ); 

//add the after shop loop item title
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 100 );

//add the add to cart button to loop items product_info
if( ! get_option(RT_THEMESLUG . "_hide_default_cart_button") ){
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 110 ); 
}

//Custom Loop Item Title
remove_action("woocommerce_shop_loop_item_title", "woocommerce_template_loop_product_title");
remove_action("woocommerce_before_shop_loop_item", "woocommerce_template_loop_product_link_open", 10);
remove_action("woocommerce_after_shop_loop_item", "woocommerce_template_loop_product_link_close", 5);
add_action("woocommerce_shop_loop_item_title", "rt_loop_item_title", 10);


#-----------------------------------------
#	functions
#-----------------------------------------
#
if ( ! function_exists( 'rt_loop_item_title' ) ) {
	/**
	 * Custom Loop Item Title
	 * @return output
	 */
	function rt_loop_item_title()
	{
		echo '<h4><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h4>';
	
	}
}

//replace the get_woocommerce_page_title function
if ( ! function_exists( 'get_woocommerce_page_title' ) ) {

	/**
	 * woocommerce_page_title function. 
	 *
	 * @access public
	 * @return void
	 */
	function get_woocommerce_page_title() {

		if ( is_search() ) {
			$page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );

			if ( get_query_var( 'paged' ) )
				$page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );

		} elseif ( is_tax() ) {

			$page_title = single_term_title( "", false );

		} elseif ( is_single() ) {

			$page_title = get_the_title();

		} else {

			$shop_page_id = woocommerce_get_page_id( 'shop' );
			$page_title   = get_the_title( $shop_page_id );

		}

	    return apply_filters( 'woocommerce_page_title', $page_title );
	}
}


//load css in order to make compatible with rt-theme
function load_css_in_order(){
	wp_enqueue_style('rt-woocommerce-styles', RT_THEMEURI.'/woocommerce/css/woocommerce.css');
	wp_enqueue_script('jquery-custom-select', RT_THEMEURI.'/js/jquery.customselect.min.js');

	//enqueue script files
	wp_enqueue_script('jquery-owl-carousel', RT_THEMEURI . '/js/owl.carousel.min.js', "", "", "true"); 	 
	wp_enqueue_style('jquery-owl-carousel', RT_THEMEURI . '/css/owl.carousel.css'); 	  	
}
 
//pagination
function rt_woocommerce_pagination(){
	global $wp_query;
	 
	if( $wp_query->max_num_pages > 1 ){
		rt_get_pagination( $wp_query );
	}
}

//thumbnail
function rt_woocommerce_template_loop_product_thumbnail() {
	global $post, $woocommerce, $woo_product_layout, $rt_title, $product;
 	
	$image = ( has_post_thumbnail( $post->ID ) ) ? get_post_thumbnail_id( $post->ID ) : "";

	//is crop active	
	$crop = get_option(RT_THEMESLUG.'_woo_product_image_crop') ? "true" : "" ;

	//image max height
	$h = $crop ? get_option(RT_THEMESLUG.'_woo_product_image_height') : 10000;	

	//Thumbnail dimensions
	$w = rt_get_min_resize_size( $woo_product_layout );

	// Resize Image
	$image_output = get_resized_image_output( array( "image_url" => "", "image_id" => $image, "w" => $w, "h" => $h, "crop" => $crop ) );  

	if( ! empty( $image_output ) ) {
		if( ! get_option(RT_THEMESLUG . "_hide_embedded_cart_button") ){
				echo '<!-- product image --><div class="featured_image"><div class="imgeffect">	';
				echo do_action("rt_woocommerce_template_loop_add_to_cart");
				echo $image_output;
				echo '</div></div>';
		}else{
				echo '<!-- product image --><div class="featured_image">';
				echo '<a href="'.get_permalink().'">'.$image_output.'</a>';
				echo '</div>';
		}
	}

}
 

#-----------------------------------------
#	FILTERS
#-----------------------------------------


#
# Number of products displayed per page
#
function rt_loop_shop_per_page() {
	$woo_product_list_pager = get_option(RT_THEMESLUG."_woo_product_list_pager");
	if($woo_product_list_pager!="" && is_numeric($woo_product_list_pager) ) {
		return  $woo_product_list_pager;
	}
}

add_filter('loop_shop_per_page', 'rt_loop_shop_per_page');


#
#
# Ensure cart contents update when products are added to the cart via AJAX
#
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start(); 
	load_theme_textdomain('rt_theme', get_template_directory().'/languages' );
	?>	
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View Cart', 'woocommerce'); ?>">
		<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'rt_theme'), $woocommerce->cart->cart_contents_count);?> 
		- <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
} 

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

#
# Remove WooCommerce show page title
#
function rt_woocommerce_show_page_title() {
	return false;
}
add_filter('woocommerce_show_page_title', 'rt_woocommerce_show_page_title');


#
# Add class name to the product search form
#
function rt_get_product_search_form() {
	$form = '<form role="search" method="get" id="searchform" class="rt_form" action="' . esc_url( home_url( '/'  ) ) . '">
		<div>
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'woocommerce' ) . '" />
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
	return $form;
} 

add_filter('get_product_search_form', 'rt_get_product_search_form');


#
# Add to cart button embedded to featured image
#
function rt_woocommerce_embedded_cart_buttton() {
	global $product;
 
	echo sprintf( 
					'<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s %s %s %s %s %s product_type_%s %s" title="%s"></a>',
					esc_url( $product->add_to_cart_url() ), 
					esc_attr( $product->id ), 
					esc_attr( $product->get_sku() ), 
					$product->is_purchasable() ? 'add_to_cart_button' : '', 
					$product->is_purchasable() ? 'single icon-basket' : '', 
					$product->product_type == "grouped" ? 'single icon-eye' : '', 
					$product->product_type == "external" ? 'single icon-link' : '', 
					$product->product_type == "variable" ? 'single icon-eye' : '', 
					! $product->is_purchasable() ? 'single icon-eye' : '', 
					esc_attr( $product->product_type ), 
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
					esc_html( $product->add_to_cart_text() )
					 
			);
} 


#
# Rewrite woocommerce archive descriptions
#
if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ) {

	/**
	 * Show an archive description on taxonomy archives
	 *
	 * @access public
	 * @subpackage	Archives
	 * @return void
	 */
	function woocommerce_taxonomy_archive_description() {
		if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
			$description = apply_filters( 'the_content', term_description() );
			if ( $description ) {
				echo '<div class="term-description">' . $description . '</div>';
				echo '<hr class="style-four" />';
			}
		}
	}
}

#
# Rewrite woocommerce default product_category shortcode
# to be able to retrive $page_product_count
# that used for product holder
#

//remove woo commerce's default categories shortcode 
function remove_product_category_shortcode(){
	remove_shortcode( "product_category" );
}
add_action("init","remove_product_category_shortcode");

function add_product_category_shortcode(){
	add_shortcode("product_category","rt_product_category_shortcode");
}

add_action("init","add_product_category_shortcode");

// product_category shortcode
function rt_product_category_shortcode( $atts ) {
	global $woocommerce_loop, $page_product_count;
 

	if ( empty( $atts ) ) return '';

	extract( shortcode_atts( array(
		'per_page' 		=> '12',
		'columns' 		=> '4',
		'orderby'   	=> 'title',
		'order'     	=> 'desc',
		'category'		=> '',
		'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
		), $atts ) );

	if ( ! $category ) return '';

	// Default ordering args
	$ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );

	$args = array(
		'post_type'				=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' 				=> $ordering_args['orderby'],
		'order' 				=> $ordering_args['order'],
		'posts_per_page' 		=> $per_page,
		'meta_query' 			=> array(
			array(
				'key' 			=> '_visibility',
				'value' 		=> array('catalog', 'visible'),
				'compare' 		=> 'IN'
			)
		),
		'tax_query' 			=> array(
			array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> array( esc_attr( $category ) ),
				'field' 		=> 'slug',
				'operator' 		=> $operator
			)
		)
	);

	if ( isset( $ordering_args['meta_key'] ) ) {
		$args['meta_key'] = $ordering_args['meta_key'];
	}

	ob_start();

	$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

 
	//get product counts
	$page_product_count = $products->post_count;  

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php endif;

	woocommerce_reset_loop();
	wp_reset_postdata();

	return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
}


if ( ! function_exists( 'rt_wc_category_numbers' ) ) {
	/**
	 * Change the markup of category product numbers
	 */
	function rt_wc_category_numbers($output,$category) {
		return ' <mark class="count">' . $category->count . '</mark>';
	}
}

add_filter( "woocommerce_subcategory_count_html", "rt_wc_category_numbers", 10, 2 );


?>
