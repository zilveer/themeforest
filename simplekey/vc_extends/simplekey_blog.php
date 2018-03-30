<?php
vc_map( array(
   "name" => __("SimpleKey Blog","SimpleKey"),
   "base" => "blog",
   "class" => "wpb_blog",
   "icon" =>"icon-wpb-blog",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Display the Blog Archive','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_blog_number hide",
         "heading" => __("Posts Number","SimpleKey"),
         "param_name" => "number",
         "value" =>  "5"
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_blog_category",
         "heading" => __("From Which Categories?","SimpleKey"),
         "param_name" => "category",
         "description" => __('Just add the category slugs and separate them with English comma. If you leave it empty, it will display all the posts.','SimpleKey'),
         "value" => "",
      ),
      	  
	  array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_thumbnail hide",
         "heading" => __("Show the Thumbnail","SimpleKey"),
         "param_name" => "thumbnail",
         "value" =>  array("Yes","No")
      ),
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_grid hide",
         "heading" => __("Show it as Grid Layout","SimpleKey"),
         "param_name" => "gridview",
         "value" =>  array("No","Yes")
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