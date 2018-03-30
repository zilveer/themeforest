<?php

// [add_to_cart_url]

vc_map(array(
   "name" 			=> "Add to Cart URL",
   "category" 		=> 'WooCommerce',
   "description"	=> "Description",
   "base" 			=> "add_to_cart_url",
   "class" 			=> "",
   "icon" 			=> "add_to_cart_url",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "ID",
			"param_name"	=> "id",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "SKU",
			"param_name"	=> "sku",
		),

   )
   
));