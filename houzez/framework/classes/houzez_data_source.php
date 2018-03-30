<?php
class houzez_data_source {

    static $fake_loop_offset = 0; 

    static function shortcode_to_args($atts = '', $paged = '') {
        extract(shortcode_atts(
                array(
                    'property_type' => '',
                    'property_status' => '',
                    'property_city' => '',
                    'property_area' => '',
                    'featured_prop' => '',
                    'property_ids' => '',
                    'posts_limit' => '',
                    'offset' => '',
                ),
                $atts
            )
        );

        $tax_query = array();
        //$property_ids_array = array();

        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if (!empty($property_type)) {
            $tax_query[] = array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $property_type
            );
        }
        if (!empty($property_status)) {
            $tax_query[] = array(
                'taxonomy' => 'property_status',
                'field' => 'slug',
                'terms' => $property_status
            );
        }
        if (!empty($property_city)) {
            $tax_query[] = array(
                'taxonomy' => 'property_city',
                'field' => 'slug',
                'terms' => $property_city
            );
        }
        if (!empty($property_area)) {
            $tax_query[] = array(
                'taxonomy' => 'property_area',
                'field' => 'slug',
                'terms' => $property_area
            );
        }

        $property_ids_array = explode(',', $property_ids);

        if (!empty($property_ids)) {
            $wp_query_args['post__in'] = $property_ids_array;
        }

        $tax_count = count( $tax_query );

        if( $tax_count > 1 ) {
            $tax_query['relation'] = 'AND';
        }
        if( $tax_count > 0 ){
            $wp_query_args['tax_query'] = $tax_query;
        }


        if (!empty($featured_prop)) {
            
            if( $featured_prop == "yes" ) {
                $wp_query_args['meta_key'] = 'fave_featured';
                $wp_query_args['meta_value'] = '1';
            } else {
                $wp_query_args['meta_key'] = 'fave_featured';
                $wp_query_args['meta_value'] = '0';
            }
        }

        $wp_query_args['post_status'] = 'publish';

        if (empty($posts_limit)) {
            $posts_limit = get_option('posts_per_page');
        }
        $wp_query_args['posts_per_page'] = $posts_limit;

        if (!empty($paged)) {
            $wp_query_args['paged'] = $paged;
        } else {
            $wp_query_args['paged'] = 1;
        }

        if (!empty($offset) and $paged > 1) {
            $wp_query_args['offset'] = $offset + ( ($paged - 1) * $posts_limit) ;
        } else {
            $wp_query_args['offset'] = $offset ;
        }

        self::$fake_loop_offset = $offset;

        $wp_query_args['post_type'] = 'property';

        return $wp_query_args;
    }




    /************************************************************************************** 
        converts a post metabox value array to a wordpress query args array
    ***************************************************************************************/
    static function metabox_to_args($homepage_loop_filter, $paged = '') {


        $wp_query_args = self::shortcode_to_args($homepage_loop_filter, $paged);


        $wp_query_args['ignore_sticky_posts'] = 0;

        if (isset($wp_query_args['offset']) and $wp_query_args['offset'] > 0) {
            add_filter('found_posts', array(__CLASS__, 'hook_fix_offset_pagination'), 1, 2 );
        }

        return $wp_query_args;
    }


    /************************************************************************************** 
        custom pagination for the fake template loops - used by hook
    ***************************************************************************************/
    static function hook_fix_offset_pagination($found_posts, $query) {
        remove_filter('found_posts','hook_fix_offset_pagination');
        return $found_posts - houzez_data_source::$fake_loop_offset;
    }


    static function &get_wp_query ($atts = '', $paged = '') {
        $args = self::shortcode_to_args($atts, $paged);
        $fave_query = new WP_Query($args);
        return $fave_query;
    }


}

