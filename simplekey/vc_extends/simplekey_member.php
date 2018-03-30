<?php
vc_map( array(
   "name" => __("SimpleKey Member","SimpleKey"),
   "base" => "member",
   "class" => "wpb_member",
   "icon" =>"icon-wpb-member",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('List the member information for your team','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_name",
         "heading" => __("Member Name","SimpleKey"),
         "param_name" => "name",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_job",
         "heading" => __("Job Position","SimpleKey"),
         "param_name" => "job",
         "value" => "",
      ),
      	  
	  array(
         "type" => "attach_image",
         "holder" => "div",
         "class" => "wpb_member_avatar",
         "heading" => __("Member Avatar","SimpleKey"),
         "param_name" => "avatar",
         "value" =>  ""
      ),
	  
	  array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_member_hover",
         "heading" => __("Avatar Hover Effect","SimpleKey"),
         "param_name" => "hover",
         "value" =>  array("on","off")
      ),
      
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "wpb_member_intro",
         "heading" => __("Short Introduction","SimpleKey"),
         "param_name" => "content",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_facebook",
         "heading" => __("Facebook URL","SimpleKey"),
         "param_name" => "facebook",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_twitter",
         "heading" => __("Twitter URL","SimpleKey"),
         "param_name" => "twitter",
         "value" =>  ""
      ),
      
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_dribbble",
         "heading" => __("Dribbble URL","SimpleKey"),
         "param_name" => "dribbble",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_linkedin",
         "heading" => __("LinkedIn URL","SimpleKey"),
         "param_name" => "linkedin",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_flickr",
         "heading" => __("Flickr URL","SimpleKey"),
         "param_name" => "flickr",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_googleplus",
         "heading" => __("Google+ URL","SimpleKey"),
         "param_name" => "googleplus",
         "value" =>  ""
      ),
      
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_behance",
         "heading" => __("Behance URL","SimpleKey"),
         "param_name" => "behance",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_pinterest",
         "heading" => __("Pinterest URL","SimpleKey"),
         "param_name" => "pinterest",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_soundcloud",
         "heading" => __("Soundcloud URL","SimpleKey"),
         "param_name" => "soundcloud",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_hearthis",
         "heading" => __("Hearthis URL","SimpleKey"),
         "param_name" => "hearthis",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_member_social wpb_member_instagram",
         "heading" => __("Instagram URL","SimpleKey"),
         "param_name" => "instagram",
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