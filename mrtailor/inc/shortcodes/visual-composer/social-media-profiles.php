<?php

// [social-media]

vc_map(array(
   "name"						=> __("Social Media Profiles"),
   "category"					=> __('Social'),
   "description"				=> __("Links to your social media profiles"),
   "base"						=> "social-media",
   "class"						=> "",
   "icon"						=> "social-media",
   
   "params" 	=> array(

		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Align"),
			"param_name"	=> "items_align",
			"value"			=> array(
				"Left"		=> "left",
				"Center"	=> "center",
				"Right"		=> "right"
			)
		),

		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Font Size (px, em)",
			"param_name"	=> "font_size",
		),

		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Color",
			"param_name"	=> "color",
		),
		
   )
   
));