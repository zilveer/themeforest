<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Ronneby theme
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'cmb_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dfd_cmb_convert_option($options, $default_text) {
	$return = array();
	if( is_array($options) ){
		array_unshift( $options, $default_text );
		foreach($options as $v => $k) {
			$result = array();
			$result['name'] = $k;
			$result['value'] = $v;
			$return[] = $result;
		}
	}
	return $return;
}

function cmb_headers_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'dfd_headers_';
	
	$the_headers = dfd_headers_type();
	$logo_position = dfd_logo_position();
	$menu_position = dfd_menu_position();
	
   
	$meta_boxes[] = array(
        'id'         => 'select_header',
        'title'      => __('Select header type', 'dfd'),
        'pages'      =>  array('page','post','my-product','product','gallery'),
        'context'    => 'side',
        'priority'   => 'default',
        'show_names' => true, // Show field names on the left
        'fields'     => array(         
            array(
                'name' => 'Header_Type',
                'desc' => '',
                'id' =>  $prefix.'header_style',
                'type' => 'select',
				'options' => dfd_cmb_convert_option($the_headers, __('--Select header--', 'dfd')),
                'std'  => 'Left Sidebar'
            ),
            array(
                'name' => 'Logo_position',
                'desc' => '',
                'id' =>  $prefix.'logo_position',
                'type' => 'select',   
				'options' => dfd_cmb_convert_option($logo_position, __('--Select logo position--', 'dfd')),
                'std'  => 'Left Sidebar'
            ),
            array(
                'name' => 'Menu_position',
                'desc' => '',
                'id' =>  $prefix.'menu_position',
                'type' => 'select',   
				'options' => dfd_cmb_convert_option($menu_position, __('--Select menu position--', 'dfd')),
                'std'  => 'Left Sidebar'
            ),
			/*array(
                'name' => 'Top_Header',
				'desc'	=> '',
                'id' =>  $prefix.'show_top_header',
				'type'	=> 'radio_inline',
                'std'  => 'Left Sidebar',
				'options' => array(
					array(
						'name' => __('On', 'dfd'),
						'value' => 'on',
					),
					array(
						'name' => __('Off', 'dfd'),
						'value' => 'off',
					),
				),
			),*/
			array(
                'name' => 'Side_Area',
				'desc'	=> '',
                'id' =>  $prefix.'show_side_area',
				'type'	=> 'radio_inline',
                'std'  => 'Left Sidebar',
				'options' => array(
					array(
						'name' => __('On', 'dfd'),
						'value' => 'on',
					),
					array(
						'name' => __('Off', 'dfd'),
						'value' => 'off',
					),
				),
			),
			array(
                'name' => 'Top_inner_page',
				'desc'	=> '',
                'id' =>  $prefix.'show_top_inner_apge',
				'type'	=> 'radio_inline',
                'std'  => 'Left Sidebar',
				'options' => array(
					array(
						'name' => __('On', 'dfd'),
						'value' => 'on',
					),
					array(
						'name' => __('Off', 'dfd'),
						'value' => 'off',
					),
				),
			),
        ),
    );
	$meta_boxes[] = array(
        'id'         => 'adaptive-header-options',
        'title'      => __('Smart header options', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'side',
        'priority'   => 'default',
        'show_on' => array(
			'key' => 'page-template',
			'value' => array(
				'tmp-one-page-scroll.php',
				'tmp-side-by-side.php'
			),
		),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'id'   => 'dfd_auto_header_colors',
                'name' => __('Enable smart header', 'dfd'),
                'desc' => __('', 'dfd'),
				'type'	=> 'radio_inline',
				'std'  => 'Left Sidebar',
				'options' => array(
					array(
						'name' => __('On', 'dfd'),
						'value' => 'on',
					),
					array(
						'name' => __('Off', 'dfd'),
						'value' => 'off',
					),
				),
            ),
		),
	);
	$meta_boxes[] = array(
        'id'         => 'enavle-nav-dots',
        'title'      => esc_html__('One page scroll options', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'side',
        'priority'   => 'default',
        'show_on' => array(
			'key' => 'page-template',
			'value' => array(
				'tmp-one-page-scroll.php',
			),
		),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'id'   => 'dfd_enable_dots',
                'name' => __('Disable dots navigation', 'dfd'),
                'desc' => __('', 'dfd'),
				'type' => 'checkbox',
            ),
			array(
                'id'   => 'dfd_animation_style',
                'name' => __('Animation style', 'dfd'),
                'desc' => __('', 'dfd'),
				'type' => 'select',
				'options' => array(
					array('name' => __('Simple','dfd'),'value' => 'none',),
					array('name' => __('Rotation','dfd'),'value' => 'dfd-3d-style-1',),
					array('name' => __('Scaling','dfd'),'value' => 'dfd-3d-style-2',),
					/*array('name' => __('Style 3','dfd'),'value' => 'dfd-3d-style-3',),*/
				),
				'std'  => 'dfd-3d-style-1',
            ),
		),
	);

    // Add other metaboxes as needed

    return $meta_boxes;
}