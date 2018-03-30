<?php

$options = array (

			array(
			"name"    => __("Info",'rt_theme_admin'),
			"desc"    => __('Most of the &#39;Product options&#39; below only apply to Product category, archive and single product pages. To have more control on how to display products showcases, customize the "<a href="admin.php?page=rt_template_options">Default Product Template</a>" or create a new template in which you insert rows-, columns- & one or more product-modules or any other module of your choice. Each module can be adjusted, and thus change its behaviour, by changing the in the module available settings. To learn more, go to the <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read the "How To Create a Product Showcase" steps.','rt_theme_admin'),			
			"type"    => "info"),
  
			array(
					"name" => __("PRODUCT LISTING OPTIONS & LAYOUT",'rt_theme_admin'), 
					"type" => "heading"),					 
			
			array(
					"name" => __("Column Layout",'rt_theme_admin'),
					"desc"    => __("Select and set a default column layout for the product items within products category & products archive listing pages.",'rt_theme_admin'),					
					"id" => RT_THEMESLUG."_product_layout",
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
					"desc"    => __("In here you can set the amount of product items to show per page before pagination kicks in. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the value or you can directly input the amount into the text field.",'rt_theme_admin'),					
					"id" 	=> RT_THEMESLUG."_product_list_pager",
					"min"	=> "1",
					"max"	=> "200",
					"default"	=> "9", 
					"type" 	=> "rangeinput"
				),
	 
			array(
					"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
					"desc"    => __("Select and set the sorting order for the product items within the product listing pages by this parameter.",'rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_product_list_orderby",
					"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
					"default"	=> "date", 
					"type" 	=> "select"
				),
	
			array(
					"name" 	=> __("Order",'rt_theme_admin'),
					"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_product_list_order",
					"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
					"default"	=> "DESC", 
					"type" 	=> "select"
				), 

			array(
					"name" => __("CATEGORY DISPLAY OPTIONS",'rt_theme_admin'), 
					"type" => "heading"),					 

			array(
					"name"    => __("Hide Current Category Description",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_hide_current_category_desc",
					"default" => "",
					"type"    => "checkbox2",
				),

			array(
					"name" => __("Category Display",'rt_theme_admin'),
					"id" => RT_THEMESLUG."_category_display",
					"options" =>  array(
								"products_only"   => __("Show products only" ,"rt_theme_admin"), 
								"both"            => __("Show products and subcategories","rt_theme_admin"),
								"categories_only" => __("Show subcategories only","rt_theme_admin") 
							  ),
					"default" => "before", 
					"type" => "select"),

			array(	 
				"id" => "category_display",
				"type"    => "div_start",
				"div_class"   => "options_set_holder",
			),	 

				array(
						"name" => __("Subcategory Column Layout",'rt_theme_admin'),
						"id" => RT_THEMESLUG."_product_category_layout",
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
						"name" => __("Subcategory List OrderBy Parameter",'rt_theme_admin'),
						"desc" => __("Select a sorting order for the product subcategories list in product categories.",'rt_theme_admin'),
						"id"   => RT_THEMESLUG."_product_category_list_orderby",
						"options" => array(
										'id'    => 'ID',
										'name'  => 'Name',
										'slug'  => 'Slug',
										'count' => 'Count'
						),
						"default" => "name", 
						"type"    => "select"
					),
		
				array(
						"name" 	=> __("Subcategory List Order",'rt_theme_admin'),
						"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
						"id" 	=> RT_THEMESLUG."_product_category_list_order",
						"options" => array('asc'=>'Ascending','desc'=>'Descending'),
						"default"	=> "ASC", 
						"type" 	=> "select"
					), 


					array(
							"name" 	=> __("Display Subcategory Names",'rt_theme_admin'),
							"id" 	=> RT_THEMESLUG."_product_category_show_names",
							"default" => "on",
							"type" 	=> "checkbox2",
						),

					array(
							"name" 	=> __("Display Subcategory Descriptions",'rt_theme_admin'),
							"id" 	=> RT_THEMESLUG."_product_category_show_desc",
							"default" => "on",
							"type" 	=> "checkbox2",
						),

					array(
							"name" 	=> __("Display Subcategory Thumbnails",'rt_theme_admin'),
							"id" 	=> RT_THEMESLUG."_product_category_show_thumbs",
							"default" => "on",
							"type" 	=> "checkbox2",
						),			

					array(
							"name" 	=> __("Crop Subcategory Images",'rt_theme_admin'),
							"id" 	=> RT_THEMESLUG."_product_category_crop",
							"default" => "on",
							"type" 	=> "checkbox2",
						),

					array(
						   "name" 	=> __("Subcategory Maximum Image Height",'rt_theme_admin'),
						   "id" 		=> RT_THEMESLUG."_product_category_image_height",
						   "desc"		=> __('<strong>Maximum Image Height (px)</strong> : Set the maximum height in pixels for the product category images in product categories. <strong>Note</strong> : The &#39;Crop Subcategory Images&#39; must be enabled to use this option.','rt_theme_admin'),
						   "min"		=>"60",
						   "max"		=>"800",
						   "default"	=>"240",
						   "type" 	=> "rangeinput"
						),
				array(	 
					"type"    => "div_end"
				),	 

			array(
					"name" => __("CURRENCY OPTIONS",'rt_theme_admin'), 
					"type" => "heading"),					 

			array(
					"name" 	=> __("Currency",'rt_theme_admin'),
					"desc"      => __('Set a default currency sign/character.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_currency",
					"default"	=> "$",
					"type" 	=> "text", 
				),

			array(
					"name" => __("Currency Location",'rt_theme_admin'),
					"desc"      => __('Select and set the location for the currency sign/character (before or after the price label).','rt_theme_admin'),
					"id" => RT_THEMESLUG."_currency_location",
					"options" =>  array(
								"before" => "Before the numbers", 
								"after" => "After the numbers" 
							  ),
					"default" => "before", 
					"type" => "select"),

			array(
					"name" => __("PRICE DISPLAY OPTIONS",'rt_theme_admin'), 
					"type" => "heading"),		


			array(
					"name" 	=> __("Show Price in Product Listing Pages",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) the product price will be shown in product listing pages.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_show_price_in_list",
					"default" => "on",
					"type" 	=> "checkbox2",
				),

	
			array(
					"name" 	=> __("Show Price in Single Product Pages",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) the product price will be shown in product single pages.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_show_price_in_pages",
					"default" => "on",
					"type" 	=> "checkbox2"
				),



			array(
					"name" 	=> __("Show Price in Product Carousels",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) the product price will be shown in product carousels. Product carousels can be added to pages by the use of the product carousel module in the template builder or by the use of the product carousel shortcode.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_show_price_in_carousels",
					"default" => "on",
					"type" 	=> "checkbox2"
				),



			array(
					"name" => __("PRODUCT IMAGES - LISTING",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"id" 	=> RT_THEMESLUG."_product_image_crop",
					"name" =>  __("Enable (if checked) cropping for Product Images in Product Listing Pages.",'rt_theme_admin'),
					"default" => "", 
					"hr"=>true,
					"type" 	=> "checkbox2"
				),
			
			array(
				   "name" 	=> __("Maximum Image Height",'rt_theme_admin'),
				   "id" 		=> RT_THEMESLUG."_product_image_height",
				   "desc"		=> __('<strong>Maximum Image Height (px)</strong> : Set the maximum height in pixels for the product images in listing pages. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the height value or you can directly input the height value into the text field.<br /><br /><strong>Note</strong> : The &#39;Cropping for Product Images in Product Listing Pages&#39; must be enabled to use this option.','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"800",
				   "default"	=>"240",
				   "type" 	=> "rangeinput"
				),

			array(
					"name" => __("PRODUCT IMAGES - SINGLE PRODUCT PAGE",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name" 	=> __("Enable Cropping for Product Images in Single Product Pages.",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) then the product images within the single products page will be cropped.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_single_product_image_crop",
					"default" => "", 
					"hr"=>true,
					"type" 	=> "checkbox2"
				),


			array(
				   "name" 		=> __("Products Maximum Image Width",'rt_theme_admin'),
				   "desc"		=> __('<strong>Maximum Image Width (px)</strong> : Set the maximum width in pixels for the product images in the single product page & the thumbnail slider images (keeping same aspect ratio). You can drag the horizontal (scroll) bar to the left or right to decrease or increase the width value or you can directly input the width value into the text field.<br /><br /><strong>Note</strong> : The &#39;Cropping for Product Images in Single Product Pages&#39; must be enabled to use this option.','rt_theme_admin'),
				   "id" 		=> RT_THEMESLUG."_single_product_image_width",
				   "min"		=>"60",
				   "max"		=>"800",
				   "default"	=>"220",
				   "type" 		=> "rangeinput"
				),
			
			array(
				   "name" 		=> __("Products Maximum Image Height",'rt_theme_admin'),
				   "desc"		=> __('<strong>Maximum Image Height (px)</strong> : Set the maximum height in pixels for the product images in the single product & the thumbnail slider images (keeping same aspect ratio). You can drag the horizontal (scroll) bar to the left or right to decrease or increase the height value or you can directly input the height value into the text field.<br /><br /><strong>Note</strong> : The &#39;Cropping for Product Images in Single Product Pages&#39; must be enabled to use this option.','rt_theme_admin'),
				   "id" 		=> RT_THEMESLUG."_single_product_image_height",
				   "min"		=>"120",
				   "max"		=>"800",
				   "default"	=>"160",
				   "type" 		=> "rangeinput"
				),

			array(
					"name" => __("PRODUCT NAVIGATION",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Enable Previous / Next Product button navigation for single product items",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) then while viewing a single product item it is possible to navigate to the previous and next product item by navigation control buttons.','rt_theme_admin'),
					"id"      => RT_THEMESLUG."_hide_product_navigation",
					"default" => "",
					"type"    => "checkbox2"
				),

			array(
					"name" 	=> __("RELATED PRODUCTS",'rt_theme_admin'), 
					"type" 	=> "heading"
				),

			array(
					"name" 	=> __("Enable cropping for Product Images inside the related products carousel",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) then the product images within the related products carousel will be cropped.','rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_related_products_crop",
					"default" => "on",					
					"hr"		=> true,
					"type" 	=> "checkbox2"
				),

			array(
					"name" => __("Related Products Column Layout",'rt_theme_admin'),
					"desc" => __("Select and set a default column layout for the related product items on single product page.",'rt_theme_admin'),
					"id" => RT_THEMESLUG."_related_product_layout",
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
					"name" => __("BREADCRUMB PATH",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name"    => __("Default Product Page (for breadcrumb)",'rt_theme_admin'),
					"desc"    => __("Select and set a default Product page to add to your breadcrumbs path. This page will be added to the breadcrumbs path in front of every single product post item. <br /><br /><strong>Note</strong> : this only applies to the breadcrumbs path and will not have any influence on the permalink structure (the url) of the product post.",'rt_theme_admin'),					
					"id"      => RT_THEMESLUG."_product_list",
					"options" =>  $this->rt_get_pages(), 			
					"default" => "", 
					"select"  => "select a page",
					"type"    => "select"),


			array(
					"name" 	=> __("PERMALINKS STRUCTURE",'rt_theme_admin'), 
					"type" 	=> "heading"
				),

			array(
					"name" 	=> __("Category Slug",'rt_theme_admin'),
					"desc"    => __("Set a default UNIQUE slugname for your product (category) listing pages. IMPORTANT! : If set to a slugname that already exists (duplicate slugnames) anywhere within your website this will result into a 404 page when you try to view your product listing pages. <br /><br /><strong>Note</strong> : When you create a post, page, category, tag, custom post wordpress automatically creates a unique slugname (in small capitals with hyphens for spaces, as spaces are not allowed in slugnames) from the title of that page, post or item. This means that if you set your slugname in here to &#39;our-products&#39; and you create a page called &#39;Our Products&#39; that you have created a duplicate slugname and you will be hit by 404 errors viewing your products pages.<br /><br /><strong>Note</strong> : If you start manually editing slugnames make sure you change them into a slugname that does not exist. Do not create duplicate slugnames as wordpress will loose its way not knowing anymore which post, page, category, tag etc. is the correct one to show!! Do not use numbers, space, etc. Use only small caps.",'rt_theme_admin'),					
					"id" 	=> RT_THEMESLUG."_product_category_slug",
					"default"	=> "product-showcase",
					"help" 	=> "true",
					"type" 	=> "text"
				),

			array(
					"name" 	=> __("Single Product Slug",'rt_theme_admin'),
					"desc"    => __("Set a default UNIQUE slugname for your single product items. IMPORTANT! : If set to a slugname that already exists (duplicate slugnames) anywhere within your website this will result into a 404 page when you try to view the single product item. <br /><br /><strong>Note</strong> : When you create a post, page, category, tag, custom post wordpress automatically creates a unique slugname (in small capitals with hyphens for spaces, as spaces are not allowed in slugnames) from the title of that page, post or item. This means that if you set your slugname in here to &#39;product&#39; and you create a page called &#39;Product&#39; that you have created a duplicate slugname and you will be hit by 404 errors viewing your single product item.<br /><br /><strong>Note</strong> : If you start manually editing slugnames make sure you change them into a slugname that does not exist. Do not create duplicate slugnames as wordpress will loose its way not knowing anymore which post, page, category, tag etc. is the correct one to show!! Do not use numbers, space, etc. Use only small caps.",'rt_theme_admin'),
					"id" 	=> RT_THEMESLUG."_product_single_slug",
					"help" 	=> "true",
					"default"	=> "product-detail",
					"type" 	=> "text"
				),

			array(
					"name" => __("DEFAULT PRODUCT LAYOUT",'rt_theme_admin'), 
					"type" => "heading"),
			
			array(
					"name" => __("Default Layout for Product Pages",'rt_theme_admin'),
					"desc"    => __("Select and set a default layout for your categories, archive and single product pages.",'rt_theme_admin'),
					"id" => RT_THEMESLUG."_sidebar_position_product",
					"select" => __("Select",'rt_theme_admin'),
					"options" =>  array(
									"right" => 	"Content + Right Sidebar", 
									"left"  => 	"Content + Left Sidebar",
									"full"  => 	"Full Width - No Sidebar",
								),
					"default"	=> "right",
					"hr"		=> true,
					"default"   => "full",
					"type" => "select"),				

		); 
?>