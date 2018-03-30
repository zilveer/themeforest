<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Customization.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Customization
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();
$thb_tc = $thb_theme->getCustomization();

$app_counter = 0;

// -----------------------------------------------------------------------------
// General
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_general', __('General', 'thb_text_domain') );

// Highlight color -------------------------------------------------------------

$thb_tc->addColorSetting(array(
	'a:hover,
	#logo a:hover,
	a#footerlogo:hover,
	form .required,
	.thb-gallery.flexslider .flex-direction-nav li a:hover:before,
	#filterlist li a:hover,
	#thb-full-background-carousel .elastislide-prev:hover:before,
	#thb-full-background-carousel .elastislide-next:hover:before,
	#main-nav ul li a:hover' => 'color',

	'#main-nav div ul li.current-menu-item,
	#main-nav div ul li.current_page_item,
	#page-links span,
	.thb-main-sidebar-toggle,
	#searchform #searchsubmit,
	.error404 #searchform #searchsubmit,
	.page-template-template-blog-timeline-php #timeline ul li.current a span,
	.page-template-template-blog-classic-php .thb-navigation ul li.current,
	.search-results .thb-navigation ul li.current,
	.archive .thb-navigation ul li.current,
	.home.blog .thb-navigation ul li.current,
	.page-template-template-blog-classic-php .thb-navigation ul li.current:hover,
	.search-results .thb-navigation ul li.current:hover,
	.archive .thb-navigation ul li.current:hover,
	.home.blog .thb-navigation ul li.current:hover,
	#thb-controls li.active a,
	#filterlist li.current a,
	.thb-shortcode.thb-toggle.open .thb-toggle-trigger:before,
	.thb-shortcode.thb-tabs .thb-tabs-nav li.open a,
	.thb-tagcloud a:hover,
	.page-template-template-blog-classic-php .thb-navigation ul .current,
	.search-results .thb-navigation ul .current,
	.archive .thb-navigation ul .current,
	.home.blog .thb-navigation ul .current,
	.page-template-template-blog-classic-php .thb-navigation ul .current:hover,
	.search-results .thb-navigation ul .current:hover,
	.archive .thb-navigation ul .current:hover,
	.home.blog .thb-navigation ul .current:hover,
	.responsive_480 .mobile-nav-active #mobile-nav-trigger,
	.responsive_480 #mobile-nav ul li.current-menu-item > a, 
	.responsive_480 #mobile-nav ul li.current_page_item > a' => 'background-color',

	'.jspDrag' => 'background',

	'::-webkit-selection' => 'background-color',
	'::-moz-selection' => 'background-color',
	'::selection' => 'background-color',

	'.alignleft .wp-caption-text,
	.alignright .wp-caption-text,
	.aligncenter .wp-caption-text,
	.alignnone .wp-caption-text,
	.gallery-item .gallery-caption,
	#thb-full-background-captions .slide .caption,
	.thb-tagcloud a' => 'border-left-color',

	'.page-template-template-blog-classic-php .thb-navigation ul li.current,
	.search-results .thb-navigation ul li.current,
	.archive .thb-navigation ul li.current,
	.home.blog .thb-navigation ul li.current,
	#thb-controls li.active a,
	.thb-flickr a:hover img,
	.page-template-template-blog-classic-php .thb-navigation ul .current,
	.search-results .thb-navigation ul .current,
	.archive .thb-navigation ul .current,
	#comments li.bypostauthor .comment_leftcol img,
	.home.blog .thb-navigation ul .current' => 'border-color',

	'.thb-text blockquote,
	.textwidget blockquote,
	.comment_body blockquote' => 'border-left-color',

	'.thb-overlay' => 'mixin-thb_overlay',

	'#main-nav div ul li.current-menu-item > a,
	#main-nav div ul li.current_page_item > a' => 'mixin-thb_main_nav_fix'

), '#ea3556', __('Highlight color', 'thb_text_domain'));

// Frame color -----------------------------------------------------------------

$thb_tc->addColorSetting(array(
	'#page:before, #page:after, #header, #footer' => 'background-color',

	'#main-nav div ul li ul' => 'mixin-thb_submenu'

), '#000000', __('Frame color', 'thb_text_domain'));

// Background color -----------------------------------------------------------------

$thb_tc->addColorSetting(array(
	'body' => 'background-color'
), "#000", __('Background color', 'thb_text_domain'));

// -----------------------------------------------------------------------------
// Header
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_header', __('Header', 'thb_text_domain') );

// Logo ------------------------------------------------------------------------

$thb_tc->addDivider( __('Logo', 'thb_text_domain') );

	$thb_tc->addFontsSettings('#logo', array(
		'font-family'    => 'Raleway',
		'font-size'      => '30',
		'line-height'    => '1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	));

	$thb_tc->addColorSetting(array(
		'#logo a' => 'color'
	), '#FFFFFF');

// Menu ------------------------------------------------------------------------

$thb_tc->addDivider( __('Menu', 'thb_text_domain') );

	$thb_tc->addFontsSettings('#main-nav div ul li a', array(
		'font-family'    => 'Raleway',
		'font-size'      => '14',
		'line-height'    => '3.4',
		'letter-spacing' => '0',
		'text-variant'   => '500',
		'text-transform' => 'uppercase'
	));

	$thb_tc->addColorSetting(array(
		'#main-nav div ul li a, #mobile-nav-trigger' => 'color'
	), '#FFFFFF');

// -----------------------------------------------------------------------------
// Content
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_content', __('Pages', 'thb_text_domain') );

	$thb_tc->addDivider( __('Page title', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.pageheader h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '68',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '200',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Meta', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.pageheader .meta', array(
		'font-family'    => 'Raleway',
		'font-size'      => '16',
		'line-height'    => '1.1',
		'letter-spacing' => '1',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Text', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '16',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Author name', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.single-post .meta.author h2', array(
		'font-family'    => 'Raleway',
		'font-size'      => '24',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Shortcode item title', 'thb_text_domain') );

	$thb_tc->addFontsSettings('#content .thb-shortcode .list .item .item-title h1 a', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '14',
		'line-height'    => '1.25',
		'letter-spacing' => '0',
		'text-variant'   => '700',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Headings H1', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text h1, .textwidget h1, .comment_body h1', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '48',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '700',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Headings H2', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text h2, .textwidget h2, .comment_body h2', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '36',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '700',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Headings H3', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text h3, .textwidget h3, .comment_body h3', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '30',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '600',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Headings H4', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text h4, .textwidget h4, .comment_body h4', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '24',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '600',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Headings H5', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text h5, .textwidget h5, .comment_body h5', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '18',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '600',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Headings H6', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.thb-text h6, .textwidget h6, .comment_body h6', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '18',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '600',
		'text-transform' => 'uppercase'
	), '');

// -----------------------------------------------------------------------------
// Slideshow
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_blog_sideshow', __('Slideshow', 'thb_text_domain') );

	$thb_tc->addDivider( __('Header', 'thb_text_domain') );

	$thb_tc->addFontsSettings('#thb-full-background-captions .slide .caption', array(
		'font-family'    => 'Raleway',
		'font-size'      => '68',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '100',
		'text-transform' => 'uppercase'
	), '');

// -----------------------------------------------------------------------------
// Blog
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_blog_timeline', __('Blog Timeline', 'thb_text_domain') );

	$thb_tc->addDivider( __('Header', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-timeline-php .hentry .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '68',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '200',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Quote', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-timeline-php .hentry.format-quote .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '48',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '200',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Meta', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-timeline-php .hentry .item-footer, .page-template-template-blog-timeline-php .hentry.format-quote .item-header cite', array(
		'font-family'    => 'Raleway',
		'font-size'      => '16',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '700',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Text', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-timeline-php .hentry .thb-text, .page-template-template-blog-timeline-php .hentry.format-link .item-header .linkurl', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '16',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'none'
	), '');

$thb_tc->addSection( 'thb_blog_carousel', __('Blog Carousel', 'thb_text_domain') );

	$thb_tc->addDivider( __('Header', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-carousel-php .hentry .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '28',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Quote', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-carousel-php .hentry.format-quote .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '28',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Meta', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-carousel-php .hentry .item-footer', array(
		'font-family'    => 'Raleway',
		'font-size'      => '13',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => 'regular',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Text', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-carousel-php .hentry .thb-text', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '13',
		'line-height'    => '1.54',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'none'
	), '');

$thb_tc->addSection( 'thb_blog_classic', __('Blog Classic', 'thb_text_domain') );

	$thb_tc->addDivider( __('Header', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-classic-php .hentry .item-header h1, .search-results .hentry .item-header h1, .archive .hentry .item-header h1, .home.blog .hentry .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '36',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Quote', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-classic-php .hentry.format-quote .item-header h1, .search-results .hentry .item-header h1, .archive .hentry .item-header h1, .home.blog .hentry .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '36',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Meta', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-classic-php .hentry .item-footer, .search-results .hentry .item-footer, .archive .hentry .item-footer, .home.blog .hentry .item-footer', array(
		'font-family'    => 'Raleway',
		'font-size'      => '16',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => 'regular',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Text', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-blog-classic-php .hentry .thb-text, .search-results .hentry .thb-text, .archive .hentry .thb-text, .home.blog .hentry .thb-text, .page-template-template-blog-classic-php .hentry.format-link .item-header .linkurl', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '13',
		'line-height'    => '1.54',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'none'
	), '');

// -----------------------------------------------------------------------------
// Portfolio
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_portfolio_carousel', __('Portfolio Carousel', 'thb_text_domain') );

	$thb_tc->addDivider( __('Work title', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-portfolio-carousel-php .hentry .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '48',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Category', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-portfolio-carousel-php .hentry .item-footer', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '13',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'uppercase'
	), '');

$thb_tc->addSection( 'thb_portfolio_masonry', __('Portfolio Masonry', 'thb_text_domain') );

	$thb_tc->addDivider( __('Work title', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.page-template-template-portfolio-masonry-php #thb-portfolio-container .item .item-header h1', array(
		'font-family'    => 'Raleway',
		'font-size'      => '26',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'uppercase'
	), '');

// -----------------------------------------------------------------------------
// Sidebar
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_sidebar', __('Sidebar', 'thb_text_domain') );

	$thb_tc->addDivider( __('Widget title', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.widget header .widgettitle', array(
		'font-family'    => 'Raleway',
		'font-size'      => '18',
		'line-height'    => '1.1',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addDivider( __('Widget item title', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.sidebar .thb-shortcode .list .item .item-title h1 a', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '14',
		'line-height'    => '1.25',
		'letter-spacing' => '0',
		'text-variant'   => 'bold',
		'text-transform' => 'none'
	), '');

	$thb_tc->addDivider( __('Widget item text', 'thb_text_domain') );

	$thb_tc->addFontsSettings('.sidebar .widget', array(
		'font-family'    => 'Open+Sans',
		'font-size'      => '14',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'text-variant'   => '300',
		'text-transform' => 'none'
	), '');


// -----------------------------------------------------------------------------
// Footer
// -----------------------------------------------------------------------------

$thb_tc->addSection( 'thb_footer', __('Footer', 'thb_text_domain') );

$thb_tc->addDivider( __('Logo', 'thb_text_domain') );

	$thb_tc->addFontsSettings('#footerlogo', array(
		'font-family'    => 'Raleway',
		'font-size'      => '12',
		'line-height'    => '1.7',
		'letter-spacing' => '0',
		'text-variant'   => '800',
		'text-transform' => 'uppercase'
	), '');

	$thb_tc->addColorSetting(array(
		'#footerlogo' => 'color'
	), '#666');

$thb_tc->addDivider( __('Text', 'thb_text_domain') );

	$thb_tc->addFontsSettings('#footer', array(
		'font-family'    => 'Raleway',
		'font-size'      => '12',
		'line-height'    => '1.7',
		'letter-spacing' => '0',
		'text-variant'   => '200',
		'text-transform' => 'none'
	), '');

	$thb_tc->addColorSetting(array(
		'#footer' => 'color'
	), '#666');

// -----------------------------------------------------------------------------
// Mixins
// -----------------------------------------------------------------------------

if( !function_exists('thb_submenu') ) {
	function thb_submenu( $value=null, $selector=null ) {
		$rgb = thb_color_hexToRgb($value);
		$bg = 'background-color: rgba(' . implode(',', $rgb) . ', 0.8);';

		$css = '';

		$css .= $selector . ' {';
			$css .= $bg;
		$css .= '}';

		return $css;
	}
}

if( !function_exists('thb_overlay') ) {
	function thb_overlay( $value=null, $selector=null ) {
		$rgb = thb_color_hexToRgb($value);
		$bg = 'background-color: rgba(' . implode(',', $rgb) . ', 0.6);';

		$css = '';

		$css .= $selector . ' {';
			$css .= $bg;
		$css .= '}';

		return $css;
	}
}

if( !function_exists('thb_main_nav_fix') ) {
	function thb_main_nav_fix( $value=null, $selector=null ) {
		$color = 'color: #fff';

		$css = '';

		$css .= $selector . ' {';
			$css .= $color;
		$css .= '}';

		return $css;
	}
}

// -----------------------------------------------------------------------------

add_action( 'customize_register', array($thb_tc, 'register') );