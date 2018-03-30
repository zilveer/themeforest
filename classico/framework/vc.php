<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

if( ! function_exists('vc_remove_element')) return;

add_action( 'init', 'etheme_VC_setup');

if(!function_exists('etheme_VC_setup')) {
	function etheme_VC_setup() {
		vc_remove_element("vc_tour");
	}
}