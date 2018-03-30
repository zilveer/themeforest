<?php if (!defined('ABSPATH')) exit(); ?>

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'search_page_show_title_bar',
	'type' => 'checkbox',
	'title'=> __('Display Title Bar', 'cardealer'),
	'description' => '',
	'default_value' => 0,
	'css_class' => '',
	'is_reset' => true,
	'hide' => TMM::get_option('search_page_header_type') === 'alternate' ? false : true,
));
?>

<div id="search_page_title_bar_content"<?php echo TMM::get_option('search_page_show_title_bar') ? '' : ' style="display:none"' ?>>

	<?php
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'search_page_alt_title',
		'type' => 'text',
		'title'=> __('Alternate Title', 'cardealer'),
		'description' => __('Leave blank to use native page namings.', 'cardealer'),
		'default_value' => '',
	));
	?>

	<?php
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'search_page_subtitle',
		'type' => 'text',
		'title'=> __('Subtitle', 'cardealer'),
		'description' => __('Leave blank to not use or Fill it in if you want to add a second level heading underneath main page title.', 'cardealer'),
		'default_value' => '',
	));
	?>

	<?php
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'search_page_title_bar_bg_type',
		'css_class' => 'search_page_title_bar_bg_type',
		'type' => 'select',
		'title'=> __('Title Bar Background', 'cardealer'),
		'description' => __('Choose an option for background filling.', 'cardealer'),
		'default_value' => 'color',
		'values' => array(
			'color' => __("Color", 'cardealer'),
			'image' => __("Image", 'cardealer'),
		),

	));
	?>

	<?php
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'search_page_title_bar_bg_color',
		'css_class' => 'search_page_title_bar_bg_color',
		'title'=>__('Background Color', 'cardealer'),
		'type' => 'color',
		'default_value' => '',
		'description' => __('Set a background color using HEX code format or use a colorpicker.', 'cardealer'),
		'css_class' => '',
		'is_reset' => true,
		'hide' => TMM::get_option('search_page_title_bar_bg_type') !== 'image' ? 0 : 1
	));
	?>

	<?php
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'search_page_title_bar_bg_image',
		'id' => 'search_page_title_bar_bg_image',
		'title'=>__('Background Image', 'cardealer'),
		'type' => 'upload',
		'default_value' => '',
		'description' => __('Set a background image by typing in an absolute path to your image or chose one from your media library.', 'cardealer'),
		'css_class' => '',
		'is_reset' => true,
		'hide' => TMM::get_option('search_page_title_bar_bg_type') === 'image' ? 0 : 1
	));
	?>

	<?php
	TMM_OptionsHelper::draw_theme_option(array(
		'name' => 'search_page_title_bar_bg_image_option',
		'css_class' => 'search_page_title_bar_bg_image_option',
		'type' => 'select',
		'title'=> __('Background image options', 'cardealer'),
		'description' => __('Set a background repetition type or make it fixed to have like a parallax effect.', 'cardealer'),
		'default_value' => 'repeat',
		'values' => array(
			"repeat" => __("Repeat", 'cardealer'),
			"repeat-x" => __("Repeat-X", 'cardealer'),
			"fixed" => __("Fixed", 'cardealer'),
		),
		'hide' => TMM::get_option('search_page_title_bar_bg_type') === 'image' ? 0 : 1
	));
	?>

</div>