<?php

	$options = array(

			
	array( 
			"name" => "Portfolio",
			"type" => "section",
			"icon" => "briefcase.png",
			"id" 	 => ""

			
			),
			
	array( 
			"type" => "open",
			"id" 	 => ""

			
			),

	


	array(
			"name" => "Portfolio settings",
			"id" 	 => "",
			"desc" => "",
			"type" => "subheading",
			"std" => ""
			
			),
			
	array(
			"name" => "Posts per page",
			"desc" => "Enter the number of post you want to show per page",
			"id" => $shortname."_portfolio_perpage",
			"type" => "text",
			"std" => "9"
			
			),
			
	array(
			"name" => "Portfolio main page",
			"desc" => "Select which page you want to use as main portfolio page",
			"id" => $shortname."_portfolio_mainpage",
			"type" => "select",
			"options" =>  $epic_getpages,
			),
	
	
	array(
			"name" => "Post order",
			"desc" => "Select if you want portfolio list to be ordered ascending or descending (Portfolio posts are ordered by date)",
			"id" => $shortname."_portfolio_order",
			"type" => "radiogroup",
			"std" => "DESC",
			"options" =>  array(
						'DESC' => "Descending",
						'ASC' => "Ascending"
						),
			),
			
	array(
			"name" => "Filterable portfolio ",
			"desc" => "Adds a category-filter to your main portfolio-page ",
			"id" => $shortname."_filterable_portfolio",
			"type" => "radiogroup",
			"std" => "true",
			"options" =>  array(
						'true' => "Yes",
						'false' => "No"),
			),
			
	array("type" => "subclose", "id" => ""),

	array( 
			"type" => "close",
			"id" 	 => ""

			
			),
			
			

);


return apply_filters('epic_theme_portfolio_options', $options);	




?>