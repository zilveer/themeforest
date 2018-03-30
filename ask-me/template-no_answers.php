<?php /* Template Name: No answers */
get_header();
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$args = array("paged" => $paged,"post_type" => "question","orderby" => "comment_count","posts_per_page" => get_option("posts_per_page"));
	function ask_filter_where($where = '') {
		$where .= " AND comment_count = 0";
		return $where;
	}
	add_filter('posts_where', 'ask_filter_where');
	query_posts($args);
	get_template_part("loop-question");
	vpanel_pagination();
	remove_filter( 'posts_where', 'filter_where' );
get_footer();?>