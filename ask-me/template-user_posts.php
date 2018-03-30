<?php /* Template name: User Posts */
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
get_header();
	$vbegy_sidebar_all     = rwmb_meta('vbegy_sidebar','radio',$post->ID);
	if ($vbegy_sidebar_all == "default") {
		$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	}else {
		$vbegy_sidebar_all = $vbegy_sidebar_all;
	}
	$blog_style = vpanel_options("home_display");
	include (get_template_directory() . '/includes/author-head.php');
	$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	wp_reset_query();
	$args = array('post_type' => 'post','paged' => $paged,'author' => $user_login->ID);
	query_posts($args);
	get_template_part("loop");
	vpanel_pagination();
get_footer();?>