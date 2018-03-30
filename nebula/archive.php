<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

//Check if portfolio post type then go to another template
$post_type = get_post_type();

if($post_type == 'portfolios')
{
	$pp_set_page_template = get_option('pp_set_page_template');
	if(empty($pp_set_page_template))
	{
		$pp_set_page_template = 3;
	}
	
	if(file_exists(get_template_directory() . "/portfolio-".$pp_set_page_template.".php"))
	{
		get_template_part("portfolio-".$pp_set_page_template);
	}
	else
	{
		get_template_part("portfolio-3");
	}
	exit;
}
else if($post_type == 'galleries')
{
	get_template_part("galleries");
	exit;
}
else
{
	//Get archive page layout setting
	$pp_blog_archive_layout = get_option('pp_blog_archive_layout');
	if(empty($pp_blog_archive_layout))
	{
		$pp_blog_archive_layout = 'blog_r';
	}
	
	$located = locate_template($pp_blog_archive_layout.'.php');
	if (!empty($located))
	{
		get_template_part($pp_blog_archive_layout);
	}
	else
	{
		echo 'Error can\'t find page template you selected';
	}
}
?>