<?php
/*
 * Availability Class
 *
 */
if( ! function_exists( 'media_center_availability_label_class') ) :
function media_center_availability_label_class( $availability ){
	$class = '';
	switch( $availability['class'] ) {
		case 'out-of-stock':
			$class = 'label-danger';
		break;
		case 'available-on-backorder':
			$class = 'label-warning';
		break;
		default :
			$class = 'label-success';
	}
	return $class;
}
endif;

if( ! function_exists( 'woocommerce_show_brand') ) :
function woocommerce_show_brand( $product_id = false, $return = false ){
	
	global $product;
	
	$product_id = ($product_id) ? $product_id : $product->id;

	$terms = get_the_terms( $product_id, 'product_brand' );
	$on_brand = '';
	if ( $terms && ! is_wp_error( $terms ) ) {
		$brand_links = array();
		foreach ( $terms as $term ) {
			$brand_links[] = $term->name;
		}
		$on_brand = join( ", ", $brand_links );
	}

	$output = $on_brand; //TODO : Add code to store brands 

	if( $return ){
		return $output;
	} else {
		echo '<div class="product-brand">' . $output . '</div>';
	}
}
endif;

// WooCommerce Pages

function media_center_woocommerce_pages( $menu = true, $wrap_before = '<ul>', $wrap_after = '</ul>' ){
	$woocommerce_pages = array(
		get_option( 'woocommerce_shop_page_id' ),
		get_option( 'woocommerce_cart_page_id' ),
		get_option( 'woocommerce_checkout_page_id' ),
		get_option( 'woocommerce_terms_page_id' ),
		get_option( 'woocommerce_myaccount_page_id' ),
	);
	$output = '';

	if( $menu ) {
		$output .= $wrap_before;
		foreach( $woocommerce_pages as $woocommerce_page ){
			if ( !empty( $woocommerce_page ) ){
				$output .= '<li><a href="' . get_permalink( $woocommerce_page ) . '">' . get_the_title( $woocommerce_page ) . '</a></li>';
			}
		}
		$output .= $wrap_after;
	} else {
		$output = $woocommerce_pages ;
	}

	return $output;
}

if ( ! function_exists( 'mediacenter_breadcrumb' ) ) {
    function mediacenter_breadcrumb( $args = array() ) {
        $args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
            'delimiter'   => ' &#47; ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'mediacenter' )
        ) ) );

        $breadcrumbs = new WC_Breadcrumb();

        if ( $args['home'] ) {
            $breadcrumbs->add_crumb( $args['home'], home_url() );
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        wc_get_template( 'framework/inc/breadcrumb.php', $args );
    }
}