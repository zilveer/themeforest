<?php
vc_map( array(
   "name" => __("SimpleKey Quote","SimpleKey"),
   "base" => "quote",
   "class" => "wpb_quote",
   "icon" =>"icon-wpb-quote",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('You can use it to display the testimonials.','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "wpb_quota_avatar",
         "heading" => __("Client Avatar","SimpleKey"),
         "param_name" => "avatar",
         "value" =>  ""
      ),
	  
	  array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "wpb_quote_content",
         "heading" => __("Quote Content","SimpleKey"),
         "param_name" => "content",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_quote_name",
         "heading" => __("Client Name","SimpleKey"),
         "param_name" => "via",
         "value" =>  ""
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