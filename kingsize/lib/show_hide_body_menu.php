<?php
/**
 * @KingSize 2012
 * Show Hide Body Menu 
 **/
?>
<?php
global $post;

$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
$postID = url_to_postid($url[0]);

#########   Making conditional to hide the body content on page load ######### 
if(get_post_meta($post->ID , 'page_hide_content', true ) == 1 || get_post_meta($post->ID , 'post_hide_content', true ) == 1 || get_post_meta($post->ID , 'kingsize_portfolio_hide_content', true ) == 1) {
	add_filter('body_class','kingsize_body_content_hide');
}
function kingsize_body_content_hide($classes) {
	$classes[] = 'body_hiding_content body_show_content';
	return $classes;
}

//removing the body control
if(get_post_meta($post->ID , 'page_hide_content', true ) == 2 || get_post_meta($post->ID , 'post_hide_content', true ) == 2 || get_post_meta($post->ID , 'kingsize_portfolio_hide_content', true ) == 2) {
	add_filter('body_class','kingsize_body_content_remove');
}
function kingsize_body_content_remove($classes) {
	$classes[] = 'body_hiding_content';
	return $classes;
}

#########  Making conditional to hide the menu on page load ######### 
if(get_post_meta($post->ID , 'page_hide_menu', true ) == 1 || get_post_meta($post->ID , 'post_hide_menu', true ) == 1 || get_post_meta($post->ID , 'kingsize_portfolio_hide_menu', true ) == 1) {
	if(!is_home())
	{
	  add_filter('body_class','kingsize_body_menu_hide');
	}
}
function kingsize_body_menu_hide($classes) {
	$classes[] = 'body_hiding_menu';
	return $classes;
}
?>