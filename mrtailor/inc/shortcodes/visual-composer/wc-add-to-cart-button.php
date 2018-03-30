<?php

// [add_to_cart]

vc_map(array(
   "name"			=> "Add to Cart Button",
   "category"		=> 'WooCommerce',
   "description"	=> "",
   "base"			=> "add_to_cart",
   "class"			=> "",
   "icon"			=> "add_to_cart",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "ID",
			"param_name"	=> "id",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "SKU",
			"param_name"	=> "sku",
			"value"			=> "",
		),

   )
   
));