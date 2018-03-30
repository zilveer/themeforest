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

add_filter( 'cmb_meta_boxes', 'crum_portfolio_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function crum_portfolio_metaboxes( array $meta_boxes ) {


    	// Start with an underscore to hide fields from custom fields list
	$prefix = 'folio_';
	$portfolio_templates = array(
		'tmp-portfolio-masonry.php',
		'tmp-portfolio-masonry_excerpt.php',
		'tmp-portfolio-masonry_mini.php',
		'tmp-portfolio-masonry-1.php',
		'tmp-portfolio-masonry-1-bordered.php',
		'tmp-portfolio-masonry-4.php',
		'tmp-portfolio-masonry-4excerpt.php',
		'tmp-portfolio-masonry-4mini.php',
		'tmp-portfolio-masonry-full-width.php',
		'tmp-portfolio-masonry-full-width-4-cols.php',
		'tmp-portfolio-masonry-full-width-bordered.php',
		'tmp-portfolio-masonry-full-width-bordered-4-cols.php',
		'tmp-portfolio-masonry-full-width-bordered-4-cols-title.php',
		'tmp-portfolio-masonry-full-width-bordered-title.php',
		'tmp-portfolio-masonry-left-sidebar.php',
		'tmp-portfolio-masonry-left-sidebar_excerpt.php',
		'tmp-portfolio-masonry-left-sidebar_mini.php',
		'tmp-portfolio-masonry-sidebar.php',
		'tmp-portfolio-masonry-sidebar_excerpt.php',
		'tmp-portfolio-masonry-sidebar_mini.php',
		'tmp-portfolio-masonry-template-2.php',
		'tmp-portfolio-masonry-template-2-left-sidebar.php',
		'tmp-portfolio-masonry-template-2-right-sidebar.php',
		'tmp-portfolio-template-1.php',
		'tmp-portfolio-template-1-left-sidebar.php',
		'tmp-portfolio-template-1-right-sidebar.php',
		'tmp-portfolio-template-2.php',
		'tmp-portfolio-grid-2-mini.php',
		'tmp-portfolio-template-2excerpt.php',
		'tmp-portfolio-template-2-left-sidebar.php',
		'tmp-portfolio-template-2mini.php',
		'tmp-portfolio-template-2mini-left-sidebar.php',
		'tmp-portfolio-template-2-right-sidebar.php',
		'tmp-portfolio-template-3.php',
		'tmp-portfolio-template-3excerpt.php',
		'tmp-portfolio-template-3-left-sidebar.php',
		'tmp-portfolio-template-3mini.php',
		'tmp-portfolio-template-3mini-left-sidebar.php',
		'tmp-portfolio-template-3-right-sidebar.php',
		'tmp-portfolio-template-4.php',
		'tmp-portfolio-template-4excerpt.php',
		'tmp-portfolio-template-4mini.php',
	);
	
	$hover_styles = '';
	if(function_exists('dfd_portfolio_hover_variants')) {
		$hover_styles = dfd_portfolio_hover_variants();
	}
	
	$hover_style_option = array();
	
	if(!empty($hover_styles) && is_array($hover_styles)) {
		foreach($hover_styles as $name=>$value) {
			$result = array();
			$result['name'] = $name;
			$result['value'] = $value;
			$hover_style_option[] = $result;
		}
	}
	
	$appear_effects = dfd_module_animation_styles('metaboxes');
	
	$appear_effects[0]['name'] = __('Inherit from theme options', 'dfd');
	
	/*TODO: Deprecated, will be deleted soon*/
    $meta_boxes[] = array(
        'id'         => 'portfolio-page-options',
        'title'      => __('Select portfolio parameters', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array(
			'key' => 'page-template',
			'value' => $portfolio_templates,
		),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Display  of certain category?',
                'desc' => 'Check, if you want to display items from a certain category',
                'id'   => $prefix . 'sort_category',
                'type' => 'checkbox'
            ),
            array(
                'name' => 'Portfolio Category',
                'desc'	=> 'Select portfolio items category',
                'id'	=> $prefix . 'category',
                'taxonomy' => 'my-product_category',
                'type' => 'taxonomy_multicheck',
            ),
            array(
                'name' => __('Number of items', 'dfd'),
                'desc' => __('Number of portfolio items that will be show on page', 'dfd'),
                'id' => $prefix . 'number_to_display',
                'type' => 'text'
            ),
            array(
                'name' => __('Hover style', 'dfd'),
                'desc' => __('Please select hover style from the drop-down list', 'dfd'),
                'id' => $prefix . 'hover_style',
                'type' => 'select',
				'std' => '',
				'options' => $hover_style_option,
            ),
        ),
    );
	
	$meta_boxes[] = array(
		'id' => $prefix . '_pagination_type',
		'title' => __('Pagination type', 'dfd'),
		'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array(
			'key' => 'page-template',
			'value' => $portfolio_templates
		),
		'show_names' => true,
		'fields' => array(
			array(
				'name' => 'Pagination type',
				'desc' => '',
				'id' => 'dfd_pagination_type',
				'type' => 'select',
				'std' => 'default',
				'options' => array(
					array( 'name' => __('Default', 'dfd'), 'value' => 'default', ),
					array( 'name' => __('Ajax', 'dfd'), 'value' => '1' ),
					array( 'name' => __('Lazy load', 'dfd'), 'value' => '2' ),
				),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => $prefix.'options_group',
		'title'      => __('Single Portfolio item options', 'dfd'),
		'pages'      => array('my-product'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'	=> __('Enable stunning header', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_stun_header',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name' =>  __('Use featured image for Stunning header background', 'dfd'),
				'desc'	=> '',
				'id'	=> 'dfd_post_thumb_enable',
				'type' => 'select',
				'std' => 'disabled',
				'options' => array(
					array( 'name' => __('Disable', 'dfd'), 'value' => 'disabled', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'enabled', ),
				),
			),
			array(
                'name' => __('Layout width','dfd'),
                'desc' => '',
                'id' =>  $prefix.'layout_width',
                'type' => 'select',   
                'std'  => 'default',
                'options'  => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Boxed', 'dfd'), 'value' => 'dfd-boxed', ),
					array( 'name' => __('Full width', 'dfd'), 'value' => 'dfd-masonry-full-width-offset', ),
				),
            ),
			array(
                'name' => __('Portfolio Template', 'dfd'),
                'desc' => '',
                'id' =>  $prefix.'inside_template',
                'type' => 'select',   
                'std'  => 'folio_inside_1',
                'options'  => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Portfolio inside 1 variant', 'dfd'), 'value' => 'folio_inside_1', ),
					array( 'name' => __('Portfolio inside 2 variant', 'dfd'), 'value' => 'folio_inside_2', ),
				),
            ),
			array(
                'name' => __('Portfolio gallery type', 'dfd'),
                'desc' => '',
                'id' =>  $prefix.'gallery_type',
                'type' => 'select',   
                'std'  => 'default',
                'options'  => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Default', 'dfd'), 'value' => 'default', ),
					array( 'name' => __('Big images', 'dfd'), 'value' => 'big_images_list', ),
					array( 'name' => __('Middle image list', 'dfd'), 'value' => 'middle_image_list', ),
					array( 'name' => __('Small images list', 'dfd'), 'value' => 'small_images_list', ),
					array( 'name' => __('Advanced gallery', 'dfd'), 'value' => 'advanced_gallery', ),
				),
            ),
            array(
                'name' => __('oEmbed video','dfd'),
                'desc' => __('Enter a Youtube, Vimeo, Twitter, or Instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.','dfd'),
                'id'   => $prefix . 'embed',
                'type' => 'oembed',
            ),
            array(
                'name' =>  __('Self hosted video file in mp4 format', 'dfd'),
                'desc'	=> '',
                'id'	=> $prefix . 'self_hosted_mp4',
                'type'	=> 'file'
            ),
            array(
                'name' =>  __('Self hosted video file in webM format', 'dfd'),
                'desc'	=> '',
                'id'	=> $prefix . 'self_hosted_webm',
                'type'	=> 'file'
            ),
			array(
                'name' => __('Layout type','dfd'),
                'desc' => '',
                'id' =>  $prefix.'layout_type',
                'type' => 'select',   
                'std'  => 'default',
                'options'  => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Default', 'dfd'), 'value' => 'default', ),
					//array( 'name' => __('Page builder without stunning header', 'dfd'), 'value' => 'page_builder_only_stunn', ),
					array( 'name' => __('Page builder only', 'dfd'), 'value' => 'page_builder_only', ),
				),
            ),
			array(
                'name' => __('Description position','dfd'),
                'desc' => '',
                'id' =>  $prefix.'description_position',
                'type' => 'select',   
                'std'  => 'left',
                'options'  => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Left', 'dfd'), 'value' => 'left', ),
					array( 'name' => __('Right', 'dfd'), 'value' => 'right', ),
					//array( 'name' => __('Top', 'dfd'), 'value' => 'top', ),
					array( 'name' => __('Bottom', 'dfd'), 'value' => 'bottom', ),
				),
            ),
			array(
				'name'	=> __('Show title', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_title',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
			),
			array(
				'name'	=> __('Show subtitle', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_subtitle',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
			),
			/*array(
				'name' => __('Subtitle text', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'single_subtitle_text',
				'type' => 'text',
				'save_id' => false,
				'std' => ''
			),
			array(
				'name'	=> __('Show meta', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_meta',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),*/
			array(
				'name'	=> __('Show Read more and Share', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_read_more_share',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
			),
			array(
				'name'	=> __('Share style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_share_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => __('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => __('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
				'dep_option'    => $prefix . 'single_show_read_more_share',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> __('Show Fixed Share', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_show_fixed_share',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Enable inside pagination', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_enable_pagination',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> __('Inside pagination position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'single_pagination_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Fixed', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Top', 'dfd'), 'value' => 'top-folio', ),
				),
			),
			array(
                'name' => __('Short description title','dfd'),
			    'desc' => '',
                'id'   => $prefix . 'single_short_desc_title',
                'type' => 'text',
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
            ),
			array(
                'name' => __('Short description text','dfd'),
			    'desc' => '',
                'id'   => $prefix . 'single_short_desc_text',
                'type' => 'text',
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
            ),
			array(
                'name' => __('Additional link title','dfd'),
			    'desc' => '',
                'id'   => $prefix . 'single_add_link_title',
                'type' => 'text',
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
            ),
			array(
                'name' => __('Additional link text','dfd'),
			    'desc' => '',
                'id'   => $prefix . 'single_add_link_text',
                'type' => 'text',
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
            ),
			array(
                'name' => __('Additional link url','dfd'),
			    'desc' => '',
                'id'   => $prefix . 'single_add_link_url',
                'type' => 'text',
				'dep_option'    => $prefix . 'inside_template',
				'dep_values'    => 'folio_inside_2',
            ),
			array(
                'name' => __('Button title','dfd'),
			    'desc' => '',
                'id'   => $prefix . 'client_name',
                'type' => 'text',
            ),
            array(
                'name' => __('Button url','dfd'),
                'desc' => '',
                'id'   => $prefix . 'client_site',
                'type' => 'text',
            ),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'dfd_portfolio_settings_box',
		'title'      => __('Portfolio page options', 'dfd'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-portfolio.php',
		),
		'fields'     => array(
			array(
				'name'	=> __('Enable stunning header', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'stun_header',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> __('Enable categories and tags dropdown', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'cat_tag',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'name' => __('Portfolio layout width','dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'layout',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Boxed','dfd'), 'value' => 'boxed', ),
					array( 'name' => __('Full width','dfd'), 'value' => 'full_width', ),
				),
				'std'  => '1',
			),
			array(
				'name'	=> __('Sidebar cofiguration', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'sidebars',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
                    array( 'name' => __('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => __('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => __('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => __('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => __('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => __('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'name' => __('Portfolio layout style','dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'layout_style',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => __('Standard','dfd'), 'value' => 'standard', ),
					array( 'name' => __('Masonry','dfd'), 'value' => 'masonry', ),
					array( 'name' => __('Grid','dfd'), 'value' => 'fitRows', ),
				),
				'std'  => '',
			),
			array(
				'name' => __('Number of columns','dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'columns',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => __('One column','dfd'), 'value' => '1', ),
					array( 'name' => __('Two columns','dfd'), 'value' => '2', ),
					array( 'name' => __('Three columns','dfd'), 'value' => '3', ),
					array( 'name' => __('Four columns','dfd'), 'value' => '4', ),
					array( 'name' => __('Five columns','dfd'), 'value' => '5', ),
					array( 'name' => __('Six columns','dfd'), 'value' => '6', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
				'std'  => '1',
			),
			array(
				'name'	=> __('Enable sort panel', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'sort_panel',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'name'	=> __('Sort panel alignment', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'sort_panel_align',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Left', 'dfd'), 'value' => 'text-left', ),
                    array( 'name' => __('Right', 'dfd'), 'value' => 'text-right', ),
                    array( 'name' => __('Center', 'dfd'), 'value' => 'text-center', ),
				),
				'dep_option'    => $prefix . 'sort_panel',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> __('Show title', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_title',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
                'name' => __('Title color','dfd'),
                'desc' => '',
                'id'   => $prefix . 'title_color',
                'type' => 'colorpicker',
                'save_id' => false,
				'dep_option'    => $prefix . 'show_title',
				'dep_values'    => 'on',
                'std'  => '',
            ),
			array(
				'name' => __('Title position','dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'title_position',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Under the image', 'dfd'), 'value' => 'under', ),
					array( 'name' => __('In front of the image','dfd'), 'value' => 'front', ),
				),
				'dep_option'    => $prefix . 'show_title',
				'dep_values'    => 'on',
				'std'  => false,
			),
			array(
				'name' => __('Title decoration','dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'title_decoration',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('None', 'dfd'), 'value' => 'none', ),
					array( 'name' => __('Background','dfd'), 'value' => 'background', ),
					array( 'name' => __('Line','dfd'), 'value' => 'line', ),
					array( 'name' => __('Shadow','dfd'), 'value' => 'shadow', ),
				),
				'dep_option'    => $prefix . 'show_title',
				'dep_values'    => 'on',
				'std'  => false,
			),
			array(
                'name' => __('Title decoration background color','dfd'),
                'desc' => '',
                'id'   => $prefix . 'title_deco_bg',
                'type' => 'colorpicker',
                'save_id' => false,
				'dep_option'    => $prefix . 'title_decoration',
				'dep_values'    => 'background',
                'std'  => '',
            ),
			array(
                'name' => __('Title decoration line color','dfd'),
                'desc' => '',
                'id'   => $prefix . 'title_deco_line_bg',
                'type' => 'colorpicker',
                'save_id' => false,
				'dep_option'    => $prefix . 'title_decoration',
				'dep_values'    => 'line',
                'std'  => '',
            ),
			array(
                'name' => __('Title decoration shadow color','dfd'),
                'desc' => '',
                'id'   => $prefix . 'title_deco_shadow',
                'type' => 'colorpicker',
                'save_id' => false,
				'dep_option'    => $prefix . 'title_decoration',
				'dep_values'    => 'shadow',
                'std'  => '',
            ),
			array(
				'name'	=> __('Show subtitle', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_subtitle',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Show meta', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_meta',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
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
				'name'	=> __('Show description', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_description',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Content alignment', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'content_alignment',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Center', 'dfd'), 'value' => 'text-center', ),
                    array( 'name' => __('Left', 'dfd'), 'value' => 'text-left', ),
					array( 'name' => __('Right', 'dfd'), 'value' => 'text-right', ),
				),
			),
			array(
				'name'	=> __('Show Read more and Share', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'show_read_more_share',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'name'	=> __('Read more style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'read_more_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Simple', 'dfd'), 'value' => 'simple', ),
					array( 'name' => __('Shuffle', 'dfd'), 'value' => 'chaffle', ),
					array( 'name' => __('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
				'dep_option'    => $prefix . 'show_read_more_share',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> __('Share style', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'share_style',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => __('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => __('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
				'dep_option'    => $prefix . 'show_read_more_share',
				'dep_values'    => 'on',
			),
			array(
				'name' => __('Works per page', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'works_per_page',
				'type' => 'text',
				'save_id' => false,
				'std' => ''
			),
			array(
				'name' => __('Items offset', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'items_offset',
				'type' => 'text',
				'save_id' => false,
				'std' => ''
			),
			array(
                'name' => __('Portfolio Category','dfd'),
                'desc'	=> __('Select Gallery items category','dfd'),
                'id'	=> $prefix . 'category',
                'taxonomy' => 'my-product_category',
                'type' => 'taxonomy_multicheck',
            ),
			array(
				'name'	=> __('Content position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'vc_content_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Before projects', 'dfd'), 'value' => 'top', ),
                    array( 'name' => __('After projects', 'dfd'), 'value' => 'bottom', ),
				),
			),
			array(
				'name'	=> __('Items appear effect', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'item_appear_effect',
				'type'	=> 'select',
				'options' => $appear_effects,
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd_portfolio_hover_settings_box',
		'title'      => __('Portfolio hover options', 'dfd'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-portfolio.php',
		),
		'fields'     => array(
			array(
				'name' => __('Hover style group','dfd'),
				'desc' => __('', 'dfd'),
				'id' => $prefix . 'hover_style_group',
				'type' => 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => __('Advanced customizable hover','dfd'), 'value' => 'custom', ),
					array( 'name' => __('Pre-built hovers &#40old version&#41','dfd'), 'value' => 'entry', ),
				),
				'std'  => 'normal',
			),
			array(
                'name' => __('Hover style', 'dfd'),
                'desc' => __('Please select hover style from the drop-down list', 'dfd'),
                'id' => $prefix . 'hover',
                'type' => 'select',
				'std' => 'portfolio-hover-style-1',
				'options' => $hover_style_option,
				'dep_option'    => $prefix . 'hover_style_group',
				'dep_values'    => 'entry',
            ),
			array(
				'name'	=> __('Main decoration', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_appear_effect',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Fade out', 'dfd'), 'value' => 'dfd-fade-out', ),
                    array( 'name' => __('Fade out offset', 'dfd'), 'value' => 'dfd-fade-offset', ),
                    array( 'name' => __('From left to right', 'dfd'), 'value' => 'dfd-left-to-right', ),
					array( 'name' => __('From right to left', 'dfd'), 'value' => 'dfd-right-to-left', ),
					array( 'name' => __('From top to bottom', 'dfd'), 'value' => 'dfd-top-to-bottom', ),
					array( 'name' => __('From bottom to top', 'dfd'), 'value' => 'dfd-bottom-to-top', ),
                    array( 'name' => __('From left to right shift image', 'dfd'), 'value' => 'dfd-left-to-right-shift', ),
					array( 'name' => __('From right to left shift image', 'dfd'), 'value' => 'dfd-right-to-left-shift', ),
					array( 'name' => __('From top to bottom shift image', 'dfd'), 'value' => 'dfd-top-to-bottom-shift', ),
					array( 'name' => __('From bottom to top shift image', 'dfd'), 'value' => 'dfd-bottom-to-top-shift', ),
					array( 'name' => __('Following the mouse', 'dfd'), 'value' => 'portfolio-hover-style-1', ),
					array( 'name' => __('Rotate content up', 'dfd'), 'value' => 'dfd-rotate-content-up', ),
                    array( 'name' => __('Rotate content down', 'dfd'), 'value' => 'dfd-rotate-content-down', ),
                    array( 'name' => __('Rotate left', 'dfd'), 'value' => 'dfd-rotate-left', ),
                    array( 'name' => __('Rotate right', 'dfd'), 'value' => 'dfd-rotate-right', ),
                    array( 'name' => __('Rotate top', 'dfd'), 'value' => 'dfd-rotate-top', ),
                    array( 'name' => __('Rotate bottom', 'dfd'), 'value' => 'dfd-rotate-bottom', ),
				),
				'dep_option'    => $prefix . 'hover_style_group',
				'dep_values'    => 'custom',
			),
			array(
				'name'	=> __('Image animation', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_image_effect',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Image parallax', 'dfd'), 'value' => 'panr', ),
					array( 'name' => __('Grow', 'dfd'), 'value' => 'dfd-image-scale', ),
					array( 'name' => __('Grow with rotation', 'dfd'), 'value' => 'dfd-image-scale-rotate', ),
					array( 'name' => __('Shift left', 'dfd'), 'value' => 'dfd-image-shift-left', ),
					array( 'name' => __('Shift right', 'dfd'), 'value' => 'dfd-image-shift-right', ),
					array( 'name' => __('Shift top', 'dfd'), 'value' => 'dfd-image-shift-top', ),
					array( 'name' => __('Shift bottom', 'dfd'), 'value' => 'dfd-image-shift-bottom', ),
					array( 'name' => __('Blur', 'dfd'), 'value' => 'dfd-image-blur', ),
				),
				'dep_option'    => $prefix . 'hover_appear_effect',
				'dep_values'    => 'dfd-fade-out,dfd-fade-offset,dfd-left-to-right,dfd-right-to-left,dfd-top-to-bottom,dfd-bottom-to-top',
			),
			array(
				'name'	=> __('Main decoration', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_main_dedcoration',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('None', 'dfd'), 'value' => 'none', ),
                    array( 'name' => __('Heading', 'dfd'), 'value' => 'heading', ),
					array( 'name' => __('Plus', 'dfd'), 'value' => 'plus', ),
					array( 'name' => __('Lines', 'dfd'), 'value' => 'lines', ),
					array( 'name' => __('Dots', 'dfd'), 'value' => 'dots', ),
				),
				'dep_option'    => $prefix . 'hover_style_group',
				'dep_values'    => 'custom',
			),
			array(
				'name'	=> __('Heading decoration', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_title_dedcoration',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('None', 'dfd'), 'value' => 'title-deco-none', ),
					array( 'name' => __('Diagonal line', 'dfd'), 'value' => 'diagonal-line', ),
					array( 'name' => __('Title underline', 'dfd'), 'value' => 'title-underline', ),
					array( 'name' => __('Square behind heading', 'dfd'), 'value' => 'square-behind-heading', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'heading',
			),
			array(
				'name'	=> __('Show title', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_show_title',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'heading',
			),
			array(
				'name'	=> __('Show subtitle', 'dfd'),
				'desc'	=> __('This field requirest Page subtitle options to be specified for portfolio items to show subtitle correctly','dfd'),
				'id'	=> $prefix . 'hover_show_subtitle',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'heading',
			),
			array(
				'name'	=> __('Plus position', 'dfd'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_plus_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Middle of the project', 'dfd'), 'value' => 'dfd-middle', ),
                    array( 'name' => __('Top right corner', 'dfd'), 'value' => 'dfd-top-right', ),
                    array( 'name' => __('Top left corner', 'dfd'), 'value' => 'dfd-top-left', ),
                    array( 'name' => __('Bottom right corner', 'dfd'), 'value' => 'dfd-bottom-right', ),
                    array( 'name' => __('Bottom left corner', 'dfd'), 'value' => 'dfd-bottom-left', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'plus',
			),
			array(
                'name' => __('Plus background','dfd'),
                'desc' => '',
                'id'   => $prefix . 'hover_plus_bg',
                'type' => 'colorpicker',
                'save_id' => false,
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'plus',
                'std'  => '',
            ),
			array(
				'name'	=> __('Show External link button', 'dfd'),
				'desc'	=> __('This field requirest Button URL options to be specified for portfolio items to show subtitle correctly','dfd'),
				'id'	=> $prefix . 'hover_show_ext_link',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_style_group',
				'dep_values'    => 'custom',
			),
			array(
				'name'	=> __('Show Quick view button', 'dfd'),
				'desc'	=> __('','dfd'),
				'id'	=> $prefix . 'hover_show_quick_view',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_style_group',
				'dep_values'    => 'custom',
			),
			array(
				'name'	=> __('Show Lightbox button', 'dfd'),
				'desc'	=> __('','dfd'),
				'id'	=> $prefix . 'hover_show_lightbox',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_style_group',
				'dep_values'    => 'custom',
			),
		),
	);

	return $meta_boxes;
}


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function cr_portfolio_add_custom_box() {

    $screens = array( 'my-product' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'crumina_portfolio_gallery',
            __( 'Images gallery', 'dfd' ),
            'cr_portfolio_inner_custom_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'cr_portfolio_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function cr_portfolio_inner_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'cr_portfolio_inner_custom_box', 'cr_portfolio_inner_custom_box_nonce' );


    ?>

    <div id="my_product_images_container">
        <ul class="my_product_images">
            <?php
            if ( metadata_exists( 'post', $post->ID, '_my_product_image_gallery' ) ) {
                $my_product_image_gallery = get_post_meta( $post->ID, '_my_product_image_gallery', true );
            } else {
                // Backwards compat
                $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
                $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                $my_product_image_gallery = implode( ',', $attachment_ids );
            }

            $attachments = array_filter( explode( ',', $my_product_image_gallery ) );

            if ( $attachments )
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . __( 'Delete image', 'dfd' ) . '">' . __( 'Delete', 'dfd' ) . '</a></li>
								</ul>
							</li>';
                }
            ?>
        </ul>

        <input type="hidden" id="my_product_image_gallery" name="my_product_image_gallery" value="<?php echo esc_attr( $my_product_image_gallery ); ?>" />

    </div>
    <p class="add_my_product_images hide-if-no-js">
        <a class="button" href="#"><?php _e( 'Add gallery images', 'dfd' ); ?></a>
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($){
			"use strict";
            // Uploading files
            var my_product_gallery_frame;
            var $image_gallery_ids = $('#my_product_image_gallery');
            var $my_product_images = $('#my_product_images_container ul.my_product_images');

            jQuery('.add_my_product_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( my_product_gallery_frame ) {
                    my_product_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                my_product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Add Images to Product Gallery', 'dfd' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to gallery', 'dfd' ); ?>'
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                my_product_gallery_frame.on( 'select', function() {

                    var selection = my_product_gallery_frame.state().get('selection');

                    selection.map( function( attachment ) {

                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                            $my_product_images.append('\
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
                my_product_gallery_frame.open();
            });

            // Image ordering
            $my_product_images.sortable({
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

                    $('#my_product_images_container ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#my_product_images_container').on( 'click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#my_product_images_container ul li.image').css('cursor','default').each(function() {
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
function cr_portfolio_save_postdata( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['cr_portfolio_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['cr_portfolio_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'cr_portfolio_inner_custom_box' ) )
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
    $mydata = $_POST['my_product_image_gallery'];

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_product_image_gallery', $mydata );
}
add_action( 'save_post', 'cr_portfolio_save_postdata' );


