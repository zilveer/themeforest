<?php

// [banner_simple_height]

vc_map(array(
   "name"			=> "Banner",
   "category"		=> 'Content',
   "description"	=> "Place Banner",
   "base"			=> "banner_simple_height",
   "class"			=> "",
   "icon"			=> "banner_simple_height",

   
   "params" 	=> array(
      
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title",
			"param_name"	=> "title",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Subtitle",
			"param_name"	=> "subtitle",
			"admin_label"	=> FALSE,
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "URL",
			"param_name"	=> "link_url",
			"value"			=> "",
		),

		array(
			"type"			=> "checkbox",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Open link in new tab?",
			"param_name"	=> "new_tab",
			"value"			=> array(
				"Yes"			=> "true",
			),
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Title Color",
			"param_name"	=> "title_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Subtitle Color",
			"param_name"	=> "subtitle_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Inner Stroke Thickness",
			"param_name"	=> "inner_stroke",
			"value"			=> "2px",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Inner Stroke Color",
			"param_name"	=> "inner_stroke_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Background Color",
			"param_name"	=> "bg_color",
			"value"			=> "#000000",
		),
		
		array(
			"type"			=> "attach_image",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Background Image",
			"param_name"	=> "bg_image",
			"value"			=> "",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Height",
			"param_name"	=> "height",
			"value"			=> "300px",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Separator Padding",
			"param_name"	=> "sep_padding",
			"value"			=> "5px",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Separator Color",
			"param_name"	=> "sep_color",
			"value"			=> "#ffffff",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "With Bullet",
			"param_name"	=> "with_bullet",
			"value"			=> array(
				"Yes"			=> "yes",
				"No"			=> "no"
			),
			"std"			=> "no",
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Bullet Text",
			"param_name"	=> "bullet_text",
			"value"			=> "",
			"dependency" 	=> Array('element' => "with_bullet", 'value' => array('yes'))
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Bullet Background Color",
			"param_name"	=> "bullet_bg_color",
			"value"			=> "#000000",
			"dependency" 	=> Array('element' => "with_bullet", 'value' => array('yes'))
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Bullet Text Color",
			"param_name"	=> "bullet_text_color",
			"value"			=> "#ffffff",
			"dependency" 	=> Array('element' => "with_bullet", 'value' => array('yes'))
		),
   )
   
));