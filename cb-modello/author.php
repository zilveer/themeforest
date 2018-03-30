<?php get_header(); 
$cbtheme=new cbtheme();
$cbtheme->page_header($show_title='yes',$type='author');
$cbtheme->show_content();
$cbtheme->page_footer();
get_footer(); ?>