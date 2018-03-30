<?php
/**
 * Since 1.3.0
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/08/16
 * Time: 7:41 PM
 */

/*-----------------------------------------------------------------------------------*/
// Get Theme Currency
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_get_currency')){
    function houzez_get_currency(){
        $currency = houzez_option( 'currency_symbol' );
        if(!empty($currency)){
            return $currency;
        }
        return esc_html__( '$' , 'houzez' );
    }
}
/*-----------------------------------------------------------------------------------*/
// Get price
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_property_price ') ) {
    function houzez_get_property_price ( $price_number ) {

        $price_number = doubleval( $price_number );

        if( $price_number ) {

            // if wp-currencies plugin installed and current currency cookie is set
            if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "houzez_current_currency" ] ) ) {
                $current_currency = $_COOKIE[ "houzez_current_currency" ];
                if ( currency_exists( $current_currency ) ) {    // validate current currency
                    $base_currency = houzez_get_base_currency();
                    $converted_price = convert_currency( $price_number, $base_currency, $current_currency );
                    return format_currency( $converted_price, $current_currency );
                }
            }

            $currency = houzez_get_currency();
            $decimals = intval(houzez_option( 'decimals' ));
            $dec_point = houzez_option( 'decimal_point_separator' );
            $thousands_sep = houzez_option( 'thousands_separator' );
            $currency_position = houzez_option( 'currency_position' );
            $formatted_price = number_format ( $price_number , $decimals , $dec_point , $thousands_sep );

            if(  $currency_position == 'before' ) {
                return $currency . $formatted_price;
            } else {
                return $formatted_price . $currency;
            }

        } else {
            $currency = 'invalid';
        }

        return $currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get invoice price
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_invoice_price ') ) {
    function houzez_get_invoice_price ( $price_number ) {

        $price_number = doubleval( $price_number );

        if( $price_number ) {

            // if wp-currencies plugin installed and current currency cookie is set
            if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "houzez_current_currency" ] ) ) {
                $current_currency = $_COOKIE[ "houzez_current_currency" ];
                if ( currency_exists( $current_currency ) ) {    // validate current currency
                    $base_currency = houzez_get_base_currency();
                    $converted_price = convert_currency( $price_number, $base_currency, $current_currency );
                    return format_currency( $converted_price, $current_currency );
                }
            }

            $currency = houzez_get_currency();
            $decimals = 2;
            $dec_point = houzez_option( 'decimal_point_separator' );
            $thousands_sep = houzez_option( 'thousands_separator' );
            $currency_position = houzez_option( 'currency_position' );
            $formatted_price = number_format ( $price_number , $decimals , $dec_point , $thousands_sep );

            if(  $currency_position == 'before' ) {
                return $currency . $formatted_price;
            } else {
                return $formatted_price . $currency;
            }

        } else {
            $currency = '';
        }

        return $currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Listing Price
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price ') ) {
    function houzez_listing_price() {

        $sale_price = get_post_meta( get_the_ID(), 'fave_property_price', true);
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true);

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if (!empty($sale_price)) {

            if (!empty($price_postfix)) {
                if( empty( $second_price ) ) {
                    $price_postfix = '&#47;' . $price_postfix;
                } else {
                    $price_postfix = '';
                }
            }

            return houzez_get_property_price($sale_price) . $price_postfix;

        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Listing price by property ID
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_by_id ') ) {
    function houzez_listing_price_by_id( $propID )
    {

        $sale_price = get_post_meta( $propID, 'fave_property_price', true);
        $second_price     = get_post_meta( $propID, 'fave_property_sec_price', true );
        $price_postfix = get_post_meta( $propID, 'fave_property_price_postfix', true);

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if (!empty($sale_price)) {

            if (!empty($price_postfix)) {
                if( empty( $second_price ) ) {
                    $price_postfix = '&#47;' . $price_postfix;
                } else {
                    $price_postfix = '';
                }
            }

            return houzez_get_property_price($sale_price) . $price_postfix;

        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Listing price version 1
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_v1 ') ) {
    function houzez_listing_price_v1()
    {
        $output = '';
        $sale_price     = get_post_meta( get_the_ID(), 'fave_property_price', true );
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true );
        $price_prefix  = get_post_meta( get_the_ID(), 'fave_property_price_prefix', true );

        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            if( is_singular( 'property' ) ) {
                $output .= '<span class="item-price item-price-text price-single-listing-text">'.$sale_price. '</span>';
                return $output;
            }
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if( !empty( $price_prefix ) ) {
            $price_prefix = '<span class="price-start">'.$price_prefix.'</span>';
        }

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = '&#47;' . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {

                if( is_singular( 'property' ) ) {
                    $output .= '<span class="item-price">'.$price_prefix. houzez_get_property_price($sale_price) . '</span>';
                    if (!empty($second_price)) {
                        $output .= '<span class="item-sub-price">';
                        $output .= houzez_get_property_price($second_price) . $price_postfix;
                        $output .= '</span>';
                    }
                } else {
                    $output .= $price_prefix.'<span class="item-price">'. houzez_get_property_price($sale_price) . '</span>';
                    if (!empty($second_price)) {
                        $output .= '<span class="item-sub-price">';
                        $output .= houzez_get_property_price($second_price) . $price_postfix;
                        $output .= '</span>';
                    }
                }
            } else {
                if (!empty( $sale_price )) {
                    if( is_singular( 'property' ) ) {
                        $output .= '<span class="item-price">';
                        $output .= $price_prefix. houzez_get_property_price($sale_price) . $price_postfix;
                        $output .= '</span>';
                    } else {
                        $output .= $price_prefix;
                        $output .= '<span class="item-price">';
                        $output .= houzez_get_property_price($sale_price) . $price_postfix;
                        $output .= '</span>';
                    }
                }
            }

        }
        return $output;
    }
}

/*-----------------------------------------------------------------------------------*/
// Price for print property
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_for_print ') ) {
    function houzez_listing_price_for_print( $propID )
    {

        $sale_price     = get_post_meta( $propID, 'fave_property_price', true );
        $second_price     = get_post_meta( $propID, 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( $propID, 'fave_property_price_postfix', true );

        $price_prefix  = get_post_meta( $propID, 'fave_property_price_prefix', true );

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if( !empty( $price_prefix ) ) {
            $price_prefix = '<span class="price-start">'.$price_prefix.'</span>';
        }

        $output = '';

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = '&#47;' . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {

                $output .= $price_prefix. '<span class="item-price">'. houzez_get_property_price($sale_price) . '</span>';
                if (!empty($second_price)) {
                    $output .= '<span class="item-sub-price">';
                    $output .= houzez_get_property_price($second_price) . $price_postfix;
                    $output .= '</span>';
                }
            } else {
                if (!empty( $sale_price )) {
                    $output .= $price_prefix;
                    $output .= '<span class="item-price">';
                    $output .= $price_prefix.' '.houzez_get_property_price($sale_price) . $price_postfix;
                    $output .= '</span>';
                }
            }

        }
        return $output;
    }
}

/*-----------------------------------------------------------------------------------*/
// Price for admin property custom post type
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'houzez_property_price_admin' ) ) {
    function houzez_property_price_admin () {
        global $post;
        $sale_price     = get_post_meta( get_the_ID(), 'fave_property_price', true );
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true );

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<b>'.$sale_price. '</b>';
            echo $output;
            return;
        }

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = '&#47;' . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {
                echo '<b>' . houzez_get_property_price($sale_price) . '</b><br/>';

                if (!empty( $second_price )) {
                    echo houzez_get_property_price($second_price) . $price_postfix;
                }
            } else {
                if (!empty( $sale_price )) {
                    echo '<b>';
                    echo houzez_get_property_price($sale_price) . $price_postfix;
                    echo '</b>';
                }
            }

        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Minimum Price List
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_min_price_list') ) {
    function houzez_min_price_list() {
        $min_price_array = array( 1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000 );
        $searched_price = '';

        $minimum_price_theme_options = houzez_option('min_price');

        if( !empty($minimum_price_theme_options) ) {
            $min_price_strings_array = explode( ',', $minimum_price_theme_options );

            if( is_array( $min_price_strings_array ) && !empty( $min_price_strings_array ) ) {
                $temp_min_price_array = array();
                foreach( $min_price_strings_array as $min_price ) {
                    $min_price_integer = floatval( $min_price );
                    if( $min_price_integer > 1 ) {
                        $temp_min_price_array[] = $min_price_integer;
                    }
                }

                if( !empty( $temp_min_price_array ) ) {
                    $min_price_array = $temp_min_price_array;
                }
            }
        }

        if( isset( $_GET['min-price'] ) ) {
            $searched_price = $_GET['min-price'];
        }

        if( !empty( $min_price_array ) ) {
            foreach( $min_price_array as $min_price ) {
                if( $searched_price == $min_price ) {
                    echo '<option value="'.esc_attr( $min_price ).'" selected="selected">'.houzez_get_property_price( $min_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $min_price ).'">'.houzez_get_property_price( $min_price ).'</option>';
                }
            }
        }


        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Minimum Price List For Rent Only
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_min_price_list_for_rent') ) {
    function houzez_min_price_list_for_rent() {
        $min_price_array = array( 500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000 );
        $searched_price = '';

        $minimum_price_theme_options = houzez_option('min_price_rent');

        if( !empty($minimum_price_theme_options) ) {
            $min_price_strings_array = explode( ',', $minimum_price_theme_options );

            if( is_array( $min_price_strings_array ) && !empty( $min_price_strings_array ) ) {
                $temp_min_price_array = array();
                foreach( $min_price_strings_array as $min_price ) {
                    $min_price_integer = floatval( $min_price );
                    if( $min_price_integer > 1 ) {
                        $temp_min_price_array[] = $min_price_integer;
                    }
                }

                if( !empty( $temp_min_price_array ) ) {
                    $min_price_array = $temp_min_price_array;
                }
            }
        }

        if( isset( $_GET['min-price'] ) ) {
            $searched_price = $_GET['min-price'];
        }

        if( !empty( $min_price_array ) ) {
            foreach( $min_price_array as $min_price ) {
                if( $searched_price == $min_price ) {
                    echo '<option value="'.esc_attr( $min_price ).'" selected="selected">'.houzez_get_property_price( $min_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $min_price ).'">'.houzez_get_property_price( $min_price ).'</option>';
                }
            }
        }


        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Maximum Price List
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_max_price_list') ) {
    function houzez_max_price_list() {
        $max_price_array = array( 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000 );
        $searched_price = '';

        $maximum_price_theme_options = houzez_option('max_price');

        if( !empty($maximum_price_theme_options) ) {
            $max_price_strings_array = explode( ',', $maximum_price_theme_options );

            if( is_array( $max_price_strings_array ) && !empty( $max_price_strings_array ) ) {
                $temp_max_price_array = array();
                foreach( $max_price_strings_array as $max_price ) {
                    $max_price_integer = floatval( $max_price );
                    if( $max_price_integer > 1 ) {
                        $temp_max_price_array[] = $max_price_integer;
                    }
                }

                if( !empty( $temp_max_price_array ) ) {
                    $max_price_array = $temp_max_price_array;
                }
            }
        }

        if( isset( $_GET['max-price'] ) ) {
            $searched_price = $_GET['max-price'];
        }

        if( !empty( $max_price_array ) ) {
            foreach( $max_price_array as $max_price ) {
                if( $searched_price == $max_price ) {
                    echo '<option value="'.esc_attr( $max_price ).'" selected="selected">'.houzez_get_property_price( $max_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $max_price ).'">'.houzez_get_property_price( $max_price ).'</option>';
                }
            }
        }


        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Maximum Price List For Rent Only
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_max_price_list_for_rent') ) {
    function houzez_max_price_list_for_rent() {
        $max_price_array = array( 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000, 40000, 50000, 75000, 100000, 150000 );
        $searched_price = '';

        $maximum_price_theme_options = houzez_option('max_price_rent');

        if( !empty($maximum_price_theme_options) ) {
            $max_price_strings_array = explode( ',', $maximum_price_theme_options );

            if( is_array( $max_price_strings_array ) && !empty( $max_price_strings_array ) ) {
                $temp_max_price_array = array();
                foreach( $max_price_strings_array as $max_price ) {
                    $max_price_integer = floatval( $max_price );
                    if( $max_price_integer > 1 ) {
                        $temp_max_price_array[] = $max_price_integer;
                    }
                }

                if( !empty( $temp_max_price_array ) ) {
                    $max_price_array = $temp_max_price_array;
                }
            }
        }

        if( isset( $_GET['max-price'] ) ) {
            $searched_price = $_GET['max-price'];
        }

        if( !empty( $max_price_array ) ) {
            foreach( $max_price_array as $max_price ) {
                if( $searched_price == $max_price ) {
                    echo '<option value="'.esc_attr( $max_price ).'" selected="selected">'.houzez_get_property_price( $max_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $max_price ).'">'.houzez_get_property_price( $max_price ).'</option>';
                }
            }
        }


        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

    }
}