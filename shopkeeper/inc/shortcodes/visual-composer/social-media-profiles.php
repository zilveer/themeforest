<?php

// [social-media]

vc_map(array(
   "name"						=> "Social Media Profiles",
   "category"					=> 'Social',
   "description"				=> "Links to your social media profiles",
   "base"						=> "social-media",
   "class"						=> "",
   "icon"						=> "social-media",
   
   "params" 	=> array(
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Align",
			"param_name"	=> "items_align",
			"value"			=> array(
				"Left"		=> "left",
				"Center"	=> "center",
				"Right"		=> "right"
			)
		)
   )
   
));