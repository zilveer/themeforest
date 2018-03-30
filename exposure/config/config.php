<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');
if( !defined('THB_CONFIG_INIT') ) { define('THB_CONFIG_INIT', true); } else { return; }

if( !defined('THB_DB_INTEGRITY_CHECK') ) { define('THB_DB_INTEGRITY_CHECK', true); }

/**
 * Theme config.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Config
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * === CORE ====================================================================
 * - Main options page and default tabs
 * - Modules
 * === APPEARANCE ==============================================================
 * - Scripts and styles *
 * - Image sizes
 * - Menu
 * === SIDEBARS ================================================================
 * - Sidebars *
 * - Page templates with sidebar *
 * === OPTIONS =================================================================
 * - Options page
 * - Custom body classes *
 * === GLOBALS =================================================================
 * - Meta data
 * - RSS feed
 * - Favicon
 * - Default script
 * - Google Analytics
 * === THEME CUSTOMIZATIONS ====================================================
 * - Woocommerce fix *
 */

$thb_theme = thb_theme();

// Scripts and styles
$template_directory_uri = get_template_directory_uri();

thb_theme()->getFrontend()->addStyle($template_directory_uri . '/css/reset.css', array(
	'name' => 'thb_reset',
	'compress' => false
));

thb_theme()->getFrontend()->addStyle($template_directory_uri . '/css/layout.css', array(
	'name' => 'thb_layout',
	'deps' => array('thb_reset'),
	'compress' => false
));

// IE compatibility
if( ! function_exists('thb_exposure_ie') ) {
	function thb_exposure_ie() {
		?>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/ie8.css'; ?>" type="text/css">
		<![endif]-->
		<?php
	}

	add_action( 'wp_head', 'thb_exposure_ie', 9999 );
}

// Responsive
if( !function_exists('thb_html_class_filter') ) {
	function thb_html_class_filter( $classes ) {
		if( thb_get_option('enable_responsive_768') == 1 ) {
			$classes[] = 'responsive_768';
		}

		if( thb_get_option('enable_responsive_480') == 1 ) {
			$classes[] = 'responsive_480';
		}

		return $classes;
	}

	add_filter('thb_html_class', 'thb_html_class_filter');
}

thb_theme()->getFrontend()->addStyle($template_directory_uri . '/css/prettyPhoto.css', array(
	'name' => 'prettyStyle',
	// 'deps' => array('thb_reset'),
	'compress' => false
));

// if( !function_exists('prettyStyle') ) {
// 	function prettyStyle() {
// 		$template_directory_uri = get_template_directory_uri();
// 		thb_stylesheet( $template_directory_uri . '/css/prettyPhoto.css', 'screen' );
// 	}
// }

// add_action('thb_footer', 'prettyStyle');

/**
 * CORE
 * -----------------------------------------------------------------------------
 */

// Main options page and default tabs

$thb_page = $thb_theme->getAdmin()->getMainPage();
	$thb_tab = new THB_Tab( __('General', 'thb_text_domain'), 'general' );
	$thb_page->addTab($thb_tab);

	$thb_tab = new THB_Tab( __('Logo & Images', 'thb_text_domain'), 'general_images' );
	$thb_page->addTab($thb_tab);

// Core modules

$thb_theme->loadModule('core/layout', array(
	'options_logo_position' => array(
		'logo-left'   => __('Left', 'thb_text_domain'),
		'logo-right'  => __('Right', 'thb_text_domain')
	),
	'meta_options_subtitle'           => false,
	'meta_options_pageheader_disable' => array(
		'default',
		'template-archives.php',
		'template-contact.php',
		'template-page-full.php'
	),
	'meta_options_page_boxed'         => false,
	'meta_options_gutter'             => false,
		'meta_options_gutter_default' => false
));

$thb_theme->loadModule('core/sidebars', array(
	'templates' => array(
		'default',
		'template-blog-classic.php',
		'template-blog-timeline.php',
		'template-blog-carousel.php',
		'template-contact.php',
		'template-page-full.php',
		'template-photogallery.php',
		'template-portfolio-carousel.php',
		'template-portfolio-masonry.php',
		'template-showcase.php'
	)
));
$thb_theme->loadModule('core/blog', array(
	'templates' => array(
		'template-blog-timeline.php',
		'template-blog-classic.php',
		'template-blog-carousel.php'
	)
));
$thb_theme->loadModule('core/portfolio', array(
	'templates' => array(
		'template-portfolio-masonry.php',
		'template-portfolio-carousel.php'
	),
	'ajax' => array(
		'template-portfolio-masonry.php'
	),
	'pagination_disabled' => array(
		'template-portfolio-carousel.php'
	),
	'work_details' => false,
	'works_navigation' => false,
	'single' => false
));

$thb_theme->loadModule('core/lightbox/submodules/prettyPhoto', array(
	'skin' => true
));

$thb_theme->loadModule('core/slideshows', array(
	'submodules' => array(
		'fullbackground' => array(
			'image_size' => 'large',
			'fixed' => false,
			'templates' => array(
				'template-showcase.php',
				'single-works.php'
			),
			'carousel' => array(
				'template-showcase.php',
				'single-works.php'
			)
		)
	)
));

$thb_theme->loadModule('core/contact');
$thb_theme->loadModule('core/seo');
$thb_theme->loadModule('core/social');
$thb_theme->loadModule('core/appearance');
$thb_theme->loadModule('core/customfonts');

// Theme

$thb_theme->loadModule('customization');

// Core modules additional setup -----------------------------------------------

if( !function_exists('thb_fullbackground_works') ) {
	function thb_fullbackground_works( $post_types ) {
		$post_types[] = 'works';
		return $post_types;
	}

	add_filter('thb_fullbackground_posttypes', 'thb_fullbackground_works');
}

if( !function_exists('thb_add_stretch') ) {
	function thb_add_stretch() {
		$thb_stretch_templates = array(
			'default',
			'template-blog-timeline.php',
			'template-blog-classic.php',
			'template-blog-carousel.php',
			'template-page-full.php',
			'template-photogallery.php',
			'template-portfolio-masonry.php',
			'template-contact.php',
			'template-archives.php',
			'single.php'
		);
		$thb_fullbg = thb_get_module_url('core/slideshows/submodules/fullbackground');

		if( thb_check_page_template(thb_get_page_ID(), $thb_stretch_templates) ) {
			if( !function_exists('thb_stretch') ) {
				function thb_stretch() {
					echo thb_get_template_part('part-stretch');
				}
			}

			thb_theme()->getFrontend()->addStyle($thb_fullbg . '/css/style.css');
			add_action('thb_fullbackground_start', 'thb_stretch');
		}
	}

	add_action('thb_head_meta', 'thb_add_stretch');
}

/**
 * APPEARANCE
 * -----------------------------------------------------------------------------
 */

// if( !function_exists('thb_theme_scripts_and_styles') ) {
// 	function thb_theme_scripts_and_styles() {
// 		$template_directory_uri = get_template_directory_uri();
// 		$is_responsive_768 = thb_get_option('enable_responsive_768');
// 		$is_responsive_480 = thb_get_option('enable_responsive_480');

// 		// Styles
// 		thb_stylesheet( $template_directory_uri . '/css/reset.css', 'screen' );
// 		thb_stylesheet( $template_directory_uri . '/css/layout.css', 'screen' );

// 		if( $is_responsive_768 == 1 ) {
// 			thb_stylesheet( $template_directory_uri . '/css/768.css', 'screen and (min-width: 768px) and (max-width: 1024px)' );
// 		}
// 		if( $is_responsive_480 == 1 ) {
// 			thb_stylesheet( $template_directory_uri . '/css/480.css', 'screen and (max-width: 767px)' );
// 		}

// 		thb_ie();
// 		wp_enqueue_script('jquery');
// 		wp_enqueue_script('swfobject');
// 		if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'thb_theme_scripts_and_styles' );

$thb_theme->getFrontend()->addScript( THB_TEMPLATE_URL . '/js/jquery.mousewheel.js' );
$thb_theme->getFrontend()->addScript( THB_TEMPLATE_URL . '/js/jquery.jscrollpane.min.js' );
$thb_theme->getFrontend()->addStyle( THB_TEMPLATE_URL . '/css/jquery.jscrollpane.css' );
$thb_theme->getFrontend()->addScript(THB_ADMIN_JS_URL . '/jquery.scrollTo-1.4.3.1-min.js');

/**
 * Touch events
 */
$thb_touch_pages = array(
	'templates' => array(
		'template-blog-carousel.php',
		'template-portfolio-carousel.php',
		'single-works.php'
	)
);
$thb_theme->getFrontend()->addScript( THB_TEMPLATE_URL . '/js/jquery.hammer.min.js', $thb_touch_pages );

$conds = array(
	'templates' => array('template-photogallery.php')
);

$thb_theme->getFrontend()->addStyle(THB_FRONTEND_CSS_URL . '/isotope.css', $conds);
$thb_theme->getFrontend()->addScript(THB_FRONTEND_JS_URL . '/jquery.isotope.min.js', $conds);

// The image sizes

add_image_size( 'micro', 80, 80, true );
add_image_size( 'small', 560, null, true );
add_image_size( 'small-cropped', 560, 350, true );
add_image_size( 'medium-cropped', 900, 560, true );
add_image_size( 'medium', 900, null, true );
add_image_size( 'large', 1200, null, true );

// Menus

register_nav_menus(array(
	'primary' => __( 'Primary navigation', 'thb_text_domain' ),
	'mobile' => __( 'Mobile navigation', 'thb_text_domain' )
));

/**
 * OPTIONS
 * -----------------------------------------------------------------------------
 */

// Theme options page

/**
 * General
 */

$thb_tab = $thb_page->getTab('general');

	// General options

	$thb_container = $thb_tab->createContainer( __('General options', 'thb_text_domain'), 'general_options' );

	$thb_field = new THB_TextField('copyright');
		$thb_field->setLabel( __('Copyright text', 'thb_text_domain') );
		$thb_field->setHelp( __('The copyright text will be displayed at the bottom of the site (Note: accepts basic HTML).', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextField('rss_alternate');
		$thb_field->setLabel( __('Alternate RSS feed URL', 'thb_text_domain') );
		$thb_field->setHelp( __('If you want to use a custom feed service, like Feedburner or others, enter your preferred RSS feed URL. Otherwise the default WordPress RSS feed will be used.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

	$thb_field = new THB_TextareaField('analytics');
		$thb_field->setLabel( __('Google Analytics tracking code', 'thb_text_domain') );
		$thb_field->setHelp( __('Paste your Google Analytics code here to enable statistics tracking for this site. For more info <a href="http://support.google.com/analytics/bin/answer.py?hl=en&topic=1006226&answer=1008080">read this article</a>.', 'thb_text_domain') );
	$thb_container->addField($thb_field);

/**
 * Images
 */

$thb_tab = $thb_page->getTab('general_images');

	$thb_container = $thb_tab->createContainer( '', 'general_images_options' );

		$thb_field = new THB_UploadField('main_logo');
			$thb_field->setLabel( __('Logo', 'thb_text_domain') );
			$thb_field->setHelp( __('Upload an image to be used as a logo for your site. If this field is left empty, a simple text logo will be used. Please remember to load a properly dimensioned logo.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('favicon');
			$thb_field->setLabel( __('Favicon', 'thb_text_domain') );
			$thb_field->setHelp( __('Paste here the URL of your custom favicon.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('touch_icon_57');
			$thb_field->setLabel( __('Apple Touch Icon 57&times;57', 'thb_text_domain') );
			$thb_field->setHelp( __('Paste here the URL of your custom 57&times;57px Apple Touch Icon. <a href="http://developer.apple.com/library/ios/#documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html">What\'s an Apple Touch Icon</a>?', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('touch_icon_72');
			$thb_field->setLabel( __('Apple Touch Icon 72&times;72', 'thb_text_domain') );
			$thb_field->setHelp( __('Paste here the URL of your custom 72&times;72px Apple Touch Icon.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('touch_icon_114');
			$thb_field->setLabel( __('Apple Touch Icon 114&times;114', 'thb_text_domain') );
			$thb_field->setHelp( __('Paste here the URL of your custom 114&times;114px Apple Touch Icon.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_TextField('touch_icon_144');
			$thb_field->setLabel( __('Apple Touch Icon 144&times;144', 'thb_text_domain') );
			$thb_field->setHelp( __('Paste here the URL of your custom 144&times;144px Apple Touch Icon.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

/**
 * Responsive options
 */
if( ! function_exists('thb_responsive_options') ) {
	function thb_responsive_options() {
		$thb_tab = thb_theme()->getAdmin()->getMainPage()->getTab('layout');
		$thb_container = $thb_tab->createContainer( __('Responsive', 'thb_text_domain'), 'responsive_options' );

		$thb_field = new THB_CheckboxField( 'enable_responsive_768' );
			$thb_field->setLabel( __( sprintf('Enable above <code>%s</code>', '768px') , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to enable the responsive layout feature above 768px, eg. tablets.', 'thb_text_domain') );
		$thb_container->addField($thb_field);

		$thb_field = new THB_CheckboxField( 'enable_responsive_480' );
			$thb_field->setLabel( __( sprintf('Enable below <code>%s</code>', '768px') , 'thb_text_domain') );
			$thb_field->setHelp( __('Tick if you want to enable the responsive layout feature below 768px, eg. Mobile devices.', 'thb_text_domain') );
		$thb_container->addField($thb_field);
	}

	add_action( 'after_setup_theme', 'thb_responsive_options' );
}

// Custom body classes

if( !function_exists('custom_body_classes') ) {
	function custom_body_classes( $classes ) {
		if( !thb_get_option('enable_responsive_768') ) {
			$classes[] = 'thb-responsive-tablet-off';
		}

		if( !thb_get_option('enable_responsive_480') ) {
			$classes[] = 'thb-responsive-mobile-off';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'custom_body_classes' );


/**
 * GLOBALS
 * -----------------------------------------------------------------------------
 */

// Theme meta data
if( !function_exists('thb_theme_meta') ) {
	function thb_theme_meta() {
		thb_meta('viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0');
	}
}
add_action( 'thb_head_meta', 'thb_theme_meta' );

// RSS feed

if( !function_exists('thb_feed') ) {
	function thb_feed() {
		$feed = get_bloginfo('rss2_url');
		if( thb_get_option('rss_alternate') != '' ) {
			$feed = thb_get_option('rss_alternate');
		}

		thb_link( 'alternate', $feed, 'application/rss+xml', array(), get_bloginfo('name') . ' ' . __('RSS Feed', 'thb_text_domain') );
		thb_link( 'pingback', get_bloginfo('pingback_url') );
	}
}
add_action('wp_head', 'thb_feed');

// Favicon

if( !function_exists('thb_icons') ) {
	function thb_icons() {
		$favicon = thb_get_option('favicon');
		$touch_icon_57 = thb_get_option('touch_icon_57');
		$touch_icon_72 = thb_get_option('touch_icon_72');
		$touch_icon_114 = thb_get_option('touch_icon_114');
		$touch_icon_144 = thb_get_option('touch_icon_144');

		if( !empty($favicon) ) {
			thb_link('Shortcut Icon', $favicon, 'image/x-icon');
		}

		if( !empty($touch_icon_57) ) {
			thb_link('apple-touch-icon', $touch_icon_57, null, array('sizes' => '57x57'));
		}

		if( !empty($touch_icon_72) ) {
			thb_link('apple-touch-icon', $touch_icon_72, null, array('sizes' => '72x72'));
		}

		if( !empty($touch_icon_114) ) {
			thb_link('apple-touch-icon', $touch_icon_114, null, array('sizes' => '114x114'));
		}

		if( !empty($touch_icon_144) ) {
			thb_link('apple-touch-icon', $touch_icon_144, null, array('sizes' => '144x144'));
		}
	}
}
add_action('wp_head', 'thb_icons');

// Default script

$thb_theme->getFrontend()->addScript(get_template_directory_uri() . '/js/theme.js');

// Google Analytics

if( !function_exists('thb_google_analytics') ) {
	function thb_google_analytics(  ) {
		$analytics = stripslashes( thb_get_option('analytics') );
		if( !empty($analytics) ) {
			echo $analytics;
		}
	}
}
add_action('wp_footer', 'thb_google_analytics');

/**
 * THEME CUSTOMIZATIONS
 * -----------------------------------------------------------------------------
 */

/**
 * Photogallery
 */
$thb_photogallery_page = array(
	'template-photogallery.php'
);

$thb_metabox = new THB_Metabox( __('Gallery pictures', 'thb_text_domain'), 'slideshow' );
	$thb_container = $thb_metabox->createDuplicableContainer( '', 'slides' );
	$thb_container->setSortable();

		$thb_container->addControl( __('Add image', 'thb_text_domain'), 'add_image', 'images.png', array(
			'action' => 'thb_add_multiple_slides',
			'title' => __('Add images', 'thb_text_domain')
		) );

		$field = new THB_SlideField( THB_SLIDES );
		$field->setLabel( __('Slide', 'thb_text_domain') );
		$thb_container->setField($field);

$thb_pages = $thb_theme->getPostType('page');
$thb_pages->addMetabox($thb_metabox, $thb_photogallery_page);

/**
 * Custom option for Portfolio carousel and blog carousel templates
 */
if( ! function_exists('thb_exposure_page_options') ) {
	function thb_exposure_page_options() {
		$thb_pages = thb_theme()->getPostType('page');
		$thb_carousel_pages = array(
			'template-portfolio-carousel.php',
			'template-blog-carousel.php'
		);
		$thb_masonry_templates = array(
			'template-photogallery.php',
			'template-portfolio-masonry.php'
		);

		$thb_metabox = $thb_pages->getMetabox('layout');

		if( thb_is_admin_template($thb_carousel_pages) ) {

			$thb_container = $thb_metabox->createContainer( __('Page options', 'thb_text_domain'), 'options_container' );
				$field = new THB_CheckBoxField( 'firstitem_highlighted' );
				$field->setDefault(false);
				$field->setLabel( __('Disable highlight on first item', 'thb_text_domain') );
				$thb_container->addField($field);

		}
		if( thb_is_admin_template($thb_masonry_templates) ) {

			$thb_container = $thb_metabox->createContainer( __('Grid options', 'thb_text_domain'), 'options_container' );
				$thb_field = new THB_SelectField( 'layout_position' );
					$thb_field->setLabel( __('Columns layout', 'thb_text_domain') );
					$thb_field->setOptions(array(
						'masonry_3col' => __('3 Columns', 'thb_text_domain'),
						'masonry_4col' => __('4 Columns', 'thb_text_domain'),
						'masonry_5col' => __('5 Columns', 'thb_text_domain')
					));
				$thb_container->addField($thb_field);

				if( thb_is_admin_template('template-photogallery.php') ) {
					$field = new THB_NumberField( 'slides_per_page' );
					$field->setLabel( __('Pictures per page', 'thb_text_domain') );
					$field->setHelp( __('In case of AJAX loading, chose how many pictures to display.', 'thb_text_domain') );
					$thb_container->addField($field);
				}

				$thb_field = new THB_SelectField( 'slides_size' );
					$thb_field->setLabel( __('Slides height', 'thb_text_domain') );
					$thb_field->setOptions(array(
						'small-cropped' => __('Fixed', 'thb_text_domain'),
						'small' => __('Variable', 'thb_text_domain')
					));
				$thb_container->addField($thb_field);

		}
	}

	add_action('init', 'thb_exposure_page_options');
}

if( !function_exists('thb_carousel_pages') ) {
	function thb_carousel_pages( $classes ) {
		$id = thb_get_page_ID();
		$firstitem_highlighted = thb_get_post_meta($id, 'firstitem_highlighted');

		if( $firstitem_highlighted == true ) {
			$classes[] = 'firstitem_highlight_disabled';
		}

		return $classes;
	}

	add_action('body_class', 'thb_carousel_pages');
}

/**
 * Custom option for classic blog layout
 */
if( ! function_exists('thb_exposure_classic_blog_options') ) {
	function thb_exposure_classic_blog_options() {
		$thb_pages = thb_theme()->getPostType('page');
		$thb_classic_blog = array(
			'template-blog-classic.php'
		);

		if( thb_is_admin_template($thb_classic_blog) ) {
			$thb_metabox = $thb_pages->getMetabox('layout');
				$thb_container = $thb_metabox->createContainer( __('Layout alignment', 'thb_text_domain'), 'options_container' );
					$thb_field = new THB_SelectField( 'layout_position' );
						$thb_field->setLabel( __('Layout alignment', 'thb_text_domain') );
						$thb_field->setOptions(array(
							'classic-blog-left'   => __('Left', 'thb_text_domain'),
							'classic-blog-right'  => __('Right', 'thb_text_domain')
						));
					$thb_container->addField($thb_field);
		}
	}

	add_action('init', 'thb_exposure_classic_blog_options');
}

if( !function_exists('thb_classic_blog_layout') ) {
	function thb_classic_blog_layout( $classes ) {
		$id = thb_get_page_ID();
		$overlay_off = thb_get_post_meta($id, 'overlay_off');

		if( $overlay_off == '1' ) {
			$classes[] = 'thb-overlay-off';
		}

		return $classes;
	}

	add_action('body_class', 'thb_classic_blog_layout');
}

/**
 * Change "Loop" metabox on carousels tempaltes
 */

$thb_hide_posts_per_page_filter_pages = array(
	'template-blog-timeline.php',
	'template-portfolio-carousel.php',
	'template-blog-carousel.php'
);

if( !function_exists('thb_hide_posts_per_page_filter') ) {
	function thb_hide_posts_per_page_filter( $metabox ) {
		$container = $metabox->getContainer('loop_container');
		$container_fields = $container->getFields();
		$container_fields[0]->setHideNum();

		return $metabox;
	}

	if( thb_is_admin_template($thb_hide_posts_per_page_filter_pages) ) {
		add_filter('thb_loop_metabox', 'thb_hide_posts_per_page_filter');
	}
}

// if( !function_exists('thb_masonry_options') ) {
// 	function thb_masonry_options() {
// 		$thb_pages = thb_theme()->getPostType('page');

// 		/**
// 		 * Columns layout for Masonry templates
// 		 */
// 		$thb_masonry_templates = array(
// 			'template-photogallery.php',
// 			'template-portfolio-masonry.php'
// 		);

// 		$thb_metabox = $thb_pages->getMetabox('layout');

// 			$thb_container = $thb_metabox->createContainer( '', 'options_container' );
// 				$thb_field = new THB_SelectField( 'layout_position' );
// 					$thb_field->setLabel( __('Columns layout', 'thb_text_domain') );
// 					$thb_field->setOptions(array(
// 						'masonry_3col' => __('3 Columns', 'thb_text_domain'),
// 						'masonry_4col' => __('4 Columns', 'thb_text_domain'),
// 						'masonry_5col' => __('5 Columns', 'thb_text_domain')
// 					));
// 				$thb_container->addField($thb_field);

// 				if( thb_is_admin_template('template-photogallery.php') ) {
// 					$field = new THB_NumberField( 'slides_per_page' );
// 					$field->setLabel( __('Pictures per page', 'thb_text_domain') );
// 					$field->setHelp( __('In case of AJAX loading, chose how many pictures to display.', 'thb_text_domain') );
// 					$thb_container->addField($field);
// 				}

// 				$thb_field = new THB_SelectField( 'slides_size' );
// 					$thb_field->setLabel( __('Slides height', 'thb_text_domain') );
// 					$thb_field->setOptions(array(
// 						'small-cropped' => __('Fixed', 'thb_text_domain'),
// 						'small' => __('Variable', 'thb_text_domain')
// 					));
// 				$thb_container->addField($thb_field);

// 	}
// 	add_action('init', 'thb_masonry_options');
// }

// $thb_metabox = new THB_Metabox( __('Layout options', 'thb_text_domain'), 'options' );
// $thb_metabox->setPriority('high');


// $thb_pages->addMetabox($thb_metabox, $thb_masonry_templates);

if( !function_exists('thb_masonry_layout') ) {
	function thb_masonry_layout( $classes ) {
		$id = thb_get_page_ID();
		$classes[] = thb_get_post_meta($id, 'layout_position');

		return $classes;
	}

	add_action('body_class', 'thb_masonry_layout');
}

/**
 * Page options
 */
if( ! function_exists('thb_exposure_style_page_options') ) {
	function thb_exposure_style_page_options() {
		$thb_page_layout_metabox_templates = array(
			"default",
			"template-archives.php",
			"template-blog-carousel.php",
			"template-blog-classic.php",
			"template-blog-timeline.php",
			"template-contact.php",
			"template-page-full.php",
			"template-photogallery.php",
			"template-portfolio-carousel.php",
			"template-portfolio-masonry.php",
			"template-showcase.php",
			"single.php",
			"single-works.php"
		);

		$thb_container = new THB_MetaboxFieldsContainer( __('Page style options', 'thb_text_domain'), 'page_style_options_container' );
			$field = new THB_ColorField( 'background_color' );
			$field->setLabel( __('Background color', 'thb_text_domain') );
			$thb_container->addField($field);

			$field = new THB_CheckboxField( 'overlay_off' );
			$field->setLabel( __('Remove the background overlay', 'thb_text_domain') );
			$thb_container->addField($field);

			if( thb_is_admin_template('single-works.php') ) {
				$field = new THB_CheckboxField( 'expand_info_box' );
				$field->setLabel( __('Auto-expand the info box on page load', 'thb_text_domain') );
				$thb_container->addField($field);
			}

		foreach( $thb_page_layout_metabox_templates as $template ) {
			if( thb_is_admin_template($template) ) {
				$post_type = thb_theme()->getPostType( thb_get_post_type_from_template($template) );
				$thb_metabox = $post_type->getMetabox('layout');
				$thb_metabox->addContainer($thb_container);
			}
		}
	}

	add_action('init', 'thb_exposure_style_page_options');
}

// Theme body classes ----------------------------------------------------------

if( !function_exists('thb_theme_body_classes') ) {
	function thb_theme_body_classes( $classes ) {
		if( thb_is_page_template('single-works.php') ) {
			$expand_info_box = thb_get_post_meta( thb_get_page_ID(), 'expand_info_box' );

			if( $expand_info_box ) {
				$classes[] = 'thb-expand-info-box';
			}
		}

		return $classes;
	}

	add_filter( 'body_class', 'thb_theme_body_classes' );
}

// Custom CSS ------------------------------------------------------------------

if( !function_exists('thb_page_style_css') ) {
	function thb_page_style_css() {
		$rules = array();
		$thb_page_id = thb_get_page_ID();
		$bg_color = thb_get_post_meta($thb_page_id, 'background_color');
		$overlay_off = thb_get_post_meta($thb_page_id, 'overlay_off');

		if( !empty($bg_color) ) {
			$rules[] = thb_get_css_selector('body', array(
				thb_get_css_rule('background-color', $bg_color)
			));
		}

		if( $overlay_off == '1' ) {
			$rules[] = thb_get_css_selector('.thb-page-overlay', array(
				thb_get_css_rule('background', 'transparent')
			));
		}

		return implode(' ', $rules);
	}
}

thb_theme()->getCustomization()->additionalStyles[900] = 'thb_page_style_css';