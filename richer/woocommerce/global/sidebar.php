<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
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
?>
</div>
<?php if($page_template != 'page-fullwidth.php' && $options_data['select_shopsidebar'] != 'none' && $options_data['select_shopsidebar'] != ''){
?>
<div id="sidebar" class="span3">
	<?php
	wp_reset_query();

	$shop_page_id = get_option('woocommerce_shop_page_id');
	$name = get_post_meta($shop_page_id, 'sbg_selected_sidebar_replacement', true);
	if($name) {
		generated_dynamic_sidebar($name[0]);
	}	
	
	?>
</div>
<?php }	?>