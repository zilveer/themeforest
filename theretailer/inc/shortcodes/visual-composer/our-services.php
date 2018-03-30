<?php

// [our_services]

vc_map(array(
   "name"			=> "Features List",
   "category"		=> 'Content',
   "description"	=> "Description",
   "base"			=> "our_services",
   "class"			=> "",
   "icon"			=> "our_services",

   
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
			"heading" => "Link Text",
			"param_name" => "link_name",
			"value" => "Link Text"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Link URL",
			"param_name" => "link_url",
			"value" => ""
		),
   )
   
));