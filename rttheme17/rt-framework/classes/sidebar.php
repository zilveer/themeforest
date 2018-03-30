<?php
#-----------------------------------------
#	RT-Theme sidebar.php
#	version: 1.0
#-----------------------------------------

#
#	Sidebar Class
#

class RTThemeSidebar extends RTThemeAdmin{
	
 
	function __construct(){ 

		// Pages
		$rt_getpages = RTTheme::rt_get_pages();

		// Posts
		$this->posts 		= query_posts('posts_per_page=-1&post_type=post&orderby=title&order=ASC'); // Regular Posts
		$this->products  	= query_posts('posts_per_page=-1&post_type=products&orderby=title&order=ASC'); // Products
		$this->portfolios  	= query_posts('posts_per_page=-1&post_type=portfolio&orderby=title&order=ASC'); // Portfolios
		
		$rt_getposts = array();
		
		foreach ($this->posts as $post_list ) {		// add regular posts to the list
				$rt_getposts[$post_list->ID] = '['.$post_list->post_type.'] '.$post_list ->post_title;
		} 

		foreach ($this->products as $post_list ) {	// add product posts to the list
				$rt_getposts[$post_list->ID] = '['.$post_list->post_type.'] '.$post_list ->post_title;
		}
		
		foreach ($this->portfolios as $post_list ) {	// add portfolio posts to the list
				$rt_getposts[$post_list->ID] = '['.$post_list->post_type.'] '.$post_list ->post_title;
		}
		

		// Categories
		$rt_getcat = RTTheme::rt_get_categories();		

		// Product Categories		
		$rt_product_getcat = RTTheme::rt_get_product_categories();		 
  
		// Portfolio Categories		
		$rt_portfolio_getcat = RTTheme::rt_get_portfolio_categories();		 

		// reset query	   
		wp_reset_query();

		// get saved values
		$savedSidebars=get_option('rt_sidebar_options');

		// create new sidebar array
		$savedSidebars_array = array ();

		// Count Sidebars		
		$savedSidebars_IDs = array ();
		$sidebar_count=0;
		if($savedSidebars){
			foreach($savedSidebars as $key => $value){
				if(!is_array($value)){  
					if(stristr($key, '_sidebar_name') == TRUE) {
						array_push($savedSidebars_IDs,$key);
						$sidebar_count++;
					} 
					
				}
			}
		}
		

		// costruct saved array		
		foreach($savedSidebars_IDs as $id){ 
			
			//sidebar
			$sidebar_name               = $savedSidebars[$id];
			$sidebar_id                 = str_replace("_sidebar_name", "", $id);
			$sidebar_pages              = isset($savedSidebars[$sidebar_id.'_pages']) ? $savedSidebars[$sidebar_id.'_pages'] : "" ;
			$sidebar_posts              = isset($savedSidebars[$sidebar_id.'_posts']) ? $savedSidebars[$sidebar_id.'_posts'] : "" ;
			$sidebar_categories         = isset($savedSidebars[$sidebar_id.'_categories']) ? $savedSidebars[$sidebar_id.'_categories'] : "" ;
			$sidebar_product_categories = isset($savedSidebars[$sidebar_id.'_productcategories']) ? $savedSidebars[$sidebar_id.'_productcategories'] : "" ;	
			$sidebar_portfolio_categories = isset($savedSidebars[$sidebar_id.'_portfoliocategories']) ? $savedSidebars[$sidebar_id.'_portfoliocategories'] : "" ;	

			//sidebar array
			array_push($savedSidebars_array, array(
				"name" => $sidebar_name, 
				"id" => $sidebar_id,
				"options" => array(
							'pages' => $sidebar_pages,
							'posts' => $sidebar_posts,
							'categories' => $sidebar_categories,
							'productcategories' => $sidebar_product_categories,
							'portfoliocategories' => $sidebar_portfolio_categories
							)
				));		
		}
		
		// costruct form arrays		
		$options = array ();

		//template builder info text
		array_push($options, array(
		"name" => __("Info",'rt_theme_admin'),
		"desc" => __('If you need a new sidebar widget area for specified contents, you can create one by using Sidebar Creator. When you create a sidebar go to Appearence → <a href="widgets.php">Widgets</a> to drag&drop widgets into it.','rt_theme_admin'),
		"hr"   => "true",
		"type" => "info"
		));		
				
		foreach($savedSidebars_array as $sidebar_v){
			
			$sidebarID=$sidebar_v["id"];

				//Sidebar Div
				array_push($options, array(
						"id" => "div_".$sidebarID,
						"name" => $sidebar_v["name"],
						"type" => "div"));	   					
			
				//Sidebar Names
				array_push($options, array(
						"name" => __("Sidebar Name",'rt_theme_admin'),
						"value" => $sidebar_v["name"],
						"id" => $sidebarID."_sidebar_name",
						"class" => "sidebar_name saved",
						"type" => "text"));	   
				
				
				//For Pages
				array_push($options,	array(
						"name" => __("Select Pages",'rt_theme_admin'),
						"id" => $sidebar_v["id"]."_pages[]",
						"options" => $rt_getpages,
						"default" => $sidebar_v["options"]["pages"],
						"purpose" => "sidebar",
						"type" => "selectmultiple"));
			 
				
				//For Posts
				array_push($options,array(
						"name" => __("Select Posts",'rt_theme_admin'),
						"desc" => __("Regular Posts, Products, Portfolio",'rt_theme_admin'),
						"id" => $sidebar_v["id"]."_posts[]",
						"options" => $rt_getposts,
						"default" => $sidebar_v["options"]["posts"],
						"purpose" => "sidebar",
						"class" => "postlist",
						"type" => "selectmultiple" 	 
						));

				//For Categories
				array_push($options,array(
						"name" => __("Select Categories",'rt_theme_admin'),
						"id" => $sidebar_v["id"]."_categories[]",
						"options" => $rt_getcat,
						"default" => $sidebar_v["options"]["categories"],
						"purpose" => "sidebar",
						"type" => "selectmultiple"
						));

				//For Product Categories
				array_push($options,array(
						"name" => __("Select Product Categories",'rt_theme_admin'),
						"id" => $sidebar_v["id"]."_productcategories[]",
						"options" => $rt_product_getcat,
						"default" => $sidebar_v["options"]["productcategories"],
						"purpose" => "sidebar",
						"type" => "selectmultiple"
						));

				//For Portfolio Categories
				array_push($options,array(
						"name" => __("Select Portfolio Categories",'rt_theme_admin'),
						"id" => $sidebar_v["id"]."_portfoliocategories[]",
						"options" => $rt_portfolio_getcat,
						"default" => $sidebar_v["options"]["portfoliocategories"],
						"purpose" => "sidebar",
						"type" => "selectmultiple"
						));

				//Button
				array_push($options,array(
						"name" => __("Delete Sidebar",'rt_theme_admin'),
						"id" => $sidebar_v["id"]."_delete",
						"class" => "deleteButton",
						"purpose" => "sidebar",
						"type" => "button"
						));				
			
				//Sidebar Divend
				array_push($options, array(
						"id" => "",
						"type" => "divend"));	
		}
		
	
		// New Sidebar
		
		$sidebarID='sidebarid_'.rand(1, 100000); 
		$sidebarName=$sidebarID.'_sidebar_name';
		
			//Sidebar Div
			array_push($options, array(
					"name" => __("Create New Sidebar",'rt_theme_admin'), 
					"id" => "div_".$sidebarID,
					"class" => "new_sidebar",
					"type" => "div"));		
		
			//Sidebar Names
			array_push($options, array(
					"name" => __("Sidebar Name",'rt_theme_admin'),
					"value" => "",
					"class" => "sidebar_name",
					"id" => $sidebarName,
					"type" => "text"));	   
			
			
			//For Pages
			array_push($options,	array(
					"name" => __("Select Pages",'rt_theme_admin'),
					"id" => $sidebarID."_pages[]",
					"options" => $rt_getpages, 
					"default" => "", 
					"purpose" => "sidebar",
					"type" => "selectmultiple"));
		 
			
			//For Posts
			array_push($options,array(
					"name" => __("Select Posts",'rt_theme_admin'),
					"id" => $sidebarID."_posts[]",
					"options" => $rt_getposts,
					"desc" => __("Regular Posts, Products, Portfolio",'rt_theme_admin'),
					"default" => "",
					"class" => "postlist",
					"purpose" => "sidebar",
					"type" => "selectmultiple" 
					));

			//For Categories
			array_push($options,array(
					"name" => __("Select Categories",'rt_theme_admin'),
					"id" => $sidebarID."_categories[]",
					"options" => $rt_getcat, 
					"default" => "", 
					"purpose" => "sidebar",
					"type" => "selectmultiple"
					));

			//For Product Categories
			array_push($options,array(
					"name" => __("Select Product Categories",'rt_theme_admin'),
					"id" => $sidebarID."_productcategories[]",
					"options" => $rt_product_getcat, 
					"default" => "", 
					"purpose" => "sidebar",
					"type" => "selectmultiple"
					));

			//For Portfolio Categories
			array_push($options,array(
					"name" => __("Select Portfolio Categories",'rt_theme_admin'),
					"id" => $sidebarID."_portfoliocategories[]",
					"options" => $rt_portfolio_getcat, 
					"default" => "", 
					"purpose" => "sidebar",
					"type" => "selectmultiple"
					));			


			//Send button
			array_push($options,	array(
					"name" => __("Create Sidebar",'rt_theme_admin'),
					"id" => $sidebarID."_send_button",
					"class" => "create_button sidebarCreate",
					"purpose" => "page_layouts",  
					"type" => "send_button"));
			
			//Sidebar Divend
			array_push($options, array(
					"id" => "",
					"type" => "divend"));	  			
				
				
		$this->rt_generate_form_page($options); 	
	}



}

$sidebarClass = new RTThemeSidebar();

?>