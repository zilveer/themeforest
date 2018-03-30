<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Function to generate the custom WP_Query
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @version     5.0
 * @package     artbees
 */

if (!function_exists('mk_wp_query')) {
    function mk_wp_query($atts) {
        
        extract($atts);
        
        $count = isset($count) ? $count : 10;

        $query = array(
            'post_type' => $post_type,
            'posts_per_page' => (int)$count,
            'suppress_filters' => 0,
        );
        
        if ($post_type == 'attachment') {
            $query['post_mime_type'] = 'image';
            $query['post_status'] = 'inherit';
        }

        if (isset($post_status) && !empty($post_status) && $post_type != 'attachment') {
            $query['post_status'] = $post_status;
        }
        
        if (isset($cat) && !empty($cat) && $post_type == 'post') {
            $query['cat'] = $cat;
        }
        if (isset($category_name) && !empty($category_name) && $post_type == 'post') {
            $query['category_name'] = $category_name;
        }
        
        if (isset($categories) && !empty($categories) && $post_type != 'post') {
            $query['tax_query'] = array(
                array(
                    'taxonomy' => $post_type . '_category',
                    'field' => 'slug',
                    'terms' => explode(',', $categories)
                )
            );
        }


        // Adds exclude option for blog loops post format
        if(!empty($exclude_post_format)) {
            $query['meta_query'] = array(
                array(
                    'key' => '_single_post_type',
                    'value' => explode(',',$exclude_post_format),
                    'compare' => 'NOT IN'
                ) ,
            );
        }
        
        if (isset($author) && !empty($author)) {
            $query['author'] = $author;
        }
         if (isset($author_name) && !empty($author_name)) {
            $query['author_name'] = $author_name;
        }
        if (isset($posts) && !empty($posts)) {
            $query['post__in'] = explode(',', $posts);
        }
        if (isset($orderby) && !empty($orderby)) {
            $query['orderby'] = $orderby;
        }
        if (isset($order) && !empty($order)) {
            $query['order'] = $order;
        }

        if (isset($year) && !empty($year)) {
            $query['year'] = $year;
        }

        if (isset($monthnum) && !empty($monthnum)) {
            $query['monthnum'] = $monthnum;
        }

        if (isset($m) && !empty($m)) {
            $query['m'] = $m;
        }

        if (isset($second) && !empty($second)) {
            $query['second'] = $second;
        }

        if (isset($minute) && !empty($minute)) {
            $query['minute'] = $minute;
        }

        if (isset($hour) && !empty($hour)) {
            $query['hour'] = $hour;
        }

        if (isset($w) && !empty($w)) {
            $query['w'] = $w;
        }

        if (isset($day) && !empty($day)) {
            $query['day'] = $day;
        }

        if (isset($tag) && !empty($tag)) {
            $query['tag'] = $tag;
        }

        if(isset($paged) && !empty($paged)) {
            $query['paged'] = $paged;    
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
            $query['paged'] = $paged;
        }

        if ($paged == 1) {
            if (isset($offset) && !empty($offset)) {
                $query['offset'] = $offset;
            }
        } 
        else {
            if (isset($offset) && !empty($offset)) {
                $offset = $offset + (($paged - 1) * $count);
                $query['offset'] = $offset;
            }
        }

        return array(
            'wp_query' => new WP_Query($query) ,
            'paged' => $paged
        );
    }
}
