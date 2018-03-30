<?php

/**
 * Theme options / General / General Settings
 *
 * @package wpv
 * @subpackage health-center
 */

return array(
array(
	'name' => __('General Settings', 'health-center'),
	'type' => 'start'
),

array(
	'name' => __('Custom Logo Picture', 'health-center'),
	'desc' => __('Please Put a logo which exactly twice the width and height of the space that you
	 want the logo to occupy. The real image size is used for retina displays.', 'health-center'),
	'id' => 'custom-header-logo',
	'type' => 'upload',
	'static' => true,
),

array(
	'name' => __('Splash Screen Logo', 'health-center'),
	'id' => 'splash-screen-logo',
	'type' => 'upload',
	'static' => true,
),

array(
	'name' => __('Google Maps API Key', 'health-center'),
	'desc'   => __("This option is required since June 22, 2016. Paste your Google Maps API Key here. If you don't have one, please sign up for a <a href='https://developers.google.com/maps/documentation/javascript/get-api-key'>Google Maps API key</a>.", 'health-center'),
	'id' => 'gmap_api_key',
	'type' => 'text',
	'static' => true,
),

array(
	'name' => __('Google Analytics Key', 'health-center'),
	'desc' => __("Paste your key here. It should be something like UA-XXXXX-X. We're using the faster asynchronous loader, so you don't need to worry about speed.", 'health-center'),
	'id' => 'analytics_key',
	'type' => 'text',
	'static' => true,
),

array(
	'name' => __('"Scroll to Top" Button', 'health-center'),
	'desc' => __('It is found in the bottom right side. It is sole purpose is help the user scroll a long page quickly to the top.', 'health-center'),
	'id' => 'show_scroll_to_top',
	'type' => 'toggle',
),

array(
	'name' => __('Feedback Button', 'health-center'),
	'desc' => __('It is found on the right hand side of your website. You can chose from a "link" or a slide out form(widget area).The slide out form is configured as a standard widget. You can use the same form you are using for your "contact us" page.', 'health-center'),
	'id' => 'feedback-type',
	'type' => 'select',
	'options' => array(
		'none' => __('None', 'health-center'),
		'link' => __('Link', 'health-center'),
		'sidebar' => __('Slide out widget area', 'health-center'),
	),
),

array(
	'name' => __('Feedback Button Link', 'health-center'),
	'desc' => __('If you have chosen a "link" in the option above, place the link of the button here, usually to your contact us page.', 'health-center'),
	'id' => 'feedback-link',
	'type' => 'text',
),

array(
	'name' => __('Share Icons', 'health-center'),
	'desc' => __('Select the social media you want enabled and for which parts of the website', 'health-center'),
	'type' => 'social',
	'static' => true,
),

array(
	'name' => __('Custom JavaScript', 'health-center'),
	'desc' => __('If the hundreds of options in the Theme Options Panel are not enough and you need customisation that is outside of the scope of the Theme Option Panel please place your javascript in this field. The contents of this field are placed near the <strong>&lt;/body&gt;</strong> tag, which improves the load times of the page.', 'health-center'),
	'id' => 'custom_js',
	'type' => 'textarea',
	'rows' => 15,
	'static' => true,
),

array(
	'name' => __('Custom CSS', 'health-center'),
	'desc' => __('If the hundreds of options in the Theme Options Panel are not enough and you need customisation that is outside of the scope of the Theme Options Panel please place your CSS in this field.', 'health-center'),
	'id' => 'custom_css',
	'type' => 'textarea',
	'rows' => 15,
	'class' => 'top-desc',
),

array(
	'type' => 'end'
)
);