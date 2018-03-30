<?php

	/*	
	*	Goodlayers Fontloader File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file manage all fonts in this framework including Cufon and 
	*	Google font ( in google-font.php file )
	*	---------------------------------------------------------------------
	*/
	
	// all fonts array in this framework ( at first will be only cufon in the array ) 
	$all_font = array();

	// get custom upload font from the goodlayers panel
	get_uploaded_font();
	function get_uploaded_font(){
	
		global $all_font;
		global $goodlayers_element;
		$upload_font_xml = get_option($goodlayers_element['gdl_panel_upload_font']['UPLOAD FONT']['name']);
		$all_font['Custom Font'] = array('status'=>'disabled','type'=>'Cufon','is-used'=>false);
		
		if(!empty($upload_font_xml)){
		
			$xml = new DOMDocument();
			$xml->loadXML($upload_font_xml);
			
			foreach( $xml->documentElement->childNodes as $each_font ){
				$all_font[find_xml_value($each_font, 'name')] = array('status'=>'enabled','type'=>'Cufon','is-used'=>false,
					'path'=>wp_get_attachment_url(find_xml_value($each_font, 'file')) );
			}
			
		}

	}
	
	
	$all_font = array_merge($all_font, array(
		'Cufon' => array(
			'status'=>'disabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon.js'),
			
		'Aller' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Aller_400.font.js'),
			
		'Bebas' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Bebas_400.font.js'),		
			
		'Cabin Cufon' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Cabin_400.font.js'),
						
		'Cantarell Cufon' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/cantarell.js'),
			
		'Cicle Gordita' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Cicle_Gordita_700.font.js'),
			
		'Colaborate Light' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/ColaborateLight_400.font.js'),

		'Gnuolane Free' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Gnuolane_Free_400.font.js'),	
			
		'Josefin Sans Cufon' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Josefin_Sans_Std_300.font.js'),	
			
		'Luxi Serif' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Luxi_Serif_400.font.js'),
						
		'Museo Sans' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Museo_Sans_500.font.js'),
									
		'Nobile Cufon' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Nobile_400.font.js'),
									
		'Oswald Cufon' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Oswald_400.font.js'),
			
		'Quicksand Book' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Quicksand_Book_400.font.js'),
			
		'Samba' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Samba_400.font.js'),
						
		'Sansation' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Sansation_400.font.js'),
			
		'Yanone Kaffeesatz Cufon' => array(
			'status'=>'enabled',
			'type'=>'Cufon',
			'is-used'=>false,
			'path'=>GOODLAYERS_PATH.'/javascript/cufon/Yanone_Kaffeesatz_400.font.js'),
	));
	
	// get google font from file and added to all_font array
	get_google_font();
	function get_google_font(){
	
		include_once('google-font.php');
		
		global $all_font;
		$all_font['Google Font'] = array('status'=>'disabled','type'=>'Cufon','is-used'=>false);
		$google_fonts = get_google_font_array();
		
		foreach($google_fonts as $google_font){
		
			$all_font[$google_font['family']] = array('status'=>'enabled','type'=>'Google Font','is-used'=>false);
		
		}
		
	}
	
	// this is a function that return all_font arrays to use with <select> element
	function get_font_array( $type = '' ){
		global $all_font;
		$fonts = array('- default -' => '');
		
		foreach($all_font as $font_name => $font_value){
		
			if( empty($type) || $type == $font_value['type'] ){
				$fonts[$font_name] = $font_value['status'];
			}
			
		}
			
		return $fonts;
		
	}
	
	// check and marked if font is being used
	add_action('init', 'is_font_used');
	function is_font_used(){
		global $all_font, $goodlayers_element;
		
		foreach($goodlayers_element['gdl_panel_font'] as $field){
		
			$used_font = get_option($field['name']);
			
			if(!empty($used_font)){ 
			
				$used_font = substr($used_font, 2);
				
				if($used_font != "default -"){
				
					$all_font[$used_font]['is-used'] = true;
					
					if($all_font[$used_font]['type'] == 'Cufon'){
					
						$all_font['Cufon']['is-used'] = true;
						
					}else if($field['type'] == 'Google Font'){
					
						$all_font['Google Font'] = true;
						
					}
				}
				
			}
			
		}
		
		$all_font['Droid Serif']['is-used'] = true;
		
	}
	
	
	// include all used font into the website
	add_action('init', 'include_used_font');
	function include_used_font(){
		if(is_admin()) return;
		
		global $all_font;
		$google_font_family = '';
		
		foreach($all_font as $font_name => $font){
		
			if($font['is-used']){
			
				if($font['type'] == 'Cufon'){
				
					wp_deregister_script($font_name);
					if( $font_name == 'Cufon'){
						wp_register_script($font_name, $font['path'], false, '1.0', false);
					}else{
						wp_register_script($font_name, $font['path'], false, '1.0', true);
					}
					wp_enqueue_script($font_name);
					
				}else if($font['type'] == 'Google Font'){
				
					$google_font_family = $google_font_family . str_replace(' ', '+' , $font_name) . ':n,i,b,bi|';
					
				}			
				
			}
			
		}
		
		if(!empty($google_font_family)){
			wp_enqueue_style('Google-Font','http://fonts.googleapis.com/css?family=' . $google_font_family);
		}
	
	}
	
	// Ajax to include font infomation
	add_action('wp_ajax_get_gdl_font_url','get_gdl_font_url');
	function get_gdl_font_url(){
	
		global $all_font;
		$recieve_font = $_POST['font'];
		
		if($all_font[$recieve_font]['type'] == 'Cufon'){
		
			$font_url = array('type'=>$all_font[$recieve_font]['type'], 'url'=>$all_font[$recieve_font]['path']);
		
		}else if($all_font[$recieve_font]['type'] == "Google Font"){
			
			$font_url = array('type'=>$all_font[$recieve_font]['type'], 'url'=>'http://fonts.googleapis.com/css?family=' . str_replace(' ', '+' , $recieve_font));	
		
		}else{
		
			die(-1);
		
		}
		
		die(json_encode($font_url));
		
	}
	
	// Ajax to get cufon information
	add_action('wp_ajax_get_cufon_position','get_cufon_position');
	function get_cufon_position(){
	
	
	}
?>