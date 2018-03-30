<?php

$options = array (

			array(
					"name"    => __("Info",'rt_theme_admin'),
					"desc"    => __('Use the settings below to change the behaviour of your WooCommerce product (listing) pages. Use the <a href="admin.php?page=woocommerce">WooCommerce Settings</a> to alter the plugin settings. Want to learn more? then go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read the "How To Create a WooCommerce Shop" steps.','rt_theme_admin'),
					"type"    => "info"),

			array(
					"name" => __("LISTING OPTIONS - PRODUCT CATEGORIES",'rt_theme_admin'), 
					"type" => "heading"),					 
			
			array(
					"name" => __("Layout",'rt_theme_admin'),
					"desc"    => __("Select and set a default column layout for the woocommerce product listing pages.",'rt_theme_admin'),					
					"id" => RT_THEMESLUG."_woo_product_layout",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ),				
					"default" => "3", 
					"type" => "select"),
			
			array(
					"name" 	=> __("Amount of products to show per page",'rt_theme_admin'),
					"desc"    => __("In here you can set the amount of product items to show on the woo commerce pages before pagination kicks in. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the value or you can directly input the amount into the text field.",'rt_theme_admin'),					
					"id" 	=> RT_THEMESLUG."_woo_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "9", 
					"type" 	=> "rangeinput",	
				), 


			array(
					"name" => __("ADD TO CART BUTTONS",'rt_theme_admin'), 
					"type" => "heading"),					 

			array(
					"name" 	=> __("Hide embedded add to cart button from images",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) the embedded add to cart button will not be visible on the product images and the image will be linked to the details page instead.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_hide_embedded_cart_button",
					"default" => "",
					"type" 	=> "checkbox2"
				),

			array(
					"name" 	=> __("Hide add to cart button under the product info",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) the add to cart button where under the product title and price will not be visible','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_hide_default_cart_button",
					"default" => "on",
					"hr"		=> true,
					"type" 	=> "checkbox2"
				),

			array(
					"name" => __("CROPPING PRODUCT IMAGES",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name" 	=> __("Enable Cropping for WooCommerce Product Images.",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) Woocommerce Product Images will be cropped following the height setting below.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_woo_product_image_crop",
					"default" => "on",
					"hr"		=> true,
					"type" 	=> "checkbox2"
				),
			
			array(
				   "name" 	=> __("Maximum Image Height",'rt_theme_admin'),
				   "desc"		=> __('<strong>Maximum Image Height (px)</strong> : Set the maximum height in pixels for the product images. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the height value or you can directly input the height value into the text field.<br /><br /><strong>Note</strong> : The &#39;Cropping for Woocommerce Product Images&#39; must be enabled to use this option.','rt_theme_admin'),
				   "id" 		=> RT_THEMESLUG."_woo_product_image_height",
				   "min"		=>"60",
				   "max"		=>"800",
				   "default"	=>"240",
				   "type" 	=> "rangeinput"
				),

			array(
					"name" => __("RELATED PRODUCTS",'rt_theme_admin'), 
					"type" => "heading"
				),

			array(
					"name" => __("Column Layout Related Products",'rt_theme_admin'),
					"desc"    => __("Select and set a default column layout for the woocommerce related products.",'rt_theme_admin'),
					"id" => RT_THEMESLUG."_woo_related_products_layout",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ),				
					"default" => "3", 
					"type" => "select"
				),
			
			array(
					"name"	=> __("Amount of max related products on single product page",'rt_theme_admin'),
					"desc"	=> __('<strong>Maximum Number of Related Products to show.</strong> : Set the maximum number for the related woocommerce products to show in a single woocommerce product page. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the amount of products to show or you can directly input the value for the amount of products to show into the text field.','rt_theme_admin'),
					"id"	=> RT_THEMESLUG."_woo_related_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "3", 
					"type"	=> "rangeinput"
				), 
								
			array(
					"name" 	=> __("TOP PAGE CART & USER LINKS",'rt_theme_admin'), 
					"type" 	=> "heading"
				), 

			array(
					"name"	=> __("Hide Cart & User Links",'rt_theme_admin'),
					"desc"	=> __("Enable (checked) this option to remove the shopping cart, my account, login/logout links from top of the page.",'rt_theme_admin'),				
					"id"	=> RT_THEMESLUG."_hide_woo_cart", 
					"type"	=> "checkbox2",
					"hr"	=> true,
				), 
  		); 
?>