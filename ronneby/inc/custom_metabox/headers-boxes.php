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

add_filter( 'cmb_meta_boxes', 'stunnig_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function stunnig_headers_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'stunnig_headers_';
	
	$meta_boxes[] = array(
		'id'         => 'header_img_metabox',
		'title'      => __('Stunning header options', 'dfd'),
		'pages'      => array('page','post','my-product','product','gallery'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
	            'name' => 'Background image',
	            'desc' => __('Select image pattern for stunning header background', 'dfd'),
	            'id'   => $prefix . 'bg_img',
                'type' => 'file',
                'save_id' => false, // save ID using true
				'std'  => '',
	        ),
			array(
				'name' => 'Background position',
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'bg_img_position',
				'type' => 'select',
				'options' => dfd_get_bgposition_redux(),
				'std'  => '',
			),
			array(
				'name' => 'Background size',
				'desc' => '',
				'id' => 'stun_header_bg_size',
				'type' => 'select',
				'options' => dfd_get_bgsize('metaboxes'),
				'std'  => '',
			),
			array(
                'name' => 'Background color',
                'desc' => __('Select color for header background', 'dfd'),
                'id'   => $prefix . 'bg_color',
                'type' => 'colorpicker',
                'save_id' => false, // save ID using true
                'std'  => '',
            ),
            array(
                'name'	=> __('Page subtitle', 'dfd'),
                'desc'	=> '',
                'id'	=> $prefix . 'subtitle',
                'type'	=> 'text',
            ),
			array(
				'name' => __('Enable breadcrumbs','dfd'),
				'desc' => '',
				'id' => 'stan_header_breadcrumbs',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('On', 'dfd'), 'value' => '1', ),
					array( 'name' => __('Off', 'dfd'), 'value' => 'off', ),
				),
				'std'  => '',
			),
			array(
				'name' => __('Breadcrumbs style','dfd'),
				'desc' => '',
				'id' => 'stan_header_breadcrumbs_style',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Theme default', 'dfd'), 'value' => 'simple', ),
					array( 'name' => __('Transparent background', 'dfd'), 'value' => 'transparent-bg', ),
				),
				'std'  => '',
				'dep_option'    => 'stan_header_breadcrumbs',
				'dep_values'    => '1',
			),
            array(
                'name'	=> __('Stunning header height', 'dfd'),
                'desc'	=> '',
                'id'	=> $prefix . 'custom_height',
                'type'	=> 'text',
            ),
			array(
				'name' => 'Text alignment',
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'text_alignment',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Theme default', 'dfd'), 'value' => '', ),
					array( 'name' => __('Center', 'dfd'), 'value' => 'text-center', ),
					array( 'name' => __('Left', 'dfd'), 'value' => 'text-left', ),
					array( 'name' => __('Right', 'dfd'), 'value' => 'text-right', ),
				),
				'std'  => '',
			),
			array(
				'name'	=> __('Fixed background image position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'stan_header_fixed',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('On', 'dfd'), 'value' => '1', ),
					array( 'name' => __('Off', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> __('Background check', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'stan_header_bgcheck',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Light', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Dark', 'dfd'), 'value' => '1', ),
				),
			),
			array(
				'name' => __('Enable stunning header video','dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_stun_video_enable',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Disable', 'dfd'), 'value' => '', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'enable', ),
				),
				'std'  => '',
			),
			array(
				'name' => __('Stunning header video source','dfd'),
				'desc' => '',
				'id' => 'dfd_stun_video_style',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('None', 'dfd'), 'value' => '', ),
					array( 'name' => __('Self-hosted video', 'dfd'), 'value' => 'self-hosted', ),
					array( 'name' => __('oEmbed Youtube video', 'dfd'), 'value' => 'youtube', ),
					array( 'name' => __('oEmbed Vimeo video', 'dfd'), 'value' => 'vimeo', ),
				),
				'std'  => '',
				'dep_option'    => 'dfd_stun_video_enable',
				'dep_values'    => 'enable',
			),
			array(
				'name' => __('Stunning header background video style','dfd'),
				'desc' => '',
				'id' => 'dfd_stun_video_type',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Background', 'dfd'), 'value' => 'bacground-video', ),
					array( 'name' => __('Full screen video', 'dfd'), 'value' => 'full-screen-video', ),
				),
				'std'  => '',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'youtube,vimeo',
			),
			array(
                'name'	=> __('Youtube video ID', 'dfd'),
                'desc'	=> '',
                'id'	=> 'dfd_stun_bg_youtube_id',
                'type'	=> 'text',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'youtube',
            ),
			array(
                'name'	=> __('Vimeo video ID', 'dfd'),
                'desc'	=> '',
                'id'	=> 'dfd_stun_bg_vimeo_id',
                'type'	=> 'text',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'vimeo',
            ),
            array(
                'name' =>  __('Self hosted video file in mp4 format', 'dfd'),
                'desc'	=> '',
                'id'	=> 'dfd_stun_header_self_hosted_mp4',
                'type'	=> 'file',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'self-hosted',
            ),
            array(
                'name' =>  __('Self hosted video file in webM format', 'dfd'),
                'desc'	=> '',
                'id'	=> 'dfd_stun_header_self_hosted_webm',
                'type'	=> 'file',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'self-hosted',
            ),
			array(
				'name'	=> __('Loop video', 'dfd'),
				'desc'	=> '',
				'id'	=> 'dfd_stun_header_video_loop',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => '1', ),
				),
				'std' => '1',
				'dep_option'    => 'dfd_stun_video_enable',
				'dep_values'    => 'enable',
			),
			array(
				'name'	=> __('Mute video', 'dfd'),
				'desc'	=> '',
				'id'	=> 'dfd_stun_header_video_mute',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => '1', ),
				),
				'std' => '1',
				'dep_option'    => 'dfd_stun_video_enable',
				'dep_values'    => 'enable',
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
