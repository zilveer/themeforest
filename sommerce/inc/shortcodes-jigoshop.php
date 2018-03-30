<?php
/**
 * Additional shortcodes for the theme.
 * 
 * To create new shortcode, get for example the shortcode [sample] already written.
 * Replace it with your code for shortcode and for other shortcodes, duplicate the first
 * and continue following.
 * 
 * CONVENTIONS: 
 * - The name of function MUST be: yiw_sc_SHORTCODENAME_func.
 * - All html output of shortcode, must be passed by an hook: apply_filters( 'yiw_sc_SHORTCODENAME_html', $html ).
 * NB: SHORTCODENAME is the name of shortcode and must be written in lowercase.    
 * 
 * For example, we'll add new shortcode [sample], so:
 * - the function must be: yiw_sc_sample_func().
 * - the hooks to use will be: apply_filters( 'yiw_sc_sample_html', $html ).   
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */             


/** 
 * LATEST PRODUCTS 
 * 
 * @description
 *    show a box with title and optional description, near the main content 
 * 
 * @example
 *   [yiw_latest_products title="" description="" per_page="" columns=""]
 * 
 * @attr  
 *   title  - the title of the box
 *   description - the text below title  
**/
function yiw_sc_yiw_latest_products_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'boxed-content',
        'title' => null,
        'description' => null,
        'per_page' => 4,
        'columns' => 4,
		'orderby'	=> get_option('jigoshop_catalog_sort_orderby'),
		'order'		=> get_option('jigoshop_catalog_sort_direction')
    ), $atts));        
	
	$html = ''; // this is the var to use for the html output of shortcode     

	remove_action( 'jigoshop_after_shop_loop_item', 'jigoshop_template_loop_add_to_cart');
	remove_action( 'jigoshop_after_shop_loop_item_title', 'jigoshop_template_loop_price');  
	
	remove_action( 'jigoshop_pagination', 'jigoshop_pagination', 10 );
	
	$html .= '[boxed_content title="' . $title . '" description="' . $description . '"]
[recent_products per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]
[/boxed_content]';                     

	add_action( 'jigoshop_after_shop_loop_item', 'jigoshop_template_loop_add_to_cart', 10, 2);
	add_action( 'jigoshop_after_shop_loop_item_title', 'jigoshop_template_loop_price', 10, 2);                              
    
    return apply_filters( 'yiw_sc_yiw_latest_products_html', do_shortcode( $html ) );   // this must be written for each shortcode
}
add_shortcode('yiw_latest_products', 'yiw_sc_yiw_latest_products_func');                     


/** 
 * FEATURED PRODUCTS 
 * 
 * @description
 *    show a box with title and optional description, near the main content 
 * 
 * @example
 *   [yiw_featured_products title="" description="" per_page="" columns=""]
 * 
 * @attr  
 *   title  - the title of the box
 *   description - the text below title  
**/
function yiw_sc_yiw_featured_products_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'boxed-content',
        'title' => null,
        'description' => null,
        'per_page' => 4,
        'columns' => 4,
		'orderby'	=> get_option('jigoshop_catalog_sort_orderby'),
		'order'		=> get_option('jigoshop_catalog_sort_direction')
    ), $atts));        
	
	$html = ''; // this is the var to use for the html output of shortcode     

	remove_action( 'jigoshop_after_shop_loop_item', 'jigoshop_template_loop_add_to_cart');
	remove_action( 'jigoshop_after_shop_loop_item_title', 'jigoshop_template_loop_price');  
	
	remove_action( 'jigoshop_pagination', 'jigoshop_pagination', 10 );
	
	$html .= '[boxed_content title="' . $title . '" description="' . $description . '"]
[featured_products per_page="' . $per_page . '" columns="' . $columns . '"  orderby="' . $orderby . '" order="' . $order . '"]
[/boxed_content]';                     

	add_action( 'jigoshop_after_shop_loop_item', 'jigoshop_template_loop_add_to_cart', 10, 2);
	add_action( 'jigoshop_after_shop_loop_item_title', 'jigoshop_template_loop_price', 10, 2);                              
    
    return apply_filters( 'yiw_sc_yiw_featured_products_html', do_shortcode( $html ) );   // this must be written for each shortcode
}
add_shortcode('yiw_featured_products', 'yiw_sc_yiw_featured_products_func');                                


/** 
 * BEST SELLERS 
 * 
 * @description
 *    show a box with best sellers
 * 
 * @example
 *   [best_sellers per_page="" columns=""]
 * 
 * @attr  
 *   title  - the title of the box
 *   description - the text below title  
**/
function yiw_sc_best_sellers_func($atts, $content = null) 
{
    global $columns, $per_page;
	
	extract(shortcode_atts(array(
		'per_page' 	=> '12',
		'columns' 	=> '4'
	), $atts));
	
	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per_page,
		'meta_key'       => '_js_total_sales',
		'orderby'        => 'meta_value',
	);
	query_posts($args);
	ob_start();
	jigoshop_get_template_part( 'loop', 'shop' );
	wp_reset_query();
	
	return apply_filters( 'yiw_sc_yiw_best_sellers_html', ob_get_clean() );        
}
add_shortcode('best_sellers', 'yiw_sc_best_sellers_func');                          


/** 
 * BOXED BEST SELLERS 
 * 
 * @description
 *    show a box with title and optional description, near the main content 
 * 
 * @example
 *   [boxed_best_sellers title="" description="" per_page="" columns=""]
 * 
 * @attr  
 *   title  - the title of the box
 *   description - the text below title  
**/
function yiw_sc_boxed_best_sellers_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'boxed-content',
        'title' => null,
        'description' => null,
        'per_page' => 4,
        'columns' => 4
    ), $atts));        
	
	$html = ''; // this is the var to use for the html output of shortcode       

	remove_action( 'jigoshop_after_shop_loop_item', 'jigoshop_template_loop_add_to_cart');
	remove_action( 'jigoshop_after_shop_loop_item_title', 'jigoshop_template_loop_price');  
	
	remove_action( 'jigoshop_pagination', 'jigoshop_pagination', 10 );
	
	remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
	
	$html .= '[boxed_content title="' . $title . '" description="' . $description . '"]
[best_sellers per_page="' . $per_page . '" columns="' . $columns . '"]
[/boxed_content]';                     

	add_action( 'jigoshop_after_shop_loop_item', 'jigoshop_template_loop_add_to_cart', 10, 2);
	add_action( 'jigoshop_after_shop_loop_item_title', 'jigoshop_template_loop_price', 10, 2);     
    
    return apply_filters( 'yiw_sc_boxed_best_sellers_html', do_shortcode( $html ) );   // this must be written for each shortcode
}
add_shortcode('boxed_best_sellers', 'yiw_sc_boxed_best_sellers_func');                   


/** 
 * ITEMS 
 * 
 * @description
 *    show the products
 * 
 * @example
 *   [items per_page="" columns="" orderby="" order=""]
 * 
 * @attr  
 *   per_page  - the title of the box
 *   description - the text below title  
**/
function yiw_sc_items_func($atts){
  global $columns, $per_page;
  
	extract(shortcode_atts(array(
	   'per_page'  => 12,
	   'columns'   => '4',
	   'orderby'   => 'title',
	   'order'     => 'asc'
	), $atts));
	
  $args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'posts_per_page' => $per_page,
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => 'visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
	);
	
	if(isset($atts['skus'])){
	  $skus = explode(',', $atts['skus']);
	  array_walk($skus, create_function('&$val', '$val = trim($val);'));
    $args['meta_query'][] = array(
      'key' => 'sku',
      'value' => $skus,
      'compare' => 'IN'
    );
  }
	
	if(isset($atts['ids'])){
	  $ids = explode(',', $atts['ids']);
	  array_walk($ids, create_function('&$val', '$val = trim($val);'));
    $args['post__in'] = $ids;
	}
	
  query_posts($args);
	ob_start();
	jigoshop_get_template_part( 'loop', 'shop' );
	wp_reset_query();
	
	return ob_get_clean();
}                  
add_shortcode('items', 'yiw_sc_items_func');   

/** 
 * ADD TO CART     
 * 
 * @description
 *    Add a simple add to cart of a product   
 * 
 * @example
 *   [add_to_cart id=""]
 * 
 * @attr                          
 *   id - the id of product
**/
function yiw_sc_add_to_cart_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"id" => false,
	), $atts));
	
	if ( ! $id )
	   return;
	
	$_product = jigoshop_product( $id );
	
	ob_start();
	
	// do not show "add to cart" button if product's price isn't announced
	if( $_product->get_price() === '') return;
	
	?><a href="<?php echo $_product->add_to_cart_url(); ?>" class="button"><?php _e('Add to cart', 'jigoshop'); ?></a><?php
    
    $html = ob_get_clean(); 
	
	return apply_filters( 'yiw_sc_add_to_cart_html', $html );
}     
add_shortcode( 'add_to_cart', 'yiw_sc_add_to_cart_func' );

?>