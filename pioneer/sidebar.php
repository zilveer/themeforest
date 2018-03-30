<?php 


$sidebar = get_post_meta($post->ID, 'epic_sidebar', true);
$sidebar_position = get_post_meta($post->ID, 'epic_layout', true);


if(is_tax('portfoliocategory')){
	$sidebar = get_option('epic_sidebar_taxonomy_portfolio');
}
elseif(is_category() || is_tag() || is_archive() || is_search()  || is_404()){
	$sidebar = get_option('epic_sidebar_blog_pages');
}

if ( $sidebar != '' && $sidebar_position != 'sidebar_none' ){
epic_sidebar_alpha();
	 if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)){};
epic_sidebar_omega();
}
?>