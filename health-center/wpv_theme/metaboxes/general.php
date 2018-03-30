<?php
/**
 * Vamtam Post Options
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('Layout and Styles', 'health-center'),
	'type' => 'separator'
),

array(
	'name' => __('Page Slider', 'health-center'),
	'desc' => __('In the drop down you will see the sliders that you have created. Please note that the theme uses Revolution Slider and its option panel is found in the WordPress navigation menu on the left.', 'health-center'),
	'id' => 'slider-category',
	'type' => 'select',
	'default' => '',
	'prompt' => __('Disabled', 'health-center'),
	'options' => WpvTemplates::get_all_sliders(),
	'class' => 'fbport fbport-disabled',
),

array(
	'name' => __('Show Splash Screen', 'health-center'),
	'desc' => __('This option is usuful if you have video background,
		 featured slider, galleries or other pages that will load considarable amount of time.', 'health-center'),
	'id' => 'show-splash-screen',
	'type' => 'toggle',
	'default' => false,
),

array(
	'name' => __('Header Featured Area', 'health-center'),
	'desc' => __('This option is only active if you have disabled the header slider. You can place plain text or HTML into it.', 'health-center'),
	'id' => 'page-middle-header-content',
	'type' => 'textarea',
	'default' => '',
	'class' => 'fbport fbport-disabled',
),

array(
	'name' => __('Full Width Header Featured Area', 'health-center'),
	'desc' => __('Extend the featured area to the end of the screen. This is basicly a full screen mode.', 'health-center'),
	'id' => 'page-middle-header-content-fullwidth',
	'type' => 'toggle',
	'default' => 'false',
),

array(
	'name' => __('Header Featured Area Minimum Height', 'health-center'),
	'desc' => __('Please note that this option does not affect the slider height. The slider height is controled from the LayerSlider option panel.', 'health-center'),
	'id' => 'page-middle-header-min-height',
	'type' => 'range',
	'default' => 0,
	'min' => 0,
	'max' => 1000,
	'unit' => 'px',
	'class' => 'fbport fbport-disabled',
),

array(
	'name' => __('Featured Area / Slider Background', 'health-center'),
	'desc' => __('This option is used for the featured area, header slider and the Ajax portfolio slider.<br>If you want to use an image as a background, enabling the cover button will resize and crop the image so that it will always fit the browser window on any resolution.', 'health-center'),
	'id' => 'local-title-background',
	'type' => 'background',
	'show' => 'color,image,repeat,size',
	'class' => 'fbport fbport-disabled fbport-page',
),

array(
	'name' => __('Sticky Header Behaviour', 'health-center'),
	'id' => 'sticky-header-type',
	'type' => 'select',
	'default' => 'normal',
	'desc' => __('Please make sure you have the sticky header enabled in theme options - layout - header.', 'health-center'),
	'options' => array(
		'normal' => __('Normal', 'health-center'),
		'over' => __('Over the page content', 'health-center'),
	),
	'class' => 'fbport fbport-disabled',
),


array(
	'name' => __('Show Page Title Area', 'health-center'),
	'desc' => __('Enables the area used by the page title.', 'health-center'),
	'id' => 'show-page-header',
	'type' => 'toggle',
	'default' => true,
	'class' => 'fbport fbport-disabled',
),

array(
	'name' => __('Page Title Background', 'health-center'),
	'id' => 'local-page-title-background',
	'type' => 'background',
	'show' => 'color,image,repeat,size',
	'class' => 'fbport fbport-disabled',
),

array(
	'name' => __('Description', 'health-center'),
	'desc' => __('The text will appear next or bellow the title of the page, only if the option above is enabled.', 'health-center'),
	'id' => 'description',
	'type' => 'textarea',
	'only' => 'page',
	'default' => '',
),

array(
	'name' => __('Show Body Top Widget Areas', 'health-center'),
	'desc' => __('The layout of these areas can be configured from "Vamtam" -> "Layout" -> "Body". In Appearance => Widgets you populate them with widgets.', 'health-center'),
	'image' => WPV_ADMIN_ASSETS_URI.'images/header-sidebars-3.png',
	'id' => 'show_header_sidebars',
	'type' => 'toggle',
	'default' => wpv_get_option('has-header-sidebars'),
	'has_default' => true,
	'class' => 'fbport fbport-disabled',
	'only' => 'page,post,portfolio,product',
),

array(
	'name' => __('Page Layout Type', 'health-center'),
	'desc' => __('The sidebars are placed just below the page title. You can choose one of the predefined layouts.', 'health-center'),
	'id' => 'layout-type',
	'type' => 'body-layout',
	'only' => 'page,post,portfolio,product,tribe_events,events',
	'default' => 'default',
	'has_default' => true,
	'class' => 'fbport fbport-disabled',
),
array(
	'name' => __('Custom Sidebars', 'health-center'),
	'desc' => __('This option correlates with the one above. If you have custom sidebars created, you will enable them by selecting them in the drop-down menu. Otherwise the page default sidebars will be used.', 'health-center'),
	'type' => 'select-row',
	'selects' => array(
		'left_sidebar_type' => array(
			'desc' => __('Left:', 'health-center'),
			'prompt' => __('Default', 'health-center'),
			'target' => 'sidebars',
			'default' => false,
		),
		'right_sidebar_type' => array(
			'desc' => __('Right:', 'health-center'),
			'prompt' => __('Default', 'health-center'),
			'target' => 'sidebars',
			'default' => false,
		),
	),
	'class' => 'fbport fbport-disabled',
),

array(
	'name' => __('Page Background', 'health-center'),
	'desc' => __('Please note that this option is used only in boxed layout mode.<br>
In full width layout mode the page background is covered by the header, slider, body and footer backgrounds respectively. If the color opacity of these areas is 1 or an opaque image is used, the page background won\'t be visible.<br>
If you want to use an image as a background, enabling the cover button will resize and crop the image so that it will always fit the browser window on any resolution.<br>
You can override this option on a page by page basis.', 'health-center'),
	'id' => 'background',
	'type' => 'background',
	'show' => 'color,image,repeat,size,attachment',
),

array(
	'name' => __('Use Bottom Padding on This Page', 'health-center'),
	'desc' => __('If you disable this option, the last element will stick to the footer. Useful for parallax pages.', 'health-center'),
	'id' => 'use-page-bottom-padding',
	'type' => 'toggle',
	'default' => true,
	'class' => 'fbport fbport-disabled',
),

);
