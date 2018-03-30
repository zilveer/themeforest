<?php  global $themename, $input_prefix;

/*****************/
/* Theme Details */

$themename = "The Writer";
$obox_themeid = "the-writer";
$obox_productid = "1800";
$presstrendsid = "o713xnekdk480oddttm3pjmtkv0oqx14s";

/**********************/
/* Include OCMX files */
$include_folders = array("/ocmx/includes/", "/ocmx/theme-setup/", "/ocmx/widgets/", "/ocmx/front-end/", "/ajax/", "/ocmx/interface/");
include_once (get_template_directory()."/ocmx/folder-class.php");
include_once (get_template_directory()."/ocmx/load-includes.php");

/***********************/
/* Add OCMX Menu Items */

add_action('admin_menu', 'ocmx_add_admin');
function ocmx_add_admin() {
	global $wpdb;

	add_object_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), '', 'http://obox-design.com/images/ocmx-favicon.png');
	add_submenu_page(basename(__FILE__), "General Options", "General", "edit_theme_options", basename(__FILE__), 'ocmx_general_options');
	add_submenu_page(basename(__FILE__), "Typography", "Typography", "edit_theme_options", "ocmx-fonts", 'ocmx_font_options');
	add_submenu_page(basename(__FILE__), "Customize Colors", "Customize Colors", "edit_theme_options", "customize.php");
	add_submenu_page(basename(__FILE__), "Help", "Help", "edit_theme_options", "obox-help", 'ocmx_welcome_page');
};

function the_writer_post_background_css( $postid = 0 ){

	// Grab the header image url
	$header_bg_image_file = get_post_meta( $postid , "header_image", true);

	// See if we can match it to a post
	if( '' != $header_bg_image_file ) {
		$header_bg_post_object = get_page_by_title( preg_replace('/\.[^.]+$/', '', basename( $header_bg_image_file ) ) , OBJECT , 'attachment' );
	}

	if( '' != $header_bg_image_file && is_object( $header_bg_post_object ) ) { // Get a resized version of the header image
		if( is_single() || is_page() ) {
			$image_size = 'full';
		} else {
			$image_size = 'large';
		}
		$header_bg_image = wp_get_attachment_image_src( $header_bg_post_object->ID , $image_size );
		$header_bg_image = $header_bg_image[0];
	} elseif ( '' != $header_bg_image_file ) { // If not, just use the full url
		$header_bg_image = $header_bg_image_file;
	} else {
		$header_bg_image = '';
	}

	$header_bg_attributes = get_post_meta( $postid , "header_image_attributes", true);
	$css = '';

	if( '' != $header_bg_image  || !empty( $header_bg_attributes["colour"] ) ) {
		if( '' != $header_bg_image ) { $css .= '
			background-image:  url(' . $header_bg_image . ');'; }
		if( isset( $header_bg_attributes['repeat'] ) ) {$css .= '
			background-repeat:' . $header_bg_attributes['repeat'] . ';'; }
		if( isset( $header_bg_attributes['colour'] ) ) { $css .= '
			background-color:' . $header_bg_attributes['colour'] . ';'; }

		$css .= ' background-position: center;
		background-size: cover;
		-webkit-background-size: cover;
		-moz-background-size: cover;';
	}
	return $css;
}

function the_writer_post_title_css( $postid = 0 ){
	$header_title_color = get_post_meta( $postid , "header_title_color", true);
	if( '' != $header_title_color ){
		return 'color: ' . $header_title_color . ';';
	} else {
		return '';
	}
}