<?php
//Get tag page layout setting
$pp_blog_tag_layout = get_option('pp_blog_tag_layout');
if(empty($pp_blog_tag_layout))
{
	$pp_blog_tag_layout = 'blog_r';
}

$located = locate_template($pp_blog_tag_layout.'.php');
if (!empty($located))
{
	get_template_part($pp_blog_tag_layout);
}
else
{
	echo 'Error can\'t find page template you selected';
}
?>