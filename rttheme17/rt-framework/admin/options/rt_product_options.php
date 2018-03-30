<?php

$options = array (

			array(
			"name"    => __("Info",'rt_theme_admin'),
			"desc"    => __('If you would like to have more control on how to display your products, customize "<a href="admin.php?page=rt_template_options">Default Product Template</a>" or create a new one according your preferences. To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Create Product Showcase" steps.','rt_theme_admin'),
			"type"    => "info"),

			array(
					"name" => __("LISTING OPTIONS - PRODUCT CATEGORIES",'rt_theme_admin'), 
					"type" => "heading"),					 
			
			array(
					"name" => __("Layout",'rt_theme_admin'),
					"desc" => __("Select the layout of products list pages. i.e., box width for each product.",'rt_theme_admin'),
					"id" => THEMESLUG."_product_layout",
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
					"id" 	=> THEMESLUG."_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "9",
					"hr"		=> true,
					"type" 	=> "rangeinput"
				),
	 
			array(
					"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
					"desc" 	=> __("sort the products by this parameter",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_list_orderby",
					"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
					"default"	=> "date",
					"hr"		=> true,
					"type" 	=> "select"
				),
	
			array(
					"name" 	=> __("Order",'rt_theme_admin'),
					"desc" 	=> __("Designates the ascending or descending order of the ORDERBY parameter",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_list_order",
					"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
					"default"	=> "DESC", 
					"type" 	=> "select"
				), 

			array(
					"name" => __("PRODUCT IMAGES - LISTING",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name" 	=> __("Crop Product Images",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_image_crop",
					"default" => "on",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),
			
			array(
				   "name" 	=> __("Maximum Image Height",'rt_theme_admin'),
				   "id" 		=> THEMESLUG."_product_image_height",
				   "desc"		=> __('You can use this option if the "Crop Product Images" feature is on','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"400",
				   "default"	=>"240",
				   "type" 	=> "rangeinput"
				),

			array(
					"name" => __("PRODUCT IMAGES - SINGLE PRODUCT PAGE",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name" 	=> __("Crop Product Images in the Slider",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_single_product_image_crop",
					"default" => "on",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),

			array(
				   "name" 	=> __("Maximum Image Width for the slider",'rt_theme_admin'),
				   "id" 		=> THEMESLUG."_single_product_image_width",
				   "desc"		=> __('Set a maximum width value for the images in the single product page thumbnail slider.','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"500",
				   "default"	=>"220",
				   "type" 	=> "rangeinput"
				),
			
			array(
				   "name" 	=> __("Maximum Image Height for the slider",'rt_theme_admin'),
				   "id" 		=> THEMESLUG."_single_product_image_height",
				   "desc"		=> __('You can use this option if the "Crop Product Images in the Slider" feature is on','rt_theme_admin'),
				   "min"		=>"120",
				   "max"		=>"400",
				   "default"	=>"160",
				   "type" 	=> "rangeinput"
				),

			array(
					"name" => __("PRODUCT NAVIGATION",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Hide Previous / Next post navigation from single product items",'rt_theme_admin'),
					"id"      => THEMESLUG."_hide_product_navigation",
					"default" => "on",
					"type"    => "checkbox"
				),

			array(
					"name" 	=> __("RELATED PRODUCTS",'rt_theme_admin'), 
					"type" 	=> "heading"
				),

			array(
					"name" => __("Related Products Layout",'rt_theme_admin'),
					"desc" => __("Select the layout of related products on single product pages.",'rt_theme_admin'),
					"id" => THEMESLUG."_related_product_layout",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ), 				
					"default" => "4", 
					"type" => "select"),
								
			array(
					"name" 	=> __("PERMALINKS",'rt_theme_admin'), 
					"type" 	=> "heading"
				),

			array(
					"name" 	=> __("Category Slug",'rt_theme_admin'),
					"desc" 	=> __("Change the slug for product categories",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_category_slug",
					"default"	=> "products",
					"help" 	=> "true",
					"type" 	=> "text",
					"hr" 	=> "true"
				),

			array(
					"name" 	=> __("Single Product Slug",'rt_theme_admin'),
					"desc" 	=> __("IMPORTANT! Bring your cursor over the help icon to read the detailed instructions ",'rt_theme_admin'),
					"id" 	=> THEMESLUG."_product_single_slug",
					"help" 	=> "true",
					"default"	=> "product",
					"type" 	=> "text"
				),

			array(
					"name" => __("SIDEBAR OPTIONS",'rt_theme_admin'), 
					"type" => "heading"),
			
			array(
					"name" => __("Default Sidebar Position for Product Showcase",'rt_theme_admin'),
					"desc" => __("Select a default sidebar position for product showcase related contents.",'rt_theme_admin'),
					"id" => THEMESLUG."_sidebar_position_product",
					"select" => __("Select",'rt_theme_admin'),
					"options" =>  array(
									"right" => 	"Content + Right Sidebar", 
									"left"  => 	"Content + Left Sidebar",
									"full"  => 	"Full Width - No Sidebar",
								),
					"default"	=> "right",
					"hr"		=> true,
					"type" => "select"),				

		); 
?>