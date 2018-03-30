<?php

//==========================================================
// === DEFINITIONS
//==========================================================
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.1.2' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', plugin_dir_path(__FILE__) );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', plugin_dir_url(__FILE__) );
$themepath = AQPB_PATH;

//==========================================================
// === REQ FUNCTIONS AND CLASSES
//==========================================================
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//==========================================================
// === BLOCKS
//==========================================================
//DT BLOCKS
require_once($themepath . '/blocks/section-wrapper.php');
require_once($themepath . '/blocks/service.php');
require_once($themepath . '/blocks/blog.php');
require_once($themepath . '/blocks/blog-ajax.php');
require_once($themepath . '/blocks/portfolio-ajax.php');
require_once($themepath . 'blocks/filterable-portfolio.php');
require_once($themepath . '/blocks/counter.php');
require_once($themepath . '/blocks/map.php');
require_once($themepath . '/blocks/testimonials.php');
require_once($themepath . '/blocks/team.php');
require_once($themepath . '/blocks/clients.php');
require_once($themepath . '/blocks/cf7.php');
require_once($themepath . '/blocks/video.php');
require_once($themepath . '/blocks/text.php');
require_once($themepath . '/blocks/image.php');
require_once($themepath . '/blocks/alert.php');
require_once($themepath . '/blocks/aq-column-block.php');
require_once($themepath . '/blocks/twitter.php');
require_once($themepath . '/blocks/text_block.php');

//DT BLOCK REGISTER
aq_register_block('AQ_Section_Block');
aq_register_block('AQ_Services_Block');
aq_register_block('AQ_Blog_Updates_Block');
aq_register_block('AQ_Blog_Updates_AJAX_Block');
aq_register_block('AQ_Portfolio_AJAX_Block');
aq_register_block('AQ_Filterable_Portfolio_Block');
aq_register_block('Counter_Block');
aq_register_block('AQ_Map_Block');
aq_register_block('AQ_Testimonials_Block');
aq_register_block('Team_Block');
aq_register_block('Clients_Block');
aq_register_block('CF7_Block');
aq_register_block('Video_Block');
aq_register_block('Text_Block');
aq_register_block('Image_Block');
aq_register_block('Alert_Block');
aq_register_block('Twitter_Block');

aq_register_block('AQ_Column_Block');
aq_register_block('DT_Text_Block');

//custom blocks


require_once(AQPB_PATH . 'blocks/aq-widgets-block.php');
require_once($themepath . '/blocks/aq-separator-block.php');
require_once($themepath . '/blocks/aq-shortcode-block.php');

aq_register_block('AQ_Separator_Block');
aq_register_block('AQ_Widgets_Block');
aq_register_block('AQ_Shortcode_Block');

//==========================================================
// === INIT DT PAGE BUILDER
//==========================================================
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();

add_action('admin_init', 'dtpb_init'); 
 
function dtpb_init() {
	add_action('admin_enqueue_scripts', 'dtpb_scripts');
	add_filter('the_editor', 'dtpb_content');
}
 
function dtpb_scripts( $page ) {
	if ( $page === 'post.php' || $page === 'post-new.php' ) {
		$custom_css = "#content-gmet.active { 
			border-color: #ccc #ccc #f4f4f4; background-color: #f4f4f4; color: #555;
		}";
		wp_add_inline_style( 'colors', $custom_css );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'gmet-styles', \get_template_directory_uri() .'/framework/distinctive-page-builder/assets/css/gmet-style.css' );
		wp_enqueue_script('gmet', \get_template_directory_uri().'/framework/distinctive-page-builder/assets/js/gmet.js' , array('jquery'), time(), false );
		wp_localize_script('gmet', 'gmetData', array(
			'tabTitle' => __('Builder Templates', 'gmet')
		));
	}
}
 
function dtpb_content( $content ) {
	preg_match("/<textarea[^>]*id=[\"']([^\"']+)\"/", $content, $matches);
	$id = $matches[1];
	// only for main content
	if( $id !== "content" ) return $content;
	ob_start();
	require_once(AQPB_PATH . 'shortcode-content.php' );
	return $content . ob_get_clean();
}