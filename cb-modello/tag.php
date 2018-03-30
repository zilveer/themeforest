<?php get_header(); 
$cbtheme=new cbtheme();
$cbtheme->page_header($show_title='yes',$type='tag');
$cbtheme->show_content('yes','search');
$cbtheme->page_footer();
get_footer(); ?>