<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! etheme_categories
// **********************************************************************// 

add_shortcode('etheme_categories','etheme_categories_shortcode');

function etheme_categories_shortcode($atts) {
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'number'     => null,
        'title'      => '',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => 1,
        'columns' => 3,
        'parent'     => '',
        'display_type'=> 'grid',
        'class'      => ''
    ), $atts ) );

    if ( isset( $atts[ 'ids' ] ) ) {
        $ids = explode( ',', $atts[ 'ids' ] );
        $ids = array_map( 'trim', $ids );
    } else {
        $ids = array();
    }

    $title_output = '';

    if($title != '') {
        $title_output = '<h3 class="title"><span>' . $title . '</span></h3>';
    }

    $hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

    // get terms and workaround WP bug with parents/pad counts
    $args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
        'include'    => $ids,
        'pad_counts' => true,
        'child_of'   => $parent
    );

    $product_categories = get_terms( 'product_cat', $args );

    if ( $parent !== "" ) {
        $product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
    }

    if ( $hide_empty ) {
        foreach ( $product_categories as $key => $category ) {
            if ( $category->count == 0 ) {
                unset( $product_categories[ $key ] );
            }
        }
    }

    if ( $number ) {
        $product_categories = array_slice( $product_categories, 0, $number );
    }

    //$woocommerce_loop['columns'] = $columns;



    $box_id = rand(1000,10000);

    ob_start();

    // Reset loop/columns globals when starting a new loop
    $woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

    $woocommerce_loop['display_type'] = $display_type;
    $woocommerce_loop['categories_columns'] = $columns;

    if ( $product_categories ) {

        
        if($display_type == 'menu') {
        	$instance = array(
        		'title' => $title,
        		'hierarchical' => 1,
	            'orderby'    => $orderby,
	            'order'      => $order,
	            'hide_empty' => $hide_empty,
	            'include'    => $ids,
	            'pad_counts' => true,
	            'child_of'   => $parent
        	);
        	$args = array();
            echo '<div class="categories-menu-element '.$class.'">';
        	the_widget( 'WC_Widget_Product_Categories', $instance, $args );
            echo '</div>';
        } else {

            if($display_type == 'slider') {
                $class .= ' owl-carousel carousel-area';
            } else {
                $class .= ' row';
            }
            
        	echo $title_output;
        
            echo '<div class="categoriesCarousel '.$class.' slider-'.$box_id.'">';

            foreach ( $product_categories as $category ) {

                wc_get_template( 'content-product_cat.php', array(
                    'category' => $category
                ) );

            }

            echo '</div>';
            
        }


        if($display_type == 'slider') {
            echo '
                <script type="text/javascript">
                    jQuery(".slider-'.$box_id.'").owlCarousel({
                        items:4, 
                        lazyLoad : true,
                        navigation: true,
                        navigationText:false,
                        rewindNav: false,
                        itemsCustom: [[0, 1], [479,2], [619,3], [768,3],  [1200, 4], [1600, 4]]
                    });
    
                </script>
            ';
        }

    }

    woocommerce_reset_loop();

    return ob_get_clean();
}

// **********************************************************************// 
// ! Register New Element: scslug
// **********************************************************************//
add_action( 'init', 'et_register_vc_scslug');
if(!function_exists('et_register_vc_scslug')) {
	function et_register_vc_scslug() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8theme] Product categories',
	      'base' => 'etheme_categories',
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
	          "heading" => __("Number of categories", ET_DOMAIN),
	          "param_name" => "number"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Parent ID", ET_DOMAIN),
	          "param_name" => "parent",
              "description" => __('Get direct children of this term (only terms whose explicit parent is this value). If 0 is passed, only top-level terms are returned. Default is an empty string.', ET_DOMAIN)
		    ),
            array(
              "type" => "dropdown",
              "heading" => __("Display type", ET_DOMAIN),
              "param_name" => "display_type",
              "value" => array( 
                  __("Grid", ET_DOMAIN) => 'grid',
                  __("Slider", ET_DOMAIN) => 'slider',
                  __("Menu", ET_DOMAIN) => 'menu'
                )
            ),
            array(
              "type" => "dropdown",
              "heading" => __("Columns (for grid)", ET_DOMAIN),
              "param_name" => "columns",
              "value" => array( 
                  __("2", ET_DOMAIN) => 2,
                  __("3", ET_DOMAIN) => 3,
                  __("4", ET_DOMAIN) => 4,
                  __("5", ET_DOMAIN) => 5,
                  __("6", ET_DOMAIN) => 6,
                )
            ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ET_DOMAIN),
	          "param_name" => "class"
	        )
	      )
	    );  
	
	    vc_map($params);
	}
}
