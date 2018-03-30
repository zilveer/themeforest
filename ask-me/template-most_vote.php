<?php /* Template Name: Most vote */
get_header();
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$args = array("paged" => $paged,"post_type" => "question","orderby" => "meta_value","meta_key" => "question_vote","posts_per_page" => get_option("posts_per_page"),"meta_query" => array(array('type' => 'numeric',"key" => "question_vote","value" => 0,"compare" => ">")));
	query_posts($args);
	get_template_part("loop-question");
	vpanel_pagination();
get_footer();?>