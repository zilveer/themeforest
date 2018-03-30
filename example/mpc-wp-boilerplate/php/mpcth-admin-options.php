<?php

/**
 * The theme option name is set as 'options-theme-customizer' here.
 * In your own project, you should use a different option name.
 * I'd recommend using the name of your theme.
 *
 * This option name will be used later when we set up the options
 * for the front end theme customizer.
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 */

function mpcth_optionsframework_option_name() {
	global $mpcth_options_name;

	$mpcth_optionsframework_settings = get_option('mpcth_optionsframework');

	$mpcth_optionsframework_settings['id'] = $mpcth_options_name;
	update_option('mpcth_optionsframework', $mpcth_optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

function mpcth_optionsframework_options() {

	$default_values = array(

		/* GLOBAL */

		'enabledResponsive'				=> '',
		'topMenu'						=> '',
		'topRibbon'						=> '',
		'pageSize'						=> '960px',
		'pageAlign'						=> 'left',

		// logo

		'useTextLogo'					=> '0',
		'textLogo'						=> 'Example',
		'logoDescription'				=> '1',

		/* FONT SIZES */

		// headings
		'h1'							=> '22px',
		'h2' 							=> '20px',
		'h3' 							=> '18px',
		'h4' 							=> '16px',
		'h5' 							=> '14px',
		'h6' 							=> '12px',

		// global
		'defaultFontSize' 				=> '12px',

		// small: meta etc.
		'smallFontSize'					=> '12px',

		// menu
		'menuFontSize'					=> '16px',
		'menuDropFontSize'				=> '16px',

		// footer
		'footerFontSize'				=> '',
		'footerHeadingSize'				=> '',

		// sidebar
		'sidebarFontSize'				=> '12px',
		'sidebarHeadingSize'			=> '16px',

		// sidebar
		'topWidgetFontSize'				=> '12px',
		'topWidgetHeadingSize'			=> '16px',

		// forms
		'formsFontSize'					=> '12px',

		// buttons
		'buttonFontSize'				=> '12px',

		// read more
		'readmoreFontSize'				=> '14px',

		// load more
		'loadmoreFontSize'				=> '14px',

		// category filter
		'categoryFilterFontSize'		=> '11px',

		/* GLOBAL COLORS */

		'headingColor'					=> '#333333',
		'bodyColor'						=> '#666666',
		'linkColor'						=> '#666666',
		'hoverColor'					=> '#888888',
		'altLinkColor'					=> '#888888',
		'altHoverColor'					=> '#666666',

		'defaultBorderColor'			=> '#F5F5F5',
		'defaultBorderCornerColor'		=> '#222222',

		/* BACKGROUNDS */

		'headerBG'						=> '#FFFFFF',
		'wrapBG'						=> 'transparent',
		'footerBG'						=> '',
		'sidebarBG'						=> '#ffffff',
		'contentBG'						=> '#ffffff',
		'postBG'						=> '#ffffff',
		'commentBG'						=> '#ffffff',
		'menuBGColor'					=> '#ffffff',
		'menuDropBG'					=> '#ffffff',
		'topMenuBG'						=> '',
		'topRibbonBG'					=> '',
		'topWidgetAreaBG' 				=> '#222222',
		'searchPageBG' 					=> '#F5F5F5',

		/* POST FORMATS BACKGROUND */

		// 'formatStandard'				=> '#AB59C0',
		// 'formatImage'					=> '#009AD7',
		// 'formatGallery'					=> '#0ACC78',
		// 'formatVideo'					=> '#F5506C',
		// 'formatAudio'					=> '#00BC9E',
		// 'formatQuote'					=> '#6761EF',
		// 'formatStatus'					=> '#00BCC9',
		// 'formatAside'					=> '#ED7740',
		// 'formatLink'					=> '#F7C238',

		// 'formatStandardHover'			=> '#9E53B2',
		// 'formatImageHover'				=> '#0090C9',
		// 'formatGalleryHover'			=> '#09BF70',
		// 'formatVideoHover'				=> '#E84C66',
		// 'formatAudioHover'				=> '#00AD90',
		// 'formatQuoteHover'				=> '#605CE0',
		// 'formatStatusHover'				=> '#00B0BA',
		// 'formatAsideHover'				=> '#DD703E',
		// 'formatLinkHover'				=> '#E8B535',

		/* PORTFOLIO FORMATS BACKGROUND */

		// 'portfolioFormatStandard'		=> '#AB59C0',
		// 'portfolioFormatImage'			=> '#009AD7',
		// 'portfolioFormatGallery'		=> '#0ACC78',
		// 'portfolioFormatVideo'			=> '#F5506C',
		// 'portfolioFormatAudio'			=> '#00BC9E',

		// 'portfolioFormatStandardHover'	=> '#9E53B2',
		// 'portfolioFormatImageHover'		=> '#0090C9',
		// 'portfolioFormatGalleryHover'	=> '#09BF70',
		// 'portfolioFormatVideoHover'		=> '#E84C66',
		// 'portfolioFormatAudioHover'		=> '#00AD90',

		/* GALLERY FORMATS BACKGROUND */

		// 'galleryFormatStandard'			=> '#AB59C0',
		// 'galleryFormatImage'			=> '#009AD7',
		// 'galleryFormatGallery'			=> '#0ACC78',
		// 'galleryFormatVideo'			=> '#F5506C',
		// 'galleryFormatAudio'			=> '#00BC9E',

		// 'galleryFormatStandardHover'	=> '#9E53B2',
		// 'galleryFormatImageHover'		=> '#0090C9',
		// 'galleryFormatGalleryHover'		=> '#09BF70',
		// 'galleryFormatVideoHover'		=> '#E84C66',
		// 'galleryFormatAudioHover'		=> '#00AD90',

		/* LOGO */

		'logoFontColor'					=> '#222222',
		'logoBG'						=> 'transparent',
		'descriptionFontColor'			=> '#CBCBCB',
		'descriptionBG'					=> 'transparent',

		/* MAIN MENU */

		// top - normal
		'menuFontColor'					=> '#222222',
		'menuItemBG'					=> 'transparent',

		// top - hover
		'menuFontHoverColor'			=> '#FFFFFF',
		'menuItemBGHover'				=> '#222222',

		// drop down - normal
		'menuDropFontColor'				=> '#222222',
		'menuDropItemBG'				=> '#FFFFFF',

		// drop down - hover
		'menuDropFontHoverColor'		=> '#FFFFFF',
		'menuDropItemBGHover'			=> '#222222',

		/* TOP MENU */

		// normal
		'topMenuFontColor'				=> '',
		'topMenuItemBG'					=> '',

		// hover
		'topMenuFontHover' 				=> '',
		'topMenuItemBGHover' 			=> '',

		/* COMMENT FORM */

		// levels
		// 'commentFirstLevelStripe'		=> '#0082B6',
		// 'commentSecondLevelStripe'		=> '#0ACC78',
		// 'commentThirdLevelStripe'		=> '#F7C238',
		// 'commentForthLevelStripe'		=> '#ED7740',

		// normal
		'commentFormFontColor'			=> '#666666',
		'commentFormItemBG'				=> '#F5F5F5',
		'commentFormBorder'				=> '',

		// hover
		'commentFormFontHoverColor'		=> '#666666',
		'commentFormItemBGHover'		=> '#F0F0F0',
		'commentFormBorderHover'		=> '',

		// error
		'commentFormFontErrorColor'		=> '#FFFFFF',
		'commentFormItemBGError'		=> '#222222',
		'commentFormBorderError'		=> '',

		'commentFormLabelError'			=> '#222222',

		/* Contact Form */

		// normal
		'contactFormFontColor'			=> '#666666',
		'contactFormItemBG'				=> '#F5F5F5',
		'contactFormBorder'				=> '',

		// hover
		'contactFormFontHoverColor'		=> '#666666',
		'contactFormItemBGHover'		=> '#F0F0F0',
		'contactFormBorderHover'		=> '',

		// error
		'contactFormFontErrorColor'		=> '#FFFFFF',
		'contactFormItemBGError'		=> '#222222',
		'contactFormBorderError'		=> '',

		'contactFormLabelError'			=> '#222222',
		'contactFormLabelSuccess'		=> '#47a46f',

		/* BUTTON TOGGLER */

		// normal
		'togglerFontColor'				=> '#222222',
		'togglerItemBG'					=> '#F5F5F5',

		// hover
		'togglerFontHoverColor'			=> '#666666',
		'togglerItemBGHover'			=> '#F5F5F5',

		/* BUTTON SUBMIT */

		// normal
		'submitFontColor'				=> '#666666',
		'submitItemBG'					=> '#F7C238',
		'submitBorder'					=> '',

		// hover
		'submitFontHoverColor'			=> '#444444',
		'submitItemBGHover'				=> '#F7C238',
		'submitBorderHover'				=> '',

		/* TABS */

		'tabsHeadingColor'				=> '#666666',
		'tabsHeadingColorBG'			=> 'transparent',
		'tabsHeadingColorHover'			=> '#222222',
		'tabsHeadingColorBGHover'		=> 'transparent',

		'tabsContentColor'				=> '#666666',
		'tabsContentColorBG'			=> 'transparent',

		/* BLOG & PORTFOLIO */

		// meta
		'thumbColor'					=> '#ffffff',
		'metaColor'						=> '#CCCCCC',

		// read more
		'readmoreColor'					=> '#333333',
		'readmoreHoverColor'			=> '#666666',

		// load more
		'loadmoreColor'					=> '#FFFFFF',
		'loadmoreColorBG'				=> '#222222',
		'loadmoreHoverColor'			=> '#F5F5F5',
		'loadmoreHoverColorBG'			=> '#222222',

		// lightbox icon
		'lightboxIcon'					=> '#FFFFFF',
		'lightboxIconHover'				=> '#F5F5F5',

		// category filter
		'categoryFilterFont'			=> '#666666',
		'categoryFilterBG'				=> 'transparent',

		'categoryFilterFontHover'		=> '#FFFFFF',
		'categoryFilterBGHover'			=> '#222222',

		/* OTHER */

		// hr line
		'hrColor'						=> '#F5F5F5',
		'hrLabelColor'					=> '#FFFFFF',
		'hrFontColor'					=> '#666666',

		// sidebar
		'sidebarHeading'				=> '#333333',
		'sidebarFontColor'				=> '#666666',

		// footer
		'footerHeading'					=> '',
		'footerFontColor'				=> '',

		// top widget area
		'topWidgetAreaHeading'			=> '#FFFFFF',
		'topWidgetAreaFontColor'		=> '#FFFFFF',

		// social icon bg
		'socialIconBgColor' 			=> '',

		// comment author
		'authorFont'					=> '#888888',
		'authorBG'						=> '',

		// tooltip
		'tooltipFont'					=> '#FFFFFF',
		'tooltipBG'						=> '#222222',

		// search
		'searchFont'					=> '#222222',
		'searchBG'						=> '#F5F5F5',

		// share
		'enableShare'					=> '0',

		/* Sidebars */
		'defaultSidebar'				=> 'none',
		'defaultPostSidebar'			=> 'none',
		'defaultPortfolioSidebar'		=> 'none',
		'defaultGallerySidebar'			=> 'none',
		'defaultSearchSidebar'			=> 'none',
		'defaultArchiveSidebar'			=> 'none',

		/* Footer */
		'showFooter'					=> '',
		'footerColNum'					=> '',
		'showBottomFooter'				=> '1',
		'copyrightText'					=> 'Copyright MassivePixelCreation 2013',
		'copyrightTextFont'				=> '#CBCBCB',

		/* Top Widget Area */
		'widgetArea'					=> '1',
		'widgetAreaColNum'				=> '3'
	);

	// page align
	$page_align = array(
		"left" => "left",
		"center" => "center",
		"right" => "right"
	);

	$background_options = array(
		"pattern_background" => "pattern background",
		"custom_background" => "custom background",
		"embed_background" => "embed background",
		"none" => "none"
	);

	// footer columns
	$footer_columns = array(
		"1" => "1",
		"2" => "2",
		"3" => "3",
		"4" => "4",
		"5" => "5"
	);

	$background_options = array(
		"pattern_background" => "pattern background",
		"custom_background" => "custom background",
		"embed_background" => "embed background",
		"none" => "none"
	);

	// path: MPC_THEME_ROOT . '/mpc-wp-boilerplate/images/ . 'patterns/pattern1.png'
	$background_patterns = array(
		'patterns/pattern01.png' => 'patterns/pattern01.png',
		'patterns/pattern02.png' => 'patterns/pattern02.png',
		'patterns/pattern03.png' => 'patterns/pattern03.png',
		'patterns/pattern04.png' => 'patterns/pattern04.png',
		'patterns/pattern05.png' => 'patterns/pattern05.png',
		'patterns/pattern06.png' => 'patterns/pattern06.png',
		'patterns/pattern07.png' => 'patterns/pattern07.png',
		'patterns/pattern08.png' => 'patterns/pattern08.png',
		'patterns/pattern09.png' => 'patterns/pattern09.png',
		'patterns/pattern10.png' => 'patterns/pattern10.png',
		'patterns/pattern11.png' => 'patterns/pattern11.png',
		'patterns/pattern12.png' => 'patterns/pattern12.png'
	);

	$options = array();

/* ---------------------------------------------------------------- */
/* General
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 	=> __("General", 'mpcth'),
		"icon" 	=> "mpcth-sc-icon-cog",
		"type" 	=> "heading" );

/* ---------------------------------------------------------------- */
/* Main
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 	=> __("Main", 'mpcth'),
		"type" 	=> "accordion");

	if(isset($default_values['enabledResponsive']) && $default_values['enabledResponsive'] != '') {
		$options['mpcth_reponsive'] = array(
			"id" 	=> "mpcth_reponsive",
			"name" 	=> __("Enable Responsive", 'mpcth'),
			"desc" 	=> __("Check this option to enable responsive mode of your theme. Flex slider is the only responsive slider.", 'mpcth'),
			"type" 	=> "checkbox",
			"std" 	=> $default_values['enabledResponsive'] );
	}

	if(isset($default_values['topMenu']) && $default_values['topMenu'] != '') {
		$options['mpcth_basic_top_menu'] = array(
			"id" 	=> "mpcth_basic_top_menu",
			"name" 	=> __("Top Menu", 'mpcth'),
			"desc" 	=> __('Check to enable top menu.', 'mpcth'),
			"type" 	=> "checkbox",
			"std" 	=> $default_values['topMenu'] );
	}

	if(isset($default_values['topRibbon']) && $default_values['topRibbon'] != '') {
		$options['mpcth_basic_top_ribbon'] = array(
			"id" 	=> "mpcth_basic_top_ribbon",
			"name" 	=> __("Top Ribbon", 'mpcth'),
			"desc" 	=> __('Check to enable top ribbon.', 'mpcth'),
			"type" 	=> "checkbox",
			"std" 	=> $default_values['topRibbon'] );
	}

	$options['mpcth_contact_email'] = array(
		"id" 	=> "mpcth_contact_email",
		"name" 	=> __("Contact e-Mail", 'mpcth'),
		"desc" 	=> __('Specify e-mail address for your contact forms.', 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	if(isset($default_values['pageSize']) && $default_values['pageSize'] != '') {
		$options['mpcth_page_size'] = array(
		 	"id" 	=> "mpcth_page_size",
		 	"name" 	=> __("Default Page Size", 'mpcth'),
		 	"desc" 	=> __("Define default page size in percents.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['pageSize'],
		 	"min" 	=> "768",
		 	"max" 	=> "1920" );
	}

	if(isset($default_values['pageAlign']) && $default_values['pageAlign'] != '') {
		$options['mpcth_page_align'] = array(
			"id" 		=> "mpcth_page_align",
			"name" 		=> __("Default Page Align", 'mpcth'),
			"desc" 		=> __("Define default page alignment.", 'mpcth'),
			"type" 		=> "select",
			"std" 		=> $default_values['pageAlign'],
			"options" 	=> $page_align );
	}

/* ---------------------------------------------------------------- */
/* Sidebar
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 	=> __("Sidebar", 'mpcth'),
		"type" 	=> "accordion");

	if(isset($default_values['defaultSidebar']) && $default_values['defaultSidebar'] != '') {
		$options['mpcth_sidebar'] = array(
			"id" 		=> "mpcth_sidebar",
			"name" 		=> __("Default Sidebar Position", 'mpcth'),
			"desc" 		=> __("Set the default sidebar position for all of the pages, you can choose between: right, none and left.", 'mpcth'),
			"type" 		=> "sidebar",
			"std" 		=> $default_values['defaultSidebar'],
			"options" 	=> array('right' => 'right',
								'none' => 'none',
								'left' => 'left'));
	}

	if(isset($default_values['defaultPostSidebar']) && $default_values['defaultPostSidebar'] != '') {
		$options['mpcth_blog_post_sidebar'] = array(
			"id" 		=> "mpcth_blog_post_sidebar",
			"name" 		=> __("Default Blog Post Sidebar Position", 'mpcth'),
			"desc" 		=> __("Set the default sidebar position for all of blog posts, you can choose between: right, none and left.", 'mpcth'),
			"type" 		=> "sidebar",
			"std" 		=> $default_values['defaultPostSidebar'],
			"options" 	=> array('right' => 'right',
										'none' => 'none',
										'left' => 'left'));
	}

	// if(isset($default_values['defaultPortfolioSidebar']) && $default_values['defaultPortfolioSidebar'] != '') {
	// 	$options['mpcth_portfolio_post_sidebar'] = array(
	// 		"id"		=> "mpcth_portfolio_post_sidebar",
	// 		"name" 		=> __("Default Portfolio Post Sidebar Position", 'mpcth'),
	// 		"desc" 		=> __("Set the default sidebar position for all of portfolio posts, you can choose between: right, none and left.", 'mpcth'),
	// 		"type" 		=> "sidebar",
	// 		"std" 		=> $default_values['defaultPortfolioSidebar'],
	// 		"options" 	=> array('right' => 'right',
	// 							'none' => 'none',
	// 							'left' => 'left'));
	// }

	if(isset($default_values['defaultSearchSidebar']) && $default_values['defaultSearchSidebar'] != '') {
		$options['mpcth_search_sidebar'] = array(
			"id" 		=> "mpcth_search_sidebar",
			"name" 		=> __("Default Search Sidebar Position", 'mpcth'),
			"desc" 		=> __("Set the default sidebar position for search section, you can choose between: right, none and left.", 'mpcth'),
			"type" 		=> "sidebar",
			"std" 		=> $default_values['defaultSearchSidebar'],
			"options" 	=> array('right' => 'right',
									'none' => 'none',
									'left' => 'left'));
	}

	if(isset($default_values['defaultArchiveSidebar']) && $default_values['defaultArchiveSidebar'] != '') {
		$options['mpcth_archive_sidebar'] = array(
			"id" 		=> "mpcth_archive_sidebar",
			"name" 		=> __("Default Archive Sidebar Position", 'mpcth'),
			"desc" 		=> __("Set the default sidebar position for archive section, you can choose between: right, none and left.", 'mpcth'),
			"type" 		=> "sidebar",
			"std" 		=> $default_values['defaultArchiveSidebar'],
			"options" 	=> array('right' => 'right',
								'none' => 'none',
								'left' => 'left'));
	}

/* ---------------------------------------------------------------- */
/* Footer
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 	=> __("Footer", 'mpcth'),
		"type" 	=> "accordion");

	if(isset($default_values['showFooter']) && $default_values['showFooter'] != '') {
		$options['mpcth_show_footer'] = array(
			"id" 				=> "mpcth_show_footer",
			"name" 				=> __("Show Footer", 'mpcth'),
			"desc" 				=> __("Uncheck this option to hide footer.", 'mpcth'),
			"type" 				=> "checkbox",
			"std" 				=> $default_values['showFooter'],
			"additional_fun" 	=> "hide",
			"hide_class" 		=> "number_of_columns" );
	}

	if(isset($default_values['footerColNum']) && $default_values['footerColNum'] != '') {
		$options['mpcth_footer_columns'] = array(
			"id" 		=> "mpcth_footer_columns",
			"name" 		=> __("Default Number of Footer Columns", 'mpcth'),
			"desc" 		=> __("Specify default number of footer columns.", 'mpcth'),
			"class" 	=> "number_of_columns",
			"type" 		=> "select",
			"std" 		=> $default_values['footerColNum'],
			"options" 	=> $footer_columns );
	}

	if(isset($default_values['showBottomFooter']) && $default_values['showBottomFooter'] != '') {
		$options['mpcth_show_copyright'] = array(
			"id" 				=> "mpcth_show_copyright",
			"name" 				=> __("Show Bottom Footer", 'mpcth'),
			"desc" 				=> __("Uncheck this option to hide copyright/social section below the footer.", 'mpcth'),
			"type" 				=> "checkbox",
			"std" 				=> $default_values['showBottomFooter'],
			"additional_fun" 	=> "hide",
			"hide_class" 		=> "mpcth_copyright" );
	}

	if(isset($default_values['copyrightText']) && $default_values['copyrightText'] != '') {
		$options['mpcth_copyright_text'] = array(
			"id" 		=> "mpcth_copyright_text",
			"name" 		=> __("Copyright Text", 'mpcth'),
			"desc" 		=> __("Specify your copyright.", 'mpcth'),
			"class" 	=> "mpcth_copyright",
			"type" 		=> "text-big",
			"std" 		=> $default_values['copyrightText']);
	}

/* ---------------------------------------------------------------- */
/* Top Widget Area
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 	=> __("Top Widget Area", 'mpcth'),
		"type" 	=> "accordion");

	if(isset($default_values['widgetArea']) && $default_values['widgetArea'] != '') {
		$options['mpcth_top_widget_area'] = array(
			"id"				=> "mpcth_top_widget_area",
			"name"				=> __("Top Widget Area", 'mpcth'),
			"desc"				=> __("Check to enable top widget area.", 'mpcth'),
			"type"				=> "checkbox",
			"std"				=> $default_values['widgetArea'],
			"additional_fun" 	=> "hide",
			"hide_class" 		=> "mpcth_top_widget_area_columns" );
	}

	if(isset($default_values['widgetAreaColNum']) && $default_values['widgetAreaColNum'] != '') {
		$options['mpcth_top_widget_area_columns'] = array(
			"id" 		=> "mpcth_top_widget_area_columns",
			"name" 		=> __("Number of Top Widget Area Columns", 'mpcth'),
			"desc" 		=> __("Specify number of top widget area columns.", 'mpcth'),
			"class" 	=> "mpcth_top_widget_area_columns",
			"type" 		=> "select",
			"std" 		=> $default_values['widgetAreaColNum'],
			"options" 	=> $footer_columns );
	}

/* ---------------------------------------------------------------- */
/* Google Analytics
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Google Analytics", 'mpcth'),
		"type" => "accordion");

	$options['mpcth_analytics'] = array(
		"id" 				=> "mpcth_analytics",
		"name" 				=> __("Enable Google Analytics", 'mpcth'),
		"desc" 				=> __("Check this option to enable google analytics.", 'mpcth'),
		"type" 				=> "checkbox",
		"std" 				=> "0",
		"additional_fun" 	=> "hide",
		"hide_class" 		=> "mpcth_analytics_code" );

	$options['mpcth_analytics_code'] = array(
		"id" 		=> "mpcth_analytics_code",
		"name" 		=> __("Google Analytics Code", 'mpcth'),
		"desc" 		=> __('Insert your google analytics code, for more information read <a href="https://support.google.com/analytics/bin/answer.py?hl=en&utm_medium=et&utm_campaign=en_us&utm_source=SetupChecklist&answer=1008080">this</a>. Don\'t worry that your script tags where removed, they will be added automatically.', 'mpcth'),
		"type" 		=> "textarea-big",
		"std" 		=> "",
		"class" 	=> "mpcth_analytics_code" );

/* ---------------------------------------------------------------- */
/* Fav Icon
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Fav Icon", 'mpcth'),
		"type" => "accordion");

	$options['mpcth_fav'] = array(
		"id" 				=> "mpcth_fav",
		"name" 				=> __("Enable Fav Icon", 'mpcth'),
		"desc" 				=> __("Check this option to enable fav icon.", 'mpcth'),
		"type" 				=> "checkbox",
		"std" 				=> "0",
		"additional_fun" 	=> "hide",
		"hide_class" 		=> "mpcth_fav_icon" );

	$options['mpcth_fav_icon'] = array(
		"id" 	=> "mpcth_fav_icon",
		"name" 	=> __("Upload Fav Icon", 'mpcth'),
		"desc" 	=> __("Use the upload to upload your custom fav icon. To learn more about the Fav Icon please read <a href='http://en.wikipedia.org/wiki/Favicon' target='_blank'>this article</a>.", 'mpcth'),
		"class" => "mpcth_fav_icon",
		"type" 	=> "upload" );

/* ---------------------------------------------------------------- */
/* Fonts
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Fonts", 'mpcth'),
		"icon" => "mpcth-sc-icon-language",
		"type" => "heading" );

/* ---------------------------------------------------------------- */
/* Font Family
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Font Family", 'mpcth'),
		"type" => "accordion");

	$options['mpcth_menu_font'] = array(
		"id" 	=> "mpcth_menu_font",
		"name" 	=> __("Menu Font", 'mpcth'),
		"desc" 	=> __("Specify menu font.", 'mpcth'),
		"type" 	=> "font_select",
		"std" 	=> "default" );

	$options['mpcth_heading_font'] = array(
		"id" 	=> "mpcth_heading_font",
		"name" 	=> __("Heading Font", 'mpcth'),
		"desc" 	=> __("Specify headings font.", 'mpcth'),
		"type" 	=> "font_select",
		"std" 	=> "default" );

	$options['mpcth_content_font'] = array(
		"id" 	=> "mpcth_content_font",
		"name" 	=> __("Content Font", 'mpcth'),
		"desc" 	=> __("Specify content font.", 'mpcth'),
		"type" 	=> "font_select",
		"std" 	=> "default" );

	$options['mpcth_small_font'] = array(
		"id" 	=> "mpcth_small_font",
		"name" 	=> __("Small Font", 'mpcth'),
		"desc" 	=> __("Specify small font.", 'mpcth'),
		"type" 	=> "font_select",
		"std" 	=> "default" );

/* ---------------------------------------------------------------- */
/* Font Size
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Font Size", 'mpcth'),
		"type" => "accordion");

	if(isset($default_values['defaultFontSize']) && $default_values['defaultFontSize'] != '') {
		$options['mpcth_content_font_size'] = array(
		 	"id" 	=> "mpcth_content_font_size",
		 	"name" 	=> __("Content Font Size", 'mpcth'),
		 	"desc" 	=> __("Content font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['defaultFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['smallFontSize']) && $default_values['smallFontSize'] != '') {
		$options['mpcth_small_font_size'] = array(
		 	"id" 	=> "mpcth_small_font_size",
		 	"name" 	=> __("Small Font Size", 'mpcth'),
		 	"desc" 	=> __("Define font size for small elements like meta data.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['smallFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['h1']) && $default_values['h1'] != '') {
		$options['mpcth_h1_font_size'] = array(
		 	"id" 	=> "mpcth_h1_font_size",
		 	"name" 	=> __("H1 Font Size", 'mpcth'),
		 	"desc" 	=> __("H1 font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['h1'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['h2']) && $default_values['h2'] != '') {
		$options['mpcth_h2_font_size'] = array(
		 	"id" 	=> "mpcth_h2_font_size",
		 	"name" 	=> __("H2 Font Size", 'mpcth'),
		 	"desc" 	=> __("H2 font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['h2'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['h3']) && $default_values['h3'] != '') {
		$options['mpcth_h3_font_size'] = array(
		 	"id" 	=> "mpcth_h3_font_size",
		 	"name" 	=> __("H3 Font Size", 'mpcth'),
		 	"desc" 	=> __("H3 font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['h3'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['h4']) && $default_values['h4'] != '') {
		$options['mpcth_h4_font_size'] = array(
		 	"id" 	=> "mpcth_h4_font_size",
		 	"name" 	=> __("H4 Font Size", 'mpcth'),
		 	"desc" 	=> __("H4 font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['h4'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['h5']) && $default_values['h5'] != '') {
		$options['mpcth_h5_font_size'] = array(
		 	"id" 	=> "mpcth_h5_font_size",
		 	"name" 	=> __("H5 Font Size", 'mpcth'),
		 	"desc" 	=> __("H5 font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['h5'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['h6']) && $default_values['h6'] != '') {
		$options['mpcth_h6_font_size'] = array(
		 	"id" 	=> "mpcth_h6_font_size",
		 	"name" 	=> __("H6 Font Size", 'mpcth'),
		 	"desc" 	=> __("H6 font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['h6'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['menuFontSize']) && $default_values['menuFontSize'] != '') {
		$options['mpcth_menu_font_size'] = array(
		 	"id" 	=> "mpcth_menu_font_size",
		 	"name" 	=> __("Menu Font Size", 'mpcth'),
		 	"desc" 	=> __("Menu font size.", 'mpcth'),
	 	 	"type" 	=> "slider",
		 	"std" 	=> $default_values['menuFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}
	if(isset($default_values['menuDropFontSize']) && $default_values['menuDropFontSize'] != '') {
		$options['mpcth_menu_drop_font_size'] = array(
		 	"id" 	=> "mpcth_menu_drop_font_size",
		 	"name" 	=> __("Menu Drop Down Font Size", 'mpcth'),
		 	"desc" 	=> __("Menu drop down font size.", 'mpcth'),
	 	 	"type" 	=> "slider",
		 	"std" 	=> $default_values['menuDropFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['footerFontSize']) && $default_values['footerFontSize'] != '') {
		$options['mpcth_footer_font_size'] = array(
		 	"id" 	=> "mpcth_footer_font_size",
		 	"name" 	=> __("Footer Font Size", 'mpcth'),
		 	"desc" 	=> __("Footer font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['footerFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['footerHeadingSize']) && $default_values['footerHeadingSize'] != '') {
		$options['mpcth_footer_heading_font_size'] = array(
		 	"id" 	=> "mpcth_footer_heading_font_size",
		 	"name" 	=> __("Footer Heading Font Size", 'mpcth'),
		 	"desc" 	=> __("Footer heading font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['footerHeadingSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['sidebarFontSize']) && $default_values['sidebarFontSize'] != '') {
		$options['mpcth_sidebar_font_size'] = array(
		 	"id" 	=> "mpcth_sidebar_font_size",
		 	"name" 	=> __("Sidebar Font Size", 'mpcth'),
		 	"desc" 	=> __("Sidebar font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['sidebarFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['sidebarHeadingSize']) && $default_values['sidebarHeadingSize'] != '') {
		$options['mpcth_sidebar_heading_font_size'] = array(
		 	"id" 	=> "mpcth_sidebar_heading_font_size",
		 	"name" 	=> __("Sidebar Heading Font Size", 'mpcth'),
		 	"desc" 	=> __("Sidebar heading font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['sidebarHeadingSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['topWidgetFontSize']) && $default_values['topWidgetFontSize'] != '') {
		$options['mpcth_top_widget_font_size'] = array(
		 	"id" 	=> "mpcth_top_widget_font_size",
		 	"name" 	=> __("Top Widget Area Font Size", 'mpcth'),
		 	"desc" 	=> __("Top Widget Area font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['topWidgetFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['topWidgetHeadingSize']) && $default_values['topWidgetHeadingSize'] != '') {
		$options['mpcth_top_widget_heading_font_size'] = array(
		 	"id" 	=> "mpcth_top_widget_heading_font_size",
		 	"name" 	=> __("Top Widget Area Heading Font Size", 'mpcth'),
		 	"desc" 	=> __("Top Widget Area heading font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['topWidgetHeadingSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['formsFontSize']) && $default_values['formsFontSize'] != '') {
		$options['mpcth_form_font_size'] = array(
		 	"id" 	=> "mpcth_form_font_size",
		 	"name" 	=> __("Form Font Size", 'mpcth'),
		 	"desc" 	=> __("Contact form & comment form font size.", 'mpcth'),
		 	"type" 	=> "slider",
			"std" 	=> $default_values['formsFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['buttonFontSize']) && $default_values['buttonFontSize'] != '') {
		$options['mpcth_button_font_size'] = array(
		 	"id" 	=> "mpcth_button_font_size",
		 	"name" 	=> __("Button Font Size", 'mpcth'),
		 	"desc" 	=> __("Contact form & comment form button font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['buttonFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['readmoreFontSize']) && $default_values['readmoreFontSize'] != '') {
		$options['mpcth_more_font_size'] = array(
		 	"id" 	=> "mpcth_more_font_size",
		 	"name" 	=> __("Read More Font Size", 'mpcth'),
		 	"desc" 	=> __("Read more button font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['readmoreFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['loadmoreFontSize']) && $default_values['loadmoreFontSize'] != '') {
		$options['mpcth_loadmore_font_size'] = array(
		 	"id" 	=> "mpcth_loadmore_font_size",
		 	"name" 	=> __("Load More Font Size", 'mpcth'),
		 	"desc" 	=> __("Load more button font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['loadmoreFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

	if(isset($default_values['categoryFilterFontSize']) && $default_values['categoryFilterFontSize'] != '') {
		$options['mpcth_cat_filter_font_size'] = array(
		 	"id" 	=> "mpcth_cat_filter_font_size",
		 	"name" 	=> __("Category Filter Font Size", 'mpcth'),
		 	"desc" 	=> __("Cateogry filter font size.", 'mpcth'),
		 	"type" 	=> "slider",
		 	"std" 	=> $default_values['categoryFilterFontSize'],
		 	"min" 	=> "8",
		 	"max" 	=> "58" );
	}

/* ---------------------------------------------------------------- */
/* Font upload
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 	=> __("Font Upload", 'mpcth'),
		"type" 	=> "accordion");

	$options['mpcth_font_upload'] = array(
		"id" 	=> "mpcth_font_upload",
		"name" 	=> __("Font Upload", 'mpcth'),
		"desc" 	=> __("Use this field if you want to upload unique font, it will appear in the Font Familly section.", 'mpcth'),
		"type" 	=> "font_upload",
		"std" 	=> "" );

/* ---------------------------------------------------------------- */
/* Elements
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Elements", 'mpcth'),
		"icon" => "mpcth-sc-icon-rocket",
		"type" => "heading" );

/* ---------------------------------------------------------------- */
/* Logo
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Logo", 'mpcth'),
		"type" => "accordion");

	if(isset($default_values['useTextLogo']) && $default_values['useTextLogo'] != '') {
		$options['mpcth_use_text_logo'] = array(
			"id" 	=> "mpcth_use_text_logo",
			"name" 	=> __("Use Text Logo", 'mpcth'),
			"desc" 	=> __("Check it if you want to use text logo.", 'mpcth'),
			"type" 	=> "checkbox",
			"std" 	=> $default_values['useTextLogo'] );
	}

	$options['mpcth_logo'] = array(
		"id" 	=> "mpcth_logo",
		"name" 	=> __("Upload Logo", 'mpcth'),
		"desc" 	=> __("Upload your logo here.", 'mpcth'),
		"type" 	=> "upload",
		"std"	=> MPC_THEME_ROOT."/mpc-wp-boilerplate/images/example.png" );


	if(isset($default_values['textLogo']) && $default_values['textLogo'] != '') {
		$options['mpcth_text_logo'] = array(
			"id" 	=> "mpcth_text_logo",
			"name" 	=> __("Text", 'mpcth'),
			"desc" 	=> __('Specify your site logo text.', 'mpcth'),
			"type" 	=> "text",
			"std" 	=> $default_values['textLogo'] );
	}

	$options['mpcth_text_logo_description'] = array(
		"id" 	=> "mpcth_text_logo_description",
		"name" 	=> __("Description", 'mpcth'),
		"desc" 	=> __('Specify if the description (tagline) for your site should be displayed next to a logo.', 'mpcth'),
		"type" 	=> "checkbox",
		"std" 	=> "1" );

	$options['mpcth_logo_top'] = array(
	 	"id" 	=> "mpcth_logo_top",
	 	"name" 	=> __("Top Margin", 'mpcth'),
	 	"desc" 	=> __("Set logo top margin.", 'mpcth'),
	 	"type" 	=> "slider",
	 	"std" 	=> "50px",
	 	"min" 	=> "0",
	 	"max" 	=> "200" );

	$options['mpcth_logo_right'] = array(
	 	"id" 	=> "mpcth_logo_right",
	 	"name" 	=> __("Right Margin", 'mpcth'),
	 	"desc" 	=> __("Set logo right margin.", 'mpcth'),
	 	"type" 	=> "slider",
	 	"std" 	=> "0px",
	 	"min" 	=> "0",
	 	"max" 	=> "200" );

	$options['mpcth_logo_bottom'] = array(
		"id" 	=> "mpcth_logo_bottom",
	 	"name" 	=> __("Bottom Margin", 'mpcth'),
	 	"desc" 	=> __("Set logo bottom margin.", 'mpcth'),
	 	"type" 	=> "slider",
	 	"std" 	=> "0px",
	 	"min" 	=> "0",
	 	"max" 	=> "200" );

	$options['mpcth_logo_left'] = array(
	 	"id" 	=> "mpcth_logo_left",
	 	"name" 	=> __("Left Margin", 'mpcth'),
	 	"desc" 	=> __("Set logo left margin.", 'mpcth'),
	 	"type" 	=> "slider",
	 	"std" 	=> "0px",
	 	"min" 	=> "0",
	 	"max" 	=> "200" );

/* ---------------------------------------------------------------- */
/* Background
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Background", 'mpcth'),
		"type" => "accordion");

	$options['mpcth_background_type'] = array(
		"id" 				=> "mpcth_background_type",
		"name" 				=> __("Type", 'mpcth'),
		"desc" 				=> __("Select background type for your site.", 'mpcth'),
		"type" 				=> "select",
		"std" 				=> "none",
		"options" 			=> $background_options,
		"additional_fun" 	=> "hide",
		"options_class" 	=> array('mpcth_pattern_opt', 'mpcth_custom_opt', 'mpcth_embed_opt', 'mpcth_none_opt') );

	$options['mpcth_background_pattern'] = array(
		"id" 				=> "mpcth_background_pattern",
		"name" 				=> __("Background Pattern", 'mpcth'),
		"desc" 				=> __("Choose background pattern for your site. This is a work in progress. There is are some issues with how the front end customizer saves checkbox options, and how the Options Framework does. Bear with me a bit while I work on a solution.", 'mpcth'),
		"class" 			=> "mpcth_pattern_opt",
		"type" 				=> "images",
		"std" 				=> "patterns/pattern01.png",
		"options" 			=> $background_patterns);

	$options['mpcth_custom_bg'] = array(
		"id" 	=> "mpcth_custom_bg",
		"name" 	=> __("Upload Background", 'mpcth'),
		"desc" 	=> __("Upload your background here.", 'mpcth'),
		"class" => "mpcth_custom_opt",
		"type" 	=> "upload" );

	$options['mpcth_repeat_background'] = array(
		"id" 	=> "mpcth_repeat_background",
		"name" 	=> __("Repeat Background", 'mpcth'),
		"desc" 	=> __("Check this option if you want to use your custom background as pattern.", 'mpcth'),
		"class" => "mpcth_custom_opt",
		"type" 	=> "checkbox",
		"std" 	=> "1" );

	$options['mpcth_embed_bg'] = array(
		"id" 	=> "mpcth_embed_bg",
		"name" 	=> __("Embed Source", 'mpcth'),
		"desc" 	=> __("Specify the link to your embed background (Vimeo, Youtube, Maps).", 'mpcth'),
		"class" => "mpcth_embed_opt",
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_toggle_background'] = array(
		"id" 	=> "mpcth_toggle_background",
		"name" 	=> __("Toggle Background", 'mpcth'),
		"desc" 	=> __("Check this option if you want to display background toggle button.", 'mpcth'),
		"class" => "mpcth_pattern_opt mpcth_custom_opt mpcth_embed_opt",
		"type" 	=> "checkbox",
		"std" 	=> "1" );

/* ---------------------------------------------------------------- */
/* Social
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Social Networks", 'mpcth'),
		"type" => "accordion");

	$options['mpcth_social_dribbble'] = array(
		"id" 	=> "mpcth_social_dribbble",
		"name" 	=> __("Dribbble", 'mpcth'),
		"desc" 	=> __("Specify the link to your Dribbble account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_facebook'] = array(
		"id" 	=> "mpcth_social_facebook",
		"name" 	=> __("Facebook", 'mpcth'),
		"desc" 	=> __("Specify the link to your Facebook account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_flickr'] = array(
		"id" 	=> "mpcth_social_flickr",
		"name" 	=> __("Flickr", 'mpcth'),
		"desc" 	=> __("Specify the link to your Flickr account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_lastfm'] = array(
		"id" 	=> "mpcth_social_lastfm",
		"name" 	=> __("LastFM", 'mpcth'),
		"desc" 	=> __("Specify the link to your LastFM account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_linkedin'] = array(
		"id" 	=> "mpcth_social_linkedin",
		"name" 	=> __("LinkedIn", 'mpcth'),
		"desc" 	=> __("Specify the link to your LinkedIn account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_rss'] = array(
		"id" 	=> "mpcth_social_rss",
		"name" 	=> __("RSS", 'mpcth'),
		"desc" 	=> __("Specify the link to your RSS, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_stumbleupon'] = array(
		"id" 	=> "mpcth_social_stumbleupon",
		"name" 	=> __("Stumble Upon", 'mpcth'),
		"desc" 	=> __("Specify the link to your Stumble Upon account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_picasa'] = array(
		"id" 	=> "mpcth_social_picasa",
		"name" 	=> __("Picasa", 'mpcth'),
		"desc" 	=> __("Specify the link to your Picasa account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_tumblr'] = array(
		"id" 	=> "mpcth_social_tumblr",
		"name" 	=> __("Tumblr", 'mpcth'),
		"desc" 	=> __("Specify the link to your Tumblr account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_twitter'] = array(
		"id" 	=> "mpcth_social_twitter",
		"name" 	=> __("Twitter", 'mpcth'),
		"desc" 	=> __("Specify the link to your Twitter account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_gplus'] = array(
		"id" 	=> "mpcth_social_gplus",
		"name" 	=> __("Google Plus", 'mpcth'),
		"desc" 	=> __("Specify the link to your Google Plus account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_mail'] = array(
		"id" 	=> "mpcth_social_mail",
		"name" 	=> __("Email", 'mpcth'),
		"desc" 	=> __("Specify your email address, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_pinterest'] = array(
		"id" 	=> "mpcth_social_pinterest",
		"name" 	=> __("Pinterest", 'mpcth'),
		"desc" 	=> __("Specify the link to your Pinterest account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_vimeo'] = array(
		"id" 	=> "mpcth_social_vimeo",
		"name" 	=> __("Vimeo", 'mpcth'),
		"desc" 	=> __("Specify the link to your Vimeo account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

	$options['mpcth_social_instagram'] = array(
		"id" 	=> "mpcth_social_instagram",
		"name" 	=> __("Instagram", 'mpcth'),
		"desc" 	=> __("Specify the link to your Instagram account, if you don't want to use this icon just leave this field blank.", 'mpcth'),
		"type" 	=> "text",
		"std" 	=> "" );

/* ---------------------------------------------------------------- */
/* Social Share
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Social Shares", 'mpcth'),
		"type" => "accordion");

	if(isset($default_values['enableShare']) && $default_values['enableShare'] != '') {
		$options['mpcth_share'] = array(
			"id" 				=> "mpcth_share",
			"name" 				=> __("Enable Share", 'mpcth'),
			"desc" 				=> __("Check this option to enable share options inside blog posts and portfolio items. For the share feature to work correctly please intall the ZillaShare plugin.", 'mpcth'),
			"type" 				=> "checkbox",
			"std" 				=> $default_values['enableShare'],
			"additional_fun" 	=> "hide",
			"hide_class" 		=> "social_shares" );
	}

/* ---------------------------------------------------------------- */
/* Color
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" => __("Colors", 'mpcth'),
		"icon" => "mpcth-sc-icon-palette",
		"type" => "heading" );

/* ---------------------------------------------------------------- */
/* Global
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Global", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Global Colors", 'mpcth'));

	if(isset($default_values['bodyColor']) && $default_values['bodyColor'] != '') {
		$options['mpcth_color_global_body'] = array(
			"id" 	=> "mpcth_color_global_body",
			"name" 	=> __("Body Color", 'mpcth'),
			"desc" 	=> __("Specify body font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['bodyColor'] );
	}

	if(isset($default_values['headingColor']) && $default_values['headingColor'] != '') {
		$options['mpcth_color_global_heading'] = array(
			"id" 	=> "mpcth_color_global_heading",
			"name" 	=> __("Headings Color", 'mpcth'),
			"desc" 	=> __("Specify headings font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['headingColor'] );
	}

	if(isset($default_values['linkColor']) && $default_values['linkColor'] != '') {
		$options['mpcth_color_global_link'] = array(
			"id" 	=> "mpcth_color_global_link",
			"name" 	=> __("Link Color", 'mpcth'),
			"desc" 	=> __("Specify link font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['linkColor'] );
	}

	if(isset($default_values['hoverColor']) && $default_values['hoverColor'] != '') {
		$options['mpcth_color_global_linkhover'] = array(
			"id" 	=> "mpcth_color_global_linkhover",
			"name" 	=> __("Link Hover Color", 'mpcth'),
			"desc" 	=> __("Specify link font color after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['hoverColor'] );
	}

	if(isset($default_values['altLinkColor']) && $default_values['altLinkColor'] != '') {
		$options['mpcth_color_global_alt_link'] = array(
			"id" 	=> "mpcth_color_global_alt_link",
			"name" 	=> __("Alternative Link Color", 'mpcth'),
			"desc" 	=> __("Specify alternative link font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['altLinkColor'] );
	}

	if(isset($default_values['altHoverColor']) && $default_values['altHoverColor'] != '') {
		$options['mpcth_color_global_alt_linkhover'] = array(
			"id" 	=> "mpcth_color_global_alt_linkhover",
			"name" 	=> __("Alternative Link Hover Color", 'mpcth'),
			"desc" 	=> __("Specify alternative link font color after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['altHoverColor'] );
	}

/* ---------------------------------------------------------------- */
/* Background
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name"					 => __("Background", 'mpcth'),
		"type"					 => "accordion",
		"visual_panel"			 => "true",
		"visual_panel_title"	 => __("Background Colors", 'mpcth'));

	if(isset($default_values['headerBG']) && $default_values['headerBG'] != '') {
		$options['mpcth_color_bg_header'] = array(
			"id"	=> "mpcth_color_bg_header",
			"name"	=> __("Aside Background", 'mpcth'),
			"desc"	=> __("Specify left side background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['headerBG'] );
	}

	if(isset($default_values['wrapBG']) && $default_values['wrapBG'] != '') {
		$options['mpcth_color_bg_main'] = array(
			"id"	=> "mpcth_color_bg_main",
			"name"	=> __("Content Wrap Background", 'mpcth'),
			"desc"	=> __("Specify content background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['wrapBG'] );
	}

	if(isset($default_values['footerBG']) && $default_values['footerBG'] != '') {
		$options['mpcth_color_bg_footer'] = array(
			"id"	=> "mpcth_color_bg_footer",
			"name"	=> __("Footer Background", 'mpcth'),
			"desc"	=> __("Specify footer background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['footerBG'] );
	}

	if(isset($default_values['sidebarBG']) && $default_values['sidebarBG'] != '') {
		$options['mpcth_color_bg_sidebar'] = array(
			"id"	=> "mpcth_color_bg_sidebar",
			"name"	=> __("Sidebar Background", 'mpcth'),
			"desc"	=> __("Specify sidebar background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['sidebarBG'] );
	}

	if(isset($default_values['contentBG']) && $default_values['contentBG'] != '') {
		$options['mpcth_color_bg_container'] = array(
			"id"	=> "mpcth_color_bg_container",
			"name"	=> __("Container Background", 'mpcth'),
			"desc"	=> __("Specify container background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['contentBG'] );
	}

	if(isset($default_values['postBG']) && $default_values['postBG'] != '') {
		$options['mpcth_color_bg_post'] = array(
			"id"	=> "mpcth_color_bg_post",
			"name"	=> __("Post Background", 'mpcth'),
			"desc"	=> __("Specify post container background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['postBG'] );
	}

	if(isset($default_values['commentBG']) && $default_values['commentBG'] != '') {
		$options['mpcth_color_bg_comment'] = array(
			"id"	=> "mpcth_color_bg_comment",
			"name"	=> __("Comment Background", 'mpcth'),
			"desc"	=> __("Specify comment background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['commentBG'] );
	}

	// if(isset($default_values['menuBGColor']) && $default_values['menuBGColor'] != '') {
	// 	$options['mpcth_mainmenu_bg'] = array(
	// 		"id"	=> "mpcth_mainmenu_bg",
	// 		"name"	=> __("Main Menu Background", 'mpcth'),
	// 		"desc"	=> __("Specify main menu background color.", 'mpcth'),
	// 		"type"	=> "color",
	// 		"std"	=> $default_values['menuBGColor'] );
	// }

	if(isset($default_values['menuDropBG']) && $default_values['menuDropBG'] != '') {
		$options['mpcth_mainmenu_drop_bg'] = array(
			"id"	=> "mpcth_mainmenu_drop_bg",
			"name"	=> __("Main Menu Drop Down Background", 'mpcth'),
			"desc"	=> __("Specify main menu drop down background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuDropBG'] );
	}

	if(isset($default_values['topMenuBG']) && $default_values['topMenuBG'] != '') {
		$options['mpcth_color_tm_bg'] = array(
			"id"	=> "mpcth_color_tm_bg",
			"name"	=> __("Top Menu Background", 'mpcth'),
			"desc"	=> __("Specify top menu background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['topMenuBG'] );
	}

	if(isset($default_values['topRibbonBG']) && $default_values['topRibbonBG'] != '') {
		$options['mpcth_color_tm_bg'] = array(
			"id"	=> "mpcth_color_tr_bg",
			"name"	=> __("Top Ribbon Background", 'mpcth'),
			"desc"	=> __("Specify top ribbon background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['topRibbonBG'] );
	}

	if(isset($default_values['topWidgetAreaBG']) && $default_values['topWidgetAreaBG'] != '') {
		$options['mpcth_top_widget_bg'] = array(
			"id" 	=> "mpcth_top_widget_bg",
			"name" 	=> __("Top Widget Area Background", 'mpcth'),
			"desc"	=> __("Specify top widget area background color.", 'mpcth'),
			"type" 	=> "color",
			"std"	=> $default_values['topWidgetAreaBG'] );
	}

	if(isset($default_values['searchPageBG']) && $default_values['searchPageBG'] != '') {
		$options['mpcth_search_bg'] = array(
			"id"	=> "mpcth_search_bg",
			"name"	=> __("Search Background", 'mpcth'),
			"desc"	=> __("Specify search heading background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['searchPageBG'] );
	}

/* ---------------------------------------------------------------- */
/* Main Menu
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name"					 => __("Main Menu", 'mpcth'),
		"type"					 => "accordion",
		"visual_panel"			 => "true",
		"visual_panel_title"	 => __("Main Menu Colors", 'mpcth'));

	if(isset($default_values['menuFontColor']) && $default_values['menuFontColor'] != '') {
		$options['mpcth_color_mm_menu'] = array(
			"id"	=> "mpcth_color_mm_menu",
			"name"	=> __("Font Color", 'mpcth'),
			"desc"	=> __("Specify main menu font color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuFontColor'] );
	}

	if(isset($default_values['menuFontHoverColor']) && $default_values['menuFontHoverColor'] != '') {
		$options['mpcth_color_mm_menu_hover'] = array(
			"id"	=> "mpcth_color_mm_menu_hover",
			"name"	=> __("Hover Font Color", 'mpcth'),
			"desc"	=> __("Specify main menu font color after hover.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuFontHoverColor'] );
	}

	if(isset($default_values['menuDropFontColor']) && $default_values['menuDropFontColor'] != '') {
		$options['mpcth_color_mm_drop'] = array(
			"id"	=> "mpcth_color_mm_drop",
			"name"	=> __("Drop Down Font Color", 'mpcth'),
			"desc"	=> __("Specify main menu drop down font color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuDropFontColor'] );
	}

	if(isset($default_values['menuDropFontHoverColor']) && $default_values['menuDropFontHoverColor'] != '') {
		$options['mpcth_color_mm_drop_hover'] = array(
			"id"	=> "mpcth_color_mm_drop_hover",
			"name"	=> __("Drop Down Hover Font Color", 'mpcth'),
			"desc"	=> __("Specify main menu drop down font color after hover.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuDropFontHoverColor'] );
	}

	// if(isset($default_values['menuItemBG']) && $default_values['menuItemBG'] != '') {// Background
	// 	$options['mpcth_color_mm_bg_menu'] = array(
	// 		"id"	=> "mpcth_color_mm_bg_menu",
	// 		"name"	=> __("Background Color", 'mpcth'),
	// 		"desc"	=> __("Specify main menu item background color.", 'mpcth'),
	// 		"type"	=> "color",
	// 		"std"	=> $default_values['menuItemBG'] );
	// }

	if(isset($default_values['menuItemBGHover']) && $default_values['menuItemBGHover'] != '') {
		$options['mpcth_color_mm_bg_menu_hover'] = array(
			"id"	=> "mpcth_color_mm_bg_menu_hover",
			"name"	=> __("Hover Background Color", 'mpcth'),
			"desc"	=> __("Specify main menu background color after hover.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuItemBGHover'] );
	}

	if(isset($default_values['menuDropItemBG']) && $default_values['menuDropItemBG'] != '') {
		$options['mpcth_color_mm_bg_drop'] = array(
			"id"	=> "mpcth_color_mm_bg_drop",
			"name"	=> __("Drop Down Background Color", 'mpcth'),
			"desc"	=> __("Specify main menu drop down background color.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuDropItemBG'] );
	}

	if(isset($default_values['menuDropItemBGHover']) && $default_values['menuDropItemBGHover'] != '') {
		$options['mpcth_color_mm_bg_drop_hover'] = array(
			"id"	=> "mpcth_color_mm_bg_drop_hover",
			"name"	=> __("Drop Down Hover Background Color", 'mpcth'),
			"desc"	=> __("Specify main menu drop down background color after hover.", 'mpcth'),
			"type"	=> "color",
			"std"	=> $default_values['menuDropItemBGHover'] );
	}

/* ---------------------------------------------------------------- */
/* Top Menu
/* ---------------------------------------------------------------- */
	// $options[] = array(
	// 	"name" 					=> __("Top Menu", 'mpcth'),
	// 	"type" 					=> "accordion",
	// 	"visual_panel" 			=> "true",
	// 	"visual_panel_title" 	=> __("Top Menu Colors", 'mpcth'));

	if(isset($default_values['topMenuFontColor']) && $default_values['topMenuFontColor'] != '') {
		$options['mpcth_color_tm_menu'] = array(
			"id" 	=> "mpcth_color_tm_menu",
			"name" 	=> __("Font Color", 'mpcth'),
			"desc" 	=> __("Specify top menu font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['topMenuFontColor'] );
	}

	if(isset($default_values['topMenuFontHover']) && $default_values['topMenuFontHover'] != '') {
		$options['mpcth_color_tm_menu_hover'] = array(
			"id" 	=> "mpcth_color_tm_menu_hover",
			"name" 	=> __("Hover Font Color", 'mpcth'),
			"desc" 	=> __("Specify top menu hover font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['topMenuFontHover'] );
	}

	if(isset($default_values['topMenuItemBG']) && $default_values['topMenuItemBG'] != '') {
		$options['mpcth_color_tm_itembg'] = array(
			"id" 	=> "mpcth_color_tm_itembg",
			"name" 	=> __("Item Background Color", 'mpcth'),
			"desc" 	=> __("Specify top menu item background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['topMenuItemBG'] );
	}

	if(isset($default_values['topMenuItemBGHover']) && $default_values['topMenuItemBGHover'] != '') {
		$options['mpcth_color_tm_itembg_hover'] = array(
			"id" 	=> "mpcth_color_tm_itembg_hover",
			"name" 	=> __("Hover Item Background Color", 'mpcth'),
			"desc" 	=> __("Specify top menu hover item background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['topMenuItemBGHover'] );
	}

/* ---------------------------------------------------------------- */
/* Comment Form
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Comment Form", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Comment Form Colors", 'mpcth'));

	if(isset($default_values['commentFirstLevelStripe']) && $default_values['commentFirstLevelStripe'] != '') {
		$options['mpcth_color_cf_first_stripe'] = array(
			"id" 	=> "mpcth_color_cf_first_stripe",
			"name" 	=> __("First Level Stripe", 'mpcth'),
			"desc" 	=> __("Specify comment form color stripe of first level comment.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFirstLevelStripe'] );
	}
	if(isset($default_values['commentSecondLevelStripe']) && $default_values['commentSecondLevelStripe'] != '') {
		$options['mpcth_color_cf_second_stripe'] = array(
			"id" 	=> "mpcth_color_cf_second_stripe",
			"name" 	=> __("Second Level Stripe", 'mpcth'),
			"desc" 	=> __("Specify comment form color stripe of second level comment.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentSecondLevelStripe'] );
	}
	if(isset($default_values['commentThirdLevelStripe']) && $default_values['commentThirdLevelStripe'] != '') {
		$options['mpcth_color_cf_third_stripe'] = array(
			"id" 	=> "mpcth_color_cf_third_stripe",
			"name" 	=> __("Third Level Stripe", 'mpcth'),
			"desc" 	=> __("Specify comment form color stripe of third level comment.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentThirdLevelStripe'] );
	}
	if(isset($default_values['commentForthLevelStripe']) && $default_values['commentForthLevelStripe'] != '') {
		$options['mpcth_color_cf_forth_stripe'] = array(
			"id" 	=> "mpcth_color_cf_forth_stripe",
			"name" 	=> __("Forth Level Stripe", 'mpcth'),
			"desc" 	=> __("Specify comment form color stripe of forth and below level comment.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentForthLevelStripe'] );
	}

	if(isset($default_values['commentFormFontColor']) && $default_values['commentFormFontColor'] != '') {
		$options['mpcth_color_cf_color'] = array(
			"id" 	=> "mpcth_color_cf_color",
			"name" 	=> __("Font Color", 'mpcth'),
			"desc" 	=> __("Specify comment form font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormFontColor'] );
	}

	if(isset($default_values['commentFormItemBG']) && $default_values['commentFormItemBG'] != '') {
		$options['mpcth_color_cf_bg'] = array(
			"id" 	=> "mpcth_color_cf_bg",
			"name" 	=> __("Background Color", 'mpcth'),
			"desc" 	=> __("Specify comment form background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormItemBG'] );
	}

	if(isset($default_values['commentFormBorder']) && $default_values['commentFormBorder'] != '') {
		$options['mpcth_color_cf_border'] = array(
			"id" 	=> "mpcth_color_cf_border",
			"name" 	=> __("Border Color", 'mpcth'),
			"desc" 	=> __("Specify comment form border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormBorder'] );
	}

	if(isset($default_values['commentFormFontHoverColor']) && $default_values['commentFormFontHoverColor'] != '') {
		$options['mpcth_color_cf_color_hover'] = array(
			"id" 	=> "mpcth_color_cf_color_hover",
			"name" 	=> __("Hover Font Color", 'mpcth'),
			"desc" 	=> __("Specify comment form hover font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormFontHoverColor'] );
	}

	if(isset($default_values['commentFormItemBGHover']) && $default_values['commentFormItemBGHover'] != '') {
		$options['mpcth_color_cf_bg_hover'] = array(
			"id" 	=> "mpcth_color_cf_bg_hover",
			"name" 	=> __("Hover Background Color", 'mpcth'),
			"desc" 	=> __("Specify comment form hover background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormItemBGHover'] );
	}

	if(isset($default_values['commentFormBorderHover']) && $default_values['commentFormBorderHover'] != '') {
		$options['mpcth_color_cf_border_hover'] = array(
			"id" 	=> "mpcth_color_cf_border_hover",
			"name" 	=> __("Hover Border Color", 'mpcth'),
			"desc" 	=> __("Specify comment form hover border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormBorderHover'] );
	}

	if(isset($default_values['commentFormFontErrorColor']) && $default_values['commentFormFontErrorColor'] != '') {
		$options['mpcth_color_cf_color_error'] = array(
			"id" 	=> "mpcth_color_cf_color_error",
			"name" 	=> __("Error Font Color", 'mpcth'),
			"desc" 	=> __("Specify comment form error font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormFontErrorColor'] );
	}

	if(isset($default_values['commentFormItemBGError']) && $default_values['commentFormItemBGError'] != '') {
		$options['mpcth_color_cf_bg_error'] = array(
			"id" 	=> "mpcth_color_cf_bg_error",
			"name" 	=> __("Error Background Color", 'mpcth'),
			"desc" 	=> __("Specify comment form error background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormItemBGError'] );
	}

	if(isset($default_values['commentFormBorderError']) && $default_values['commentFormBorderError'] != '') {
		$options['mpcth_color_cf_border_error'] = array(
			"id" 	=> "mpcth_color_cf_border_error",
			"name" 	=> __("Error Border Color", 'mpcth'),
			"desc" 	=> __("Specify comment form error border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormBorderError'] );
	}

	if(isset($default_values['commentFormLabelError']) && $default_values['commentFormLabelError'] != '') {
		$options['mpcth_color_cf_label_error'] = array(
			"id" 	=> "mpcth_color_cf_label_error",
			"name" 	=> __("Error Label Color", 'mpcth'),
			"desc" 	=> __("Specify comment form error label color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['commentFormLabelError'] );
	}

/* ---------------------------------------------------------------- */
/* Contact Form
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Contact Form", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Contact Form Colors", 'mpcth'));

	if(isset($default_values['contactFormFontColor']) && $default_values['contactFormFontColor'] != '') {
		$options['mpcth_color_cu_color'] = array(
			"id" 	=> "mpcth_color_cu_color",
			"name" 	=> __("Font Color", 'mpcth'),
			"desc" 	=> __("Specify contact form font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormFontColor'] );
	}

	if(isset($default_values['contactFormItemBG']) && $default_values['contactFormItemBG'] != '') {
		$options['mpcth_color_cu_bg'] = array(
			"id" 	=> "mpcth_color_cu_bg",
			"name" 	=> __("Background Color", 'mpcth'),
			"desc" 	=> __("Specify contact form background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormItemBG'] );
	}

	if(isset($default_values['contactFormBorder']) && $default_values['contactFormBorder'] != '') {
		$options['mpcth_color_cu_border'] = array(
			"id" 	=> "mpcth_color_cu_border",
			"name" 	=> __("Border Color", 'mpcth'),
			"desc" 	=> __("Specify contact form border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormBorder'] );
	}

	if(isset($default_values['contactFormFontHoverColor']) && $default_values['contactFormFontHoverColor'] != '') {
		$options['mpcth_color_cu_color_hover'] = array(
			"id" 	=> "mpcth_color_cu_color_hover",
			"name" 	=> __("Hover Font Color", 'mpcth'),
			"desc" 	=> __("Specify contact form hover font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormFontHoverColor'] );
	}

	if(isset($default_values['contactFormItemBGHover']) && $default_values['contactFormItemBGHover'] != '') {
		$options['mpcth_color_cu_bg_hover'] = array(
			"id" 	=> "mpcth_color_cu_bg_hover",
			"name" 	=> __("Hover Background Color", 'mpcth'),
			"desc" 	=> __("Specify contact form hover background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormItemBGHover'] );
	}

	if(isset($default_values['contactFormBorderHover']) && $default_values['contactFormBorderHover'] != '') {
		$options['mpcth_color_cu_border_hover'] = array(
			"id" 	=> "mpcth_color_cu_border_hover",
			"name" 	=> __("Hover Border Color", 'mpcth'),
			"desc" 	=> __("Specify contact form hover border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormBorderHover'] );
	}

	if(isset($default_values['contactFormFontErrorColor']) && $default_values['contactFormFontErrorColor'] != '') {
		$options['mpcth_color_cu_color_error'] = array(
			"id" 	=> "mpcth_color_cu_color_error",
			"name" 	=> __("Error Font Color", 'mpcth'),
			"desc" 	=> __("Specify contact form error font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormFontErrorColor'] );
	}

	if(isset($default_values['contactFormItemBGError']) && $default_values['contactFormItemBGError'] != '') {
		$options['mpcth_color_cu_bg_error'] = array(
			"id" 	=> "mpcth_color_cu_bg_error",
			"name" 	=> __("Error Background Color", 'mpcth'),
			"desc" 	=> __("Specify contact form error background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormItemBGError'] );
	}

	if(isset($default_values['contactFormBorderError']) && $default_values['contactFormBorderError'] != '') {
		$options['mpcth_color_cu_border_error'] = array(
			"id" 	=> "mpcth_color_cu_border_error",
			"name" 	=> __("Error Border Color", 'mpcth'),
			"desc" 	=> __("Specify contact form error border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormBorderError'] );
	}

	if(isset($default_values['contactFormLabelError']) && $default_values['contactFormLabelError'] != '') {
		$options['mpcth_color_cu_label_error'] = array(
			"id" 	=> "mpcth_color_cu_label_error",
			"name" 	=> __("Error Label Color", 'mpcth'),
			"desc" 	=> __("Specify contact form error label color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormLabelError'] );
	}

	if(isset($default_values['contactFormLabelSuccess']) && $default_values['contactFormLabelSuccess'] != '') {
		$options['mpcth_color_cu_label_success'] = array(
			"id" 	=> "mpcth_color_cu_label_success",
			"name" 	=> __("Success Label Color", 'mpcth'),
			"desc" 	=> __("Specify contact form success label color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['contactFormLabelSuccess'] );
	}

/* ---------------------------------------------------------------- */
/* Content Toggler
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Button - Toggle Content", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Buttom - Toggle Content", 'mpcth'));

	if(isset($default_values['togglerFontColor']) && $default_values['togglerFontColor'] != '') {
		$options['mpcth_color_toggler_text'] = array(
			"id" 	=> "mpcth_color_toggler_text",
			"name" 	=> __("Font Color", 'mpcth'),
			"desc" 	=> __("Specify text color for the toggler button in page and single post.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['togglerFontColor'] );
	}

	if(isset($default_values['togglerItemBG']) && $default_values['togglerItemBG'] != '') {
		$options['mpcth_color_toggler_bg'] = array(
			"id" 	=> "mpcth_color_toggler_bg",
			"name" 	=> __("Background Color", 'mpcth'),
			"desc" 	=> __("Specify background color for the toggler button in page and single post.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['togglerItemBG'] );
	}


	if(isset($default_values['togglerFontHoverColor']) && $default_values['togglerFontHoverColor'] != '') {
		$options['mpcth_color_toggler_text_hover'] = array(
			"id" 	=> "mpcth_color_toggler_text_hover",
			"name" 	=> __("Font Color Hover", 'mpcth'),
			"desc" 	=> __("Specify text color for the toggler button in page and single post after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['togglerFontHoverColor'] );
	}

	if(isset($default_values['togglerItemBGHover']) && $default_values['togglerItemBGHover'] != '') {
		$options['mpcth_color_toggler_bg_hover'] = array(
			"id" 	=> "mpcth_color_toggler_bg_hover",
			"name" 	=> __("Background Color Hover", 'mpcth'),
			"desc" 	=> __("Specify background color for the toggler button in page and single post after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['togglerItemBGHover'] );
	}

/* ---------------------------------------------------------------- */
/* Button
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Button - Submit", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Buttom - Submit", 'mpcth'));

	if(isset($default_values['submitFontColor']) && $default_values['submitFontColor'] != '') {
		$options['mpcth_color_submit_text'] = array(
			"id" 	=> "mpcth_color_submit_text",
			"name" 	=> __("Font Color", 'mpcth'),
			"desc" 	=> __("Specify text color for the submit button in contact form & comment form.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['submitFontColor'] );
	}


	if(isset($default_values['submitFontHoverColor']) && $default_values['submitFontHoverColor'] != '') {
		$options['mpcth_color_submit_text_hover'] = array(
			"id" 	=> "mpcth_color_submit_text_hover",
			"name" 	=> __("Hover Font Color", 'mpcth'),
			"desc" 	=> __("Specify text color for the submit button in contact form & comment form after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['submitFontHoverColor'] );
	}


/* ---------------------------------------------------------------- */
/* Tabs & Accordions
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Tabs & Accordions", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Tabs & Accordions", 'mpcth'));

	if(isset($default_values['tabsHeadingColor']) && $default_values['tabsHeadingColor'] != '') {
		$options['mpcth_color_tabs_heading'] = array(
			"id" 	=> "mpcth_color_tabs_heading",
			"name" 	=> __("Tab Font Color", 'mpcth'),
			"desc" 	=> __("Specify tab font color for the tabs & accordions.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tabsHeadingColor'] );
	}
	if(isset($default_values['tabsHeadingColorBG']) && $default_values['tabsHeadingColorBG'] != '') {
		$options['mpcth_color_tabs_heading_bg'] = array(
			"id" 	=> "mpcth_color_tabs_heading_bg",
			"name" 	=> __("Tab Background Color", 'mpcth'),
			"desc" 	=> __("Specify tab background color for the tabs & accordions.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tabsHeadingColorBG'] );
	}

	if(isset($default_values['tabsHeadingColorHover']) && $default_values['tabsHeadingColorHover'] != '') {
		$options['mpcth_color_tabs_heading_hover'] = array(
			"id" 	=> "mpcth_color_tabs_heading_hover",
			"name" 	=> __("Tab Font Color Hover", 'mpcth'),
			"desc" 	=> __("Specify tab font color for the tabs & accordions after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tabsHeadingColorHover'] );
	}
	if(isset($default_values['tabsHeadingColorBGHover']) && $default_values['tabsHeadingColorBGHover'] != '') {
		$options['mpcth_color_tabs_heading_bg_hover'] = array(
			"id" 	=> "mpcth_color_tabs_heading_bg_hover",
			"name" 	=> __("Tab Background Color Hover", 'mpcth'),
			"desc" 	=> __("Specify tab background color for the tabs & accordions after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tabsHeadingColorBGHover'] );
	}

	if(isset($default_values['tabsContentColor']) && $default_values['tabsContentColor'] != '') {
		$options['mpcth_color_tabs_content'] = array(
			"id" 	=> "mpcth_color_tabs_content",
			"name" 	=> __("Content Font Color", 'mpcth'),
			"desc" 	=> __("Specify content font color for the tabs & accordions.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tabsContentColor'] );
	}
	if(isset($default_values['tabsContentColorBG']) && $default_values['tabsContentColorBG'] != '') {
		$options['mpcth_color_tabs_content_bg'] = array(
			"id" 	=> "mpcth_color_tabs_content_bg",
			"name" 	=> __("Content Background Color", 'mpcth'),
			"desc" 	=> __("Specify content background color for the tabs & accordions.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tabsContentColorBG'] );
	}

/* ---------------------------------------------------------------- */
/* Blog & Portfolio
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Blog & Portfolio", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Blog & Portfolio", 'mpcth'));

	// if(isset($default_values['thumbColor']) && $default_values['thumbColor'] != '') {
	// 	$options['mpcth_color_thumb'] = array(
	// 		"id" 	=> "mpcth_color_thumb",
	// 		"name" 	=> __("Thumbnail Background", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the thumbnail background displayed for each post.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['thumbColor'] );
	// }

	if(isset($default_values['metaColor']) && $default_values['metaColor'] != '') {
		$options['mpcth_color_meta'] = array(
			"id" 	=> "mpcth_color_meta",
			"name" 	=> __("Meta Data", 'mpcth'),
			"desc" 	=> __("Specify color of the meta data displayed for each post.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['metaColor'] );
	}

	if(isset($default_values['readmoreColor']) && $default_values['readmoreColor'] != '') {
		$options['mpcth_color_more'] = array(
			"id" 	=> "mpcth_color_more",
			"name" 	=> __("Read More", 'mpcth'),
			"desc" 	=> __("Specify color of the read more button displayed for each post.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['readmoreColor'] );
	}

	if(isset($default_values['readmoreHoverColor']) && $default_values['readmoreHoverColor'] != '') {
		$options['mpcth_color_more_hover'] = array(
			"id" 	=> "mpcth_color_more_hover",
			"name" 	=> __("Read More Hover", 'mpcth'),
			"desc" 	=> __("Specify color of the read more button hover displayed for each post.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['readmoreHoverColor'] );
	}

	// if(isset($default_values['loadmoreColor']) && $default_values['loadmoreColor'] != '') {
	// 	$options['mpcth_color_loadmore'] = array(
	// 		"id" 	=> "mpcth_color_loadmore",
	// 		"name" 	=> __("Load More", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the load more button.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['loadmoreColor'] );
	// }
	// if(isset($default_values['loadmoreColorBG']) && $default_values['loadmoreColorBG'] != '') {
	// 	$options['mpcth_color_loadmore_bg'] = array(
	// 		"id" 	=> "mpcth_color_loadmore_bg",
	// 		"name" 	=> __("Load More Background", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the load more button background.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['loadmoreColorBG'] );
	// }

	// if(isset($default_values['loadmoreHoverColor']) && $default_values['loadmoreHoverColor'] != '') {
	// 	$options['mpcth_color_loadmore_hover'] = array(
	// 		"id" 	=> "mpcth_color_loadmore_hover",
	// 		"name" 	=> __("Load More Hover", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the load more button after hover.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['loadmoreHoverColor'] );
	// }
	// if(isset($default_values['loadmoreHoverColorBG']) && $default_values['loadmoreHoverColorBG'] != '') {
	// 	$options['mpcth_color_loadmore_bg_hover'] = array(
	// 		"id" 	=> "mpcth_color_loadmore_bg_hover",
	// 		"name" 	=> __("Load More Background Hover", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the load more button background after hover.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['loadmoreHoverColorBG'] );
	// }

	// if(isset($default_values['lightboxIcon']) && $default_values['lightboxIcon'] != '') {
	// 	$options['mpcth_color_lb'] = array(
	// 		"id" 	=> "mpcth_color_lb",
	// 		"name" 	=> __("Lightbox Text", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the lightbox text.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['lightboxIcon'] );
	// }

	// if(isset($default_values['lightboxIconHover']) && $default_values['lightboxIconHover'] != '') {
	// 	$options['mpcth_color_lb_hover'] = array(
	// 		"id" 	=> "mpcth_color_lb_hover",
	// 		"name" 	=> __("Lightbox Text Hover", 'mpcth'),
	// 		"desc" 	=> __("Specify color of the lightbox text after hover.", 'mpcth'),
	// 		"type" 	=> "color",
	// 		"std" 	=> $default_values['lightboxIconHover'] );
	// }

	if(isset($default_values['categoryFilterFont']) && $default_values['categoryFilterFont'] != '') {
		$options['mpcth_color_cat_text'] = array(
			"id" 	=> "mpcth_color_cat_text",
			"name" 	=> __("Category Filter Font", 'mpcth'),
			"desc" 	=> __("Specify color of the category filter font.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['categoryFilterFont'] );
	}

	if(isset($default_values['categoryFilterBG']) && $default_values['categoryFilterBG'] != '') {
		$options['mpcth_color_cat_bg'] = array(
			"id" 	=> "mpcth_color_cat_bg",
			"name" 	=> __("Category Filter Background", 'mpcth'),
			"desc" 	=> __("Specify color of the category filter background.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['categoryFilterBG'] );
	}

	if(isset($default_values['categoryFilterFontHover']) && $default_values['categoryFilterFontHover'] != '') {
		$options['mpcth_color_cat_text_hover'] = array(
			"id" 	=> "mpcth_color_cat_text_hover",
			"name" 	=> __("Category Filter Font Hover", 'mpcth'),
			"desc" 	=> __("Specify color of the category filter font after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['categoryFilterFontHover'] );
	}

	if(isset($default_values['categoryFilterBGHover']) && $default_values['categoryFilterBGHover'] != '') {
		$options['mpcth_color_cat_bg_hover'] = array(
			"id" 	=> "mpcth_color_cat_bg_hover",
			"name" 	=> __("Category Filter Background Hover", 'mpcth'),
			"desc" 	=> __("Specify color of the category filter background after hover.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['categoryFilterBGHover'] );
	}

/* ---------------------------------------------------------------- */
/* Logo
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name"					 => __("Logo", 'mpcth'),
		"type"					 => "accordion",
		"visual_panel"			 => "true",
		"visual_panel_title"	 => __("Logo Colors", 'mpcth'));

	if(isset($default_values['logoFontColor']) && $default_values['logoFontColor'] != '') {
		$options['mpcth_text_logo_color'] = array(
			"id" 	=> "mpcth_text_logo_color",
			"name" 	=> __("Font Color", 'mpcth'),
			"desc" 	=> __("Specify text logo font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['logoFontColor'] );
	}

	if(isset($default_values['logoBG']) && $default_values['logoBG'] != '') {
		$options['mpcth_text_logo_bg'] = array(
			"id" 	=> "mpcth_text_logo_bg",
			"name" 	=> __("Background Color", 'mpcth'),
			"desc" 	=> __("Specify text logo background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['logoBG'] );
	}

	if(isset($default_values['descriptionFontColor']) && $default_values['descriptionFontColor'] != '') {
		$options['mpcth_text_logo_description_color'] = array(
			"id" 	=> "mpcth_text_logo_description_color",
			"name" 	=> __("Description Font Color", 'mpcth'),
			"desc" 	=> __("Specify description font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['descriptionFontColor'] );
	}

	if(isset($default_values['descriptionBG']) && $default_values['descriptionBG'] != '') {
		$options['mpcth_text_logo_description_bg'] = array(
			"id" 	=> "mpcth_text_logo_description_bg",
			"name" 	=> __("Description Background Color", 'mpcth'),
			"desc" 	=> __("Specify description background color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['descriptionBG'] );
	}

/* ---------------------------------------------------------------- */
/* Other
/* ---------------------------------------------------------------- */
	$options[] = array(
		"name" 					=> __("Other", 'mpcth'),
		"type" 					=> "accordion",
		"visual_panel" 			=> "true",
		"visual_panel_title" 	=> __("Other", 'mpcth'));

	if(isset($default_values['defaultBorderColor']) && $default_values['defaultBorderColor'] != '') {
		$options['mpcth_color_border_color'] = array(
			"id" 	=> "mpcth_color_border_color",
			"name" 	=> __("Default Border Color", 'mpcth'),
			"desc" 	=> __("Specify default border color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['defaultBorderColor'] );
	}

	if(isset($default_values['defaultBorderCornerColor']) && $default_values['defaultBorderCornerColor'] != '') {
		$options['mpcth_color_border_corner_color'] = array(
			"id" 	=> "mpcth_color_border_corner_color",
			"name" 	=> __("Default Border Corner Color", 'mpcth'),
			"desc" 	=> __("Specify default border corner color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['defaultBorderCornerColor'] );
	}

	if(isset($default_values['hrColor']) && $default_values['hrColor'] != '') {
		$options['mpcth_color_hr_color'] = array(
			"id" 	=> "mpcth_color_hr_color",
			"name" 	=> __("HR Line", 'mpcth'),
			"desc" 	=> __("Specify color of the hr tag (divider line).", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['hrColor'] );
	}
	if(isset($default_values['hrLabelColor']) && $default_values['hrLabelColor'] != '') {
		$options['mpcth_color_hr_label_color'] = array(
			"id" 	=> "mpcth_color_hr_label_color",
			"name" 	=> __("HR Label Background", 'mpcth'),
			"desc" 	=> __("Specify label background color of the hr tag (divider line).", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['hrLabelColor'] );
	}
	if(isset($default_values['hrFontColor']) && $default_values['hrFontColor'] != '') {
		$options['mpcth_color_hr_font_color'] = array(
			"id" 	=> "mpcth_color_hr_font_color",
			"name" 	=> __("HR Label Font", 'mpcth'),
			"desc" 	=> __("Specify font color of the hr tag (divider line).", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['hrFontColor'] );
	}

	if(isset($default_values['sidebarHeading']) && $default_values['sidebarHeading'] != '') {
		$options['mpcth_color_sidebar_heading'] = array(
			"id" 	=> "mpcth_color_sidebar_heading",
			"name" 	=> __("Sidebar Heading", 'mpcth'),
			"desc" 	=> __("Specify color of the headings for sidebar section.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['sidebarHeading'] );
	}

	if(isset($default_values['sidebarFontColor']) && $default_values['sidebarFontColor'] != '') {
		$options['mpcth_color_sidebar_text'] = array(
			"id" 	=> "mpcth_color_sidebar_text",
			"name" 	=> __("Sidebar Font", 'mpcth'),
			"desc" 	=> __("Specify color of text for sidebar section.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['sidebarFontColor'] );
	}

	if(isset($default_values['footerHeading']) && $default_values['footerHeading'] != '') {
		$options['mpcth_color_footer_heading'] = array(
			"id" 	=> "mpcth_color_footer_heading",
			"name" 	=> __("Footer Heading", 'mpcth'),
			"desc" 	=> __("Specify color of the headings for footer section.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['footerHeading'] );
	}

	if(isset($default_values['footerFontColor']) && $default_values['footerFontColor'] != '') {
		$options['mpcth_color_footer_text'] = array(
			"id" 	=> "mpcth_color_footer_text",
			"name" 	=> __("Footer Font", 'mpcth'),
			"desc" 	=> __("Specify color of text for footer section.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['footerFontColor'] );
	}

	if(isset($default_values['topWidgetAreaHeading']) && $default_values['topWidgetAreaHeading'] != '') {
		$options['mpcth_color_top_widget_area_heading'] = array(
			"id" 	=> "mpcth_color_top_widget_area_heading",
			"name" 	=> __("Top Widget Area Heading", 'mpcth'),
			"desc" 	=> __("Specify color of the headings for top widget area section.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['topWidgetAreaHeading'] );
	}

	if(isset($default_values['topWidgetAreaFontColor']) && $default_values['topWidgetAreaFontColor'] != '') {
		$options['mpcth_color_top_widget_area_text'] = array(
			"id" 	=> "mpcth_color_top_widget_area_text",
			"name" 	=> __("Top Widget Area Font", 'mpcth'),
			"desc" 	=> __("Specify color of text for top widget area section.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['topWidgetAreaFontColor'] );
	}

	if(isset($default_values['authorFont']) && $default_values['authorFont'] != '') {
		$options['mpcth_color_cf_author_text'] = array(
			"id" 	=> "mpcth_color_cf_author_text",
			"name" 	=> __("Author Label Font", 'mpcth'),
			"desc" 	=> __("Specify author label font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['authorFont'] );
	}

	if(isset($default_values['authorBG']) && $default_values['authorBG'] != '') {
		$options['mpcth_color_cf_author_bg'] = array(
			"id" 	=> "mpcth_color_cf_author_bg",
			"name" 	=> __("Author Label Background", 'mpcth'),
			"desc" 	=> __("Specify author label background.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['authorBG'] );
	}

	if(isset($default_values['tooltipFont']) && $default_values['tooltipFont'] != '') {
		$options['mpcth_color_tooltip_text'] = array(
			"id" 	=> "mpcth_color_tooltip_text",
			"name" 	=> __("Tooltip Font", 'mpcth'),
			"desc" 	=> __("Specify tooltip font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tooltipFont'] );
	}

	if(isset($default_values['tooltipBG']) && $default_values['tooltipBG'] != '') {
		$options['mpcth_color_tooltip_bg'] = array(
			"id" 	=> "mpcth_color_tooltip_bg",
			"name" 	=> __("Tooltip Background", 'mpcth'),
			"desc" 	=> __("Specify tooltip background.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['tooltipBG'] );
	}

	if(isset($default_values['searchFont']) && $default_values['searchFont'] != '') {
		$options['mpcth_color_search_form_text'] = array(
			"id" 	=> "mpcth_color_search_form_text",
			"name" 	=> __("Search Form Font", 'mpcth'),
			"desc" 	=> __("Specify search form font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['searchFont'] );
	}

	if(isset($default_values['searchBG']) && $default_values['searchBG'] != '') {
		$options['mpcth_color_search_form_bg'] = array(
			"id" 	=> "mpcth_color_search_form_bg",
			"name" 	=> __("Search Form Background", 'mpcth'),
			"desc" 	=> __("Specify search form background.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['searchBG'] );
	}

	if(isset($default_values['copyrightTextFont']) && $default_values['copyrightTextFont'] != '') {
		$options['mpcth_color_copyright_text'] = array(
			"id" 	=> "mpcth_color_copyright_text",
			"name" 	=> __("Copyright Font", 'mpcth'),
			"desc" 	=> __("Specify copyright font color.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['copyrightTextFont'] );
	}

	if(isset($default_values['socialIconBgColor']) && $default_values['socialIconBgColor'] != '') {
		$options['mpcth_social_bg_color'] = array(
			"id" 	=> "mpcth_social_bg_color",
			"name" 	=> __("Social Icon Background", 'mpcth'),
			"desc" 	=> __("Specify social icons background.", 'mpcth'),
			"type" 	=> "color",
			"std" 	=> $default_values['socialIconBgColor'] );
	}

	return $options;
}