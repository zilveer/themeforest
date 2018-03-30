<?php
class fave_data_source {

    static $fake_loop_offset = 0; 

    static function shortcode_to_args($atts = '', $paged = '') {
        extract(shortcode_atts(
                array(
                    'category_ids' => '',
                    'category_id' => '',
                    'tag_slug' => '',
                    'sort' => '',
                    'posts_limit' => '',
                    'autors_id' => '',
                    'featured_posts' => '',
                    'posts_per_page' => '',
                    'offset' => ''
                ),
                $atts
            )
        );

        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if (!empty($category_id) and empty($category_ids)) {
            $category_ids = $category_id;
        }


        if (!empty($category_ids)) {
            $wp_query_args['cat'] = $category_ids;
        }

        if ( !empty($tag_slug) ) {
            $wp_query_args['tag'] = str_replace(' ', '-', $tag_slug);
        }

       $current_day = date('j');

        switch ($sort) {
            
            case 'popular':
                $wp_query_args['meta_key'] = 'fave-post_views';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'review_high':
                $wp_query_args['meta_key'] = 'fave_final_score';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_posts':
                $wp_query_args['orderby'] = 'rand';
                break;
            case 'alphabetical_order':
                $wp_query_args['orderby'] = 'title';
                $wp_query_args['order'] = 'ASC';
                break;
            case 'comment_count':
                $wp_query_args['orderby'] = 'comment_count';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_today':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['year'] = date('Y');
                $wp_query_args['monthnum'] = date('n');
                $wp_query_args['day'] = date('j');
                break;
            case 'random_7_day':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['date_query'] = array(
                            'column' => 'post_date_gmt',
                            'after' => '1 week ago'
                            );
                break;
        }

        if (!empty($autors_id)) {
            $wp_query_args['author'] = $autors_id;
        }

        if (!empty($featured_posts)) {
            
            if( $featured_posts == "yes" ) {
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

        return $wp_query_args;
    }


    /************************************************************************************** 
        Columns two
    ***************************************************************************************/
    static function shortcode_to_args_column_one($atts = '', $paged = '') {
        extract(shortcode_atts(
                array(
                    
                    'category_id_1'     => '',
                    'category_ids_1'    => '',
                    'tag_slug_1'        => '',
                    'sort_1'            => '',
                    'posts_limit'       => '',
                    'autors_id_1'       => '',
                    'featured_posts_1'  => '',
                    'posts_per_page'    => '',
                    'offset_1'          => '',
                ),
                $atts
            )
        );

        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if (!empty($category_id_1) and empty($category_ids_1)) {
            $category_ids_1 = $category_id_1;
        }


        if (!empty($category_ids_1)) {
            $wp_query_args['cat'] = $category_ids_1;
        }

        if ( !empty($tag_slug_1) ) {
            $wp_query_args['tag'] = str_replace(' ', '-', $tag_slug_1);
        }

       $current_day = date('j');

        switch ($sort_1) {
            
            case 'popular':
                $wp_query_args['meta_key'] = 'fave-post_views';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'review_high':
                $wp_query_args['meta_key'] = 'fave_final_score';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_posts':
                $wp_query_args['orderby'] = 'rand';
                break;
            case 'alphabetical_order':
                $wp_query_args['orderby'] = 'title';
                $wp_query_args['order'] = 'ASC';
                break;
            case 'comment_count':
                $wp_query_args['orderby'] = 'comment_count';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_today':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['year'] = date('Y');
                $wp_query_args['monthnum'] = date('n');
                $wp_query_args['day'] = date('j');
                break;
            case 'random_7_day':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['date_query'] = array(
                            'column' => 'post_date_gmt',
                            'after' => '1 week ago'
                            );
                break;
        }

        if (!empty($autors_id_1)) {
            $wp_query_args['author'] = $autors_id_1;
        }

        if (!empty($featured_posts_1)) {
            
            if( $featured_posts_1 == "yes" ) {
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

        if ( !empty($offset_1) ) {
            $wp_query_args['offset'] = $offset_1 ;
        }


        return $wp_query_args;
    }

    /************************************************************************************** 
        Columns two
    ***************************************************************************************/
    static function shortcode_to_args_column_two($atts = '', $paged = '') {
        extract(shortcode_atts(
                array(
                    
                    'category_id_2'     => '',
                    'category_ids_2'    => '',
                    'tag_slug_2'        => '',
                    'sort_2'            => '',
                    'posts_limit'       => '',
                    'autors_id_2'       => '',
                    'featured_posts_2'  => '',
                    'posts_per_page'    => '',
                    'offset_2'          => '',
                ),
                $atts
            )
        );

        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if (!empty($category_id_2) and empty($category_ids_2)) {
            $category_ids_2 = $category_id_2;
        }


        if (!empty($category_ids_2)) {
            $wp_query_args['cat'] = $category_ids_2;
        }

        if ( !empty($tag_slug_2) ) {
            $wp_query_args['tag'] = str_replace(' ', '-', $tag_slug_2);
        }

       $current_day = date('j');

        switch ($sort_2) {
            
            case 'popular':
                $wp_query_args['meta_key'] = 'fave-post_views';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'review_high':
                $wp_query_args['meta_key'] = 'fave_final_score';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_posts':
                $wp_query_args['orderby'] = 'rand';
                break;
            case 'alphabetical_order':
                $wp_query_args['orderby'] = 'title';
                $wp_query_args['order'] = 'ASC';
                break;
            case 'comment_count':
                $wp_query_args['orderby'] = 'comment_count';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_today':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['year'] = date('Y');
                $wp_query_args['monthnum'] = date('n');
                $wp_query_args['day'] = date('j');
                break;
            case 'random_7_day':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['date_query'] = array(
                            'column' => 'post_date_gmt',
                            'after' => '1 week ago'
                            );
                break;
        }

        if (!empty($autors_id_2)) {
            $wp_query_args['author'] = $autors_id_2;
        }

        if (!empty($featured_posts_2)) {
            
            if( $featured_posts_2 == "yes" ) {
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

        if ( !empty($offset_2) ) {
            $wp_query_args['offset'] = $offset_2 ;
        }


        return $wp_query_args;
    }


    /************************************************************************************** 
        Columns Three
    ***************************************************************************************/
    static function shortcode_to_args_column_three($atts = '', $paged = '') {
        extract(shortcode_atts(
                array(
                    
                    'category_id_3'     => '',
                    'category_ids_3'    => '',
                    'tag_slug_3'        => '',
                    'sort_3'            => '',
                    'posts_limit'       => '',
                    'autors_id_3'       => '',
                    'featured_posts_3'  => '',
                    'posts_per_page'    => '',
                    'offset_3'          => '',
                ),
                $atts
            )
        );

        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if (!empty($category_id_3) and empty($category_ids_3)) {
            $category_ids_3 = $category_id_3;
        }


        if (!empty($category_ids_3)) {
            $wp_query_args['cat'] = $category_ids_3;
        }

        if ( !empty($tag_slug_3) ) {
            $wp_query_args['tag'] = str_replace(' ', '-', $tag_slug_3);
        }

       $current_day = date('j');

        switch ($sort_3) {
            
            case 'popular':
                $wp_query_args['meta_key'] = 'fave-post_views';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'review_high':
                $wp_query_args['meta_key'] = 'fave_final_score';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_posts':
                $wp_query_args['orderby'] = 'rand';
                break;
            case 'alphabetical_order':
                $wp_query_args['orderby'] = 'title';
                $wp_query_args['order'] = 'ASC';
                break;
            case 'comment_count':
                $wp_query_args['orderby'] = 'comment_count';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'random_today':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['year'] = date('Y');
                $wp_query_args['monthnum'] = date('n');
                $wp_query_args['day'] = date('j');
                break;
            case 'random_7_day':
                $wp_query_args['orderby'] = 'rand';
                $wp_query_args['date_query'] = array(
                            'column' => 'post_date_gmt',
                            'after' => '1 week ago'
                            );
                break;
        }

        if (!empty($autors_id_3)) {
            $wp_query_args['author'] = $autors_id_3;
        }

        if (!empty($featured_posts_3)) {
            
            if( $featured_posts_3 == "yes" ) {
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

        if ( !empty($offset_3) ) {
            $wp_query_args['offset'] = $offset_3 ;
        }


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
        return $found_posts - fave_data_source::$fake_loop_offset;
    }


    static function &get_wp_query ($atts = '', $paged = '') {
        $args = self::shortcode_to_args($atts, $paged);
        $fave_query = new WP_Query($args);
        return $fave_query;
    }

    static function &get_wp_query_columns ($atts = '', $columns, $paged = '' ) { 
        
        if ( $columns == 'columns_one' ) {
            $args = self::shortcode_to_args_column_one($atts, $paged);
        
        } elseif ( $columns == 'columns_two' ) {
            $args = self::shortcode_to_args_column_two($atts, $paged);
        
        } elseif ( $columns == 'columns_three' ) {
            $args = self::shortcode_to_args_column_three($atts, $paged);
        }


        $fave_query = new WP_Query($args);
        return $fave_query;
    }


}

