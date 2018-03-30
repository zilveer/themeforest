<?php

// [portfolio]

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
	'taxonomy'                 => 'portfolio_categories',
	'pad_counts'               => false
);

$categories = get_categories($args);

$output_categories = array();

$output_categories["All"] = "";

foreach($categories as $category) { 
	$output_categories[htmlspecialchars_decode($category->name)] = $category->slug;
}

vc_map(array(
   "name"			=> "Portfolio",
   "category"		=> 'Content',
   "description"	=> "Place Portfolio",
   "base"			=> "portfolio",
   "class"			=> "",
   "icon"			=> "portfolio",

   
   "params" 	=> array(
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "How many portfolio items would you like to show?",
			"param_name"	=> "items",
		),
		
		array(
			"type" 			=> "dropdown",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Portfolio Category",
			"param_name" 	=> "category",
			"value" 		=> $output_categories
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Show Filters?",
			"param_name"	=> "show_filters",
			"value"			=> array(
				"Yes"	=> "yes",
				"No"	=> "no"
			),
			"dependency" 	=> Array('element' => "category", 'value' => array(''))
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order by",
			"param_name"	=> "order_by",
			"value"			=> array(
				"Date"			=> "date",
				"Alphabetical"	=> "alphabetical"
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Order",
			"param_name"	=> "order",
			"value"			=> array(
				"Descending"	=> "desc",
				"Ascending"	=> "asc"
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Grid Layout Styles",
			"param_name"	=> "grid",
			"value"			=> array(
				"Default - Equal Boxes"		=> "default",
				"Masonry Style - V1"		=> "grid1",
				"Masonry Style - V2"		=> "grid2",
				"Masonry Style - V3"		=> "grid3"
			),
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Items per Row",
			"param_name"	=> "portfolio_items_per_row",
			"value"			=> array(
				"3"	=> "3",
				"4"	=> "4",
				"5"	=> "5"
			),
			"dependency" 	=> Array('element' => "grid", 'value' => array('default'))
		),
   )
   
));