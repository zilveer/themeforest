<?php /* Template name: Follow post */
global $user_ID;
if(empty($_GET['u'])){
	wp_redirect(home_url());
}
$user_login = get_userdata($_GET['u']);
if(empty($user_login)){
	wp_redirect(home_url());
}
$owner = false;
if($user_ID == $user_login->ID){
	$owner = true;
}
$show_point_favorite = get_user_meta($user_login->ID,"show_point_favorite",true);
if($show_point_favorite != 1 && $owner == false){
	wp_redirect(home_url());
}
get_header();
	include (get_template_directory() . '/includes/author-head.php');
	$vbegy_sidebar_all     = rwmb_meta('vbegy_sidebar','radio',$post->ID);
	if ($vbegy_sidebar_all == "default") {
		$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	}else {
		$vbegy_sidebar_all = $vbegy_sidebar_all;
	}
	$blog_style = vpanel_options("home_display");
	$following_me = get_user_meta($user_login->ID,"following_me");
	$following_me_array = $following_me[0];
	if (is_array($following_me_array)) {
		$following_me_array = array_filter($following_me_array);
	}
	if (isset($following_me_array) && is_array($following_me_array) && !empty($following_me_array)) {
		$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
		$args = array('post_type' => 'post','paged' => $paged,'author__in' => $following_me_array,'ignore_sticky_posts' => 1);
		query_posts($args);
		get_template_part("loop");
		vpanel_pagination();
	}else {
		echo "<div class='page-content page-content-user'><p class='no-item'>".__("There are no user follow yet .","vbegy")."</p></div>";
	}
get_footer();?>