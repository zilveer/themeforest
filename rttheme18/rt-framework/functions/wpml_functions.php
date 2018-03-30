<?php
#-----------------------------------------
#	RT-Theme wpml_functions.php 
#-----------------------------------------

#
# WPML match page id 
# returns the page of default language
# @returns $id 
#
if( ! function_exists("rt_wpml_page_id") ){
	function rt_wpml_page_id($id){	 
		if(function_exists('icl_object_id')) {
			global $sitepress;
			$get_default_language =  $sitepress->get_default_language();

			return icl_object_id($id,'page',true,$get_default_language);
		} else {
			return $id;
		}
	}
}

#
# WPML match page id 
# returns the current language version of the page
# @returns $id 
#
if( ! function_exists("rt_wpml_translated_page_id") ){
	function rt_wpml_translated_page_id($id){	 
		if(function_exists('icl_object_id')) {
			return icl_object_id($id,'page',true);
		} else {
			return $id;
		}
	}
}


#
# WPML match post id
#
if( ! function_exists("rt_wpml_post_id") ){
	function rt_wpml_post_id($id){
		if(function_exists('icl_object_id')) {
			global $sitepress, $post;
			$get_default_language =  $sitepress->get_default_language();
			$post_type = isset( $post->post_type ) ? $post->post_type : "post" ; 
			return icl_object_id($id,$post_type,true,$get_default_language);
		} else {
			return $id;
		}
	}
}

#
# WPML match category id
#
if( ! function_exists("rt_wpml_category_id") ){
	function rt_wpml_category_id($id){
		if(function_exists('icl_object_id')) {
			global $sitepress;
			$get_default_language =  $sitepress->get_default_language();

			return icl_object_id($id,'category',true,$get_default_language);
		} else {
			return $id;
		}
	}
}


#
# WPML match product category id
#
if( ! function_exists("rt_wpml_product_category_id") ){
	function rt_wpml_product_category_id($id){
		if(function_exists('icl_object_id')) {
			global $sitepress;
			$get_default_language =  $sitepress->get_default_language();

			return icl_object_id($id,'product_categories',true,$get_default_language);
		} else {
			return $id;
		}
	}
}

#
# WPML match portfolio category id
#
if( ! function_exists("rt_wpml_portfolio_category_id") ){
	function rt_wpml_portfolio_category_id($id){
		if(function_exists('icl_object_id')) {
			global $sitepress;
			$get_default_language =  $sitepress->get_default_language();

			return icl_object_id($id,'portfolio_categories',true,$get_default_language);
		} else {
			return $id;
		}
	}
}


#
# WPML match categories
#
if( ! function_exists("rt_wpml_lang_object_ids") ){
	function rt_wpml_lang_object_ids($ids_array, $type) {
		if(function_exists('icl_object_id')) {
			global $sitepress;
			$get_default_language =  $sitepress->get_default_language();

			$res = array();
			foreach ($ids_array as $id) {
				$xlat = icl_object_id($id,$type,false,$get_default_language);
				if(!is_null($xlat)) $res[] = $xlat;
			}
			return $res;
		} else {
			return $ids_array;
		}
	}
}

#
# Get WPML Plugin Flags
#
if( ! function_exists("rt_wpml_languages_list") ){
	function rt_wpml_languages_list(){
	    $languages = icl_get_languages('skip_missing=0&orderby=code'); 

		if(!empty($languages)){
			echo '<li class="languages icon-globe-1">'.ICL_LANGUAGE_NAME.' <span class="icon-angle-down"></span>';
			echo '<ul class="flags">';
			foreach($languages as $l){
				echo '<li>';
				if($l['country_flag_url']){
					echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /> <a href="'.$l['url'].'" title="'.$l['native_name'].'"><span>'.$l['native_name'].'</span></a>';
				}
				echo '</li>';
			}
			echo '</ul>';
			echo '</li>';
		}
	}
}


#
#	WPML Home URL
#
if( ! function_exists("rt_wpml_get_home_url") ){
	function rt_wpml_get_home_url(){
		if(function_exists('icl_get_home_url')){
			return icl_get_home_url();
		}else{
			return rtrim(home_url() , '/') . '/';
		}
	}
}

#
#	WPML String Register
#
if( ! function_exists("rt_wpml_register_string") ){
	function rt_wpml_register_string($context, $name, $value){
		if(function_exists('icl_register_string') && trim($value)){
			icl_register_string($context, $name, $value);
		}    
	}
}

#
#	WPML Get Registered String
#
if( ! function_exists("rt_wpml_t") ){
	function rt_wpml_t($context, $name, $original_value){
		global $sitepress;
		if( isset( $sitepress ) ){
			$get_default_language =  $sitepress->get_default_language();
			if( ! empty( $get_default_language ) ){
				if(function_exists('icl_t')){
					return icl_t($context, $name, $original_value);
				}else{
					return $original_value;
				}
			}else{
				return $original_value;
			}
		}else{
			return $original_value;
		}
	}
}


#
# WPML match attachment id 
# returns the current language version of the attachment
# @returns $id 
#
if( ! function_exists("rt_wpml_translated_attachment_id") ){
	function rt_wpml_translated_attachment_id($id){	 
		if(function_exists('icl_object_id')) {
			return icl_object_id($id,'attachment',true);
		} else {
			return $id;
		}
	}
}
?>