<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'cmb_post_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_post_metaboxes( array $meta_boxes ) {

	$prefix = 'blog_';
	
	$appear_effects = dfd_module_animation_styles('metaboxes');
	
	$appear_effects[0]['name'] = __('Inherit from theme options', 'dfd');
	
	$meta_boxes[] = array(
		'id'         => 'post_video_custom_fields',
		'title'      => esc_html__('Post Video', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
                'name' => esc_html__('YouTube video ID', 'dfd'),
                'desc'	=> '',
                'id'	=> 'post_youtube_video_url',
                'type'	=> 'text'
            ),
            array(
                'name' =>  esc_html__('Vimeo video ID', 'dfd'),
                'desc'	=> '',
                'id'	=> 'post_vimeo_video_url',
                'type'	=> 'text'
            ),
            array(
                'name' =>  esc_html__('Self hosted video file in mp4 format', 'dfd'),
                'desc'	=> '',
                'id'	=> 'post_self_hosted_mp4',
                'type'	=> 'file'
            ),
            array(
                'name' =>  esc_html__('Self hosted video file in webM format', 'dfd'),
                'desc'	=> '',
                'id'	=> 'post_self_hosted_webm',
                'type'	=> 'file'
            ),
		),
	);

        
	$meta_boxes[] = array(
		'id'         => 'post_audio_custom_fields',
		'title'      => esc_html__('Post Audio', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' =>  esc_html__('Use audio embed code', 'dfd'),
				'desc'	=> '',
				'id'	=> 'post_custom_post_audio_url',
				'type'	=> 'text'
			),
			array(
				'name' =>  esc_html__('Self hosted audio file in mp3 format', 'dfd'),
				'desc'	=> '',
				'id'	=> 'post_self_hosted_audio',
				'type'	=> 'file'
			),
			array(
				'name' =>  esc_html__('Soundcloud audio', 'dfd'),
				'desc'	=> '',
				'id'	=> 'post_soundcloud_audio',
				'type'	=> 'textarea_code'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'post_quote_custom_fields',
		'title'      => esc_html__('Post Quote', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' =>  esc_html__('Quote author name', 'dfd'),
				'desc'	=> '',
				'id'	=> 'post_custom_author_name',
				'type'	=> 'text'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'single_post_settings',
		'title'      => esc_html__('Single post settings', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'	=> esc_html__('Single post style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'base', ),
					array( 'name' => esc_attr__('Advanced', 'dfd'), 'value' => 'advanced', ),
				),
			),
			array(
				'name'	=> esc_html__('Enable stunning header', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_stun_header',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name' =>  esc_html__('Enable post thumb in Stunning header', 'dfd'),
				'desc'	=> '',
				'id'	=> 'dfd_post_thumb_enable',
				'type' => 'select',
				'std' => 'disabled',
				'options' => array(
					array('name' => esc_attr__('Disable', 'dfd'),'value' => 'disabled',),
					array('name' => esc_attr__('Enable', 'dfd'),'value' => 'enabled',),
				),
			),
			array(
				'name' =>  esc_html__('Single post layout width', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_layout',
				'type' => 'select',
				'std' => 'boxed',
				'options' => array(
					array('name' => esc_attr__('Inherit from theme options', 'dfd'),'value' => '',),
					array('name' => esc_attr__('Boxed', 'dfd'),'value' => 'boxed',),
					array('name' => esc_attr__('Full width', 'dfd'),'value' => 'full-width',),
				),
			),
			array(
				'name'	=> esc_html__('Sidebar cofiguration', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_sidebars',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => esc_attr__('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => esc_attr__('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => esc_attr__('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'name'	=> esc_html__('Show title', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_title',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> esc_html__('Show meta', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_meta',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> esc_html__('Show Read more and Share', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_read_more_share',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> esc_html__('Show Fixed Share', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_fixed_share',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> esc_html__('Share style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_share_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => esc_attr__('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
			),
			array(
				'name'	=> esc_html__('Enable inside pagination', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_enable_pagination',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Inside pagination position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_pagination_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Fixed', 'dfd'), 'value' => 'fixed', ),
                    array( 'name' => esc_attr__('Top', 'dfd'), 'value' => 'top', ),
				),
				'dep_option'    => $prefix . 'single_enable_pagination',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Content position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'vc_content_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Before projects', 'dfd'), 'value' => 'top', ),
                    array( 'name' => esc_attr__('After projects', 'dfd'), 'value' => 'bottom', ),
				),
			),
			array(
				'id'	=> $prefix . 'single_reset_counter',
                'name' => __('Reset views counter', 'dfd'),
                'desc' => '',
				'type' => 'checkbox',
            ),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd_blog_settings_box',
		'title'      => esc_html__('Blog page options', 'dfd'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-blog.php',
		),
		'fields'     => array(
			array(
				'name'	=> esc_html__('Enable stunning header', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'stun_header',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Enable categories and tags dropdown', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'cat_tag',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name' => esc_html__('Blog layout width','dfd'),
				'desc' => esc_html__('', 'dfd'),
				'id' => $prefix . 'layout',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Boxed','dfd'), 'value' => 'boxed', ),
					array( 'name' => esc_attr__('Full width','dfd'), 'value' => 'full_width', ),
				),
				'std'  => '1',
			),
			array(
				'name'	=> esc_html__('Sidebar cofiguration', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'sidebars',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => esc_attr__('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => esc_attr__('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => esc_attr__('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'name' => esc_html__('Blog layout style','dfd'),
				'desc' => esc_html__('', 'dfd'),
				'id' => $prefix . 'layout_style',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Standard','dfd'), 'value' => 'standard', ),
					array( 'name' => esc_attr__('Left image','dfd'), 'value' => 'left-image', ),
					array( 'name' => esc_attr__('Right image','dfd'), 'value' => 'right-image', ),
					array( 'name' => esc_attr__('Masonry','dfd'), 'value' => 'masonry', ),
					array( 'name' => esc_attr__('Grid','dfd'), 'value' => 'fitRows', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Smart grid mode','dfd'),
				'desc' => esc_html__('', 'dfd'),
				'id' => $prefix . 'smart_grid',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable','dfd'), 'value' => 'on', ),
					array( 'name' => esc_attr__('Disable','dfd'), 'value' => 'off', ),
				),
				'std'  => 'off',
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'fitRows',
			),
			array(
				'name' => esc_html__('Number of columns','dfd'),
				'desc' => esc_html__('', 'dfd'),
				'id' => $prefix . 'columns',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('One column','dfd'), 'value' => '1', ),
					array( 'name' => esc_attr__('Two columns','dfd'), 'value' => '2', ),
					array( 'name' => esc_attr__('Three columns','dfd'), 'value' => '3', ),
					array( 'name' => esc_attr__('Four columns','dfd'), 'value' => '4', ),
					array( 'name' => esc_attr__('Five columns','dfd'), 'value' => '5', ),
					array( 'name' => esc_attr__('Six columns','dfd'), 'value' => '6', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
				'std'  => '1',
			),
			array(
				'name'	=> esc_html__('Enable sort panel', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'sort_panel',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'name'	=> esc_html__('Sort panel alignment', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'sort_panel_align',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Left', 'dfd'), 'value' => 'text-left', ),
                    array( 'name' => esc_attr__('Right', 'dfd'), 'value' => 'text-right', ),
                    array( 'name' => esc_attr__('Center', 'dfd'), 'value' => 'text-center', ),
				),
				'dep_option'    => $prefix . 'sort_panel',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Show title', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_title',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> esc_html__('Show meta', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_meta',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Show comments count', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_comments',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Show likes', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_likes',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Comments and like style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'comments_likes_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Always show', 'dfd'), 'value' => ' ', ),
					array( 'name' => __('Show on hover', 'dfd'), 'value' => 'comments-like-hover', ),
				),
			),
			array(
				'name'	=> esc_html__('Heading position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'heading_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Under media', 'dfd'), 'value' => 'bottom', ),
                    array( 'name' => esc_attr__('Over media', 'dfd'), 'value' => 'top', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'standard,masonry,fitRows',
			),
			array(
				'name'	=> esc_html__('Show description', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_description',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> esc_html__('Description alignment', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'content_alignment',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Center', 'dfd'), 'value' => 'text-center', ),
                    array( 'name' => esc_attr__('Left', 'dfd'), 'value' => 'text-left', ),
					array( 'name' => esc_attr__('Right', 'dfd'), 'value' => 'text-right', ),
				),
			),
			array(
				'name'	=> esc_html__('Show Read more and Share', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_read_more_share',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'smart_grid',
				'dep_values'    => ' ,off',
			),
			array(
				'name'	=> esc_html__('Read more style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'read_more_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'simple', ),
					array( 'name' => esc_attr__('Shuffle', 'dfd'), 'value' => 'chaffle', ),
					array( 'name' => esc_attr__('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
			),
			array(
				'name'	=> esc_html__('Share style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'share_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => esc_attr__('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
			),
			array(
				'name' => esc_html__('Works per page', 'dfd'),
				'desc' => esc_html__('', 'dfd'),
				'id' => $prefix . 'works_per_page',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => esc_html__('Items offset', 'dfd'),
				'desc' => esc_html__('', 'dfd'),
				'id' => $prefix . 'items_offset',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
                'name' => esc_html__('Blog Category','dfd'),
                'desc'	=> esc_html__('Select blog items category','dfd'),
                'id'	=> $prefix . 'category',
                'taxonomy' => 'category',
                'type' => 'taxonomy_multicheck',
            ),
			array(
				'name'	=> esc_html__('Items appear effect', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'item_appear_effect',
				'type'	=> 'select',
				'options' => $appear_effects,
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function dfd_post_add_custom_box() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'dfd_post_gallery',
            esc_html__( 'Images gallery', 'dfd' ),
            'dfd_post_inner_custom_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'dfd_post_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function dfd_post_inner_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'dfd_post_inner_custom_box', 'dfd_post_inner_custom_box_nonce' );


    ?>

    <div id="my_post_images_container">
        <ul class="my_post_images">
            <?php
            if ( metadata_exists( 'post', $post->ID, '_my_post_image_gallery' ) ) {
                $my_post_image_gallery = get_post_meta( $post->ID, '_my_post_image_gallery', true );
            } else {
                // Backwards compat
                $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
                $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                $my_post_image_gallery = implode( ',', $attachment_ids );
            }

            $attachments = array_filter( explode( ',', $my_post_image_gallery ) );

            if ( $attachments ) {
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'dfd' ) . '">' . esc_attr__( 'Delete', 'dfd' ) . '</a></li>
								</ul>
							</li>';
                }
			} ?>
        </ul>

        <input type="hidden" id="my_post_image_gallery" name="my_post_image_gallery" value="<?php echo esc_attr( $my_post_image_gallery ); ?>" />

    </div>
    <p class="add_my_post_images hide-if-no-js">
        <a class="button" href="#"><?php _e( 'Add gallery images', 'dfd' ); ?></a>
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($){
			"use strict";
            // Uploading files
            var my_post_gallery_frame;
            var $image_gallery_ids = $('#my_post_image_gallery');
            var $my_post_images = $('#my_post_images_container ul.my_post_images');

            jQuery('.add_my_post_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( my_post_gallery_frame ) {
                    my_post_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                my_post_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Add Images to post Gallery', 'dfd' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to gallery', 'dfd' ); ?>'
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                my_post_gallery_frame.on( 'select', function() {

                    var selection = my_post_gallery_frame.state().get('selection');

                    selection.map( function( attachment ) {

                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                            $my_post_images.append('\
									<li class="image" data-attachment_id="' + attachment.id + '">\
										<img src="' + attachment.url + '" />\
										<ul class="actions">\
											<li><a href="#" class="delete" title="<?php _e( 'Delete image', 'dfd' ); ?>"><?php _e( 'Delete', 'dfd' ); ?></a></li>\
										</ul>\
									</li>');
                        }

                    } );

                    $image_gallery_ids.val( attachment_ids );
                });

                // Finally, open the modal.
                my_post_gallery_frame.open();
            });

            // Image ordering
            $my_post_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity:40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#my_post_images_container ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#my_post_images_container').on( 'click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#my_post_images_container ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>


<?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function dfd_post_save_postdata( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['dfd_post_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['dfd_post_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'dfd_post_inner_custom_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = $_POST['my_post_image_gallery'];

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_post_image_gallery', $mydata );
}
add_action( 'save_post', 'dfd_post_save_postdata' );