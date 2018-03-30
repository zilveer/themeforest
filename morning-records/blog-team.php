<?php
/*
Template Name: Team members list
*/

/**
 * Make empty page with this template 
 * and put it into menu
 * to display all Team members as streampage
 */

morning_records_storage_set('blog_filters', 'team');

get_template_part('blog');
?>