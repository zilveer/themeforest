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
   "name"			=> "Blog Posts Slider",
   "category"		=> 'Content',
   "description"	=> "Place a Blog Posts Slider",
   "base"			=> "from_the_blog",
   "class"			=> "",
   "icon"			=> "from_the_blog",

   
   "params" 	=> array(
      
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Title",
			"param_name" => "title",
			"value" => "From The Blog"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Posts",
			"param_name" => "posts",
			"value" => 6
		),
		
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Category",
			"param_name" => "category",
			"value" => $output_categories
		),
   )
   
));