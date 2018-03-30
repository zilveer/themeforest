<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	- general
	- global
	- js
	- menu
	- sidebars
	- widgets
	- metaboxes
	- shortcodes
	- breadcrumbs
	- networks
	- networks_path
	- panel

*/

/*===============================================

	T H E M E   O P T I O N S
	Unique options of the theme

===============================================*/

	global $st_Options;

	$st_Options = array (
	
		'general'		=>	array (
								'name'				=>	'upward_',
								'label'				=>	'Upward',
								'version'			=>	'1.0.7',
								'url'				=>	'http://strictthemes.com/theme/upward',
								'url-demo'			=>	'http://strictthemes.com/upward',
								'documentation'		=>	'http://strictthemes.com/documentation',
								'developer'			=>	'StrictThemes',
								'developer-url'		=>	'http://strictthemes.com',
								'stkit-min'			=>	'1.1.1',
								),
		'global'		=>	array (
								'content_width'		=>	837,
								'rss'				=>	true,
								'lang'				=>	true,
								'excerpt'			=>	25, // words
								'excerpt-in-search'	=>	true,
								'tag-cloud'			=>	13, // px
								'post-formats'		=>	array(
															'enabled'		=>	true,
															'post-title'	=>	true, // metabox option
															'aside'			=>	array(
																						'status'		=>	false,
																						'label'			=>	__( 'Aside', 'strictthemes' ),
																					),
															'image'			=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Image', 'strictthemes' ),
																					),
															'gallery'		=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Gallery', 'strictthemes' ),
																					),
															'audio'			=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Audio', 'strictthemes' ),
																					),
															'video'			=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Video', 'strictthemes' ),
																					),
															'link'			=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Link', 'strictthemes' ),
																					),
															'quote'			=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Quote', 'strictthemes' ),
																					),
															'status'		=>	array(
																						'status'		=>	true,
																						'label'			=>	__( 'Status', 'strictthemes' ),
																					),
															'chat'			=>	array(
																						'status'		=>	false,
																						'label'			=>	__( 'Chat', 'strictthemes' ),
																					),
															),
								'images'			=>	array(
															'thumbnail'		=>	array(
																						'status'		=>	true,
																						'width'			=>	150,
																						'height'		=>	150,
																						'crop'			=>	true,
																						),
															'medium'			=>	array(
																						'status'		=>	true,
																						'width'			=>	300,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															'large'				=>	array(
																						'status'		=>	true,
																						'width'			=>	1200,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															'archive-image'		=>	array(
																						'status'		=>	true,
																						'width'			=>	837,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															'post-image'		=>	array(
																						'status'		=>	true,
																						'width'			=>	667,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															'project-thumb'		=>	array(
																						'status'		=>	true,
																						'width'			=>	262,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															'project-medium'	=>	array(
																						'status'		=>	true,
																						'width'			=>	574,
																						'height'		=>	9999,
																						'crop'			=>	false,
																						),
															),
								'custom-background'	=>	true,
								'custom-header'		=>	false,
								),
		'ctp'			=>	array (
								'post'			=>	'st_project',
								'category'		=>	'st_category',
								'tag'			=>	'st_tag',
								),
		'js'			=>	array (
								'st'			=>	true,
								'menu'			=>	true,
								'theme'			=>	false,
								'prettyPhoto'	=>	true,
								'mediaelement'	=>	true,
								'ie'			=>	true,
								),
		'menu'			=>	array (
								'primary'		=>	true,
								'secondary'		=>	true,
								),
		'sidebars'		=>	array (
								'default'		=>	true,
								'post-sidebar'	=>	true,
								'homepage'		=>	2,
								'projects'		=>	true,
								'footer'		=>	4,
								),
		'widgets'		=>	array (
								'sharrre'		=>	true,
								'contact-info'	=>	true,
								'flickr'		=>	true,
								'recent-posts'	=>	true,
								'subscribe'		=>	true,
								),
		'metaboxes'		=>	array (
								'sidebar'		=>	true,
								'post-options'	=>	true,
								),
		'shortcodes'	=>	array (
								'status'		=>	true,
								'column'		=>	true,
								'ul'			=>	true,
								'button'		=>	true,
								'alert'			=>	true,
								'highlight'		=>	true,
								'dropcap'		=>	true,
								'pullquote'		=>	true,
								'toggle'		=>	true,
								'accordion'		=>	true,
								'tabs'			=>	true,
								'googlemap'		=>	true,
								'pricing-table'	=>	true,
								'sidebar'		=>	true,
								'clear'			=>	true,
								'notice'		=>	true,
								'skill'			=>	true,
								'icon-box'		=>	true,
								'gallery'		=>	true,
								),
		'breadcrumbs'	=>	true,
		'networks'		=>	array (
								'life_500px',
								'life_Behance',
								'life_Blogger',
								'life_Delicious',
								'life_DeviantART',
								'life_Digg',
								'life_Dopplr',
								'life_Dribbble',
								'life_Evernote',
								'life_Facebook',
								'life_Flickr',
								'life_Forrst',
								'life_GitHub',
								'life_GooglePlus',
								'life_Grooveshark',
								'life_Instagram',
								'life_Lastfm',
								'life_LinkedIn',
								'life_MySpace',
								'life_Path',
								'life_Picasa',
								'life_Pinterest',
								'life_Posterous',
								'life_Reddit',
								'life_RSS',
								'life_Skype',
								'life_SoundCloud',
								'life_Spotify',
								'life_Stumbleupon',
								'life_Tumblr',
								'life_Twitter',
								'life_Viddler',
								'life_Vimeo',
								'life_Virb',
								'life_WordPress',
								'life_Youtube',
								'life_Zerply'
								),
		'networks_path'	=>	'18/social/color/',
		'panel'			=>	array(
								'major'			=>	array (
														'status'	=>	true,
														'general'	=>	array(
																			'status'		=>	true,
																			'logo_img'		=>	true,
																			'favicon'		=>	true,
																			'copyrights'	=>	true,
																			'dev_link'		=>	true,
																			'analytics'		=>	true,
																			),
														'blog'		=>	array(
																			'status'		=>	true,
																			'template'		=>	array(
																									'default'			=>	array (
																																'label'			=> __( 'Default', 'strictthemes' ),
																																'status'		=> true,
																																'desc'			=> __( 'This is standard template.', 'strictthemes' ),
																																),
																									't1'				=>	array (
																																'label'			=> '1',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't2'				=>	array (
																																'label'			=> '2',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't3'				=>	array (
																																'label'			=> '3',
																																'status'		=> true,
																																'desc'			=> __( 'This template comes with an excerpt instead of a whole post.', 'strictthemes' ),
																																),
																									't4'				=>	array (
																																'label'			=> '4',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't5'				=>	array (
																																'label'			=> '5',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't6'				=>	array (
																																'label'			=> '6',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't7'				=>	array (
																																'label'			=> '7',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									't8'				=>	array (
																																'label'			=> '8',
																																'status'		=> true,
																																'desc'			=> __( 'Minimalistic template. Also it used on search page.', 'strictthemes' ),
																																),
																									't9'				=>	array (
																																'label'			=> '9',
																																'status'		=> false,
																																'desc'			=> '',
																																),
																									),
																			),
														'post'		=> array(
																			'status'			=>	true,
																			'after_title'		=>	true,
																			'before_post'		=>	true,
																			'post_feat_image'	=>	true,
																			'excerpt'			=>	true,
																			'post_meta'			=>	array(
																										'status'		=>	true,
																										'author_info'	=>	true,
																										'post_views'	=>	true,
																										'nice_time'		=>	true
																										),
																			'after_post'		=>	true,
																			'post_comments'		=>	true
																			),
														'page'		=> array(
																			'status'			=>	true,
																			'page_comments'		=>	true
																			),
														'sidebar'		=> array(
																			'status'			=>	true,
																			'additional'		=>	true
																			),
														),
								'layout'		=>	array(
														'status'	=> true,
														'general'	=>	array(
																			'status'			=>	true,
																			'layout_type'		=>	true,
																			),
														'header'	=>	array(
																			'status'			=>	false
																			),
														'footer'	=>	array(
																			'status'			=>	true,
																			'scheme'			=>	array(
																										'status'			=>	true,
																										'default'			=>	'5',
																									),
																			),
														'social'	=>	array(
																			'status'			=>	true,
																			),
														),
								'projects'		=>	array (
														'status'	=> true,
														'general'	=>	array(
																			'status'			=>	true,
																			'slugs'				=>	true
																			),
														'portfolio'	=>	array(
																			'status'			=>	true,
																			'projects_qty'		=>	true,
																			'templates'			=>	array (
																										'status'		=>	false,
																										'default'		=>	array (
																																'status'		=>	false,
																																'label'			=>	__( 'Default', 'strictthemes' ),
																																'dummy'			=>	true,
																																),
																										't1'			=>	array (
																																'status'		=>	true,
																																'label'			=>	'1',
																																'dummy'			=>	true,
																																),
																										't2'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'2',
																																'dummy'			=>	true,
																																),
																										't3'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'3',
																																'dummy'			=>	false,
																																),
																										't4'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'4',
																																'dummy'			=>	true,
																																),
																										't5'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'5',
																																'dummy'			=>	true,
																																),
																										't6'			=>	array (
																																'status'		=>	false,
																																'label'			=>	'6',
																																'dummy'			=>	false,
																																)
																										),
																			'template-default'	=>	't1',
																			),
														'taxonomy'	=>	array(
																			'status'			=>	true,
																			),
														),
								'fonts'			=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'			=>	true,
																			'font_size'			=>	true,
																			'font_type'			=>	true,
																			'font_custom'		=>	true,
																			),
														),
								'style'			=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'			=>	true,
																			'styles'			=>	array(
																										'status'		=>	true,
																										'light' 		=>	array (
																																'status'		=>	'default',
																																'label'			=>	__( 'Light', 'strictthemes' ),
																																),
																										'dark'			=>	array (
																																'status'		=>	true,
																																'label'			=>	__( 'Dark', 'strictthemes' ),
																																),
																										),
																			'colors'			=>	array(
																										'status'		=>	true,
																										'default'		=>	'1c93c5',
																										'primary'		=>	array(
																																'hex'			=>	'3a3346',
																																'colors'		=>	array(
																																						),
																																						'h1, h2, h3, h4, h5, h6',
																																						'h2 a, h3 a, h4 a, h5 a, h6 a',
																																						'#sidebar .widget_text h1',
																																						'#sidebar .widget_text h2',
																																						'#sidebar .widget_text h3',
																																						'#sidebar .widget_text h4',
																																						'#sidebar .widget_text h5',
																																						'#sidebar .widget_text h6',
																																						'a:hover',
																																						'ul.menu > li > a',
																																						'.nav-next a, .nav-previous a',
																																						'#but-prev-next a',
																																						'#wp-pagenavibox .wp-pagenavi *',
																																						'.widget_custom_menu > li > ul > li.current-menu-item > a',
																																'backgrounds'	=>	array(
																																						//'body.dark', // needed
																																						'a.button:hover',
																																						'caption',
																																						'th',
																																						'input[type="button"]:hover',
																																						'input[type="submit"]:hover',
																																						'.icons-social a',
																																						'ul.menu ul li',
																																						'ul.menu-2 ul li',
																																						'#selectElement',
																																						'.status-header',
																																						'.pricing-table-gray .pricing-table-title',
																																						'.pricing-table-gray .pricing-table-price',
																																						'.pricing-table-gray .button',
																																						'.pricing-table-dark .pricing-table-title',
																																						'.pricing-table-dark .pricing-table-price',
																																						'.pricing-table-dark .button',
																																						'.notice',
																																						'#sidebar .widget',
																																						'.more-link:hover',
																																						'#layout .mejs-controls',
																																						'#layout .mejs-volume-slider',
																																						'.tagcloud a:hover',
																																						'.widget_nav_menu',
																																						'.widget_nav_menu h5',
																																						'.sidebar-footer .widget-posts-icon',
																																						),
																																'border-top'	=>	array(
																																						'body:before',
																																						'#header-layout-2:after',
																																						'ul.menu ul:after',
																																						'ul.menu ul li:first-child',
																																						'ul.menu-2 ul:after',
																																						'ul.menu-2 ul li:first-child',
																																						'#sidebar .widget:after',
																																						),
																																'border-bottom'	=>	array(
																																						'body:after',
																																						'#footer:after',
																																						'ul.menu > li > ul > li:first-child > a:before',
																																						'ul.menu-2 > li > ul > li:first-child > a:before',
																																						'#sidebar .widget:before',
																																						'#sidebar .widget_calendar:before',
																																						),
																																),
																										'primary-alt-a'	=>	array(
																																'steps'			=>	'120',
																																'color'	=>	array(
																																						'.dark #content-layout',
																																						'#sidebar .widget',
																																						'.widget-subscribe form > div',
																																						),
																																),
																										'primary-alt-b'	=>	array(
																																'steps'			=>	'-10',
																																'backgrounds'	=>	array(
																																						'.dark #content-layout',
																																						),
																																'border-top'	=>	array(
																																						'.dark .single-author-upic:before',
																																						'.dark .avatar-box:before',
																																						'.dark #footer-layout:before',
																																						'.dark .projects-t1-wrapper a.project-thumb:before',
																																						),
																																'border-bottom'	=>	array(
																																						'.dark .single-author-upic:after',
																																						'.dark .avatar-box:after',
																																						'.dark #header-layout:after',
																																						'.dark .projects-t1-wrapper a.project-thumb:after',
																																						),
																																),
																										'secondary'		=>	array(
																																'hex'			=>	'1c93c5',
																																'colors'		=>	array(
																																						'a',
																																						'.st-ul li.st-current',
																																						'.st-ul li.st-current:hover',
																																						'.sidebar-footer .widget-info p a.mailto',
																																						'fieldset legend',
																																						),
																																'backgrounds'	=>	array(
																																						//'::selection',
																																						'body',
																																						'.projects-term-title h1:before',
																																						'input[type="button"]',
																																						'input[type="submit"]',
																																						'#logo',
																																						'ul.menu ul li:hover',
																																						'ul.menu-2 ul li:hover',
																																						'#but-prev-next a:hover',
																																						'#wp-pagenavibox a.page:hover',
																																						'#wp-pagenavibox a.first:hover',
																																						'#wp-pagenavibox a.last:hover',
																																						'#wp-pagenavibox a.previouspostslink:hover',
																																						'#wp-pagenavibox a.nextpostslink:hover',
																																						'.term-title h1:before',
																																						'a.button',
																																						'.toggle-closed .toggle-title span',
																																						'.pricing-table-featured .pricing-table-title',
																																						'.pricing-table-featured .pricing-table-price',
																																						'.pricing-table-featured .button',
																																						'.skill-bar',
																																						'.st-gallery ol li.st-gallery-tab-current',
																																						'.more-link',
																																						'#layout .mejs-time-loaded',
																																						'#sidebar .widget_search',
																																						'.tagcloud a',
																																						'.widget_custom_menu > li > a:hover',
																																						'.widget_custom_menu > li.wHover',
																																						'#sidebar .widget-posts',
																																						'.widget-posts-icon:hover',
																																						'#sidebar .sharrre .count',
																																						),
																																'border-top'	=>	array(
																																						'fieldset',
																																						'#logo:after',
																																						'.st-ul li.st-current',
																																						'.st-ul li.st-current:hover',
																																						'#sidebar .widget_search:after',
																																						'#sidebar .widget-posts:after',
																																						'#sidebar .sharrre .count:before',
																																						'#sidebar .sharrre .count:after',
																																						),
																																'border-right'	=>	array(
																																						'fieldset',
																																						),
																																'border-bottom'	=>	array(
																																						'fieldset',
																																						'#logo:before',
																																						'#sidebar .widget_search:before',
																																						'#sidebar .widget-posts:before',
																																						),
																																'border-left'	=>	array(
																																						'fieldset',
																																						),
																																),
																										),
																			'background-image'	=>	'',
																			'responsive'		=>	true,
																			),
														'custom'	=>	array(
																			'status'			=>	true,
																			),
														),
								'misc'			=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'		=>	true,
																			),
														'admin_bar'	=>	true,
														'hidpi'		=>	true,
														),
								'import'		=>	array(
														'status'	=>	true,
														),
								'update'		=>	array(
														'status'	=>	true,
														'general'	=>	array(
																			'status'		=>	true,
																			'source'		=>	'themeforest',
																			),
														),
								),
	); // $st_Options

?>