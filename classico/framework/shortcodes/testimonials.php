<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');


// **********************************************************************// 
// ! Register New Element: Testimonials Widget
// **********************************************************************//
add_action( 'init', 'et_register_vc_testimonials');
if(!function_exists('et_register_vc_testimonials')) {
	function et_register_vc_testimonials() {
		if(!function_exists('vc_map')) return;
	    $testimonials_params = array(
	      'name' => 'Testimonials widget',
	      'base' => 'testimonials',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Limit", ET_DOMAIN),
	          "param_name" => "limit",
	          "description" => __('How many testimonials to show? Enter number.', ET_DOMAIN)
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Display type", "js_composer"),
	          "param_name" => "type",
	          "value" => array( 
	              "", 
	              __("Slider", ET_DOMAIN) => 'slider',
	              __("Grid", ET_DOMAIN) => 'grid'
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Interval", ET_DOMAIN),
	          "param_name" => "interval",
	          "description" => __('Interval between slides. In milliseconds. Default: 10000', ET_DOMAIN),
	          "dependency" => Array('element' => "type", 'value' => array('slider'))
	        ),
	        array(
	          "type" => "dropdown",
	          "heading" => __("Show Control Navigation", "js_composer"),
	          "param_name" => "navigation",
	          "dependency" => Array('element' => "type", 'value' => array('slider')),
	          "value" => array( 
	              "", 
	              __("Hide", ET_DOMAIN) => false,
	              __("Show", ET_DOMAIN) => true
	            )
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Category", ET_DOMAIN),
	          "param_name" => "category",
	          "description" => __('Display testimonials from category.', ET_DOMAIN)
	        ),
	      )
	
	    );  
	
	    vc_map($testimonials_params);
	}
}