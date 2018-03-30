<?php
/*
Template Name: Matches list
*/

/**
 * Make empty page with this template 
 * and put it into menu
 * to display all Matches as streampage
 */

morning_records_storage_set('blog_filters', 'matches');

get_template_part('blog');
?>