<?php
if(get_query_var('page')){
  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
}else{
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
}
$args = array( 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'post_status' => 'publish', 'category__in' => get_field('show_only_these_categories') );
$osetin_query = new WP_Query( $args );