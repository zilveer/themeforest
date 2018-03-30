<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Likes Functions
 * Changed by CMSMasters
 * 
 */


function cmsmsLike($show = true) {
	global $wpdb;
	
	
	$post_ID = get_the_ID();
	$ip = $_SERVER['REMOTE_ADDR'];
	
    $likes = get_post_meta($post_ID, 'cmsms_likes', true) != '' ? get_post_meta($post_ID, 'cmsms_likes', true) : '0';
	
	$ipCheck = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . CMSMS_SHORTNAME . "_likes WHERE post_id = '" . $post_ID . "' AND ip = '" . $ip . "'");
	
    if (!isset($_COOKIE['like-' . $post_ID]) && $ipCheck == 0) {
		$counter = '<a href="#" onclick="cmsmsLike(' . $post_ID . '); return false;" id="cmsmsLike-' . $post_ID . '" class="cmsmsLike"><span>' . $likes . '</span></a>';
    } else {
		$counter = '<a href="#" onclick="return false;" id="cmsmsLike-' . $post_ID . '" class="cmsmsLike active"><span>' . $likes . '</span></a>';
    }
    
    if ($show !== true) {
	    return $counter;
    } else {
    	echo $counter;
    }
}


function addTemplateURL() {
	echo '<script type="text/javascript">' . 
		'var templateURL = "' . get_template_directory_uri() . '";' . 
	'</script>';
}

add_action('wp_head', 'addTemplateURL');

