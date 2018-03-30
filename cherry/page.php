<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 */
// You can override via functions.php conditionals or define:
// $columns = 'four';

get_header();

//Retrieve and verify sidebars 
$pages_sidebar = rwmb_meta('gg_secondary-widget-area');
$sidebar_list = of_get_option('sidebar_list');
if ($sidebar_list) : $pages_sidebar_exists = in_array_r($pages_sidebar, $sidebar_list); else : $pages_sidebar_exists = false; endif;

st_before_content($columns='');
get_template_part( 'loop', 'page' );
st_after_content();
get_sidebar("page");
get_footer();
?>