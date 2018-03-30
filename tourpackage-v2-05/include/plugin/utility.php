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
	function find_xml_value($xml, $field, $translate = true, $return = ''){
		if(!empty($xml)){
			foreach($xml->childNodes as $xmlChild){
				if($xmlChild->nodeName == $field){
					if( is_admin() || !$translate ){
						return $xmlChild->nodeValue;
					}else{
						return __($xmlChild->nodeValue, 'gdl_front_end');
					}
				}
			}
		}
		
		return $return;
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
		$exclude_array = array('Footer 1', 'Footer 2', 'Footer 3', 'Footer 4', 'Site Map 1', 'Site Map 2', 'Site Map 3');
		
		$sidebar_all = array();
		
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			if( !in_array( $sidebar['name'] , $exclude_array ) ){
				$sidebar_all[] = $sidebar['name'];
			}
		}		

		return $sidebar_all;
	}	
	
	// get width and height from string WIDTHxHEIGHT
	function gdl_get_width( $size ){
		$size_array = explode('x', $size);
		if( !empty($size_array[0]) ) return $size_array[0];
		return '';
	}
	function gdl_get_height( $size ){
		$size_array = explode('x', $size);
		if( !empty($size_array[1]) ) return $size_array[1];
		return '';
	}
	
	// use ajax to print all of media image for using with slider selection
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
		echo '</div><div class=clear></div>';
	
		echo '<ul>';
		foreach( $media_query->posts as $image ){ 
		
			$thumb_src = wp_get_attachment_image_src( $image->ID, 'thumbnail');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, 'thumbnail');
			echo '<li><img src="' . $thumb_src[0] .'" title="' . $image->post_title . '" attid="' . $image->ID . '" rel="' . $thumb_src_preview[0] . '"/></li>';
		
		}
		echo '</ul><div class=clear></div>';
		
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
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'hide_empty' => 0	));
			
			$category_list = array( '0' =>'All');
			if( !empty($get_category) ){
				foreach( $get_category as $category ){
					$category_list[] = urldecode($category->slug);
				}
			}
				
			return $category_list;
		}else{
			$parent_id = get_term_by('slug', $parent, $category_name);
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id, 'hide_empty' => 0	));
			$category_list = array( '0' => $parent );
			
			if( !empty($get_category) ){
				foreach( $get_category as $category ){
					$category_list[] = urldecode($category->slug);
				}
			}
				
			return $category_list;		
		}
	}
	
	// return the slug list of each post
	function get_post_slug_list( $post_type ){
		
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		$posts_title = array();
		foreach ($posts as $post) {
			$posts_title[] = urldecode($post->post_name);
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
	
	// cut excerpt by word or character
	function gdl_get_excerpt( $charlength = 180, $postscript = '', $excerpt_text = ''){
		global $gdl_word_excerpt;
		
		if( $charlength == 0 ) return;
		if( empty($excerpt_text) ){
			if( $gdl_word_excerpt ){
				$excerpt = get_the_excerpt();
				$charlength++;

				if ( strlen( $excerpt ) > $charlength ) {
					$subex = mb_substr( $excerpt, 0, $charlength - 5 );
					$exwords = explode( ' ', $subex );
					$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
					if ( $excut < 0 ) {
						return mb_substr( $subex, 0, $excut - 1 ) . $postscript;
					} else {
						return mb_substr( $subex, 0, -1 ) . $postscript;
					}
				} else {
					return $excerpt;
				}
			}else{
				return mb_substr( get_the_excerpt(), 0, $charlength );	
			}
		}else{
			$excerpt = $excerpt_text;
			$charlength++;

			if ( strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					return mb_substr( $subex, 0, $excut - 1 ) . $postscript;
				} else {
					return mb_substr( $subex, 0, -1 ) . $postscript;
				}
			} else {
				return $excerpt;
			}	
		}
	}	
	
	function gdl_hex_lighter($hex, $factor = 40) { 
		$new_hex = ''; 
		 
		$base['R'] = hexdec($hex{1}.$hex{2}); 
		$base['G'] = hexdec($hex{3}.$hex{4}); 
		$base['B'] = hexdec($hex{5}.$hex{6}); 
		 
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
			 
		return '#' . $new_hex;     
	} 
	
	function gdl_hex_darker($hex, $factor = 30){
        $new_hex = '';
        
        $base['R'] = hexdec($hex{1}.$hex{2});
        $base['G'] = hexdec($hex{3}.$hex{4});
        $base['B'] = hexdec($hex{5}.$hex{6});
        
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
                
        return '#' . $new_hex;        
    }	
	
?>