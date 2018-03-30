<?php

// [from_the_blog]

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false
);

$categories = get_categories($args);

$output_categories = array();

$output_categories["All"] = "";

foreach($categories as $category) { 
	$output_categories[htmlspecialchars_decode($category->name)] = $category->slug;
}

vc_map(array(
   "name"			=> __("Posts Slider"),
   "category"		=> __('Content'),
   "description"	=> __("Display the latest posts in the blog"),
   "base"			=> "from_the_blog",
   "class"			=> "",
   "icon"			=> "from_the_blog",

   
   "params" 	=> array(
      
		array(
			"type" 			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> __("Number of Posts"),
			"param_name" 	=> "posts",
			"value" 		=> "",
			"description" 	=> __("Number of posts to be displayed in the slider.")
		),
		
		array(
			"type" 			=> "dropdown",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> __("Category"),
			"param_name" 	=> "category",
			"value" 		=> $output_categories
		),
   )
   
));