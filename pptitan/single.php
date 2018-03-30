<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/

$current_page_id = $post->ID;

if($post->post_type=='attachment')
{
	get_template_part("single-attachment");
	exit;
}

if($post_type == 'gallery')
{
	get_template_part("single-gallery");
	exit;
}
elseif($post_type == 'portfolios')
{
	get_template_part("single-portfolio");
	exit;
}
else
{
	$pp_blog_single_layout = get_option('pp_blog_single_layout');
	
	if($pp_blog_single_layout=='page_sidebar')
	{
		get_template_part("single-post-r");
		exit;
	}
	else
	{
		get_template_part("single-post-f");
		exit;
	}
}
?>