<?php

$options = array (

	array(
	"type"      => "hr"),	
	
	array(
	"name"      => __("Logo",'rt_theme_admin'),
	"desc"      => __('Upload a image file by the use of the upload button or insert a valid url to a image to use as the website logo. <strong>Note</strong> : Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),
	"id"        => RT_THEMESLUG."_logo_url", 
	"type"      => "upload"),
	
	array(
	"name"      => __("Logo for HiDPI (Retina) Devices ",'rt_theme_admin'),
	"desc"      => __('Upload a image file, two times bigger in size than the default logo image, to get sharp looking logo on HiDPI (Retina) devices. For uploading use the upload button or insert a valid url to a logo image. <br /><br /><strong>Example</strong> : if your logo image in the default logo upload field is sized 200x100px then you should upload 400x200px one for this field.<br /><strong>Note</strong> : Externally linked images are not allowed because they can put your website at risk.','rt_theme_admin'),
	"id"        => RT_THEMESLUG."_logo_url_2x",
	"type"      => "upload"),
 

	array(
	"name"      => __("HEADER STYLE",'rt_theme_admin'), 
	"type"      => "heading"), 

				array(	 
					"type"    => "div_start",
					"div_class"   => "options_set_holder",
				),	 
					array(
					"name"      => __("Header Style",'rt_theme_admin'),
					"desc"      => __('Select and set the default theme layout style (boxed mode or full width mode).','rt_theme_admin'),
					"id"        => RT_THEMESLUG."_header_design",
					"options"   =>	array(
										"design1"  => __("DESIGN 1 - Logo placed above of the navigation bar",'rt_theme_admin'),
										"design2"  => __("DESIGN 2 - Logo placed left of the navigation bar",'rt_theme_admin'),				
								),
					"default"   => "default", 
					"class"     => "div_controller",
					"type"      => "select"),  


					array( 
						"div_class"   => "hidden_options_set design1",
						"type"    => "div_start",
					),	

						array(
						"name"      => __("NAVIGATION WIDTH",'rt_theme_admin'), 
						"type"      => "heading"),
						  

						array(
						"name"    => __("Navigation Bar Width",'rt_theme_admin'),
						"desc"    => __('Select to change the navigation design.','rt_theme_admin'),
						"id"      => RT_THEMESLUG."_menu_style",
						"options" =>  array(
										"menu-style-one"   => __("Full-Width","rt_theme_admin"),
										"menu-style-two"   => __("Half-Width / Centered","rt_theme_admin")
									),
						"hr"      => "true",
						"default" => "menu-style-one",
						"type"    => "select"	
						), 	


						array(
						"name"      => __("LOGO POSITON & TOP WIDGET AREAS",'rt_theme_admin'), 
						"type"      => "heading"),
						  

						array(
						"name"    => __("Logo Section Width",'rt_theme_admin'),
						"desc"    => __('Select and set the width of the logo section. The rest of the space left in the header area will be used for the top widget areas.','rt_theme_admin'),
						"id"      => RT_THEMESLUG."_header_layout",
						"options" =>  array(
										"5" =>  "Three fourth of the header", 
										"4" =>  "Two third of the header", 
										"3" =>  "One third of the header", 
										"2" =>  "Half of the header",
										"1" =>  "Full width of the header",
									),
						
						"default" => "3",
						"type"    => "select"),	


						array(
						"name"    => __("Logo Position",'rt_theme_admin'),
						"desc"    => __('Select and set the logo position (available options : left, right, center).','rt_theme_admin'),
						"id"      => RT_THEMESLUG."_logo_position",
						"options" =>  array(
										"left" =>  "Left", 
										"right" =>  "Right",
										"center" =>  "Center",
									),
						
						"default" => "center",
						"hr"        => "true",
						"type"    => "select"),	

						array(
						"name"      => __("Show First Top Widget Area.",'rt_theme_admin'),
						"id"        => RT_THEMESLUG."_show_first_top_widget",
						"check_desc"   => __('<br /><br />If enabled (checked) widgets will show in the header area from the first top widget container. See the wordpress admin appearance widgets section.','rt_theme_admin'),	
						"type"      => "checkbox2",
						"default"   => "checked", 
						"help"      => "true"),  
					 
						array(
						"name"      => __("Show Second Top Widget Area.",'rt_theme_admin'),
						"id"        => RT_THEMESLUG."_show_second_top_widget",
						"check_desc"      => __('<br /><br />If enabled (checked) widgets will show in the header area from the second top widget container. See the wordpress admin appearance widgets section.','rt_theme_admin'),	
						"type"      => "checkbox2",
						"default"   => "checked",
						"help"      => "true"),  


						array(
						"name"      => __("NAVIGATION BAR ELEMENTS",'rt_theme_admin'), 
						"type"      => "heading"), 

						array(
						"name"      => __("Enable Top Level Menu Subtitles.",'rt_theme_admin'),
						"desc"      => __("If enabled (checked) then the in the menu item description field entered text will show as a subtitles for the <strong>top level item only</strong>. <br /><br /><strong>Note</strong> : If you don&#39;t see a description field in your menu item, then make sure to enabled the visibility of the description field in the screen options below the admin name while you are working in the wordpress menu system.",'rt_theme_admin'),				
						"id"        => RT_THEMESLUG."_show_subtitles",
						"type"      => "checkbox2"
						), 			

						array(
						"name"      => __("Show Search in Default Menubar",'rt_theme_admin'),
						"desc"      => __("If enabled (checked) the search field will show in the main navigation bar.",'rt_theme_admin'),				
						"id"        => RT_THEMESLUG."_show_search_menu",
						"default"   => "on",
						"type"      => "checkbox2"
						), 			

				
					array(	 
						"type"    => "div_end"
					),	

					array( 
						"div_class"   => "hidden_options_set design2",
						"type"    => "div_start",
					),	

						array(
						"name"      => __("HEADER HEIGHT",'rt_theme_admin'), 
						"type"      => "heading"),
						  
						 	array(
								"name" => __("Header Height",'rt_theme_admin'),
								"desc" =>  __("Change the height of the header of the design 2",'rt_theme_admin'),							
								"id" => RT_THEMESLUG."_header_height",
								"min"=>"40",
								"max"=>"1000",
								"default"=>"80",
								"dont_save"=>"true",
								"type" => "rangeinput"
							),
				
					array(	 
						"type"    => "div_end"
					),	

				array(	 
					"type"    => "div_end"
				),			


	array(
	"name"      => __("TOP SLOGAN",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
	"name"      => __("Top Slogan",'rt_theme_admin'),
	"desc"      => __("Enter a slogan text to show in the header area.",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_top_slogan",
	"type"      => "text"
	),

	array(
	"name"      => __("Icon for the Top Slogan",'rt_theme_admin'),
	"desc"      => __('Select and set a icon to precede the slogan.','rt_theme_admin'),	
	"id"        => RT_THEMESLUG."_top_slogan_icon",
	"type"      => "text",
	"class"     => "icon_selection"
	),

	array(
	"name"    => __("Top Slogan Location",'rt_theme_admin'),
	"desc"    => __('Select and set the location to show the slogan in the header area.','rt_theme_admin'),
	"id"      => RT_THEMESLUG."_top_slogan_position",
	"options" =>  array(
					"sidebar-for-top-first"   => "Inside First Top Widget Area / Before Logo",
					"sidebar-for-top-second"  => "Inside Second Top Widget Area / After Logo", 					
				),
	
	"default" => "sidebar-for-top-second",
	"type"    => "select"),	

	
	array(
	"name"      => __("TOP BAR ( Top Links Area ) ",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
	"name"      => __("Hide Top Bar",'rt_theme_admin'),
	"desc"      => __("If this opion enabled (checked) the top bar (top links area) will be removed from all pages.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_hide_top_bar",
	"default"   => "",
	"type"      => "checkbox2"
	), 			

	array(
	"name"      => __("Show Search in Top Menubar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the search field will show in the page top menu bar.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_search_top",
	"default"   => "on",
	"type"      => "checkbox2"
	), 		


	array(
	"name"      => __("STICKY NAVIGATION",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
	"name"      => __("Enable Sticky Menubar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the main navigation menubar will stick to the top of the browser window while scrolling down through the page content. <br /><br /><strong>Note</strong> : only works when the page content is bigger then the browser window itself.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_sticky_navigation",
	"default"   => "checked",
	"type"      => "checkbox2",
	),

	array(
	"name"      => __("Show Logo in Sticky Menubar",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the logo will be displayed inside the sticky menubar.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_sticky_logo",
	"default"   => "on",
	"type"      => "checkbox2"
	), 			 

	array(
	"name"      => __("SUB-HEADER AREA",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
	"name"      => __("Remove sub-header content area when empty",'rt_theme_admin'),
	"desc"      => __("If enabled (checked) the sub-header bar will not be displayed if there is no content, breadcrumb or page title added into.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_remove_empty_sub_header",
	"default"   => "",
	"type"      => "checkbox2"
	), 		


	array(
	"name"      => __("PAGE TITLE & BREADCRUMB MENU",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
	"name"    => __("Breadcrumb & Title Position",'rt_theme_admin'),
	"desc"    => __('Select and set a location for breadcrumb path and the page title.','rt_theme_admin'),
	"id"      => RT_THEMESLUG."_breadcrumb_position",
	"options" =>  array(
					"inside_header"   =>  "Inside Header Bar", 
					"inside_content" =>  "Inside Content Area",
				), 
	"default" => "inside_header",
	"type"    => "select"),	


	array(
	"name"      => __("Show Breadcrumb Path",'rt_theme_admin'),
	"check_desc"  => __("If enabled (checked) the breadcrumb path is displayed at the in the previous option set location.",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_breadcrumb_menus", 
	"default"   => "checked",
	"type"      => "checkbox"),
	
	array(
	"name"      => __("Breadcrumb Path Prefix Text",'rt_theme_admin'),
	"desc"      => __("Enter the default text to show before the breadcrumb path. ( f.e. 'You are now here : ' )",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_breadcrumb_text",
	"type"      => "text",
	"hr"        => "true"
	),

); 
?>