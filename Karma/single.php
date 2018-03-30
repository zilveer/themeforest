<?php
/*
* Loads blog post layout according to site option.
*/
$layout = get_option('ka_blog_single_layout');
$layout = apply_filters('blog_single_layout',$layout); //karma theme's filter

if($layout == '' || $layout == 'right_sidebar'){

	get_template_part('page-layouts/blog-single-layout-right-sidebar');

} elseif($layout == 'left_sidebar'){

	get_template_part('page-layouts/blog-single-layout-left-sidebar');

} else {
	
	get_template_part('page-layouts/blog-single-layout-full-width');
}
?>