<?php
/**
 * Theme options / Styles / General Typography
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('General Typography', 'health-center'),
	'type' => 'start',
),

array(
	'name' => __('Where are these options used?', 'health-center'),
	'desc' => __('The options bellow are used for headings, titles and emphasizing text in different parts of the website.<br>
Please note that some of the options for styling text are present in header, body and footer tabs as they are specific only to each area - for example, main menu, body general text, footer widget titles, etc.<br>
<strong>Some combinations of typography settings are not possible - for example, not all fonts feature a 300 weight. In such cases the browser substitutes the font with its default setting.</strong>
', 'health-center'),
	'type' => 'info',
),

array(
	'name' => __('Headlines', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('H1', 'health-center'),
	'id' => 'h1',
	'type' => 'font',
	'min' => 14,
	'max' => 60,
	'lmin' => 14,
	'lmax' => 120,
),

array(
	'name' => __('H2', 'health-center'),
	'id' => 'h2',
	'type' => 'font',
	'min' => 14,
	'max' => 60,
	'lmin' => 14,
	'lmax' => 120,
),

array(
	'name' => __('H3', 'health-center'),
	'id' => 'h3',
	'type' => 'font',
	'min' => 12,
	'max' => 30,
	'lmin' => 12,
	'lmax' => 60,
),

array(
	'name' => __('H4', 'health-center'),
	'id' => 'h4',
	'type' => 'font',
	'min' => 12,
	'max' => 24,
	'lmin' => 12,
	'lmax' => 48,
),

array(
	'name' => __('H5', 'health-center'),
	'id' => 'h5',
	'type' => 'font',
	'min' => 10,
	'max' => 18,
	'lmin' => 10,
	'lmax' => 36,
),

array(
	'name' => __('H6', 'health-center'),
	'id' => 'h6',
	'type' => 'font',
	'min' => 10,
	'max' => 16,
	'lmin' => 10,
	'lmax' => 32,
),

array(
	'name' => __('Additional Font Styles', 'health-center'),
	'type' => 'separator',
),

array(
	'name' => __('Emphasis Font', 'health-center'),
	'id' => 'em',
	'type' => 'font',
	'min' => 1,
	'max' => 20,
	'lmin' => 1,
	'lmax' => 40,
),

array(
	'name' => __('Style 1', 'health-center'),
	'id' => 'additional-font-1',
	'type' => 'font',
	'min' => 10,
	'max' => 50,
	'lmin' => 10,
	'lmax' => 100,
),

array(
	'name' => __('Style 2', 'health-center'),
	'id' => 'additional-font-2',
	'type' => 'font',
	'min' => 10,
	'max' => 50,
	'lmin' => 10,
	'lmax' => 100,
),

array(
	'name' => __('Google Fonts Subsets', 'health-center'),
	'desc' => __('Separate the subsets with commas and no empty spaces. The full list of available subsets is:<br>
		<strong>cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese</strong><br><br>
		Not all fonts support every subset. Please check the Google Fonts Directory for compatibility.', 'health-center'),
	'id' => 'google-fonts-subsets',
	'type' => 'text',
),

array(
	'name' => __('Custom Font Families', 'health-center'),
	'desc' => __('In order to use fonts other than the ones hosted by Google, you need to include them in a <a href="http://vamtam.com/child-themes/">child theme</a>. This option is used for adding font families to the dropdowns in the font options. If you change this setting, please refresh this page so that your changes can take place.<br> Only add one font family per line.', 'health-center'),
	'id' => 'custom-font-families',
	'type' => 'textarea',
),

	array(
		'type' => 'end'
	),
);