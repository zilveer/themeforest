<?php

$options = array(


array( "name" => "Footer",
	   "type" => "section",
	   "icon" => "layout-select-footer.png",
	   "id" 	 => ""
),
array( "type" => "open",
"id" 	 => ""
),



array("name" => "Footer credits",
"id" 	 => "",
"desc" => "",
"type" => "subheading"),

array("name" => "Footer credits - left",
"desc" => "This is the copyright-notice on the bottom of all pages.",
"id" => $shortname."_footer_text_left",
"type" => "textarea",
"std" => ""
),

array("name" => "Footer credits - right",
"desc" => "This is the copyright-notice on the bottom of all pages.",
"id" => $shortname."_footer_text_right",
"type" => "textarea",
"std" => ""
),
array("type" => "subclose", "id" => ""),


array( "type" => "close",
"id" 	 => ""
),


);

return apply_filters('epic_theme_footer_options', $options);	





?>