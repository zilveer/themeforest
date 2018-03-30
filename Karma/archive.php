<?php
/*
* Loads archive layout according to site option.
*/
$layout = get_option('ka_blog_layout');
$layout = apply_filters('blog_layout',$layout); //karma theme's filter

if($layout == '' || $layout == 'right_sidebar'){

	get_template_part('page-layouts/archive-layout-left-or-right-sidebar');

} elseif($layout == 'left_sidebar'){

	get_template_part('page-layouts/archive-layout-left-or-right-sidebar');

} else{
	
	get_template_part('page-layouts/archive-layout-masonary');
}
?>