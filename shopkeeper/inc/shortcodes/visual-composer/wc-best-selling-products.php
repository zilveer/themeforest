<?php

// [best_selling_products]

vc_map(array(
   "name" 			=> "Best Selling Products",
   "category" 		=> 'WooCommerce',
   "description"	=> "",
   "base" 			=> "best_selling_products",
   "class" 			=> "",
   "icon" 			=> "best_selling_products",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Number of Products",
			"param_name"	=> "per_page",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Columns",
			"param_name"	=> "columns",
		),
   )
   
));