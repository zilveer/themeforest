<?php
/**
 * Theme options / Styles / Footer
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
	'name' => __('Where are these options used?', 'health-center'),
	'desc' => __('The footer is the area below the body down to the bottom of your site. It consist of two main areas - the footer and the sub-footer. You can change the style of these areas using the options below.<br>
		Please not that the footer map options are located in general settings - footer map tab.', 'health-center'),
	'type' => 'info',
),

array(
	'name' => __('Backgrounds', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('Widget Areas Background', 'health-center'),
	'desc' => __('If you want to use an image as a background, enabling the cover button will resize and crop the image so that it will always fit the browser window on any resolution. If the color opacity  is less than 1 the page background underneath will be visible.', 'health-center'),
	'id' => 'footer-background',
	'type' => 'background',
	'only' => 'color,opacity,image,repeat,size'
),

array(
	'name' => __('Sub-footer Background', 'health-center'),
	'desc' => __('If you want to use an image as a background, enabling the cover button will resize and crop the image so that it will always fit the browser window on any resolution.', 'health-center'),
	'id' => 'subfooter-background',
	'type' => 'background',
	'only' => 'color,image,repeat,size'
),

array(
	'name' => __('Typography', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('Widget Areas Text', 'health-center'),
	'desc' => __('This is the general font used for the footer widgets.', 'health-center'),
	'id' => 'footer-sidebars-font',
	'type' => 'font',
	'min' => 10,
	'max' => 32,
	'lmin' => 10,
	'lmax' => 64,
),

array(
	'name' => __('Widget Areas Titles', 'health-center'),
	'desc' => __('Please note that this option will override the general headings style set in the General Typography" tab.', 'health-center'),
	'id' => 'footer-sidebars-titles',
	'type' => 'font',
	'min' => 10,
	'max' => 32,
	'lmin' => 10,
	'lmax' => 64,
),

array(
	'name' => __('Sub-footer', 'health-center'),
	'desc' => __('You can place your text/HTML in the General Settings option page.', 'health-center'),
	'id' => 'sub-footer',
	'type' => 'font',
	'min' => 10,
	'max' => 32,
	'lmin' => 10,
	'lmax' => 64,
),

array(
	'name' => __('Links', 'health-center'),
	'type' => 'color-row',
	'inputs' => array(
		'css_footer_link_color' => array(
			'name' => __('Normal:', 'health-center'),
		),
		'css_footer_link_visited_color' => array(
			'name' => __('Visited:', 'health-center'),
		),
		'css_footer_link_hover_color' => array(
			'name' => __('Hover:', 'health-center'),
		),
	),
),

	array(
		'type' => 'end'
	),

);