<?php

$options = array (


			array(
			"name"    => __("Info",'rt_theme_admin'),
			"desc"    => __('All the &#39;Portfolio options&#39; below only apply to Portfolio category, archive and single portfolio pages. To have more control on how to display portfolio posts, customize the "<a href="admin.php?page=rt_template_options">Default Portfolio Template</a>" or create a new template in which you insert rows-, columns- & one or more portfolio-modules or any other module of your choice. Each module can be adjusted, and thus change its behaviour, by changing the in the module available settings. To learn more, go to the <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read the "How To Create a Portfolio" steps.','rt_theme_admin'),
			"type"    => "info"),


			array(
					"name" => __("PORTFOLIO LISTING OPTIONS & LAYOUT",'rt_theme_admin'), 
					"type" => "heading"),				   			
			array(
					"name"    => __("Column Layout",'rt_theme_admin'),
					"desc"    => __("Select and set a default column layout for the portfolio items within portfolio category & portfolio archive listing pages.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portfolio_layout",
					"options" =>  array(
								5 => "1/5", 
								4 => "1/4",
								3 => "1/3",
								2 => "1/2",
								1 => "1/1"
							  ), 			
					"default" => "3", 
					"type"    => "select"),
			
			array(
					"name"    => __("Amount of portfolio items to show per page",'rt_theme_admin'),
					"desc"    => __("In here you can set the amount of portfolio items to show per page before pagination kicks in. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the value or you can directly input the amount into the text field.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portf_pager",
					"min"     => "1",
					"max"     => "200",
					"default" => "9", 
					"type"    => "rangeinput"
				),
	
			array(
					"name"    => __("OrderBy Parameter",'rt_theme_admin'),
					"desc"    => __("Select and set the sorting order for the portfolio items within the portfolio listing pages by this parameter.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portf_list_orderby",
					"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'), 
					"default" => "date",
					"type"    => "select"
				),
	
			array(
					"name"    => __("Order",'rt_theme_admin'),
					"desc"    => __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portf_list_order",
					"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
					"default" => "DESC",				
					"type"    => "select"
				),


			array(
					"name" => __("PORTFOLIO IMAGES - LISTING PAGES",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			
			array(
					"name"    => __("Enable Cropping for Portfolio Images in Portfolio Listing Pages.",'rt_theme_admin'),
					"desc"      => __('If enabled (checked) Portfolio Images will be cropped in listing pages following the height setting below.','rt_theme_admin'),					
					"id"      => RT_THEMESLUG."_portfolio_image_crop", 
					"default" => "",					
					"hr"      => true,	
					"type"    => "checkbox2"
				),

			
			array(
				   "name" 	=> __("Maximum Image Height",'rt_theme_admin'),
				   "id" 		=> RT_THEMESLUG."_portfolio_image_height",
				   "desc"		=> __('<strong>Maximum Image Height (px)</strong> : Set the maximum height in pixels for the portfolio images in listing pages. You can drag the horizontal (scroll) bar to the left or right to decrease or increase the height value or you can directly input the height value into the text field.<br /><br /><strong>Note</strong> : The &#39;Cropping for Portfolio Images in Portfolio Listing Pages&#39; must be enabled to use this option.','rt_theme_admin'),
				   //"desc"		=> __('You can use this option if the "Crop Portfolio Images" feature is ON for portfolio listing pages','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"800",
				   "default"	=>"460",
				   "type" 	=> "rangeinput"
				),


			array(
					"name" => __("COMMENTS",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Enable (if checked) Commenting in Single Portfolio Pages.",'rt_theme_admin'),
					"desc"      => __('If enabled your website visitors will be able to leave a comment in the single portfolio item page while viewing that single portfolio page. If enabled in here you can still turn commenting off in the single portfolio item itself by unchecking the comments option in that post in the admin backend. If you don&#39;t see that option you can enable it by clicking on the screen options below the admin name while you are working in the single portfolio item.','rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portfolio_comments",
					"default" => "",
					"type"    => "checkbox2"
				),

			array(
					"name" => __("POST NAVIGATION",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Enable (if checked) Previous / Next portfolio button navigation for single portfolio items",'rt_theme_admin'),
					"desc"      => __('If enabled then while viewing a single portfolio item it is possible to navigate to the previous and next portfolio item by navigation control buttons.','rt_theme_admin'),
					"id"      => RT_THEMESLUG."_hide_portfolio_navigation",
					"default" => "on",
					"type"    => "checkbox2"
				),

			array(
					"name" => __("BREADCRUMBS PATH",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"name"    => __("Default Portfolio Page (for breadcrumb)",'rt_theme_admin'),
					"desc"    => __("Select and set a default Portfolio page to add to your breadcrumbs path. This page will be added to the breadcrumbs path in front of every single portfolio post item. <br /><br /><strong>Note</strong> : this only applies to the breadcrumbs path and will not have any influence on the permalink structure (the url) of the portfolio post.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portf_page",
					"options" =>  $this->rt_get_pages(), 			
					"default" => "", 
					"select"  => "select a page",
					"type"    => "select"),

			array(
					"name" => __("PERMALINK STRUCTURE",'rt_theme_admin'), 
					"type" => "heading"),

			array(
					"name"    => __("Category Slug",'rt_theme_admin'),
					"desc"    => __("Set a default UNIQUE slugname for your portfolio (category) listing pages. IMPORTANT! : If set to a slugname that already exists (duplicate slugnames) anywhere within your website this will result into a 404 page when you try to view your portfolio listing pages. <br /><br /><strong>Note</strong> : When you create a post, page, category, tag, custom post wordpress automatically creates a unique slugname (in small capitals with hyphens for spaces, as spaces are not allowed in slugnames) from the title of that page, post or item. This means that if you set your slugname in here to &#39;our-portfolios&#39; and you create a page called &#39;Our Portfolios&#39; that you have created a duplicate slugname and you will be hit by 404 errors viewing your portfolio pages.<br /><br /><strong>Note</strong> : If you start manually editing slugnames make sure you change them into a slugname that does not exist. Do not create duplicate slugnames as wordpress will loose its way not knowing anymore which post, page, category, tag etc. is the correct one to show!! Do not use numbers, space, etc. Use only small caps.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portfolio_category_slug",
					"default" => "portfolios",
					"help"    => "true",
					"type"    => "text",
					"hr"      => "true"
				),

			array(
					"name"    => __("Single Portfolio Slug",'rt_theme_admin'),
					"desc"    => __("Set a default UNIQUE slugname for your single portfolio items. IMPORTANT! : If set to a slugname that already exists (duplicate slugnames) anywhere within your website this will result into a 404 page when you try to view the single portfolio item. <br /><br /><strong>Note</strong> : When you create a post, page, category, tag, custom post wordpress automatically creates a unique slugname (in small capitals with hyphens for spaces, as spaces are not allowed in slugnames) from the title of that page, post or item. This means that if you set your slugname in here to &#39;portfolio&#39; and you create a page called &#39;Portfolio&#39; that you have created a duplicate slugname and you will be hit by 404 errors viewing your single portfolio item.<br /><br /><strong>Note</strong> : If you start manually editing slugnames make sure you change them into a slugname that does not exist. Do not create duplicate slugnames as wordpress will loose its way not knowing anymore which post, page, category, tag etc. is the correct one to show!! Do not use numbers, space, etc. Use only small caps.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_portfolio_single_slug",
					"help"    => "true",
					"default" => "portfolio",
					"type"    => "text"
				),

			array(
					"name" => __("DEFAULT PORTFOLIO LAYOUT",'rt_theme_admin'), 
					"type" => "heading"),
  
			array(
					"name"    => __("Default Layout for Portfolio Pages",'rt_theme_admin'),
					"desc"    => __("Select and set a default layout for your categories, archive and single portfolio pages.",'rt_theme_admin'),
					"id"      => RT_THEMESLUG."_sidebar_position_portfolio",
					"select"  => __("Select",'rt_theme_admin'),
					"options" =>  array(
									"right"   => 	"Content + Right Sidebar", 
									"left"    => 	"Content + Left Sidebar",
									"full"    => 	"Full Width - No Sidebar",
									),
					"hr"      => true,
					"type"    => "select"),				
		); 
?>