<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! row
// **********************************************************************// 

// **********************************************************************// 
// ! Register New Element: row
// **********************************************************************//
add_action( 'init', 'et_register_vc_row');
if(!function_exists('et_register_vc_row')) {
	function et_register_vc_row() {
		if(!function_exists('vc_map')) return;
	    // **********************************************************************// 
	    // ! Row (add anchor field)
	    // **********************************************************************//
	    vc_add_param('vc_row', array(
			'type' => 'textfield',
			'heading' => __( 'Anchor for one page navigation', 'js_composer' ),
			'param_name' => 'anchor',
	    ));
	}
}
