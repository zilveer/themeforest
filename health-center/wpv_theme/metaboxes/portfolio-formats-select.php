<?php
/**
 * Vamtam Portfolio Format Selector
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('Portfolio Format', 'health-center'),
	'type' => 'separator'
),

array(
	'name' => __('Portfolio Data Type', 'health-center'),
	'desc' => __('Image - uses the featured image (default)<br />
				  Gallery - use the featured image as a title image but show additional images too<br />
				  Video/Link - uses the "portfolio data url" setting<br />
				  Document - acts like a normal post<br />
				  HTML - overrides the image with arbitrary HTML when displaying a single portfolio page. Does not work with the ajax portfolio.
				', 'health-center'),
	'id' => 'portfolio_type',
	'type' => 'radio',
	'options' => array(
		'image' => __('Image', 'health-center'),
		'gallery' => __('Gallery', 'health-center'),
		'video' => __('Video', 'health-center'),
		'link' => __('Link', 'health-center'),
		'document' => __('Document', 'health-center'),
		'html' => __('HTML', 'health-center'),
	),
	'default' => 'image',
),

);
