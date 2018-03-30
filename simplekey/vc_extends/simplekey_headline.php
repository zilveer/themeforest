<?php
vc_map( array(
   "name" => __("SimpleKey Headline","SimpleKey"),
   "base" => "headline",
   "class" => "wpb_headline",
   "icon" =>"icon-wpb-headline",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('You can add the headline anywhere','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_headline_title",
         "heading" => __("Title","SimpleKey"),
         "param_name" => "title",
         "description" => __('You can use strong HTML tag to make it bold','SimpleKey'),
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_headline_desc",
         "heading" => __("Tagline","SimpleKey"),
         "param_name" => "desc",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_headline_top hide",
         "heading" => __("Top Space","SimpleKey"),
         "param_name" => "top",
         "description" => __('For example, 10px, 5em or 10%','SimpleKey'),
         "value" =>  ""
      ),
      
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_headline_bottom hide",
         "heading" => __("Bottom Space","SimpleKey"),
         "param_name" => "bottom",
         "description" => __('For example, 10px, 5em or 10%','SimpleKey'),
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