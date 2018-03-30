<?php

$dropdownfontlist = __("A dropdown list is presented with available google fonts and websafe fonts. Only one font family type can be set at a time to this element.",'rt_theme_admin');
$fontsizeslider = __('Set the font size for this element by :<br />1) dragging the &#39;font-size-slider&#39; to the left (decrease the font size), <br />2) dragging the &#39;font-size-slider&#39; to the right (increase the font size),<br />3) manually entering a value into the font size text field.','rt_theme_admin');

$options = 
array (

	array(
			"name" => __("FONTS",'rt_theme_admin'), 
			"type" => "heading"),  

	array(
			"name" => __("Select Body Font Family",'rt_theme_admin'),
			"desc" => __("Select and set a font family for the body element.",'rt_theme_admin').' '. $dropdownfontlist,
			"id" => RT_THEMESLUG."_font_body",
			"options" => $this->rt_font_list,		 
			"font-demo" => "true", 
			"class" => "fontlist",
			"select"=>__("Select Font",'rt_theme_admin'),
			"hr" => "true", 
			"default"=> "PT+Sans:400,400italic",
			"type" => "select"),

	array(
			"name" => __("Select Heading Font",'rt_theme_admin'),
			"desc" => __("Select a font for the heading elements (h-tags).",'rt_theme_admin').' '. $dropdownfontlist,
			"id" => RT_THEMESLUG."_fonts_heading",
			"options" => $this->rt_font_list,
			"font-demo" => "true", 
			"class" => "fontlist",
			"select"=>__("Select Font",'rt_theme_admin'),
			"hr" => "true",  
			"default"=> "PT+Sans+Narrow&subset=latin,latin-ext",
			"type" => "select"),			

	array(
			"name" => __("Select Menu Font",'rt_theme_admin'),
			"desc" => __("Select a font for the main navigation menu.",'rt_theme_admin').' '. $dropdownfontlist,
			"id" => RT_THEMESLUG."_fonts_menu", 
			"options" => $this->rt_font_list,
			"font-demo" => "true",
			"select"=>__("Select Font",'rt_theme_admin'), 
			"class" => "fontlist", 
			"hr" => "true",  
			"default"=> "PT+Sans+Narrow&subset=latin,latin-ext",			   
			"type" => "select"),		 

	array(
			"name" => __("Select Alternative Font",'rt_theme_admin'),
			"desc" => __("Select a alternative font for the quotes, testimonials and some other parts of the design.",'rt_theme_admin').' '. $dropdownfontlist,
			"id" => RT_THEMESLUG."_fonts_serif", 
			"options" => $this->rt_font_list,
			"font-demo" => "true",
			"select"=>__("Select Font",'rt_theme_admin'), 
			"class" => "fontlist", 
			"default"=> "PT+Serif",			   
			"type" => "select"),		 
						

	array(
			"name" => __("FONT SIZES (px)",'rt_theme_admin'), 
			"type" => "heading"),

	array(
			"name" => __("Body Font Size",'rt_theme_admin'),
			"desc" =>  __("<strong>Body element font size</strong> : ",'rt_theme_admin').$fontsizeslider,
			"id" => RT_THEMESLUG."_body_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"36",
			"default"=>"13",
			"dont_save"=>"true",
			"type" => "rangeinput"),
	
	array(
			"name" => __("Menu Font Size",'rt_theme_admin'),
			"desc" =>  __("<strong>Menu / Navigation font size</strong> : ",'rt_theme_admin').$fontsizeslider,			
			"id" => RT_THEMESLUG."_menu_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"24",
			"default"=>"16",
			"dont_save"=>"true",
			"type" => "rangeinput"),		 

	array(
			"name" => __("Content Box and Widget Headings",'rt_theme_admin'),
			"desc" =>  __("<strong>Content Box and Widget Headings font size</strong> : ",'rt_theme_admin').$fontsizeslider,			
			"id" => RT_THEMESLUG."_widget_heading_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"50",
			"default"=>"20",
			"dont_save"=>"true",
			"type" => "rangeinput"),

	array(
			"name" => __("Heading Font Size (H1)",'rt_theme_admin'),
			"desc" =>  __("<strong>Heading (h1-tag) font size</strong> : ",'rt_theme_admin').$fontsizeslider,				
			"id" => RT_THEMESLUG."_h1_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"100",
			"default"=>"28",
			"dont_save"=>"true",
			"type" => "rangeinput"),

	array(
			"name" => __("Heading Font Size (H2)",'rt_theme_admin'),
			"desc" =>  __("<strong>Heading (h2-tag) font size</strong> : ",'rt_theme_admin').$fontsizeslider,				
			"id" => RT_THEMESLUG."_h2_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"100",
			"default"=>"26",
			"dont_save"=>"true",
			"type" => "rangeinput"),

	array(
			"name" => __("Heading Font Size (H3)",'rt_theme_admin'),
			"desc" =>  __("<strong>Heading (h3-tag) font size</strong> : ",'rt_theme_admin').$fontsizeslider,							
			"id" => RT_THEMESLUG."_h3_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"100",
			"default"=>"20",
			"dont_save"=>"true",
			"type" => "rangeinput"),

	array(
			"name" => __("Heading Font Size (H4)",'rt_theme_admin'),
			"desc" =>  __("<strong>Heading (h4-tag) font size</strong> : ",'rt_theme_admin').$fontsizeslider,							
			"id" => RT_THEMESLUG."_h4_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"100",
			"default"=>"18",
			"dont_save"=>"true",
			"type" => "rangeinput"),

	array(
			"name" => __("Heading Font Size (H5)",'rt_theme_admin'),
			"desc" =>  __("<strong>Heading (h5-tag) font size</strong> : ",'rt_theme_admin').$fontsizeslider,							
			"id" => RT_THEMESLUG."_h5_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"100",
			"default"=>"16",
			"dont_save"=>"true",
			"type" => "rangeinput"), 			

	array(
			"name" => __("Heading Font Size (H6)",'rt_theme_admin'),
			"desc" =>  __("<strong>Heading6 (h6-tag) font size</strong> : ",'rt_theme_admin').$fontsizeslider,							
			"id" => RT_THEMESLUG."_h6_font_size",
			"hr" => "true",
			"min"=>"10",
			"max"=>"100",
			"default"=>"14",
			"dont_save"=>"true",
			"type" => "rangeinput"),
			
); 
?>