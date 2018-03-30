<?php
vc_map( array(
   "name" => __("SimpleKey Social Media","SimpleKey"),
   "base" => "social_icon",
   "class" => "wpb_social",
   "icon" =>"icon-wpb-social",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Display The Social Icons','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_facebook hide",
         "heading" => __("Facebook URL","SimpleKey"),
         "param_name" => "facebook",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_twitter hide",
         "heading" => __("Twitter URL","SimpleKey"),
         "param_name" => "twitter",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_dribbble hide",
         "heading" => __("Dribbble URL","SimpleKey"),
         "param_name" => "dribbble",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_flickr hide",
         "heading" => __("Flickr URL","SimpleKey"),
         "param_name" => "flickr",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_googleplus hide",
         "heading" => __("Google+ URL","SimpleKey"),
         "param_name" => "googleplus",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_linkedin hide",
         "heading" => __("LinkedIn Profile","SimpleKey"),
         "param_name" => "linkedin",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_soundcloud hide",
         "heading" => __("SoundCloud Profile","SimpleKey"),
         "param_name" => "soundcloud",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_hearthis hide",
         "heading" => __("Hearthis Profile","SimpleKey"),
         "param_name" => "hearthis",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_blogger hide",
         "heading" => __("Blogger Link","SimpleKey"),
         "param_name" => "blogger",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_tumblr hide",
         "heading" => __("Tumblr URL","SimpleKey"),
         "param_name" => "tumblr",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_deviantart hide",
         "heading" => __("Deviantart URL","SimpleKey"),
         "param_name" => "deviantart",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_behance hide",
         "heading" => __("Behance URL","SimpleKey"),
         "param_name" => "behance",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_pinterest hide",
         "heading" => __("Pinterest URL","SimpleKey"),
         "param_name" => "pinterest",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_youtube hide",
         "heading" => __("Youtube URL","SimpleKey"),
         "param_name" => "youtube",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_vimeo hide",
         "heading" => __("Vimeo URL","SimpleKey"),
         "param_name" => "vimeo",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_myspace hide",
         "heading" => __("Myspace URL","SimpleKey"),
         "param_name" => "myspace",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_myemail hide",
         "heading" => __("Email Address","SimpleKey"),
         "param_name" => "myemail",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_instagram hide",
         "heading" => __("Instagram URL","SimpleKey"),
         "param_name" => "instagram",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_meetup hide",
         "heading" => __("Meetup URL","SimpleKey"),
         "param_name" => "meetup",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_xing hide",
         "heading" => __("Xing URL","SimpleKey"),
         "param_name" => "xing",
         "value" =>  ""
      ),
      	  
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_klout hide",
         "heading" => __("Klout URL","SimpleKey"),
         "param_name" => "klout",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_vk hide",
         "heading" => __("VK URL","SimpleKey"),
         "param_name" => "vk",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_yelp hide",
         "heading" => __("Yelp URL","SimpleKey"),
         "param_name" => "yelp",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_social_rss hide",
         "heading" => __("RSS URL","SimpleKey"),
         "param_name" => "rss",
         "value" =>  ""
      ),
   )
) );
?>