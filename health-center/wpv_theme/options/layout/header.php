<?php

/**
 * Theme options / Layout / Header
 *
 * @package wpv
 * @subpackage health-center
 */

return array(
array(
	'name' => __('Header', 'health-center'),
	'type' => 'start',
),

array(
	'name' => __('Header Layout', 'health-center'),
	'desc' => __('Please note that the theme uses Revolution Slider and its option panel is found in the WordPress navigation menu on the left', 'health-center'),
	'type' => 'info',
),


array(
	'name' => __('Header Layout', 'health-center'),
	'type' => 'autofill',
	'class' => 'no-box',
	'option_sets' => array(
		array(
			'name' => __('One row, left logo, menu on the right', 'health-center'),
			'image' => WPV_ADMIN_ASSETS_URI . 'images/header-layout-1.png',
			'values' => array(
				'header-layout' => 'logo-menu',
			),
		),
		array(
			'name' => __('Two rows; left-aligned logo on top, right-aligned text and search', 'health-center'),
			'image' => WPV_ADMIN_ASSETS_URI . 'images/header-layout-2.png',
			'values' => array(
				'header-layout' => 'logo-text-menu',
			),
		),
		array(
			'name' => __('Two rows; centered logo on top', 'health-center'),
			'image' => WPV_ADMIN_ASSETS_URI . 'images/header-layout-3.png',
			'values' => array(
				'header-layout' => 'standard',
			),
		),
	),
),


array(
	'name' => __('Header Height', 'health-center'),
	'desc' => __('This is the area above the slider.', 'health-center'),
	'id' => 'header-height',
	'type' => 'range',
	'min' => 30,
	'max' => 300,
	'unit' => 'px',
),
array(
	'name' => __('Sticky Header', 'health-center'),
	'desc' => __('This option is switched off automatically for mobile devices because the animation is not well sported by the majority of the mobile devices.', 'health-center'),
	'id' => 'sticky-header',
	'type' => 'toggle',
),


array(
	'name' => __('Enable Header Search', 'health-center'),
	'id' => 'enable-header-search',
	'type' => 'toggle',
),

array(
	'name' => __('Full Width Header', 'health-center'),
	'id' => 'full-width-header',
	'type' => 'toggle',
	'class' => 'fhl fhl-logo-menu',
),

array(
	'name' => __('Top Bar Layout', 'health-center'),
	'id' => 'top-bar-layout',
	'type' => 'select',
	'options' => array(
		'' => __('Disabled', 'health-center'),
		'menu-social' => __('Left: Menu, Right: Social Icons', 'health-center'),
		'social-menu' => __('Left: Social Icons, Right: Menu', 'health-center'),
		'text-menu' => __('Left: Text, Right: Menu', 'health-center'),
		'menu-text' => __('Left: Menu, Right: Text', 'health-center'),
		'social-text' => __('Left: Social Icons, Right: Text', 'health-center'),
		'text-social' => __('Left: Text, Right: Social Icons', 'health-center'),
	),
	'field_filter' => 'ftbl',
),

array(
	'name' => __('Top Bar Text', 'health-center'),
	'desc' => __('You can place plain text, HTML and shortcodes.', 'health-center'),
	'id' => 'top-bar-text',
	'type' => 'textarea',
	'class' => 'ftbl ftbl-menu-text ftbl-text-menu ftbl-social-text ftbl-text-social',
),

array(
	'name' => __('Top Bar Social Text Lead', 'health-center'),
	'id' => 'top-bar-social-lead',
	'type' => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Facebook Link', 'health-center'),
	'id'    => 'top-bar-social-fb',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Twitter Link', 'health-center'),
	'id'    => 'top-bar-social-twitter',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar LinkedIn Link', 'health-center'),
	'id'    => 'top-bar-social-linkedin',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Google+ Link', 'health-center'),
	'id'    => 'top-bar-social-gplus',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Flickr Link', 'health-center'),
	'id'    => 'top-bar-social-flickr',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Pinterest Link', 'health-center'),
	'id'    => 'top-bar-social-pinterest',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Dribbble Link', 'health-center'),
	'id'    => 'top-bar-social-dribbble',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Instagram Link', 'health-center'),
	'id'    => 'top-bar-social-instagram',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar YouTube Link', 'health-center'),
	'id'    => 'top-bar-social-youtube',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name'  => __('Top Bar Vimeo Link', 'health-center'),
	'id'    => 'top-bar-social-vimeo',
	'type'  => 'text',
	'class' => 'ftbl ftbl-menu-social ftbl-social-menu ftbl-social-text ftbl-text-social slim',
),

array(
	'name' => __('Header Layout', 'health-center'), // dummy option, do not remove
	'id' => 'header-layout',
	'type' => 'select',
	'class' => 'hidden',
	'options' => array(
		'standard' => __('Two rows; centered logo on top', 'health-center'),
		'logo-menu' => __('One row, left logo, menu on the right', 'health-center'),
		'logo-text-menu' => __('Two rows; left-aligned logo on top, right-aligned text and search', 'health-center'),
	),
	'field_filter' => 'fhl',
),

array(
	'name' => __('Header Text Area', 'health-center'),
	'desc' => __('You can place text/HTML or any shortcode in this field. The text will appear in the header on the left hand side.', 'health-center'),
	'id' => 'phone-num-top',
	'type' => 'textarea',
	'static' => true,
),

array(
	'name' => __('Mobile Header', 'health-center'),
	'type' => 'separator',
),

array(
	'name'   => __('Enable Below', 'health-center'),
	'id'     => 'mobile-top-bar-resolution',
	'type'   => 'range',
	'min'    => 320,
	'max'    => 4000,
	'static' => true,
),

array(
	'name'   => __('Enable Search in Logo Bar', 'health-center'),
	'id'     => 'mobile-search-in-header',
	'type'   => 'toggle',
	'static' => true,
),

array(
	'name'   => __('Mobile Top Bar', 'health-center'),
	'id'     => 'mobile-top-bar',
	'type'   => 'textarea',
	'static' => true,
),

	array(
		'type' => 'end'
	),

);