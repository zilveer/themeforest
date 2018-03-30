<?php
/*
Template Name: Players list
*/

/**
 * Make empty page with this template 
 * and put it into menu
 * to display all Players as streampage
 */

morning_records_storage_set('blog_filters', 'players');

get_template_part('blog');
?>