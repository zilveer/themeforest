<?php

// [featured_1]

vc_map(array(
   "name"			=> "Services List",
   "category"		=> 'Content',
   "description"	=> "Description",
   "base"			=> "featured_1",
   "class"			=> "",
   "icon"			=> "featured_1",

   
   "params" 	=> array(
		
		array(
			"type" => "attach_image",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Image",
			"param_name" => "image_url",
			"value" => ""
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Title",
			"param_name" => "title",
			"value" => "Title"
		),
		
		array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
            "heading" => "Content",
            "param_name" => "content",
            "value" => "<p>I am test text block. Click edit button to change this text.</p>",
            "description" => "Enter your content."
         ),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Button Text",
			"param_name" => "button_text",
			"value" => "Button Text"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Button URL",
			"param_name" => "button_url",
			"value" => ""
		),
   )
   
));