<?php

/*
 * Blog template. we have to fetch our desired category and then include the category file
 */

$wp_query_tmp = $wp_query;

$f = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'paged' => $paged
);
if(isset($wp_query->query_vars['cat']))
{
    $f['cat'] = $wp_query->query_vars['cat'];
}
$wp_query = new WP_Query($f);

include 'category.php';

?>
