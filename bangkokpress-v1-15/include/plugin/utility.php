<?php

	/*
	*	Goodlayers Utility File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains all of the necessary function for the front-end and
	*	back-end to use. You can see the description of each function below.
	*	---------------------------------------------------------------------
	*/

	// Find the XML value from XML Object
	function find_xml_value($xml, $field){
	
		if(!empty($xml)){
		
			foreach($xml->childNodes as $xmlChild){
			
				if($xmlChild->nodeName == $field){
					if( is_admin() ){
						return $xmlChild->nodeValue;
					}else{
						return __($xmlChild->nodeValue, 'gdl_front_end');
					}
				}
				
			}
			
		}
		
		return '';
		
	}
	
	// Find the XML node from XML Object
	function find_xml_node($xml, $node){
	
		if(!empty($xml)){
		
			foreach($xml->childNodes as $xmlChild){
			
				if($xmlChild->nodeName == $node){
				
					return $xmlChild;
					
				}
				
			}
			
		}
		
		return '';
		
	}
	
	// Create tag string from nodename and value
	function create_xml_tag($node, $value){
	
		return '<' . $node . '>' . $value . '</' . $node . '>';
		
	}
	
	// Get array of sidebar name
	function get_sidebar_name(){
	
		global $gdl_sidebar;
		$sidebar = array();
		
		if(!empty($gdl_sidebar)){
		
			$xml = new DOMDocument();
			$xml->loadXML($gdl_sidebar);
			
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
			
				$sidebar[] = $sidebar_name->nodeValue;
				
			}
			
		}
		
		return $sidebar;
		
	}
	
	// get width and height from string WIDTHxHEIGHT
	function gdl_get_width( $size ){
		$size_array = explode('x', $size);
		return $size_array[0];
	}
	function gdl_get_height( $size ){
		$size_array = explode('x', $size);
		return $size_array[1];
	}
	
	// use ajax to print all of media image
	add_action('wp_ajax_get_media_image','get_media_image');
	function get_media_image(){
	
		$image_width = 70;
		$image_height = 70;
		
		$paged = (isset($_POST['page']))? $_POST['page'] : 1; 	
		if($paged == ''){ $paged = 1; }
		
		$statement = array('post_type' => 'attachment',
			'post_mime_type' =>'image',
			'post_status' => 'inherit', 
			'posts_per_page' => 12,
			'paged' => $paged);
		$media_query = new WP_Query($statement);
	
		?>
		
		<div class="media-title">
			<label><?php _e('SELECT MEDIA','gdl_back_office'); ?></label>
		</div>
		
		<?php
		
		echo '<div class="media-gallery-nav" id="media-gallery-nav">';
		echo '<ul>';
		echo '<a><li class="nav-first" rel="1" ></li></a>';
		
		for( $i=1 ; $i<=$media_query->max_num_pages; $i++){
		
			if($i == $paged){
				echo '<li rel="' . $i . '">' . $i . '</li>';
			}else if( ($i <= $paged+2 && $i >= $paged-2) || $i%10 == 0){
				echo '<a><li rel="' . $i . '">' . $i . '</li></a>';		
			}
			
		}
		echo '<a><li class="nav-last" rel="' . $media_query->max_num_pages . '"></li></a>';
		echo '</ul>';
		echo '</div><br class=clear>';
	
		echo '<ul>';
		
		foreach( $media_query->posts as $image ){ 
		
			$thumb_src = wp_get_attachment_image_src( $image->ID, '150x150');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, '160x110');
			echo '<li><img src="' . $thumb_src[0] .'" attid="' . $image->ID . '" rel="' . $thumb_src_preview[0] . '"/></li>';
		
		}
		
		echo '</ul><br class=clear>';
		
		if(isset($_POST['page'])){ die(''); }
	}
	
	// return the slider option array to use with javascript file
	function get_gdl_slider_option_array($slider_option){
	
		$slider_setting = array();
	
		foreach($slider_option as $value){
			
			$set_value = get_option($value['name']);
			
			if(isset($value['oldname']) && $set_value){
			
				$slider_setting[$value['oldname']] = $set_value;
			
			}
		}
		
		return $slider_setting;
	}
	

	// return the array of category
	function get_category_list( $category_name, $parent='' ){
		
		if( empty($parent) ){ 
		
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' =>'All');
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;
			
		}else{
			
			$parent_id = get_term_by('name', $parent, $category_name);
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
			$category_list = array( '0' => $parent );
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;		
		
		}
	}
	
	// return the title list of each post_type
	function get_title_list( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_title;
		}
		
		return $posts_title;
	
	}

	// return the title id of each category (in post)
	function get_post_title_id( $category ){
		
		$posts_title = array();
		$posts = get_posts(array('category_name' => $category, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->ID;
		}
		
		return $posts_title;
	
	}
	
	// send contact form email
	add_action('wp_ajax_submit_contact_form','gdl_submit_contact_form');
	add_action('wp_ajax_nopriv_submit_contact_form','gdl_submit_contact_form');
	function gdl_submit_contact_form(){

		global $gdl_admin_translator;
		
		if( $gdl_admin_translator == 'enable' ){
			$gdl_send_complete = get_option(THEME_SHORT_NAME.'_translator_contact_send_complete', 'The e-mail was sent successfully');
			$gdl_send_error = get_option(THEME_SHORT_NAME.'_translator_contact_send_error', 'Message cannot be sent to destination');
		}else{
			$gdl_send_complete = __('The e-mail was sent successfully','gdl_front_end');
			$gdl_send_error =  __('Message cannot be sent to destination','gdl_front_end');
		}	
		
		$return_data = array('success'=>'0');
		
		if(empty($_POST)){
			$return_data['value'] = 'Cannot send email to destination. No parameter receive form AJAX call.';	
			die ( json_encode($return_data) );
		}
		
		$name = $_POST['name'];		
		if(empty($name)){
			$return_data['value'] = 'Please enter your name.';
			die ( json_encode($return_data) );
		}
		
		$email = $_POST['email'];
		if(empty($email)){
			$return_data['value'] = 'Please enter a valid email address.';
			die ( json_encode($return_data) );		
		}
		
		$message = $_POST['message'];
		if(empty($message)){ 
			$return_data['value'] = 'Please enter message.';
			die ( json_encode($return_data) );				
		}
		
		$receiver = $_POST['receiver'];
		
		$messages = "You have received a new contact form message. \n";
		$messages = $messages . 'Name : ' . $name . " \n";
		$messages = $messages . 'Email : ' . $email . " \n";
		$messages = $messages . 'Message : ' . $message;
		
		$header = "From: " . $name . "<" . $email . "> \r\n";
		$header = $header . "Reply-To: " . $receiver . " \r\n";
		$header = $header . 'Content-Type: text/plain; charset=UTF-8 ' . " \r\n";
		
		if( wp_mail($receiver, 'New contact form received', $messages, $header) ){
			$return_data['success'] = '1';
			$return_data['value'] = $gdl_send_complete;
			die( json_encode($return_data) );
		}else{
			$return_data['value'] = $gdl_send_error;
			die( json_encode($return_data) );	
		}
		
	}
	
	add_action('wp_ajax_load_dummy_data','gdl_load_dummy_data');
	function gdl_load_dummy_data(){
		
		require_once ABSPATH . 'wp-admin/includes/import.php';
		
		$import_path = TEMPLATEPATH . "/include/plugin/dummy-data.xml";
		$import_error = false;
		
		//check if wp_importer, the base importer class is available, otherwise include it
		if ( !class_exists( 'WP_Importer' ) ) {
		
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ){
				require_once($class_wp_importer);
			}else{
				$avia_importerError = true;
			}
			
		}		

		die('1');
		
	}
	
	function hexLighter($hex,$factor = 80) { 
		$new_hex = ''; 
		 
		$base['R'] = hexdec($hex{0}.$hex{1}); 
		$base['G'] = hexdec($hex{2}.$hex{3}); 
		$base['B'] = hexdec($hex{4}.$hex{5}); 
		 
		foreach ($base as $k => $v) 
			{ 
			$amount = 255 - $v; 
			$amount = $amount / 100; 
			$amount = round($amount * $factor); 
			$new_decimal = $v + $amount; 
		 
			$new_hex_component = dechex($new_decimal); 
			if(strlen($new_hex_component) < 2) 
				{ $new_hex_component = "0".$new_hex_component; } 
			$new_hex .= $new_hex_component; 
			} 
			 
		return $new_hex;     
	} 
	
	function hexDarker($hex,$factor = 30){
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
    }
	
