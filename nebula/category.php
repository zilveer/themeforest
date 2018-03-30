<?php
//Get category page layout setting
$pp_blog_category_layout = get_option('pp_blog_category_layout');
if(empty($pp_blog_category_layout))
{
	$pp_blog_category_layout = 'blog_r';
}

$located = locate_template($pp_blog_category_layout.'.php');
if (!empty($located))
{
	get_template_part($pp_blog_category_layout);
}
else
{
	echo 'Error can\'t find page template you selected';
}
?>