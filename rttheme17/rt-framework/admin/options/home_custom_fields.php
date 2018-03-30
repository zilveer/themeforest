<?php
#-----------------------------------------
#	RT-Theme home_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Home Page Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/ 

asort($this->google_fonts);//sort google fonts by name

$customFields = array(

			array(
					"title" => __("HEADING & TEXT",'rt_theme_admin'), 
					"type" => "heading"
				),

			array(
				"title" 			=> __("Heading & Text Position",'rt_theme_admin'), 
				"name"			=> "heading_and_text_position",
				"options" 		=>  array(
										"left" 		=> "Left aligned",
										"center" 		=> "Centered", 
								 ),
				"hr"		=> true,
				"type" 			=> "select"
			),

			array(
					"title" 	=> __("Hide the Heading",'rt_theme_admin'),
					"name" 	=> "hide_the_heading",
					"default" => "",
					"type" 	=> "checkbox"
				),

			array(
					"title" => __("LINK",'rt_theme_admin'), 
					"type" => "heading"
				),


			array(
				"name"			=> "custom_link", 
				"title"			=> __("Custom Link",'rt_theme_admin'),
				"type"			=> "text",			
				"hr"		=> true,
			),

			array(
				"name"			=> "custom_link_text",
				"title"			=> __("Custom Link Text",'rt_theme_admin'),
                "description"		=> "ex: read more",
				"type"			=> "text",
				"hr" => true,
			),

			array(
				"name" => "custom_link_target",
				"title" => __("Custom Link Target",'rt_theme_admin'),
				"options" =>  array(
							"_self" => "Same Page",
							"_blank" => "New Page", 
							),
				"type" => "select"
			),

			array(
					"title" => __("FEATURED IMAGE",'rt_theme_admin'), 
					"type" => "heading"
				),


			array(
				"title" 			=> __("Featured Image Position",'rt_theme_admin'), 
				"name"			=> "featured_image_position",
				"options" 		=>  array(
									"1-optgroup-start" => "Before Title",
										"before-center" 		=> "Centered", 
										"before-left" 			=> "Left aligned",
										"before-right" 		=> "Right aligned",
									"1-optgroup-end" => "#",
					
									"2-optgroup-start" => "After Title",
										"after-center" 		=> "Centered", 
										"after-left" 			=> "Left aligned",
										"after-right" 			=> "Right aligned",
									"2-optgroup-end" => "#",

								 ),
				"select" 			=> __("Select",'rt_theme_admin'),				
				"hr"		=> true,
				"type" 			=> "select"
			), 

			
			array(
					"title" 	=> __("Crop Featured Image",'rt_theme_admin'),
					"name" 	=> "homepage_image_crop",
					"default" => "",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),
			
			array(
				   "title" 	=> __("Maximum Image Height",'rt_theme_admin'),
				   "name" 	=> "homepage_image_height",
				   "description"		=> __('You can use this option if the "Crop Featured Image" feature is on','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"400",
				   "default"	=>"120",
				   "type" 	=> "rangeinput"
				), 


			array(
				   "title" => __("CUSTOM TYPOGRAPHY OPTIONS",'rt_theme_admin'), 
				   "type" => "heading"), 
			

			array(
				   "title" => __("Select Heading Font",'rt_theme_admin'),
				   "description" => __("You can select another google font for the heading just for this content. Make sure Google Fonts is ON inside the Typography Options",'rt_theme_admin'),
				   "name" => "_google_fonts_heading",
				   "options" => $this->google_fonts, 
				   "font-demo" => "true",
				   "font-system" => "google",
				   "class" => "fontlist",
				   "select"=>__("Select Font",'rt_theme_admin'),
				   "hr" => "true", 
				   "type" => "select"),

			array(
				   "title" => __("Select Text Font",'rt_theme_admin'),
				   "description" => __("You can select another google font for the text just for this content. Make sure Google Fonts is ON inside the Typography Options",'rt_theme_admin'),
				   "name" => "_google_fonts_body",
				   "options" => $this->google_fonts,		 
				   "font-demo" => "true",
				   "font-system" => "google",
				   "class" => "fontlist",
				   "select"=>__("Select Font",'rt_theme_admin'),
				   "type" => "select"),


			array(
				   "title" => __("CUSTOM FONT SIZES",'rt_theme_admin'), 
				   "type" => "heading"),

			array(
				   "title" => __("Heading Font Size (px)",'rt_theme_admin'),
				   "name" => "_heading_font_size",
					 "description" => "When you use the default values, it doesn't overwrites the selected heading values via the Typography Options.",
				   "min"=>"10",
				   "max"=>"100",
				   "default"=>"18",
				   "dont_save"=>"true",
				   "show_default"=>"true",					
					"hr"		=> true,
				   "type" => "rangeinput"),

			array(
				   "title" => __("Text Font Size (px)",'rt_theme_admin'),
				   "name" => "_text_font_size", 
				   "min"=>"10",
				   "max"=>"36",
				   "default"=>"13",
				   "dont_save"=>"true",
				   "show_default"=>"true",
				   "type" => "rangeinput"),


			array(
				   "title" => __("CUSTOM COLOR OPTIONS",'rt_theme_admin'), 
				   "type" => "heading"),

			array(
				"title"      => __("Heading Font Color",'rt_theme_admin'),
				"name"        => "_heading_font_color",
				"dont_save" => "true",
				"hr" => "true",
				"type"      => "colorpicker"),
		
			array(
				"title"      => __("Text Font Color",'rt_theme_admin'),
				"name"        => "_text_font_color",
				"dont_save" => "true",
				"hr" => "true",
				"type"      => "colorpicker"),

			array(
				"title"      => __("Link Color",'rt_theme_admin'),
				"name"        => "_link_font_color",
				"dont_save" => "true",
				"hr" => "true",
				"type"      => "colorpicker"),

			array(
				"title"      => __("Box Background Color",'rt_theme_admin'),
				"name"        => "_box_bg_color",
				"dont_save" => "true",
				"type"      => "colorpicker"),


				array(
				"name" 			=> "_custom_styling", 
				"statical_value"	=> "custom_styled",
				"type"			=> "hidden"),

);

$settings  = array( 
	"name"		=> THEMENAME ." Home Page Options",
	"scope"		=> "home_page",
	"slug"		=> "rt_home_custom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);