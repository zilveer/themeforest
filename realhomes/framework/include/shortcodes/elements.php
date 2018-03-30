<?php
/* ------------------------------------------------------------------------*
 * Properties Shortcode
 * ------------------------------------------------------------------------*/
if( !function_exists( 'inspiry_properties' ) ) {
    function inspiry_properties( $attributes, $content = null ) {
        extract( shortcode_atts( array(
                                    'count' => 3,
                                    'layout' => 'grid',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'locations' => null,
                                    'statuses' => null,
                                    'types' => null,
                                    'features' => null,
                                    'relation' => 'AND',
                                    'min_beds' => null,
                                    'max_beds' => null,
                                    'min_baths' => null,
                                    'max_baths' => null,
                                    'min_price' => null,
                                    'max_price' => null,
                                    'min_area' => null,
                                    'max_area' => null,
                                    'featured' => 'no',
                                ), $attributes ) );

        ob_start();

        $properties_shortcode_args = array(
            'post_type' => 'property',
            'posts_per_page' => $count,
        );

        // Order By
        if ( $orderby == 'price' ) {
            $properties_shortcode_args['orderby'] = 'meta_value_num';
            $properties_shortcode_args['meta_key'] = 'REAL_HOMES_property_price';
        } else {
            $properties_shortcode_args['orderby'] = 'date';
        }
        // Order
        if ( $order == 'ASC' || $order == 'asc' ) {
            $properties_shortcode_args['order'] = 'ASC';
        } else {
            $properties_shortcode_args['order'] = 'DESC';
        }

        /* Properties Taxonomy Query
        -----------------------------*/
        $tax_query = array();

        // Properties types
        if( $types ) {
            $types = explode( ',', $types );
            $tax_query[] = array(
                'taxonomy' => 'property-type',
                'field' => 'slug',
                'terms' => $types
            );
        }

        // Properties statuses
        if( $statuses ) {
            $statuses = explode( ',', $statuses );
            $tax_query[] = array(
                'taxonomy' => 'property-status',
                'field' => 'slug',
                'terms' => $statuses
            );
        }

        // Properties locations
        if( $locations ) {
            $locations = explode( ',', $locations );
            $tax_query[] = array(
                'taxonomy' => 'property-city',
                'field' => 'slug',
                'terms' => $locations
            );
        }

        // Properties features
        if( $features ) {
            $features = explode( ',', $features );
            $tax_query[] = array(
                'taxonomy' => 'property-feature',
                'field' => 'slug',
                'terms' => $features
            );
        }

        // Taxonomy query relationship only if taxonomies are more than one
        $tax_count = count( $tax_query );
        if( $tax_count > 1 ) {
            if ( $relation == 'OR' ) {
                $tax_query['relation'] = 'OR';
            } else {
                $tax_query['relation'] = 'AND';
            }
        }
        if( $tax_count > 0 ){
            $properties_shortcode_args['tax_query'] = $tax_query;
        }


        /* Properties Meta Query
        -----------------------------*/
        $meta_query = array();

        // Bedrooms
        if( !empty( $min_beds ) || !empty( $max_beds ) ) {
            $min_beds = abs( intval( $min_beds ) );
            $max_beds = abs( intval( $max_beds ) );
            if( $max_beds > 0 ) {
                // if max beds are greater than 0 then either min beds are 0 or greater than 0, And in both cases same query will be enough
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_bedrooms',
                    'value' => array( $min_beds, $max_beds ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            } else {
                // if max beds are 0 then only min beds matters
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_bedrooms',
                    'value' => $min_beds,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        // Bathrooms
        if( !empty( $min_baths ) || !empty( $max_baths ) ) {
            $min_baths = abs( intval( $min_baths ) );
            $max_baths = abs( intval( $max_baths ) );
            if( $max_baths > 0 ) {
                // if max baths are greater than 0 then either min baths are 0 or greater than 0, And in both cases same query will be enough
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_bathrooms',
                    'value' => array( $min_baths, $max_baths ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            } else {
                // if max baths are 0 then only min baths matters
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_bathrooms',
                    'value' => $min_baths,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        // Price
        if( !empty( $min_price ) || !empty( $max_price ) ) {
            $min_price = doubleval( $min_price );
            $max_price = doubleval( $max_price );
            if( $max_price > 0 ) {
                // if max price is greater than 0 then either min price is 0 or greater than 0, And in both cases same query will be enough
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => array( $min_price, $max_price ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            } else {
                // if max price is 0 then only min price matters
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        // Size
        if( !empty( $min_area ) || !empty( $max_area ) ) {
            $min_area = intval( $min_area );
            $max_area = intval( $max_area );
            if( $max_area > 0 ) {
                // if max area is greater than 0 then either min area is 0 or greater than 0, And in both cases same query will be enough
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => array( $min_area, $max_area ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );
            } else {
                // if max area is 0 then only min area matters
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => $min_area,
                    'type' => 'NUMERIC',
                    'compare' => '>=',
                );
            }
        }

        //Featured Properties
        $featured = ( $featured == 'yes' ) ? true : false ;
        if( $featured ) {
            $meta_query[] = array(
                'key' => 'REAL_HOMES_featured',
                'value' => 1,
                'compare' => '=',
                'type'  => 'NUMERIC'
            );
        }

        // if more than one meta query elements exist then specify the relation
        $meta_count = count( $meta_query );
        if( $meta_count > 1 ){
            if ( $relation == 'OR' ) {
                $meta_query['relation'] = 'OR';
            } else {
                $meta_query['relation'] = 'AND';
            }
        }
        if( $meta_count > 0 ){
            $properties_shortcode_args['meta_query'] = $meta_query;
        }

        // inspiry_log( $properties_shortcode_args );

        $properties_shortcode_query = new WP_Query( $properties_shortcode_args );

        if ( $properties_shortcode_query->have_posts() ) :

            if ( $layout == 'list' ) :
                // LIST LAYOUT
                echo '<div class="listing-layout inspiry-shortcode">';
                echo '<div class="list-container clearfix">';

                while ( $properties_shortcode_query->have_posts() ) :
                    $properties_shortcode_query->the_post();

                    // display property in list layout
                    get_template_part('template-parts/property-for-listing');

                endwhile;
                echo '</div>';
                echo '</div>';

            else:
                // GRID LAYOUT
                echo '<div class="listing-layout property-grid inspiry-shortcode">';
                echo '<div class="list-container clearfix">';
                while ( $properties_shortcode_query->have_posts() ) :
                    $properties_shortcode_query->the_post();

                    // Display Property in grid layout
                    get_template_part('template-parts/property-for-grid');

                endwhile;
                echo '</div>';
                echo '</div>';

            endif;

        else:
            alert ( __('Result:', 'framework'), __('No Properties Found!', 'framework') );
        endif;

        wp_reset_query();

        return ob_get_clean();
    }
}
add_shortcode('properties', 'inspiry_properties');


/* ------------------------------------------------------------------------*
 * Messages Shortcode
 * ------------------------------------------------------------------------*/
 
 // Information
if( !function_exists( 'show_info' ) ){
    function show_info($atts, $content = null) {
        return '<p class="info">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('info', 'show_info');

// Tip
if( !function_exists( 'show_tip' ) ){
    function show_tip($atts, $content = null) {
        return '<p class="tip">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('tip', 'show_tip');
 
 // Error
if( !function_exists( 'show_error' ) ){
    function show_error($atts, $content = null) {
        return '<p class="error">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('error', 'show_error');

 // Success
if( !function_exists( 'show_success' ) ){
    function show_success($atts, $content = null) {
        return '<p class="success">'.do_shortcode($content).'<i class="icon-remove"></i></p>';
    }
}
add_shortcode('success', 'show_success');



/* ------------------------------------------------------------------------*
 * Lists
 * ------------------------------------------------------------------------*/
// Disc list
if( !function_exists( 'disc_list' ) ){
    function disc_list($atts, $content = null) {
        return '<div class="disc-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('disc_list', 'disc_list');

// small arrow list
if( !function_exists( 'small_arrow_list' ) ){
    function small_arrow_list($atts, $content = null) {
        return '<div class="small-arrow-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('small_arrow_list', 'small_arrow_list');

// Tick list
if( !function_exists( 'tick_list' ) ){
    function tick_list($atts, $content = null) {
        return '<div class="tick-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('tick_list', 'tick_list');

// Arrow list
if( !function_exists( 'arrow_list' ) ){
    function arrow_list($atts, $content = null) {
        return '<div class="arrow-list">'.do_shortcode($content).'</div>';
    }
}
add_shortcode('arrow_list', 'arrow_list');


/* ------------------------------------------------------------------------*
 * Buttons
 * ------------------------------------------------------------------------*/

// Button Real Mini
if( !function_exists( 'button_real_mini' ) ){
    function button_real_mini($atts, $content = null) {
        extract(shortcode_atts(array(
                                    'link' => '#',
                                    'target' => ''
                                    ), $atts));

        return '<a class="real-btn btn-mini" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_mini', 'button_real_mini');


// Button Real Small
if( !function_exists( 'button_real_small' ) ){
    function button_real_small($atts, $content = null) {

        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="real-btn btn-small" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_small', 'button_real_small');


// Button Real Large
if( !function_exists( 'button_real_large' ) ){
    function button_real_large($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="real-btn btn-large" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_large', 'button_real_large');



// Button blue Mini
if( !function_exists( 'button_blue_mini' ) ){
    function button_blue_mini($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-blue btn-mini" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_blue_mini', 'button_blue_mini');


// Button blue Small
if( !function_exists( 'button_blue_small' ) ){
    function button_blue_small($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-blue btn-small" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_blue_small', 'button_blue_small');


// Button blue Large
if( !function_exists( 'button_blue_large' ) ){
    function button_blue_large($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-blue btn-large" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_blue_large', 'button_blue_large');


// Button grey Mini
if( !function_exists( 'button_grey_mini' ) ){
    function button_grey_mini($atts, $content = null){
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-grey btn-mini" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_grey_mini', 'button_grey_mini');


// Button grey Small
if( !function_exists( 'button_grey_small' ) ){
    function button_grey_small($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-grey btn-small" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_grey_small', 'button_grey_small');


// Button grey Large
if( !function_exists( 'button_grey_large' ) ){
    function button_grey_large($atts, $content = null) {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="btn-grey btn-large" href="'.$link.'" target="'.$target.'">'.do_shortcode($content).'</a>';
    }
}
add_shortcode('button_grey_large', 'button_grey_large');


// Video Wrapper
if( !function_exists( 'video_wrapper' ) ){
    function video_wrapper( $atts, $content = null ) {
        return '<div class="post-video"><div class="video-wrapper">'.stripslashes( htmlspecialchars_decode( $content ) ).'</div></div>';
    }
}
add_shortcode('video_wrapper', 'video_wrapper');

?>