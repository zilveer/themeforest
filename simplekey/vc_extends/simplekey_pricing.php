<?php
vc_map( array(
   "name" => __("SimpleKey Pricing","SimpleKey"),
   "base" => "pricing",
   "class" => "wpb_pricing",
   "icon" =>"icon-wpb-pricing",
   "category" => __('SimpleKey',"SimpleKey"),
   "description" => __('Create pricing table for your service or product','SimpleKey'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extends/vc_extends.js'),
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extends/vc_extends.css'),
   'custom_markup'=>'',
   "params" => array(
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_pricing_name",
         "heading" => __("Plan Name","SimpleKey"),
         "param_name" => "name",
         "value" =>  ""
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_pricing_plan",
         "heading" => __("Plan Number","SimpleKey"),
         "param_name" => "plan",
         "value" => array('1','2','3','4'),
      ),
      
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_pricing_currency",
         "heading" => __("Currency","SimpleKey"),
         "param_name" => "currency",
         "value" =>  "$"
      ),
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_pricing_price",
         "heading" => __("Price","SimpleKey"),
         "param_name" => "price",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_quote_cycle",
         "heading" => __("Payment Cycle","SimpleKey"),
         "param_name" => "cycle",
         "value" =>  "/month"
      ),
      
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "wpb_pricing_content",
         "heading" => __("Plan Details","SimpleKey"),
         "param_name" => "content",
         "value" =>  "<li>Add the detail items in the LI tag</li>
         <li>Add the detail items in the LI tag</li>"
      ),
      
       array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_pricing_button_text",
         "heading" => __("Button Text","SimpleKey"),
         "param_name" => "linktext",
         "value" =>  ""
      ),
      
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "wpb_pricing_link hide",
         "heading" => __("Button Link","SimpleKey"),
         "param_name" => "link",
         "value" =>  ""
      ),
      
      array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "wpb_pricing_target hide",
         "heading" => __("Link Target","SimpleKey"),
         "param_name" => "target",
         "value" => array('_self','_blank'),
         "description" => __("Open the link in new tab/window or not, select '_blank' - open in new window, select '_self' - open in same window","SimpleKey")
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