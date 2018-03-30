<?php
vc_map( array(
   "name" => __("SimpleKey Post List","SimpleKey"),
   "base" => "post_list",
   "class" => "wpb_post_list",
   "icon" =>"icon-wpb-post-list",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Display the Post Title List','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_post_list_number hide",
         "heading" => __("Posts Number","SimpleKey"),
         "param_name" => "number",
         "value" =>  "5"
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_post_list_category",
         "heading" => __("From Which Categories?","SimpleKey"),
         "param_name" => "category",
         "description" => __('Just add the category slugs and separate them with English comma. If you leave it empty, it will display all the posts.','SimpleKey'),
         "value" => "",
      ),
      	  
	  array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_post_list_thumbnail hide",
         "heading" => __("Show the Thumbnail","SimpleKey"),
         "param_name" => "thumbnail",
         "value" =>  array("Yes","No")
      )
      	  
   )
) );
?>