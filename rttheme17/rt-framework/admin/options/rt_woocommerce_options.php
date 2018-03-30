<?php

$options = array (

			array(
			"name"    => __("Info",'rt_theme_admin'),
			"desc"    => __('Use these options to change display of your WooCommerce products. Head over to <a href="admin.php?page=woocommerce">WooCommerce Settings</a> to change the plugin settins. To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Create WooCommerce Shop" steps.','rt_theme_admin'),
			"type"    => "info"),

			array(
					"name" => __("LISTING OPTIONS - PRODUCT CATEGORIES",'rt_theme_admin'), 
					"type" => "heading"),					 
			
			array(
					"name" => __("Layout",'rt_theme_admin'),
					"desc" => __("Select the layout of products list pages. i.e., box width for each product.",'rt_theme_admin'),
					"id" => THEMESLUG."_woo_product_layout",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ),
					"hr"		=> true,					
					"default" => "3", 
					"type" => "select"),
			
			array(
					"name" 	=> __("Amount of products per page",'rt_theme_admin'),
					"desc"	=> __("How many products do you want to display per page?",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_woo_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "9", 
					"type" 	=> "rangeinput"
				), 
			array(
					"name" => __("PRODUCT IMAGES",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name" 	=> __("Crop Product Images",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_woo_product_image_crop",
					"default" => "on",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),
			
			array(
				   "name" 	=> __("Maximum Image Height",'rt_theme_admin'),
				   "id" 		=> THEMESLUG."_woo_product_image_height",
				   "desc"		=> __('You can use this option if the "Crop Product Images" feature is on','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"400",
				   "default"	=>"240",
				   "type" 	=> "rangeinput"
				),

			array(
					"name" => __("RELATED PRODUCTS",'rt_theme_admin'), 
					"type" => "heading"
				),
			  

			array(
					"name" 	=> __("Amount of related products on single product page",'rt_theme_admin'),
					"desc"	=> __("How many related products do you want to display on single product page?",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_woo_related_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "3", 
					"type" 	=> "rangeinput"
				), 
 
								
			array(
					"name" 	=> __("CART & USER LINKS",'rt_theme_admin'), 
					"type" 	=> "heading"
				), 

					array(
					"name"      => __("Hide Cart & User Links",'rt_theme_admin'),
					"desc"      => __("Turn On this option to remove the shopping cart, my account, login/logout links from top of the page",'rt_theme_admin'),				
					"id"        => THEMESLUG."_hide_woo_cart", 
					"type"      => "checkbox",
					"hr"		=> true,
				), 
  		); 
?>