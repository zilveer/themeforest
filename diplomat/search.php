<?php
if (!defined('ABSPATH')) exit();

get_header();

if (TMM::get_option('menu_advanced_search')||TMM::get_option('widget_advanced_search')) {
    global $wp_query;
    
    $wp_query->posts = TMM_Advanced_Search::advanced_search();
    $wp_query->found_posts = count(TMM_Advanced_Search::advanced_search());
    $wp_query->post_count = $wp_query->query_vars['posts_per_page'];
    if (count(TMM_Advanced_Search::advanced_search())<$wp_query->query_vars['posts_per_page']){
        $wp_query->post_count = count(TMM_Advanced_Search::advanced_search());
    }
     
    $wp_query->max_num_pages = ceil($wp_query->found_posts / $wp_query->query_vars['posts_per_page']);   
}

get_template_part('content', null);

get_footer(); 
