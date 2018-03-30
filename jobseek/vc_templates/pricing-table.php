<?php

/* Pricing Table
-------------------------------------------------------------------------------------------------------------------*/

if (!function_exists('pricing_table')) {
	function pricing_table($atts, $content = null) {
        $args = array(
            "title"       => "",
            "price"       => "",
            "highlight"   => false,
            "button"      => "",
            "link"        => "",
            "product_id"  => "",
            "button_text" => "",
        );
	        
		extract(shortcode_atts($args, $atts));
	        
	    $output = '<div class="pricing">'; 

            if( $highlight ) {
                $output .= '<ul class="popular">';
            } else {
                $output .= '<ul>';
            }

                $output .= '<li class="title">' . $title . '</li>';
                $output .= '<li class="price">' . $price . '</li>';
                $output .= strip_tags($content, '<li>');

                switch ($button) {
                    case 'link':
                        $link = ( $link == '||' ) ? '' : $link;
                        $link = vc_build_link( $link );
                        $use_link = false;
                        if ( strlen( $link['url'] ) > 0 ) {
                            $use_link = true;
                            $a_href = $link['url'];
                            $a_title = $link['title'];
                            $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
                        }
                        $output .= '<li><a href="' . $a_href . '" class="btn btn-primary" target="' . $a_target . '">' . $a_title . '</a></li>';
                        break;
                    case 'buy':
                        global $woocommerce;
                        if( !empty($woocommerce) ) {
                            $cart_url = $woocommerce->cart->get_cart_url();
                            $output .= '<li><a href="' . $cart_url . '?add-to-cart=' . $product_id . '" class="btn btn-primary">' . $button_text . '</a></li>';
                        }
                        break;                
                    default:
                        break;
                }

        $output .= '</ul></div>'; 
            	    
	    return $output;
	}
}
add_shortcode('pricing_table', 'pricing_table');