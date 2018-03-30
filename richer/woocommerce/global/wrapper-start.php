<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $options_data;

$template = get_option('template');

if(is_shop()) {
	$pageID = get_option('woocommerce_shop_page_id'); 
} else {
	$pageID = $post->ID;
}

$custom_fields = get_post_custom_values('_wp_page_template', $pageID);
if(is_array($custom_fields) && !empty($custom_fields)) {
	$page_template = $custom_fields[0];
} else {
	$page_template = '';
}

if($page_template == 'page-fullwidth.php') {
	$sidebar_pos ='span12';
}
elseif($options_data['select_shopsidebar'] != 'none' && $options_data['select_shopsidebar'] != ''){
	$sidebar_pos = $options_data['select_shopsidebar'].' span9';
} else {
	$sidebar_pos ='span12';
}

echo '<div id="page-wrap"><div class="container"><div id="content" class="'.$sidebar_pos.'">';
