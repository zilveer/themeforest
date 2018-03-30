<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! brands
// **********************************************************************// 

add_shortcode('brands', 'et_brands');

if(!function_exists('et_brands')) {
	function et_brands($atts) {
        extract( shortcode_atts( array(
            'number'     => null,
            'title'      => '',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'columns'    => 3,
            'parent'     => '',
            'display_type'=> 'slider',
            'class'      => ''
        ), $atts ) );

        if ( isset( $atts[ 'ids' ] ) ) {
            $ids = explode( ',', $atts[ 'ids' ] );
            $ids = array_map( 'trim', $ids );
        } else {
            $ids = array();
        }


        // get terms and workaround WP bug with parents/pad counts
        $args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => 1,
            'include'    => $ids,
            'pad_counts' => true,
            'child_of'   => $parent
        );

        $terms = get_terms( 'brand', $args );

        if ( $parent !== "" ) {
            $terms = wp_list_filter( $terms, array( 'parent' => $parent ) );
        }

        if ( $number ) {
            $terms = array_slice( $terms, 0, $number );
        }

		
		$output = '';
		$rand = rand(1000,9999);
		
		$count = count($terms); $i=0;
		if ($count > 0) {
			$output .= '<div class="carousel-area et-brands-'.$display_type.' '.$class.' columns-number-'.$columns.'">';	
			if($title != '') {
				$output .= '<h2 class="brands-title title"><span>'.$title.'</span></h2>';
			}
			$output .= '<div class="brandCarousel'.$rand.'">';
			
		    foreach ($terms as $term) {
		        $i++;
		        $thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
				$output .= '<div class="et-brand">';
				if($thumbnail_id) {
					$output .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all products from %s', ET_DOMAIN), $term->name) . '"><img src="' . etheme_get_image($thumbnail_id) . '" title="' . $term->name . '"/></a>';		
				} else {
					$output .= '<h3><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all products from %s', ET_DOMAIN), $term->name) . '">' . $term->name . '</a></h3>';		
				}		
				$output .= '</div>';
		    }
		    
		    $output .= '</div>';
			$output .= '</div>';
			
			if($display_type == 'slider') {
				$items = '[[0, 1], [479,1], [619,2], [768,3],  [1200, 4], [1600, 4]]';
				$output .=  '<script type="text/javascript">';
				$output .=  '     jQuery(".brandCarousel'.$rand.'").owlCarousel({';
				$output .=  '         items:4, ';
				$output .=  '         navigation: true,';
				$output .=  '         navigationText:false,';
				$output .=  '         rewindNav: false,';
				$output .=  '         itemsCustom: '.$items.'';
				$output .=  '    });';
				
				$output .=  ' </script>';
			}
				
		}
			
		
		
		return $output;
	}
}

// **********************************************************************// 
// ! Register New Element: brands
// **********************************************************************//
add_action( 'init', 'et_register_vc_brands');
if(!function_exists('et_register_vc_brands')) {
	function et_register_vc_brands() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] Brands',
	      'base' => 'brands',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ET_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display type", ET_DOMAIN),
	          "param_name" => "display_type",
	          "value" => array( 
	              __("Slider", ET_DOMAIN) => 'slider',
	              __("Grid", ET_DOMAIN) => 'grid'
	            )
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Number of columns", ET_DOMAIN),
	          "param_name" => "columns",	          
	          "dependency" => Array('element' => "display_type", 'value' => array('grid')),
	          "value" => array( 
	              '2' => 2,
	              '3' => 3,
	              '4' => 4,
	              '5' => 5,
	              '6' => 6,
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of brands", ET_DOMAIN),
	          "param_name" => "number"
	        ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Order by", "js_composer"),
		      "param_name" => "orderby",
		      "value" => array( "", __("ID", "js_composer") => "id", __("Count", "js_composer") => "count", __("Name", "js_composer") => "name",  __("Slug", "js_composer") => "slug"),
		      
		    ),
		    array(
		      "type" => "dropdown",
		      "heading" => __("Order way", "js_composer"),
		      "param_name" => "order",
		      "value" => array( __("Descending", "js_composer") => "DESC", __("Ascending", "js_composer") => "ASC" ),
		      "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'js_composer'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		    ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Parent ID", ET_DOMAIN),
	          "param_name" => "parent",
              "description" => __('Get direct children of this term (only terms whose explicit parent is this value). If 0 is passed, only top-level terms are returned. Default is an empty string.', ET_DOMAIN)
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
