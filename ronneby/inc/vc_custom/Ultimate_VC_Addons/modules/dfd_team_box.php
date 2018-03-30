<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Team Member Box
*/
if(!class_exists('Dfd_Team_Box')) 
{
	class Dfd_Team_Box{
		function __construct(){
			add_action('init',array($this,'dfd_team_member_init'));
			add_shortcode('dfd_team_member',array($this,'dfd_team_member_shortcode'));
		}
		function dfd_team_member_init(){
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
						'name' => __('Team member','dfd'),
						'base' => 'dfd_team_member',
						'class' => 'vc_info_banner_icon',
						'icon' => 'vc_icon_info_banner',
						//'deprecated' => '4.6',
						'category' => __('Ronneby 1.0','dfd'),
						'description' => __('Displays team member information','dfd'),
						'params' => array(
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Title ','dfd'),
								'param_name' => 'team_member_title',
								'admin_label' => true,
								'value' => '',
								'description' => ''
							),
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Subtitle ','dfd'),
								'param_name' => 'team_member_subtitle',
								'admin_label' => true,
								'value' => '',
								'description' => ''
							),
							array(
								'type' => 'textarea',
								'class' => '',
								'heading' => __('Description','dfd'),
								'param_name' => 'team_desc',
								'value' => '',
								'description' => ''
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Information Alignment', 'dfd'),
								'param_name' => 'info_alignment',
								'value' => array(
									__('Center', 'dfd') => 'text-center',
									__('Left', 'dfd') => 'text-left',
									__('Right', 'dfd') => 'text-right'
								)
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable team member custom link','dfd'),
								'param_name' => 'enable_custom_link',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Apply link to', 'dfd'),
								'param_name' => 'apply_link_to',
								'value' => array(
									__('Team member image', 'dfd') => 'image-link',
									__('Title', 'dfd') => 'title-link',
									__('Both title and image', 'dfd') => 'both-title-and-image',
								),
								'dependency' => array('element' => 'enable_custom_link','not_empty' => true),
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Custom link url', 'dfd'),
								'value' => '',
								'param_name' => 'custtom_link_url',
								'dependency' => array('element' => 'enable_custom_link','not_empty' => true),
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Team Member Image','dfd'),
								'param_name' => 'team_member_image',
								'value' => '',
								'description' => __('Upload the team member photo','dfd'),
								'group' => 'Image',
							),
							array(
								'type' => 'ult_param_heading',
								'text' => 'Image size',
								'param_name' => 'image_height_typography',
								'class' => 'ult-param-heading',
								'group' => 'Image',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image width', 'dfd'),
								'param_name' => 'team_item_width',
								'value' => 380,
								"group" => "Image",
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image height', 'dfd'),
								'param_name' => 'team_item_height',
								'value' => 340,
								"group" => "Image",
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Hover Mask Background Color:', 'dfd'),
								'param_name' => 'mask_bg_color',
								'value' => '',
								'description' => __('Select the color for hover mask background.', 'dfd'),								
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Heading Settings", 'dfd'),
								"param_name" => "main_heading_typograpy",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								//"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading type', 'dfd'),
								'param_name' => 'heading_typography_type',
								'value' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								"group" => "Typography",
								//"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "main_heading_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography",
								"dependency" => Array("element" => "heading_typography_type", "value" => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder' => 'div',
								'value' => '',
								"group" => "Typography",
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_heading_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('google_fonts')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_heading_default_style",
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"main_heading_default_weight",
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "main_heading_font_size",
								"min" => 10,
								"suffix" => "px",
								//"description" => __("Main heading font size", 'dfd'),
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "main_heading_color",
								"value" => "",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "main_heading_line_height",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "main_heading_letter_spacing",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Sub Heading Settings", 'dfd'),
								"param_name" => "sub_heading_typograpy",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading type', 'dfd'),
								'param_name' => 'subheading_typography_type',
								'value' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								"group" => "Typography",
								//"dependency" => Array("element" => "content", "not_empty" => true),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "sub_heading_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography",
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font subfamily', 'dfd' ),
								'param_name' => 'main_subheading_custom_family',
								'holder' => 'div',
								'value' => '',
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('default')),
								"group" => "Typography",
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"sub_heading_style",
								//"description"	=>	__("Sub heading font style", 'dfd'),
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('google_fonts')),
								"group" => "Typography",
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"sub_heading_default_style",
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"sub_heading_default_weight",
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "sub_heading_font_size",
								"min" => 14,
								"suffix" => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "sub_heading_color",
								"value" => "",
								//"description" => __("Sub heading color", 'dfd'),	
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "sub_heading_line_height",
								"value" => "",
								"suffix" => "px",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "sub_heading_letter_spacing",
								"value" => "",
								"suffix" => "px",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Icon hover style', 'dfd'),
								'param_name' => 'soc_icons_hover',
								'value' => dfd_soc_icons_hover_composer(),
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Deviantart link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_de',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Digg link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_dg',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Dribbble link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_dr',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Dropbox link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_db',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Evernote link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_en',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Facebook link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_fb',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Flickr link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_flk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Foursquare link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_fs',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Google + link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_gp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Instagram link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_in',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('LastFM link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_lf',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('LinkedIN link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_li',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Livejournal link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_lj',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Picasa link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_pi',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Pinterest link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_pt',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('RSS link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_rss',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Tumblr link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_tu',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Twitter link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_tw',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Vimeo link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vi',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Wordpress link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_wp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('YouTube link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_yt',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('500px link', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_500px',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Mail', 'dfd'),
								'description' => __('Type your email in a form, e.g.: mailto:youremail@mail.com', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ml',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('ViewBug', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vb',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('VKontakte', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Xing', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_xn',
								'group' => 'Social networks',
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Spotify', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sp',
								'group' => 'Social networks',
							),
						   array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Houzz', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_hz',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Skype', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Slideshare', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ss',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Bandcamp', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_bd',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Soundcloud', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sd',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Meerkat', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_mk',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Periscope', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ps',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Snapchat', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_sc',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('The City', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_tc',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Behance', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_bh',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Microsoft Pinpoint', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_pp',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Viadeo', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_vd',
								'group' => 'Social networks',
							),
							array(
								'type' => 'textfield',
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('TripAdvisor', 'dfd'),
								'value' => '',
								'param_name' => 'team_member_ta',
								'group' => 'Social networks',
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => 'Animation Settings',
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_team_member_shortcode($atts)
		{
			$output = $el_class = $module_animation = '';
			$team_member_title = $team_member_subtitle = $team_desc = $info_alignment = $team_member_image = $team_item_width = $team_item_height = $mask_bg_color = $soc_icons_hover = '';
			$team_member_de = $team_member_dg = $team_member_dr = $team_member_db = $team_member_en = $team_member_fb = $team_member_flk = $team_member_fs = '';
			$team_member_gp = $team_member_in = $team_member_lf = $team_member_li = $team_member_lj = $team_member_pi = $team_member_pt = $team_member_rss = '';
			$team_member_tu = $team_member_tw = $team_member_vi = $team_member_wp = $team_member_yt = $team_member_500 = $team_member_vb = $team_member_ml = $team_member_vk = '';
			$team_member_xn = $team_member_sp = $team_member_hz = $team_member_sk = $team_member_ss = $team_member_bd = $team_member_sd = $team_member_mk = $team_member_ps = '';
			$team_member_sc = $team_member_tc = $team_member_bh = $team_member_pp = $team_member_vd = $team_member_ta = '';
						
			$heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = '';
			$subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';
			$main_heading_style_inline = $sub_heading_style_inline = '';
			$enable_custom_link = $apply_link_to = $custtom_link_url = $before_title = $after_title = $before_mask = $after_mask = '';
			
			extract(shortcode_atts( array(
				'module_animation' => '',
				'team_member_title' => '',
				'team_member_subtitle' => '',
				'team_desc' => '',
				'info_alignment' => 'text-center',
				'enable_custom_link' => '',
				'apply_link_to' => 'image-link',
				'custtom_link_url' => '',
				'team_member_image' => '',
				'team_item_width' => '',
				'team_item_height' => '',
				'mask_bg_color' => '',
				'el_class' => '',
				'heading_typography_type'	=> 	'default',
				'main_heading_font_size'	=> 	'',
				'main_heading_font_family' => '',
				'main_heading_custom_family' => '',
				'main_heading_style'		=>	'',
				'main_heading_default_style'		=>	'',
				'main_heading_default_weight'		=>	'',
				'main_heading_color'		=>	'',
				'main_heading_line_height' => '',
				'main_heading_letter_spacing' => '',
				'subheading_typography_type'	=> 	'default',
				'sub_heading_font_size'	=> 	'',
				'sub_heading_font_family' => '',
				'main_subheading_custom_family' => '',
				'sub_heading_style'		=>	'',
				'sub_heading_default_style'		=>	'',
				'sub_heading_default_weight'		=>	'',
				'sub_heading_color'		=>	'',
				'sub_heading_line_height' => '',
				'sub_heading_letter_spacing' => '',
				'soc_icons_hover' => '',
				'team_member_de' => '',
				'team_member_dg' => '',
				'team_member_dr' => '',
				'team_member_db' => '',
				'team_member_en' => '',
				'team_member_fb' => '',
				'team_member_flk' => '',
				'team_member_fs' => '',
				'team_member_gp' => '',
				'team_member_in' => '',
				'team_member_lf' => '',
				'team_member_li' => '',
				'team_member_lj' => '',
				'team_member_pi' => '',
				'team_member_pt' => '',
				'team_member_rss' => '',
				'team_member_tu' => '',
				'team_member_tw' => '',
				'team_member_vi' => '',
				'team_member_wp' => '',
				'team_member_yt' => '',
				'team_member_500px' => '',
				'team_member_vb' => '',
				'team_member_ml' => '',
				'team_member_vk' => '',
				'team_member_xn' => '',
				'team_member_sp' => '',
				'team_member_hz' => '',
				'team_member_sk' => '',
				'team_member_ss' => '',
				'team_member_bd' => '',
				'team_member_sd' => '',
				'team_member_mk' => '',
				'team_member_ps' => '',
				'team_member_sc' => '',
				'team_member_tc' => '',
				'team_member_bh' => '',
				'team_member_pp' => '',
				'team_member_vd' => '',
				'team_member_ta' => '',
			),$atts));
			
			if($enable_custom_link) {
				$link_src = vc_build_link($custtom_link_url);
				if(!filter_var( $link_src['url'], FILTER_VALIDATE_URL ) === false || $link_src['url'] == '#') {
					$link_title = !empty($link_src['title']) ? 'title="'.esc_attr($link_src['title']).'"' : '';
					$link_target = !empty($link_src['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link_src['target'])).'"' : '';
					if($apply_link_to == 'title-link') {
						$before_title .= '<a href="'.esc_url($link_src['url']).'" '.$link_title.' '.$link_target.'>';
						$after_title .= '</a>';
					} elseif($apply_link_to == 'both-title-and-image') {
						$before_mask .= '<a href="'.esc_url($link_src['url']).'" '.$link_title.' '.$link_target.'>';
						$after_mask .= '</a>';
						$before_title .= '<a href="'.esc_url($link_src['url']).'" '.$link_title.' '.$link_target.'>';
						$after_title .= '</a>';
					} else {
						$before_mask .= '<a href="'.esc_url($link_src['url']).'" '.$link_title.' '.$link_target.'>';
						$after_mask .= '</a>';
					}
				}
			}
			
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.$mhfont_family.'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.$main_heading_custom_family.'\';';
			}
			// main heading font style
			if(strcmp($heading_typography_type, 'google_fonts') === 0) {
				$main_heading_style_inline .= get_ultimate_font_style($main_heading_style);
			}elseif(!empty($main_heading_default_style) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-style:'.esc_attr($main_heading_default_style).';';
			}
			if(!empty($main_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-weight:'.esc_attr($main_heading_default_weight).';';
			}
			//attach font size if set
			if($main_heading_font_size != '') {
				$main_heading_style_inline .= 'font-size:'.esc_attr($main_heading_font_size).'px;';
			}
			//attach font color if set	
			if($main_heading_color != '') {
				$main_heading_style_inline .= 'color:'.esc_attr($main_heading_color).';';
			}
			//line height
			if($main_heading_line_height != '') {
				$main_heading_style_inline .= 'line-height:'.esc_attr($main_heading_line_height).'px;';
			}
			//letter spacing
			if($main_heading_letter_spacing != '') {
				$main_heading_style_inline .= 'letter-spacing:'.esc_attr($main_heading_letter_spacing).'px;';
			}
				
			/* ----- sub heading styles ----- */
			if($sub_heading_font_family != '' && strcmp($subheading_typography_type, 'google_fonts') === 0)
			{
				$shfont_family = get_ultimate_font_family($sub_heading_font_family);
				$sub_heading_style_inline .= 'font-family:\''.$shfont_family.'\';';
			}elseif(!empty($main_subheading_custom_family) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-family:\''.$main_subheading_custom_family.'\';';
			}
			//sub heaing font style
			if(strcmp($subheading_typography_type, 'google_fonts') === 0) {
				$sub_heading_style_inline .= get_ultimate_font_style($sub_heading_style);
			}elseif(!empty($sub_heading_default_style) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-style:'.esc_attr($sub_heading_default_style).';';
			}
			if(!empty($sub_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-weight:'.esc_attr($sub_heading_default_weight).';';
			}
			//attach font size if set
			if($sub_heading_font_size != '') {
				$sub_heading_style_inline .= 'font-size:'.esc_attr($sub_heading_font_size).'px;';
			}
			//attach font color if set	
			if($sub_heading_color != '') {
				$sub_heading_style_inline .= 'color:'.esc_attr($sub_heading_color).';';	
			}
			//line height
			if($sub_heading_line_height != '') {
				$sub_heading_style_inline .= 'line-height:'.esc_attr($sub_heading_line_height).'px;';
			}
			//letter spacing
			if($sub_heading_letter_spacing != '') {
				$sub_heading_style_inline .= 'letter-spacing:'.esc_attr($sub_heading_letter_spacing).'px;';	
			}
			
			if($soc_icons_hover == '') {
				$soc_icons_hover = '1';
			}
			
			$soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.esc_attr($soc_icons_hover);
			
			$social_icons = array(
				'de' => 'soc_icon-deviantart',
				'dg' => 'soc_icon-digg',
				'dr' => 'soc_icon-dribbble',
				'db' => 'soc_icon-dropbox',
				'en' => 'soc_icon-evernote',
				'fb' => 'soc_icon-facebook',
				'flk' => 'soc_icon-flickr',
				'fs' => 'soc_icon-foursquare_2',
				'gp' => 'soc_icon-google__x2B_',
				'in' => 'soc_icon-instagram',
				'lf' => 'soc_icon-last_fm',
				'li' => 'soc_icon-linkedin',
				'lj' => 'soc_icon-livejournal',
				'pi' => 'soc_icon-picasa',
				'pt' => 'soc_icon-pinterest',
				'rss' => 'soc_icon-rss',
				'tu' => 'soc_icon-tumblr',
				'tw' => 'soc_icon-twitter-3',
				'vi' => 'soc_icon-vimeo',
				'wp' => 'soc_icon-wordpress',
				'yt' => 'soc_icon-youtube',
				'500px' => 'dfd-added-font-icon-px-icon',
				'vb' => 'dfd-added-font-icon-vb',
				'ml' => 'soc_icon-mail',
				'vk' => 'soc_icon-rus-vk-02',
				'xn' => 'dfd-added-font-icon-b_Xing-icon_bl',
				'sp' => 'dfd-added-font-icon-c_spotify-512-black',
				'hz' => 'dfd-added-font-icon-houzz-dark-icon',
				'sk' => 'dfd-added-font-icon-skype',
				'ss' => 'dfd-added-font-icon-slideshare',
				'bd' => 'dfd-added-font-icon-bandcamp-logo',
				'sd' => 'dfd-added-font-icon-soundcloud-logo',
				'mk' => 'dfd-added-font-icon-Meerkat-color',
				'ps' => 'dfd-added-font-icon-periscope-logo',
				'sc' => 'dfd-added-font-icon-Snapchat-logo',
				'tc' => 'dfd-added-font-icon-the-city',
				'bh' => 'soc_icon-behance',
				'pp' => 'dfd-added-font-icon-pinpoint',
				'vd' => 'dfd-added-font-icon-viadeo',
				'ta' => 'dfd-added-font-icon-tripadvisor',
			);
			
			$mask_css = $soc_icons_html = '';
			
			foreach($social_icons as $key => $value) {
				$url = 'team_member_'.$key;
				if(!empty($$url)) {
					$link = vc_build_link($$url);
					if(!filter_var( $link['url'], FILTER_VALIDATE_URL ) === false || $link['url'] == '#')
						$soc_icons_html .= '<a href="'.esc_url($link['url']).'" class="'.esc_attr($value).'" target="_blank"><span class="line-top-left '.esc_attr($value).'"></span><span class="line-top-center '.esc_attr($value).'"></span><span class="line-top-right '.esc_attr($value).'"></span><span class="line-bottom-left '.esc_attr($value).'"></span><span class="line-bottom-center '.esc_attr($value).'"></span><span class="line-bottom-right '.esc_attr($value).'"></span><i class="'.esc_attr($value).'"></i></a>';
				}
			}
			
			$team_member_src = wp_get_attachment_image_src($team_member_image,'full');
			$team_member_img_meta = wp_get_attachment_metadata($team_member_image);
			
			if(isset($team_member_img_meta['image_meta']['caption']) && $team_member_img_meta['image_meta']['caption'] != '') {
				$caption = $team_member_img_meta['image_meta']['caption'];
			} else if(isset($team_member_img_meta['image_meta']['title']) && $team_member_img_meta['image_meta']['title'] != '') {
				$caption = $team_member_img_meta['image_meta']['title'];
			} else {
				$caption = 'team image';
			}
			
			$id = uniqid(rand());

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if(empty($team_item_width)) {
				$team_item_width = 380;
			}
			
			if(empty($team_item_height)) {
				$team_item_height = 340;
			}
			
			if($mask_bg_color != '') {
				$mask_css .= 'style="background: '.esc_attr($mask_bg_color).';"';
			}
			
			$output .= '<div id="dfdteam-'.esc_attr($id).'" class="dfd-team-box '.esc_attr($info_alignment).' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
				
				$output .= '<div class="dfd-team-front">';
			
					if(isset($team_member_src[0]) && $team_member_src[0] != '') {
						$team_member_img_url = dfd_aq_resize($team_member_src[0], $team_item_width, $team_item_height, true, true, true);
						
						if(!$team_member_img_url) {
							$team_member_img_url = $team_member_src[0];
						}
						
						$output .= '<div class="image-wrap">';
						$output .= '<img src="'.esc_url($team_member_img_url).'" alt="'.esc_attr($caption).'"/>';
						$output .= '<div class="hover-mask" '.$mask_css.'>'.$before_mask . $after_mask.'</div>';
						$output .= '</div>';
					}
					
					if(!empty($soc_icons_html)) {
						$output .= '<div class="soc-icon-aligment"><div class="widget soc-icons '.esc_attr($soc_icons_hover_style).'">'.$soc_icons_html.'</div></div>';
					}
					
					if($team_member_title != '' || $team_member_subtitle != '') {
						$output .= '<div class="dfd-team-box-heading">';
						if($team_member_title != '') {
							$output .= '<div class="feature-title" style="'.$main_heading_style_inline.'">'.$before_title . $team_member_title . $after_title .'</div>';
						}
						if($team_member_subtitle != '') {
							$output .= '<div class="subtitle" style="'.$sub_heading_style_inline.'">'.$team_member_subtitle.'</div>';
						}
						$output .= '</div>';
					}
				
				$output .= '</div>';
				$output .= '<div class="dfd-team-back">';
				
					if($team_desc != '') {
						$output .= '<div class="content">'.$team_desc.'</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Team_Box'))
{
	$Dfd_Team_Box = new Dfd_Team_Box;
}
