<?php /* Template Name: Blog 2 */
get_header();
	$vbegy_what_post      = rwmb_meta('vbegy_what_post','select',$post->ID);
	$vbegy_what_sidebar   = rwmb_meta('vbegy_what_sidebar','select',$post->ID);
	$vbegy_sidebar_all    = rwmb_meta('vbegy_sidebar','radio',$post->ID);
	$post_number          = rwmb_meta('vbegy_post_number_b','text',$post->ID);
	$post_excerpt         = rwmb_meta('vbegy_post_excerpt_b','text',$post->ID);
	$orderby_post         = rwmb_meta('vbegy_orderby_post_b','select',$post->ID);
	$post_display         = rwmb_meta('vbegy_post_display_b','select',$post->ID);
	$post_single_category = rwmb_meta('vbegy_post_single_category_b','select',$post->ID);
	$post_categories      = rwmb_meta('vbegy_post_categories_b','type=checkbox_list',$post->ID);
	$post_posts           = rwmb_meta('vbegy_post_posts_b','text',$post->ID);
	$post_number          = (isset($post_number) && $post_number != ""?$post_number:get_option("posts_per_page"));
	$post_excerpt         = (isset($post_excerpt) && $post_excerpt != ""?$post_excerpt:40);
	if ($vbegy_sidebar_all == "default") {
		$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	}else {
		$vbegy_sidebar_all = $vbegy_sidebar_all;
	}
	$taxonomy = 'category';
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	if ($post_display == "single_category") {
		$cats_post = array("post_type" => "post",'ignore_sticky_posts' => 1,"paged" => $paged,"posts_per_page" => $post_number,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $post_single_category)));
	}else if ($post_display == "multiple_categories") {
		$cats_post = array("post_type" => "post",'ignore_sticky_posts' => 1,"paged" => $paged,"posts_per_page" => $post_number,'tax_query' => array(array('taxonomy' => $taxonomy,'field' => 'id','terms' => $post_categories)));
	}else if ($post_display == "posts") {
		$post_posts = explode(",",$post_posts);
		$cats_post = array('post__in' => $post_posts,'ignore_sticky_posts' => 1,"paged" => $paged,"posts_per_page" => $post_number);
	}else {
		$cats_post = array("post_type" => "post","paged" => $paged,"posts_per_page" => $post_number);
	}
	if ($orderby_post == "popular") {
		$orderby_post = array('orderby' => 'comment_count');
	}else if ($orderby_post == "random") {
		$orderby_post = array('orderby' => 'rand');
	}else {
		$orderby_post = array();
	}
	query_posts(array_merge($orderby_post,$cats_post));
	$blog_style = "blog_2";
	get_template_part("loop");
	vpanel_pagination();
get_footer();?>