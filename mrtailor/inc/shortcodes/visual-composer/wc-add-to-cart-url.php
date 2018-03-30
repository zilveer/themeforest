<?php

// [add_to_cart_url]

vc_map(array(
   "name" 			=> __("Add to Cart URL"),
   "category" 		=> __('WooCommerce'),
   "description"	=> __("Description"),
   "base" 			=> "add_to_cart_url",
   "class" 			=> "",
   "icon" 			=> "add_to_cart_url",
   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("ID"),
			"param_name"	=> "id",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("SKU"),
			"param_name"	=> "sku",
			"value"			=> "",
		),

   )
   
));