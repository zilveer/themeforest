<?php
/*
Template Name: Blog
*/

/*
* Load the correct layout based on chosen site option
*/
$layout = get_option('ka_blog_layout');
$layout = apply_filters('blog_layout',$layout); //karma theme's filter

if($layout == '' || $layout == 'right_sidebar'){

	get_template_part('page-layouts/blog-layout-right-sidebar');

} elseif($layout == 'left_sidebar') {

	get_template_part('page-layouts/blog-layout-left-sidebar');

} else {
	
	get_template_part('page-layouts/blog-layout-masonary');
}
?>