<?php 
/**
 *  @package by Theme Record
*/

$repeat_options = array(
	'no-repeat' => __('No Repeat', 'TR'),
	'repeat-x' => __('Repeat only Horizontally', 'TR'),
	'repeat-y' => __('Repeat only Vertically', 'TR'),
	'repeat' => __('Repeat both Vertically and Horizontally', 'TR')
);

$horizontal_options = array(
	'left' => __('Left', 'TR'),
	'right' => __('Right', 'TR'),
	'center' => __('Center', 'TR')
);

$vertical_options = array(
	'top' => __('Top', 'TR'),
	'bottom' => __('Bottom', 'TR'),
	'center' => __('Center', 'TR')
);

$attachment_options = array(
	'fixed' => __('Fixed', 'TR'),
	'scroll' => __('Scroll', 'TR')
);


$options = array(

	array('name' => __('Colors Settings', 'TR'), 'type' => 'tab_page_title'),

	array('type' => 'tabs_head'),

	//Tab Title
	array('type' => 'tab_title_head'),
	array('name' => __('General', 'TR'), 'slug' => 'general', 'class' => 'active', 'type' => 'tab'),
	array('name' => __('Announcement', 'TR'), 'slug' => 'announcement', 'type' => 'tab'),
	array('name' => __('Header', 'TR'), 'slug' => 'header', 'type' => 'tab'),
	array('name' => __('Slideshow', 'TR'), 'slug' => 'slideshow', 'type' => 'tab'),
	array('name' => __('Page Header', 'TR'), 'slug' => 'page_header', 'type' => 'tab'),
	array('name' => __('Buttons', 'TR'), 'slug' => 'buttons', 'type' => 'tab'),
	array('name' => __('Footer Widgets', 'TR'), 'slug' => 'footer-widgets', 'type' => 'tab'),
	array('name' => __('Footer Contact', 'TR'), 'slug' => 'footer-contact', 'type' => 'tab'),
	array('name' => __('Copyright', 'TR'), 'slug' => 'copyright', 'type' => 'tab'),
	array('type' => 'tab_title_foot'),

	//General
	array('slug' => 'general', 'type' => 'tab_content_head'),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the body background color.','TR'),
			'id' => 'body_bg_color',
			'std' => 'FFFFFF',
			'size' => '6',
			'type' => 'color'
	),

	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the basic text color.','TR'),
			'id' => 'text_color',
			'std' => '444444',
			'size' => '6',
			'type' => 'color'
	),

	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the basic link color.','TR'),
			'id' => 'link_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),

	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the basic link hover color.','TR'),
			'id' => 'hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),

	array(
			'name' => __('Hgroup Color','TR'),
			'desc' => __('It is the hgroup text color.','TR'),
			'id' => 'hgroup_color',
			'std' => '181818',
			'size' => '6',
			'class' => 'no',
			'type' => 'color'
	),
	array('type' => 'tab_content_foot'),


	//Announcement
	array('slug' => 'announcement', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the text color for announcement.','TR'),
			'id' => 'ac_text_color',
			'std' => 'FFFFFF',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the announcement link color.','TR'),
			'id' => 'ac_link_color',
			'std' => 'AAAAAA',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the announcement hover link color.','TR'),
			'id' => 'ac_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the announcement background color.','TR'),
			'id' => 'ac_bg_color',
			'std' => '444444',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_ac_bg_image',
			'std' => '',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'ac_bg_repeat',
			'std' => 'no-repeat',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'ac_bg_horizontal',
			'std' => 'center',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'ac_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),


	//Header
	array('slug' => 'header', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Top Line Color','TR'),
			'desc' => __('It is the top line color.','TR'),
			'id' => 'header_top_line_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the header text color for site and menu description.','TR'),
			'id' => 'header_text_color',
			'std' => '999999',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Menu Link Color','TR'),
			'desc' => __('It is the main menu link color.','TR'),
			'id' => 'header_menu_link_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Menu Hover Color','TR'),
			'desc' => __('It is the main menu link hover color.','TR'),
			'id' => 'header_menu_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Menu Background Color','TR'),
			'desc' => __('It is the menu background color when you hover on.','TR'),
			'id' => 'header_menu_bg_color',
			'std' => 'F8F8F8',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Sub Menu Background Color','TR'),
			'desc' => __('It is the sub menu background color when you hover on.','TR'),
			'id' => 'header_sub_menu_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the header background color.','TR'),
			'id' => 'header_bg_color',
			'std' => 'FFFFFF',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_header_bg_image',
			'std' => '',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'header_bg_repeat',
			'std' => 'no-repeat',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'header_bg_horizontal',
			'std' => 'center',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'header_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),


	//Slideshow
	array('slug' => 'slideshow', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Title Color','TR'),
			'desc' => __('It is the slideshow title color.','TR'),
			'id' => 'slideshow_title_color',
			'std' => '181818',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the slideshow text color.','TR'),
			'id' => 'slideshow_text_color',
			'std' => '444444',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the slideshow link color.','TR'),
			'id' => 'slideshow_link_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the slideshow link hover color.','TR'),
			'id' => 'slideshow_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the slideshow background color.','TR'),
			'id' => 'slideshow_bg_color',
			'std' => 'F9F9F9',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_slideshow_bg_image',
			'std' => '',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'slideshow_bg_repeat',
			'std' => 'repeat-x',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'slideshow_bg_horizontal',
			'std' => 'left',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'slideshow_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),


	//Page Header
	array('slug' => 'page_header', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Title Color','TR'),
			'desc' => __('It is the page header title color.','TR'),
			'id' => 'page_header_title_color',
			'std' => '181818',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the page header text color.','TR'),
			'id' => 'page_header_text_color',
			'std' => '999999',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the page header link color.','TR'),
			'id' => 'page_header_link_color',
			'std' => '999999',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the page header link hover color.','TR'),
			'id' => 'page_header_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the page header background color.','TR'),
			'id' => 'page_header_bg_color',
			'std' => 'F9F9F9',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_page_header_bg_image',
			'std' => '',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'page_header_bg_repeat',
			'std' => 'repeat-x',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'page_header_bg_horizontal',
			'std' => 'left',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'page_header_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),


	//Buttons
	array('slug' => 'buttons', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Announcement Button Color','TR'),
			'desc' => __('It is the close announcement button background color.','TR'),
			'id' => 'button_ac_bg_color',
			'std' => '222222',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Announcement Hover Button Color','TR'),
			'desc' => __('It is the close announcement hover button background color.','TR'),
			'id' => 'button_ac_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Slideshow Button Color','TR'),
			'desc' => __('It is the slideshow button background color.','TR'),
			'id' => 'button_slideshow_bg_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Slideshow Hover Button Color','TR'),
			'desc' => __('It is the slideshow hover button background color.','TR'),
			'id' => 'button_slideshow_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Carousel Button Color','TR'),
			'desc' => __('It is the carousel button background color.','TR'),
			'id' => 'button_carousel_bg_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Carousel Hover Button Color','TR'),
			'desc' => __('It is the carousel hover button background color.','TR'),
			'id' => 'button_carousel_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Format Icon Color','TR'),
			'desc' => __('It is the blog format icon background color.','TR'),
			'id' => 'button_format_bg_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Format Icon Hover Color','TR'),
			'desc' => __('It is the blog format icon hover background color.','TR'),
			'id' => 'button_format_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Read More Button Color','TR'),
			'desc' => __('It is the read more button background color.','TR'),
			'id' => 'button_read_more_bg_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Read More Hover Button Color','TR'),
			'desc' => __('It is the read more hover button background color.','TR'),
			'id' => 'button_read_more_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Pagenation Button Color','TR'),
			'desc' => __('It is the pagenation button background color.','TR'),
			'id' => 'button_pagenation_bg_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Pagenation Hover Button Color','TR'),
			'desc' => __('It is the pagenation hover button background color.','TR'),
			'id' => 'button_pagenation_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Submit Button Color','TR'),
			'desc' => __('It is the submit button background color.','TR'),
			'id' => 'button_submit_bg_color',
			'std' => '333333',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Submit Hover Button Color','TR'),
			'desc' => __('It is the submit hover button background color.','TR'),
			'id' => 'button_submit_hover_bg_color',
			'std' => 'DA5A04',
			'size' => '6',
			'class' => 'no',
			'type' => 'color'
	),
	array('type' => 'tab_content_foot'),

	//Footer Widgets
	array('slug' => 'footer-widgets', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Title Color','TR'),
			'desc' => __('It is the footer widgets title color.','TR'),
			'id' => 'footer_widgets_title_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the footer widgets text color.','TR'),
			'id' => 'footer_widgets_text_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the footer widgets link color.','TR'),
			'id' => 'footer_widgets_link_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the footer widgets link hover color.','TR'),
			'id' => 'footer_widgets_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the footer widgets background color.','TR'),
			'id' => 'footer_widgets_bg_color',
			'std' => '202222',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_footer_widgets_bg_image',
			'std' => '',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'footer_widgets_bg_repeat',
			'std' => 'no-repeat',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'footer_widgets_bg_horizontal',
			'std' => 'center',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'footer_widgets_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),

	//Footer Contact
	array('slug' => 'footer-contact', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the footer contact text color.','TR'),
			'id' => 'footer_contact_text_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the footer contact link color.','TR'),
			'id' => 'footer_contact_link_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the footer contact link hover color.','TR'),
			'id' => 'footer_contact_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the footer contact background color.','TR'),
			'id' => 'footer_contact_bg_color',
			'std' => '202222',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_footer_contact_bg_image',
			'std' => ASSETS_URI.'/images/footer-contact-bg.png',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'footer_contact_bg_repeat',
			'std' => 'repeat-x',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'footer_contact_bg_horizontal',
			'std' => 'left',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'footer_contact_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),

	//Copyright
	array('slug' => 'copyright', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Text Color','TR'),
			'desc' => __('It is the copyright text color.','TR'),
			'id' => 'footer_copyright_text_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Link Color','TR'),
			'desc' => __('It is the copyright link color.','TR'),
			'id' => 'footer_copyright_link_color',
			'std' => 'CCCCCC',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Hover Color','TR'),
			'desc' => __('It is the copyright link hover color.','TR'),
			'id' => 'footer_copyright_hover_color',
			'std' => 'DA5A04',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Icon Background Color','TR'),
			'desc' => __('It is the icon background color.','TR'),
			'id' => 'footer_copyright_icon_bg_color',
			'std' => '292B2B',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Color','TR'),
			'desc' => __('It is the copyright background color.','TR'),
			'id' => 'footer_copyright_bg_color',
			'std' => '181A1A',
			'size' => '6',
			'type' => 'color'
	),
	array(
			'name' => __('Background Image', 'TR'),
			'desc' => __('To upload an image click on "Upload image" button.', 'TR'),
			'id' => 'TR_footer_copyright_bg_image',
			'std' => ASSETS_URI.'/images/footer-message.png',
			'title' => 'Enter a URL or upload an image for your image:',
			'size' => '60',
			'button' => __('Upload Image', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Background Image Repeat', 'TR'),
			'desc' => __('Select the background image repeat mode.', 'TR'),
			'id' => 'footer_copyright_bg_repeat',
			'std' => 'repeat-x',
			'options' => $repeat_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Horizontal', 'TR'),
			'desc' => __('Select the background image horizontal mode.', 'TR'),
			'id' => 'footer_copyright_bg_horizontal',
			'std' => 'left',
			'options' => $horizontal_options,
			'type' => 'select'
	),
	array(
			'name' => __('Background Image Vertical', 'TR'),
			'desc' => __('Select the background image vertical mode.', 'TR'),
			'id' => 'footer_copyright_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'class' => 'no',
			'type' => 'select'
	),
	array('type' => 'tab_content_foot'),


	array('type' => 'tabs_foot')

);

return array('auto' => true, 'name' => 'colors', 'options' => $options );

?>