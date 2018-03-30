<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Posts carousel
// **********************************************************************// 


// **********************************************************************// 
// ! Update element: Posts carousel
// **********************************************************************//
add_action( 'init', 'et_register_vc_carousel');
if(!function_exists('et_register_vc_carousel')) {
	function et_register_vc_carousel() {
		if(!function_exists('vc_map')) return;

        vc_add_param( 'vc_basic_grid', array(
            'type' => 'dropdown',
            'heading' => __( 'Posts design', 'js_composer' ),
            'param_name' => 'design',
            'value' => array( 
                __( 'Default', 'js_composer' ) => 'default', 
                __( 'Design 1', 'js_composer' ) => '1', 
                __( 'Design 2', 'js_composer' ) => '2', 
                __( 'Design 3', 'js_composer' ) => '3', 
                __( 'Design 3', 'js_composer' ) => '3' 
            )
        ) ); 


	}
}
