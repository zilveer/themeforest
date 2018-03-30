<?php

function etheme_get_option($key, $setting = null,$doshortcode = true) {
	$setting = $setting ? $setting : ETHEME_OPTIONS;
	$pre = apply_filters('etheme_pre_get_option_'.$key, false, $setting);
	if ( false !== $pre )
		return $pre;
	$options = get_option($setting);
	if ( !is_array( $options ) || !array_key_exists($key, (array) $options) )
		return '';
	if ( is_array( $options[$key] ) ) 
		return $options[$key];
    if($doshortcode){
        $value = do_shortcode($options[$key]);
    }
    else{
        $value = $options[$key];
    }
	
	if ( is_ssl() ) $value = str_replace( 'http://', 'https://', $value );
	return stripslashes( wp_kses_decode_entities( $value ) );
}
function etheme_option($key, $setting = null,$doshortcode = true) {
	echo etheme_get_option($key, $setting, $doshortcode);
}

function etheme_get_color($key) {
	$color = etheme_get_option($key);
	if ( $color && $color != '#' )
		return $color;
	else
		return false;
}

/**
 * undocumented
 */
function etheme_get_custom_field($field) {
	global $post;
	if ( null === $post ) return FALSE;
	$custom_field = get_post_meta($post->ID, $field, true);
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
	$sql = "SELECT pm.post_id 
            FROM `{$wpdb->postmeta}` AS pm 
                LEFT JOIN `{$wpdb->posts}` AS p ON p.ID = pm.post_id
            WHERE pm.meta_key = '_wp_page_template' AND pm.meta_value = '$tpl' AND p.post_status='publish' LIMIT 1";
	$page_id = $wpdb->get_var($sql);
	return apply_filters( 'etheme_tpl2id', $page_id );
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
