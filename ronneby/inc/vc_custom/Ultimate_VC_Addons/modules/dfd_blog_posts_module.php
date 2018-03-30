<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
if(!class_exists('Dfd_Posts')) {
	class Dfd_Posts {
		function __construct(){
			add_action('init',array($this,'blog_init'));
			add_shortcode('dfd_blog',array($this,'blog_shortcode'));
		}
		function blog_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Blog posts','dfd'),
						'base' => 'dfd_blog',
						'class' => 'vc_interactive_icon',
						'icon' => 'vc_icon_interactive',
						'category' => __('Ronneby 1.0','dfd'),
						'description' => __('Displays blog posts','dfd'),
						//'deprecated' => '4.6',
						'params' => array(
							array(
								'type' => 'dropdown',
								'heading' => __('Blog posts style','dfd'),
								'param_name' => 'blog_posts_styles',
								'value' => array(
									__('Blog isotope', 'dfd') => 'blog_masonry',
									__('Posts slider', 'dfd') => 'posts_slider',
									__('Wide posts', 'dfd') => 'wide_posts',
									__('Posts list', 'dfd') => 'posts_list',
									__('Single post item', 'dfd') => 'single_post',
									__('Last three posts', 'dfd') => 'last_three_posts',
									__('Last four posts', 'dfd') => 'last_four_posts',
								),
							),
							array(
								'type' => 'radio_image_post_select',
								'heading' => __('post to display','dfd'),
								'param_name' => 'single_custom_post_item',
								'value' => '',
								'post_type' => 'post',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => __('Select portfolio item to display', 'dfd'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('single_post')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Categories','dfd'),
								'param_name' => 'post_categories',
								'value' => dfd_get_select_options_multi('category'),
								//"description" => __("If the description text is not suiting well on specific screen sizes, you may enable this option - which will hide the description text.",'dfd'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','posts_slider','wide_posts','last_three_posts','last_four_posts','posts_list')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Loop include/exclude','dfd'),
								'param_name' => 'post_catgories_option',
								'value' => array(
									__('Include','dfd') => 'include',
									__('Exclude','dfd') => 'exclude',
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','posts_slider','wide_posts','last_three_posts','last_four_posts','posts_list')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Module Style','dfd'),
								'param_name' => 'last_four_posts_style',
								'value' => array(
									__('Main post left','dfd') => '',
									__('Main post top','dfd') => 'dfd-main-news-top',
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('last_four_posts')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Image mask style','dfd'),
								'param_name' => 'image_mask_background',
								'value' => array(
									__('No mask','dfd') => '',
									__('Color','dfd') => 'color',
									__('Gradient','dfd') => 'gradient',
								),
								'group' => 'Mask',
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider','last_three_posts','last_four_posts','posts_list','single_post')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image mask opacity', 'dfd'),
								'param_name' => 'image_mask_opacity',
								'value' => 1,
								'dependency' => array('element' => 'image_mask_background','value' => array('color','gradient')),
								'group' => 'Mask',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image mask opacity on hover', 'dfd'),
								'param_name' => 'image_mask_opacity_hover',
								'value' => 0,
								'dependency' => array('element' => 'image_mask_background','value' => array('color','gradient')),
								'group' => 'Mask',
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'image_mask_color',
								'class' => '',
								'heading' => __('Image mask color', 'dfd'),
								'value' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('color')),
								'group' => 'Mask',
							),
							array(
								'type' => 'gradient',
								'param_name' => 'image_mask_gradient',
								'class' => '',
								'heading' => __('Image mask gradient', 'dfd'),						
								'description' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('gradient')),
								'group' => 'Mask',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Image alignment','dfd'),
								'param_name' => 'posts_list_configuration',
								'value' => array(
									__('Image to the left from description','dfd') => 'left-image',
									__('Image to the right from description','dfd') => 'right-image',
									__('Description under image','dfd') => 'top-image',
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_list','single_post')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Module Style','dfd'),
								'param_name' => 'posts_list_style',
								'value' => array(
									__('Standard','dfd') => '',
									__('Half-size image','dfd') => 'dfd-half-size-image',
								),
								'dependency' => array('element' => 'posts_list_configuration','value' => array('right-image','left-image')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Number of Columns','dfd'),
								'param_name' => 'posts_list_columns',
								'value' => array(
									__('One','dfd') => 1,
									__('Two','dfd') => 2,
									__('Three','dfd') => 3,
									__('Four','dfd') => 4,
								),
								'dependency' => array('element' => 'posts_list_configuration','value' => array('top-image')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Main news title position','dfd'),
								'param_name' => 'main_news_style',
								'value' => array(
									__('Under thumbnail image','dfd') => '',
									__('In front of thumbnail image','dfd') => 'title-on-image',
								),
								'group' => 'Heading',
								'dependency' => array('element' => 'blog_posts_styles','value' => array('last_three_posts')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Title position','dfd'),
								'param_name' => 'title_position',
								'value' => array(
									__('Over media content','dfd') => 'top',
									__('Under media content','dfd') => 'bottom',
								),
								'group' => 'Heading',
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','single_post','last_three_posts','last_four_posts')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Offset', 'dfd'),
								'param_name' => 'query_offset',
								'value' => '',
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','posts_slider','wide_posts','posts_list')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Hide comments count','dfd'),
								'param_name' => 'hide_comments',
								'value' => array(__('Yes, please','dfd') => true),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','single_post','last_three_posts','last_four_posts')),
								'group' => 'Content',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Hide post like button','dfd'),
								'param_name' => 'hide_post_like',
								'value' => array(__('Yes, please','dfd') => true),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','single_post','last_three_posts','last_four_posts')),
								'group' => 'Content',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Meta to hide','dfd'),
								'param_name' => 'meta_to_hide',
								'value' => array(
									__('Hide date','dfd') => 'hide_date',
									__('Hide author','dfd') => 'hide_author',
									__('Hide category','dfd') => 'hide_category',
								),
								'group' => 'Content',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Meta to hide for additional news','dfd'),
								'param_name' => 'meta_to_hide_additional',
								'value' => array(
									__('Hide date','dfd') => 'hide_date',
									__('Hide author','dfd') => 'hide_author',
									__('Hide category','dfd') => 'hide_category',
								),
								'group' => 'Content',
								'dependency' => array('element' => 'blog_posts_styles','value' => array('last_three_posts','last_four_posts')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Hide excerpt','dfd'),
								'param_name' => 'hide_excerpt',
								'value' => array(__('Yes, please','dfd') => 'yes'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','wide_posts','posts_list','last_three_posts','last_four_posts','single_post')),
								'group' => 'Content',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Excerpt length', 'dfd'),
								'param_name' => 'excerpt_length',
								'value' => '',
								'min' => '1',
								'max' => '30',
								'description' => __('Please select value from 1 to 30 words','dfd'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','wide_posts','posts_list','last_three_posts','last_four_posts','single_post')),
								'group' => 'Content',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 675,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider','last_three_posts','last_four_posts','posts_list','single_post')),
								'group' => 'Image',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 450,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider','last_three_posts','last_four_posts','posts_list','single_post')),
								'group' => 'Image',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Small image width', 'dfd'),
								'param_name' => 'small_image_width',
								'value' => 400,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('last_three_posts', 'last_four_posts')),
								'group' => 'Image',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Small image height', 'dfd'),
								'param_name' => 'small_image_height',
								'value' => 350,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('last_three_posts' ,'last_four_posts')),
								'group' => 'Image',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Number of posts to display', 'dfd'),
								'param_name' => 'posts_to_show',
								'value' => 9,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry','posts_slider','wide_posts','posts_list')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Number of slides to display', 'dfd'),
								'param_name' => 'slides_to_show',
								'value' => 4,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Number of slides to scroll', 'dfd'),
								'param_name' => 'slides_to_scroll',
								'value' => 1,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Slideshow speed', 'dfd'),
								'param_name' => 'slideshow_speed',
								'value' => 3000,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Responsive breakpoint one', 'dfd'),
								'param_name' => 'responsive_brekpoint_first',
								'value' => 1280,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
								'group'       => 'Responsive',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Responsive breakpoint two', 'dfd'),
								'param_name' => 'responsive_brekpoint_second',
								'value' => 1024,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
								'group'       => 'Responsive',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Responsive breakpoint three', 'dfd'),
								'param_name' => 'responsive_brekpoint_third',
								'value' => 675,
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
								'group'       => 'Responsive',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable autoslideshow','dfd'),
								'param_name' => 'auto_slideshow',
								'value' => array('Enable autoslideshow' => 'yes'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable pagination','dfd'),
								'param_name' => 'enable_dots',
								'value' => array('Enable pagination' => 'yes'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('posts_slider')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Content alignment','dfd'),
								'param_name' => 'content_alignment',
								"value" => array(
									__('Center','dfd') => "text-center",
									__('Left','dfd') => "text-left",
									__('Right','dfd') => "text-right"
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('wide_posts')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Content width','dfd'),
								'param_name' => 'layout_style',
								'value' => array(
									__('Boxed','dfd') => '',
									__('Full width','dfd') => 'dfd-blog-module-full-width'
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('wide_posts')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Layout mode','dfd'),
								'param_name' => 'masonry_layout_mode',
								'value' => array(
									__('Masonry','dfd') => 'masonry',
									__('Grid','dfd') => 'fitRows'
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable sort panel','dfd'),
								'param_name' => 'enable_sort_panel',
								'value' => array('Enable sort panel' => 'yes'),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Sort panel alignment','dfd'),
								'param_name' => 'sort_panel_alignment',
								'value' => array(
									__('Center','dfd') => 'text-center',
									__('Left','dfd') => 'text-left',
									__('Right','dfd') => 'text-right'
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Hover effect style for "MORE INFO" button','dfd'),
								'param_name' => 'hover_read_more_style',
								'value' => array(
									__('Shuffle', 'dfd') => 'chaffle',
									__('Slide up', 'dfd') => 'slide-up',
								),
								'dependency' => array('element' => 'blog_posts_styles','value' => array('blog_masonry', 'wide_posts')),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Heading Settings', 'dfd'),
								'param_name' => 'main_heading_typograpy',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => 'Heading',
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
								'group' => 'Heading',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'main_heading_font_family',
								'description' => __('Select the font of your choice. You can <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">add new in the collection here</a>.', 'dfd'),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Heading',
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder' => 'div',
								'value' => '',
								'group' => 'Heading',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'main_heading_style',
								//'description'	=>	__('Main heading font style', 'dfd'),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Heading',
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'main_heading_default_style',
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
								'group' => 'Heading',
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Weight', 'dfd'),
								'param_name'	=>	'main_heading_default_weight',
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
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
								'group' => 'Heading',
							),
							array(
								'type' => 'number',
								'class' => 'font-size',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'main_heading_font_size',
								'min' => 10,
								'suffix' => 'px',
								'group' => 'Heading',
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Font Color', 'dfd'),
								'param_name' => 'main_heading_color',
								'value' => '',
								'group' => 'Heading',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Line Height', 'dfd'),
								'param_name' => 'main_heading_line_height',
								'value' => '',
								'suffix' => 'px',
								'group' => 'Heading',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Letter spacing', 'dfd'),
								'param_name' => 'main_heading_letter_spacing',
								'value' => '',
								'suffix' => 'px',
								'group' => 'Heading',
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Additional news heading style', 'dfd'),
								'param_name' => 'sub_heading_typograpy',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'dependency' => Array('element' => 'blog_posts_styles', 'value' => array('last_three_posts','last_four_posts')),
								'group' => 'Heading',
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
								'group' => 'Heading',
								'dependency' => Array('element' => 'blog_posts_styles', 'value' => array('last_three_posts','last_four_posts')),
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'sub_heading_font_family',
								'description' => __('Select the font of your choice. You can <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">add new in the collection here</a>.', 'dfd'),
								'group' => 'Typography',
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font subfamily', 'dfd' ),
								'param_name' => 'main_subheading_custom_family',
								'holder' => 'div',
								'value' => '',
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Heading',
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'sub_heading_style',
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Heading',
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'sub_heading_default_style',
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Heading',
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Weight', 'dfd'),
								'param_name'	=>	'sub_heading_default_weight',
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
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Heading',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'sub_heading_font_size',
								'min' => 14,
								'suffix' => 'px',
								'group' => 'Heading',
								'dependency' => Array('element' => 'blog_posts_styles', 'value' => array('last_three_posts','last_four_posts')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Font Color', 'dfd'),
								'param_name' => 'sub_heading_color',
								'value' => '',
								'group' => 'Heading',
								'dependency' => Array('element' => 'blog_posts_styles', 'value' => array('last_three_posts','last_four_posts')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Line Height', 'dfd'),
								'param_name' => 'sub_heading_line_height',
								'value' => '',
								'suffix' => 'px',
								'group' => 'Heading',
								'dependency' => Array('element' => 'blog_posts_styles', 'value' => array('last_three_posts','last_four_posts')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Letter spacing', 'dfd'),
								'param_name' => 'sub_heading_letter_spacing',
								'value' => '',
								'suffix' => 'px',
								'dependency' => Array('element' => 'blog_posts_styles', 'value' => array('last_three_posts','last_four_posts')),
								'group' => 'Heading',
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => 'Animation',
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for stats banner
		function blog_shortcode($atts) {
			$output = $sort_panel_html = $image_width = $image_height = $works_num = $sort_panel_alignment = $content_alignment = /*$wide_posts_image_height = */ $query_offset = $module_animation = $hover_read_more_style = $single_custom_post_item = $title_position = $posts_to_show = $posts_list_configuration = $posts_list_style = $main_news_style = $image_mask_background = $image_mask_color = $image_mask_gradient = '';
			$last_four_posts_style = $meta_to_hide = $meta_to_hide_additional = $hide_excerpt = $layout_style = $masonry_layout_mode = $responsive_brekpoint_first = $responsive_brekpoint_second = $responsive_brekpoint_third = $small_image_width = $small_image_height = $posts_list_columns = $image_mask_opacity = $image_mask_opacity_hover = 0;
			$heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = '';
			$subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';
			extract(shortcode_atts( array(
				'blog_posts_styles' => '',
				'post_categories' => '',
				'post_catgories_option' => 'include',
				'posts_list_configuration' => 'left-image',
				'posts_list_style' => '',
				'posts_list_columns' => '',
				'main_news_style' => '',
				'title_position' => 'top',
				'image_width' => '675',
				'image_height' => '450',
				'small_image_width' => '165',
				'small_image_height' => '125',
				'posts_to_show' => '',
				'query_offset' => '',
				'image_mask_background' => '',
				'image_mask_color' => '',
				'image_mask_gradient' => '',
				'image_mask_opacity' => '',
				'image_mask_opacity_hover' => '',
				'single_custom_post_item' => '',
				'enable_sort_panel' => '',
				'sort_panel_alignment' => 'text-center',
				'slides_to_show' => '',
				'slides_to_scroll' => '',
				'slideshow_speed' => '',
				'responsive_brekpoint_first' => '',
				'responsive_brekpoint_second' => '',
				'responsive_brekpoint_third' => '',
				'auto_slideshow' => '',
				'layout_style' => '',
				'content_alignment' => 'text-center',
				'masonry_layout_mode' => '',
				'enable_dots' => '',
				'hover_read_more_style' => '',
				'module_animation' => '',
				'excerpt_length' => '',
				'hide_comments' => false,
				'hide_post_like' => false,
				'hide_excerpt' => '',
				'meta_to_hide' => '',
				'meta_to_hide_additional' => '',
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
				'test_loop_option' => '',
				'last_four_posts_style' => '',
			),$atts));
			
			if(empty($hover_read_more_style)) {
				$hover_read_more_style = 'chaffle';
			}
			
			if(empty($works_to_show)) {
				$works_to_show = -1;
			}
			
			if(empty($posts_list_columns)) {
				$posts_list_columns = 1;
			}
			
			if(empty($blog_posts_styles)) {
				$blog_posts_styles = 'blog_masonry';
			}
			
			if(strcmp($blog_posts_styles, 'wide_posts') === 0) {
				$image_width = 70;
			} elseif($image_width == '') {
				$image_width = 675;
			}
			
			if(strcmp($blog_posts_styles, 'wide_posts') === 0) {
				$image_height = 70;
			} elseif($image_height == '') {
				$image_height = 450;
			}
			
			if(empty($small_image_width)) {
				$small_image_width = 165;
			}
			
			if(empty($small_image_height)) {
				$small_image_height = 125;
			}
			
			if(empty($enable_sort_panel)) {
				$enable_sort_panel = false;
			}
			
			if(empty($posts_to_show)) {
				$posts_to_show = 9;
			}
			
			if($blog_posts_styles == 'last_three_posts' || $blog_posts_styles == 'last_four_posts') {
				$posts_to_show = 1;
			} elseif($blog_posts_styles == 'single_post') {
				$posts_to_show = -1;
			} elseif(empty($posts_to_show)) {
				$posts_to_show = 9;
			}
			
			if($single_custom_post_item == '') {
				$single_custom_post_item = false;
			}
			
			$additional_class = $image_mask_html = $image_mask_class = $columns = $masonry_data_attr = $carousel_data_attr = $mask_css = '';
			if(strcmp($blog_posts_styles, 'wide_posts') === 0 && $content_alignment != '') {
				$additional_class .= $content_alignment;
			}
			
			if($last_four_posts_style != '') {
				$additional_class .= $last_four_posts_style;
			}
			
			if(strcmp($blog_posts_styles, 'posts_list') === 0 && $posts_list_configuration != '') {
				$additional_class .= ' dfd-'.$posts_list_configuration;
				$title_position = 'bottom';
			}
			
			if(strcmp($blog_posts_styles, 'masonry')) {
				if(empty($masonry_layout_mode)) {
					$masonry_layout_mode = 'masonry';
				}
				$masonry_data_attr .= 'data-masonry-layout="'.esc_attr($masonry_layout_mode).'"';
			}
			
			if(strcmp($blog_posts_styles, 'posts_slider') === 0) {
				if(empty($slides_to_show)) {
					$slides_to_show = 4;
				}
				$carousel_data_attr .= 'data-show-slides="'.esc_attr($slides_to_show).'" ';

				if(empty($slides_to_scroll)) {
					$slides_to_scroll = 1;
				}
				$carousel_data_attr .= 'data-scroll-slides="'.esc_attr($slides_to_scroll).'" ';

				if(empty($slideshow_speed)) {
					$slideshow_speed = 3000;
				}
				$carousel_data_attr .= 'data-slideshow-speed="'.esc_attr($slideshow_speed).'" ';

				if(empty($responsive_brekpoint_first)) {
					$responsive_brekpoint_first = 1280;
				}
				$carousel_data_attr .= 'data-resp-width-first="'.esc_attr($responsive_brekpoint_first).'" ';

				if(empty($responsive_brekpoint_second)) {
					$responsive_brekpoint_second = 1025;
				}
				$carousel_data_attr .= 'data-resp-width-second="'.esc_attr($responsive_brekpoint_second).'" ';

				if(empty($responsive_brekpoint_third)) {
					$responsive_brekpoint_third = 675;
				}
				$carousel_data_attr .= 'data-resp-width-third="'.esc_attr($responsive_brekpoint_third).'" ';

				if(empty($auto_slideshow)) {
					$auto_slideshow = 'false';
				} else {
					$auto_slideshow = 'true';
				}
				$carousel_data_attr .= 'data-autoplay="'.esc_attr($responsive_brekpoint_third).'" ';

				if(empty($enable_dots)) {
					$enable_dots = 'false';
				} else {
					$enable_dots = 'true';
				}
				$carousel_data_attr .= 'data-dots="'.esc_attr($enable_dots).'" ';
			}
			
			if(strcmp($blog_posts_styles, 'posts_list') === 0 && $posts_list_configuration == 'top-image') {
				$additional_class .= ' row';
				$columns .= dfd_num_to_string((int)$posts_list_columns).' columns';
			}
			
			if(strcmp($blog_posts_styles, 'last_three_posts') === 0 && $main_news_style != '') {
				$additional_class .= ' dfd-'.$main_news_style;
			}
			
			if($posts_list_style != '') {
				$additional_class .= ' '.$posts_list_style;
			}
			
			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$main_heading_style_inline = $sub_heading_style_inline = '';
			
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.esc_attr($mhfont_family).'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.esc_attr($main_heading_custom_family).'\';';
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
			
			if($meta_to_hide != '') {
				$meta_to_hide = str_replace(',', ' ', $meta_to_hide);
			}
			
			$module_id = uniqid('blog-posts-');
			
			if($image_mask_background == 'color' || $image_mask_color != '') {
				$image_mask_html .= '<div class="dfd-image-mask" style="background: '.esc_attr($image_mask_color).'"></div>';
			} elseif($image_mask_background == 'gradient' || $image_mask_gradient != '') {
				$image_mask_html .= '<div class="dfd-image-mask" style="'.esc_attr($image_mask_gradient).'"></div>';
			}
			
			if(empty($image_mask_html) && ($blog_posts_styles == 'posts_slider' || ($blog_posts_styles == 'last_three_posts' && $main_news_style == 'title-on-image'))) {
				$image_mask_html .= '<div class="dfd-image-mask"></div>';
			}
			
			if($image_mask_opacity != '') {
				$mask_css .= '#'.esc_attr($module_id).'.dfd-blog-module .post .entry-media .entry-thumb .dfd-image-mask {opacity: '.esc_attr($image_mask_opacity).';}';
			}
			
			if($image_mask_opacity_hover != '') {
				$mask_css .= '#'.esc_attr($module_id).'.dfd-blog-module .post:hover .entry-media .entry-thumb .dfd-image-mask {opacity: '.esc_attr($image_mask_opacity_hover).';}';
			}
			
			ob_start();
			
			echo '<div id="'.esc_attr($module_id).'" class="dfd-blog-module '.esc_attr($additional_class).' '.esc_attr($layout_style).' '. esc_attr($blog_posts_styles) .' '.esc_attr($animate).'" '.$animation_data.' '.$masonry_data_attr.' '.$carousel_data_attr.'>';
				$sticky = get_option( 'sticky_posts' );

				if (!empty($post_categories)){
					$args = array(
						//'category_name' => $post_categories,
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
					if($post_catgories_option == 'exclude') {
						$exclude_cats = array();
						$exclude_array = explode(',', $post_categories);
						foreach($exclude_array as $cat) {
							$exclude_cat = get_term_by('slug', $cat, 'category');
							$exclude_cats[] = $exclude_cat->term_id;
						}
						$args['category__not_in'] = $exclude_cats;
					} else {
						$args['category_name'] = $post_categories;
					}
				} else {
					$args = array(
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
				}
				
				if($query_offset != '') {
					$args['offset'] = $query_offset;
				}

				$taxonomy = 'category';

				$categories_arr = get_terms($taxonomy);

				if(!empty($categories_arr) && is_array($categories_arr) && !is_wp_error($categories_arr)) {
					$sort_panel_html .= '<div class="sort-panel '.$sort_panel_alignment.'">';
						$sort_panel_html .= '<ul class="filter">';
							$sort_panel_html .= '<li class="active"><a data-filter=".post" href="#">'. __('All', 'dfd') .'</a></li>';
							foreach ($categories_arr as $category) {
								$sort_panel_html .= '<li><a data-filter=".post[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
							}
						$sort_panel_html .= '</ul>';
					$sort_panel_html .= '</div>';
				}

				if(strcmp($blog_posts_styles, 'blog_masonry') === 0 && $enable_sort_panel) {
					echo $sort_panel_html;
				}

				$the_query = new WP_Query($args);
				
				$posts_list_class = $meta_postfix = '';
				if(strcmp($blog_posts_styles, 'wide_posts') === 0 || strcmp($blog_posts_styles, 'posts_slider') === 0) {
					$meta_postfix .= '-comments';
				}
				
				echo '<div class="posts-list '.esc_attr($meta_to_hide).' '. esc_attr($posts_list_class) .'">';

					while ($the_query->have_posts()) : $the_query->the_post();

						$_post_id = get_the_ID();

						$terms = get_the_terms($_post_id, 'category');

						$data_categories = '';

						if(!empty($terms) && is_array($terms) && !is_wp_error($terms)) {
							foreach ($terms as $term) {
								$data_categories .= ' '.strtolower(preg_replace('/\s+/', '-', $term->slug));
							}
						}
						
						$heading_html = '';
						$heading_html .= '<div class="title-wrap">';
						$heading_html .= '<div class="block-title" style="'.$main_heading_style_inline.'"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></div>';
						ob_start();
						get_template_part('templates/entry-meta', 'post-bottom'.$meta_postfix);
						$heading_html .= ob_get_clean();
						$heading_html .= '</div>';
						
						$post_class_elems = get_post_class();

						$post_class = implode(' ', $post_class_elems);
						
						$post_class .= ' '.$columns;

						if($_post_id != $single_custom_post_item && strcmp($blog_posts_styles, 'single_post') === 0) {
							continue;
						} else {
							echo '<div class="'. esc_attr($post_class) .'" data-category="'. esc_attr($data_categories) .'">';
								if($title_position == 'top') {
									echo $heading_html;
								}
								echo '<div class="entry-media">';
									if(strcmp($blog_posts_styles, 'blog_masonry') === 0) {
										switch(true) {
											case has_post_format('video'):
												get_template_part('templates/post', 'video');
												break;
											case has_post_format('audio'):
												get_template_part('templates/post', 'audio');
												break;
											case has_post_format('gallery'):
												get_template_part('templates/post', 'gallery');
												break;
											case has_post_format('quote'):
												get_template_part('templates/post', 'quote');
												break;
											default:
												if (has_post_thumbnail()) {
													$thumb = get_post_thumbnail_id();
													$img_url = wp_get_attachment_url($thumb, 'large'); //get img URL

													$article_image = dfd_aq_resize($img_url, 450, null, false, true, false);
													if(!$article_image) {
														$article_image = $img_url;
													}
													echo '<div class="entry-thumb">';
														echo '<img src="'. esc_url($article_image) .'" alt="'. esc_attr(get_the_title()) .'"/>';
														if(!isset($hide_comments) || !$hide_comments) {
															echo '<div class="post-comments-wrap">';
																get_template_part('templates/entry-meta/mini', 'comments-number');
															echo '</div>';
														}
														if(!isset($hide_post_like) || !$hide_post_like) {
															echo '<div class="post-like-wrap">';
																get_template_part('templates/entry-meta/mini', 'like');
															echo '</div>';
														}
													echo '</div>';
												}
										}
									} else {
										if (has_post_thumbnail()) {
											$thumb = get_post_thumbnail_id();
											$img_url = wp_get_attachment_url($thumb, 'large'); //get img URL

											$article_image = dfd_aq_resize($img_url, $image_width, $image_height, true, true, true);
											if(!$article_image) {
												$article_image = $img_url;
											}
										} else {
											$article_image = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
										}
										echo '<div class="entry-thumb">';
											echo $image_mask_html;
											echo '<img src="'. esc_url($article_image) .'" alt="'. esc_attr(get_the_title()) .'"/>';
											if(strcmp($blog_posts_styles, 'wide_posts') !== 0) {
												if(!isset($hide_comments) || !$hide_comments) {
													echo '<div class="post-comments-wrap">';
														get_template_part('templates/entry-meta/mini', 'comments-number');
													echo '</div>';
												}
												if(!isset($hide_post_like) || !$hide_post_like) {
													echo '<div class="post-like-wrap">';
														get_template_part('templates/entry-meta/mini', 'like');
													echo '</div>';
												}
											}
										echo '</div>';
									}
								echo '</div>';
								if($title_position == 'bottom') {
									echo $heading_html;
								}
								if(strcmp($blog_posts_styles, 'posts_slider') !== 0 && !$hide_excerpt) {
									echo '<div class="entry-content">';
										$content = get_the_excerpt();
										if($excerpt_length != '' && is_numeric($excerpt_length)) {
											$content = wp_trim_words($content, $excerpt_length);
										}
										echo '<p>'.$content.'</p>';
										if(strcmp($blog_posts_styles, 'blog_masonry') === 0 || strcmp($blog_posts_styles, 'wide_posts') === 0) {
											echo '<a href="'. esc_url(get_permalink()) .'" class="more-button '.esc_attr($hover_read_more_style).'" data-lang="en" title="">'.__('Continue', 'dfd').'</a>';
											if(strcmp($blog_posts_styles, 'blog_masonry') === 0) {
												echo '<div class="entry-meta right">';
													get_template_part('templates/entry-meta/mini', 'comments');
												echo '</div>';
											}
										}
									echo '</div>';
								}
							echo '</div>';
						}

					endwhile; wp_reset_postdata();

				echo '</div>';
				if(strcmp($blog_posts_styles, 'blog_masonry') === 0) {
					echo '<div class="posts-list-hidden"></div>';
				}
			
			if(strcmp($blog_posts_styles, 'last_three_posts') === 0 || strcmp($blog_posts_styles, 'last_four_posts') === 0) {
				$extra_args = $args;
				if(strcmp($blog_posts_styles, 'last_three_posts') === 0) {
					$extra_args['posts_per_page'] = 2;
				}
				if(strcmp($blog_posts_styles, 'last_four_posts') === 0) {
					$extra_args['posts_per_page'] = 3;
				}
				if($meta_to_hide_additional != '') {
					$meta_to_hide_additional = str_replace(',', ' ', $meta_to_hide_additional);
				}
				$extra_args['offset'] = 1;
				$extra_query = new WP_Query($extra_args);
				echo '<div class="posts-list additional-posts '.esc_attr($meta_to_hide_additional).' '. esc_attr($posts_list_class) .'">';
					while ($extra_query->have_posts()) : $extra_query->the_post();
						if (has_post_thumbnail()) {
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url($thumb, 'large'); //get img URL

							$article_image = dfd_aq_resize($img_url, $small_image_width, $small_image_height, true, true, true);
							if(!$article_image) {
								$article_image = $img_url;
							}
						} else {
							$article_image = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
						}
						echo '<div class="'. esc_attr($post_class) .' row" data-category="'. esc_attr($data_categories) .'">';
							echo '<div class="entry-media five mobile-two columns">';
								echo '<div class="entry-thumb">';
									echo '<img src="'. esc_url($article_image) .'" alt="'. esc_attr(get_the_title()) .'"/>';
									if(!isset($hide_comments) || !$hide_comments) {
										echo '<div class="post-comments-wrap">';
											get_template_part('templates/entry-meta/mini', 'comments-number');
										echo '</div>';
									}
									if(!isset($hide_post_like) || !$hide_post_like) {
										echo '<div class="post-like-wrap">';
											get_template_part('templates/entry-meta/mini', 'like');
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
							echo '<div class="title-wrap seven mobile-two columns">';
								echo '<div class="box-name" style="'.$sub_heading_style_inline.'"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></div>';
								get_template_part('templates/entry-meta', 'post-bottom');
							echo '</div>';
						echo '</div>';
					endwhile;
					wp_reset_postdata();
				echo '</div>';
			}
			if($mask_css != '') {
				?>
				<script type="text/javascript">
					(function($) {
						$('head').append('<style type="text/css"><?php echo esc_js($mask_css); ?></style>');
					})(jQuery);
				</script>
				<?php
			}
			echo '</div>';
			
			if(strcmp($blog_posts_styles, 'blog_masonry') === 0) {
				wp_enqueue_script('isotope');
				wp_enqueue_script('dfd-isotope-news-module');
			}
			
			if(strcmp($blog_posts_styles, 'posts_slider') === 0) {
				wp_enqueue_script('dfd-isotope-news-carousel');	
			}
			
			$output .= ob_get_clean();

			return $output;
		}
	}
}
if(class_exists('Dfd_Posts')) {
	$Dfd_Posts = new Dfd_Posts;
}