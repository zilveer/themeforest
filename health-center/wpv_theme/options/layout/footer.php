<?php

/**
 * Theme options / Layout / Footer
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('Footer', 'health-center'),
	'type' => 'start',
),

array(
	'name' => __('Footer Layout', 'health-center'),
	'desc' => __('You can enable or disable the footer widget areas and choose the desired layout. This will be the default layout for all pages.<br>
		Please not that the footer map options are located in general settings - footer map tab', 'health-center'),
	'type' => 'info',
),

array(
	'name' => __('Enable Footer Widget Areas', 'health-center'),
	'desc' => __('This option only enables the area. You can set the layout, using the two options below.  In appearance - widgets, you can populate the area with widgets.', 'health-center'),
	'id' => 'has-footer-sidebars',
	'type' => 'toggle',
),

array(
	'name' => __('Footer Widget Area Pre-defined Layouts', 'health-center'),
	'desc' => __('The widget areas bellow are placed between the body and the sub-footer.  You can either choose one of the predefined layouts or configure your own in the "Advanced" section bellow.', 'health-center'),
	'type' => 'autofill',
	'class' => 'no-box',
	'option_sets' => array(
		array(
			'name' => __('1/3 | 1/3 | 1/3', 'health-center'),
			'image' => WPV_ADMIN_ASSETS_URI . 'images/footer-sidebars-3.png',
			'values' => array(
				'footer-sidebars' => 3,
				'footer-sidebars-1-width' => 'cell-1-3',
				'footer-sidebars-1-last' => 0,
				'footer-sidebars-2-width' => 'cell-1-3',
				'footer-sidebars-2-last' => 0,
				'footer-sidebars-3-width' => 'cell-1-3',
				'footer-sidebars-3-last' => 1,
				'footer-sidebars-4-width' => 'full',
				'footer-sidebars-4-last' => 0,
				'footer-sidebars-5-width' => 'full',
				'footer-sidebars-5-last' => 0,
				'footer-sidebars-6-width' => 'full',
				'footer-sidebars-6-last' => 0,
			),
		),
		array(
			'name' => __('1/4 | 1/4 | 1/4 | 1/4', 'health-center'),
			'image' => WPV_ADMIN_ASSETS_URI . 'images/footer-sidebars-4.png',
			'values' => array(
				'footer-sidebars' => 4,
				'footer-sidebars-1-width' => 'cell-1-4',
				'footer-sidebars-1-last' => 0,
				'footer-sidebars-2-width' => 'cell-1-4',
				'footer-sidebars-2-last' => 0,
				'footer-sidebars-3-width' => 'cell-1-4',
				'footer-sidebars-3-last' => 0,
				'footer-sidebars-4-width' => 'cell-1-4',
				'footer-sidebars-4-last' => 1,
				'footer-sidebars-5-width' => 'full',
				'footer-sidebars-5-last' => 0,
				'footer-sidebars-6-width' => 'full',
				'footer-sidebars-6-last' => 0,
			),
		),

		array(
			'name' => __('1/5 | 1/5 | 1/5 | 1/5 | 1/5', 'health-center'),
			'image' => WPV_ADMIN_ASSETS_URI . 'images/footer-sidebars-5.png',
			'values' => array(
				'footer-sidebars' => 5,
				'footer-sidebars-1-width' => 'cell-1-5',
				'footer-sidebars-1-last' => 0,
				'footer-sidebars-2-width' => 'cell-1-5',
				'footer-sidebars-2-last' => 0,
				'footer-sidebars-3-width' => 'cell-1-5',
				'footer-sidebars-3-last' => 0,
				'footer-sidebars-4-width' => 'cell-1-5',
				'footer-sidebars-4-last' => 0,
				'footer-sidebars-5-width' => 'cell-1-5',
				'footer-sidebars-5-last' => 1,
				'footer-sidebars-6-width' => 'full',
				'footer-sidebars-6-last' => 0,
			),
		),
	),
),

array(
	'name' => __('Footer Widget Areas Advanced Layout Builder', 'health-center'),
	'desc' => __("Please choose the number of widget areas and adjust each widget area's settings. You can adjust the width of each widget area from the drop - down menu and place them in one to six rows by using 'last' option. 'Empty' is used if you do not intend to place a widget into certain widget area. If there is no widget in an widget area and this option is not ticked the layout may be broken.
", 'health-center'),
	'id_prefix' => 'footer-sidebars',
	'type' => 'horizontal_blocks',
	'min' => 0,
	'max' => 6,
),

array(
	'name' => __('Text Area in Footer', 'health-center'),
	'desc' => __('You can place text/HTML or any shortcode in this field. The text will appear in the  footer of your website.', 'health-center'),
	'id' => 'credits',
	'type' => 'textarea',
	'static' => true,
),

	array(
		'type' => 'end'
	),

);