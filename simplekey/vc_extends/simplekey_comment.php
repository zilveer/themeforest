<?php
vc_map( array(
   "name" => __("SimpleKey Comment List","SimpleKey"),
   "base" => "comments",
   "class" => "wpb_comment_list",
   "icon" =>"icon-wpb-post-list",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Display the Recent Comment List','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_comment_number",
         "heading" => __("Comment Number","SimpleKey"),
         "param_name" => "number",
         "value" =>  "5"
      )
      	  
   )
) );
?>