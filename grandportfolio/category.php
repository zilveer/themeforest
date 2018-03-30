<?php
//Get category page layout setting
$tg_blog_category_layout = kirki_get_option('tg_blog_category_layout');

$located = locate_template($tg_blog_category_layout.'.php');

if (!empty($located))
{
	get_template_part($tg_blog_category_layout);
}
else
{
	get_template_part('blog_r');
}

?>