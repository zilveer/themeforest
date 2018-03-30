<?php

/**
 * Theme options / Layout / General
 *
 * @package wpv
 * @subpackage health-center
 */

return array(
array(
	'name' => __('General', 'health-center'),
	'type' => 'start',
),

array(
	'name' => __('Responsive Layout', 'health-center'),
	'desc' => __('Enabling this option will make the layout respond to the screen resolutions.It is useful mostly on mobile phones.', 'health-center'),
	'id' => 'is-responsive',
	'type' => 'toggle',
	'class' => 'hidden',
),

array(
	'name' => __('Layout Type', 'health-center'),
	'desc' => __('Please note that in full width layout mode, the body background option found in Styles - Body, acts as page background.', 'health-center'),
	'id' => 'site-layout-type',
	'type' => 'select',
	'options' => array(
		'boxed' => __('Boxed', 'health-center'),
		'full' => __('Full width', 'health-center'),
	),
),

array(
	'name' => __('Maximum Page Width', 'health-center'),
	'desc' => sprintf(__('If you have changed this option, please use the <a href="%s" title="Regenerate thumbnails" target="_blank">Regenerate thumbnails</a> plugin in order to update your images.', 'health-center'), 'http://wordpress.org/extend/plugins/regenerate-thumbnails/'),
	'id' => 'site-max-width',
	'type' => 'select',
	'options' => array(
		1080 => '960px',
		1260 => '1140px',
		1380 => '1260px',
	),
),

	array(
		'type' => 'end'
	),
);