<?php
vc_map( array(
   "name" => __("SimpleKey Feature","SimpleKey"),
   "base" => "config_item",
   "class" => "wpb_config",
   "icon" =>"icon-wpb-config",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Feature item for your service or product','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	 
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_config_title",
         "heading" => __("Feature Title","SimpleKey"),
         "param_name" => "title",
         "value" =>  ""
      ),
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_config_link",
         "heading" => __("Icon Link","SimpleKey"),
         "param_name" => "href",
         "value" =>  "",
         "description" => __('Do not miss http://','SimpleKey')
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_config_target",
         "heading" => __("Link Target","SimpleKey"),
         "param_name" => "target",
         "value" => array('_self','_blank'),
         "description" => __("Open the link in new tab/window or not, select '_blank' - open in new window, select '_self' - open in same window","SimpleKey")
      ),
	  
	  array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "wpb_config_image",
         "heading" => __("Upload Icon","SimpleKey"),
         "param_name" => "image",
         "value" =>  "",
         "description" => __('Recommend the double size of your icon for the retina device.','SimpleKey')
      ),
	  
	  array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "wpb_config_content",
         "heading" => __("Feature Content","SimpleKey"),
         "param_name" => "content",
         "value" =>  "",
         "description" => __('HTML tags supported','SimpleKey')
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "custom_hide_field",
         "heading" => __("CSS Animation","focux"),
         "param_name" => "css_animation",
		 "value" => array(
		  'no'=>'',
		  'Top to bottom'=>'top-to-bottom',
		  'Bottom to top'=>'bottom-to-top',
		  'Left to right'=>'left-to-right',
		  'Right to left'=>'right-to-left',
		  'Appear from center'=>'appear'
		 ),
         "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.","SimpleKey")
      ),
	  
   )
) );
?>