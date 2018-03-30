<?php

// [team_member]

vc_map(array(
   "name"			=> "Team Members",
   "category"		=> 'Content',
   "description"	=> "Place Team Members",
   "base"			=> "team_member",
   "class"			=> "",
   "icon"			=> "team_member",

   
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
			"heading" => "Name",
			"param_name" => "name",
			"value" => "Name"
		),
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => "Role",
			"param_name" => "role",
			"value" => "Role"
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

   )
   
));