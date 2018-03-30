<?php 
$blogsidebar = get_post_meta($post->ID, 'epic_blogmodule_sidebar', true);
$blogsidebar_position = get_post_meta($post->ID, 'epic_blogmodule_layout', true);


if ( $blogsidebar != '' && $blogsidebar_position != 'sidebar_none' ){
echo '<aside id="sidebar-blog" class="sidebar">';
	 dynamic_sidebar($blogsidebar);
echo '</aside>';
}
?>