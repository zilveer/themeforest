<?php

// [blog_posts]

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
   "name"			=> __("Blog Posts"),
   "category"		=> __('Content'),
   "description"	=> __("Display the latest posts in the blog"),
   "base"			=> "blog_posts_mixed",
   "class"			=> "",
   "icon"			=> "blog_posts_mixed",

   
   "params" 	=> array(
      
		array(
			"type" 			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> __("Number of Posts"),
			"param_name" 	=> "posts",
			"value" 		=> "9",
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
       
        array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Layout Style",
			"param_name"	=> "layout",
			"value"			=> array(
				"Listing"	=> "listing",
				"Slider"	=> "slider"
			),
		),
   )
   
));