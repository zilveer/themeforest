<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_posts')) :
    function tfuse_list_posts() {
        $args = array(
            'posts_per_page'  => -1,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'post_type'       => 'post',
            'post_status'     => 'publish',
            'suppress_filters' => true );
        $posts = get_posts( $args );

        $result = array();
        $result[0] = 'Select a post';
        foreach ( $posts as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_services')) :
    function tfuse_list_services() {
        $args = array(
            'posts_per_page'  => -1,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'post_type'       => 'service',
            'post_status'     => 'publish',
            'suppress_filters' => true );
        $posts = get_posts( $args );

        $result = array();
        $result[0] = 'Select a service';
        foreach ( $posts as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;