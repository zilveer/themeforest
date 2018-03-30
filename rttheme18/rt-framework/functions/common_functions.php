<?php
#-----------------------------------------
#	RT-Theme common_functions.php
#	version: 1.1
#-----------------------------------------

#
# Check a file exists in the child theme from path 
# @return file url
#
function rt_locate_media_file( $file_path ){
	if ( is_child_theme() ){
		$child_file_path = get_stylesheet_directory() . $file_path ; 

		if ( file_exists( $child_file_path ) ){
			$file_url = get_stylesheet_directory_uri() . $file_path ; 
		}else{
			$file_url = RT_THEMEURI . $file_path ; 
		}
	}else{
		$file_url = RT_THEMEURI . $file_path ; 
	}

	return $file_url;
}

#
# find vimeo and youtube id from url
#
function rt_find_tube_video_id($url){
	$tubeID="";

	if( strpos($url, 'youtube') || strpos($url, 'youtu.be')  ) {	
		$tubeID=parse_url($url);		

		isset( $tubeID['path'] ) && strpos($url, 'http://youtu.be') 
			and $tubeID=str_replace("/", "", $tubeID['path']);	

		isset( $tubeID['query'] ) 
			and parse_str($tubeID['query'], $url_parts);

		isset( $url_parts ) && is_array( $url_parts ) 
			and $tubeID=$url_parts["v"];
	}
	
	if( strpos($url, 'vimeo')  ) {
		$tubeID=parse_url($url, PHP_URL_PATH);			
		$tubeID=str_replace("/", "", $tubeID);	
	}	


	if( is_string( $tubeID ) ) return $tubeID;
}

#
# Check layer slider
#

function rt_check_layer_slider() { 
	if( function_exists( "layerslider_load_lang" ) || function_exists( "layerslider_activation_scripts" ) || function_exists( "layerslider_new_site" ) ) {
		return true;
	}else{
		return false;
	}
}

#
# layer slider slides list 
#
function rt_layer_slider_list() { 

	$get_layer_slider_list = array();

	if( function_exists( "lsSliders" ) ){
		$sliders = lsSliders(200, false, true); 

		if ( rt_check_layer_slider() ){
			if( is_array( $sliders ) ){
				foreach ($sliders as $key => $value) { 
					$get_layer_slider_list[$value["id"]] = $value["name"];  
				}		
			}
		}
	}else{
		$get_layer_slider_list[0] = "Layer Slider has not been installed or activated!";
	}

	return $get_layer_slider_list;		
}

#
# layer revslider slides list 
#

function rt_rev_slider_list() { 
	global $wpdb,$table_prefix;
	
	$get_rev_slider_list = array();

	if( class_exists( "RevSlider" ) ){

		$table_name = $wpdb->prefix . "revslider_sliders";
		
		$revslider_sliders = $wpdb->get_results( "SELECT title,alias FROM $table_name" );

		if( isset( $revslider_sliders ) ){
			foreach ($revslider_sliders as $key => $value) {
				$get_rev_slider_list[ $value->alias ] = $value->title;   
			}
		}
	}else{
		$get_rev_slider_list[0] = "Slider Revolution has not been installed or activated!";		
	}

	return $get_rev_slider_list;
}

#
# returns a post ID from a url
#

function rt_get_attachment_id_from_src ($image_src) { 
	global $wpdb; 

	// fix demo image urls http://rttheme18.demo-rt.com/wp-content/uploads/	 
	$upload_dir = wp_upload_dir(); 
	$image_src = str_replace(RT_DEMOUPLOADSDIR, $upload_dir['url'], $image_src );

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id    = $wpdb->get_var($query);
	return $id; 
}

#
# find orginal image url - clean thumbnail extensions
#

function rt_clean_thumbnail_ext ($image_src) { 
	$search = '#-\d+x\d+#';  
	return preg_replace($search, "", $image_src);
}

#
# generate shortcode function
#
function rt_generate_shortcode($class,$shorcode_name=""){

	$shorcode_name = !empty( $shorcode_name ) ? $shorcode_name : $class->content_type;

	$template_shortcode ='['.$shorcode_name.' ';
	foreach ($class as $key => $value) {
		$template_shortcode  .= $key.'="'.$value.'" ';
	}

	return $template_shortcode.']';	
}


#
# Remove slashes from strings, arrays and objects
#
if( ! function_exists("rt_stripslashesFull") ){
	function rt_stripslashesFull($input){
		if (is_array($input)) {
			$input = array_map('rt_stripslashesFull', $input);
		} elseif (is_object($input)) {
			$vars = get_object_vars($input);
			foreach ($vars as $k=>$v) {
				$input->{$k} = rt_stripslashesFull($v);
			}
		} else {
			$input = stripcslashes($input);
		}
		return $input;
	}
}


