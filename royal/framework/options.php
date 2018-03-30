<?php

function etheme_get_option($key, $setting = null,$doshortcode = true) {
  	global $options;
    if ( function_exists( 'ot_get_option' ) ) {
    	if($doshortcode && is_string(ot_get_option( $key,$setting ))){
        	$result = do_shortcode(ot_get_option( $key,$setting ));
    	}else{
        	$result =  ot_get_option( $key,$setting );
    	}
    	return apply_filters('et_option_'.$key, $result);
    }
    
}
function etheme_option($key, $setting = null,$doshortcode = true) {
	echo etheme_get_option($key, $setting, $doshortcode);
}

/**
 * undocumented
 */
function et_is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}
 
 
function etheme_get_custom_field($field, $postid = false) {
	global $post;
	if ( null === $post && !$postid) return FALSE;
	if(!$postid) {
		$postid = $post->ID;
	} 
	$page_for_posts = get_option( 'page_for_posts' );
	$custom_field = get_post_meta($postid, $field, true);
	
	if(is_array($custom_field)) {
		$custom_field = $custom_field[0];
	}
	if ( $custom_field ) {
		return stripslashes( wp_kses_decode_entities( $custom_field ) );
	}
	else {
		return FALSE;
	}
}
function etheme_custom_field($field) {
	echo etheme_get_custom_field($field);
}

function etheme_shortcode2id($shortcode, $type = 'page'){
	global $wpdb;
	$sql = "SELECT `ID` FROM `{$wpdb->posts}` WHERE `post_type` = '$type' AND `post_status` IN('publish','private') AND `post_content` LIKE '%$shortcode%' LIMIT 1";
	$page_id = $wpdb->get_var($sql);
	return apply_filters( 'etheme_shortcode2id', $page_id );
}

function etheme_tpl2id($tpl){
	global $wpdb;
	
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $tpl
	));
	foreach($pages as $page){
		return $page->ID;
	}
}

/**
 * undocumented
 */
function etheme_childtheme_file($file) {
	if ( ( PARENT_DIR != CHILD_DIR ) && file_exists(trailingslashit(CHILD_DIR).$file) ) 
		$url = trailingslashit(CHILD_URL).$file;
	else 
		$url = trailingslashit(PARENT_URL).$file;
	return $url;
}
