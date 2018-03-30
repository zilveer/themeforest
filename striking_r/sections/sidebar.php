<?php
if(!function_exists('theme_section_sidebar')){
/**
 * The default template for displaying sidebar in the pages
 */
function theme_section_sidebar(){
	return sidebar_generator('get_sidebar',theme_get_queried_object_id());
}
}