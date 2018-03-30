<?php
class fave_video_post_type_data_source {

    static $fake_loop_offset = 0;


    static function shortcode_to_args($atts = '', $paged = '') {
        extract(shortcode_atts(
                array(
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

        //init the array
        $wp_query_args = array(
            'ignore_sticky_posts' => 1
        );

        if (!empty($category_id)) {
            
            $wp_query_args['tax_query'] = array(
                                array(
                                'taxonomy' => 'video-categories',
                                'field' => 'term_id',
                                'terms' => $category_id,
                                )
                            );
        }

       $current_day = date('j');

        switch ($sort) {
            
            case 'popular':
                $wp_query_args['meta_key'] = 'fave-post_views';
                $wp_query_args['orderby'] = 'meta_value_num';
                $wp_query_args['order'] = 'DESC';
                break;
            case 'review_high':
                $wp_query_args['meta_key'] = '';
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
                $wp_query_args['meta_key'] = 'fave_video_featured';
                $wp_query_args['meta_value'] = '1';
            } else {
                $wp_query_args['meta_key'] = 'fave_video_featured';
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

        $wp_query_args['post_type'] = 'video';


        return $wp_query_args;
    }

    
    static function metabox_to_args($loop_filter, $paged = '') {


        $wp_query_args = self::shortcode_to_args($loop_filter, $paged);


        $wp_query_args['ignore_sticky_posts'] = 0;

        if (isset($wp_query_args['offset']) and $wp_query_args['offset'] > 0) {
            add_filter('found_posts', array(__CLASS__, 'hook_fix_offset_pagination'), 1, 2 );
        }


        return $wp_query_args;
    }

    
    static function hook_fix_offset_pagination($found_posts, $query) {
        remove_filter('found_posts','hook_fix_offset_pagination');
        return $found_posts - fave_data_source::$fake_loop_offset;
    }


    static function &get_wp_query ($atts = '', $paged = '') {
        $args = self::shortcode_to_args($atts, $paged);
        $fave_query = new WP_Query($args);
        return $fave_query;
    }


}

