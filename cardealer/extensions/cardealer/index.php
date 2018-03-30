<?php
define('TMM_APP_CARDEALER_PREFIX', TMM_THEME_PREFIX . "app_cardealer_");

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

include_once TMM_EXT_PATH . '/cardealer/config.php';
include_once TMM_EXT_PATH . '/cardealer/classes/cardealer.php';
include_once TMM_EXT_PATH . '/cardealer/classes/watermark.php';
include_once TMM_EXT_PATH . '/cardealer/classes/data_constructor.php';
include_once TMM_EXT_PATH . '/cardealer/classes/car.php';
include_once TMM_EXT_PATH . '/cardealer/classes/car_image.php';
include_once TMM_EXT_PATH . '/cardealer/classes/user.php';
include_once TMM_EXT_PATH . '/cardealer/classes/sheduler.php';
include_once TMM_EXT_PATH . '/cardealer/classes/carlocation_list_table.php';
include_once TMM_EXT_PATH . '/cardealer/widgets.php';
include_once TMM_EXT_PATH . '/cardealer/functions.php';

add_action("init", array('TMM_Ext_Car_Dealer', 'init'));
add_action('admin_menu', array('TMM_Ext_Car_Dealer', 'admin_menu'));
add_action("admin_init", array('TMM_Ext_Car_Dealer', 'admin_init'));
add_action('admin_enqueue_scripts', array('TMM_Ext_Car_Dealer', 'admin_head'));

//add_action('manage_users_custom_column', array('TMM_Ext_Car_Dealer', 'manage_users_custom_column'), 15, 3);
//add_filter('manage_users_columns', array('TMM_Ext_Car_Dealer', 'manage_users_columns'), 15, 1);
//AJAX callbacks
add_action('wp_ajax_nopriv_app_cardealer_draw_quicksearch_models', array('TMM_Ext_PostType_Car', 'draw_quicksearch_models'));
add_action('wp_ajax_nopriv_app_cardealer_draw_quicksearch_locations', array('TMM_Ext_PostType_Car', 'draw_quicksearch_locations'));
add_action('wp_ajax_nopriv_app_cardealer_draw_quicksearch_producers', array('TMM_Ext_PostType_Car', 'draw_quicksearch_producers'));
add_action('wp_ajax_nopriv_app_cardealer_process_advanced_search_params', array('TMM_Ext_PostType_Car', 'process_advanced_search_params'));

add_action('wp_ajax_nopriv_app_cardealer_filtered_cars', array('TMM_Helper', 'filtered_cars'));
add_action('wp_ajax_nopriv_app_cardealer_login_check', array('TMM_Helper', 'login_check'));
add_action('wp_ajax_app_cardealer_login_check', array('TMM_Helper', 'login_check'));

add_action('wp_ajax_app_cardealer_add_car_producer_name', array('TMM_Ext_PostType_Car', 'add_car_producer_name'));
add_action('wp_ajax_app_cardealer_save_settings', array('TMM_Ext_Car_Dealer', 'save_settings'));
add_action('wp_ajax_app_cardealer_draw_quicksearch_models', array('TMM_Ext_PostType_Car', 'draw_quicksearch_models'));
add_action('wp_ajax_app_cardealer_draw_quicksearch_locations', array('TMM_Ext_PostType_Car', 'draw_quicksearch_locations'));
add_action('wp_ajax_app_cardealer_draw_quicksearch_producers', array('TMM_Ext_PostType_Car', 'draw_quicksearch_producers'));
add_action('wp_ajax_app_cardealer_process_advanced_search_params', array('TMM_Ext_PostType_Car', 'process_advanced_search_params'));
add_action('wp_ajax_app_cardealer_add_car', array('TMM_Ext_PostType_Car', 'add_car'));
add_action('wp_ajax_app_cardealer_update_user_profile', array('TMM_Cardealer_User', 'update_user_profile'));
add_action('wp_ajax_app_cardealer_add_data_group', array('TMM_Cardealer_DataConstructor', 'add_data_group'));
add_action('wp_ajax_app_cardealer_add_car_opt', array('TMM_Cardealer_DataConstructor', 'add_car_opt'));
add_action('wp_ajax_app_cardealer_add_item_to_data_group', array('TMM_Cardealer_DataConstructor', 'add_item_to_data_group'));
add_action('wp_ajax_app_cardealer_get_user_logo_url', array('TMM_Cardealer_User', 'ajax_get_user_logo_url'));
add_action('wp_ajax_app_cardealer_set_user_car_as_featured', array('TMM_Cardealer_User', 'set_user_car_as_featured'));
add_action('wp_ajax_app_cardealer_filtered_cars', array('TMM_Helper', 'filtered_cars'));
add_action('wp_ajax_app_cardealer_update_sample_watermark', array('TMM_Ext_PostType_Car', 'get_sample_watermark'));
add_action('wp_ajax_app_cardealer_delete_car', array('TMM_Ext_PostType_Car', 'delete_car'));
add_action('wp_ajax_app_cardealer_sold_car', array('TMM_Ext_PostType_Car', 'sold_car'));
add_action('wp_ajax_app_cardealer_draft_car', array('TMM_Ext_PostType_Car', 'draft_car'));
add_action('wp_ajax_app_cardealer_add_currency', array('TMM_Ext_Car_Dealer', 'add_currency'));
add_action('wp_ajax_app_cardealer_user_max_images_size', array('TMM_Cardealer_User', 'set_user_max_images_size'));
add_action('wp_ajax_app_cardealer_get_user_file_space', array('TMM_Cardealer_User', 'get_user_file_space'));
add_action('wp_ajax_app_cardealer_draw_locations_select', array('TMM_Ext_Car_Dealer', 'draw_locations_select'));
add_action('wp_ajax_app_cardealer_draw_tax_select', array('TMM_Ext_Car_Dealer', 'draw_tax_select'));
add_action('wp_ajax_app_cardealer_add_user_role', array('TMM_Cardealer_User', 'add_user_role'));
add_action('wp_ajax_app_cardealer_add_features_packet', array('TMM_Cardealer_User', 'add_features_packet'));
add_action('wp_ajax_app_cardealer_set_car_cover_image', array('TMM_Ext_PostType_Car', 'set_car_cover_image'));
add_action('wp_ajax_app_cardealer_import_cardealer_settings', array('TMM_Ext_Car_Dealer', 'import_cardealer_settings'));
add_action('wp_ajax_app_cardealer_set_dealer_loan_rate', array('TMM_Cardealer_User', 'set_dealer_loan_rate'));
add_action('wp_ajax_app_cardealer_get_users_by_role', array('TMM_Cardealer_User', 'get_users_by_role'));
add_action('wp_ajax_app_cardealer_upload_cardealer_logo', array('TMM_Car_Image', 'upload_cardealer_logo'));
add_action('wp_ajax_app_cardealer_upload_car_image', array('TMM_Car_Image', 'upload_car_image'));


/**
 * Add query var for dealers page
 */
function tmm_dealer_add_rewrite_var( $vars ) {
	$vars[] = 'dealer_id';
	return $vars;
}
function tmm_dealer_add_rewrite_rules(){

	$page_id = (int) TMM::get_option( 'dealers_page', TMM_APP_CARDEALER_PREFIX );
	$page = get_post($page_id);

	if(is_object($page) && $page->ID){
		$parent = '';

		if (!empty($page->post_parent)) {
			$parent = get_post($page->post_parent);
			$parent = $parent->post_name . '/';
		}

		add_rewrite_rule(
			'^'.$parent.$page->post_name.'/dealer_id/([^/]*)/?',
			'index.php?page_id='.$page->ID.'&dealer_id=$matches[1]',
			'top'
		);
	}

	add_rewrite_tag( '%dealer_id%', '([^&]+)' );
	add_rewrite_endpoint( 'dealer_id', EP_ROOT | EP_PAGES );

}

add_filter( 'query_vars','tmm_dealer_add_rewrite_var' );
add_filter( 'init','tmm_dealer_add_rewrite_rules');

/**
 * Navigation menu fix with adding current page class to 'page_for_posts' on custom posts
 */
function tmm_dealer_fix_blog_menu_css_class( $classes, $item ) {
	if ( is_tax( 'carproducer' ) || is_singular( 'car' ) || is_post_type_archive( 'car' ) ) {
		if ( $item->object_id == get_option('page_for_posts') ) {
			$key = array_search( 'current_page_parent', $classes );
			if ( false !== $key )
				unset( $classes[ $key ] );
		} else if ( $item->object_id == TMM::get_option('searching_page', TMM_APP_CARDEALER_PREFIX) ) {
			if (!in_array('current_page_parent', $classes)) {
				$classes[] = 'current_page_parent';
			}
		}
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tmm_dealer_fix_blog_menu_css_class', 10, 2 );

/**
 * Currency converter
 */
add_action('wp_ajax_nopriv_app_cardealer_convert_curency', 'tmm_convert_curency');
add_action('wp_ajax_app_cardealer_convert_curency', 'tmm_convert_curency');
/* update currency exchange rates */
add_action('admin_init', array('TMM_Ext_Car_Sheduler', 'convert_curency_sheduler'));
