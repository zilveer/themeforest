<?php

/**
 * Blockquote shortcode options
 *
 * @package wpv
 * @subpackage editor
 */

return array(
	'name' => __('Testimonials', 'health-center') ,
	'desc' => __('Please note that this element shows already created testimonials. To create one go to Testimonials tab in the WordPress main navigation menu on the left - add new.  ' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('quotes-left'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'blockquote',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Layout', 'health-center') ,
			'id' => 'layout',
			'default' => 'slider',
			'type' => 'select',
			'options' => array(
				'slider' => __('Slider', 'health-center'),
				'static' => __('Static', 'health-center'),
			),
			'field_filter' => 'fbl',
		) ,
		array(
			'name' => __('Categories (optional)', 'health-center') ,
			'desc' => __('By default all categories are active. Please note that if you do not see catgories, most probably there are none created.  You can use ctr + click to select multiple categories.' , 'health-center'),
			'id' => 'cat',
			'default' => array() ,
			'target' => 'testimonials_category',
			'type' => 'multiselect',
		) ,
		array(
			'name' => __('IDs (optional)', 'health-center') ,
			'desc' => __(' By default all testimonials are active. You can use ctr + click to select multiple IDs.', 'health-center') ,
			'id' => 'ids',
			'default' => array() ,
			'target' => 'testimonials',
			'type' => 'multiselect',
		) ,

		array(
			'name' => __('Automatically rotate', 'health-center') ,
			'id' => 'autorotate',
			'default' => false,
			'type' => 'toggle',
			'class' => 'fbl fbl-slider',
		) ,

		array(
			'name' => __('Title (optional)', 'health-center') ,
			'desc' => __('The title is placed just above the element.', 'health-center'),
			'id' => 'column_title',
			'default' => __('', 'health-center') ,
			'type' => 'text'
		) ,


		array(
			'name' => __('Title Type (optional)', 'health-center') ,
			'id' => 'column_title_type',
			'default' => 'single',
			'type' => 'select',
			'options' => array(
				'single' => __('Title with devider next to it.', 'health-center'),
				'double' => __('Title with devider under it.', 'health-center'),
				'no-divider' => __('No Divider', 'health-center'),
			),
		) ,
		array(
			'name' => __('Element Animation (optional)', 'health-center') ,
			'id' => 'column_animation',
			'default' => 'none',
			'type' => 'select',
			'options' => array(
				'none' => __('No animation', 'health-center'),
				'from-left' => __('Appear from left', 'health-center'),
				'from-right' => __('Appear from right', 'health-center'),
				'fade-in' => __('Fade in', 'health-center'),
				'zoom-in' => __('Zoom in', 'health-center'),
			),
		) ,
	) ,
);
