<?php 


$options = array (
		array(
			"name" => __("Info",'rt_theme_admin'),
			"desc" => __("Type URL of your social media page in the related fields to display with it's icon. You can place the social media icons on top of the page and footer by turning on under the 'Positions' options or anywhere else you want by using the shortcode below." ,'rt_theme_admin'),
			"type" => "info",
		),

		array(
		"name"      => __("SOCIAL MEDIA SHORTCODE",'rt_theme_admin'), 
		"type"      => "heading"),

		array( 
				"desc"      => __("[rt_social_media_icons]",'rt_theme_admin'),
				"type" => "info_text",
		),

		array(
		"name"      => __("POSITIONS",'rt_theme_admin'), 
		"type"      => "heading"),

		array(
				"name"      => __("Display icons on top of the page",'rt_theme_admin'),			
				"id"        => THEMESLUG."_social_media_top",
				"type"      => "checkbox",				
				"hr"		=> "true"
		),

		array(
				"name"      => __("Display icons on footer of the page",'rt_theme_admin'),
				"id"        => THEMESLUG."_social_media_bottom",
				"type"      => "checkbox",
				"default"   => "on",
				"hr"		  => "true"
		),

); 

	foreach($this->social_media_icons as $key => $value){
			array_push($options, 
						array(
						"name" 	=> $key. __(" icon link",'rt_theme_admin'), 
						"id" 	=> THEMESLUG."_".$value."",
						"type" 	=> "text", "hr" => "true"
						)
					);  
	} 
?>