<?php

// [best_selling_products_mixed]

vc_map(array(
   "name" 			=> "Best Selling Products",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "best_selling_products_mixed",
   "class" 			=> "",
   "icon" 			=> "best_selling_products_mixed",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Number of Products",
			"param_name"	=> "per_page",
			"value"			=> "4",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Columns",
			"param_name"	=> "columns",
			"value"			=> "4",
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