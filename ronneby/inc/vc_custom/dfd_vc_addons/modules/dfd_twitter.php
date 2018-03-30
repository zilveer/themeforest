<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Twitter module
*/
if(!class_exists('Dfd_Twitter')) 
{
	class Dfd_Twitter{
		function __construct(){
			add_action('init',array($this,'dfd_twitter_init'));
			add_shortcode('dfd_twitter',array($this,'dfd_twitter_shortcode'));
		}
		function dfd_twitter_init(){
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/twitter/';
				vc_map(
					array(
					   'name'				=> esc_html__('Twitter module','dfd'),
					   'base'				=> 'dfd_twitter',
					   'class'				=> 'vc_info_banner_icon',
					   'icon'				=> 'vc_icon_info_banner',
					   'category'			=> esc_html__('Ronneby 2.0','dfd'),
					   'description'		=> esc_html__('Displays recent tweets carousel','dfd'),
					   'params' => array(
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> __('Please make sure that you have all necessary options filled in Twitter options section of <a href="'.admin_url('admin.php?page=_options').'" target="_blank">Theme options panel</a> before using this module.', 'dfd'),
								'param_name'		=> 'main_heading_typograpy',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'heading'			=> esc_html__( 'Select Style', 'dfd' ),
								'description'		=> '',
								'type'				=> 'radio_image_select',
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'style-1'	=> array(
										'tooltip'	=> esc_attr__('Gray icon','dfd'),
										'src'		=> $module_images . 'style-1.png'
									),
									'style-2'	=> array(
										'tooltip'	=> esc_attr__('Top icon','dfd'),
										'src'		=> $module_images . 'style-2.png'
									),
									'style-3'	=> array(
										'tooltip'	=> esc_attr__('Bottom icon','dfd'),
										'src'		=> $module_images . 'style-3.png'
									),
									'style-4'	=> array(
										'tooltip'	=> esc_attr__('Left icon','dfd'),
										'src'		=> $module_images . 'style-4.png'
									),
									'style-5'	=> array(
										'tooltip'	=> esc_attr__('Right icon','dfd'),
										'src'		=> $module_images . 'style-5.png'
									),
									'style-6'	=> array(
										'tooltip'	=> esc_attr__('Bottom right icon','dfd'),
										'src'		=> $module_images . 'style-6.png'
									),
									'style-7'	=> array(
										'tooltip'	=> esc_attr__('Bottom left icon','dfd'),
										'src'		=> $module_images . 'style-7.png'
									),
								),
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Number of slides to display', 'dfd'),
								'param_name'		=> 'slides_to_show',
								'value'				=> 1,
								'group'				=> esc_html__('Sliding', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Number of slides to scroll', 'dfd'),
								'param_name'		=> 'slides_to_scroll',
								'value'				=> 1,
								'group'				=> esc_html__('Sliding', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Slideshow speed', 'dfd'),
								'param_name'		=> 'slideshow_speed',
								'value'				=> 3000,
								'group'				=> esc_html__('Sliding', 'dfd')
							),
							array(
								'type'				=> 'checkbox',
								'class'				=> '',
								'heading'			=> esc_html__('Enable autoslideshow','dfd'),
								'param_name'		=> 'auto_slideshow',
								'value'				=> array('Enable autoslideshow' => 'yes'),
								'group'				=> esc_html__('Sliding', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type'				=> 'checkbox',
								'class'				=> '',
								'heading'			=> esc_html__('Enable pagination','dfd'),
								'param_name'		=> 'enable_dots',
								'value'				=> array('Enable pagination' => 'yes'),
								'group'				=> esc_html__('Sliding', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type'				=> 'dropdown',
								'param_name'		=> 'dots_style',
								'value'				=> array(
									esc_html__( 'Dfd Style rounded', 'dfd' )        => 'dfdrounded',
									esc_html__( 'Dfd Style fill rounded', 'dfd' )   => 'dfdfillrounded',
									esc_html__( 'Dfd Style empty rounded', 'dfd' )  => 'dfdemptyrounded',
									esc_html__( 'Dfd Style fill square', 'dfd' )    => 'dfdfillsquare',
									esc_html__( 'Dfd Style advance square', 'dfd' ) => 'dfdadvancesquare',
									esc_html__( 'Dfd Style line', 'dfd' )           => 'dfdline',
								),
								'heading'			=> esc_html__( 'Pagination style', 'dfd' ),
								'description'		=> esc_html__( 'Select pagination style.', 'dfd' ),
								'group'				=> esc_html__( 'Sliding', 'dfd' ),
								'dependency'		=> array('element' => 'enable_dots', 'value' => 'yes'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Text Alignment','dfd'),
								'param_name' => 'text_alignment',
								'value' => array(
									__('Left','dfd') => 'text-left',
									__('Center','dfd') => 'text-center',
									__('Right','dfd') => 'text-right'
								)
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> esc_html__('Extra class name', 'js_composer'),
								'param_name'		=> 'el_class',
								'description'		=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'		=> 'content_t_heading',
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'crumina_font_container',
								'heading'			=> '',
								'param_name'		=> 'font_options',
								'settings'			=> array(
									'fields'		=> array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'				=> 'checkbox',
								'heading'			=> esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'		=> 'use_google_fonts',
								'value'				=> array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description'		=> esc_html__( 'Use font family from google.', 'dfd' ),
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'				=> 'google_fonts',
								'param_name'		=> 'custom_fonts',
								'value'				=> '',
								'group'				=> esc_attr__( 'Typography', 'dfd' ),
								'settings'			=> array(
									'fields'		=> array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__( 'Icon', 'dfd' ) . ' ' . esc_html__( 'Decoration', 'dfd' ),
								'param_name'		=> 'icon_t_decoration',
								'group'				=> esc_html__( 'Typography', 'dfd' ),
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Icon Size', 'dfd'),
								'param_name'		=> 'icon_size',
								'value'				=> '',
								'min'				=> 10,
								'max'				=> 100,
								'group'				=> esc_html__('Typography', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> esc_html__( 'Color', 'dfd' ),
								'param_name'		=> 'icon_color',
								'value'				=> '',//#5eaade
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'group'				=> esc_html__( 'Typography', 'dfd' ),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__( 'Link', 'dfd' ) . ' ' . esc_html__( 'Decoration', 'dfd' ),
								'param_name'		=> 'link_t_decoration',
								'description'		=> esc_html__( 'By default the value is set from theme options.', 'dfd' ),
								'group'				=> esc_html__( 'Typography', 'dfd' ),
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'number',
								'class'				=> '',
								'heading'			=> esc_html__('Font size', 'dfd'),
								'param_name'		=> 'link_size',
								'value'				=> '',
								'min'				=> 5,
								'max'				=> 50,
								'group'				=> esc_html__('Typography', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => esc_html__( '', 'dfd' ),
								'group'       => esc_html__('Animation Settings', 'dfd'),
							),
						),
					)
				);
			}
		}
		function _crum_parse_text_shortcode_params( $string ) {
			$parsed_param = array();
			$param_value  = explode( '|', $string );
			if ( is_array( $param_value ) ) {
				foreach ( $param_value as $single_param ) {
					$single_param                     = explode( ':', $single_param );
					if(isset($single_param[1]))
						$parsed_param[ $single_param[0] ] = $single_param[1];
				}
			}

			return $parsed_param;
		}
		// Shortcode handler function
		function dfd_twitter_shortcode($atts) {
			$output = $el_class = $tweets = $text_alignment = $module_animation = $icon_color = $icon_size = $link_size = $icon_style = $link_style_css = '';
			$main_style = $font_options = $use_google_fonts = $custom_fonts = $content_typo = $google_fonts_obj = $icon_html = $dots_style = $dots_class = '';
			$icon_echo_st1 = $icon_echo_st2 = $icon_echo_st3 = $icon_echo_st4 = $icon_echo_st5 = $icon_echo_st6 = $icon_echo_st7 = $main_style_class = '';
			
			extract(shortcode_atts( array(
				'main_style' => 'style-1',
				'slides_to_show' => '1',
				'slides_to_scroll' => '1',
				'slideshow_speed' => '3000',
				'auto_slideshow' => '',
				'enable_dots' => '',
				'text_alignment' => 'text-left',
				'module_animation' => '',
				'el_class' => '',
				'font_options' => '',
				'use_google_fonts' => '',
				'custom_fonts' => '',
				'icon_size' => '',
				'icon_color' => '',
				'link_size' => '',
				'dots_style' => 'dfdrounded',
			),$atts));
			
			$unique_id = uniqid('dfd-twitter-module-');
			
			if(empty($slides_to_show)) {
				$slides_to_show = 1;
			}
			
			if(empty($slides_to_scroll)) {
				$slides_to_scroll = 1;
			}
			
			if(empty($slideshow_speed)) {
				$slideshow_speed = 3000;
			}
			
			if(empty($auto_slideshow)) {
				$auto_slideshow = 'false';
			} else {
				$auto_slideshow = 'true';
			}
			
			if(empty($enable_dots)) {
				$enable_dots = 'false';
			} else {
				$enable_dots = 'true';
			}
			
			if(isset($dots_style) && !empty($dots_style)) {
				$dots_class = $dots_style;
			}
			
			$icon_style .= 'style="';
			if($icon_color) {
				$icon_style .= 'color:' .$icon_color.'; ';
			}
			if($icon_size) {
				$icon_style .= 'font-size:' .$icon_size.'px; ';
			}
			$icon_style .= '"';
			
			if(isset($text_alignment) && strcmp($text_alignment, 'text-left') === 0 ) {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .dfd-slick-dots {text-align: left;}';
			}elseif (strcmp($text_alignment, 'text-right') === 0) {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .dfd-slick-dots {text-align: right;}';
			}
			
			if(isset($main_style) && !empty($main_style)) {
				$icon_html = '<i class="icon-module-twitt soc_icon-twitter-3" '.$icon_style.'></i>';
				
				if(strcmp($main_style, 'style-1') === 0) {
					$icon_echo_st1 = $icon_html;
				}elseif(strcmp($main_style, 'style-2') === 0) {
					$icon_echo_st2 = $icon_html;
				}elseif(strcmp($main_style, 'style-3') === 0) {
					$icon_echo_st3 = $icon_html;
				}elseif(strcmp($main_style, 'style-4') === 0) {
					$icon_echo_st4 = $icon_html;
				}elseif(strcmp($main_style, 'style-5') === 0) {
					$icon_echo_st5 = $icon_html;
				}elseif(strcmp($main_style, 'style-6') === 0) {
					$icon_echo_st6 = $icon_html;
				}elseif(strcmp($main_style, 'style-7') === 0) {
					$icon_echo_st7 = $icon_html;
				}
			}
			// Text Typography.
			$font_options = _crum_parse_text_shortcode_params( $font_options, 'content', $use_google_fonts, $custom_fonts );
			
			
			if($link_size !== '') {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .tweet-item .tweet .tweet-content a {font-size: '.esc_attr($link_size).'px;}';
			}
			
			// Get the tweets from Twitter.
			require_once locate_template('/inc/lib/twitteroauth.php');
			$twitter = new DFDTwitter();
			$tweets = $twitter->getTweets();

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$output .= '<div class="dfd-twitter-module dfd-dots-enabled icon-'.esc_attr($main_style).' '.esc_attr($dots_class).' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
				if(!$twitter->hasError()) {
					if(!empty($tweets)) {
						$output .= '<div id="'.esc_attr($unique_id).'">';
							foreach($tweets as $tweet) {
								$output .= '<div class="tweet-item">';
									$output .= $icon_echo_st4;
									$output .= '<div class="tweet '.esc_attr($text_alignment).'">';
										$output .= $icon_echo_st2;
										$output .= '<'.$font_options['tag'].' class="tweet-content '.esc_attr($font_options['class']).'" ' . $font_options['style'] . '>';
											$output .= $icon_echo_st1;
											$output .= $tweet['text'];
										$output .= '</'.$font_options['tag'].'>';
										$output .= '<div class="date subtitle">';
											$output .= $icon_echo_st7;
											$output .= date('d F Y', $tweet['time']);//human_time_diff($t['time'], current_time('timestamp'));
											$output .= $icon_echo_st6;
										$output .= '</div>';
										$output .= $icon_echo_st3;
									$output .= '</div>';
									$output .= $icon_echo_st5;
								$output .= '</div>';
							}
						$output .= '</div>';
					}
				} else {
					$output .= '<p class="text-bold text-center">';
						$output .= $twitter->getError()->message;
					$output .= '</p>';
				}
			$output .= '</div>';
			if(!$twitter->hasError() && !empty($tweets)) {

				$breakpoint_first = ($slides_to_show > 3) ? 3 : $slides_to_show;

				$breakpoint_second = ($slides_to_show > 2) ? 2 : $slides_to_show;

				$output .= '<script type="text/javascript">
					(function($) {
						"use strict";
						$(document).ready(function() {
							$("#'.esc_js($unique_id).'").slick({
								infinite: true,
								slidesToShow: '.esc_js($slides_to_show).',
								slidesToScroll: '.esc_js($slides_to_scroll).',
								arrows: false,
								dots: '.esc_js($enable_dots).',
								autoplay: '.esc_js($auto_slideshow) .',
								dotsClass: \'dfd-slick-dots\',
								autoplaySpeed: '.esc_js($slideshow_speed) .',
								customPaging: function(slider, i) {
									return \'<span data-role="none" role="button" aria-required="false" tabindex="0"></span>\';
								},
								responsive: [
									{
										breakpoint: 1280,
										settings: {
											slidesToShow: '.esc_js($breakpoint_first).',
											infinite: true,
											arrows: false,
											dots: '.esc_js($enable_dots) .'
										}
									},
									{
										breakpoint: 800,
										settings: {
											slidesToShow: '.$breakpoint_second.',
											infinite: true,
											arrows: false,
											dots: '.esc_js($enable_dots) .'
										}
									}
								]
							});
						});
						$("#'. esc_js($unique_id) .'").next(".slider-controls").find(".next").click(function(e) {
							$("#'. esc_js($unique_id) .'").slickNext();

							e.preventDefault();
						});

						$("#'. esc_js($unique_id).'").next(".slider-controls").find(".prev").click(function(e) {
							$("#'. esc_js($unique_id) .'").slickPrev();

							e.preventDefault();
						});
						$("#'. esc_js($unique_id) .' .tweet-item").on("mousedown select",(function(e){
							e.preventDefault();
						}));
					})(jQuery);
				</script>';
			}
			if(!empty($link_style_css)) {
				$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style type=\'text/css\'>'.esc_js($link_style_css).'</style>");
					})(jQuery);
				</script>';
			}
			return $output;
		}
	}
}
if(class_exists('Dfd_Twitter'))
{
	$Dfd_Twitter = new Dfd_Twitter;
}