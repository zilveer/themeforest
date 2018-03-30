<?php
/**
 * This file contains the main post settings for the theme.
 */

global $pexeto;

$pexeto_cats = pexeto_get_categories();
array_unshift( $pexeto_cats, array( 'id'=>-1, 'name'=>'All Categories' ) );

$pexeto_theme_opt_var = get_option(PEXETO_SHORTNAME.'_options');
$show_rel_posts_default = empty($pexeto_theme_opt_var) ? true : false;

$pexeto_pages_options= array( array(
		'name' => 'Post &amp; Page Settings',
		'type' => 'title',
		'img' => 'icon-document'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'pages', 'name'=>'Pages' ),
			array( 'id'=>'general', 'name'=>'Blog Posts' ), 
			array( 'id'=>'archives', 'name'=>'Post Archives' ),
			array( 'id'=>'portfolio_posts', 'name'=>'Portfolio Posts' ) )
	),

	/* ------------------------------------------------------------------------*
	 * GENERAL PAGE SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'pages'
	),


	array(
		'name' => 'Display page title',
		'id' => 'show_page_title',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If "ON" selected, the page title will be displayed in the 
			header of the page as a main title. You can also 
			overwrite this option in the single page settings section where
			the display page title option has a higher priority.'
	),

	array(
		'name' => 'Display comments',
		'id' => 'page_comments',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'By default comments won\'t be displayed on pages, but if enable
			this option, you will be able to enable/disable comments for 
			the separate pages in the "Allow comments" field of the page.<br />
			Note: This option is available for the Default Page and Full-width 
			custom page templates only.'
	),


	array(
		'type' => 'close' ),

	/* ------------------------------------------------------------------------*
	 * POST SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'general'
	),



	array(
		'name' => 'Single Post Layout',
		'id' => 'post_layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'right', 'name'=>'Right Sidebar' ), 
			array( 'id'=>'left', 'name'=>'Left Sidebar' ), 
			array( 'id'=>'full', 'name'=>'Full width' ) ),
		'std' => 'right'
	),


	array(
		'name' => 'Single post sidebar',
		'id' => 'post_sidebar',
		'type' => 'select',
		'options' => pexeto_get_content_sidebars(),
		'std' => 'default'
	),


	array(
		'name' => 'Show sections from post info',
		'id' => 'exclude_post_sections',
		'type' => 'multicheck',
		'options' => array( 
			array( 'id'=>'date', 'name'=>'Post Date' ), 
			array( 'id'=>'author', 'name'=>'Post Author' ), 
			array( 'id'=>'category', 'name'=>'Post Category' ), 
			array( 'id'=>'comments', 'name'=>'Comment Number' ) ),
		'class'=>'exclude',
		'desc' => 'You can select the post info sections that will be displayed
		to each post.' )
	,

	array(
		'name' => 'Show post summary as',
		'id' => 'post_summary',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'readmore', 'name'=>'Separated with \'Read More\' tag' ), 
			array( 'id'=>'excerpt', 'name'=>'Excerpt' ) ),
		'std' => 'readmore',
		'desc' => 'Using the "Read More" 
			tag is more flexible than using the excerpt. With this option selected, 
			only the text that is displayed before the "More" tag will be displayed 
			as summary. You can insert a "Read More" tag by using the "Insert Read More tag" 
			button from the WordPress content editor.<br /><br />
			With the Excerpt option selected, only the first several words of the 
			post will be displayed as summary.'
	),

	array(
		'text' => '<h3>Related posts section</h3>',
		'type' => 'documentation'
	),

	array(
		'name' => 'Show related posts after post content',
		'id' => 'show_related_posts',
		'type' => 'checkbox',
		'std' =>$show_rel_posts_default
	),

	array(
		'name' => 'Show posts from categories',
		'id' => 'related_posts_cat',
		'type' => 'select',
		'options' => array_merge(
			array(
				array( 'name'=>'Posts from the same categories', 'id'=>'related' ),
				array( 'name'=>'All categories', 'id'=>'all' )
			),
			pexeto_get_categories()
		),
		'std' => 'related'
	),


	array(
		'name' => 'Show posts formats',
		'id' => 'exclude_related_posts',
		'type' => 'multicheck',
		'options' => pexeto_get_post_format_options(),
		'class'=>'exclude'
	),

	array(
		'name' => 'Number of columns',
		'id' => 'related_posts_columns',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'2', 'name'=>'2' ), 
			array( 'id'=>'3', 'name'=>'3' ), 
			array( 'id'=>'4', 'name'=>'4' ) ),
		'std' => '3'
	),

	array(
		'name' => 'Order posts by',
		'id' => 'related_posts_order',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'date', 'name'=>'Date' ), 
			array( 'id'=>'random', 'name'=>'Random order' )),
		'std' => 'date'
	),

	array(
		'name' => 'Custom thumbnail height',
		'id' => 'related_posts_height',
		'type' => 'text',
		'suffix' => 'px'
	),


	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * ARCHIVE SETTINGS
	 * ------------------------------------------------------------------------*/


	array(
		'type' => 'subtitle',
		'id'=>'archives'
	),


	array(
		'name' => 'Layout',
		'id' => 'archive_layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'right', 'name'=>'Right Sidebar' ), 
			array( 'id'=>'left', 'name'=>'Left Sidebar' ), 
			array( 'id'=>'full', 'name'=>'Full width' ) ),
		'std' => 'right',
		'desc' => 'This layout setting will affect the post index page, archives 
		and search pages.'
	),

	array(
		'name' => 'Sidebar',
		'id' => 'archive_sidebar',
		'type' => 'select',
		'options' => pexeto_get_content_sidebars(),
		'std' => 'default'
	),

	array(
		'type' => 'close' ),

	/* ------------------------------------------------------------------------*
	 * PORTFOLIO POSTS SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'portfolio_posts'
	),

	array(
		'text' => '<h3>Portfolio Thumbnail Settings</h3>',
		'type' => 'documentation'
	),

	array(
		'name' => 'Display post info in galleries and carousels',
		'id' => 'portfolio_exclude_info',
		'type' => 'multicheck',
		'options' => array(
			array( 'id'=>'title', 'name'=>'Title' ),
			array( 'id'=>'category', 'name'=>'Category' ),
		),
		'class'=>'exclude',
		'desc' => 'You can select the item info sections that will be displayed
		for each item in the portfolio gallery pages and portfolio carousels.',
	),

	array(
		'name' => 'Enable hover effects in galleries and carousels',
		'id' => 'portfolio_exclude_effects',
		'type' => 'multicheck',
		'options' => array(
			array( 'id'=>'icon', 'name'=>'Display Icon' ),
			array( 'id'=>'zoom', 'name'=>'Zoom Effect' ),
			array( 'id'=>'overlay', 'name'=>'Dark Overlay' ),
		),
		'class'=>'exclude',
		'desc' => 'In this section you can disable the default hover effects on the
		portfolio thumbnails in the portfolio galleries and carousels.',
	),

	array(
		'text' => '<h3>Single portfolio post settings</h3>',
		'type' => 'documentation'
	),

	array(
		'name' => 'Post Layout',
		'id' => 'portfolio_layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'right', 'name'=>'Right Sidebar' ),
			array( 'id'=>'left', 'name'=>'Left Sidebar' ), 
			array( 'id'=>'full', 'name'=>'Full width' ) ),
		'std' => 'right'
	),


	array(
		'name' => 'Post sidebar',
		'id' => 'portfolio_sidebar',
		'type' => 'select',
		'options' => pexeto_get_content_sidebars(),
		'std' => 'default'
	),

	array(
		'name' => 'Display comments',
		'id' => 'portfolio_comments',
		'type' => 'checkbox',
		'std' =>false
	),

	array(
		'name' => 'Display title',
		'id' => 'portfolio_show_title',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the portfolio item title will be displayed
		on its single standard page (for "Standard Page" items only)'
	),

	array(
		'name' => 'Display featured image',
		'id' => 'portfolio_show_featured',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the portfolio item featured image will be displayed
		on its single standard page (for "Standard Page" items only)'
	),

	array(
		'type' => 'close' ),

	array(
		'type' => 'close' ) );

$pexeto->options->add_option_set( $pexeto_pages_options );
