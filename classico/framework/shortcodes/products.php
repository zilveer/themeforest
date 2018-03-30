<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! products
// **********************************************************************// 

add_shortcode('etheme_products','etheme_products_shortcode');

function etheme_products_shortcode($atts, $content) {
    global $wpdb, $woocommerce_loop;
    if ( !class_exists('Woocommerce') ) return false;

    $from_first = '';
    
    extract(shortcode_atts(array( 
        'ids' => '',
        'skus' => '',
        'columns' => 4,
        'shop_link' => 1,
        'limit' => 20,
        'categories' => '',
        'block_id' => false,
        'hover' => '',
        'type' => 'slider',
        'style' => 'default',
        'from_first' => '',
        'products' => '', //featured new sale bestsellings recently_viewed
        'title' => '',
        'desktop' => 4,
        'notebook' => 4,
        'tablet' => 3,
        'phones' => 1,
        'orderby' => '',
        'order' => 'ASC',
    ), $atts)); 


    $args = array(
        'post_type'             => 'product',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit,
        'orderby'               => $orderby,
        'order'                 => $order,
        'meta_query' => array(
            array(
                'key'       => '_visibility',
                'value'     => array('catalog', 'visible'),
                'compare'   => 'IN'
            )
        )
    );

    $woocommerce_loop['hover'] = $hover;

    if ($products == 'featured') {
        $args['meta_query'][] = array(
            'key'       => '_featured',
            'value'     => 'yes',
            'compare'   => '='
        );
    }

    if ($products == 'new') {
        $args['meta_query'][] = array(
            'key'       => ET_PREFIX . 'product_new',
            'value'     => 'on',
            'compare'   => '='
        );
    }

    if ($products == 'sale') {
        $product_ids_on_sale = woocommerce_get_product_ids_on_sale();
        $args['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
    }

    if ($products == 'bestsellings') {
        $args['meta_key'] = 'total_sales';
        $args['orderby'] = 'meta_value_num';
    }

    if ($products == 'recently_viewed') {
        $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
        $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

        if ( empty( $viewed_products ) )
          return;
        $args['post__in'] = $viewed_products;
        $args['orderby'] = 'rand';
    }


    if($skus != ''){
        $skus = explode(',', $atts['skus']);
        $skus = array_map('trim', $skus);
        $args['meta_query'][] = array(
            'key'       => '_sku',
            'value'     => $skus,
            'compare'   => 'IN'
        );
    }

    if($ids != ''){
        $ids = explode(',', $atts['ids']);
        $ids = array_map('trim', $ids);
        $args['post__in'] = $ids;
    }

    // Narrow by categories
    if ( $categories != '' ) {
      $categories = explode(",", $categories);
      $gc = array();
      foreach ( $categories as $grid_cat ) {
          array_push($gc, $grid_cat);
      }
      $gc = implode(",", $gc);
      ////http://snipplr.com/view/17434/wordpress-get-category-slug/
      //$args['category_name'] = $gc;
      $pt = array('product');


      $taxonomies = get_taxonomies('', 'object');
      $args['tax_query'] = array('relation' => 'OR');
      foreach ( $taxonomies as $t ) {
          if ( in_array($t->object_type[0], $pt) ) {
              $args['tax_query'][] = array(
                  'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                  'terms' => $categories,
                  'field' => 'id',
              );
          }
      }
    }

    $customItems = array(
        'desktop' => $desktop,
        'notebook' => $notebook,
        'tablet' => $tablet,
        'phones' => $phones
    );
      
    if ($type == 'slider') {
    	$slider_args = array(
    		'title' => $title,
    		'shop_link' => $shop_link,
    		'slider_type' => false,
    		'items' => $customItems,
    		'style' => $style,
    	);
        ob_start();
        etheme_create_slider($args, $slider_args);
        $output = ob_get_contents();
        ob_end_clean();
    } elseif($type == 'full-width') {
    	$slider_args = array(
    		'title' => $title,
    		'shop_link' => $shop_link,
    		'slider_type' => 'swiper',
        'customItems' => $customItems,
        'from_first' => $from_first,
    		'style' => $style,
    		'block_id' => $block_id
    	);
        ob_start();
        etheme_create_slider($args, $slider_args);
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $woocommerce_loop['view_mode'] = $type;
        $output = etheme_products($args, $title, $columns);
    }
    
    return $output;
}

// **********************************************************************// 
// ! Register New Element: products
// **********************************************************************//
add_action( 'init', 'et_register_vc_products');
if(!function_exists('et_register_vc_products')) {
	function et_register_vc_products() {
		if(!function_exists('vc_map')) return;

      $order_by_values = array(
        '',
        __( 'Date', 'js_composer' ) => 'date',
        __( 'ID', 'js_composer' ) => 'ID',
        __( 'Author', 'js_composer' ) => 'author',
        __( 'Title', 'js_composer' ) => 'title',
        __( 'Modified', 'js_composer' ) => 'modified',
        __( 'Random', 'js_composer' ) => 'rand',
        __( 'Comment count', 'js_composer' ) => 'comment_count',
        __( 'Menu order', 'js_composer' ) => 'menu_order',
      );

      $order_way_values = array(
        '',
        __( 'Descending', 'js_composer' ) => 'DESC',
        __( 'Ascending', 'js_composer' ) => 'ASC',
      );

      $static_blocks = array('--choose--' => '');
      
      foreach(et_get_static_blocks() as $value) {
        $static_blocks[$value['label']] = $value['value'];
      }
	    $params = array(
	      'name' => '[8THEME] Products',
	      'base' => 'etheme_products',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ET_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("IDs", ET_DOMAIN),
	          "param_name" => "ids"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("SKUs", ET_DOMAIN),
	          "param_name" => "skus"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display Type", ET_DOMAIN),
	          "param_name" => "type",
	          "value" => array( 
                __("Slider", ET_DOMAIN) => 'slider',
                __("Slider full width (LOOK BOOK)", ET_DOMAIN) => 'full-width', 
                __("Grid", ET_DOMAIN) => 'grid', 
                __("List", ET_DOMAIN) => 'list'
              )
	        ),

          array(
            "type" => "dropdown",
            "heading" => __("Start from first slide", ET_DOMAIN),
            "param_name" => "from_first",
            "dependency" => Array('element' => "type", 'value' => array('full-width')),
            "value" => array( 
                '' => '',
                __("Yes", ET_DOMAIN) => 'yes', 
                __("No", ET_DOMAIN) => 'no'
              )
          ),
          array(
            "type" => "dropdown",
            "dependency" => Array('element' => "type", 'value' => array('full-width')),
            "heading" => __("Static block for the first slide of the LOOK BOOK", ET_DOMAIN),
            "param_name" => "block_id",
            "value" => $static_blocks
          ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Columns", ET_DOMAIN),
	          "param_name" => "columns",
	          "dependency" => Array('element' => "type", 'value' => array('grid'))
	        ),
            array(
              "type" => "dropdown",
              "heading" => __("Product view", ET_DOMAIN),
              "param_name" => "style",
              "dependency" => Array('element' => "type", 'value' => array('slider')),
              "value" => array( __("Default", ET_DOMAIN) => 'default', __("Advanced", ET_DOMAIN) => 'advanced')
            ),
            array(
              "type" => "dropdown",
              "heading" => __("Product hover", ET_DOMAIN),
              "param_name" => "hover",
              "value" => array( 
                    __("Default", ET_DOMAIN) => '', 
                    __("Disable", ET_DOMAIN) => 'disable', 
                    __("Swap", ET_DOMAIN) => 'swap', 
                    __("Default light", ET_DOMAIN) => 'default-light', 
                    __("Default dark", ET_DOMAIN) => 'default-dark', 
                    __("Images Slider", ET_DOMAIN) => 'slider', 
                    __("Mask", ET_DOMAIN) => 'mask'
                )
            ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on desktop", ET_DOMAIN),
	          "param_name" => "desktop",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on notebook", ET_DOMAIN),
	          "param_name" => "notebook",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on tablet", ET_DOMAIN),
	          "param_name" => "tablet",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of items on phones", ET_DOMAIN),
	          "param_name" => "phones",
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Products type", ET_DOMAIN),
	          "param_name" => "products",
	          "value" => array( __("All", ET_DOMAIN) => '', __("Featured", ET_DOMAIN) => 'featured', __("New", ET_DOMAIN) => 'new', __("Sale", ET_DOMAIN) => 'sale', __("Recently viewed", ET_DOMAIN) => 'recently_viewed', __("Bestsellings", ET_DOMAIN) => 'bestsellings')
	        ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Order by', 'js_composer' ),
            'param_name' => 'orderby',
            'value' => $order_by_values,
            'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', ET_DOMAIN ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Order way', 'js_composer' ),
            'param_name' => 'order',
            'value' => $order_way_values,
            'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', ET_DOMAIN ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
          ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ET_DOMAIN),
	          "param_name" => "limit"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Categories IDs", ET_DOMAIN),
	          "param_name" => "categories"
	        )
	      )
	
	    );  
	
	    vc_map($params);
	}
}
