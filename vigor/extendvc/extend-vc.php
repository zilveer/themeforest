<?php
global $edgtIconCollections;


/*** Removing shortcodes ***/

vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_message");
vc_remove_element("vc_tour");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_gmaps");
vc_remove_element("vc_btn");
vc_remove_element("vc_cta");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_tabs");


/***Remove Grid Elements if disabled ***/

if (!edgt_vc_grid_elements_enabled() && version_compare(edgt_get_vc_version(), '4.4.2') >= 0) {
	vc_remove_element('vc_basic_grid');
	vc_remove_element('vc_media_grid');
	vc_remove_element('vc_masonry_grid');
	vc_remove_element('vc_masonry_media_grid');
	vc_remove_element('vc_icon');
	vc_remove_element('vc_button2');
	vc_remove_element("vc_custom_heading");
}


/*** Remove unused parameters ***/

if (function_exists('vc_remove_param')) {
	vc_remove_param('vc_single_image', 'css_animation');
	vc_remove_param('vc_single_image', 'title');
	vc_remove_param('vc_gallery', 'title');
	vc_remove_param('vc_column_text', 'css_animation');
	vc_remove_param('vc_row', 'video_bg');
	vc_remove_param('vc_row', 'video_bg_url');
	vc_remove_param('vc_row', 'video_bg_parallax');
	vc_remove_param('vc_row', 'full_height');
	vc_remove_param('vc_row', 'content_placement');
	vc_remove_param('vc_row', 'full_width');
	vc_remove_param('vc_row', 'bg_image');
	vc_remove_param('vc_row', 'bg_color');
	vc_remove_param('vc_row', 'font_color');
	vc_remove_param('vc_row', 'margin_bottom');
	vc_remove_param('vc_row', 'bg_image_repeat');
	vc_remove_param( "vc_row", "css" );
	vc_remove_param( "vc_row_inner", "css" );
	vc_remove_param('vc_tabs', 'interval');
	vc_remove_param('vc_tabs', 'title');
	vc_remove_param('vc_separator', 'style');
	vc_remove_param('vc_separator', 'color');
	vc_remove_param('vc_separator', 'accent_color');
	vc_remove_param('vc_separator', 'el_width');
	vc_remove_param('vc_text_separator', 'style');
	vc_remove_param('vc_text_separator', 'color');
	vc_remove_param('vc_text_separator', 'accent_color');
	vc_remove_param('vc_text_separator', 'el_width');
	vc_remove_param('vc_text_separator', 'title_align');
	vc_remove_param('vc_accordion', 'title');
	vc_remove_param('vc_row', 'gap');
    vc_remove_param('vc_row', 'columns_placement');
    vc_remove_param('vc_row', 'equal_height');
    vc_remove_param('vc_row_inner', 'gap');
    vc_remove_param('vc_row_inner', 'columns_placement');
    vc_remove_param('vc_row_inner', 'equal_height');
    vc_remove_param('vc_row_inner', 'content_placement');

    //remove vc parallax functionality
    vc_remove_param('vc_row', 'parallax');
    vc_remove_param('vc_row', 'parallax_image');
	vc_remove_param('vc_row', 'parallax_speed_video');
	vc_remove_param('vc_row', 'parallax_speed_bg');

	if(version_compare(edgt_get_vc_version(), '4.4.2') >= 0) {
		vc_remove_param('vc_accordion', 'disable_keyboard');
		vc_remove_param('vc_separator', 'align');
		vc_remove_param('vc_separator', 'border_width');
		vc_remove_param('vc_text_separator', 'align');
		vc_remove_param('vc_text_separator', 'border_width');
	}

	if(version_compare(edgt_get_vc_version(), '4.7.4') >= 0) {
		add_action( 'init', 'edgt_remove_vc_image_zoom',11);
		function edgt_remove_vc_image_zoom() {
			//Remove zoom from click action on single image
			$param = WPBMap::getParam( 'vc_single_image', 'onclick' );
			unset($param['value']['Zoom']);
			vc_update_shortcode_param( 'vc_single_image', $param );
		}
		vc_remove_param('vc_text_separator', 'css');
		vc_remove_param('vc_separator', 'css');
	}

}


/*** Remove unused parameters from grid elements ***/

if (function_exists('vc_remove_param') && edgt_vc_grid_elements_enabled() && version_compare(edgt_get_vc_version(), '4.4.2') >= 0) {
	vc_remove_param('vc_basic_grid', 'button_style');
	vc_remove_param('vc_basic_grid', 'button_color');
	vc_remove_param('vc_basic_grid', 'button_size');
	vc_remove_param('vc_basic_grid', 'filter_color');
	vc_remove_param('vc_basic_grid', 'filter_style');
	vc_remove_param('vc_media_grid', 'button_style');
	vc_remove_param('vc_media_grid', 'button_color');
	vc_remove_param('vc_media_grid', 'button_size');
	vc_remove_param('vc_media_grid', 'filter_color');
	vc_remove_param('vc_media_grid', 'filter_style');
	vc_remove_param('vc_masonry_grid', 'button_style');
	vc_remove_param('vc_masonry_grid', 'button_color');
	vc_remove_param('vc_masonry_grid', 'button_size');
	vc_remove_param('vc_masonry_grid', 'filter_color');
	vc_remove_param('vc_masonry_grid', 'filter_style');
	vc_remove_param('vc_masonry_media_grid', 'button_style');
	vc_remove_param('vc_masonry_media_grid', 'button_color');
	vc_remove_param('vc_masonry_media_grid', 'button_size');
	vc_remove_param('vc_masonry_media_grid', 'filter_color');
	vc_remove_param('vc_masonry_media_grid', 'filter_style');
	vc_remove_param('vc_basic_grid', 'paging_color');
	vc_remove_param('vc_basic_grid', 'arrows_color');
	vc_remove_param('vc_media_grid', 'paging_color');
	vc_remove_param('vc_media_grid', 'arrows_color');
	vc_remove_param('vc_masonry_grid', 'paging_color');
	vc_remove_param('vc_masonry_grid', 'arrows_color');
	vc_remove_param('vc_masonry_media_grid', 'paging_color');
	vc_remove_param('vc_masonry_media_grid', 'arrows_color');
}


/*** Remove frontend editor ***/

if(function_exists('vc_disable_frontend')){
	vc_disable_frontend();
}

/*** Restore Tabs&Accordion from Deprecated category ***/

$vc_map_deprecated_settings = array (
	'deprecated' => false,
	'category' => __( 'Content', 'js_composer' )
);
vc_map_update( 'vc_accordion', $vc_map_deprecated_settings );
vc_map_update( 'vc_tabs', $vc_map_deprecated_settings );
vc_map_update( 'vc_tab', array('deprecated' => false) );
vc_map_update( 'vc_accordion_tab', array('deprecated' => false) );

$carousel_sliders = edgtGetCarouselSliderArray();

$animations = array(
	"No animations" => "",
	"Elements Shows From Left Side" => "element_from_left",
	"Elements Shows From Right Side" => "element_from_right",
	"Elements Shows From Top Side" => "element_from_top",
	"Elements Shows From Bottom Side" => "element_from_bottom",
	"Elements Shows From Fade" => "element_from_fade"
);
$font_weight_array = array(
	"Default" => "",
	"Thin 100" => "100",
	"Extra-Light 200" => "200",
	"Light 300" => "300",
	"Regular 400" => "400",
	"Medium 500" => "500",
	"Semi-Bold 600" => "600",
	"Bold 700" => "700",
	"Extra-Bold 800" => "800",
	"Ultra-Bold 900" => "900"
);
$social_icons_array = array(
	"" => "",
	"ADN" => "fa-adn",
	"Android" => "fa-android",
	"Apple" => "fa-apple",
	"Bitbucket" => "fa-bitbucket",
	"Bitbucket-Sign" => "fa-bitbucket-sign",
	"Bitcoin" => "fa-bitcoin",
	"BTC" => "fa-btc",
	"CSS3" => "fa-css3",
	"Dribbble" => "fa-dribbble",
	"Dropbox" => "fa-dropbox",
	"Facebook" => "fa-facebook",
	"Facebook-Sign" => "fa-facebook-sign",
	"Flickr" => "fa-flickr",
	"Foursquare" => "fa-foursquare",
	"GitHub" => "fa-github",
	"GitHub-Alt" => "fa-github-alt",
	"GitHub-Sign" => "fa-github-sign",
	"Gittip" => "fa-gittip",
	"Google Plus" => "fa-google-plus",
	"Google Plus-Sign" => "fa-google-plus-sign",
	"HTML5" => "fa-html5",
	"Instagram" => "fa-instagram",
	"LinkedIn" => "fa-linkedin",
	"LinkedIn-Sign" => "fa-linkedin-sign",
	"Linux" => "fa-linux",
	"MaxCDN" => "fa-maxcdn",
	"Paypal" => "fa-paypal",
	"Pinterest" => "fa-pinterest",
	"Pinterest-Sign" => "fa-pinterest-sign",
	"Renren" => "fa-renren",
	"Skype" => "fa-skype",
	"StackExchange" => "fa-stackexchange",
	"Trello" => "fa-trello",
	"Tumblr" => "fa-tumblr",
	"Tumblr-Sign" => "fa-tumblr-sign",
	"Twitter" => "fa-twitter",
	"Twitter-Sign" => "fa-twitter-sign",
	"VK" => "fa-vk",
	"Weibo" => "fa-weibo",
	"Windows" => "fa-windows",
	"Xing" => "fa-xing",
	"Xing-Sign" => "fa-xing-sign",
	"YouTube" => "fa-youtube",
	"YouTube Play" => "fa-youtube-play",
	"YouTube-Sign" => "fa-youtube-sign"
);

/*** Accordion ***/

vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Style",
	"param_name" => "style",
	"value" => array(
		"Accordion"             => "accordion",
		"Toggle"                => "toggle",
        "Boxed Accordion"       => "boxed_accordion",
        "Boxed Toggle"          => "boxed_toggle"
	),
	'save_always' => true,
	"description" => ""
));

vc_add_param("vc_accordion", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Accordion Mark Border Radius",
	"param_name" => "accordion_border_radius",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "style", 'value' => array('accordion', 'toggle'))
));

vc_add_param("vc_accordion_tab", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Title Color",
	"param_name" => "title_color",
	"value" => "",
	"description" => ""
));

vc_add_param("vc_accordion_tab", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Background Color",
	"param_name" => "background_color",
	"value" => "",
	"description" => ""
));

vc_add_param("vc_accordion_tab", array(
	"type" => "dropdown",
    "class" => "",
    "heading" => "Title Tag",
    "param_name" => "title_tag",
    "value" => array(
        ""   => "",
        "h2" => "h2",
        "h3" => "h3",
        "h4" => "h4",	
        "h5" => "h5",
        "h6" => "h6",
    ),
    "description" => ""
));


/*** Tabs ***/

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Style",
	"param_name" => "style",
	"value" => array(
		"Horizontal Center" => "horizontal",
		"Horizontal Center With Icons" => "horizontal_with_icons",
		"Horizontal Left" => "horizontal_left",
		"Horizontal Left With Icons" => "horizontal_left_with_icons",
		"Horizontal Right" => "horizontal_right",
		"Horizontal Right With Icons" => "horizontal_right_with_icons",
		"Vertical Left" => "vertical_left",
		"Vertical Left With Icons" => "vertical_left_with_icons",
		"Vertical Right" => "vertical_right",
        "Vertical Right With Icons" => "vertical_right_with_icons"
	),
	'save_always' => true,
	"description" => ""
));

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Tab Type",
	"param_name" => "tab_type_default",
	"value" => array(
		"Default" => "default",
		"With Borders" => "with_borders"
	),
	'save_always' => true,
	"dependency" => Array('element' => "style", 'value' => array('horizontal','horizontal_left','horizontal_right', 'vertical_left', 'vertical_right'))
));

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Tab Type",
	"param_name" => "tab_type_icons",
	"value" => array(
		"Default" => "default",
		"With Borders" => "with_borders",
		"With Lines" => "with_lines"
	),
	'save_always' => true,
	"dependency" => Array('element' => "style", 'value' => array('horizontal_with_icons','horizontal_left_with_icons','horizontal_right_with_icons', 'vertical_left_with_icons', 'vertical_right_with_icons'))
));

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Border Type",
	"param_name" => "border_type_default",
	"value" => array(
		"Border Arround Tabs" => "border_arround_element",
		"Border Arround Active Tab" => "border_arround_active_tab"
	),
	'save_always' => true,
	"dependency" => Array('element' => "tab_type_default", 'value' => array('with_borders'))
));

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Border Type",
	"param_name" => "border_type_icons",
	"value" => array(
		"Border Arround Tabs" => "border_arround_element",
		"Border Arround Active Tab" => "border_arround_active_tab"
	),
	'save_always' => true,
	"dependency" => Array('element' => "tab_type_icons", 'value' => array('with_borders'))
));

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Margin Between Tabs",
	"param_name" => "margin_between_tabs",
	"value" => array(
		"Yes" => "enable_margin",
		"No" => "disable_margin"
	),
	'save_always' => true,
	"description" => "",
	"dependency" => Array('element' => "border_type_default", 'value' => array('border_arround_element'))
));

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Margin Between Tabs",
	"param_name" => "icons_margin_between_tabs",
	"value" => array(
		"Yes" => "enable_margin",
		"No" => "disable_margin"
	),
	'save_always' => true,
	"description" => "",
	"dependency" => Array('element' => "border_type_icons", 'value' => array('border_arround_element'))
));

vc_add_param("vc_tabs", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Space Between Tab and Content (px)",
    "param_name" => "space_between_tab_and_content",
    "value" => "",
    "description" => "Insert value for space between Tab and Content (default value is 18px)",
    "dependency" => Array('element' => "style", 'value' => array('horizontal_with_icons','horizontal_left_with_icons','horizontal_right_with_icons','horizontal','horizontal_left','horizontal_right', 'boxed'))
));

vc_add_param("vc_tab", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Icon Pack",
    "param_name" => $edgtIconCollections->iconPackParamName,
    "value" => $edgtIconCollections->getIconCollectionsVC(),
	'save_always' => true,
));

foreach ($edgtIconCollections->iconCollections as $collection_key => $collection ) {
    vc_add_param("vc_tab", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Icon",
        "param_name" => $collection->param,
        "value" => $collection->getIconsArray(),
		'save_always' => true,
        "dependency" => Array('element' => $edgtIconCollections->iconPackParamName, 'value' => array($collection_key))
    ));
}


/*** Flickr Widget ***/

vc_add_param("vc_flickr", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Columns",
    "param_name" => "columns",
    "value" => array(
        "Two" => "two",
        "Three" => "three",
        "Four" => "four"
    ),
	'save_always' => true,
    "description" => ""
));


/*** Empty Space ***/

vc_add_param("vc_empty_space",  array(
        "type" => "attach_image",
        "holder" => "div",
        'heading' => 'Background Image',
        'param_name' => 'background_image',
        'value' => '',
        'description' =>( 'Select image from media library.'),
    )
);
vc_add_param("vc_empty_space",  array(
        "type" => "dropdown",
        'heading' => 'Image Repeat',
        'param_name' => 'image_repeat',
        "value" => array(
            'No Repeat' => 'no-repeat',
            'Repeat x' => 'repeat-x',
            'Repeat y' => 'repeat-y',
            'Repeat (x y)' => 'repeat'
        ),
		'save_always' => true,
        'description' =>( '')
    )
);


/*** Gallery ***/

vc_add_param("vc_gallery", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Column Number",
	"param_name" => "column_number",
	 "value" => array(2, 3, 4, 5, "Disable" => 0),
	'save_always' => true,
	 "dependency" => Array('element' => "type", 'value' => array('image_grid'))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Grayscale Images",
    "param_name" => "grayscale",
    "value" => array('No' => 'no', 'Yes' => 'yes'),
	'save_always' => true,
    "dependency" => Array('element' => "type", 'value' => array('image_grid'))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Frame",
    "param_name" => "frame",
	"value" => array("Use frame?" => "use_frame"),
	"value" => array(
		'' => '',
		'Yes' => 'use_frame',
		'No' => 'no'
	),
    "description" => "",
    "dependency" => Array('element' => "type", 'value' => array('flexslider_slide'))
));

vc_add_param("vc_gallery", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Choose Frame",
	"param_name" => "choose_frame",
	"value" => array(
		'Default' => 'default',
		'Frame 1' => 'frame1',
		'Frame 2' => 'frame2',
		'Frame 3' => 'frame3',
		'Frame 4' => 'frame4'
	),
	'save_always' => true,
	"dependency" => Array('element' => "frame", 'value' => array('use_frame'))
));

vc_add_param("vc_gallery", array(
    "type" => "checkbox",
    "class" => "",
    "heading" => "Show image title?",
    "param_name" => "show_image_title",
    "value" => array("Show image title in the bottom of image" => "show_image_title"),
    "description" => "",
    "dependency" => Array('element' => "type", 'value' => array('flexslider_slide', 'flexslider_fade'))
));

vc_add_param("vc_gallery", array(
    "type" => "checkbox",
    "class" => "",
    "heading" => "Disable navigation arrows?",
    "param_name" => "disable_navigation_arrows",
    "value" => array("Disable navigation arrows" => "yes"),
    "description" => "",
    "dependency" => Array('element' => "type", 'value' => array('flexslider_slide', 'flexslider_fade'))
));

vc_add_param("vc_gallery", array(
    "type" => "checkbox",
    "class" => "",
    "heading" => "Show navigation controls?",
    "param_name" => "show_navigation_controls",
    "value" => array("Show navigation controls" => "yes"),
    "description" => "",
    "dependency" => Array('element' => "type", 'value' => array('flexslider_slide', 'flexslider_fade'))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => "Title Alignment",
    "param_name" => "title_alignment",
    "value" => array(
        "Left"    => "left",
        "Center"  => "center",
        "Right"   => "right"
    ),
	'save_always' => true,
    "description" => "",
    "dependency" => Array('element' => "show_image_title", 'value' => array('show_image_title'))
));

vc_add_param("vc_gallery", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Title Font Family",
    "param_name" => "title_font_family",
    "value" => "",
    "description" => "",
    "dependency" => Array('element' => "show_image_title", 'value' => array('show_image_title'))
));

vc_add_param("vc_gallery", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Title Font Size (px)",
    "param_name" => "title_font_size",
    "value" => "",
    "description" => "",
    "dependency" => Array('element' => "show_image_title", 'value' => array('show_image_title'))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => "Title Font Weight",
    "param_name" => "title_font_weight",
    "value" => array(
        "Default" 			=> "",
        "Thin 100"			=> "100",
        "Extra-Light 200" 	=> "200",
        "Light 300"			=> "300",
        "Regular 400"		=> "400",
        "Medium 500"		=> "500",
        "Semi-Bold 600"		=> "600",
        "Bold 700"			=> "700",
        "Extra-Bold 800"	=> "800",
        "Ultra-Bold 900"	=> "900"
    ),
    "description" => "",
    "dependency" => Array('element' => "show_image_title", 'value' => array('show_image_title'))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => "Title Font Style",
    "param_name" => "title_font_style",
    "value" => array(
        "" 		   => "",
        "Normal"   => "normal",
        "Italic"   => "italic"
    ),
    "description" => "",
    "dependency" => Array('element' => "show_image_title", 'value' => array('show_image_title'))
));

vc_add_param("vc_gallery", array(
    "type" => "colorpicker",
    "holder" => "div",
    "class" => "",
    "heading" => "Title Layer Color",
    "param_name" => "title_layer_color",
    "value" => "",
    "description" => "",
    "dependency" => Array('element' => "show_image_title", 'value' => array('show_image_title'))
));

vc_add_param("vc_gallery", array(
    "type" => "colorpicker",
    "holder" => "div",
    "class" => "",
    "heading" => "Background hover color",
    "param_name" => "background_hover_color",
    "value" => "",
    "description" => "",
    "dependency" => Array('element' => "grayscale", 'value' => array("no"))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Choose hover icon",
    "param_name" => "hover_icon",
    "value" => array('None' => 'none', 'Magnifier' => 'magnifier', 'Plus' => 'plus'),
	'save_always' => true,
    "dependency" => Array('element' => "grayscale", 'value' => array("no"))
));

vc_add_param("vc_gallery", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Spaces between images",
    "param_name" => "images_space",
    "value" => array('No' => 'gallery_without_space', 'Yes' => 'gallery_with_space'),
	'save_always' => true,
    "dependency" => Array('element' => "type", 'value' => array('image_grid'))
));


/*** Row ***/

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => "Row Type",
	"param_name" => "row_type",
	"value" => array(
		"Row" => "row",
		"Parallax" => "parallax",
		"Expandable" => "expandable",
		"Content menu" => "content_menu"
	),
	'save_always' => true,
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => "Use Row as Full Screen Section",
	"param_name" => "use_row_as_full_screen_section",
	"value" => array(
		"No" => "no",
		"Yes" => "yes"
	),
	'save_always' => true,
	"description" => "This option works only for Full Screen Sections Template",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Type",
	"param_name" => "type",
	"value" => array(
		"Full Width" => "full_width",
		"In Grid" => "grid"		
	),
	'save_always' => true,
	"dependency" => Array('element' => "row_type", 'value' => array('row','parallax','content_menu'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Header Style",
    "param_name" => "header_style",
    "value" => array(
        "" => "",
        "Light" => "light",
        "Dark" => "dark"
    ),
    "dependency" => Array('element' => "row_type", 'value' => array('row','parallax','expandable'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Anchor ID (Example home)",
	"param_name" => "anchor",
	"value" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row','parallax','expandable'))
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Row in content menu",
	"value" => array("Use row for content menu?" => "in_content_menu"),
	"param_name" => "in_content_menu",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row','parallax','expandable', 'expandable_with_background'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Content menu title",
	"value" => "",
	"param_name" => "content_menu_title",
	"description" => "",
	"dependency" => Array('element' => "in_content_menu", 'value' => array('in_content_menu'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Content menu icon pack",
	"param_name" => $edgtIconCollections->iconPackParamName,
	"value" => $edgtIconCollections->getIconCollectionsVC(),
	'save_always' => true,
	"description" => "",
	"dependency" => Array('element' => "in_content_menu", 'value' => array('in_content_menu'))
));

foreach($edgtIconCollections->iconCollections as $collection_key => $collection) {
    vc_add_param("vc_row", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Content menu icon",
        "param_name" => "content_menu_".$collection->param,
        "value" => $collection->getIconsArray(),
		'save_always' => true,
        "description" => "",
        "dependency" => Array('element' => $edgtIconCollections->iconPackParamName, 'value' => array($collection_key))
    ));
}

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Angled Shape in Background",
    "param_name" => "oblique_section",
    "value" => array(
        'No' => 'no',
        'Yes' => 'yes'
    ),
	'save_always' => true,
    "description" => "",
    "dependency" => Array('element' => "row_type", 'value' => array('row'))
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Angled Shape Top and Bottom",
    "param_name" => "oblique_section_top_and_bottom",
    "value" => array(
        'Default (both)' => 'both',
        'Only Top' => 'top',
        'Only Bottom' => 'bottom'
    ),
	'save_always' => true,
    "description" => "",
    "dependency" => Array('element' => "oblique_section", 'value' => array('yes'))
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Angled Shape Position",
    "param_name" => "oblique_section_position",
    "value" => array(
        'From Left To Right' => 'from_left_to_right',
        'From Right To Left' => 'from_right_to_left'
    ),
	'save_always' => true,
    "description" => "",
    "dependency" => Array('element' => "oblique_section", 'value' => array('yes'))
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Text Align",
	"param_name" => "text_align",
	"value" => array(
		"Left" => "left",
		"Center" => "center",
		"Right" => "right"
	),
	'save_always' => true,
	"dependency" => Array('element' => "row_type", 'value' => array('row','parallax','expandable'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Triangle Shape in Background",
    "param_name" => "triangle_shape",
    "value" => array(
        'No' => 'no',
        'Yes' => 'yes'
    ),
	'save_always' => true,
    "description" => "Enabling this option will display a triangular shape on the row",
    "dependency" => Array('element' => "row_type", 'value' => array('row', 'parallax'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Triangle Shape Position",
    "param_name" => "triangle_shape_position",
    "value" => array(
        'Default (both)' => 'both',
        'Only Top' => 'top',
        'Only Bottom' => 'bottom'
    ),
	'save_always' => true,
    "description" => "",
    "dependency" => Array('element' => "triangle_shape", 'value' => array('yes'))
));

vc_add_param("vc_row", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => "Triangle Shape Color",
    "param_name" => "triangle_shape_color",
    "value" => array(
        'Default (both)' => 'both',
        'Only Top' => 'top',
        'Only Bottom' => 'bottom'
    ),
    "description" => "",
    "dependency" => Array('element' => "triangle_shape", 'value' => array('yes'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Video background",
	"value" => array(
		"No" => "",
		"Yes" => "show_video"
	),
	"param_name" => "video",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Video overlay",
	"value" => array(
		"No" => "",
		"Yes" => "show_video_overlay"
	),
	"param_name" => "video_overlay",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));

vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => "Video overlay image (pattern)",
	"value" => "",
	"param_name" => "video_overlay_image",
	"description" => "",
	"dependency" => Array('element' => "video_overlay", 'value' => array('show_video_overlay'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video background (webm) file url",
	"value" => "",
	"param_name" => "video_webm",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video background (mp4) file url",
	"value" => "",
	"param_name" => "video_mp4",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video background (ogv) file url",
	"value" => "",
	"param_name" => "video_ogv",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));

vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => "Video preview image",
	"value" => "",
	"param_name" => "video_image",
	"description" => "",
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));

vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => "Background image",
	"value" => "",
	"param_name" => "background_image",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('parallax', 'row','expandable'))
));

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Pattern background",
	"value" => array("Use background image as pattern?" => "pattern_background"),
	"param_name" => "pattern_background",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Full Screen Height",
    "param_name" => "full_screen_section_height",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
	'save_always' => true,
    "dependency" => Array('element' => "row_type", 'value' => array('parallax'))
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Vertically Align Content In Middle",
    "param_name" => "vertically_align_content_in_middle",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
	'save_always' => true,
    "dependency" => array('element' => 'full_screen_section_height', 'value' => 'yes')
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Section height",
	"param_name" => "section_height",
	"value" => "",
	"dependency" => Array('element' => "full_screen_section_height", 'value' => array('no'))
));

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Use as box",
	"value" => array("Use row as box" => "use_row_as_box" ),
	"param_name" => "use_as_box",
	"description" => '',
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Parallax speed",
    "param_name" => "parallax_speed",
    "value" => "",
    "dependency" => Array('element' => "row_type", 'value' => array('parallax'))
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Background color",
	"param_name" => "background_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row','expandable','content_menu'))
));

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Show logo",
	"value" => array("Show logo in content menu" => "logo_in_content_menu"),
	"param_name" => "logo_in_content_menu",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('content_menu'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Custom widget area",
	"param_name" => "custom_widget_area",
	"value" => array_merge(array('' => ''), edgt_get_custom_sidebars()),
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('content_menu'))
));

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Show Border Bottom",
	"value" => array("Show border bottom on content menu?" => "yes"),
	"param_name" => "content_menu_border_bottom",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('content_menu'))
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Content Menu Border Color",
	"param_name" => "content_menu_border_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "content_menu_border_bottom", 'value' => array('yes'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Content Menu Border Style",
	"param_name" => "content_menu_border_style",
	"value" => array(
		"Solid" => "solid",
		"Dashed" => "dashed",
		"Dotted" => "dotted"
		),
	'save_always' => true,
	"description" => "",
	"dependency" => Array('element' => "content_menu_border_bottom", 'value' => array('yes'))
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Border Top Color",
	"param_name" => "border_top_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Border Bottom Color",
	"param_name" => "border_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding",
	"value" => "",
	"param_name" => "side_padding",
	"description" => "Padding (left/right in pixels or percentage. Put number and px or %. Ex. 30% or 30px)",
	"dependency" => Array('element' => "type", 'value' => array('full_width'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
    "heading" => "Padding Top (px)",
	"value" => "",
	"param_name" => "padding_top",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
    "heading" => "Padding Bottom (px)",
	"value" => "",
	"param_name" => "padding_bottom",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Label Color",
	"param_name" => "color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Label Hover Color",
	"param_name" => "hover_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "More Label",
	"param_name" => "more_button_label",
	"value" =>  "",
	"description" => "Default label is Expand Section",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Less Label",
	"param_name" => "less_button_label",
	"value" =>  "",
	"description" => "Default label is Contract Section",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Label Position",
	"param_name" => "button_position",
	"value" => array(
		"" => "",
		"Left" => "left",
		"Right" => "right",
		"Center" => "center"
	),
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row",  array(
  "type" => "dropdown",
  "heading" => "CSS Animation",
  "param_name" => "css_animation",
  "admin_label" => true,
  "value" => $animations,
	'save_always' => true,
  "description" => "",
  "dependency" => Array('element' => "row_type", 'value' => array('row'))
  
));

vc_add_param("vc_row",  array(
	"type" => "textfield",
	"heading" => "Transition delay (ms)",
	"param_name" => "transition_delay",
	"admin_label" => true,
	"value" => "",
	"description" => "",
	"dependency" => array("element" => "css_animation", "not_empty" => true)
  
));

vc_add_param("vc_row",  array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Box Shadow on Row",
    "param_name" => "box_shadow_on_row",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
	'save_always' => true,
    "dependency" => array("element" => "row_type", "value" => array("row")) 
));

vc_add_param("vc_row",  array(
    "type" => "colorpicker",
    "heading" => "Box Shadow Color",
    "param_name" => "box_shadow_color",
    "value" => "",
    "description" => "",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")
  
));

vc_add_param("vc_row",  array(
    "type" => "textfield",
    "heading" => "Horizontal Offset (px)",
    "param_name" => "horizontal_offset",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")
));

vc_add_param("vc_row",  array(
    "type" => "textfield",
    "heading" => "Vertical Offset (px)",
    "param_name" => "vertical_offset",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")
));

vc_add_param("vc_row",  array(
    "type" => "textfield",
    "heading" => "Box Shadow Blur (px)",
    "param_name" => "box_shadow_blur",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes") 
));

vc_add_param("vc_row",  array(
    "type" => "textfield",
    "heading" => "Box Shadow Spread (px)",
    "param_name" => "box_shadow_spread",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")  
));


/*** Row Inner ***/

vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => "Row Type",
	"param_name" => "row_type",
	"value" => array(
		"Row" => "row",
		"Parallax" => "parallax",
		"Expandable" => "expandable"
	),
	'save_always' => true,
));

vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Type",
	"param_name" => "type",
	"value" => array(
		"Full Width" => "full_width",
		"In Grid" => "grid"
	),
	'save_always' => true,
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Use Row as Full Screen Section Slide",
    "param_name" => "use_row_as_full_screen_section_slide",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
	'save_always' => true,
    "description" => "This option works only for Full Screen Sections Template",
    "dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row_inner", array(
    "type" => "checkbox",
    "class" => "",
    "heading" => "Use as box",
    "value" => array("Use row as box" => "use_row_as_box" ),
    "param_name" => "use_as_box",
    "description" => '',
    "dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Border Radius(px)",
	"param_name" => "row_box_border_radius",
	"value" => "",
	"dependency" => Array('element' => "use_as_box", 'value' => array('use_row_as_box'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Anchor ID",
	"param_name" => "anchor",
	"value" => ""
));

vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Text Align",
	"param_name" => "text_align",
	"value" => array(
		"Left" => "left",
		"Center" => "center",
		"Right" => "right"
	),
	'save_always' => true,
	
));

vc_add_param("vc_row_inner", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Background color",
	"param_name" => "background_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row','expandable'))
));

vc_add_param("vc_row_inner", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => "Background image",
	"value" => "",
	"param_name" => "background_image",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('parallax', 'row'))
));

vc_add_param("vc_row_inner", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Border color",
	"param_name" => "border_color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row','expandable'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding",
	"value" => "",
	"param_name" => "side_padding",
	"description" => "Left and right spacing in pixels",
	"dependency" => Array('element' => "type", 'value' => array('full_width'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding Top",
	"value" => "",
	"param_name" => "padding_top",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding Bottom",
	"value" => "",
	"param_name" => "padding_bottom",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "More Button Label",
	"param_name" => "more_button_label",
	"value" =>  "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Less Button Label",
	"param_name" => "less_button_label",
	"value" =>  "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Button Position",
	"param_name" => "button_position",
	"value" => array(
		"" => "",
		"Left" => "left",
		"Right" => "right",
		"Center" => "center"	
	),
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row_inner", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Color",
	"param_name" => "color",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));

vc_add_param("vc_row_inner",  array(
	"type" => "dropdown",
	"heading" => "CSS Animation",
	"param_name" => "css_animation",
	"admin_label" => true,
	"value" => $animations,
	'save_always' => true,
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
  
));

vc_add_param("vc_row_inner",  array(
  "type" => "textfield",
  "heading" => "Transition delay (ms)",
  "param_name" => "transition_delay",
  "admin_label" => true,
  "value" => "",
  "description" => "",
  "dependency" => Array('element' => "row_type", 'value' => array('row'))
  
));

vc_add_param("vc_row_inner",  array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Box Shadow on Row",
    "param_name" => "box_shadow_on_row",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
	'save_always' => true,
    "dependency" => array("element" => "row_type", "value" => array("row")) 
));

vc_add_param("vc_row_inner",  array(
    "type" => "colorpicker",
    "heading" => "Box Shadow Color",
    "param_name" => "box_shadow_color",
    "value" => "",
    "description" => "",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")
  
));

vc_add_param("vc_row_inner",  array(
    "type" => "textfield",
    "heading" => "Horizontal Offset (px)",
    "param_name" => "horizontal_offset",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")
));

vc_add_param("vc_row_inner",  array(
    "type" => "textfield",
    "heading" => "Vertical Offset (px)",
    "param_name" => "vertical_offset",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")
));

vc_add_param("vc_row_inner",  array(
    "type" => "textfield",
    "heading" => "Box Shadow Blur (px)",
    "param_name" => "box_shadow_blur",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes") 
));

vc_add_param("vc_row_inner",  array(
    "type" => "textfield",
    "heading" => "Box Shadow Spread (px)",
    "param_name" => "box_shadow_spread",
    "value" => "",
    "description" => "Default value is 1",
    "dependency" => array("element" => "box_shadow_on_row", "value" => "yes")  
));


/*** Separator ***/

$separator_setting = array (
  'show_settings_on_create' => true,
  "controls"	=> '',
);
vc_map_update('vc_separator', $separator_setting);

vc_add_param("vc_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Type",
	"param_name" => "type",
	"value" => array(
		"Normal"		=>	"normal",
		"Transparent"	=>	"transparent",
		"Small"			=>	"small",
	),
	'save_always' => true,
	"description" => ""
));

vc_add_param("vc_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Position",
	"param_name" => "position",
	"value" => array(
		"Center" => "center",
		"Left" => "left",
		"Right" => "right"
	),
	'save_always' => true,
    "dependency" => array("element" => "type", "value" => array("small")),
	"description" => ""
));

vc_add_param("vc_separator", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => "Color",
	"param_name" => "color",
	"value" => "",
	"description" => "",
    "dependency" => array("element" => "type", "value" => array("small", "normal"))
));

vc_add_param("vc_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Border Style",
	"param_name" => "border_style",
	"value" => array(
		"" => "",
		"Dashed" => "dashed",
		"Solid" => "solid",
        "Dotted" => "dotted"
    ),
	"description" => ""
));

vc_add_param("vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Width (px)",
    "param_name" => "width",
    "value" => "",
    "description" => "",
	"dependency" => array("element" => "type", "value" => array("small"))
));

vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Thickness (px)",
	"param_name" => "thickness",
	"value" => "",
	"description" => ""
));

vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Top Margin (px)",
	"param_name" => "up",
	"value" => "",
	"description" => ""
));

vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Bottom Margin  (px)",
	"param_name" => "down",
	"value" => "",
	"description" => ""
));


/*** Separator With Text ***/

vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => "Title Color",
    "param_name" => "title_color",
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Title Font size (px)",
    "param_name" => 'title_size',
    "value" => "",
    "description" => ""
));

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Text In Box",
    "param_name" => "text_in_box",
    "value" => array(
        "Yes" => "yes",
        "No" => "no"
    ),
	'save_always' => true,
));

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Text Position",
    "param_name" => "text_position",
    "value" => array(
        "Center" => "center",
        "Left" => "left",
        "Right" => "right"
    ),
	'save_always' => true,
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Height (px)",
    "param_name" => 'box_height',
    "value" => "",
    "description" => "Insert height for a shape around the text"
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Left/right Padding (px)",
    "param_name" => 'box_padding',
    "value" => "",
    "description" => "Insert size for a padding on left and right side of text",
));

vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => "Box Background Color",
    "param_name" => "box_background_color",
    "dependency" => Array('element' => "text_in_box", 'value' => array('yes'))
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Box Border Width (px)",
    "param_name" => "box_border_width",
    "value" => "",
    "description" => "Insert width for the separator line",
    "dependency" => Array('element' => "text_in_box", 'value' => array('yes'))
));

vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => "Box Border Color",
    "param_name" => "box_border_color",
    "dependency" => Array('element' => "text_in_box", 'value' => array('yes'))
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Box Border radius (px)",
    "param_name" => "box_border_radius",
    "description" => __("Insert border radius(Rounded corners) in px. For example: 4. Leave empty for default. ", 'edgt'),
    "dependency" => Array('element' => "text_in_box", 'value' => array('yes'))
));

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => "Box Border Style",
    "param_name" => "box_border_style",
    "value" => array(
        "Solid" => "solid",
        "Dashed" => "dashed",
        "Dotted" => "dotted",
        "Transparent" => "transparent"
    ),
	'save_always' => true,
    "description" => "Choose a style for the separator line",
    "dependency" => Array('element' => "text_in_box", 'value' => array('yes'))
));

vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "holder" => "div",
    "class" => "",
    "heading" => "Line Color",
    "param_name" => "line_color",
    "value" => "",
    "description" => "Choose a color for the separator line"
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Line Width (px)",
    "param_name" => "line_width",
    "value" => "",
    "description" => "Insert width for the separator line"
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Line Thickness (px)",
    "param_name" => "line_thickness",
    "value" => "",
    "description" => "Insert thickness for the separator line"
));

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => "Separator Line Style",
    "param_name" => "line_border_style",
    "value" => array(
        "Solid" => "solid",
        "Dashed" => "dashed",
        "Dotted" => "dotted",
        "Transparent" => "transparent"
    ),
	'save_always' => true,
    "description" => "Choose a style for the separator line"
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Top Margin (px)",
    "param_name" => "up",
    "value" => "",
    "description" => "Insert top margin for the separator"
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Bottom Margin (px)",
    "param_name" => "down",
    "value" => "",
    "description" => "Insert bottom margin for the separator"
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Box Margins (px)",
    "param_name" => "box_margin",
    "description" => "Insert left and right line margins"
));

vc_add_param("vc_text_separator", array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => "Dots on line end ",
    "param_name" => "line_dots",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
	'save_always' => true,
    "description" => "Insert icons on the end of the border"
));

vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "holder" => "div",
    "class" => "",
    "heading" => "Dots Color",
    "param_name" => "line_dots_color",
    "description" => "Insert dots color (default value is #b2b2b2)",
    "dependency" => Array('element' => "line_dots", 'value' => array('yes'))
));

vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "holder" => "div",
    "class" => "",
    "heading" => "Dots Size (px)",
    "param_name" => "line_dots_size",
    "description" => "Insert dots size",
    "dependency" => Array('element' => "line_dots", 'value' => array('yes'))
));


/*** Single Image ***/

vc_add_param("vc_single_image",  array(
	"type" => "dropdown",
	"heading" => "CSS Animation",
	"param_name" => "edgt_css_animation",
	"admin_label" => true,
	"value" => $animations,
	'save_always' => true,
	"description" => "" 
));

vc_add_param("vc_single_image",  array(
	"type" => "textfield",
	"heading" => "Transition delay (s)",
	"param_name" => "transition_delay",
	"admin_label" => true,
	"value" => "",
	"description" => "",
	"dependency" => array("element" => "edgt_css_animation", "not_empty" => true)
));

function edgt_add_open_prettyphoto() {
    //Get current values stored in the Link Target in "Single Image" element
    $param = WPBMap::getParam('vc_single_image', 'img_link_target');
    //Append new value to the 'value' array
    $param['value'][__('Open prettyPhoto', 'js_composer')] = 'open_prettyphoto';
    //Finally "mutate" param with new values
    WPBMap::mutateParam('vc_single_image', $param);
}
add_action('init', 'edgt_add_open_prettyphoto',11);

/*** Counter ***/

vc_map( array(
		"name" => "Counter",
		"base" => "no_counter",
		"category" => 'by EDGE',
		'admin_enqueue_css' => array(edgt_get_skin_uri().'/assets/css/edgtf-vc-extend.css'),
		"icon" => "icon-wpb-counter",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Type",
				"param_name" => "type",
				"value" => array(
					"Zero Counter" => "zero",
					"Random Counter" => "random"	
				),
				'save_always' => true,
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Box",
                "param_name" => "box",
                "value" => array(
					"" => "",
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Box Border Color",
                "param_name" => "box_border_color",
                "description" => "",
                "dependency" => array('element' => "box", 'value' => array('yes'))
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Position",
				"param_name" => "position",
				"value" => array(
					"Left" => "left",
					"Right" => "right",	
					"Center" => "center"
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Digit",
				"param_name" => "digit",
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Underline Digit",
                "param_name" => "underline_digit",
                "value" => array(
                    "" => "",
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Digit Font Size (px)",
				"param_name" => "font_size",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Digit Font Weight",
				"param_name" => "font_weight",
				"value" => array(
					"Default" 			=> "",
					"Thin 100"			=> "100",
					"Extra-Light 200" 	=> "200",
					"Light 300"			=> "300",
					"Regular 400"		=> "400",
					"Medium 500"		=> "500",
					"Semi-Bold 600"		=> "600",
					"Bold 700"			=> "700",
					"Extra-Bold 800"	=> "800",
					"Ultra-Bold 900"	=> "900"
				),
				"description" => ""
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Digit Letter Spacing (px)",
                "param_name" => "digit_letter_spacing",
                "description" => ""
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Digit Font Color",
				"param_name" => "font_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Tag",
				"param_name" => "title_tag",
				"value" => array(
					""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",
					"h5" => "h5",
					"h6" => "h6",
				),
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Size (px)",
				"param_name" => "title_size",
				"description" => ""
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Text",
                "param_name" => "text",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Text Size (px)",
                "param_name" => "text_size",
                "description" => ""
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Font Weight",
				"param_name" => "text_font_weight",
				"value" => array(
					"Default" => "",
					"Thin 100" => "100",
					"Extra-Light 200" => "200",
					"Light 300" => "300",
					"Regular 400" => "400",
					"Medium 500" => "500",
					"Semi-Bold 600" => "600",
					"Bold 700" => "700",
					"Extra-Bold 800" => "800",
					"Ultra-Bold 900" => "900"
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Transform",
				"param_name" => "text_transform",
				"value" => array(
					"Default" 			=> "",
					"None"				=> "none",
					"Capitalize" 		=> "capitalize",
					"Uppercase"			=> "uppercase",
					"Lowercase"			=> "lowercase"
				),
				"description" => ""
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Text Color",
                "param_name" => "text_color",
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator",
                "param_name" => "separator",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
				'save_always' => true,
                "description" => ""
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Separator Position",
				"param_name" => "separator_position",
				"value" => array(
					"Default" 			=> "",
					"Above Title"		=> "above_title",
					"Under Title"		=> "under_title",
				),
				"description" => "",
				"dependency" => array('element' => "separator", 'value' => array('yes'))
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Color",
                "param_name" => "separator_color",
                "description" => "",
                "dependency" => array('element' => "separator", 'value' => array('yes'))
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Separator Border Style",
				"param_name" => "separator_border_style",
				"value" => array(
					"" => "",
					"Dashed" => "dashed",
					"Solid" => "solid"
				),
				"description" => "",
				"dependency" => array('element' => "separator", 'value' => array('yes'))
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => "Padding Bottom(px)",
               "param_name" => "padding_bottom",
               "description" => ""
             ),
		)
) );


/*** Cover Boxes ***/

vc_map( array(
		"name" => "Cover Boxes",
		"base" => "no_cover_boxes",
		"icon" => "icon-wpb-cover-boxes",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Active element",
                "param_name" => "active_element",
                "value" => ""
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Title tag",
				"param_name" => "title_tag",
				"value" => array(
					""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",
					"h5" => "h5",
					"h6" => "h6",
				),
				"description" => "Choose with heading tag to display for titles"
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Image 1",
				"param_name" => "image1"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title 1",
				"param_name" => "title1",
				"value" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color 1",
				"param_name" => "title_color1",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text 1",
				"param_name" => "text1",
				"value" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Color 1",
				"param_name" => "text_color1",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link 1",
				"param_name" => "link1",
				"value" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link label 1",
				"param_name" => "link_label1",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Target 1",
				"param_name" => "target1",
				"value" => array(
					"Self" => "_self",
					"Blank" => "_blank"
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Image 2",
				"param_name" => "image2"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title 2",
				"param_name" => "title2",
				"value" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color 2",
				"param_name" => "title_color2",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text 2",
				"param_name" => "text2",
				"value" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Color 2",
				"param_name" => "text_color2",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link 2",
				"param_name" => "link2",
				"value" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link label 2",
				"param_name" => "link_label2",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Target 2",
				"param_name" => "target2",
				"value" => array(
					"Self" => "_self",
					"Blank" => "_blank"
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Image 3",
				"param_name" => "image3"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title 3",
				"param_name" => "title3",
				"value" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color 3",
				"param_name" => "title_color3",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text 3",
				"param_name" => "text3",
				"value" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Color 3",
				"param_name" => "text_color3",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link 3",
				"param_name" => "link3",
				"value" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link label 3",
				"param_name" => "link_label3",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Target 3",
				"param_name" => "target3",
				"value" => array(
					"Self" => "_self",
					"Blank" => "_blank"
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Read More Button Style",
				"param_name" => "read_more_button_style",
				"value" => array(
					"Default" => "",
					"No" => "no",
					"Yes" => "yes"
				),
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator",
                "param_name" => "separator",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
				'save_always' => true,
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Color",
                "param_name" => "separator_color",
                "description" => "",
                "dependency" => array('element' => "separator", 'value' => array('yes'))
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Border Style",
                "param_name" => "separator_border_style",
                "value" => array(
                    "" => "",
                    "Dashed" => "dashed",
                    "Solid" => "solid"
                ),
                "description" => "",
                "dependency" => array('element' => "separator", 'value' => array('yes'))
            )
		)
) );


/*** Google Map ***/

vc_map( array(
	"name" => "Google Map",
	"base" => "no_google_map",
	"icon" => "icon-wpb-google-map",
	"category" => 'by EDGE',
	"allowed_container_element" => 'vc_row',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Address 1",
			"param_name" => "address1",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Address 2",
			"param_name" => "address2",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Address 3",
			"param_name" => "address3",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Address 4",
			"param_name" => "address4",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Address 5",
			"param_name" => "address5",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Custom Map Style",
			"param_name" => "custom_map_style",
			"value" => array(
				"No" => "false",
				"Yes" => "true"
			),
			'save_always' => true,
			"description" => "Enabling this option will allow Map editing"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Color Overlay",
			"param_name" => "color_overlay",
			"description" => "Choose a Map color overlay",
			"dependency" => Array('element' => "custom_map_style", 'value' => array('true'))
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Saturation",
			"param_name" => "saturation",
			"description" => "Choose a level of saturation (-100 = least saturated, 100 = most saturated)",
			"dependency" => Array('element' => "custom_map_style", 'value' => array('true'))
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Lightness",
			"param_name" => "lightness",
			"description" => "Choose a level of lightness (-100 = darkest, 100 = lightest)",
			"dependency" => Array('element' => "custom_map_style", 'value' => array('true'))
		),
		array(
			"type" => "attach_image",
			"holder" => "div",
			"class" => "",
			"heading" => "Pin",
			"param_name" => "pin",
			"description" => "Select a pin image to be used on Google Map"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Map Zoom",
			"param_name" => "zoom",
			"description" => "Enter a zoom factor for Google Map (0 = whole worlds, 19 = individual buildings)"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Zoom Map on Mouse Wheel",
			"param_name" => "google_maps_scroll_wheel",
			"value" => array(
				"No" => "false",
				"Yes" => "true"
			),
			'save_always' => true,
			"description" => "Enabling this option will allow users to zoom in on Map using mouse wheel"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Map Height",
			"param_name" => "map_height",
			"description" => ""
		) ,
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Show address info box on page load",
			"param_name" => "address_info_box",
			"value" => array(
				"No" => "no",
				"Yes" => "yes"
			),
			'save_always' => true,
		)
	)
));


/*** Icon List Item ***/

vc_map( array(
	"name" => "Icon List Item",
	"base" => "no_icon_list_item",
	"icon" => "icon-wpb-icon-list-item",
	"category" => 'by EDGE',
	"params" => array_merge(
		$edgtIconCollections->getVCParamsArray(),
        array(
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Icon Type",
                "param_name" => "icon_type",
                "value" => array(
                    "Normal"  => "normal_icon_list",
                    "Small"   => "small_icon_list"
                ),
				'save_always' => true,
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Icon Color",
                "param_name" => "icon_color",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Icon Margin Right (px)",
                "param_name" => "icon_margin_right",
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Border Type",
                "param_name" => "border_type",
                "value" => array(
                    "" => "",
                    "Circle"  => "circle",
                    "Square"   => "square"
                ),
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Border Color",
                "param_name" => "border_color",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Title",
                "param_name" => "title",
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Title Color",
                "param_name" => "title_color",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Title size (px)",
                "param_name" => "title_size",
                "description" => ""
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Title Font Weight (px)",
                "param_name" => "title_font_weight",
				"value" => $font_weight_array,
				'save_always' => true,
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Bottom Margin (px)",
                "param_name" => "bottom_margin",
                "description" => ""
            )
        )
    )
) );


/*** Call to action ***/

vc_map( array(
		"name" => "Call to Action",
		"base" => "no_call_to_action",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-call-to-action",
		"allowed_container_element" => 'vc_row',
		"params" => array_merge(
			array(
				array(
					"type"          => "dropdown",
					"holder"        => "div",
					"class"         => "",
					"heading"       => "Full Width",
					"param_name"    => "full_width",
					"value"         => array(
						"Yes"       => "yes",
						"No"        => "no"
					),
					'save_always' => true,
					"description"   => ""
				),
				array(
					"type"          => "dropdown",
					"holder"        => "div",
					"class"         => "",
					"heading"       => "Content in grid",
					"param_name"    => "content_in_grid",
					"value"         => array(
						"Yes"       => "yes",
						"No"        => "no"
					),
					'save_always' => true,
					"description"   => "",
					"dependency"    => array("element" => "full_width", "value" => "yes")
				),
				array(
					"type"          => "dropdown",
					"holder"        => "div",
					"class"         => "",
					"heading"       => "Grid size",
					"param_name"    => "grid_size",
					"value"         => array(
						"75/25"     => "75",
						"50/50"     => "50",
						"66/33"     => "66"
					),
					'save_always' => true,
					"description"   => "",
					"dependency"    => array("element" => "content_in_grid", "value" => "yes")
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Type",
					"param_name" => "type",
					"value" => array(
						"Normal" => "normal",
						"With Icon" => "with_icon",
						"With Custom Icon" => "with_custom_icon"
					),
					'save_always' => true,
					"description" => ""
				)
			),
			$edgtIconCollections->getVCParamsArray(array('element' => 'type', 'value' => array('with_icon'))),
			array(
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Custom Icon",
					"param_name" => "custom_icon",
					"dependency" => Array('element' => "type", 'value' => array('with_custom_icon'))
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Icon Size",
					"param_name" => "icon_size",
					"description" => "",
					"dependency" => Array('element' => "type", 'value' => array('with_icon'))
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Icon Position",
					"param_name" => "icon_position",
					"value" => array(
						"Default/Top" => "top",
						"Middle" => "middle",
						"Bottom" => "bottom"
					),
					'save_always' => true,
					"description" => "",
					"dependency" => array('element' => 'type', 'value' => array('with_icon','with_custom_icon'))
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => "Icon Color",
					"param_name" => "icon_color",
					"description" => "",
					"dependency" => Array('element' => "type", 'value' => array('with_icon'))
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Background Color",
					"param_name" => "background_color",
					"description" => ""
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Border Color",
					"param_name" => "border_color",
					"description" => ""
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Box Padding (top right bottom left) px",
					"param_name" => "box_padding",
					"description" => "Default padding is 20px on all sides"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Default Text Font Size (px)",
					"param_name" => "text_size",
					"description" => "Font size for p tag"
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Show Button",
					"param_name" => "show_button",
					"value" => array(
						"Yes" => "yes",
						"No" => "no"
					),
					'save_always' => true,
					"description" => ""
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Position",
					"param_name" => "button_position",
					"value" => array(
						"Default/right" => "",
						"Center" => "center",
						"Left" => "left"
					),
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Size",
					"param_name" => "button_size",
					"value" => array(
						"Default" => "",
						"Small" => "small",
						"Medium" => "medium",
						"Large" => "large",
						"Extra Large" => "big_large"
					),
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Text",
					"param_name" => "button_text",
					"description" => "Default text is 'button'",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Link",
					"param_name" => "button_link",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Target",
					"param_name" => "button_target",
					"value" => array(
						"" => "",
						"Self" => "_self",
						"Blank" => "_blank"
					),
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Text Color",
					"param_name" => "button_text_color",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Hover Text Color",
					"param_name" => "button_hover_text_color",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Background Color",
					"param_name" => "button_background_color",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				 array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Hover Background Color",
					"param_name" => "button_hover_background_color",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Border Color",
					"param_name" => "button_border_color",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Hover Border Color",
					"param_name" => "button_hover_border_color",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Button Border Width",
					"param_name" => "button_border_width",
					"description" => "",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Border Radius px",
					"param_name" => "border_radius",
					"description" => "Border radius for button",
					"dependency" => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => "Content",
					"param_name" => "content",
					"value" => "<p>"."I am test text for Call to action."."</p>",
					"description" => ""
				)
			)
			)
    )
);


/*** Blockquote ***/

vc_map( array(
		"name" => "Blockquote",
		"base" => "no_blockquote",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-blockquote",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text",
				"value" => "Blockquote text",
				'save_always' => true
			),
            array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Color",
				"param_name" => "text_color",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Title tag",
				"param_name" => "title_tag",
				"value" => array(
					""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",
					"h5" => "h5",
					"h6" => "h6",
				),
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Width",
				"param_name" => "width",
				"description" => "Width (%)"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Line Height",
				"param_name" => "line_height",
				"description" => "Line Height (px)"
			),
            array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Background Color",
				"param_name" => "background_color",
				"description" => ""
			),
             array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Show Border",
                "param_name" => "show_border",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
				 'save_always' => true,
                "description" => ""
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Color",
				"param_name" => "border_color",
				"description" => "",
                "dependency" => array('element' => "show_border", 'value' => 'yes')
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Border width (px)",
                "param_name" => "border_width",
                "description" => "",
                "dependency" => array('element' => "show_border", 'value' => 'yes')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Border Right Margin (px)",
                "param_name" => "border_right_margin",
                "description" => "",
                "dependency" => array('element' => "show_border", 'value' => 'yes')
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Show Quote Icon",
                "param_name" => "show_quote_icon",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
				'save_always' => true,
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Use Custom Icon or Font",
                "param_name" => "quote_icon_font",
                "value" => array(
                    "No" => "",
                    "Use Specific Font" => "font_family",
                    "Use Icon" => "with_icon"
                ),
                "description" => "",
                "dependency" => array('element' => "show_quote_icon", 'value' => 'yes')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Quote Icon Font",
                "param_name" => "quote_font_family",
                "dependency" => Array('element' => "quote_icon_font", 'value' => 'font_family')
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Quote Icon Pack",
                "param_name" => "quote_icon_pack",
                "value" => array_merge(array("" => ""),$edgtIconCollections->getIconCollectionsVCExclude('linea_icons')),
				'save_always' => true,
                "dependency" => Array('element' => "quote_icon_font", 'value' => 'with_icon')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Quote Icon Color",
                "param_name" => "quote_icon_color",
                "description" => "",
                "dependency" => array('element' => "show_quote_icon", 'value' => 'yes')
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Quote Icon Size (px)",
				"param_name" => "quote_icon_size",
                "dependency" => array('element' => "show_quote_icon", 'value' => 'yes')
			)
		)
) );


/*** Button shortcode **/

vc_map( array(
		"name" => "Button",
		"base" => "no_button",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-button",
		"allowed_container_element" => 'vc_row',
		"params" => array_merge(
                    array(
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Size",
                            "param_name" => "size",
                            "value" => array(
                                "Default" => "",
                                "Small" => "small",
                                "Medium" => "medium",	
                                "Large" => "large",
                                "Extra Large" => "big_large",
                                "Extra Large Full Width" => "big_large_full_width"
                            )
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Style",
                            "param_name" => "style",
                            "value" => array(
                                "Default" => "",
                                "White" => "white"
                            )
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text",
                            "param_name" => "text",
                            "description" => "Default text is 'button'"
                        )
                    ),
                    $edgtIconCollections->getVCParamsArray(array(), '', true),
                    array(
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Icon Position",
                            "param_name" => "icon_position",
                            "value" => array(
                                "Right" => "right",
                                "Left" => "left"
                            ),
							'save_always' => true,
                            "dependency" => Array('element' => $edgtIconCollections->iconPackParamName, 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Color",
                            "param_name" => "icon_color",
                            "dependency" => Array('element' =>$edgtIconCollections->iconPackParamName, 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Background Color",
                            "param_name" => "icon_background_color",
                            "dependency" => Array('element' =>$edgtIconCollections->iconPackParamName, 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Background Hover Color",
                            "param_name" => "icon_background_hover_color",
                            "dependency" => Array('element' =>$edgtIconCollections->iconPackParamName, 'not_empty' => true)
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Link",
                            "param_name" => "link"
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Link Target",
                            "param_name" => "target",
                            "value" => array(
                                "Self" => "_self",
                                "Blank" => "_blank"
                            ),
							'save_always' => true,
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Color",
                            "param_name" => "color"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Hover Color",
                            "param_name" => "hover_color"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Background Color",
                            "param_name" => "background_color"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Hover Background Color",
                            "param_name" => "hover_background_color"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Border Color",
                            "param_name" => "border_color"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Hover Border Color",
                            "param_name" => "hover_border_color"
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Border Width (px)",
                            "param_name" => "border_width"
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Font Style",
                            "param_name" => "font_style",
                            "value" => array(
                                "" => "",
                                "Normal" => "normal",	
                                "Italic" => "italic"
                            )
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Font Weight",
                            "param_name" => "font_weight",
                            "value" => $font_weight_array,
							'save_always' => true,
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Margin",
                            "param_name" => "margin",
                            "description" => __("Please insert margin in format: 0px 0px 1px 0px", 'edgt')
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Left/Right Padding (px)",
                            "param_name" => "padding",
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Border radius",
                            "param_name" => "border_radius",
                            "description" => __("Please insert border radius(Rounded corners) in px. For example: 4 ", 'edgt')
                        )
                    )
                )
    )
);


/*** Image with text ***/

vc_map( array(
		"name" => "Image With Text",
		"base" => "no_image_with_text",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-image-with-text",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Image",
				"param_name" => "image"
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Alignment",
                "param_name" => "alignment",
                "value" => array(
                    "Center"   => "center",
                    "Left"    => "left",
                    "Right"   => "right"
                ),
				'save_always' => true,
                "description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Tag",
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "<p>"."I am test text for Interactive Banners shortcode."."</p>",
				"description" => ""
			)
		)
) );


/*** Message shortcode ***/

vc_map( array(
	"name" => "Message",
	"base" => "no_message",
	"category" => 'by EDGE',
	"icon" => "icon-wpb-message",
	"allowed_container_element" => 'vc_row',
	"params" => array_merge(
            array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Type",
                    "param_name" => "type",
                    "value" => array(
                        "Normal" => "normal",
                        "With Icon" => "with_icon",
                        "With Custom Icon" => "with_custom_icon"
                    ),
					'save_always' => true
                )
            ),
            $edgtIconCollections->getVCParamsArray(array('element' => "type", 'value' => array('with_icon'))),
            array(
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => "Icon Position",
                    "param_name" => "icon_position",
                    "value" => array(
                        "Right" => "right",
                        "Left" => "left"
                    ),
					'save_always' => true,
                    "dependency" => Array('element' => $edgtIconCollections->iconPackParamName, 'not_empty' => true)
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => "Icon Position",
                    "param_name" => "custom_icon_position",
                    "value" => array(
                        "Right" => "right",
                        "Left" => "left"
                    ),
					'save_always' => true,
                    "dependency" => Array('element' => 'type', 'value' => array('with_custom_icon'))
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Icon Size",
                    "param_name" => "icon_size",
                    "value" => $edgtIconCollections->getIconSizesArray(),
					'save_always' => true,
                    "description" => "",
                    "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Custom Size (px)",
                    "param_name" => "icon_custom_size",
                    "value" => "",
                    "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => "Icon Color",
                    "param_name" => "icon_color",
                    "description" => "",
                    "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => "Icon Background Color",
                    "param_name" => "icon_background_color",
                    "description" => "",
                    "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                ),
                array(
                    "type" => "attach_image",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Custom Icon",
                    "param_name" => "custom_icon",
                    "dependency" => Array('element' => "type", 'value' => array('with_custom_icon'))
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Background Color",
                    "param_name" => "background_color",
                    "description" => ""
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Border Color",
                    "param_name" => "border_color",
                    "description" => ""
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Border Width (px)",
                    "param_name" => "border_width",
                    "description" => "Default value is 1"
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Close Button Color",
                    "param_name" => "close_button_color",
                    "description" => "Default color is #fff"
                ),
                array(
                    "type" => "textarea_html",
                    "holder" => "div",
                    "class" => "",
                    "heading" => "Content",
                    "param_name" => "content",
                    "value" => "<p>"."I am test text for Message shortcode."."</p>",
                    "description" => ""
                )
            )
        )
) );


/*** Pie Chart ***/

vc_map( array(
		"name" => "Pie Chart",
		"base" => "no_pie_chart",
		"icon" => "icon-wpb-pie-chart",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Size(px)",
                "param_name" => "size",
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Type of Central text",
                "param_name" => "type_of_central_text",
                "value" => array(
                    "Title" => "title",
                    "Percent"  => "percent"
                ),
				'save_always' => true,
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage",
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Percentage Mark",
				"param_name" => "show_percent_mark",
				"value" => array(
					"Yes" => "with_mark",
					"No"  => "without_mark"	
				),
				'save_always' => true,
				"dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Color",
				"param_name" => "percentage_color",
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Percentage Font",
                "param_name" => "percent_font_family",
                "dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Font Size",
				"param_name" => "percent_font_size",
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Font weight",
				"param_name" => "percent_font_weight",
				"value" => array(
					"Default" 			=> "",
					"Thin 100"			=> "100",
					"Extra-Light 200" 	=> "200",
					"Light 300"			=> "300",
					"Regular 400"		=> "400",
					"Medium 500"		=> "500",
					"Semi-Bold 600"		=> "600",
					"Bold 700"			=> "700",
					"Extra-Bold 800"	=> "800",
					"Ultra-Bold 900"	=> "900"
				),
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Bar Active Color",
				"param_name" => "active_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Bar Inactive Color",
				"param_name" => "noactive_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Pie Chart Line Width (px)",
				"param_name" => "line_width",
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Chart Alignment",
                "param_name" => "chart_alignment",
                "value" => array(
                    "Center"   => "",
                    "Left" => "left",
                    "Right" => "right"
                ),
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Margin below chart (px)",
                "param_name" => "margin_below_chart",
                "description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Tag",
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Color",
				"param_name" => "text_color",
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator",
                "param_name" => "separator",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
				'save_always' => true,
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Color",
                "param_name" => "separator_color",
                "description" => "",
                "dependency" => array('element' => "separator", 'value' => array('yes'))
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Border Style",
                "param_name" => "separator_border_style",
                "value" => array(
                    "" => "",
                    "Dashed" => "dashed",
                    "Solid" => "solid"
                ),
                "description" => "",
                "dependency" => array('element' => "separator", 'value' => array('yes'))
            )
		)
) );


/*** Pie Chart With Icon ***/

vc_map( array(
	"name" => "Pie Chart With Icon",
	"base" => "no_pie_chart_with_icon",
	"icon" => "icon-wpb-pie-chart-with-icon",
	"category" => 'by EDGE',
	"allowed_container_element" => 'vc_row',
	"params" => array_merge(
                array(
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Size(px)",
                        "param_name" => "size",
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Percentage",
                        "param_name" => "percent",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Bar Active Color",
                        "param_name" => "active_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Bar Inactive Color",
                        "param_name" => "noactive_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Pie Chart Line Width (px)",
                        "param_name" => "line_width",
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title",
                        "param_name" => "title",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title Color",
                        "param_name" => "title_color",
                        "dependency" => array('element' => "title", 'not_empty' => true)
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Title Tag",
                        "param_name" => "title_tag",
                        "value" => array(
                            ""   => "",
                            "h2" => "h2",
                            "h3" => "h3",
                            "h4" => "h4",
                            "h5" => "h5",
                            "h6" => "h6",
                        ),
                        "dependency" => array('element' => "title", 'not_empty' => true)
                    ),
                ),
                $edgtIconCollections->getVCParamsArray(),
                array(
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Color",
                        "param_name" => "icon_color",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Icon Size (px)",
                        "param_name" => "icon_custom_size",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Size",
                        "param_name" => "icon_size",
                        "value" => $edgtIconCollections->getIconSizesArray(),
						'save_always' => true,
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Text",
                        "param_name" => "text",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Text Color",
                        "param_name" => "text_color",
                        "dependency" => array('element' => "text", 'not_empty' => true)
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator",
                        "param_name" => "separator",
                        "value" => array(
                            "Yes" => "yes",
                            "No" => "no"
                        ),
						'save_always' => true,
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator Color",
                        "param_name" => "separator_color",
                        "description" => "",
                        "dependency" => array('element' => "separator", 'value' => array('yes'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator Border Style",
                        "param_name" => "separator_border_style",
                        "value" => array(
                            "" => "",
                            "Dashed" => "dashed",
                            "Solid" => "solid"
                        ),
                        "description" => "",
                        "dependency" => array('element' => "separator", 'value' => array('yes'))
                    )
                )
            )

) );


/*** Pie Chart 2 (Pie) ***/

vc_map( array(
		"name" => "Pie Chart 2 (Pie)",
		"base" => "no_pie_chart2",
		"icon" => "icon-wpb-pie-chart2",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Width",
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Height",
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Legend Text Color",
				"param_name" => "color",
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "15,#2B3127,Legend One; 35,#94907b,Legend Two; 50,#414a3b,Legend Three",
				"description" => ""
			)

		)
) );


/*** Pie Chart 3 (Doughnut) ***/

vc_map( array(
		"name" => "Pie Chart 3 (Doughnut)",
		"base" => "no_pie_chart3",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-pie-chart3",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Width",
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Height",
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Legend Text Color",
				"param_name" => "color",
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "15,#2B3127,Legend One; 35,#94907b,Legend Two; 50,#414a3b,Legend Three",
				"description" => ""
			)

		)
) );


/** Horizontal progress bar shortcode ***/

vc_map( array(
		"name" => "Progress Bar - Horizontal",
		"base" => "no_progress_bar",
		"icon" => "icon-wpb-progress-bar",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Tag",
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Custom Size (px)",
				"param_name" => "title_custom_size",
				"description" => ""
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Title Padding Bottom(px)",
                "param_name" => "title_padding_bottom",
                "description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage",
				"param_name" => "percent",
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Show Percentage Number",
                "param_name" => "show_percent_number",
                "value" => array(
                    "Yes" => "yes",
                    "No"  => "no"
                ),
				'save_always' => true,
                "dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Percentage Mark",
				"param_name" => "show_percent_mark",
				"value" => array(
					"Yes" => "with_mark",
					"No"  => "without_mark"	
				),
				'save_always' => true,
				"dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => "Percentage Type",
                "param_name" => "percentage_type",
                "value" => array(
                    "Floating"  => "floating",
                    "Static" => "static"
                ),
				'save_always' => true,
                "dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Floating Type",
				"param_name" => "floating_type",
				"value" => array(
					"Outside Floating"  => "floating_outside",
					"Inside Floating" => "floating_inside"
				),
				'save_always' => true,
				"dependency" => array('element' => "percentage_type", 'value' => array('floating'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Color",
				"param_name" => "percent_color",
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Percentage Background Color",
                "param_name" => "percent_background_color",
                "dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Percentage Border Radius (px)",
                "param_name" => "percent_border_radius",
                "dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Font Size",
				"param_name" => "percent_font_size",
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Font weight",
				"param_name" => "percent_font_weight",
				"value" => array(
					"Default" 			=> "",
					"Thin 100"			=> "100",
					"Extra-Light 200" 	=> "200",
					"Light 300"			=> "300",
					"Regular 400"		=> "400",
					"Medium 500"		=> "500",
					"Semi-Bold 600"		=> "600",
					"Bold 700"			=> "700",
					"Extra-Bold 800"	=> "800",
					"Ultra-Bold 900"	=> "900"
				),
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Active Background Color",
				"param_name" => "active_background_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Active Border Color",
				"param_name" => "active_border_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Inactive Background Color",
				"param_name" => "noactive_background_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Progress Bar Height (px)",
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Progress Bar Border Radius (px)",
				"param_name" => "border_radius",
				"description" => ""
			)
		)
) );


/*** Vertical progress bar shortcode ***/

vc_map( array(
		"name" => "Progress Bar - Vertical",
		"base" => "no_progress_bar_vertical",
		"icon" => "icon-wpb-vertical-progress-bar",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"description" => ""
			),
            array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Tag",
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Size",
				"param_name" => "title_size",
				"description" => ""
			),
			 array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Progress Bar Height(px)",
				"param_name" => "bar_content_height",
				"description" => "Default value is 190px"
			),
            array (
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Bar Color",
                "param_name" => "bar_color",
                "description" => ""
            ),
            array (
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Bar Border Color",
                "param_name" => "bar_border_color",
                "description" => ""
            ),
			array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Background Color",
				"param_name" => "background_color",
				"description" => ""
			),
			array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Top Border Radius",
				"param_name" => "border_radius",
				"description" => ""
			),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percent",
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Percentage Mark",
				"param_name" => "show_percent_mark",
				"value" => array(
					"Yes" => "with_mark",
					"No"  => "without_mark"	
				),
				'save_always' => true,
				"dependency" => Array('element' => "percent", 'not_empty' => true)
            ),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Text Size",
				"param_name" => "percentage_text_size",
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
            array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Percentage Color",
				"param_name" => "percent_color",
				"dependency" => Array('element' => "percent", 'not_empty' => true)
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text",
				"value" => "",
				"description" => ""
			),
            array (
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Text Color",
                "param_name" => "text_color",
                "description" => "",
                "dependency" => Array('element' => "text", 'not_empty' => true)
            )
		)
) );


/*** Progress Bar Icon ***/

vc_map( array(
	"name" => "Progress Bar - Icon",
	"base" => "no_progress_bar_icon",
	"icon" => "icon-wpb-progress-bar-icon",
	"category" => 'by EDGE',
	"allowed_container_element" => 'vc_row',
	"params" => array_merge(
                array(
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Number of Icons",
                        "param_name" => "icons_number",
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Number of Active Icons",
                        "param_name" => "active_number",
                        "description" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Type",
                        "param_name" => "type",
                        "value" => array(
                            "Normal" => "normal",
                            "Circle" => "circle",
                            "Square" => "square"
                        ),
						'save_always' => true,
                        "description" => ""
                    )
                ),
                $edgtIconCollections->getVCParamsArray(),
                array(
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Size",
                        "param_name" => "size",
                        "value" => array(
                            "Tiny" => "tiny",
                            "Small" => "small",
                            "Medium" => "medium",
                            "Large" => "large",
                            "Very Large" => "very_large",
                        ),
						'save_always' => true,
                        "description" => "",
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Color",
                        "param_name" => "icon_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Active Color",
                        "param_name" => "icon_active_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Background Color",
                        "param_name" => "background_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Background Active Color",
                        "param_name" => "background_active_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Border Color",
                        "param_name" => "border_color",
                        "description" => "Only for Square and Circle type",
                        "dependency" => array('element' => "type", 'value' => array('square', 'circle'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Border Active Color",
                        "param_name" => "border_active_color",
                        "description" => "Only for Square and Circle type",
                        "dependency" => array('element' => "type", 'value' => array('square', 'circle'))
                    )
                )
            )
) );


/*** Line Graph shortcode ***/

vc_map( array(
		"name" => "Line Graph",
		"base" => "no_line_graph",
		"icon" => "icon-wpb-line-graph",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Type",
				"param_name" => "type",
				"value" => array(
					"" => "",
					"Rounded edges" => "rounded",
					"Sharp edges" => "sharp"	
				),
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Width",
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Height",
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Custom Color",
				"param_name" => "custom_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Scale steps",
				"param_name" => "scale_steps",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Scale step width",
				"param_name" => "scale_step_width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Labels",
				"param_name" => "labels",
				"value" => "Label 1, Label 2, Label 3"
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "#414a3b,Legend One,1,5,10;#94907b,Legend Two,3,7,20;#2B3127,Legend Three,10,2,34"
			)
		)
) );


/*** Pricing Tables ***/

class WPBakeryShortCode_No_Pricing_Tables  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" => "Edge Pricing Tables", "edgt",
    "base" => "no_pricing_tables",
    "as_parent" => array('only' => 'no_pricing_table'),
    "content_element" => true,
    "category" => 'by EDGE',
    "icon" => "icon-wpb-pricing-tables",
    "show_settings_on_create" => true,
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Columns",
            "param_name" => "columns",
            "value" => array(
                "Two"       => "two_columns",
                "Three"     => "three_columns",
                "Four"      => "four_columns",
            ),
			'save_always' => true,
            "description" => ""
        )
    ),
    "js_view" => 'VcColumnView'
) );


/*** Pricing Table ***/

class WPBakeryShortCode_No_Pricing_Table  extends WPBakeryShortCode {}
vc_map( array(
		"name" => "Pricing Table",
		"base" => "no_pricing_table",
		"icon" => "icon-wpb-pricing-table",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
        "as_child" => array('only' => 'no_pricing_tables'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type", 'edgt'),
				"param_name" => "type",
				"value" => array(
					"Price on top" => "price_on_top",
					"Title on top" => "title_on_top"
                ),
				'save_always' => true,
				"description" => ""
			),		
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"value" => "Basic Plan",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Color",
				"param_name" => "title_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Background Color",
				"param_name" => "title_background_color",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Small Separator",
				"param_name" => "title_separator",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"	
				),
				'save_always' => true,
				"description" => "",
				"dependency" => array('element' => 'type', 'value' => 'price_on_top')
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Separator Color",
				"param_name" => "title_separator_color",
				"description" => "",
				"dependency" => array('element' => 'title_separator', 'value' => 'yes')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Border Bottom",
				"param_name" => "title_border_bottom",
				"value" => array(
					"Yes" => "yes",
					"No" => "no"						
				),
				'save_always' => true,
				"description" => "",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Title Border Bottom Color",
				"param_name" => "title_border_bottom_color",
				"description" => "",
				"dependency" => array('element' => 'title_border_bottom', 'value' => 'yes')
			), 

			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Around",
				"param_name" => "border_arround",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"										
				),
				'save_always' => true,
				"description" => ""
			),

			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Arround Color",
				"param_name" => "border_arround_color",
				"description" => "",
				"dependency" => array('element' => 'border_arround', 'value' => 'yes')
			),	
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Wide Border Top",
				"param_name" => "table_border_top",
				"value" => array(
					"Yes" => "yes",
					"No" => "no"						
				),
				'save_always' => true,
				"description" => "",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
			),

			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Wide Border Top Color",
				"param_name" => "pricing_table_border_top_color",
				"description" => "",
				"dependency" => array('element' => 'table_border_top', 'value' => 'yes')
			),	

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Price",
				"param_name" => "price",
				"description" => "Default value is 100"
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Price Background Color",
                "param_name" => "price_background",
                "description" => ""
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Price Font Weight",
				"param_name" => "price_font_weight",
				"value" => $font_weight_array,
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Currency",
				"param_name" => "currency",
				"description" => "Default mark is $"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Price Period",
				"param_name" => "price_period",
				"description" => "Default label is monthly"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Price Period Position",
				"param_name" => "price_period_position",
				"value" => array(
					"Default" => "",
					"Next to Title" => "next_to_title",
					"Bellow Title" => "bellow_title"						
				),
				"description" => "",
				"dependency" => array('element' => 'type', 'value' => 'price_on_top')
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Text",
                "param_name" => "button_text",
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Size",
                "value" => array(
                    "Full Width" => "full_width",
                    "Normal" => "normal"
                ),
				'save_always' => true,
                "param_name" => "button_size",
                "dependency" => array('element' => 'type',  'value' => 'title_on_top')
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Link",
				"param_name" => "link",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Target",
				"param_name" => "target",
				"value" => array(
					"" => "",
					"Self" => "_self",
					"Blank" => "_blank"
				),
				"dependency" => array('element' => 'link', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Color",
				"param_name" => "button_color",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Background Color",
				"param_name" => "button_background_color",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),
			
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Holder Background Color",
				"param_name" => "button_holder_background_color",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Border Color",
				"param_name" => "button_border_color",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),

			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Button arrow",
				"param_name" => "button_arrow",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"	
				),
				'save_always' => true,
				"description" => "",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Disable Button Top Border",
				"param_name" => "disable_button_border_top",
				"value" => array(
					"Default" => "",
					"No" => "no",
					"Yes" => "yes"	
				),
				"description" => "This options is only used for type Title on Top",
				"dependency" => array('element' => 'button_text', 'not_empty' => true)
			),			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Active",
				"param_name" => "active",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"	
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Active Style",
				"param_name" => "active_style",
				"value" => array(
					"Default" => "",
					"Circle" => "circle",
					"Rectangle" => "rectangle",
				),
				"description" => "This option is only used for type price on top",
				"dependency" => array('element' => 'active', 'value' => 'yes')
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Active text",
                "param_name" => "active_text",
                "description" => "Best choice",
                "dependency" => array('element' => 'active', 'value' => 'yes')
            ),
            array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Active Text Color",
				"param_name" => "active_text_color",
				"dependency" => array('element' => 'active', 'value' => 'yes')
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Active Text Background Color",
				"param_name" => "active_text_background_color",
				"dependency" => array('element' => 'active', 'value' => 'yes')
			),
			 array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Content Text Color",
				"param_name" => "content_text_color"
			),
			array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Content Background Color",
                "param_name" => "content_background_color",
                "description" => "",
				"dependency" => array('element' => 'type', 'value' => 'price_on_top')
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Background and Border Color From Edge to Edge",
				"param_name" => "content_section_full_width",
				"value" => array(
					"Default" => "",
					"Yes" => "yes",
					"No" => "no",
				),
				"description" => "",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
			),
			array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Even Section Background color",
                "param_name" => "even_section_background_color",
                "description" => "Set background color for even numbered pricing table content sections",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Even Section Border color",
                "param_name" => "even_section_border_color",
                "description" => "Set border color for even numbered pricing table content sections",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
            ),
			array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Odd Section Background color",
                "param_name" => "odd_section_background_color",
                "description" => "Set background color for odd numbered pricing table content sections",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Odd Section Border color",
                "param_name" => "odd_section_border_color",
                "description" => "Set border color for odd numbered pricing table content sections",
				"dependency" => array('element' => 'type', 'value' => 'title_on_top')
            ),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Pricing Table Background Image",
				"param_name" => "content_background_image",
				"description" => "Set background color for odd numbered pricing table content sections"
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "<li>content content content</li><li>content content content</li><li>content content content</li>",
				"description" => ""
			)
		)
) );


/*** Social Share ***/

vc_map( array(
		"name" => "Social Share",
		"base" => "no_social_share",
		"icon" => "icon-wpb-social-share",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"show_settings_on_create" => false
) );


/*** Custom Font ***/

vc_map( array(
		"name" => "Custom Font",
		"base" => "no_custom_font",
		"icon" => "icon-wpb-custom-font",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Font family",
				"param_name" => "font_family",
				"value" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Font size",
				"param_name" => "font_size",
				"value" => "",
				'save_always' => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Line height",
				"param_name" => "line_height",
				"value" => "",
				'save_always' => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Font Style",
				"param_name" => "font_style",
				"value" => array(
					"Normal" => "normal",
					"Italic" => "italic"	
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Align",
				"param_name" => "text_align",
				"value" => array(
					"Left" => "left",
					"Center" => "center",
					"Right" => "right"	
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Font weight",
				"param_name" => "font_weight",
				"value" => "300",
				'save_always' => true
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Color",
				"param_name" => "color",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text decoration",
				"param_name" => "text_decoration",
				"value" => array(
					"None" => "none",
					"Underline" => "underline",
					"Overline" => "overline",
					"Line Through" => "line-through"	
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text transform",
				"param_name" => "text_transform",
				"value" => array(
					"None" => "none",
					"Uppercase" => "uppercase",
					"Lowercase" => "lowercase",
					"Capitalize" => "capitalize"	
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text shadow",
				"param_name" => "text_shadow",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"
				),
				'save_always' => true,
				"description" => ""
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Letter Spacing (px)",
                "param_name" => "letter_spacing",
                "value" => ""
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Background Color",
				"param_name" => "background_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Padding (px)",
				"param_name" => "padding",
				"value" => "0",
                "description" =>  __("Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px", 'edgt')
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Margin (px)",
				"param_name" => "margin",
				"value" => "0"
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Show in border box",
                "param_name" => "show_in_border_box",
                "value" => array(
                    "No" => "no",
                    "Yes" => "yes"
                ),
				'save_always' => true,
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Border Color",
                "param_name" => "border_color",
                "description" => "",
                "dependency" => array('element' => 'show_in_border_box', 'value' => 'yes')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Border Thickness (px)",
                "param_name" => "border_width",
                "value" => "",
                "dependency" => array('element' => 'show_in_border_box', 'value' => 'yes')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Text background Color",
                "param_name" => "text_background_color",
                "value" => "",
                "dependency" => array('element' => 'show_in_border_box', 'value' => 'yes')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Text padding (px)",
                "param_name" => "text_padding",
                "value" => "",
                "description" =>  __("Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px", 'edgt'),
                "dependency" => array('element' => 'show_in_border_box', 'value' => 'yes')
            ),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "<p>content content content</p>",
				"description" => ""
			)
		)
) );


/*** Ordered List ***/

vc_map( array(
		"name" => "List - Ordered",
		"base" => "no_ordered_list",
		"icon" => "icon-wpb-ordered-list",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>",
				"description" => ""
			)

		)
) );


/*** Unordered List ***/

vc_map( array(
		"name" => "List - Unordered",
		"base" => "no_unordered_list",
		"icon" => "icon-wpb-unordered-list",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Style",
				"param_name" => "style",
				"value" => array(
					"Circle" => "circle",
					"Number" => "number",
					"Line"	 => "line"
				),
				'save_always' => true,
				"description" => ""
			),
            array(
                "type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Number Type",
				"param_name" => "number_type",
				"value" => array(
					"Circle" => "circle_number",
					"Transparent" => "transparent_number"
				),
				'save_always' => true,
				"description" => "",
                "dependency" => array('element' => "style", 'value' => array('number'))
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Animate List",
				"param_name" => "animate",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"
				),
				'save_always' => true,
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Font Weight",
				"param_name" => "font_weight",
				"value" => array(
                    "Default" => "",
					"Light" => "light",
					"Normal" => "normal",
                    "Bold" => "bold"
				),
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => "Content",
				"param_name" => "content",
				"value" => "<ul><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ul>",
				"description" => ""
			)
		)
) );


/*** Icon Shortcode ***/

vc_map( array(
	"name" => "Icon",
	"base" => "no_icons",
	"category" => 'by EDGE',
	"icon" => "icon-wpb-icons",
	"allowed_container_element" => 'vc_row',
	"params" => array_merge(
		$edgtIconCollections->getVCParamsArray(),
		array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Size",
				"param_name" => 'fa_size',
				"value" => $edgtIconCollections->getIconSizesArray(),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Custom Size (px)",
				"param_name" => "custom_size",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Type",
				"param_name" => "type",
				"value" => array(
					"Normal" => "normal",
					"Circle" => "circle",
					"Square" => "square"
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Rotated Shape",
				"param_name" => "rotated_shape",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"
				),
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => "square")
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Border radius",
				"param_name" => "border_radius",
				"description" => __("Please insert border radius(Rounded corners) in px. For example: 4 ", 'edgt'),
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Shape Size (px)",
				"param_name" => 'shape_size',
				"value" => "",
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Color",
				"param_name" => "icon_color",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Position",
				"param_name" => "position",
				"value" => array(
					"Normal" => "",
					"Left" => "left",
					"Center" => "center",
					"Right" => "right"
				),
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Color",
				"param_name" => "border_color",
				"dependency" => Array('element' => "type", 'value' => array('circle','square')),
				"description" => "Same color for Inner Border if enabled"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Width",
				"param_name" => "border_width",
				"description" => "Default value is 1. Enter just number. Omit pixels",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Background Color",
				"param_name" => "background_color",
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Hover Icon Color",
				"param_name" => "hover_icon_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Hover Border Color",
				"param_name" => "hover_border_color",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Hover Background Color",
				"param_name" => "hover_background_color",
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Shadow",
				"param_name" => "icon_shadow",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"
				),
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Shadow Color",
				"param_name" => "shadow_color",
				"description" => "",
				"dependency" => Array('element' => "icon_shadow", 'value' => 'yes')
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Hover Shadow Color",
				"param_name" => "hover_shadow_color",
				"description" => "",
				"dependency" => Array('element' => "icon_shadow", 'value' => 'yes')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Inner Border",
				"param_name" => "inner_border",
				"value" => array(
					"No" => "no",
					"Yes" => "yes"
				),
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('circle','square'))
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Margin",
				"param_name" => "margin",
				"description" => "Margin (top right bottom left)"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Animation",
				"param_name" => "icon_animation",
				"value" => array(
					"No" => "",
					"Yes" => "edgt_icon_animation"
				),
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Animation Delay (ms)",
				"param_name" => "icon_animation_delay",
				"value" => "",
				"description" => "",
				"dependency" => Array('element' => "icon_animation", 'value' => 'edgt_icon_animation')
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use For Back To Top",
				"value" => array("Use this icon as Back to Top button?" => "yes"),
				"param_name" => "back_to_top_icon",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link",
				"value" => ""
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => "Use Link as Anchor",
				"value" => array("Use this icon as Anchor?" => "yes"),
				"param_name" => "anchor_icon",
				"description" => "Check this box to use icon as anchor link (eg. #contact)",
				"dependency" => Array('element' => "link", 'not_empty' => true)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Target",
				"param_name" => "target",
				"value" => array(
					"Self" => "_self",
					"Blank" => "_blank"
				),
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "link", 'not_empty' => true)
		))
	)
) );


/*** Social icon ***/

vc_map( array(
	"name" => "Social Icons",
	"base" => "no_social_icons",
	"icon" => "icon-wpb-social-icons",
	"category" => 'by EDGE',
	"allowed_container_element" => 'vc_row',
	"params" => array_merge(
		array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Type",
				"param_name" => "type",
				"value" => array(
					"Normal" => "normal_social",
					"Circle" => "circle_social",
					"Square" => "square_social"
				),
				'save_always' => true,
				"description" => ""
			)
		),
		$edgtIconCollections->getSocialVCParamsArray(array(), '', false, 'linea_icons'),
		array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Size",
				"param_name" => "size",
				"value" => array(
					"Tiny"   => "tiny",
					"Small"  => "small",
					"Medium" => "medium",
					"Large"  => "large",
					"Huge"   => "huge"
				),
				'save_always' => true,
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Target",
				"param_name" => "target",
				"value" => array(
					"Self" => "_self",
					"Blank" => "_blank"
				),
				'save_always' => true,
				"dependency" => Array('element' => "link", 'not_empty' => true)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Color",
				"param_name" => "icon_color"
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Background Color",
				"param_name" => "background_color",
				"description" =>"",
				"dependency" => Array('element' => "type", 'value' => array('circle_social', 'square_social'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Color",
				"param_name" => "border_color",
				"description" =>"",
				"dependency" => Array('element' => "type", 'value' => array('circle_social', 'square_social'))
			),
			array(
				"type"              => "colorpicker",
				"holder"            => "div",
				"class"             => "",
				"heading"           => "Icon Hover Color",
				"param_name"        => "icon_hover_color",
				"description"       => ""
			),
			array(
				"type"              => "colorpicker",
				"holder"            => "div",
				"class"             => "",
				"heading"           => "Background Hover Color",
				"param_name"        => "background_hover_color",
				"dependency" => Array('element' => "type", 'value' => array('circle_social', 'square_social'))
			),
			array(
				"type"              => "colorpicker",
				"holder"            => "div",
				"class"             => "",
				"heading"           => "Border Hover Color",
				"param_name"        => "border_hover_color",
				"dependency" => Array('element' => "type", 'value' => array('circle_social', 'square_social'))
			)
		)
	)
) );


/*** Icon with Text ***/

vc_map( array(
	"name" => "Icon With Text",
	"base" => "no_icon_text",
	"icon" => "icon-wpb-icon-with-text",
	"category" => 'by EDGE',
	"allowed_container_element" => 'vc_row',
	"params" => array_merge(
                array(
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Box type",
                        "param_name" => "box_type",
                        "value" => array(
                            "Normal" => "normal",
                            "Icon in a box" => "icon_in_a_box"
                        ),
						'save_always' => true,
                        "description" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Box Border",
                        "param_name" => "box_border",
                        "value" => array(
                            "Yes" => "yes",
                            "No" => "no"
                        ),
						'save_always' => true,
                        "description" => "",
                        "dependency" => Array('element' => "box_type", 'value' => array('icon_in_a_box'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Box Border Color",
                        "param_name" => "box_border_color",
                        "description" => "",
                        "dependency" => Array('element' => "box_type", 'value' => array('icon_in_a_box'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Box Background Color",
                        "param_name" => "box_background_color",
                        "description" => "",
                        "dependency" => Array('element' => "box_type", 'value' => array('icon_in_a_box'))
                    )
                ),
                $edgtIconCollections->getVCParamsArray(),
                array(
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Icon",
                        "param_name" => "custom_icon"
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Type",
                        "param_name" => "icon_type",
                        "value" => array(
                            "Normal" => "normal",
                            "Circle" => "circle",
                            "Square" => "square"
                        ),
						'save_always' => true,
                        "description" => "This attribute doesn't work when Icon Position is Top. In This case Icon Type is Normal",
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => "Icon border width (px)",
                        "param_name" => "icon_border_width",
                        "description" => "Enter just number, omit pixels",
                        "dependency" => array('element' => 'icon_type' , 'value' => array('circle', 'square'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Size / Icon Space From Text",
                        "param_name" => "icon_size",
                        "value" => $edgtIconCollections->getIconSizesArray(),
						'save_always' => true,
                        "description" => "This attribute doesn't work when Icon Position is Top"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Icon Size (px)",
                        "param_name" => "custom_icon_size",
                        "description" => "Default value is 30",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Animation",
                        "param_name" => "icon_animation",
                        "value" => array(
                            "No" => "",
                            "Yes" => "edgt_icon_animation"
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Animation Delay (ms)",
                        "param_name" => "icon_animation_delay",
                        "value" => "",
                        "description" => "",
                        "dependency" => Array('element' => "icon_animation", 'value' => array('edgt_icon_animation'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Position",
                        "param_name" => "icon_position",
                        "value" => array(
                            "Top" => "top",
                            "Left" => "left",
                            "Left From Title" => "left_from_title",
                            "Right" => "right"
                        ),
						'save_always' => true,
                        "description" => "Icon Position (only for normal box type)",
                        "dependency" => Array('element' => "box_type", 'value' => array('normal'))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Margin",
                        "param_name" => "icon_margin",
                        "value" => "",
                        "description" => "Margin should be set in a top right bottom left format"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Text Left Padding (px)",
                        "param_name" => "text_left_padding",
                        "description" => "Default value is 86. Only when Icon Position is Left",
                        "dependency" => Array('element' => "icon_position", 'value' => array('left'))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Text Right Padding (px)",
                        "param_name" => "text_right_padding",
                        "description" => "Default value is 86. Only when Icon Position is Right",
                        "dependency" => Array('element' => "icon_position", 'value' => array('right'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Border Color",
                        "param_name" => "icon_border_color",
                        "description" => "Only for Square and Circle type",
                        "dependency" => Array('element' => "icon_type", 'value' => array('square','circle'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Color",
                        "param_name" => "icon_color",
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Background Color",
                        "param_name" => "icon_background_color",
                        "description" => "Icon Background Color (only for square and circle icon type)",
                        "dependency" => Array('element' => "icon_type", 'value' => array('square','circle'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator",
                        "param_name" => "separator",
                        "value" => array(
                            "No"  => "no",
                            "Yes"   => "yes",
                        ),
						'save_always' => true,
                        "description" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator Color",
                        "param_name" => "separator_color",
                        "description" => "",
                        "dependency" => array('element' => "separator", 'value' => array("yes"))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator Thickness (px)",
                        "param_name" => "separator_thickness",
                        "description" => "",
                        "dependency" => array('element' => "separator", 'value' => array("yes"))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator Size (px)",
                        "param_name" => "separator_width",
                        "description" => "",
                        "dependency" => array('element' => "separator", 'value' => array("yes"))
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Separator Alignment",
                        "param_name" => "separator_alignment",
                        "value" => array(
                            "Center"   => "none",
                            "Left" => "left",
                            "Right" => "right",
                        ),
						'save_always' => true,
                        "dependency" => array('element' => "separator", 'value' => array("yes"))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title",
                        "param_name" => "title",
                        "value" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Title Tag",
                        "param_name" => "title_tag",
                        "value" => array(
                            ""   => "",
                            "h2" => "h2",
                            "h3" => "h3",
                            "h4" => "h4",
                            "h5" => "h5",
                            "h6" => "h6",
                        ),
                        "dependency" => Array('element' => "title", 'not_empty' => true)
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title Color",
                        "param_name" => "title_color",
                        "dependency" => Array('element' => "title", 'not_empty' => true)
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title Top Padding (px)",
                        "param_name" => "title_padding",
                        "value" => "",
                        "description" => "This attribute is used for boxed type",
                        "dependency" => Array('element' => "box_type", 'value' => array('icon_in_a_box'))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Text",
                        "param_name" => "text",
                        "value" => ""
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Text Color",
                        "param_name" => "text_color",
                        "dependency" => Array('element' => "text", 'not_empty' => true)
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Link",
                        "param_name" => "link",
                        "value" => "",
                        "dependency" => Array('element' => "box_type", 'value' => array('normal'))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Link Text",
                        "param_name" => "link_text",
                        "description" => "Default value is READ MORE",
                        "dependency" => Array('element' => "link", 'not_empty' => true)
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Button Link Text Color",
                        "param_name" => "link_color",
                        "description" => "",
                        "dependency" => Array('element' => "link_text", 'not_empty' => true)
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Target",
                        "param_name" => "target",
                        "value" => array(
                            ""   => "",
                            "Self" => "_self",
                            "Blank" => "_blank"
                        ),
                        "dependency" => Array('element' => "link", 'not_empty' => true)
                    )
                )
            )
) );


/*** Blog List ***/

vc_map( array(
		"name" => "Blog List",
		"base" => "no_blog_list",
		"icon" => "icon-wpb-blog-list",
		"category" => 'by EDGE',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type", 'edgt'),
				"param_name" => "type",
				"value" => array(
					"Image in left box" => "image_in_box",
					"Boxes" => "boxes",
                    "Minimal" => "minimal",
                    "Masonry" => "masonry"
                ),
				'save_always' => true,
				"description" => ""
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Number of Posts",
                "param_name" => "number_of_posts",
                "description" => "",
                "dependency" => Array('element' => "type", 'value' => array('image_in_box', 'minimal','boxes', 'masonry'))
            ),
			 array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Image Size",
                "param_name" => "image_size",
                "value" => array(
                    "Original" => "original",
					"Landscape" => "landscape",
					"Square" => "square"

				),
				 'save_always' => true,
                "description" => "",
                "dependency" => Array('element' => "type", 'value' => array('boxes'))
            ),
			 array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Show Thumbnail",
                "param_name" => "show_thumbnail",
                "value" => array(
                    "Yes" => "yes",
					"No" => "no",
				),
				 'save_always' => true,
                "description" => "",
                "dependency" => Array('element' => "type", 'value' => array('boxes'))
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Number of Columns",
                "param_name" => "number_of_columns",
                "value" => array(
                    "One" => "1",
					"Two" => "2",
					"Three" => "3",
					"Four" => "4"
				),
				'save_always' => true,
                "description" => "",
                "dependency" => Array('element' => "type", 'value' => array('boxes'))
            ),
			
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Overlay Color",
                "param_name" => "overlay_color",
                "description" => "",
                "dependency" => Array('element' => "type", 'value' => array('boxes'))
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Display Overlay Icon",
                "param_name" => "overlay_icon",
                "value" => array(
                    "No" => "0",
                    "Yes" => "1"
                ),
				'save_always' => true,
                "dependency" => Array('element' => "type", 'value' => array('boxes'))
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Order By",
				"param_name" => "order_by",
				"value" => array(
					"Title" => "title",
					"Date" => "date"
				),
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal', 'masonry'))
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Order",
				"param_name" => "order",
				"value" => array(
					"ASC" => "ASC",
					"DESC" => "DESC"
				),
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal', 'masonry'))
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Category Slug",
				"param_name" => "category",
				"description" => "Leave empty for all or use comma for list"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text length",
				"param_name" => "text_length",
				"description" => "Number of characters"
            ),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Tag",
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Title Size (px)",
                "param_name" => "title_size",
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Title Color",
                "param_name" => "title_color",
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Display excerpt",
                "param_name" => "display_excerpt",
                "value" => array(
                    "Default" => "",
                    "Yes" => "1",
                    "No" => "0"
                ),
                "description" => ''
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Excerpt Color",
                "param_name" => "excerpt_color",
                "dependency" => Array('element' => "display_excerpt", 'value' => array('1', ''))
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Info Position",
                "param_name" => "info_position",
                "value" => array(
                    "Default" => "",
                    "Top" => "top",
                    "Bottom" => "bottom"
                ),
                "dependency" => array('element' => "type", 'value' => array('image_in_box', 'minimal','boxes'))
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Post info font size (px)",
                "param_name" => "post_info_font_size",
                "description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),
			array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Post info color",
                "param_name" => "post_info_color",
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),
			array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Post info link color",
                "param_name" => "post_info_link_color",
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Post info font family",
                "param_name" => "post_info_font_family",
                "description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),			
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Post info text transform",
                "param_name" => "post_info_text_transform",
				"value" => array(
					"Default" => "",
					"None" => "none",
					"Capitalize" => "capitalize",
					"Uppercase" => "uppercase",
					"Lowercase" => "lowercase"
				),
                "description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Post info font weight",
				"param_name" => "post_info_font_weight",
				"value" => $font_weight_array,
				'save_always' => true,
				"description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
			),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Post info font style",
                "param_name" => "post_info_font_style",
				"value" => array(
					"Default" => "",
					"Normal" => "normal",
					"Italic" => "italic"
				),
                "description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "", 
                "heading" => "Post info letter spacing (px)",
                "param_name" => "post_info_letter_spacing",
                "description" => "",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Display category",
				"param_name" => "display_category",
				"value" => array(
					"Default" => "",
					"Yes" => "1",
					"No" => "0"
				),
				"description" => '',
                "dependency" => Array('element' => "type", 'value' => array('image_in_box','boxes','minimal', 'masonry'))
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Display date",
				"param_name" => "display_date",
				"value" => array(
				    "Default" => "",
					"Yes" => "1",
					"No" => "0"
				),
				"description" => '',
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal', 'masonry'))
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Date Position",
                "param_name" => "date_place",
                "value" => array(
                    "Date by Title" => "by_title",
                    "Date by Post Info" => "by_post_info"
                ),
				'save_always' => true,
                "description" => 'Choose where will be date placed',
                "dependency" => Array('element' => "type", 'value' => array('boxes'))
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Date Size (px)",
                "param_name" => "date_size",
                "description" => "",
                "dependency" => array('element' => "type", 'value' => array('boxes', 'image_in_box'))
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Display author",
				"param_name" => "display_author",
				"value" => array(
					"Default" => "",
					"Yes" => "1",
					"No" => "0"
				)
			),
            array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Display comments",
				"param_name" => "display_comments",
				"value" => array(
					"Default" => "",
					"Yes" => "1",
					"No" => "0"
				),
                "dependency" => Array('element' => "type", 'value' => array('image_in_box','boxes'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Box Background Color",
				"param_name" => "background_color",
				"dependency" => Array('element' => "type", 'value' => array('boxes', 'image_in_box','masonry'))
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Box Padding",
				"param_name" => "box_info_padding",
				"description" => "Please insert padding in format (top right bottom left) i.e. 5px 5px 5px 5px",
				"dependency" => Array('element' => "type", 'value' => array('boxes', 'image_in_box', 'masonry'))
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Between Item Color",
                "param_name" => "border_color",
                "description" => "",
                "dependency" => array('element' => "type", 'value' => array('minimal','image_in_box'))
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Separator Between Item Thickness (px)",
                "param_name" => "border_width",
                "description" => "",
                "dependency" => array('element' => "type", 'value' => array('minimal','image_in_box'))

            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Display Button",
                "param_name" => "display_button",
                "value" => array(
                    "Default" => "",
                    "Yes" => "1",
                    "No" => "0"
                ),
                "description" => "Show button leading to post single page",
				"dependency" => Array('element' => "type", 'value' => array('image_in_box', 'boxes', 'minimal'))
				
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Size",
                "param_name" => "button_size",
                "value" => array(
                    "Default" => "",
                    "Small" => "small",
                    "Medium" => "medium",
                    "Large" => "large",
                    "Extra Large" => "big_large"
                ),
                "description" => "Default value is small",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Style",
                "param_name" => "button_style",
                "value" => array(
                    "Default" => "",
                    "White" => "white"
                ),
                "description" => "Default value is Mid-Transparent",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Text",
                "param_name" => "button_text",
                "description" => "Default text is LEARN MORE",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Text Color",
                "param_name" => "button_color",
                "description" => "",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Text Hover Color",
                "param_name" => "button_hover_color",
                "description" => "",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Background Color",
                "param_name" => "button_background_color",
                "description" => "",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Hover Background Color",
                "param_name" => "button_hover_background_color",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Border Color",
                "param_name" => "button_border_color",
                "description" => "",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Border Width",
                "param_name" => "button_border_width",
                "description" => "",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Hover Border Color",
                "param_name" => "button_hover_border_color",
                "description" => "",
                "dependency" => array('element' => "display_button", 'value' => '1')
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Button Border Radius (px)",
                "param_name" => "button_border_radius",
                "description" => "Border radius for button",
                "dependency" => array('element' => "display_button", 'value' => '1')
            )
		)
) );


/*** Blog Slider ***/

vc_map( array(
	"name" => "Blog Slider",
	"base" => "no_blog_slider",
	"category" => 'by EDGE',
	"icon" => "icon-wpb-blog-slider",
	"allowed_container_element" => 'vc_row',
	"params" => array(
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Slider type",
			"param_name" => "type",
			"value" => array(
				"Default" => "",
				"Post Info visible" => "info_always",
				"Post Info in Bottom" => "info_in_bottom"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Image size",
			"param_name" => "image_size",
			"value" => array(
				"Default" => "",
				"Original Size" => "full",
				"Landscape" => "landscape",
				"Portrait" => "portrait"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Order By",
			"param_name" => "order_by",
			"value" => array(
				"" => "",
				"Title" => "title",
				"Date" => "date"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Order",
			"param_name" => "order",
			"value" => array(
				"" => "",
				"ASC" => "ASC",
				"DESC" => "DESC",
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Number",
			"param_name" => "number",
			"value" => "-1",
			"description" => "Number of blog posts on page (-1 is all)"
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Number of Blog Posts Shown",
			"param_name" => "blogs_shown",
			"value" => array(
				"" => "",
				"3" => "3",
				"4" => "4",
				"5" => "5",
				"6" => "6"
			),
			"description" => "Number of blog posts that are showing at the same time in full width (on smaller screens is responsive so there will be less items shown)",
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Category",
			"param_name" => "category",
			"value" => "",
			"description" => "Category Slug (leave empty for all)"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Selected Projects",
			"param_name" => "selected_projects",
			"value" => "",
			"description" => "Selected Projects (leave empty for all, delimit by comma)"
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Hover type",
			"param_name" => "hover_type",
			"value" => array(
				"Standard" => "standard",
				"With Triangle on Top" => "with_triangle"
			),
			'save_always' => true,
			"description" => "",
			"dependency" => array("element" => "type", "value" => array("","info_always"))
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Triangle color",
			"param_name" => "triangle_color",
			"value" => "",
			"dependency" => Array('element' => 'hover_type', 'value' => 'with_triangle'),
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Info Box Background Color",
			"param_name" => "hover_box_color",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Post Info Color",
			"param_name" => "post_info_color",
			"value" => "",
			"description" => "",
			"dependency" => array("element" => "type","value" => "info_in_bottom")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Show Author",
			"param_name" => "show_author",
			"value" => array(
				"Yes" => "yes",
				"No" => "no"
			),
			'save_always' => true,
			"description" => "Default value is Yes",
			"dependency" => array("element" => "type", "value" => "info_in_bottom")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Author Color",
			"param_name" => "author_color",
			"value" => "",
			"description" => "",
			"dependency" => array('element' => "show_author", 'value' => array('yes'))
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Show Category Names",
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "yes",
				"No" => "no"
			),
			'save_always' => true,
			"description" => "Default value is Yes",
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Category Name Color",
			"param_name" => "category_color",
			"value" => "",
			"description" => "",
			"dependency" => array('element' => "show_categories", 'value' => array('yes'))
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Show Date",
			"param_name" => "show_date",
			"value" => array(
				"Yes" => "yes",
				"No" => "no"
			),
			'save_always' => true,
			"description" => "Default value is Yes",
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Date Color",
			"param_name" => "date_color",
			"value" => "",
			"description" => "",
			"dependency" => array('element' => "show_date", 'value' => array('yes'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Title Tag",
			"param_name" => "title_tag",
			"value" => array(
				""   => "",
				"h2" => "h2",
				"h3" => "h3",
				"h4" => "h4",
				"h5" => "h5",
				"h6" => "h6",
			),
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Title Color",
			"param_name" => "title_color",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => "Prev/Next navigation",
			"value" => array("Enable prev/next navigation?" => "enable_navigation"),
			"param_name" => "enable_navigation"
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => "Bullets navigation",
			"value" => array("Show bullets navigation?" => "yes"),
			"param_name" => "pager_navigation"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Extra class name",
			"param_name" => "add_class",
			"value" => "",
			"description" => "If you wish to style this particular blog slider differently, you can use this field to add an extra class name to it and then refer to that class name in your css file."
		)
	)
) );


/*** Interactive Banners ***/

vc_map( array(
		"name" => "Interactive Banners",
		"base" => "no_interactive_banners",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-image-with-text-over",
		"allowed_container_element" => 'vc_row',
		"params" => array_merge(
                    array(
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Width",
                            "param_name" => "layout_width",
                            "value" => array(
                                ""   => "",
                                "1/2" => "one_half",
                                "1/3" => "one_third",
                                "1/4" => "one_fourth",
                            ),
                            "description" => ""
                        ),
                        array(
                            "type" => "attach_image",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Image",
                            "param_name" => "image"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Image Color Overlay",
                            "param_name" => "overlay_color",
                            "value" => "",
                            "description" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Image Hover Color Overlay",
                            "param_name" => "overlay_color_hover",
                            "value" => "",
                            "description" => "",
                        ),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => "Image Zoom on Hover",
							"param_name" => "image_animate",
							"value" => array(
								"No"   => "no",
								"Yes"   => "yes"
							),
							'save_always' => true,
							"description" => "",
							"dependency" => Array('element' => "image", 'not_empty' => true)
						),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Show Image Inner Border",
                            "param_name" => "show_border",
                            "value" => array(
                                "Yes" => "yes",
                                "No" => "no"
                            ),
							'save_always' => true,
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => "Image Inner Border Color",
                            "param_name" => "border_color",
                            "description" => "",
                            "dependency" => Array('element' => "show_border", 'value' => array('yes'))
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Inner Border Offset (px)",
                            "param_name" => "inner_border_offset",
                            "value" => "",
                            "description" => "Default value is 5",
                            "dependency" => Array('element' => "show_border", 'value' => array('yes'))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Show Triangle",
                            "param_name" => "show_triangle",
                            "value" => array(
                                "Never" => "no",
                                "Only on Hover" => "on_hover",
                                "Always" => "yes"
                            ),
							'save_always' => true,
                            "description" => ""
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Triangle Position",
                            "param_name" => "triangle_position",
                            "value" => array(
                                "Top" => "top",
                                "Bottom" => "bottom"
                            ),
							'save_always' => true,
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => "Triangle Color",
                            "param_name" => "triangle_color",
                            "description" => "",
                            "dependency" => Array('element' => "show_triangle", 'value' => array('yes','on_hover'))
                        ),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => "Show Icon",
							"param_name" => "show_icon",
							"value" => array(
								"Always"    => "always",
								"Only On Hover"    => "on_hover",
								"Never"   => "never"
							),
							'save_always' => true,
							"description" => "",
						),
                    ),
                    $edgtIconCollections->getVCParamsArray((array('element' => "show_icon", 'value' => array('always', 'on_hover'))), '', true),
                    array(
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Type",
                            "param_name" => "icon_type",
                            "value" => array(
                                "Normal" => "normal",
                                "Circle" => "circle",
                                "Square" => "square"
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Size (px)",
                            "param_name" => "icon_custom_size",
                            "value" => "",
                            "description" => "Default value is 20",
                            "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Color",
                            "param_name" => "icon_color",
                            "description" => "",
                            "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Zoom on Hover",
                            "param_name" => "icon_zoom",
                            "value" => array(
                                "No" => "no",
                                "Yes" => "yes"
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Show Title",
                            "param_name" => "show_title",
                            "value" => array(
                                "Always"    => "always",
                                "Only On Hover"    => "on_hover",
                                "Never"   => "never"
                            ),
							'save_always' => true,
                            "description" => "",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Text",
                            "param_name" => "title",
                            "description" => "",
                            "dependency" => Array('element' => "show_title", 'value' => array('always','on_hover'))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Color",
                            "param_name" => "title_color",
                            "dependency" => Array('element' => "title", 'not_empty' => true),
                            "dependency" => Array('element' => "show_title", 'value' => array('always','on_hover'))
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Size (px)",
                            "param_name" => "title_size",
                            "description" => "Default value is 17",
                            "dependency" => Array('element' => "title", 'not_empty' => true),
                            "dependency" => Array('element' => "show_title", 'value' => array('always','on_hover'))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Title Tag",
                            "param_name" => "title_tag",
                            "value" => array(
                                ""   => "",
                                "h2" => "h2",
                                "h3" => "h3",
                                "h4" => "h4",	
                                "h5" => "h5",	
                                "h6" => "h6",	
                            ),
                            "dependency" => Array('element' => "title", 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Show Button",
                            "param_name" => "show_button",
                            "value" => array(
                                "Always"    => "always",
                                "Only On Hover"    => "on_hover",
                                "Never"   => "never"
                            ),
							'save_always' => true,
                            "description" => "",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Button Height",
                            "param_name" => "button_size",
                            "description" => "It uses 'small' button options (px)",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Button Left and Right Padding",
                            "param_name" => "button_padding",
                            "description" => "It uses 'small' button options (px)",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Button Text",
                            "param_name" => "link_text",
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Link Button to following URL",
                            "param_name" => "button_link",
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Link Target",
                            "param_name" => "target",
                            "value" => array(
                                "Self"   => "_self",
                                "Blank" => "_blank"
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Button Text Color",
                            "param_name" => "link_color",
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Button Border Color",
                            "param_name" => "link_border_color",
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Button Background Color",
                            "param_name" => "link_background_color",
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover","always"))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Button Animation",
                            "param_name" => "button_animation",
                            "value" => array(
                                "Fade in"   => "fade_in",
                                "Zoom"   => "zoom",
                                "Slides Up"   => "slides_up"
                            ),
							'save_always' => true,
                            "description" => "This option doesn't work if 'Hide Text Content on Hover' enabled",
                            "dependency" => Array('element' => "show_button", 'value' => array("on_hover"))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Add Link Over Banner Content",
                            "param_name" => "link_over_content",
                            "value" => array(
                                "No"    => "no",
                                "Yes"    => "yes"
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => Array('element' => "show_button", 'value' => "never")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Link Banner Content to following URL",
                            "param_name" => "content_link",
                            "description" => "",
                            "dependency" => Array('element' => "link_over_content", 'value' => 'yes')
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Show Separator under Title",
                            "param_name" => "separator",
                            "value" => array(
                                "Never"   => "no",
                                "Always"   => "yes",
                                "Only On Hover" => "on_hover"
                            ),
							'save_always' => true,
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Separator Thickness (px)",
                            "param_name" => "separator_thickness",
                            "description" => "",
                            "dependency" => Array('element' => "separator", 'value' => array("yes","on_hover"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Separator Color",
                            "param_name" => "separator_color",
                            "description" => "",
                            "dependency" => Array('element' => "separator", 'value' => array("yes","on_hover"))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Separator Animation",
                            "param_name" => "separator_animate",
                            "value" => array(
                                "Yes"   => "yes",
                                "No"   => "no",
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => Array('element' => "separator", 'value' => array("yes","on_hover"))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Show Content",
                            "param_name" => "show_content",
                            "value" => array(
                                "Always"    => "always",
                                "Only On Hover"    => "on_hover",
                                "Never"   => "never"
                            ),
							'save_always' => true,
                            "description" => "",
                        ),
                        array(
                            "type" => "textarea_html",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Content",
                            "param_name" => "content",
                            "value" => "<p>"."I am test text for 'Interactive Banner' shortcode."."</p>",
                            "description" => ""
                        )
                    )
                )
    )
);


/*** Image with text and icon ***/

vc_map( array(
    "name" => "Image with text and Icon",
    "base" => "no_image_with_text_and_icon",
    "icon" => "icon-wpb-image-with-text-over",
    "category" => 'by EDGE',
    "allowed_container_element" => 'vc_row',
    "params" => array_merge(
                array(
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Image",
                        "param_name" => "image"
                    )
                ),
                $edgtIconCollections->getVCParamsArray(array(), '', true),
                array(
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Type",
                        "param_name" => "icon_type",
                        "value" => array(
                            "Circle" => "circle",
                            "Square" => "square"
                        ),
						'save_always' => true,
                        "description" => "",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Size (px)",
                        "param_name" => "icon_custom_size",
                        "value" => "",
                        "description" => "Default value is 25",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Shape Size (px)",
                        "param_name" => "icon_shape_size",
                        "value" => "",
                        "description" => "Default value is 100",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Color",
                        "param_name" => "icon_color",
                        "description" => "",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Background Color",
                        "param_name" => "icon_background_color",
                        "description" => "",
                        "dependency" => Array('element' => "icon_pack", 'value' => $edgtIconCollections->getIconCollectionsKeys())
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Link",
                        "param_name" => "link",
                        "description" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Link Target",
                        "param_name" => "target",
                        "value" => array(
                            "" => "",
                            "Self" => "_self",
                            "Blank" => "_blank"
                        ),
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title",
                        "param_name" => "title",
                        "description" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Title Tag",
                        "param_name" => "title_tag",
                        "value" => array(
                            ""   => "",
                            "h2" => "h2",
                            "h3" => "h3",
                            "h4" => "h4",
                            "h5" => "h5",
                            "h6" => "h6",
                        ),
                        "description" => "Default value is h4",
                        "dependency" => Array('element' => "title", 'not_empty' => true)
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Title Color",
                        "param_name" => "title_color",
                        "description" => "",
                        "dependency" => Array('element' => "title", 'not_empty' => true)
                    ),
                    array(
                        "type" => "textarea_html",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Content",
                        "param_name" => "content",
                        "value" => "<p>"."I am test text for Image With Text and Icon shortcode."."</p>",
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Top Margin",
                        "param_name" => "position_top",
                        "description" => "Select top position of title from image. Default value is 75"
                    )
                )
            )

) );


/*** Image hover ***/

vc_map( array(
		"name" => "Image Hover",
		"base" => "no_image_hover",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-image-hover",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Image",
				"param_name" => "image"
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Hover Image",
				"param_name" => "hover_image"
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Target",
				"param_name" => "target",
				"description" => "",
                "value" => array(
                    "Self" => "_self",
                    "Blank" => "_blank"
                ),
				'save_always' => true,
			),
            array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Animation",
				"param_name" => "animation",
				"description" => "",
                "value" => array(
                    "" => "",
                    "Yes" => "yes",
                    "No" => "no"
                )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Animation speed (In seconds)",
				"param_name" => "animation_speed",
				"dependency" => array('element' => "animation", 'value' => array("yes"))
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Transition delay",
				"param_name" => "transition_delay",
				"description" => "",
                "dependency" => array('element' => "animation", 'value' => array("yes"))
			)
		)
) );


/*** Team ***/

$team_social_icons_array = array();
for ($x = 1; $x<6; $x++) {
    $teamIconCollections = $edgtIconCollections->iconCollections;
    if (array_key_exists('linea_icons', $teamIconCollections)) {
        unset($teamIconCollections['linea_icons']);
    }
    foreach($teamIconCollections as $collection_key => $collection) {
    
        $team_social_icons_array[] = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Social Icon ".$x,
            "param_name" => "team_social_".$collection->param."_".$x,
            "value" => $collection->getSocialIconsArrayVC(),
			'save_always' => true,
            "dependency" => Array('element' => "team_social_icon_pack", 'value' => array($collection_key))
        );
    
    }
    
    $team_social_icons_array[] = array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "Social Icon ".$x." Link",
        "param_name" => "team_social_icon_".$x."_link",
        "dependency" => array('element' => 'team_social_icon_pack', 'value' => $edgtIconCollections->getIconCollectionsKeys())
    );
    
    $team_social_icons_array[] = array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => "Social Icon ".$x." Target",
        "param_name" => "team_social_icon_".$x."_target",
        "value" => array(
            "" => "",
            "Self" => "_self",
            "Blank" => "_blank"
        ),
        "dependency" => Array('element' => "team_social_icon_".$x."_link", 'not_empty' => true)
    );
    
}

vc_map( array(
		"name" => "Team",
		"base" => "no_team",
		"category" => 'by EDGE',
		"icon" => "icon-wpb-team",
		"allowed_container_element" => 'vc_row',
		"params" => array_merge(
                    array(
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => "Type",
							"param_name" => "team_type",
							"value" => array(
								"Main Info on Hover"     => "on_hover",
								"Main Info Below Image"  => "below_image"
							),
							'save_always' => true,
						),
                        array(
                            "type" => "attach_image",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Image",
                            "param_name" => "team_image"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Image hover color",
                            "param_name" => "team_image_hover_color"
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Hover Type",
                            "param_name" => "team_hover_type",
                            "value" => array(
                                "Text In Center"        => "in_center",
                                "Text in Left Corner"   => "in_corner"
                            ),
							'save_always' => true,
							"dependency" => array('element' => "team_type", 'value' => array('on_hover'))
						),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Name",
                            "param_name" => "team_name"
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Name Tag",
                            "param_name" => "team_name_tag",
                            "value" => array(
                                ""   => "",
                                "h2" => "h2",
                                "h3" => "h3",
                                "h4" => "h4",	
                                "h5" => "h5",	
                                "h6" => "h6",	
                            ),
                            "dependency" => array('element' => 'team_name', 'not_empty' => true)
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Name font size(px)",
                            "param_name" => "team_name_font_size",
                            "dependency" => array('element' => 'team_name', 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Name color",
                            "param_name" => "team_name_color",
                            "dependency" => array('element' => 'team_name', 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Name font weight",
                            "param_name" => "team_name_font_weight",
                            "value" => $font_weight_array,
							'save_always' => true,
                            "description" => "",
                            "dependency" => array('element' => 'team_name', 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Name text transform",
                            "param_name" => "team_name_text_transform",
                            "value" => array(
                                "Default" => "",
                                "None" => "none",
                                "Capitalize" => "capitalize",
                                "Uppercase" => "uppercase",
                                "Lowercase" => "lowercase"
                            ),
                            "dependency" => array('element' => 'team_name', 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Show Separator",
                            "param_name" => "team_show_separator",
                            "value" => array(
                                "Yes" => "yes",
                                "No" => "no"	
                            ),
							'save_always' => true,
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Separator color",
                            "param_name" => "team_separator_color",
                            "dependency" => array('element' => 'team_show_separator', 'value' => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Position",
                            "param_name" => "team_position"
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Position font size(px)",
                            "param_name" => "team_position_font_size",
                            "dependency" => array('element' => 'team_position', 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Position color",
                            "param_name" => "team_position_color",
                            "dependency" => array('element' => 'team_position', 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Position font weight",
                            "param_name" => "team_position_font_weight",
                            "value" => $font_weight_array,
							'save_always' => true,
                            "description" => "",
                            "dependency" => array('element' => 'team_position', 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Position text transform",
                            "param_name" => "team_position_text_transform",
                            "value" => array(
                                "Default" => "",
                                "None" => "none",
                                "Capitalize" => "capitalize",
                                "Uppercase" => "uppercase",
                                "Lowercase" => "lowercase"
                            ),
                            "dependency" => array('element' => 'team_position', 'not_empty' => true)
                        ),
                        array(
                            "type" => "textarea",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Description",
                            "param_name" => "team_description"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Description color",
                            "param_name" => "team_description_color",
                            "dependency" => array('element' => 'team_description', 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text align",
                            "param_name" => "text_align",
                            "value" => array(
                                "Default" => "",
                                "Left" => "left_align",
                                "Center" => "center_align",
                                "Right" => "right_align"
                            )
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Background Color",
                            "param_name" => "background_color",
                            "description" => ""
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Box Border",
                            "param_name" => "box_border",
                            "value" => array(
                                "Default" => "",
                                "No" => "no",
                                "Yes" => "yes"
                            ),
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Box Border Width",
                            "param_name" => "box_border_width",
                            "value" => "",
                            "description" => "",
                            "dependency" => array('element' => "box_border", 'value' => array('yes'))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Box Border Color",
                            "param_name" => "box_border_color",
                            "value" => "",
                            "description" => "",
                            "dependency" => array('element' => "box_border", 'value' => array('yes'))
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Social Icon Pack",
                            "param_name" => "team_social_icon_pack",
                            "value" => array_merge(array("" => ""),$edgtIconCollections->getIconCollectionsVCExclude('linea_icons')),
							'save_always' => true,
                        ),
						array(
							"type" => "dropdown",
							"holder" => "div",
							"class" => "",
							"heading" => "Social Style",
							"param_name" => "team_social_style",
							"value" => array(
								"Between Image and Info" => "social_style_between",
								"In the center of the image" => "social_style_center"
							),
							'save_always' => true,
							"description" => "Social Style applies only when Main Info Below Image type is selected",
							"dependency" => array('element' => 'team_social_icon_pack', 'value' => $edgtIconCollections->getIconCollectionsKeys())
						),
						array(
							"type" => "dropdown",
							"holder" => "div",
							"class" => "",
							"heading" => "Social Icons Position",
							"param_name" => "social_icons_position",
							"value" => array(
								"Left" => "left",
								"Center" => "center",
								"Right" => "right"
							),
							'save_always' => true,
							"description" => "Social Icons Position applies only when Main Info Below Image type is selected",
							"dependency" => array('element' => 'team_social_style', 'value' => array("social_style_between"))
						),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Social Icons Type",
                            "param_name" => "team_social_icon_type",
                            "value" => array(
                                "Normal" => "normal_social",
                                "Circle" => "circle_social",
                                "Square" => "square_social"
                            ),
							'save_always' => true,
                            "dependency" => array('element' => 'team_social_icon_pack', 'value' => $edgtIconCollections->getIconCollectionsKeys())
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Social Icons color",
                            "param_name" => "team_social_icon_color",
                            "dependency" => array('element' => 'team_social_icon_pack', 'value' => $edgtIconCollections->getIconCollectionsKeys())
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Social Icons Background Color",
                            "param_name" => "team_social_icon_background_color",
                            "dependency" => array('element' => 'team_social_icon_type', 'value' => array('circle_social', 'square_social'))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Social Icons Border Color",
                            "param_name" => "team_social_icon_border_color",
                            "dependency" => array('element' => 'team_social_icon_type', 'value' => array('circle_social', 'square_social'))
                        )
                    ),
                    $team_social_icons_array,
                    array(
                        array(
                            "type" => "checkbox",
                            "class" => "",
                            "heading" => "Team Member Skills",
                            "value" => array("Show Team Member Skills?" => "yes"),
                            "param_name" => "show_skills",
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Skills Title Size",
                            "param_name" => "skills_title_size",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "First Skill Title",
                            "param_name" => "skill_title_1",
                            "description" => "For example Web design",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "First Skill Percentage",
                            "param_name" => "skill_percentage_1",
                            "description" => "Enter just number, without %",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Second Skill Title",
                            "param_name" => "skill_title_2",
                            "description" => "For example Web design",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Second Skill Percentage",
                            "param_name" => "skill_percentage_2",
                            "description" => "Enter just number, without %",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Third Skill Title",
                            "param_name" => "skill_title_3",
                            "description" => "For example Web design",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Third Skill Percentage",
                            "param_name" => "skill_percentage_3",
                            "description" => "Enter just number, without %",
                            "dependency" => array("element" => "show_skills", "value" => "yes")
                        )
                    )
                )

) );


/*** Service table ***/

vc_map( array(
        "name" => "Service Table",
        "base" => "no_service_table",
        "icon" => "icon-wpb-service-table",
        "category" => 'by EDGE',
        "allowed_container_element" => 'vc_row',
        "params" => array_merge(
                    array(
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Type",
                            "param_name" => "type",
                            "value" => array(		
                                "Icon/Image on Top" 	=> "icon_image_on_top",
                                "Title on Top"  		=> "title_on_top",
                                ),
							'save_always' => true,
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title",
                            "param_name" => "title",
                            "value" => ""
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Title Tag",
                            "param_name" => "title_tag",
                            "value" => array(
                                ""   => "",
                                "h2" => "h2",
                                "h3" => "h3",
                                "h4" => "h4",   
                                "h5" => "h5",   
                                "h6" => "h6",   
                            ),
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Color",
                            "param_name" => "title_color",
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Background Color",
                            "param_name" => "title_background_color",
                            "description" => ""
                        ),
                        array(
                            "type" => "attach_image",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Top Background Image",
                            "param_name" => "top_background_image",
                            "description" => "",
                            "dependency" => array("element" => "type", "value" => array("icon_image_on_top"))
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Small Separator",
                            "param_name" => "title_separator",
                            "value" => array(
                                "No" => "no",
                                "Yes" => "yes"	
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => array("element" => "type", "value" => array("icon_image_on_top"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Separator Color",
                            "param_name" => "title_separator_color",
                            "description" => "",
                            "dependency" => array("element" => "title_separator", "value" => array("yes"))
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Border Bottom",
                            "param_name" => "title_border_bottom",
                            "value" => array(
                                "Yes" => "yes",	
                                "No" => "no"					
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => array("element" => "type", "value" => array("title_on_top"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Border Bottom color",
                            "param_name" => "title_border_bottom_color",
                            "description" => "",
                            "dependency" => array("element" => "title_border_bottom", "value" => array("yes"))
                        ),
                         array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Wide Border Top",
                            "param_name" => "border_top",
                            "value" => array(
                                "Yes" => "yes",	
                                "No" => "no"					
                            ),
							 'save_always' => true,
                            "description" => "",
                            "dependency" => array("element" => "type", "value" => array("title_on_top"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Wide Border Top Color",
                            "param_name" => "border_top_color",
                            "description" => "",
                            "dependency" => array("element" => "border_top", "value" => array("yes"))
                        ),
                        
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Show Icon/Image",
                            "param_name" => "show_icon_image",
                            "value" => array(
                                "Yes" => "yes", 
                                "No" => "no"                    
                            ),
							'save_always' => true,
                            "description" => ""
                        ),  

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Header type",
                            "param_name" => "header_type",
                            "value" => array(
                                "With Icon" => "with_icon",
                                "With Image" => "with_image"   
                            ),
							'save_always' => true,
                            "description" => "",
                            "dependency" => array("element" => "show_icon_image", "value" => array("yes"))
                        )
                    ),
                    $edgtIconCollections->getVCParamsArray(array("element" => "header_type", "value" => array("with_icon"))),
                    array(
                        array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Color",
                        "param_name" => "icon_color",
                        "description" => "",
                        "dependency" => array("element" => "header_type", "value" => array("with_icon"))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Size (px)",
                        "param_name" => "custom_size",
                        "value" => "",
                        "dependency" => array("element" => "header_type", "value" => array("with_icon"))
                    ),
                     array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Header Image",
                        "param_name" => "header_image",
                        "description" => "",
                        "dependency" => array("element" => "header_type", "value" => array("with_image"))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Content Background Color",
                        "param_name" => "content_background_color",
                        "description" => ""
                    ),
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Content Background Image",
                        "param_name" => "content_background_image",
                        "description" => ""
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Border Around",
                        "param_name" => "border",
                        "value" => array(
                            "Default" => "",
                            "No" => "no",
                            "Yes" => "yes"
                        ),
                        "description" => ""
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Border width (px)",
                        "param_name" => "border_width",
                        "value" => "",
                        "dependency" => array('element' => "border", 'value' => array('yes'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Border color",
                        "param_name" => "border_color",
                        "value" => "",
                        "dependency" => array('element' => "border", 'value' => array('yes'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Active",
                        "param_name" => "active",
                        "value" => array(
                            "No" => "no",
                            "Yes" => "yes"	
                        ),
						'save_always' => true,
                        "description" => ""
                    ),
					array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Active Style",
                        "param_name" => "active_style",
                        "value" => array(
                            "Default" => "",
                            "Circle" => "circle",
							"Rectangle" => "rectangle"	
                        ),
                        "description" => "This option is only used for type Icon/Image on Top",
						"dependency" => array('element' => "active", 'value' => array('yes'))
                    ),	
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Active text",
                        "param_name" => "active_text",
                        "description" => "Best choice",
                        "dependency" => array('element' => 'active', 'value' => 'yes')
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Active Text Color",
                        "param_name" => "active_text_color",
                        "dependency" => array('element' => 'active', 'value' => 'yes')
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Active Text Background Color",
                        "param_name" => "active_text_background_color",
                        "dependency" => array('element' => 'active', 'value' => 'yes')
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Content Text Color", 
                        "param_name" => "content_text_color"
                    ),
                    array(
                        "type" => "textarea_html",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Content",
                        "param_name" => "content",
                        "value" => "<li>content content content</li><li>content content content</li><li>content content content</li>",
                        "description" => ""
                    )
                    )
                )
    )
);


/*** Image slider ***/

vc_map( array(
    "name" => "Edge Image Slider",
    "base" => "no_image_slider_no_space",
    "category" => 'by EDGE',
    "icon" => "icon-wpb-image-slider-no-space",
    "allowed_container_element" => 'vc_row',
    "params" => array(
        array(
            "type" => "attach_images",
            "holder" => "div",
            "class" => "",
            "heading" => "Images",
            "param_name" => "images"
        ),
		array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "On click",
            "param_name" => "on_click",
            "value" => array(
                "Do nothing"       			 	=> "",
                "Open image in prettyphoto"     => "prettyphoto",
                "Open image in new tab"			=> "new_tab",
                "Use custom links"				=> "use_custom_links"
            ),
            "description" => ""
        ),
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => "Custom Links",
			"param_name" => "custom_links",
			"value" => "",
			"dependency" => array('element' => 'on_click', 'value' => 'use_custom_links'),
			"description" => "Enter links for each image here. Divide links with comma."
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Custom links target",
			"param_name" => "custom_links_target",
			"value" => array(
				"" => "",
				"Same window" => "_self",
				"New window" => "_blank"
			),
			"dependency" => array('element' => 'on_click', 'value' => 'use_custom_links'),
			"description" => ""
		),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Show info",
            "param_name" => "show_info",
            "value" => array(
                "" => "",
                "On Hover" => "on_hover",
                "In The Bottom Corner" => "in_bottom_corner",
            ),
            "description" => "Show image title and description"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Info position",
            "param_name" => "info_position",
            "value" => array(
                "Bottom Left" => "bottom_left",
                "Bottom Right" => "bottom_right",
            ),
			'save_always' => true,
            "dependency" => array('element' => "show_info", 'value' => array('in_bottom_corner'))
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Background Color",
            "param_name" => "background_color",
            "dependency" => array('element' => "show_info", 'value' => array('on_hover','in_bottom_corner'))
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Title Color",
            "param_name" => "title_color",
            "dependency" => array('element' => "show_info", 'value' => array('on_hover','in_bottom_corner'))
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Title font size (px)",
            "param_name" => "title_font_size",
            "value" => "",
            "dependency" => array('element' => "show_info", 'value' => array('on_hover','in_bottom_corner'))
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Description Color",
            "param_name" => "description_color",
            "dependency" => array('element' => "show_info", 'value' => array('on_hover','in_bottom_corner'))
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Description font size (px)",
            "param_name" => "description_font_size",
            "value" => "",
            "dependency" => array('element' => "show_info", 'value' => array('on_hover','in_bottom_corner'))
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Separator Color",
            "param_name" => "separator_color",
            "dependency" => array('element' => "show_info", 'value' => 'on_hover')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Separator opacity (0-1)",
            "param_name" => "separator_opacity",
            "value" => "",
            "dependency" => array('element' => "show_info", 'value' => 'on_hover')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Full Screen Height",
            "param_name" => "full_screen",
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
			'save_always' => true,
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Slider height (px)",
            "param_name" => "height",
            "value" => "",
            "dependency" => array('element' => 'full_screen', 'value' => 'no')
        ),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Navigation style",
			"param_name" => "navigation_style",
			"value" => array(
				"" => "",
				"Light" => "light",
				"Dark" => "dark"
			)
		),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Highlight Active Image",
            "param_name" => "highlight_active_image",
            "value" => array(
                "" => "",
                "Yes" => "yes",
                "No" => "no"
            )
        ),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Highlight Inactive Color",
            "param_name" => "highlight_inactive_color",
            "dependency" => array('element' => "highlight_active_image", 'value' => 'yes')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Highlight Inactive Opacity (0-1)",
            "param_name" => "highlight_inactive_opacity",
            "value" => "",
            "dependency" => array('element' => "highlight_active_image", 'value' => 'yes')
        )
    )
) );


/*** Countdown ***/

vc_map( array(
    "name" => "Countdown",
    "base" => "no_countdown",
    "category" => 'by EDGE',
    "icon" => "icon-wpb-countdown",
    "allowed_container_element" => 'vc_row',
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Year",
            "param_name" => "year",
            "value" => array(
                "" => "",
                "2014" => "2014",
                "2015" => "2015",
                "2016" => "2016",
                "2017" => "2017",
                "2018" => "2018",
                "2019" => "2019",
                "2020" => "2020"
            ),
			'save_always' => true,
        ),

        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Month",
            "param_name" => "month",
            "value" => array(
                "" => "",
                "January" => "1",
                "February" => "2",
                "March" => "3",
                "April" => "4",
                "May" => "5",
                "June" => "6",
                "July" => "7",
                "August" => "8",
                "September" => "9",
                "October" => "10",
                "November" => "11",
                "December" => "12"
            ),
			'save_always' => true,
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Day",
            "param_name" => "day",
            "value" => array(
                "" => "",
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
                "6" => "6",
                "7" => "7",
                "8" => "8",
                "9" => "9",
                "10" => "10",
                "11" => "11",
                "12" => "12",
                "13" => "13",
                "14" => "14",
                "15" => "15",
                "16" => "16",
                "17" => "17",
                "18" => "18",
                "19" => "19",
                "20" => "20",
                "21" => "21",
                "22" => "22",
                "23" => "23",
                "24" => "24",
                "25" => "25",
                "26" => "26",
                "27" => "27",
                "28" => "28",
                "29" => "29",
                "30" => "30",
                "31" => "31",
            ),
			'save_always' => true,
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Hour",
            "param_name" => "hour",
            "value" => array(
                "" => "",
                "0" => "0",
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
                "6" => "6",
                "7" => "7",
                "8" => "8",
                "9" => "9",
                "10" => "10",
                "11" => "11",
                "12" => "12",
                "13" => "13",
                "14" => "14",
                "15" => "15",
                "16" => "16",
                "17" => "17",
                "18" => "18",
                "19" => "19",
                "20" => "20",
                "21" => "21",
                "22" => "22",
                "23" => "23",
                "24" => "24"
            ),
			'save_always' => true,
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Minute",
            "param_name" => "minute",
            "value" => array(
                "" => "",
                "0" => "0",
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
                "6" => "6",
                "7" => "7",
                "8" => "8",
                "9" => "9",
                "10" => "10",
                "11" => "11",
                "12" => "12",
                "13" => "13",
                "14" => "14",
                "15" => "15",
                "16" => "16",
                "17" => "17",
                "18" => "18",
                "19" => "19",
                "20" => "20",
                "21" => "21",
                "22" => "22",
                "23" => "23",
                "24" => "24",
                "25" => "25",
                "26" => "26",
                "27" => "27",
                "28" => "28",
                "29" => "29",
                "30" => "30",
                "31" => "31",
                "32" => "32",
                "33" => "33",
                "34" => "34",
                "35" => "35",
                "36" => "36",
                "37" => "37",
                "38" => "38",
                "39" => "39",
                "40" => "40",
                "41" => "41",
                "42" => "42",
                "43" => "43",
                "44" => "44",
                "45" => "45",
                "46" => "46",
                "47" => "47",
                "48" => "48",
                "49" => "49",
                "50" => "50",
                "51" => "51",
                "52" => "52",
                "53" => "53",
                "54" => "54",
                "55" => "55",
                "56" => "56",
                "57" => "57",
                "58" => "58",
                "59" => "59",
                "60" => "60",
            ),
			'save_always' => true,
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Month Label",
            "param_name" => "month_label",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Day Label",
            "param_name" => "day_label",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Hour Label",
            "param_name" => "hour_label",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Minute Label",
            "param_name" => "minute_label",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Second Label",
            "param_name" => "second_label",
            "description" => ""
        ),
        array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Month Singular Label",
			"param_name" => "month_singular_label",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Day Singular Label",
			"param_name" => "day_singular_label",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Hour Singular Label",
			"param_name" => "hour_singular_label",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Minute Singular Label",
			"param_name" => "minute_singular_label",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Second Singular Label",
			"param_name" => "second_singular_label",
			"description" => ""
		),
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Color",
            "param_name" => "color",
            "description" => "For digits, labels and separators",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Digit Font Size (px)",
            "param_name" => "digit_font_size",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Label Font Size (px)",
            "param_name" => "label_font_size",
            "description" => ""
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Font Weight",
            "param_name" => "font_weight",
            "description" => "For both digits and labels",
            "value" => array(
                "Default" => "",
                "Thin 100" => "100",
                "Extra-Light 200" => "200",
                "Light 300" => "300",
                "Regular 400" => "400",
                "Medium 500" => "500",
                "Semi-Bold 600" => "600",
                "Bold 700" => "700",
                "Extra-Bold 800" => "800",
                "Ultra-Bold 900" => "900"
            )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Show separator",
            "param_name" => "show_separator",
            "value" => array(
                "No" => "hide_separator",
                "Yes" => "show_separator"
            ),
			'save_always' => true,
        ),
    )
) );


/*** Separator with Icon ***/

vc_map( array(
    "name" => "Separator with Icon",
    "base" => "no_separator_with_icon",
    "category" => 'by EDGE',
    "icon" => "icon-wpb-separator-with-icon",
    "allowed_container_element" => 'vc_row',
    "params" => array_merge(
                array(
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Separator Line Style",
                        "param_name" => "border_style",
                        "value" => array(
                            "Solid" => "solid",
                            "Dashed" => "dashed",
                            "Dotted" => "dotted",
                            "Transparent" => "transparent"
                        ),
						'save_always' => true,
                        "description" => "Choose a style for the separator line"
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Line Color",
                        "param_name" => "color",
                        "value" => "",
                        "description" => "Choose a color for the separator line"
                    ), 
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Line Width (px)",
                        "param_name" => "width",
                        "value" => "",
                        "description" => "Insert width for the separator line"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Line Thickness (px)",
                        "param_name" => "thickness",
                        "value" => "",
                        "description" => "Insert thickness for the separator line"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Top Margin (px)",
                        "param_name" => "up",
                        "value" => "",
                        "description" => "Insert top margin for the separator"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Bottom Margin (px)",
                        "param_name" => "down",
                        "value" => "",
                        "description" => "Insert bottom margin for the separator"
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Type",
                        "param_name" => "type",
                        "value" => array(
                            "Default Icon" => "with_icon",
                            "Custom Icon" => "with_custom_icon"
                        ),
						'save_always' => true,
                        "description" => "Choose a style for the separator line"
                    ),
                ),
                $edgtIconCollections->getVCParamsArray(array('element' => "type", 'value' => array('with_icon'))),
                array(
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Custom Size (px)",
                        "param_name" => "icon_custom_size",
                        "value" => "",
                        "description" => "Insert size for the icon (default value is 20)",
                        "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Type",
                        "param_name" => "icon_type",
                        "value" => array(
                            "Normal" => "normal",
                            "Circle" => "circle",
                            "Square" => "square"
                        ),
						'save_always' => true,
                        "description" => "Choose icon type",
                        "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                    ),
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Custom Icon",
                        "param_name" => "custom_icon",
                        "dependency" => Array('element' => "type", 'value' => array('with_custom_icon'))
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Position",
                        "param_name" => "separator_icon_position",
                        "value" => array(
                            "Center" => "center",
                            "Left" => "left",
                            "Right" => "right"
                        ),
						'save_always' => true,
                        "description" => "Choose position of the icon"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Margins",
                        "param_name" => "icon_margin",
                        "description" => "Insert left and right icon margins"
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Border radius",
                        "param_name" => "icon_border_radius",
                        "description" => __("Insert border radius(Rounded corners) in px. For example: 4. Leave empty for default. ", 'edgt'),
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Shape Size (px)",
                        "param_name" => 'icon_shape_size',
                        "value" => "",
                        "description" => "Insert size for a shape around the icon",
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Color",
                        "param_name" => "icon_color",
                        "description" => "Choose a color for the icon",
                        "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Border Color",
                        "param_name" => "icon_border_color",
                        "description" => "Choose a color for the border around the icon shape",
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),
                    array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Border Width",
                        "param_name" => "icon_border_width",
                        "description" => "Insert border width (just number, omit pixels)",
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Background Color",
                        "param_name" => "icon_background_color",
                        "description" => "Choose a background color for the icon shape",
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Hover Icon Color",
                        "param_name" => "hover_icon_color",
                        "description" => "Choose a hover color for the icon",
                        "dependency" => Array('element' => "type", 'value' => array('with_icon'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Hover Border Color",
                        "param_name" => "hover_icon_border_color",
                        "description" => "Choose a hover color for the border around the icon shape",
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Icon Hover Background Color",
                        "param_name" => "hover_icon_background_color",
                        "description" => "Choose a background hover color for the icon shape",
                        "dependency" => Array('element' => "icon_type", 'value' => array('circle','square'))
                    ),array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => "Link",
                        "param_name" => "link",
                        "description" => ""
						),
						array(
						"type" => "checkbox",
						"class" => "",
						"heading" => "Use Link as Anchor",
						"value" => array("Use this icon as Anchor?" => "yes"),
						"param_name" => "icon_anchor",
						"description" => "Check this box to use icon as anchor link (eg. #contact)",
						"dependency" => Array('element' => "link", 'not_empty' => true)
						),
						array(
							"type" => "dropdown",
							"holder" => "div",
							"class" => "",
							"heading" => "Target",
							"param_name" => "target",
							"value" => array(
								"Self" => "_self",
								"Blank" => "_blank"
							),
							'save_always' => true,
							"description" => "",
							"dependency" => Array('element' => "link", 'not_empty' => true)
					)
                )
            )

) );


/*** Clients ***/

class WPBakeryShortCode_No_Clients  extends WPBakeryShortCodesContainer {}
vc_map( array(
        "name" => "Edge Clients", "edgt",
        "base" => "no_clients",
        "as_parent" => array('only' => 'no_client'),
        "content_element" => true,
		"category" => 'by EDGE',
		"icon" => "icon-wpb-clients",
        "show_settings_on_create" => true,
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Columns",
                "param_name" => "columns",
                "value" => array(
                    "Two"       => "two_columns",
                    "Three"     => "three_columns",
                    "Four"      => "four_columns",
                    "Five"      => "five_columns",
                    "Six"       => "six_columns"
                ),
				'save_always' => true,
                "description" => ""
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Show borders",
				"param_name" => "client_borders",
				"description" => "",
				"value" => array(
					"Yes"      => "yes",
					"No"      => "no"
				),
			),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Space between clients",
                "param_name" => "space_between_clients",
                "description" => "When yes, space will be 10px",
                "value" => array(
                    "No"      => "no",
                    "Yes"      => "yes"
                ),
				'save_always' => true,
            )
        ),
        "js_view" => 'VcColumnView'
) );


/*** Client ***/

class WPBakeryShortCode_No_Client extends WPBakeryShortCode {}
vc_map( array(
        "name" => "Edge Client", "edgt",
        "base" => "no_client",
        "content_element" => true,
		"icon" => "icon-wpb-client",
        "as_child" => array('only' => 'no_clients'),
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => "Image",
                "param_name" => "image"
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Link",
                "param_name" => "link"
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Link Target",
                "param_name" => "link_target",
                "value" => array(
                    "" => "",
                    "Self" => "_self",
                    "Blank" => "_blank"
                )
            )
        )
) );


/*** Circles ***/

class WPBakeryShortCode_No_Circles  extends WPBakeryShortCodesContainer {}
vc_map( array(
        "name" => "Edge Process Holder", "edgt",
        "base" => "no_circles",
        "as_parent" => array('only' => 'no_circle'),
        "content_element" => true,
		"category" => 'by EDGE',
		"icon" => "icon-wpb-circles",
        "show_settings_on_create" => true,
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => "Columns",
                "param_name" => "columns",
                "value" => array(
                    "Three"     => "three_columns",
                    "Four"      => "four_columns",
                    "Five"      => "five_columns",
                    "Six"      =>  "six_columns"
                ),
				'save_always' => true,
                "description" => ""
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Lines between items?",
				"param_name" => "lines_between",
				"description" => "",
				"value" => array(
					"Default"     => "",
					"No"      => "no",
					"Yes"      => "yes"
				),
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Line Color",
				"param_name" => "line_color",
				"description" => ""
			),			
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Process Item Height (px)",
				"param_name" => "process_height",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Process Item Width (px)",
				"param_name" => "process_width",
				"description" => ""
			)
        ),
        "js_view" => 'VcColumnView'
) );


/*** Circle ***/

class WPBakeryShortCode_No_Circle extends WPBakeryShortCode {}
vc_map( array(
        "name" => "Edge Process", "edgt",
        "base" => "no_circle",
        "content_element" => true,
		"icon" => "icon-wpb-circle",
        "as_child" => array('only' => 'no_circles'),
        "params" => array_merge(
                    array(
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Type",
                            "param_name" => "type",
                            "value" => array(
                                "Icon in Process" => "icon_type",
                                "Image" => "image_type",	
                                "Text in Process" => "text_type",
                                "Image with Text" => "image_with_text_type"
                            ),
							'save_always' => true,
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Background Process Color",
                            "param_name" => "background_color",
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Background Process Transparency",
                            "param_name" => "background_transparency",
                            "description" => "Insert value between 0 and 1"
                        ),
                        array(
                            "type" => "checkbox",
                            "class" => "",
                            "heading" => "",
                            "value" => array("Without outer border?" => "yes"),
                            "param_name" => "without_double_border",
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Border Process Color",
                            "param_name" => "border_color",
                            "description" => ""
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Border Process Width",
                            "param_name" => "border_width",
                            "description" => ""
                        )
                    ),
                    $edgtIconCollections->getVCParamsArray( array( 'element' => 'type', 'value' => array( 'icon_type' ) ) ),
                    array(
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Size",
                            "param_name" => "size",
                            "description" => "Enter just number. Omit px",
                            "dependency" => array('element' => "type", 'value' => array("icon_type"))
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Icon Color",
                            "param_name" => "icon_color",
                            "dependency" => array('element' => "type", 'value' => array("icon_type"))
                        ),
                        array(
                            "type" => "attach_image",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Image",
                            "param_name" => "image",
                            "dependency" => array('element' => "type", 'value' => array("image_type", "image_with_text_type"))
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text in Process",
                            "param_name" => "text_in_circle",
                            "dependency" => array('element' => "type", 'value' => array("text_type", "image_with_text_type"))
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Text in Process Tag",
                            "param_name" => "text_in_circle_tag",
                            "value" => array(
                                ""   => "",
                                "h2" => "h2",
                                "h3" => "h3",
                                "h4" => "h4",	
                                "h5" => "h5",	
                                "h6" => "h6",	
                            ),
                            "description" => "",
                            "dependency" => array('element' => "text_in_circle", 'not_empty' => true)
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text in Process Size (px)",
                            "param_name" => "font_size",
                            "dependency" => array('element' => "text_in_circle", 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text in Process Color",
                            "param_name" => "text_in_circle_color",
                            "description" => "",
                            "dependency" => array('element' => "text_in_circle", 'not_empty' => true)
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Link",
                            "param_name" => "link",
                            "description" => ""
                        ),
                        array(
                            "type" => "dropdown",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Link Target",
                            "param_name" => "link_target",
                            "value" => array(
                                "" => "",
                                "Self" => "_self",
                                "Blank" => "_blank"
                            ),
                            "description" => "",
                            "dependency" => array('element' => "link", 'not_empty' => true)
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title",
                            "param_name" => "title",
                            "description" => ""
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Title Tag",
                            "param_name" => "title_tag",
                            "value" => array(
                                ""   => "",
                                "h2" => "h2",
                                "h3" => "h3",
                                "h4" => "h4",	
                                "h5" => "h5",	
                                "h6" => "h6",	
                            ),
                            "description" => "",
                            "dependency" => array('element' => "title", 'not_empty' => true)
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Title Color",
                            "param_name" => "title_color",
                            "description" => "",
                            "dependency" => array('element' => "title", 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Title Alignment",
                            "param_name" => "title_alignment",
                            "value" => array(
                                ""   => "",
                                "Left" => "title_left",
                                "Center" => "title_center",
                                "Right" => "title_right"
                            ),
                            "description" => "",
                            "dependency" => array('element' => "title", 'not_empty' => true)
                        ),
                        array(
                            "type" => "textarea",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text",
                            "param_name" => "text",
                            "description" => ""
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Text Color",
                            "param_name" => "text_color",
                            "description" => "",
                            "dependency" => array('element' => "text", 'not_empty' => true)
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => "Text Alignment",
                            "param_name" => "text_alignment",
                            "value" => array(
                                ""   => "",
                                "Left" => "text_left",
                                "Center" => "text_center",
                                "Right" => "text_right"
                            ),
                            "description" => "",
                            "dependency" => array('element' => "text", 'not_empty' => true)
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Space between circle and title",
                            "param_name" => "title_margin_top",
                            "description" => "Enter just number. Omit px (default value is 24)"
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => "Space between title and text",
                            "param_name" => "text_margin_top",
                            "description" => "Enter just number. Omit px (default value is 5)"
                        )
                    )
                )
) );


/*** Elements Holder ***/

class WPBakeryShortCode_No_Elements_Holder  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" =>  __( 'Edge Elements Holder', 'edgt' ),
    "base" => "no_elements_holder",
    "as_parent" => array('only' => 'no_elements_holder_item'),
    "content_element" => true,
    "category" => 'by EDGE',
    "icon" => "icon-wpb-elements-holder",
    "show_settings_on_create" => true,
    "js_view" => 'VcColumnView',
	"params" => array(
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Background Color",
			"param_name" => "background_color",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Columns",
			"param_name" => "number_of_columns",
			"value" => array(
                "1 Column"      => "one_column",
				"2 Columns"    	=> "two_columns",
				"3 Columns"     => "three_columns",
				"4 Columns"      => "four_columns",
				"5 Columns"      => "five_columns",
				"6 Columns"      => "six_columns"
			),
			'save_always' => true,
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"holder" => "div",
			"class" => "",
			"heading" => "Items Float Left",
			"param_name" => "items_float_left",
			"value" => array("Make Items Float Left?" => "yes"),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Switch to One Column",
			"param_name" => "switch_to_one_column",
			"value" => array(
				"Default"    		=> "",
				"Below 1300px" 		=> "1300",
				"Below 1000px"    	=> "1000",
				"Below 768px"     	=> "768",
				"Below 600px"    	=> "600",
				"Below 480px"    	=> "480",
				"Never"    			=> "never"
			),
			"description" => "Choose on which stage item will be in one column"
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Choose Alignment In Responsive Mode",
			"param_name" => "alignment_one_column",
			"value" => array(
				"Default"    	=> "",
				"Left" 			=> "left",
				"Center"    	=> "center",
				"Right"     	=> "right"
			),
			"description" => "Alignment When Items are in One Column"
		)
	)
) );


/*** Elements Holder Item ***/

class WPBakeryShortCode_No_Elements_Holder_Item  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" =>  __( 'Edge Elements Holder Item', 'edgt' ),
    "base" => "no_elements_holder_item",
    "as_parent" => array('except' => 'vc_row, vc_tabs, vc_accordion, no_cover_boxes, no_portfolio_list, no_portfolio_slider, no_carousel'),
    "as_child" => array('only' => 'no_elements_holder'),
    "content_element" => true,
    "category" => 'by EDGE',
    "icon" => "icon-wpb-elements-holder-item",
    "show_settings_on_create" => true,
    "js_view" => 'VcColumnView',
	"params" => array(
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => "Background Color",
			"param_name" => "background_color",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "div",
			"class" => "",
			"heading" => "Background Image",
			"param_name" => "background_image",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Padding",
			"param_name" => "item_padding",
			"value" => "",
			"description" => "Please insert padding in format 0px 10px 0px 10px"
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Alignment",
			"param_name" => "aligment",
			"value" => array(
				"Left"    	=> "left",
				"Right"     => "right",
				"Center"      => "center"
			),
			'save_always' => true,
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Vertical Alignment",
			"param_name" => "vertical_alignment",
			"value" => array(
				"Default"    	=> "",
				"Top"    	=> "top",
				"Middle"    => "middle",
				"Bottom"    => "bottom"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => "Animation Name",
			"param_name" => "animation_name",
			"value" => array(
				"No Animation"     => "",
				"Flip In"     => "flip_in",
				"Grow In"     => "grow_in",
				"X Rotate"    => "x_rotate",
				"Z Rotate"    => "z_rotate",
				"Y Translate" => "y_translate",
				"Fade In"		=> "fade_in",
				"Fade In Down" => "fade_in_down",
				"Fade In Left X Rotate" => "fade_in_left_x_rotate"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => "Animation Delay (ms)",
			"param_name" => "animation_delay",
			"value" => "",
			"description" => "",
			"dependency" => array('element' => "animation_name", 'value' => array('flip_in', 'grow_in', 'x_rotate','z_rotate','y_translate','fade_in', 'fade_in_down', 'fade_in_left_x_rotate'))
		),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Advanced Animations",
            "param_name" => "advanced_animations",
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
			'save_always' => true,
            "description" => ""
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Animation Start Position",
            "param_name" => "start_position",
            "value" => array(
                'Bottom of Page' => 'bottom',
                'Center of Page' => 'center'
            ),
			'save_always' => true,
            "description" => "",
            "dependency" => array("element" => "advanced_animations", "value" => array("yes"))
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Start Animation Style",
            "param_name" => "start_animation_style",
            "description" => "",
            "dependency" => array("element" => "advanced_animations", "value" => array("yes"))
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Animation End Position",
            "param_name" => "end_position",
            "value" => array(
                "Center of Page" => "center",
                "Top of Page" => "top-bottom"
            ),
			'save_always' => true,
            "description" => "",
            "dependency" => array("element" => "advanced_animations", "value" => array("yes"))
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "End Animation Style",
            "param_name" => "end_animation_style",
            "description" => "",
            "dependency" => array("element" => "advanced_animations", "value" => array("yes"))
        ),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Padding on screen size between 1000px-1300px",
			"param_name" => "item_padding_1000_1300",
			"value" => "",
			"description" => "Please insert padding in format 0px 10px 0px 10px"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Padding on screen size between 768px-1000px",
			"param_name" => "item_padding_768_1000",
			"value" => "",
			"description" => "Please insert padding in format 0px 10px 0px 10px"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Padding on screen size between 600px-768px",
			"param_name" => "item_padding_600_768",
			"value" => "",
			"description" => "Please insert padding in format 0px 10px 0px 10px"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Padding on screen size between 480px-600px",
			"param_name" => "item_padding_480_600",
			"value" => "",
			"description" => "Please insert padding in format 0px 10px 0px 10px"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"group" => "Width & Responsiveness",
			"heading" => "Padding on Screen Size Bellow 480px",
			"param_name" => "item_padding_480",
			"value" => "",
			"description" => "Please insert padding in format 0px 10px 0px 10px"
		)
	)
) );


/*** Vertical Split Slider ***/

class WPBakeryShortCode_No_Vertical_Split_Slider  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" =>  __( 'Edge Vertical Split Slider', 'edgt' ),
    "base" => "no_vertical_split_slider",
    "as_parent" => array('only' => 'no_vertical_left_sliding_panel,no_vertical_right_sliding_panel'),
    "content_element" => true,
    "category" => 'by EDGE',
    "icon" => "icon-wpb-vertical-split-slider",
    "show_settings_on_create" => true,
    "js_view" => 'VcColumnView',
    "params" => array(
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Preloader Background Color",
            "param_name" => "background_color",
            "value" => "",
            "description" => ""
        )
    )
) );


/*** Vertical Split Slider Left Panel ***/

class WPBakeryShortCode_No_Vertical_Left_Sliding_Panel  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" =>  __( 'Left Sliding Panel', 'edgt' ),
    "base" => "no_vertical_left_sliding_panel",
    "as_parent" => array('only' => 'no_vertical_slide_content_item'),
    "as_child" => array('only' => 'no_vertical_split_slider'),
    "content_element" => true,
    "category" => 'by EDGE',
    "icon" => "icon-wpb-vertical-split-slider-left-panel",
    "show_settings_on_create" => false,
    "js_view" => 'VcColumnView',
	'params' => array()
) );


/*** Vertical Split Slider Right Panel ***/

class WPBakeryShortCode_No_Vertical_Right_Sliding_Panel  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" =>  __( 'Right Sliding Panel', 'edgt' ),
    "base" => "no_vertical_right_sliding_panel",
    "as_parent" => array('only' => 'no_vertical_slide_content_item'),
    "as_child" => array('only' => 'no_vertical_split_slider'),
    "content_element" => true,
    "category" => 'by EDGE',
    "icon" => "icon-wpb-vertical-split-slider-right-panel",
    "show_settings_on_create" => false,
    "js_view" => 'VcColumnView',
	'params' => array()
) );


/*** Vertical Split Slider Content Item ***/

class WPBakeryShortCode_No_Vertical_Slide_Content_Item  extends WPBakeryShortCodesContainer {}
vc_map( array(
    "name" =>  __( 'Slide Content Item', 'edgt' ),
    "base" => "no_vertical_slide_content_item",
    "as_parent" => array('except' => 'vc_row, vc_tabs, vc_accordion, no_cover_boxes, no_portfolio_list, no_portfolio_slider, no_carousel'),
    "as_child" => array('only' => 'no_vertical_left_sliding_panel, no_vertical_right_sliding_panel'),
    "content_element" => true,
    "category" => 'by EDGE',
	"icon" => "icon-wpb-vertical-split-slider-content-item",
    "show_settings_on_create" => true,
    "js_view" => 'VcColumnView',
    "params" => array(
        array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => "Background Color",
            "param_name" => "background_color",
            "value" => "",
            "description" => ""
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => "Background Image",
            "param_name" => "background_image",
            "value" => "",
            "description" => ""
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => "Padding left/right",
            "param_name" => "item_padding",
            "value" => "",
            "description" => "Please insert padding in format '10px'"
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Content Aligment",
            "param_name" => "alignment",
            "value" => array(
                "left"    	=> "left",
                "right"     => "right",
                "center"      => "center"
            ),
			'save_always' => true,
            "description" => ""
        ),
		array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => "Header Style",
            "param_name" => "header_style",
            "value" => array(
                ""	=>	"",
                "Light"	=>	"light",
                "Dark"	=>	"dark"
            ),
            "description" => ""
        )

    )
) );

/*** Contact Form 7 ***/

if(edgt_contact_form_7_installed()){
	vc_add_param("contact-form-7", array(
		"type" => "dropdown",
		"class" => "",
		"heading" => "Style",
		"param_name" => "html_class",
		"value" => array(
			"Default"				=> "default",
			"Custom Style 1"		=> "cf7_custom_style_1",
			"Custom Style 2"		=> "cf7_custom_style_2",
			"Custom Style 3"		=> "cf7_custom_style_3"
		),
		'save_always' => true,
		"description" => "You can style each form element individually in Edge Options > Contact Form 7"
	));
}