<?php
/*
** single.php
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/

get_header();

Mk_Static_Files::addAssets('mk_blog');

$blog_style = 'blog-style-'.mk_get_blog_single_style();
$blog_type = 'blog-post-type-'.mk_get_blog_single_type();
$holder_class = $blog_type . ' ' .$blog_style;

mk_build_main_wrapper( mk_get_view('singular', 'wp-single', true), false,  $holder_class);


get_footer();

