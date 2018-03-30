<?php
global $themename;
//custom post type - weekdays
function theme_weekdays_init()
{
	global $themename;
	$labels = array(
		'name' => _x('Weekdays', 'post type general name', 'gymbase'),
		'singular_name' => _x('Day', 'post type singular name', 'gymbase'),
		'add_new' => _x('Add New', $themename . '_portfolio', 'gymbase'),
		'add_new_item' => __('Add New Day', 'gymbase'),
		'edit_item' => __('Edit Day', 'gymbase'),
		'new_item' => __('New Day', 'gymbase'),
		'all_items' => __('All Weekdays', 'gymbase'),
		'view_item' => __('View Day', 'gymbase'),
		'search_items' => __('Search Weekdays', 'gymbase'),
		'not_found' =>  __('No weekdays found', 'gymbase'),
		'not_found_in_trash' => __('No weekdays found in Trash', 'gymbase'), 
		'parent_item_colon' => '',
		'menu_name' => __("Weekdays", 'gymbase')
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
function gymbase_weekdays_edit_columns($columns)
{
	global $themename;
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => _x('Day name', 'post type singular name', 'gymbase'),   
		"date" => __('Date', 'gymbase')
	);    

	return $columns;  
}  
add_filter("manage_edit-" . $themename . "_weekdays_columns", $themename . "_weekdays_edit_columns");
?>