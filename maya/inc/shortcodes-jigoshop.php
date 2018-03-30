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
	
	$_product = &new jigoshop_product( $id );
	
	ob_start();
	
	// do not show "add to cart" button if product's price isn't announced
	if( $_product->get_price() === '') return;
	
	?><a href="<?php echo $_product->add_to_cart_url(); ?>" class="button"><?php _e('Add to cart', 'jigoshop'); ?></a><?php
    
    $html = ob_get_clean(); 
	
	return apply_filters( 'yiw_sc_add_to_cart_html', $html );
}     
add_shortcode( 'add_to_cart', 'yiw_sc_add_to_cart_func' );

/** 
 * PRODUCT SLIDER     
 * 
 * @description
 *    Add a product slider   
 * 
 * @example
 *   [product_slider cat=""]
 * 
 * @attr                          
 *   id - the id of product
**/
function yiw_sc_product_slider_func($atts, $content = null) {  
	
  	//if (empty($atts)) return;
  
	extract(shortcode_atts(array(
	  	'orderby'   => 'date',
	  	'order'     => 'desc',
	  	'cat'       => '',
	  	'style'     => '',
        'items'     => -1
		), $atts));
  	
  	global $wpdb, $products_style, $per_page;   
  	
  	if ( isset( $atts['latest'] ) && $atts['latest'] ) {
        $orderby = 'date';
        $order = 'desc'; 
    }
    
    $per_page = -1;
	
  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'posts_per_page' => $items,
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' 		=> 'visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			)
		)
	);
	
	if(isset( $atts['featured']) && $atts['featured']){
    	$args['meta_query'][] = array(
      		'key' 		=> 'featured',
      		'value' 	=> '1'
    	);
  	}
	
	if(isset( $atts['best_sellers']) && $atts['best_sellers']){
    	$args['meta_key'] = '_js_total_sales';
    	$args['orderby'] = 'meta_value';
    	$args['order'] = 'desc';
  	}
	
	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
    	$args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}
	
	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
    	$args['post__in'] = $ids;
	}           
    
    if ( ! empty( $cat ) ) {
        $tax = 'product_cat';
        $cat = array_map( 'trim', explode( ',', $cat ) );
        if ( count($cat) == 1 ) $cat = $cat[0];
        $args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $cat
            )
        );
    }
    
    if ( empty( $style ) )
        $products_style = yiw_get_option( 'shop_products_style', 'ribbon' );
    else   
        $products_style = $style;
	
    query_posts($args);
	ob_start();
	echo '<div class="products-slider '.$products_style.'">';
	jigoshop_get_template_part( 'loop', 'shop' );
	echo '</div>';
	wp_reset_query();
    
    $html = ob_get_clean(); 
    
    $html = str_replace( ' last', '', $html );
    $html = str_replace( ' first', '', $html );
	
	return apply_filters( 'yiw_sc_product_slider_html', $html );
}     
add_shortcode( 'product_slider', 'yiw_sc_product_slider_func' );

?>