<?php 
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file includes the function to create / control the backoffice  
	*	---------------------------------------------------------------------
	*/

	// sidebar inclusion
	include_once('function/gdlr-sidebar-generator.php');
	
	// admin panel template
	include_once('function/gdlr-admin-panel.php');	
	include_once('function/gdlr-admin-panel-html.php');	
	
	// gdlr customizaer
	include_once('function/gdlr-customizer.php');	
	
	// page builder template
	include_once('function/gdlr-page-builder.php');	
	include_once('function/gdlr-page-builder-html.php');	
	
	// page option template
	include_once('function/gdlr-page-options.php');	

	// taxonomy meta option
	include_once('function/gdlr-tax-meta.php');		
	
	// include frontend script when necessary
	include_once('function/gdlr-include-script.php');	
	
	// font controller
	include_once('function/gdlr-font-loader.php');
	
	// Add file extension font with mime type 'mime/type'
	add_filter('upload_mimes', 'gdlr_custom_upload_mimes');
	if( !function_exists('gdlr_custom_upload_mimes') ){
		function gdlr_custom_upload_mimes ( $existing_mimes = array() ) {
			$existing_mimes['ttf'] = 'application/x-font-ttf';
			$existing_mimes['otf'] = 'application/x-font-opentyp'; 
			$existing_mimes['eot'] = 'application/vnd.ms-fontobject'; 
			$existing_mimes['woff'] = 'application/font-woff'; 
			$existing_mimes['svg'] = 'image/svg+xml'; 

			return $existing_mimes;
		}
	}
	
	if( !function_exists('gdlr_stripslashes') ){
		function gdlr_stripslashes($value){
			$value = is_array($value) ?
						array_map('stripslashes_deep', $value) : 
						stripslashes($value);
						
			return $value;
		}
	}
	
	if( !function_exists('gdlr_preventslashes') ){
		function gdlr_preventslashes($value){
			$value = str_replace('\\\\\\\\\\\\\"', '|gq6|', $value);
			$value = str_replace('\\\\\\\\\\\"', '|gq5|', $value);
			$value = str_replace('\\\\\\\\\"', '|gq4|', $value);
			$value = str_replace('\\\\\\\"', '|gq3|', $value);
			$value = str_replace('\\\\\"', '|gq2|', $value);
			$value = str_replace('\\\"', '|gq"|', $value);
			$value = str_replace('\\\\\\t', '|g2t|', $value);
			$value = str_replace('\\\\t', '|g1t|', $value);			
			$value = str_replace('\\\\\\n', '|g2n|', $value);
			$value = str_replace('\\\\n', '|g1n|', $value);
			return $value;
		}
	}
	
	if( !function_exists('gdlr_decode_preventslashes') ){
		function gdlr_decode_preventslashes($value){
			$value = str_replace('|gq6|', '\\\\\\"', $value);
			$value = str_replace('|gq5|', '\\\\\"', $value);
			$value = str_replace('|gq4|', '\\\\"', $value);
			$value = str_replace('|gq3|', '\\\"', $value);
			$value = str_replace('|gq2|', '\\"', $value);
			$value = str_replace('|gq"|', '\"', $value);
			$value = str_replace('|g2t|', '\\\t', $value);
			$value = str_replace('|g1t|', '\t', $value);			
			$value = str_replace('|g2n|', '\\\n', $value);
			$value = str_replace('|g1n|', '\n', $value);
			return $value;
		}
	}	

?>