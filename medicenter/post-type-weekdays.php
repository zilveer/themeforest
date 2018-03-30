<?php
global $themename;
//custom post type - weekdays
function theme_weekdays_init()
{
	global $themename;
	$labels = array(
		'name' => _x('Weekdays', 'post type general name', 'medicenter'),
		'singular_name' => _x('Day', 'post type singular name', 'medicenter'),
		'add_new' => _x('Add New', $themename . '_weekdays', 'medicenter'),
		'add_new_item' => __('Add New Day', 'medicenter'),
		'edit_item' => __('Edit Day', 'medicenter'),
		'new_item' => __('New Day', 'medicenter'),
		'all_items' => __('All Weekdays', 'medicenter'),
		'view_item' => __('View Day', 'medicenter'),
		'search_items' => __('Search Weekdays', 'medicenter'),
		'not_found' =>  __('No weekdays found', 'medicenter'),
		'not_found_in_trash' => __('No weekdays found in Trash', 'medicenter'), 
		'parent_item_colon' => '',
		'menu_name' => __("Weekdays", 'medicenter')
	);
	$args = array(  
		"labels" => $labels, 
		"public" => true,  
		"show_ui" => true,  
		"capability_type" => "post",  
		"menu_position" => 20,
		"hierarchical" => false,  
		"rewrite" => true,  
		"supports" => array("title", "page-attributes")
	);
	register_post_type($themename . "_weekdays", $args);
}  
add_action("init", "theme_weekdays_init"); 

//custom weekdays items list
function medicenter_weekdays_edit_columns($columns)
{
	global $themename;
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => _x('Day name', 'post type singular name', 'medicenter'),   
		"date" => __('Date', 'medicenter')
	);    

	return $columns;  
}  
add_filter("manage_edit-" . $themename . "_weekdays_columns", $themename . "_weekdays_edit_columns");
?>