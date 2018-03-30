<?php
/**
 * Template Name: One column page
*/

get_header();
st_before_content($columns='');
get_template_part( 'loop', 'page' );
st_after_content();
get_footer();
?>
