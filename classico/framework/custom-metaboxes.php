<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */


add_filter( 'cmb_meta_boxes', 'et_base_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
 
if(!function_exists('et_base_metaboxes')) {
	function et_base_metaboxes( array $meta_boxes ) {
	
		// Start with an underscore to hide fields from custom fields list
		$prefix = '_et_';
	
		/**
		 * Sample metabox to demonstrate each field type included
		 */
		$meta_boxes['page_metabox'] = array(
			'id'         => 'page_metabox',
			'title'      => __( '[8theme] Layout options', ET_DOMAIN ),
			'pages'      => array( 'page', 'post'), // Post type
			'context'    => 'side',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
			'fields'     => array(
		        array(
		            'id'          => ET_PREFIX .'custom_logo',
		            'name'        => 'Custom logo for this page',
				    'desc' => 'Upload an image or enter an URL.',
				    'type' => 'file',
				    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
		        ),
		        array(
		            'id'          => ET_PREFIX .'sidebar_state',
		            'name'        => 'Sidebar Position',
		            'type'        => 'radio',
		            'options'     => array(
	                    'default' => 'Default',
	                    'without' => 'Without',
	                    'left' => 'Left',
	                    'right' => 'Right' 
	                )
		        ),
		        array(
		            'id'          => ET_PREFIX .'widget_area',
		            'name'        => 'Widget Area',
		            'type'        => 'select',
		            'options'     => et_get_sidebars()
		        ),
			    array(
			        'id'          => ET_PREFIX .'sidebar_width',
			        'name'        => 'Sidebar width',
			        'type'        => 'radio',
			        'options'     => array(
		                '' => 'Default', 
		                2 => '1/6', 
		                3 => '1/4', 
		                4 => '1/3' 
		            )
			    ),
		        array(
		            'id'          => ET_PREFIX .'custom_nav',
		            'name'       => 'Custom navigation for this page',
		            'type'        => 'select',
		            'options'     => et_get_menus_options()
		        ),
		        array(
		            'id'          => ET_PREFIX .'one_page',
		            'name'        => 'One page navigation',
		            'default'     => false,
		            'type'        => 'checkbox'
		        ),
		        array(
		            'id'          => ET_PREFIX .'breadcrumb_type',
		            'name'        => 'Breadcrumbs Style',
		            'type'        => 'select',
		            'class'       => '',
		            'options'     => array(
	                    'default'   => 'Default',
	                    '2'   => 'Default left',
	                    '3'   => 'With title',
	                    '4'   => 'With title left',
	                    '5'   => 'Parallax',
	                    '6'   => 'Parallax left',
	                    '7'   => 'With animation',
	                    '8'   => 'Background large',
	                    '9'   => 'Disable',
		            )
		        ),
		        array(
		            'id'          => ET_PREFIX .'page_slider',
		            'name'        => 'Page slider',
		            'desc'        => 'Show revolution slider instead of breadcrumbs and page title',
		            'type'        => 'select',
		            'options'     => et_get_revsliders()
		        ),
		        array(
		            'id'          => ET_PREFIX .'custom_footer',
		            'name'        => 'Use custom footer for this page',
		            'type'        => 'select',
		            'options'     => et_get_post_options( array( 'post_type' => 'staticblocks', 'numberposts' => 100 ) ),
		        ),
			),
		);

		$static_blocks = array();
		$static_blocks[] = "--choose--";
		
		foreach (et_get_static_blocks() as $block) {
			$static_blocks[$block['value']] = $block['label'];
		}

		$meta_boxes['product_metabox'] = array(
			'id'         => 'page_metabox',
			'title'      => __( '[8theme] Product Options', ET_DOMAIN ),
			'pages'      => array( 'product', ), // Post type
			'context'    => 'normal',
			'priority'   => 'low',
			'show_names' => true, // Show field names on the left
			// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
			'fields'     => array(
				array(
				    'name' => 'Additional custom block',
				    'id' => $prefix . 'additional_block',
				    'type'    => 'select',
				    'options' => $static_blocks
				),
				array(
				    'name' => 'Mark product as New',
				    'id' => $prefix . 'product_new',
				    'type' => 'checkbox',
				    'value' => 'enable'
				),
				array(
				    'name' => 'Hover image',
				    'id' => $prefix . 'hover_image',
				    'type' => 'file',
				    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
				),
				array(
				    'name'    => 'Select the layout',
				    'desc'    => 'Select an option',
				    'id'      => $prefix . 'et_single_select',
				    'type'    => 'select',
				    'options' => array(
				        'small' => __( 'Small', ET_DOMAIN ),
				        'medium'   => __( 'Medium', ET_DOMAIN ),
				        'large'     => __( 'Large', ET_DOMAIN ),
				        'fixed'     => __( 'Fixed content', ET_DOMAIN ),
				        'default' => __( 'Default', ET_DOMAIN ),
				    ),
				    'default' => 'default',
				),
			),
		);
	

		$meta_boxes['post_metabox'] = array(
			'id'         => 'post_metabox',
			'title'      => __( '[8theme] Post Options', ET_DOMAIN ),
			'pages'      => array( 'post', ), // Post type
			'context'    => 'normal',
			'priority'   => 'low',
			'show_names' => true, // Show field names on the left
			// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
			'fields'     => array(
				array(
				    'name' => 'Hide featured image on single',
				    'id' => $prefix . 'post_featured',
				    'type' => 'checkbox',
				    'value' => 'enable'
				),
			),
		);
	
	
	
		// Add other metaboxes as needed
	
		return $meta_boxes;
	}
}