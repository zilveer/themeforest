<?php /* Template Name: Most visit */
get_header();
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$args = array("paged" => $paged,"posts_per_page" => get_option("posts_per_page"),"post_type" => "question","orderby" => "meta_value_num","meta_key" => "post_stats","meta_query" => array(array('type' => 'numeric',"key" => "post_stats","value" => 0,"compare" => ">=")));
	query_posts($args);
	get_template_part("loop-question");
	vpanel_pagination();
get_footer();?>