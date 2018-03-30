<?php
vc_map( array(
   "name" => __("SimpleKey Blog Grid","SimpleKey"),
   "base" => "blog_grid",
   "class" => "wpb_blog_grid",
   "icon" =>"icon-wpb-blog_grid",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Display the Blog as Gridview','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_blog_number",
         "heading" => __("Posts Number","SimpleKey"),
         "param_name" => "number",
         "value" =>  "6"
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
         "class" => "wpb_blog_open hide",
         "heading" => __("Open Method","SimpleKey"),
         "param_name" => "open",
         "value" =>  array("ajax","normal")
      ),
	  
	  array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_orderby hide",
         "heading" => __("Order the posts By","SimpleKey"),
         "param_name" => "orderby",
         "value" =>  array("date","rand")
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_intro hide",
         "heading" => __("Show the Excerpt? none","SimpleKey"),
         "param_name" => "intro",
         "value" =>  array("Yes","No")
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_columns hide",
         "heading" => __("Grid Columns","SimpleKey"),
         "param_name" => "col",
         "value" =>  array("3","4","5")
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_filter hide",
         "heading" => __("Show the Filter?","SimpleKey"),
         "param_name" => "filter",
         "value" =>  array("Yes","No")
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_blog_filter_inverse hide",
         "heading" => __("Inverse the Filter Color?","SimpleKey"),
         "param_name" => "inverse",
         "value" =>  array("Yes","No")
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