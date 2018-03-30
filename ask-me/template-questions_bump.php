<?php /* Template Name: Questions bump */
get_header();
	$question_bump = vpanel_options("question_bump");
	$active_points = vpanel_options("active_points");
	if ($question_bump == 1 && $active_points == 1) {
		$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
		$args = array("paged" => $paged,"post_type" => "question","posts_per_page" => get_option("posts_per_page"),"orderby" => "meta_value_num","meta_key" => "question_points","meta_query" => array(array('type' => 'numeric',"key" => "question_points","value" => 0,"compare" => ">=")));
		function ask_filter_where($where = '') {
			$where .= " AND comment_count = 0";
			return $where;
		}
		add_filter('posts_where', 'ask_filter_where');
		query_posts($args);
	}
	if ($question_bump == 1) {
		$question_bump_template = true;
		get_template_part("loop-question");
		vpanel_pagination();
		remove_filter( 'posts_where', 'filter_where' );
	}else {
		echo "<div class='page-content page-content-user'><p class='no-item'>".__("This page is not active .","vbegy")."</p></div>";
	}
get_footer();?>