<?php

// [product_categories_grid]

vc_map(array(
   "name"			=> "Product Categories - Grid",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "product_categories_grid",
   "class"			=> "",
   "icon"			=> "product_categories_grid",
   //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
   //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "How many product categories to display?",
			"param_name"	=> "number",
			"admin_label" 	=> true
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "Order By",
			"param_name"	=> "orderby",
			"value"			=> array(
				"None"			=> "none",
				"ID"			=> "id",
				"Name"			=> "name",
				"Date"			=> "date",
				"Menu Order"	=> "menu_order",
				"Rand"			=> "rand"
			),
			"admin_label" 	=> true
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "Order",
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
			),
			"admin_label" 	=> true
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "Hide Empty",
			"param_name"	=> "hide_empty",
			"value"			=> array(
				"Yes"	=> "1",
				"No"	=> "0"
			),
			"admin_label" 	=> true
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "Parent",
			"description"	=> "Set the parent paramater to 0 to only display top level categories.",
			"param_name"	=> "parent",
			"value"			=> "",
			"admin_label" 	=> true
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class"			=> "hide_in_vc_editor",
			"heading"		=> "IDs",
			"description"	=> "Set ids to a comma separated list of category ids to only show those.",
			"param_name"	=> "ids",
			"value"			=> "",
			"admin_label" 	=> true
		),
   )
   
));