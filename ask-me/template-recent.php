<?php /* Template Name: Recent question  */
get_header();
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$args = array("paged" => $paged,"post_type" => "question","posts_per_page" => get_option("posts_per_page"));
	query_posts($args);
	get_template_part("loop-question");
	vpanel_pagination();
get_footer();?>