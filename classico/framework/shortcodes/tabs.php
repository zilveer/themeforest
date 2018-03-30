<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

add_action( 'init', 'et_register_vc_vc_tabs');
if(!function_exists('et_register_vc_vc_tabs')) {
	function et_register_vc_vc_tabs() {
		if(!function_exists('vc_map')) return;
	    $tab_id_1 = time().'-1-'.rand(0, 100);
	    $tab_id_2 = time().'-2-'.rand(0, 100);
	    $setting_vc_tabs = array(
	        array(
	          "type" => "dropdown",
	          "heading" => __("Tabs type", "js_composer"),
	          "param_name" => "type",
	          "value" => array(__("Default", "js_composer") => '', 
	              __("Products Tabs", "js_composer") => 'products-tabs', 
	              __("Left bar", "js_composer") => 'left-bar', 
	              __("Right bar", "js_composer") => 'right-bar')
	        ),
	    );
	    vc_add_params('vc_tabs', $setting_vc_tabs);

	    vc_map( array(
	      "name" => __("Tab", "js_composer"),
	      "base" => "vc_tab",
	      "allowed_container_element" => 'vc_row',
	      "is_container" => true,
	      "content_element" => false,
	      "params" => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", "js_composer"),
	          "param_name" => "title",
	          "description" => __("Tab title.", "js_composer")
	        ),
	        array(
	          'type' => 'icon',
	          "heading" => __("Icon", ET_DOMAIN),
	          "param_name" => "icon"
	        ),
	        array(
	          "type" => "tab_id",
	          "heading" => __("Tab ID", "js_composer"),
	          "param_name" => "tab_id"
	        )
	      ),
	      'js_view' => 'VcTabView'
	    ) );
	}
}
