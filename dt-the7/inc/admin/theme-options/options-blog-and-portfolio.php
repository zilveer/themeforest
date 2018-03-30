<?php
/**
 * Templates settings
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("General", "theme-options", 'the7mk2'), "type" => "heading" );

/**
 * Categorization & sorting.
 */
$options[] = array(	"name" => _x('Categorization & sorting', 'theme-options', 'the7mk2'), "type" => "block" );

$options['general-filter_style'] = array(
	'id'      => 'general-filter_style',
	'name'    => _x( 'Style', 'theme-options', 'the7mk2' ),
	'type'    => 'images',
	'class'   => 'small',
	'std'     => 'ios',
	'options' => array(
		'ios'      => array(
			'title' => _x( 'No decoration', 'theme-options', 'the7mk2' ),
			'src' => '/inc/admin/assets/images/general-filter-no-decor.gif',
		),
		'minimal'  => array(
			'title' => _x( 'Background', 'theme-options', 'the7mk2' ),
			'src' => '/inc/admin/assets/images/general-filter-background.gif',
		),
		'material' => array(
			'title' => _x( 'Underline', 'theme-options', 'the7mk2' ),
			'src' => '/inc/admin/assets/images/general-filter-underline.gif',
		),
	),
	'show_hide' => array(
		'ios' => array(),
		'minimal' => array( 'general-filter_style-minimal' ),
		'material' => array( 'general-filter_style-material' ),
	),
);

$options[] = array( "type" => "js_hide_begin", "class" => "general-filter_style general-filter_style-minimal" );

$options['general-filter_style-minimal-border_radius'] = array(
	"name"		=> _x( 'Border radius (px)', 'theme-options', 'the7mk2' ),
	"id"		=> "general-filter_style-minimal-border_radius",
	"std"		=> '100',
	"type"		=> "text",
	"sanitize"	=> 'dimensions',
);

$options[] = array( "type" => "js_hide_end" );

$options[] = array( "type" => "js_hide_begin", "class" => "general-filter_style general-filter_style-material" );

$options['general-filter_style-material-line_size'] = array(
	"name"		=> _x( 'Line size (px)', 'theme-options', 'the7mk2' ),
	"id"		=> "general-filter_style-material-line_size",
	"std"		=> '2',
	"type"		=> "text",
	"sanitize"	=> 'dimensions'
);

$options[] = array( "type" => "js_hide_end" );

$options[] = array( 'type' => 'divider' );

$options['general-filter-font-family'] = array(
	'id'        => 'general-filter-font-family',
	'name'      => _x( 'Font', 'theme-options', 'the7mk2' ),
	'type'      => 'web_fonts',
	'std'       => 'Open Sans',
	'fonts'     => 'all',
);

$options['general-filter-font-size'] = array(
	'id'        => 'general-filter-font-size',
	'name'      => _x( 'Font size', 'theme-options', 'the7mk2' ),
	'type'      => 'slider',
	'sanitize'  => 'font_size',
	'std'       => 16,
	'options'   => array( 'min' => 9, 'max' => 120 ),
);

$options['general-filter_ucase'] = array(
	'id'   => 'general-filter_ucase',
	'name' => _x( 'Capitalize', 'theme-options', 'the7mk2' ),
	'type' => 'checkbox',
	'std'  => 0,
);

$options[] = array( 'type' => 'divider' );

presscore_options_apply_template( $options, 'indents', 'general-filter-padding', array(
	'left'   => array( 'std' => '5' ),
	'right'  => array( 'std' => '5' ),
	'top'    => array( 'std' => '5' ),
	'bottom' => array( 'std' => '5' ),
) );

$options[] = array( 'type' => 'divider' );

presscore_options_apply_template( $options, 'indents-margins', 'general-filter-margin', array(
	'left'   => array(  'std' => '5' ),
	'right'  => array(  'std' => '5' ),
) );

/**
 * Gap below categorization & before pagination.
 */
$options[] = array(	"name" => _x('Gap below categorization & before pagination', 'theme-options', 'the7mk2'), "type" => "block" );

$options['general-navigation_margin'] = array(
	'id' => 'general-navigation_margin',
	'name' => _x( 'Gap (px)', 'theme-options', 'the7mk2' ),
	'type' => 'text',
	'std' => '50',
	'sanitize' => 'dimensions',
	'class' => 'mini',
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Blog", "theme-options", 'the7mk2'), "type" => "heading" );

	/**
	 * Image Settings.
	 */
	$options[] = array(	"name" => _x('Image Settings', 'theme-options', 'the7mk2'), "type" => "block" );

		$options['blog-thumbnail_size'] = array(
			'name' => __( 'Single post thumbnail sizing', 'theme-options', 'the7mk2' ),
			'id' => 'blog-thumbnail_size',
			'type' => 'radio',
			'std' => 'original',
			'options' => array(
				'original' => __( 'Preserve images proportions', 'theme-options', 'the7mk2' ),
				'resize' => __( 'Resize images', 'theme-options', 'the7mk2' ),
			),
			'show_hide' => array( 'resize' => true ),
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			$options['blog-thumbnail_proportions'] = array(
				'name' => _x( 'Thumbnail proportions', 'theme-options', 'the7mk2' ),
				'id' => 'blog-thumbnail_proportions',
				'type' => 'square_size',
				'std' => array(
					'width' => 3,
					'height' => 2,
				),
			);

		$options[] = array( 'type' => 'js_hide_end' );

	/**
	 * Author info in posts
	 */
	$options[] = array(	"name" => _x('Author info in posts', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show author info in blog posts', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-show_author_in_blog',
			'std'   	=> 1,
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show_author_in_blog-yes.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Previous &amp; next buttons
	 */
	$options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show in blog posts', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-next_prev_in_blog',
			'type'		=> 'images',
			'class'     => 'small',
			'std'   	=> 1,
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-next-prev-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Back button.
	 */
	$options[] = array(	"name" => _x('Back button', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Back button', 'theme-options', 'the7mk2'),
			"id"		=> 'general-show_back_button_in_post',
			"std"		=> '0',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show-back-button-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// select
			$options[] = array(
				"name"		=> _x( 'Choose page', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-post_back_button_target_page_id',
				"type"		=> 'pages_list'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Meta information.
	 */
	$options[] = array(	"name" => _x('Meta information', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Meta information', 'theme-options', 'the7mk2'),
			"id"		=> 'general-blog_meta_on',
			"std"		=> '1',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-album_meta_on-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Date', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Comments', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Tags', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_tags',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Related posts.
	 */
	$options[] = array(	"name" => _x('Related posts', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Related posts', 'theme-options', 'the7mk2'),
			"id"		=> 'general-show_rel_posts',
			"std"		=> '0',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show_rel_posts-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// input
			$options[] = array(
				"name"		=> _x( 'Title', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_posts_head_title',
				"std"		=> __('Related Posts', 'the7mk2'),
				"type"		=> 'text',
			);

			// input
			$options[] = array(
				"name"		=> _x( 'Maximum number of related posts', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_posts_max',
				"std"		=> 6,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

// options placeholder
$options['blog_and_portfolio_placeholder'] = array();

// options placeholder
$options['blog_and_portfolio_advanced_tab_placeholder'] = array();