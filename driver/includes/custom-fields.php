<?php
/***
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */

// Fields

function iron_register_acf_fields()
{
	if ( ! class_exists('acf_field_repeater') )
		include_once(IRON_PARENT_DIR.'/includes/acf-addons/acf-repeater/repeater.php');

	if ( ! class_exists('acf_field_widget_area') )
		include_once(IRON_PARENT_DIR.'/includes/acf-addons/acf-widget-area/widget-area-v4.php');

	iron_check_acf_lite_switch();

}
add_action('acf/register_fields', 'iron_register_acf_fields');


/**
* If ACF_LITE is on, update all acf group fields in DB to draft
*/


function iron_check_acf_lite_switch()
{

	if(isset($_GET["settings-updated"])) {

		global $wpdb;

		if(ACF_LITE)
			$status = "draft";
		else
			$status = "publish";

		$wpdb->update( $wpdb->posts, array( 'post_status' => $status ), array( 'post_type' => "acf" ), '%s' );
	}

}



/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group") && ACF_LITE)
{

	$default_sidebar = null;
	$sidebar_position = 'disabled';
	$single_post_featured_image = null;
	
	$current_path = parse_url(basename($_SERVER["REQUEST_URI"]));
	
	if(is_admin() && !empty($current_path["path"]) && $current_path["path"] == 'post-new.php') {
		
		$post_type = !empty($_GET["post_type"]) ? $_GET["post_type"] : 'post';
		
		if($post_type == 'post') {
			
			$default_sidebar = get_iron_option('single_post_default_sidebar');
			$sidebar_position = "right";
			$single_post_featured_image = get_iron_option('single_post_featured_image');
			
		}else if($post_type == 'video') {
		
			$default_sidebar = get_iron_option('single_video_default_sidebar');
			$sidebar_position = "right";
			
		}else if($post_type == 'album') {
		
			$default_sidebar = get_iron_option('single_discography_default_sidebar');
			$sidebar_position = "right";
			
		}else if($post_type == 'photo-album') {
		
			$default_sidebar = get_iron_option('single_photo_album_default_sidebar');
			$sidebar_position = "right";
			
		}else if($post_type == 'event') {
		
			$default_sidebar = get_iron_option('single_event_default_sidebar');
			$sidebar_position = "right";
		}
	}
	
	
	register_field_group(array (
		'id' => 'acf_sidebar-options',
		'title' => 'Sidebar Options',
		'fields' => array (
			array (
				'key' => 'field_526d6ec715ee9',
				'label' => 'Sidebar Position',
				'name' => 'sidebar-position',
				'type' => 'radio',
				'choices' => array (
					'disabled' => 'Disabled',
					'left' => 'Left',
					'right' => 'Right'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => $sidebar_position,
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_526d6c0da8219',
				'label' => 'Widget Area',
				'name' => 'sidebar-area_id',
				'type' => 'widget_area',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6ec715ee9',
							'operator' => '!=',
							'value' => 'disabled',
						),
					),
					'allorany' => 'all',
				),
				'allow_null' => 1,
				'default_value' => $default_sidebar,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				)
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'photo-album',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	register_field_group(array (
		'id' => 'single-post-options',
		'title' => 'Single Post Options',
		'fields' => array (
			array (
				'key' => 'field_526d6ec715ef9',
				'label' => 'Single Post Featured Image',
				'name' => 'single_post_featured_image',
				'type' => 'radio',
				'choices' => array(
					'fullwidth' => 'Full Width',
					'original' => 'Original',
					'none' => 'None'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => $single_post_featured_image,
				'layout' => 'vertical',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));			
			

	register_field_group(array (
		'id' => 'acf_news-template-settings',
		'title' => 'Template Settings',
		'fields' => array (	
			array (
				'key' => 'field_523382c925a72',
				'label' => 'Enable Excerpts',
				'name' => 'enable_excerpts',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'index.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid3.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-grid4.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-posts-classic.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	register_field_group(array (
		'id' => 'acf_videos-template-settings',
		'title' => 'Template Settings',
		'fields' => array (	
			array (
				'key' => 'field_523382c925a73',
				'label' => 'On video click option',
				'name' => 'video_link_type',
				'type' => 'radio',
				'choices' => array (
					'single' => 'Go to detailed video page',
					'lightbox' => 'Open video in a LightBox',
					'inline' => 'Replace image by video'
				),
				'default_value' => 'single',
				'multiple' => 0,
			),
		),
		'location' => array (

			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-video.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-video-grid.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
					
	register_field_group(array (
		'id' => 'acf_page-settings',
		'title' => 'Page Settings',
		'fields' => array (
			array (
				'key' => 'field_523384ce55a84',
				'label' => 'Classic Menu Container Background Color',
				'instructions' => __('This will override global settings', IRON_TEXT_DOMAIN),
				'name' => 'classic_menu_background',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a86',
				'label' => 'Classic Menu Container Background Transparency',
				'name' => 'classic_menu_background_alpha',
				'instructions' => __('Set the menu opacity between 0 and 1', IRON_TEXT_DOMAIN),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			),			
			array (
				'key' => 'field_523384ce55a85',
				'label' => 'Show Classic Menu & Header Over Content',
				'name' => 'classic_menu_over_content',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),
			array (
				'key' => 'field_523384ce55a87',
				'label' => 'Classic Menu Main Item Text Color',
				'instructions' => __('This will override global settings', IRON_TEXT_DOMAIN),
				'name' => 'classic_menu_main_item_color',
				'type' => 'color_picker',
				'default_value' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_523384ce55a85',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_523384ce55a88',
				'label' => 'Classic Menu Logo',
				'instructions' => __('This will override global settings', IRON_TEXT_DOMAIN),
				'name' => 'classic_menu_logo',
				'type' => 'file',
				'column_width' => '',
				'save_format' => 'url',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_523384ce55a85',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
						
			array (
				'key' => 'field_523382c955a73',
				'label' => 'Hide Page Title',
				'name' => 'hide_page_title',
				'type' => 'true_false',
				'default_value' => 0,
				'placeholder' => 0,
			),	
			array (
				'key' => 'field_523382c955a74',
				'label' => 'Background',
				'name' => 'background',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_523382f555a75',
				'label' => 'Background Repeat',
				'name' => 'background_repeat',
				'type' => 'select',
				'choices' => array (
					'repeat' => 'Repeat',
					'no-repeat' => 'No Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233837455a76',
				'label' => 'Background Size',
				'name' => 'background_size',
				'type' => 'select',
				'choices' => array (
					'cover' => 'Cover',
					'contain' => 'Contain',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233842d55a78',
				'label' => 'Background Position',
				'name' => 'background_position',
				'type' => 'select',
				'choices' => array (
					'left top' => 'left top',
					'left center' => 'left center',
					'left bottom' => 'left bottom',
					'right top' => 'right top',
					'right center' => 'right center',
					'right bottom' => 'right bottom',
					'center top' => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
/*
			array (
				'key' => 'field_523383fb55a77',
				'label' => 'Background Attachment',
				'name' => 'background_attachment',
				'type' => 'select',
				'choices' => array (
					'scroll' => 'Scroll',
					'fixed' => 'Fixed',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),	
*/		
			array (
				'key' => 'field_523384ce55a79',
				'label' => 'Background Color',
				'name' => 'background_color',
				'instructions' => 'Background Images will not be shown on mobile.<br>Please set a background color instead',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a80',
				'label' => 'Content Background Color',
				'name' => 'content_background_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a81',
				'label' => 'Content Background Transparency',
				'name' => 'content_background_transparency',
				'instructions' => __('Set the content opacity between 0 and 1<br>If you set an image background - make sure to set Content Background Transparency to 0', IRON_TEXT_DOMAIN),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			),

			
/*
			array (
				'key' => 'field_523384ce55a82',
				'label' => 'Outer Content Background Color',
				'name' => 'outer_content_background_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
			array (
				'key' => 'field_523384ce55a83',
				'label' => 'Outer Content Background Transparency',
				'name' => 'outer_content_background_transparency',
				'instructions' => __('Set the outer content opacity between 0 and 1', IRON_TEXT_DOMAIN),
				'type' => 'number',
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default_value' => 1,
			)
*/
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'photo-album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_video-embedder',
		'title' => 'Video Embedder',
		'fields' => array (
			array (
				'key' => 'field_51b8d3ffdfe47',
				'label' => 'Add a video link',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => 'See <a target="_blank" href="http://codex.wordpress.org/Embeds">Supported Sites</a>',
				'default_value' => 'http://www.youtube.com/watch?v=aHjpOzsQ9YI',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'revisions',
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_album-infos',
		'title' => 'Album Infos',
		'fields' => array (
			array (
				'key' => 'field_51b8db2cd11c5',
				'label' => 'Hide album within the Albums Posts template',
				'instructions' => '<br style="clear:both">Could be useful for solo / remix albums<br><br>',
				'name' => 'hide_album',
				'type' => 'true_false',
				'placeholder' => 0,
			),		
			array (
				'key' => 'field_51b8db2cd11c4',
				'label' => 'Release Date',
				'name' => 'alb_release_date',
				'type' => 'date_picker',
				'date_format' => 'yy-mm-dd',
				'display_format' => 'yy-mm-dd',
				'first_day' => 1,
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => __('Users will be redirected to the link’s destination instead of the album’s details page.', IRON_TEXT_DOMAIN),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_51b8c4facc846',
				'label' => 'Tracklist',
				'name' => 'alb_tracklist',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51b8c51ecc847',
						'label' => 'Title',
						'name' => 'track_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c5e3cc848',
						'label' => 'Where to buy',
						'name' => 'track_store',
						'type' => 'text',
						'instructions' => 'Add link to the online store to buy this track',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c5e3cc850',
						'label' => 'Buy Track Label',
						'name' => 'track_buy_label',
						'type' => 'text',
						'instructions' => 'Add your own buy track label',
						'column_width' => '',
						'default_value' => 'Buy Track',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c637cc849',
						'label' => 'MP3',
						'name' => 'track_mp3',
						'type' => 'file',
						'instructions' => 'Upload the mp3 file',
						'column_width' => '',
						'save_format' => 'url',
						'library' => 'all',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Track',
			),
			array (
				'key' => 'field_51b8c6d6cc84a',
				'label' => 'Store list',
				'name' => 'alb_store_list',
				'type' => 'repeater',
				'instructions' => 'Links the the online stores to buy album',
				'sub_fields' => array (
					array (
						'key' => 'field_51b8c6fdcc84b',
						'label' => 'Store Name',
						'name' => 'store_name',
						'type' => 'text',
						'instructions' => 'Examples : iTunes, Bandcamp, Soundcloud, etc.',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c718cc84c',
						'label' => 'Store Link',
						'name' => 'store_link',
						'type' => 'text',
						'instructions' => 'Link to the online store',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Store',
			),
			array (
				'key' => 'field_51b8c792cc84d',
				'label' => 'Review',
				'name' => 'alb_review',
				'type' => 'textarea',
				'default_value' => '',
				'formatting' => 'br',
				'maxlength' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_51b8c88fcc84e',
				'label' => 'Review Author',
				'name' => 'alb_review_author',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	
	
	$photo_sizes_options = get_iron_option('photo_sizes');
	$photo_sizes = array('random' => 'Random');
	
	if(!empty($photo_sizes_options) && is_array($photo_sizes_options)) {
		foreach($photo_sizes_options as $key => $size) {
			$photo_sizes["size_".$key] = $size["size_name"]." (".$size["size_width"]."x".$size["size_height"].")";
		}
	}	
	
	register_field_group(array (
		'id' => 'acf_photo_album',
		'title' => 'Photo Album',
		'fields' => array (
			array (
				'key' => 'field_51c4d5b5f6475',
				'label' => 'Album Photos',
				'name' => 'album_photos',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51c4d6b5f6477',
						'label' => 'Photo Upload',
						'name' => 'photo_file',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),		
					array (
						'key' => 'field_51c4d622f6479',
						'label' => 'Photo Size',
						'name' => 'photo_size',
						'type' => 'select',
						'choices' => $photo_sizes,
						'allow_null' => 0,
						'default_value' => 'random'
					),		
					array (
						'key' => 'field_51c4d622f6476',
						'label' => 'Photo Title',
						'name' => 'photo_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_51c4d622f6478',
						'label' => 'Image Position',
						'name' => 'photo_position',
						'instructions' => 'Click on the picture where you would like to focus to automatically set the position within the dynamic grid on the frontend',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					)
					
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Photo',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'photo-album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));


	register_field_group(array (
		'id' => 'acf_iosslider',
		'title' => 'IOS Slider Photos',
		'fields' => array (
			array (
				'key' => 'field_61c4d5b5f6474',
				'type' => 'message',
				'message' => '<label for="acf-field-slider_shortcode">'.__('Shortcode').'</label><input type="text" readonly value="[iron_iosslider id='.(!empty($_GET["post"]) ? $_GET["post"] : '').']" />',
			),
			array (
				'key' => 'field_61c4d5b5f6473',
				'label' => 'Slider Height',
				'instructions' => 'Height in Pixels)',
				'name' => 'slider_height',
				'type' => 'number',
				'default_value' => '300',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
				
			),
			array (
				'key' => 'field_61c4d5b5f6475',
				'label' => 'Slider Photos',
				'name' => 'slider_photos',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5220bd6a85dfb',
						'label' => 'Photo Upload',
						'name' => 'photo_file',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_5220bd6a85dea',
						'label' => 'Photo Overlay Text 1',
						'name' => 'photo_text_1',
						'type' => 'text',
						'default_value' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5220bd6a85deb',
						'label' => 'Photo Overlay Text 2',
						'name' => 'photo_text_2',
						'type' => 'text',
						'default_value' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),					
					array (
						'key' => 'field_5220bd6a85dfc',
						'label' => 'Link Type',
						'name' => 'slide_link_type',
						'type' => 'radio',
						'choices' => array (
							'internal' => 'Internal Page',
							'external' => 'External Link',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 'internal',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_51b9e1a1fde59',
						'label' => 'Slide Link',
						'name' => 'slide_link',
						'type' => 'page_link',
						'instructions' => 'Add link to redirect the user on click.',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5220bd6a85dfc',
									'operator' => '==',
									'value' => 'internal',
								),
							),
							'allorany' => 'all',
						),
						'post_type' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5220bdac85dfd',
						'label' => 'Slide Link',
						'name' => 'slide_link_external',
						'type' => 'text',
						'instructions' => 'Add link to redirect the user on click.',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5220bd6a85dfc',
									'operator' => '==',
									'value' => 'external',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52386855ea1e9',
						'label' => 'Slide Call-To-Action',
						'name' => 'slide_more_text',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => ( get_iron_option('slide_more_label') ? get_iron_option('slide_more_label') : __('Read More', IRON_TEXT_DOMAIN)),
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slide',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'iosslider',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'categories',
				6 => 'tags',
				7 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));



	$default_event_show_time = get_iron_option('default_event_show_time');

	if ( is_null($default_event_show_time) )
		$default_event_show_time = true;

	$events_show_countdown_rollover = get_iron_option('events_show_countdown_rollover');

	if ( is_null($events_show_countdown_rollover) )
		$events_show_countdown_rollover = true;
		
		
	register_field_group(array (
		'id' => 'acf_event-infos',
		'title' => 'Event Infos',
		'fields' => array (
			array (
				'key' => 'field_523b46ebe355f',
				'type' => 'message',
				'message' => '<p><strong for="acf-event-date">'.__('Event Date / Time').'</strong></p>Please use the post publish date to set your event date',
			),		
			array (
				'key' => 'field_523b46ebe35ef',
				'label' => '',
				'name' => 'event_show_time',
				'type' => 'true_false',
				'message' => 'Show the time',
				'default_value' => (bool) $default_event_show_time,
			),
			array (
				'key' => 'field_523b46ebe35f0',
				'label' => '',
				'name' => 'event_enable_countdown',
				'type' => 'true_false',
				'message' => 'Enable Rollover Countdown',
				'default_value' => (bool) $events_show_countdown_rollover,
			),
			array (
				'key' => 'field_51b8bf97193f8',
				'label' => 'City',
				'name' => 'event_city',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfa8193f9',
				'label' => 'Venue',
				'name' => 'event_venue',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fb',
				'label' => 'Map Link Label',
				'name' => 'event_map_label',
				'type' => 'text',
				'default_value' => 'Google Map',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => 'Google Map',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fa',
				'label' => 'Map Link',
				'name' => 'event_map',
				'type' => 'text',
				'instructions' => 'Add the link to Google Maps pointing to the Venue',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bff2193fd',
				'label' => 'Call to Action Label',
				'name' => 'event_action_label',
				'type' => 'text',
				'default_value' => 'Tickets',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => 'Tickets',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bff2193fb',
				'label' => 'Call to Action Link',
				'name' => 'event_link',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'format',
				2 => 'categories',
				3 => 'tags',
				4 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	
	register_field_group(array (
		'id' => 'acf_page-event-template',
		'title' => 'Events Query',
		'fields' => array (
			array (
				'key' => 'field_51b8bff2193fc',
				'label' => 'Filter By',
				'name' => 'events_filter',
				'type' => 'select',
				'choices' => array (
					'upcoming' => 'Upcoming Events',
					'past' => 'Past Events'
				),
				'default_value' => 'upcoming',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'archive-event.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));			

	register_field_group(array (
		'id' => 'acf_logos',
		'title' => 'Logos',
		'fields' => array (
			array (
				'key' => 'field_logos_1',
				'label' => 'Link Type',
				'name' => 'logo_link_type',
				'type' => 'radio',
				'choices' => array (
					'internal' => 'Internal Page',
					'external' => 'External Link',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'internal',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_logos_2',
				'label' => 'Logo Link',
				'name' => 'logo_link',
				'type' => 'page_link',
				'instructions' => 'Add link to redirect the user on click.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_logos_1',
							'operator' => '==',
							'value' => 'internal',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_logos_3',
				'label' => 'Logo Link',
				'name' => 'logo_link_external',
				'type' => 'text',
				'instructions' => 'Add link to redirect the user on click.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_logos_1',
							'operator' => '==',
							'value' => 'external',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'logo',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	register_field_group(array (
		'id' => 'acf_single-portfolio-options',
		'title' => 'Single Portfolio Options',
		'fields' => array (
			array (
				'key' => 'field_526d6d4f15ee9',
				'label' => 'Single Portfolio Template',
				'name' => 'single-portfolio-template',
				'type' => 'radio',
				'choices' => array (
					'default' => 'Default template',
					'blank' => 'Blank Template'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'default',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_526d6d4f15e39',
				'label' => 'Project Clients',
				'name' => 'project-clients',
				'type' => 'repeater',
				'sub_fields' => array (	
					array (
						'key' => 'field_526d6d4f15e31',
						'label' => 'Client Name',
						'name' => 'client_name',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Client',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6d4f15ee9',
							'operator' => '==',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				),
			),	
			array (
				'key' => 'field_526d6d4f15e19',
				'label' => 'Images Display',
				'name' => 'images-display',
				'type' => 'radio',
				'choices' => array (
					'slider' => 'Slider',
					'list' => 'List'
				),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6d4f15ee9',
							'operator' => '==',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_526d6d4f15e29',
				'label' => 'Project Images',
				'name' => 'project-images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_526d6d4f15e21',
						'label' => 'Image Upload',
						'name' => 'image_file',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'medium',
						'library' => 'all',
					),		
					array (
						'key' => 'field_526d6d4f15e22',
						'label' => 'Image Description',
						'name' => 'image_description',
						'type' => 'textarea',
						'default_value' => '',
						'formatting' => 'br',
						'maxlength' => '',
						'placeholder' => '',
					),
					
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6d4f15ee9',
							'operator' => '==',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_526d6d4f15e40',
				'label' => 'External Link Label',
				'name' => 'external_link_label',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6d4f15ee9',
							'operator' => '==',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_526d6d4f15e41',
				'label' => 'External Link',
				'name' => 'external_link',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6d4f15ee9',
							'operator' => '==',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_526d6d4f15e42',
				'label' => 'External Link Target',
				'name' => 'external_link_target',
				'type' => 'radio',
				'choices' => array (
					'_self' => 'Same Window',
					'_blank' => 'New Window'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'default',
				'layout' => 'vertical',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_526d6d4f15ee9',
							'operator' => '==',
							'value' => 'default',
						),
					),
					'allorany' => 'all',
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'portfolio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	

}

?>