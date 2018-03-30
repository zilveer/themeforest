<?php

/*
 * Add meta boxes for post & page options and page builder.
 */
function barcelona_meta_boxes() {

	/*
	 * Featured Image Options
	 */
	$barcelona_field_fimg = array(
		'id'          => 'barcelona_featured_image_style',
		'label'       => esc_html__( 'Featured Image Style', 'barcelona' ),
		'type'        => 'radio-image',
		'choices'     => array(
			array(
				'value'     => 'none',
				'label'     => esc_html__( 'None', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-none.png'
			),
			array(
				'value'     => 'cl',
				'label'     => esc_html__( 'Classic Featured Image', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fimg-cl.jpg'
			),
			array(
				'value'     => 'fw',
				'label'     => esc_html__( 'Full Width Featured Image', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fimg-fw.jpg'
			),
			array(
				'value'     => 'sw',
				'label'     => esc_html__( 'Screen Width Featured Image', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fimg-sw.jpg'
			),
			array(
				'value'     => 'sp',
				'label'     => esc_html__( 'Screen Width Parallax Featured Image', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fimg-sp.jpg'
			),
			array(
				'value'     => 'fs',
				'label'     => esc_html__( 'Full Screen Featured Image', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fimg-fs.jpg'
			),
			array(
				'value'     => 'fp',
				'label'     => esc_html__( 'Full Screen Parallax Featured Image', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fimg-fp.jpg'
			)
		)
	);

	/*
	 * Sidebar Position Options
	 */
	$barcelona_field_sidebar_position = array(
		'id'          => 'barcelona_sidebar_position',
		'label'       => esc_html__( 'Sidebar Position', 'barcelona' ),
		'type'        => 'radio-image',
		'choices'     => array(
			array(
				'value'     => 'right',
				'label'     => esc_html__( 'Sidebar Left', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/sidebar-'. ( is_rtl() ? 'left' : 'right' ) .'.jpg'
			),
			array(
				'value'     => 'left',
				'label'     => esc_html__( 'Sidebar Right', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/sidebar-'. ( is_rtl() ? 'right' : 'left' ) .'.jpg'
			),
			array(
				'value'     => 'none',
				'label'     => esc_html__( 'No Sidebar', 'barcelona' ),
				'src'       => BARCELONA_THEME_PATH .'includes/admin/images/sidebar-none.jpg'
			)
		)
	);

	/*
	 * Meta box for post options
	 */
	$barcelona_po = array(
		'id'        => 'barcelona_po',
		'title'     => esc_html__( 'Post Options', 'barcelona' ),
		'pages'     => array( 'post' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'barcelona_po_tab_fi',
				'label'       => esc_html__( 'Featured Image', 'barcelona' ),
				'type'        => 'tab'
			),
			$barcelona_field_fimg,
			array(
				'id'            => 'barcelona_featured_image_credit',
				'label'         => esc_html__( 'Featured Image Credit Line (Optional)', 'barcelona' ),
				'type'          => 'text'
			),
			array(
				'id'          => 'barcelona_po_tab_sidebar',
				'label'       => esc_html__( 'Sidebar', 'barcelona' ),
				'type'        => 'tab'
			),
			$barcelona_field_sidebar_position,
			array(
				'id'          => 'barcelona_default_sidebar',
				'label'       => esc_html__( 'Sidebar', 'barcelona' ),
				'type'        => 'sidebar-select'
			),
			array(
				'id'          => 'barcelona_po_tab_layout',
				'label'       => esc_html__( 'Layout', 'barcelona' ),
				'type'        => 'tab'
			),
			array(
				'id'          => 'barcelona_show_title',
				'label'       => esc_html__( 'Display Title', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_content',
				'label'       => esc_html__( 'Display Content', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_breadcrumb',
				'label'       => esc_html__( 'Display Breadcrumb', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_comments',
				'label'       => esc_html__( 'Display Comments', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_comment_voting',
				'label'       => esc_html__( 'Display Comment Voting Buttons', 'barcelona' ),
				'type'        => 'on-off',
				'class'       => 'barcelona-setting-indent',
				'condition'   => 'barcelona_show_comments:is(on)'
			),
			array(
				'id'          => 'barcelona_comment_voting_login_req',
				'label'       => esc_html__( 'Only logged-in users can vote comments', 'barcelona' ),
				'type'        => 'on-off',
				'class'       => 'barcelona-setting-indent',
				'condition'   => 'barcelona_show_comments:is(on),barcelona_show_comment_voting:is(on)',
				'operator'    => 'and'
			),
			array(
				'id'          => 'barcelona_show_tags',
				'label'       => esc_html__( 'Display Tags', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_social_sharing',
				'label'       => esc_html__( 'Display Social Sharing', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_author_box',
				'label'       => esc_html__( 'Display Author Box', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_voting',
				'label'       => esc_html__( 'Display Post Voting Buttons', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_post_voting_login_req',
				'label'       => esc_html__( 'Only logged-in users can vote this post', 'barcelona' ),
				'type'        => 'on-off',
				'class'       => 'barcelona-setting-indent',
				'condition'   => 'barcelona_show_voting:is(on)'
			),
			array(
				'id'          => 'barcelona_show_post_nav',
				'label'       => esc_html__( 'Display Post Navigation', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_related_posts',
				'label'       => esc_html__( 'Display Related Posts', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_post_meta_choices',
				'label'       => esc_html__( 'Post Meta Data', 'barcelona' ),
				'desc'        => esc_html__( 'Check which meta data to show for this post', 'barcelona' ),
				'std'         => '',
				'type'        => 'checkbox',
				'choices'     => array(
					array(
						'value'       => 'date',
						'label'       => esc_html__( 'Post Date', 'barcelona' )
					),
					array(
						'value'       => 'author',
						'label'       => esc_html__( 'Post Author', 'barcelona' )
					),
					array(
						'value'       => 'views',
						'label'       => esc_html__( 'Post Views', 'barcelona' )
					),
					array(
						'value'       => 'likes',
						'label'       => esc_html__( 'Post Votes', 'barcelona' )
					),
					array(
						'value'       => 'comments',
						'label'       => esc_html__( 'Post Comments', 'barcelona' )
					),
					array(
						'value'       => 'categories',
						'label'       => esc_html__( 'Post Categories', 'barcelona' )
					)
				),
				'section'     => 'ot-layout-settings',
			),
			array(
				'id'          => 'barcelona_po_tab_background',
				'label'       => esc_html__( 'Background', 'barcelona' ),
				'type'        => 'tab'
			),
			array(
				'id'          => 'barcelona_custom_background',
				'label'       => esc_html__( 'Post Background', 'barcelona' ),
				'type'        => 'background'
			),
			array(
				'id'          => 'barcelona_po_tab_ad',
				'label'       => esc_html__( 'Advertisement', 'barcelona' ),
				'type'        => 'tab'
			),
			array(
				'id'          => 'barcelona_post_content_ad',
				'label'       => esc_html__( 'Post Content Ad', 'barcelona' ),
				'type'        => 'select',
				'choices'     => array(
					array(
						'value' => 'inherit',
						'label' => esc_html__( 'Inherit (Same as single post settings)', 'barcelona' )
					),
					array(
						'value' => 'custom',
						'label' => esc_html__( 'Custom', 'barcelona' )
					)
				)
			),
			array(
				'id'          => 'barcelona_post_content_ad_1',
				'label'       => esc_html__( 'Post Content Ad (728x90)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to single post content for large screens.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'section'     => 'ot-layout-settings',
				'condition'   => 'barcelona_post_content_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			),
			array(
				'id'          => 'barcelona_post_content_ad_2',
				'label'       => esc_html__( 'Post Content Ad (468x60)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to single post content for small screens.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'section'     => 'ot-layout-settings',
				'condition'   => 'barcelona_post_content_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			),
			array(
				'id'          => 'barcelona_add_header_ad',
				'label'       => esc_html__( 'Header Ad', 'barcelona' ),
				'type'        => 'select',
				'choices'     => array(
					array(
						'value' => 'inherit',
						'label' => esc_html__( 'Inherit (Same as post settings)', 'barcelona' )
					),
					array(
						'value' => 'custom',
						'label' => esc_html__( 'Custom', 'barcelona' )
					),
					array(
						'value' => 'off',
						'label' => esc_html__( 'Disabled', 'barcelona' )
					)
				)
			),
			array(
				'id'          => 'barcelona_header_ad_1',
				'label'       => esc_html__( 'Header Ad for Large Screens (728x90)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to header for large screen sizes.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'condition'   => 'barcelona_add_header_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			),
			array(
				'id'          => 'barcelona_header_ad_2',
				'label'       => esc_html__( 'Header Ad for Small Screens (468x60)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to header for small screen sizes.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'condition'   => 'barcelona_add_header_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			)
		)
	);

	// Add post options defaults
	foreach ( $barcelona_po['fields'] as $k => $v ) {

		if ( $v['id'] == 'barcelona_po_tab_background' ) {
			break;
		}

		if ( $v['type'] != 'tab' ) {

			global $pagenow;

			$barcelona_opt_id = $v['id'];
			if ( $pagenow == 'post-new.php' ) {
				$barcelona_opt_id .= '__single';
			}

			$barcelona_po['fields'][ $k ]['std'] = barcelona_get_option( $barcelona_opt_id, true );

		}

	}

	/*
	 * Meta box for page options
	 */
	$barcelona_pgo = array(
		'id'        => 'barcelona_pgo',
		'title'     => esc_html__( 'Page Options', 'barcelona' ),
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'barcelona_po_tab_fi',
				'label'       => esc_html__( 'Featured Image', 'barcelona' ),
				'type'        => 'tab'
			),
			$barcelona_field_fimg,
			array(
				'id'          => 'barcelona_po_tab_sidebar',
				'label'       => esc_html__( 'Sidebar', 'barcelona' ),
				'type'        => 'tab'
			),
			$barcelona_field_sidebar_position,
			array(
				'id'          => 'barcelona_default_sidebar',
				'label'       => esc_html__( 'Sidebar', 'barcelona' ),
				'type'        => 'sidebar-select'
			),
			array(
				'id'          => 'barcelona_po_tab_layout',
				'label'       => esc_html__( 'Layout', 'barcelona' ),
				'type'        => 'tab'
			),
			array(
				'id'          => 'barcelona_show_title',
				'label'       => esc_html__( 'Display Title', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_content',
				'label'       => esc_html__( 'Display Content', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_breadcrumb',
				'label'       => esc_html__( 'Show Breadcrumb', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_comments',
				'label'       => esc_html__( 'Display Comments', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_comment_voting',
				'label'       => esc_html__( 'Display Comment Voting Buttons', 'barcelona' ),
				'type'        => 'on-off',
				'class'       => 'barcelona-setting-indent',
				'condition'   => 'barcelona_show_comments:is(on)'
			),
			array(
				'id'          => 'barcelona_comment_voting_login_req',
				'label'       => esc_html__( 'Only logged-in users can vote comments', 'barcelona' ),
				'type'        => 'on-off',
				'class'       => 'barcelona-setting-indent',
				'condition'   => 'barcelona_show_comments:is(on),barcelona_show_comment_voting:is(on)',
				'operator'    => 'and'
			),
			array(
				'id'          => 'barcelona_show_social_sharing',
				'label'       => esc_html__( 'Display Social Sharing', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_author_box',
				'label'       => esc_html__( 'Display Author Box', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_show_voting',
				'label'       => esc_html__( 'Display Post Voting Buttons', 'barcelona' ),
				'type'        => 'on-off'
			),
			array(
				'id'          => 'barcelona_post_voting_login_req',
				'label'       => esc_html__( 'Only logged-in users can vote this post', 'barcelona' ),
				'type'        => 'on-off',
				'class'       => 'barcelona-setting-indent',
				'condition'   => 'barcelona_show_voting:is(on)'
			),
			array(
				'id'          => 'barcelona_post_meta_choices',
				'label'       => esc_html__( 'Page Meta Data', 'barcelona' ),
				'desc'        => esc_html__( 'Check which meta data to show for this page', 'barcelona' ),
				'std'         => '',
				'type'        => 'checkbox',
				'choices'     => array(
					array(
						'value'       => 'date',
						'label'       => esc_html__( 'Page Date', 'barcelona' )
					),
					array(
						'value'       => 'author',
						'label'       => esc_html__( 'Page Author', 'barcelona' )
					),
					array(
						'value'       => 'views',
						'label'       => esc_html__( 'Page Views', 'barcelona' )
					),
					array(
						'value'       => 'likes',
						'label'       => esc_html__( 'Page Votes', 'barcelona' )
					),
					array(
						'value'       => 'comments',
						'label'       => esc_html__( 'Page Comments', 'barcelona' )
					)
				),
				'section'     => 'ot-layout-settings',
			),
			array(
				'id'          => 'barcelona_po_tab_background',
				'label'       => esc_html__( 'Background', 'barcelona' ),
				'type'        => 'tab'
			),
			array(
				'id'          => 'barcelona_custom_background',
				'label'       => esc_html__( 'Page Background', 'barcelona' ),
				'type'        => 'background'
			),
			array(
				'id'    => 'barcelona_po_tab_ad',
				'label' => esc_html__( 'Advertisement', 'barcelona' ),
				'type'  => 'tab'
			),
			array(
				'id'          => 'barcelona_post_content_ad',
				'label'       => esc_html__( 'Page Content Ad', 'barcelona' ),
				'type'        => 'select',
				'choices'     => array(
					array(
						'value' => 'inherit',
						'label' => esc_html__( 'Inherit (Same as page settings)', 'barcelona' )
					),
					array(
						'value' => 'custom',
						'label' => esc_html__( 'Custom', 'barcelona' )
					)
				)
			),
			array(
				'id'          => 'barcelona_post_content_ad_1',
				'label'       => esc_html__( 'Page Content Ad (728x90)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to page content for large screens.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'section'     => 'ot-layout-settings',
				'condition'   => 'barcelona_post_content_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			),
			array(
				'id'          => 'barcelona_post_content_ad_2',
				'label'       => esc_html__( 'Page Content Ad (468x60)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to page content for small screens.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'section'     => 'ot-layout-settings',
				'condition'   => 'barcelona_post_content_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			),
			array(
				'id'          => 'barcelona_add_header_ad',
				'label'       => esc_html__( 'Header Ad', 'barcelona' ),
				'type'        => 'select',
				'choices'     => array(
					array(
						'value' => 'inherit',
						'label' => esc_html__( 'Inherit (Same as page settings)', 'barcelona' )
					),
					array(
						'value' => 'custom',
						'label' => esc_html__( 'Custom', 'barcelona' )
					),
					array(
						'value' => 'off',
						'label' => esc_html__( 'Disabled', 'barcelona' )
					)
				)
			),
			array(
				'id'          => 'barcelona_header_ad_1',
				'label'       => esc_html__( 'Header Ad for Large Screens (728x90)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to header for large screen sizes.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'condition'   => 'barcelona_add_header_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			),
			array(
				'id'          => 'barcelona_header_ad_2',
				'label'       => esc_html__( 'Header Ad for Small Screens (468x60)', 'barcelona' ),
				'desc'        => esc_html__( 'Put the ad code to header for small screen sizes.', 'barcelona' ),
				'type'        => 'textarea-simple',
				'rows'        => 4,
				'condition'   => 'barcelona_add_header_ad:is(custom)',
				'class'       => 'barcelona-setting-indent barcelona-textarea-code'
			)
		)
	);

	// Add page options defaults
	foreach ( $barcelona_pgo['fields'] as $k => $v ) {

		if ( $v['id'] == 'barcelona_po_tab_background' ) {
			break;
		}

		if ( $v['type'] != 'tab' ) {

			global $pagenow;

			$barcelona_opt_id = $v['id'];
			if ( $pagenow == 'post-new.php' ) {
				$barcelona_opt_id .= '__page';
			}

			$barcelona_pgo['fields'][ $k ]['std'] = barcelona_get_option( $barcelona_opt_id, true );

		}

	}

	/*
	 * Featured Posts Options
	 */
	$barcelona_fp_choices = array(
		array(
			'value'     => 'none',
			'label'     => esc_html__( 'None', 'barcelona' ),
			'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-none.png'
		),
		array(
			'value'     => 'a',
			'label'     => esc_html__( 'Style A', 'barcelona' ),
			'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-a.png'
		),
		array(
			'value'     => 'b',
			'label'     => esc_html__( 'Style B', 'barcelona' ),
			'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-b.png'
		),
		array(
			'value'     => 'c',
			'label'     => esc_html__( 'Style C', 'barcelona' ),
			'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-c.png'
		),
		array(
			'value'     => 'd',
			'label'     => esc_html__( 'Style D', 'barcelona' ),
			'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-d.png'
		),
		array(
			'value'     => 'e',
			'label'     => esc_html__( 'Style E', 'barcelona' ),
			'src'       => BARCELONA_THEME_PATH .'includes/admin/images/fpstyle-e.png'
		)
	);

	/*
	 * Order by Field Options
	 */
	$barcelona_orderby_choices = array(
		array(
			'value' => 'date',
			'label' => esc_html__( 'Date', 'barcelona' )
		),
		array(
			'value' => 'views',
			'label' => esc_html__( 'Number of Views', 'barcelona' )
		),
		array(
			'value' => 'comments',
			'label' => esc_html__( 'Number of Comments', 'barcelona' )
		),
		array(
			'value' => 'votes',
			'label' => esc_html__( 'Number of Votes', 'barcelona' )
		),
		array(
			'value' => 'random',
			'label' => esc_html__( 'Random', 'barcelona' )
		),
		array(
			'value' => 'posts',
			'label' => esc_html__( 'Manual Post IDs', 'barcelona' )
		)
	);

	/*
	 * Meta box for page builder
	 */
	$barcelona_mod = array(
		'id'        => 'barcelona_pb',
		'title'     => esc_html__( 'Page Builder', 'barcelona' ),
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'barcelona_fp_style',
				'label'       => esc_html__( 'Featured Posts', 'barcelona' ),
				'type'        => 'radio-image',
				'std'         => 'none',
				'choices'     => $barcelona_fp_choices
			),
			array(
				'id'            => 'barcelona_fp_max_number_of_posts',
				'label'         => esc_html__( 'Max Number of Post', 'barcelona' ),
				'type'          => 'numeric-slider',
				'std'           => 3,
				'min_max_step'  => '1,100,1',
				'class'         => 'barcelona-max-number-of-posts barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'            => 'barcelona_fp_posts_offset',
				'label'         => esc_html__( 'Posts Offset', 'barcelona' ),
				'type'          => 'numeric-slider',
				'std'           => '0',
				'min_max_step'  => '0,100,1',
				'class'         => 'barcelona-posts-offset barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),

			array(
				'id'          => 'barcelona_fp_owl_choices',
				'label'       => esc_html__( 'Slider Options', 'barcelona' ),
				'desc'        => esc_html__( 'Check which options for slider', 'barcelona' ),
				'std'         => '',
				'type'        => 'checkbox',
				'choices'     => array(
					array(
						'value'       => 'autoplay',
						'label'       => esc_html__( 'Auto Play', 'barcelona' )
					),
					array(
						'value'       => 'loop',
						'label'       => esc_html__( 'Loop', 'barcelona' )
					),
					array(
						'value'       => 'stophover',
						'label'       => esc_html__( 'Stop on Hover', 'barcelona' )
					),
					array(
						'value'       => 'mousedrag',
						'label'       => esc_html__( 'Mouse Drag', 'barcelona' )
					),
					array(
						'value'       => 'touchdrag',
						'label'       => esc_html__( 'Touch Drag', 'barcelona' )
					)
				),
				'class'     => 'barcelona-filter-category barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),


			array(
				'id'          => 'barcelona_fp_post_meta_choices',
				'label'       => esc_html__( 'Page Meta Data', 'barcelona' ),
				'desc'        => esc_html__( 'Check which meta data to show for featured posts', 'barcelona' ),
				'std'         => '',
				'type'        => 'checkbox',
				'choices'     => array(
					array(
						'value'       => 'date',
						'label'       => esc_html__( 'Post Date', 'barcelona' )
					),
					array(
						'value'       => 'views',
						'label'       => esc_html__( 'Post Views', 'barcelona' )
					),
					array(
						'value'       => 'likes',
						'label'       => esc_html__( 'Post Votes', 'barcelona' )
					),
					array(
						'value'       => 'comments',
						'label'       => esc_html__( 'Post Comments', 'barcelona' )
					),
					array(
						'value'       => 'categories',
						'label'       => esc_html__( 'Post Categories', 'barcelona' )
					)
				),
				'class'     => 'barcelona-filter-category barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'            => 'barcelona_fp_filter_category',
				'label'         => esc_html__( 'Filter by Category', 'barcelona' ),
				'type'          => 'taxonomy-checkbox',
				'taxonomy'      => 'category',
				'class'         => 'barcelona-filter-category barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'            => 'barcelona_fp_filter_tag',
				'label'         => esc_html__( 'Filter by Tag Name', 'barcelona' ),
				'desc'          => esc_html__( 'Add tag(s) seperated by comma. i.e. sports, cooking', 'barcelona' ),
				'type'          => 'text',
				'class'         => 'barcelona-filter-tag barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'            => 'barcelona_fp_filter_post',
				'label'         => esc_html__( 'Filter by Post Manually', 'barcelona' ),
				'desc'          => esc_html__( 'Specify post ids separated by comma. i.e. 45,73,132,19', 'barcelona' ),
				'type'          => 'text',
				'class'         => 'barcelona-filter-post barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'            => 'barcelona_fp_orderby',
				'label'         => esc_html__( 'Order Posts by', 'barcelona' ),
				'type'          => 'select',
				'std'           => 'date',
				'choices'       => $barcelona_orderby_choices,
				'class'         => 'barcelona-orderby barcelona-half',
				'condition'     => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'        => 'barcelona_fp_order',
				'label'     => esc_html__( 'Posts Order Type', 'barcelona' ),
				'type'      => 'select',
				'std'       => 'desc',
				'choices'   => array(
					array(
						'value' => 'asc',
						'label' => esc_html__( 'Ascending', 'barcelona' )
					),
					array(
						'value' => 'desc',
						'label' => esc_html__( 'Descending', 'barcelona' )
					)
				),
				'class'     => 'barcelona-orderby barcelona-half',
				'condition' => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'        => 'barcelona_fp_prevent_duplication',
				'label'     => esc_html__( 'Do not duplicate (Display only in featured posts area)' ),
				'desc'      => esc_html__( 'Enable this option if you want posts in featured posts area to be excluded from other modules so they don\'t appear twice' ),
				'type'      => 'on-off',
				'std'       => 'off',
				'class'     => 'barcelona-prevent-duplication',
				'condition' => 'barcelona_fp_style:not(none)'
			),
			array(
				'id'        => 'barcelona_mod',
				'label'     => esc_html__( 'Modules', 'barcelona' ),
				'type'      => 'list-item',
				'section'   => 'barcelona-pb-section',
				'settings'  => array(
					array(
						'id'          => 'module_layout',
						'label'       => esc_html__( 'Module Layout', 'barcelona' ),
						'type'        => 'radio-image',
						'std'         => 'a',
						'choices'     => array(
							array(
								'value' => 'a',
								'label' => esc_html__( 'Module A', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-a.png'
							),
							array(
								'value' => 'b',
								'label' => esc_html__( 'Module B', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-b.png'
							),
							array(
								'value' => 'c',
								'label' => esc_html__( 'Module C', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-c.png'
							),
							array(
								'value' => 'd',
								'label' => esc_html__( 'Module D', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-d.png'
							),
							array(
								'value' => 'e',
								'label' => esc_html__( 'Module E (Slider)', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-e.png'
							),
							array(
								'value' => 'f',
								'label' => esc_html__( 'Module F', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-f.png'
							),
							array(
								'value' => 'g',
								'label' => esc_html__( 'Module G (Slider)', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-g.png'
							),
							array(
								'value' => 'i',
								'label' => esc_html__( 'Module H', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-h.png'
							),
							array(
								'value' => 'h',
								'label' => esc_html__( 'Module I', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-i.png'
							),
							array(
								'value' => 'j',
								'label' => esc_html__( 'Module J', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-j.png'
							),
							array(
								'value' => 'k',
								'label' => esc_html__( 'Module K', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-k.png'
							),
							array(
								'value' => 'l',
								'label' => esc_html__( 'Custom Html', 'barcelona' ),
								'src'   => BARCELONA_THEME_PATH .'includes/admin/images/module-l.png'
							)
						)
					),
					array(
						'id'        => 'g_show_overlay_always',
						'label'     => esc_html__( 'Display Post Title', 'barcelona' ),
						'type'      => 'select',
						'std'       => 'off',
						'choices'   => array(
							array(
								'value' => 'off',
								'label' => esc_html__( 'On Mouseover', 'barcelona' ),
								'src'   => ''
							),
							array(
								'value' => 'on',
								'label' => esc_html__( 'Always', 'barcelona' ),
								'src'   => ''
							)
						),
						'class'     => 'barcelona-half',
						'condition' => 'module_layout:is(g)'
					),
					array(
						'id'        => 'g_is_autoplay',
						'label'     => esc_html__( 'Enable Autoplay', 'barcelona' ),
						'type'      => 'on-off',
						'std'       => 'off',
						'class'     => 'barcelona-half',
						'condition' => 'module_layout:is(g)'
					),
					array(
						'id'        => 'add_tabs',
						'label'     => esc_html__( 'Add Tabs', 'barcelona' ),
						'type'      => 'on-off',
						'std'       => 'off',
						'operator'  => 'and',
						'class'     => 'barcelona-half',
						'condition' => 'module_layout:not(l)'
					),
					array(
						'id'        => 'pagination',
						'label'     => esc_html__( 'Pagination Type', 'barcelona' ),
						'type'      => 'select',
						'std'       => 'none',
						'choices'   => array(
							array(
								'value' => 'none',
								'label' => esc_html__( 'None', 'barcelona' )
							),
							array(
								'value' => 'numeric',
								'label' => esc_html__( 'Numeric Pagination Buttons', 'barcelona' )
							),
							array(
								'value' => 'nextprev',
								'label' => esc_html__( 'Prev/Next Page Links', 'barcelona' )
							),
							array(
								'value' => 'loadmore',
								'label' => esc_html__( 'Load More Button', 'barcelona' )
							),
							array(
								'value' => 'infinite',
								'label' => esc_html__( 'Infinite Scroll', 'barcelona' )
							)
						),
						'operator'  => 'and',
						'class'     => 'barcelona-half',
						'condition' => 'module_layout:not(e),module_layout:not(g),module_layout:not(l)'
					),
					array(
						'id'        => 'tab_type',
						'label'     => esc_html__( 'Tab Type', 'barcelona' ),
						'type'      => 'select',
						'choices'   => array(
							array(
								'value' => 't1',
								'label' => esc_html__( 'Use Selected Categories as Tab', 'barcelona' )
							),
							array(
								'value' => 't2',
								'label' => esc_html__( 'Use Statistical Tabs', 'barcelona' )
							)
						),
						'operator' => 'and',
						'condition' => 'add_tabs:is(on),module_layout:not(l)'
					),
					array(
						'id'            => 'max_number_of_posts',
						'label'         => esc_html__( 'Max Number of Post', 'barcelona' ),
						'type'          => 'numeric-slider',
						'min_max_step'  => '1,100,1',
						'class'         => 'barcelona-max-number-of-posts barcelona-half',
					    'operator'      => 'and',
						'condition'     => 'module_layout:not(a),module_layout:not(b),module_layout:not(l)'
					),
					array(
						'id'            => 'posts_offset',
						'label'         => esc_html__( 'Posts Offset', 'barcelona' ),
						'type'          => 'numeric-slider',
						'min_max_step'  => '0,100,1',
						'class'         => 'barcelona-posts-offset barcelona-half',
						'operator'      => 'and',
						'condition'     => 'module_layout:not(l)'
					),
					array(
						'id'          => 'post_meta_choices',
						'label'       => esc_html__( 'Posts Meta Data', 'barcelona' ),
						'desc'        => esc_html__( 'Check which meta data to show for the posts in module', 'barcelona' ),
						'std'         => array( 'date' ),
						'type'        => 'checkbox',
						'choices'     => array(
							array(
								'value'       => 'excerpt',
								'label'       => esc_html__( 'Post Excerpt', 'barcelona' )
							),
							array(
								'value'       => 'date',
								'label'       => esc_html__( 'Post Date', 'barcelona' )
							),
							array(
								'value'       => 'views',
								'label'       => esc_html__( 'Post Views', 'barcelona' )
							),
							array(
								'value'       => 'likes',
								'label'       => esc_html__( 'Post Votes', 'barcelona' )
							),
							array(
								'value'       => 'comments',
								'label'       => esc_html__( 'Post Comments', 'barcelona' )
							)
						),
						'class'       => 'barcelona-filter-category barcelona-half',
						'section'     => 'ot-layout-settings',
						'condition'   => 'module_layout:not(l)'
					),
					array(
						'id'            => 'filter_category',
						'label'         => esc_html__( 'Filter by Category', 'barcelona' ),
						'type'          => 'taxonomy-checkbox',
						'taxonomy'      => 'category',
						'class'         => 'barcelona-filter-category barcelona-half',
						'operator'      => 'and',
						'condition'     => 'module_layout:not(l)'
					),
					array(
						'id'            => 'filter_tag',
						'label'         => esc_html__( 'Filter by Tag Name', 'barcelona' ),
						'desc'          => esc_html__( 'Add tag(s) seperated by comma. i.e. sports, cooking', 'barcelona' ),
						'type'          => 'text',
						'class'         => 'barcelona-filter-tag barcelona-half',
						'operator'      => 'and',
						'condition'     => 'module_layout:not(l)'
					),
					array(
						'id'            => 'filter_post',
						'label'         => esc_html__( 'Filter by Post Manually', 'barcelona' ),
						'desc'          => esc_html__( 'Specify post ids separated by comma. i.e. 45,73,132,19', 'barcelona' ),
						'type'          => 'text',
						'class'         => 'barcelona-filter-post barcelona-half',
						'operator'      => 'and',
						'condition'     => 'module_layout:not(l)'
					),
					array(
						'id'            => 'orderby',
						'label'         => esc_html__( 'Order Posts by', 'barcelona' ),
						'type'          => 'select',
						'std'           => 'date',
						'choices'       => $barcelona_orderby_choices,
						'class'         => 'barcelona-orderby barcelona-half',
						'condition'     => 'module_layout:not(l)'
					),
					array(
						'id'        => 'order',
						'label'     => esc_html__( 'Posts Order Type', 'barcelona' ),
						'type'      => 'select',
						'std'       => 'desc',
						'choices'   => array(
							array(
								'value' => 'asc',
								'label' => esc_html__( 'Ascending', 'barcelona' )
							),
							array(
								'value' => 'desc',
								'label' => esc_html__( 'Descending', 'barcelona' )
							)
						),
						'class'     => 'barcelona-orderby barcelona-half',
						'condition' => 'module_layout:not(l)'
					),
					array(
						'id'        => 'html',
						'label'     => esc_html__( 'Custom Html Content', 'barcelona' ),
						'desc'      => esc_html__( 'Put your custom html code or shortcode', 'barcelona' ),
						'type'      => 'textarea',
						'rows'      => '15',
						'condition' => 'module_layout:is(l)',
						'operator'  => 'and',
						'class'     => 'barcelona-setting-indent barcelona-textarea-code'
					),
					array(
						'id'        => 'prevent_duplication',
						'label'     => esc_html__( 'Do not duplicate (Display only in this module)' ),
						'desc'      => esc_html__( 'Enable this option if you want posts in this module to be excluded from other modules so they don\'t appear twice' ),
						'type'      => 'on-off',
						'std'       => 'on',
						'class'     => 'barcelona-prevent-duplication',
						'condition' => 'module_layout:not(l)'
					)
				)
			)
		)
	);

	ot_register_meta_box( $barcelona_mod );
	ot_register_meta_box( $barcelona_pgo );
	ot_register_meta_box( $barcelona_po );

}
add_action( 'admin_init', 'barcelona_meta_boxes' );

/*
 * Category add form fields
 */
function barcelona_category_add_form_fields() {

	global $wp_registered_sidebars;

	$barcelona_fp_style            = barcelona_get_option( 'fp_style__category' );
	$barcelona_fp_number           = barcelona_get_option( 'fp_max_number_of_posts__category' );
	$barcelona_fp_posts_offset     = barcelona_get_option( 'fp_posts_offset__category' );
	$barcelona_fp_filter_tag       = barcelona_get_option( 'fp_filter_tag__category' );
	$barcelona_fp_filter_post      = barcelona_get_option( 'fp_filter_post__category' );
	$barcelona_fp_orderby          = barcelona_get_option( 'fp_orderby__category' );
	$barcelona_fp_order            = barcelona_get_option( 'fp_order__category' );
	$barcelona_prevent_duplication = barcelona_get_option( 'fp_prevent_duplication__category' );

	$barcelona_fp_post_meta_choices = barcelona_get_option( 'fp_post_meta_choices__category' );
	if ( ! is_array( $barcelona_fp_post_meta_choices ) ) {
		$barcelona_fp_post_meta_choices = array();
	}

	$barcelona_posts_layout       = barcelona_get_option( 'posts_layout__category' );
	$barcelona_pagination         = barcelona_get_option( 'pagination__category' );
	$barcelona_default_sidebar    = barcelona_get_option( 'default_sidebar__category' );
	$barcelona_sidebar_position   = barcelona_get_option( 'sidebar_position__category' );
	$barcelona_show_breadcrumb    = barcelona_get_option( 'show_breadcrumb__category' );
	$barcelona_show_cat_title     = barcelona_get_option( 'show_cat_title__category' );

	$barcelona_post_meta_choices  = barcelona_get_option( 'post_meta_choices__category' );
	if ( ! is_array( $barcelona_post_meta_choices ) ) {
		$barcelona_post_meta_choices = array();
	}

	?>
	<div class="form-field fp-layout-wrap" data-el="barcelona-fp-layout-options">
		<label for="barcelona-tag-fp-layout"><?php esc_html_e( 'Featured Posts', 'barcelona' ); ?></label>
		<div class="barcelona-tax-radio-img barcelona-clearfix" id="barcelona-tag-fp-layout">
			<?php foreach ( array( 'none', 'a', 'b', 'c', 'd', 'e' ) as $k ): ?>
			<div class="barcelona-radio barcelona-sec<?php echo ( $barcelona_fp_style == $k ) ? ' barcelona-selected' : ''; ?>" data-val="<?php echo esc_attr( $k ); ?>">
				<img src="<?php echo BARCELONA_THEME_PATH; ?>includes/admin/images/fpstyle-<?php echo sanitize_key( $k ); ?>.png" width="120" />
			</div>
			<?php endforeach; ?>
			<input type="hidden" name="barcelona_cat[fp_style]" class="barcelona-hidden-val" value="<?php echo esc_attr( $barcelona_fp_style ); ?>" />
		</div>
		<p><?php esc_html_e( 'Choose the style of featured posts of the category.', 'barcelona' ); ?></p>
	</div>

	<div class="barcelona-toggle-area barcelona-fp-layout-options barcelona-hide barcelona-clearfix" data-cond="not:none">

		<div class="form-field fp-post-meta-choices-wrap">
			<label for="barcelona-tag-fp-post-meta-choices"><?php esc_html_e( 'Post Meta Data', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="date"<?php echo in_array( 'date', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Date', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="views"<?php echo in_array( 'views', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Views', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="likes"<?php echo in_array( 'likes', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Votes', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="comments"<?php echo in_array( 'comments', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Comments', 'barcelona' ); ?></label>
			<p><?php esc_html_e( 'Check which meta data to show for the featured posts.', 'barcelona' ); ?></p>
		</div>

		<div class="form-field fp-max-posts-wrap">
			<label for="barcelona-tag-fp-max-posts"><?php esc_html_e( 'Max. Number of Post', 'barcelona' ); ?></label>
			<select name="barcelona_cat[fp_max_number_of_posts]" id="barcelona-tag-fp-max-posts">
				<?php for ( $i = 1; $i <= 10; $i++ ): ?>
				<option value="<?php echo esc_attr( $i ); ?>"<?php echo ( $barcelona_fp_number == $i ) ? ' selected' : ''; ?>><?php echo esc_html( $i ); ?></option>
				<?php endfor; ?>
			</select>
		</div>

		<div class="form-field fp-posts-offset-wrap">
			<label for="barcelona-tag-fp-posts-offset"><?php esc_html_e( 'Posts Offset', 'barcelona' ); ?></label>
			<select name="barcelona_cat[fp_posts_offset]" id="barcelona-tag-fp-posts-offset">
				<?php for ( $i = 0; $i <= 100; $i++ ): ?>
					<option value="<?php echo esc_attr( $i ); ?>"<?php echo ( $barcelona_fp_posts_offset == $i ) ? ' selected' : ''; ?>><?php echo esc_html( $i ); ?></option>
				<?php endfor; ?>
			</select>
		</div>

		<div class="form-field fp-filter-tag-wrap">
			<label for="barcelona-tag-fp-filter-tag"><?php esc_html_e( 'Filter by Tag Name', 'barcelona' ); ?></label>
			<input name="barcelona_cat[fp_filter_tag]" id="barcelona-tag-fp-filter-tag" type="text" value="<?php echo esc_attr( $barcelona_fp_filter_tag ); ?>" />
			<p class="description"><?php esc_html_e( 'Add tag(s) seperated by comma. i.e. sports, cooking', 'barcelona' ); ?></p>
		</div>

		<div class="form-field fp-filter-post-wrap">
			<label for="barcelona-tag-fp-filter-post"><?php esc_html_e( 'Filter by Post Manually', 'barcelona' ); ?></label>
			<input name="barcelona_cat[fp_filter_post]" id="barcelona-tag-fp-filter-post" type="text" value="<?php echo esc_attr( $barcelona_fp_filter_post ); ?>" />
			<p class="description"><?php esc_html_e( 'Specify post ids separated by comma. i.e. 45,73,132,19', 'barcelona' ); ?></p>
		</div>

		<div class="form-field fp-orderby-wrap">
			<label for="barcelona-tag-fp-orderby"><?php esc_html_e( 'Order Posts by', 'barcelona' ); ?></label>
			<select name="barcelona_cat[fp_orderby]" id="barcelona-tag-fp-orderby">
				<option value="date"<?php echo ( $barcelona_fp_orderby == 'date' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Date', 'barcelona' ); ?></option>
				<option value="views"<?php echo ( $barcelona_fp_orderby == 'views' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Views', 'barcelona' ); ?></option>
				<option value="comments"<?php echo ( $barcelona_fp_orderby == 'comments' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Comments', 'barcelona' ); ?></option>
				<option value="votes"<?php echo ( $barcelona_fp_orderby == 'votes' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Votes', 'barcelona' ); ?></option>
				<option value="random"<?php echo ( $barcelona_fp_orderby == 'random' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Random', 'barcelona' ); ?></option>
				<option value="posts"<?php echo ( $barcelona_fp_orderby == 'posts' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Manual Post IDs', 'barcelona' ); ?></option>
			</select>
		</div>

		<div class="form-field fp-order-wrap">
			<label for="barcelona-tag-fp-order"><?php esc_html_e( 'Posts Order Type', 'barcelona' ); ?></label>
			<select name="barcelona_cat[fp_order]" id="barcelona-tag-fp-order">
				<option value="asc"<?php echo ( $barcelona_fp_order == 'asc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Ascending', 'barcelona' ); ?></option>
				<option value="desc"<?php echo ( $barcelona_fp_order == 'desc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Descending', 'barcelona' ); ?></option>
			</select>
		</div>

		<div class="form-field fp-prevent-duplication-wrap">
			<label for="barcelona-tag-fp-prevent-duplication"><?php esc_html_e( 'Do not duplicate (Display only in featured posts area)', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[fp_prevent_duplication]" value="on"<?php echo ( $barcelona_prevent_duplication == 'on' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'On', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[fp_prevent_duplication]" value="off"<?php echo ( $barcelona_prevent_duplication == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Off', 'barcelona' ); ?></label>
			<p class="description"><?php esc_html_e( 'Enable this option if you want posts in featured posts area to be excluded from other modules so they don\'t appear twice', 'barcelona' ); ?></p>
		</div>

	</div>

	<div class="form-field posts-layout-wrap">
		<label for="barcelona-tag-posts-layout"><?php esc_html_e( 'Posts Layout', 'barcelona' ); ?></label>
		<div class="barcelona-tax-radio-img barcelona-clearfix" id="barcelona-tag-posts-layout">
			<?php foreach ( array( 'c' => 'a', 'd' => 'b', 'i' => 'd', 'h' => 'c', 'j' => 'e', 'k' => 'f' ) as $k => $v ): ?>
			<div class="barcelona-radio<?php echo ( $barcelona_posts_layout == $k ) ? ' barcelona-selected' : ''; ?>" data-val="<?php echo esc_attr( $k ); ?>">
				<img src="<?php echo BARCELONA_THEME_PATH; ?>includes/admin/images/pmodule-<?php echo sanitize_key( $v ); ?>.png" width="120" />
			</div>
			<?php endforeach; ?>
			<input type="hidden" name="barcelona_cat[posts_layout]" class="barcelona-hidden-val" value="<?php echo esc_attr( $barcelona_posts_layout ); ?>" />
		</div>
		<p><?php esc_html_e( 'Choose how posts of the category will display.', 'barcelona' ); ?></p>
	</div>

	<div class="form-field pagination-wrap">
		<label for="barcelona-tag-pagination"><?php esc_html_e( 'Pagination Type', 'barcelona' ); ?></label>
		<select name="barcelona_cat[pagination]" id="barcelona-tag-pagination" class="barcelona-tax-select widefat">
			<option value="<?php echo esc_attr( 'numeric' ); ?>"<?php echo ( $barcelona_pagination == 'numeric' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Numeric Pagination Buttons', 'barcelona' ); ?></option>
			<option value="<?php echo esc_attr( 'nextprev' ); ?>"<?php echo ( $barcelona_pagination == 'nextprev' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Prev/Next Page Links', 'barcelona' ); ?></option>
			<option value="<?php echo esc_attr( 'loadmore' ); ?>"<?php echo ( $barcelona_pagination == 'loadmore' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Load More Button', 'barcelona' ); ?></option>
			<option value="<?php echo esc_attr( 'infinite' ); ?>"<?php echo ( $barcelona_pagination == 'infinite' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Infinite Scroll', 'barcelona' ); ?></option>
		</select>
	</div>

	<div class="form-field post-meta-choices-wrap">
		<label for="barcelona-tag-post-meta-choices"><?php esc_html_e( 'Post Meta Data', 'barcelona' ); ?></label>
		<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="excerpt"<?php echo in_array( 'excerpt', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Excerpt', 'barcelona' ); ?></label>
		<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="date"<?php echo in_array( 'date', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Date', 'barcelona' ); ?></label>
		<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="views"<?php echo in_array( 'views', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Views', 'barcelona' ); ?></label>
		<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="likes"<?php echo in_array( 'likes', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Votes', 'barcelona' ); ?></label>
		<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="comments"<?php echo in_array( 'comments', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Comments', 'barcelona' ); ?></label>
		<p><?php esc_html_e( 'Check which meta data to show for the posts in this category.', 'barcelona' ); ?></p>
	</div>

	<div class="form-field sidebar-wrap">
		<label for="barcelona-tag-sidebar"><?php esc_html_e( 'Sidebar', 'barcelona' ); ?></label>
		<select name="barcelona_cat[sidebar]" id="barcelona-tag-sidebar" class="barcelona-tax-select widefat">
			<?php foreach( $wp_registered_sidebars as $k => $v ): ?>
			<option value="<?php echo esc_attr( $k ); ?>"<?php echo ( $barcelona_default_sidebar == $k ) ? ' selected' : ''; ?>><?php echo esc_html( $v['name'] ); ?></option>
			<?php endforeach; ?>
		</select>
		<p><?php esc_html_e( 'Choose any sidebar. This will be default for the category.', 'barcelona' ); ?></p>
	</div>

	<div class="form-field sidebar-position-wrap">
		<label for="barcelona-tag-sidebar-position"><?php esc_html_e( 'Sidebar Position', 'barcelona' ); ?></label>
		<div class="barcelona-tax-radio-img barcelona-clearfix" id="barcelona-tag-sidebar-position">
			<?php foreach ( array( 'right', 'left', 'none' ) as $k ): ?>
			<div class="barcelona-radio<?php echo ( $barcelona_sidebar_position == $k ) ? ' barcelona-selected' : ''; ?>" data-val="<?php echo esc_attr( $k ); ?>">
				<img src="<?php echo BARCELONA_THEME_PATH; ?>includes/admin/images/sidebar-<?php echo sanitize_key( $k ); ?>.jpg" width="120" />
			</div>
			<?php endforeach; ?>
			<input type="hidden" name="barcelona_cat[sidebar_position]" class="barcelona-hidden-val" value="<?php echo esc_attr( $barcelona_sidebar_position ); ?>" />
		</div>
		<p><?php esc_html_e( 'Choose the position of sidebar for the category.', 'barcelona' ); ?></p>
	</div>

	<div class="form-field show-breadcrumb-wrap">
		<label for="barcelona-tag-display-breadcrumb"><?php esc_html_e( 'Display Breadcrumb', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[show_breadcrumb]" value="on"<?php echo ( $barcelona_show_breadcrumb == 'on' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'On', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[show_breadcrumb]" value="off"<?php echo ( $barcelona_show_breadcrumb == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Off', 'barcelona' ); ?></label>
	</div>

	<div class="form-field show-cat-title-wrap">
		<label for="barcelona-tag-display-cat-title"><?php esc_html_e( 'Display Category Title', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[show_cat_title]" value="on"<?php echo ( $barcelona_show_cat_title == 'on' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'On', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[show_cat_title]" value="off"<?php echo ( $barcelona_show_cat_title == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Off', 'barcelona' ); ?></label>
	</div>

	<div class="form-field add-header-ad-wrap" data-el="barcelona-header-ad-custom">
		<label for="barcelona-tag-add-header-ad"><?php esc_html_e( 'Header Ad', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[add_header_ad]" class="barcelona-sec" value="inherit" checked="checked" /> <?php esc_html_e( 'Inherit (Same as global setting)', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[add_header_ad]" class="barcelona-sec" value="custom" /> <?php esc_html_e( 'Custom', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[add_header_ad]" class="barcelona-sec" value="off" /> <?php esc_html_e( 'Disabled', 'barcelona' ); ?></label>
		<p><?php esc_html_e( 'You can specify custom header ad for the category.', 'barcelona' ); ?></p>
	</div>

	<div class="barcelona-toggle-area barcelona-header-ad-custom barcelona-hide barcelona-clearfix" data-cond="is:custom">

		<div class="form-field header-ad-1-wrap">
			<label for="barcelona-tag-header-ad-1"><?php esc_html_e( 'Header Ad for Large Screens (728x90)', 'barcelona' ); ?></label>
			<textarea name="barcelona_cat[header_ad_1]" id="barcelona-tag-header-ad-1" rows="4" cols="40"></textarea>
		</div>

		<div class="form-field header-ad-2-wrap">
			<label for="barcelona-tag-header-ad-2"><?php esc_html_e( 'Header Ad for Small Screens (468x60)', 'barcelona' ); ?></label>
			<textarea name="barcelona_cat[header_ad_2]" id="barcelona-tag-header-ad-2" rows="4" cols="40"></textarea>
		</div>

	</div>

	<div class="form-field set-background-wrap" data-el="barcelona-background-kit">
		<label for="barcelona-tag-set-background"><?php esc_html_e( 'Background', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[set_background]" class="barcelona-sec" value="inherit" checked="checked" /> <?php esc_html_e( 'Inherit (Same as global setting)', 'barcelona' ); ?></label>
		<label><input type="radio" name="barcelona_cat[set_background]" class="barcelona-sec" value="custom" /> <?php esc_html_e( 'Custom', 'barcelona' ); ?></label>
		<p><?php esc_html_e( 'You can specify custom background for the category.', 'barcelona' ); ?></p>
	</div>

	<div class="barcelona-background-kit barcelona-toggle-area barcelona-hide barcelona-clearfix" data-cond="is:custom">

		<div class="form-field backgrond-color-wrap">
			<label for="barcelona-tag-background-color"><?php esc_html_e( 'Background Color', 'barcelona' ); ?></label>
			<input type="text" name="barcelona_cat[background_color]" value="" id="barcelona-tag-background-color" class="barcelona-colorpicker" />
		</div>

		<div class="form-field form-field-half background-repeat-wrap">
			<label for="barcelona-tag-background-repeat"><?php esc_html_e( 'Background Repeat', 'barcelona' ); ?></label>
			<select name="barcelona_cat[background_repeat]" id="barcelona-tag-background-repeat" class="widefat">
				<option value="">--</option>
				<option value="repeat"><?php echo esc_html_x( 'Repeat All', 'Background repeat', 'barcelona' ); ?></option>
				<option value="no-repeat"><?php echo esc_html_x( 'No Repeat', 'Background repeat', 'barcelona' ); ?></option>
				<option value="repeat-x"><?php echo esc_html_x( 'Repeat Horizontally', 'Background repeat', 'barcelona' ); ?></option>
				<option value="repeat-y"><?php echo esc_html_x( 'Repeat Vertically', 'Background repeat', 'barcelona' ); ?></option>
				<option value="inherit"><?php esc_html_e( 'Inherit', 'barcelona' ); ?></option>
			</select>
		</div>

		<div class="form-field form-field-half background-position-wrap">
			<label for="barcelona-tag-background-position"><?php esc_html_e( 'Background Position', 'barcelona' ); ?></label>
			<select name="barcelona_cat[background_position]" id="barcelona-tag-background-position" class="widefat">
				<option value="">--</option>
				<option value="left top"><?php esc_html_e( 'Left Top', 'barcelona' ); ?></option>
				<option value="left center"><?php esc_html_e( 'Left Center', 'barcelona' ); ?></option>
				<option value="left bottom"><?php esc_html_e( 'Left Bottom', 'barcelona' ); ?></option>
				<option value="center top"><?php esc_html_e( 'Center Top', 'barcelona' ); ?></option>
				<option value="center center"><?php esc_html_e( 'Center Center', 'barcelona' ); ?></option>
				<option value="center bottom"><?php esc_html_e( 'Center Bottom', 'barcelona' ); ?></option>
				<option value="right top"><?php esc_html_e( 'Right Top', 'barcelona' ); ?></option>
				<option value="right center"><?php esc_html_e( 'Right Center', 'barcelona' ); ?></option>
				<option value="right bottom"><?php esc_html_e( 'Right Bottom', 'barcelona' ); ?></option>
			</select>
		</div>

		<div class="form-field form-field-half background-attachment-wrap">
			<label for="barcelona-tag-background-attachment"><?php esc_html_e( 'Background Attachment', 'barcelona' ); ?></label>
			<select name="barcelona_cat[background_attachment]" id="barcelona-tag-background-attachment" class="widefat">
				<option value="">--</option>
				<option value="fixed"><?php echo esc_html_x( 'Fixed', 'Background Attachment', 'barcelona' ); ?></option>
				<option value="scroll"><?php echo esc_html_x( 'Scroll', 'Background Attachment', 'barcelona' ); ?></option>
				<option value="inherit"><?php esc_html_e( 'Inherit', 'barcelona' ); ?></option>
			</select>
		</div>

		<div class="form-field form-field-half background-size-wrap">
			<label for="barcelona-tag-background-size"><?php esc_html_e( 'Background Size', 'barcelona' ); ?></label>
			<input type="text" name="barcelona_cat[background_size]" id="barcelona-tag-background-size" class="barcelona-input-wide" />
		</div>

		<div class="form-field background-image-wrap">
			<label for="barcelona-tag-background-image"><?php esc_html_e( 'Background Image', 'barcelona' ); ?></label>
			<input type="hidden" class="barcelona-media-val" name="barcelona_cat[background_image]" />
			<p class="barcelona-media-placeholder"></p>
			<button type="button" class="barcelona-media button" id="barcelona-tag-background-image"><?php esc_html_e( 'Select Image', 'barcelona' ); ?></button>
			<button type="button" class="barcelona-media-remove button barcelona-hide" id="barcelona-tag-background-image"><?php esc_html_e( 'Remove Image', 'barcelona' ); ?></button>
		</div>

	</div>
	<?php

}
add_action( 'category_add_form_fields', 'barcelona_category_add_form_fields' );

/*
 * Category edit form fields
 */
function barcelona_category_edit_form_fields( $term ) {

	global $wp_registered_sidebars;

	$term_id = $term->term_id;

	$barcelona_fp_style            = barcelona_get_option( 'fp_style__category_'. $term_id, true );
	$barcelona_fp_number           = barcelona_get_option( 'fp_max_number_of_posts__category_'. $term_id, true );
	$barcelona_fp_posts_offset     = barcelona_get_option( 'fp_posts_offset__category_'. $term_id, true );
	$barcelona_fp_filter_tag       = barcelona_get_option( 'fp_filter_tag__category_'. $term_id, true );
	$barcelona_fp_filter_post      = barcelona_get_option( 'fp_filter_post__category_'. $term_id, true );
	$barcelona_fp_orderby          = barcelona_get_option( 'fp_orderby__category_'. $term_id, true );
	$barcelona_fp_order            = barcelona_get_option( 'fp_order__category_'. $term_id, true );
	$barcelona_prevent_duplication = barcelona_get_option( 'fp_prevent_duplication__category_'. $term_id, true );

	$barcelona_fp_post_meta_choices = barcelona_get_option( 'fp_post_meta_choices__category_'. $term_id, true );
	if ( ! is_array( $barcelona_fp_post_meta_choices ) ) {
		$barcelona_fp_post_meta_choices = array();
	}

	$barcelona_posts_layout       = barcelona_get_option( 'posts_layout__category_'. $term_id, true );
	$barcelona_pagination         = barcelona_get_option( 'pagination__category_'. $term_id, true );
	$barcelona_default_sidebar    = barcelona_get_option( 'default_sidebar__category_'. $term_id, true );
	$barcelona_sidebar_position   = barcelona_get_option( 'sidebar_position__category_'. $term_id, true );
	$barcelona_show_breadcrumb    = barcelona_get_option( 'show_breadcrumb__category_'. $term_id, true );
	$barcelona_show_cat_title     = barcelona_get_option( 'show_cat_title__category_'. $term_id, true );
	$barcelona_add_header_ad      = barcelona_get_option( 'add_header_ad__category_'. $term_id, true );
	$barcelona_header_ad_1        = ( $barcelona_add_header_ad == 'custom' ) ? barcelona_get_option( 'header_ad_1__category_'. $term_id, true ) : '';
	$barcelona_header_ad_2        = ( $barcelona_add_header_ad == 'custom' ) ? barcelona_get_option( 'header_ad_2__category_'. $term_id, true ) : '';
	$barcelona_set_background     = barcelona_get_option( 'set_background__category_'. $term_id, true );
	$barcelona_background         = ( $barcelona_set_background == 'custom' ) ? barcelona_get_option( 'custom_background__category_'. $term_id, true ) : array();

	$barcelona_post_meta_choices  = barcelona_get_option( 'post_meta_choices__category_'. $term_id, true );
	if ( ! is_array( $barcelona_post_meta_choices ) ) {
		$barcelona_post_meta_choices = array();
	}

	?>
	<tr class="form-field fp-layout-wrap" data-el="barcelona-fp-layout-options">
		<th scope="row">
			<label for="barcelona-tag-fp-layout"><?php esc_html_e( 'Featured Posts', 'barcelona' ); ?></label>
		</th>
		<td>
			<div class="barcelona-tax-radio-img barcelona-clearfix" id="barcelona-tag-fp-layout">
				<?php foreach ( array( 'none', 'a', 'b', 'c', 'd', 'e' ) as $k ): ?>
				<div class="barcelona-radio barcelona-sec<?php echo ( $barcelona_fp_style == $k ) ? ' barcelona-selected' : ''; ?>" data-val="<?php echo esc_attr( $k ); ?>">
					<img src="<?php echo BARCELONA_THEME_PATH; ?>includes/admin/images/fpstyle-<?php echo esc_attr( $k ); ?>.png" width="120" />
				</div>
				<?php endforeach; ?>
				<input type="hidden" name="barcelona_cat[fp_style]" class="barcelona-hidden-val" value="<?php echo esc_attr( $barcelona_fp_style ); ?>" />
			</div>
			<p class="description"><?php esc_html_e( 'Choose the style of featured posts of the category.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field barcelona-fp-layout-options<?php echo ( $barcelona_fp_style == 'none' ) ? ' barcelona-hide' : ''; ?>" data-cond="not:none">
		<th scope="row">&nbsp;</th>
		<td>
			<div class="barcelona-toggle-area barcelona-clearfix">

				<div class="form-field fp-post-meta-choices-wrap">
					<label for="barcelona-tag-fp-post-meta-choices"><?php esc_html_e( 'Post Meta Data', 'barcelona' ); ?></label>
					<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="excerpt"<?php echo in_array( 'excerpt', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Excerpt', 'barcelona' ); ?></label>
					<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="date"<?php echo in_array( 'date', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Date', 'barcelona' ); ?></label>
					<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="views"<?php echo in_array( 'views', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Views', 'barcelona' ); ?></label>
					<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="likes"<?php echo in_array( 'likes', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Votes', 'barcelona' ); ?></label>
					<label><input type="checkbox" name="barcelona_cat[fp_post_meta_choices][]" value="comments"<?php echo in_array( 'comments', $barcelona_fp_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Comments', 'barcelona' ); ?></label>
					<p class="description"><?php esc_html_e( 'Check which meta data to show for the featured posts.', 'barcelona' ); ?></p>
				</div>

				<div class="form-field fp-max-posts-wrap">
					<label for="barcelona-tag-fp-max-posts"><?php esc_html_e( 'Max Number of Post', 'barcelona' ); ?></label>
					<select name="barcelona_cat[fp_max_number_of_posts]" id="barcelona-tag-fp-max-posts">
						<?php for ( $i=1; $i<=10; $i++ ): ?>
						<option value="<?php echo esc_attr( $i ); ?>"<?php echo ( $barcelona_fp_number == $i ) ? ' selected' : ''; ?>><?php echo esc_html( $i ); ?></option>
						<?php endfor; ?>
					</select>
				</div>

				<div class="form-field fp-posts-offset-wrap">
					<label for="barcelona-tag-fp-posts-offset"><?php esc_html_e( 'Posts Offset', 'barcelona' ); ?></label>
					<select name="barcelona_cat[fp_posts_offset]" id="barcelona-tag-fp-posts-offset">
						<?php for ( $i=0; $i<=100; $i++ ): ?>
							<option value="<?php echo esc_attr( $i ); ?>"<?php echo ( $barcelona_fp_posts_offset == $i ) ? ' selected' : ''; ?>><?php echo esc_html( $i ); ?></option>
						<?php endfor; ?>
					</select>
				</div>

				<div class="form-field fp-filter-tag-wrap">
					<label for="barcelona-tag-fp-filter-tag"><?php esc_html_e( 'Filter by Tag Name', 'barcelona' ); ?></label>
					<input name="barcelona_cat[fp_filter_tag]" id="barcelona-tag-fp-filter-tag" type="text" value="<?php echo esc_attr( $barcelona_fp_filter_tag ); ?>" />
					<p class="description"><?php esc_html_e( 'Add tag(s) seperated by comma. i.e. sports, cooking', 'barcelona' ); ?></p>
				</div>

				<div class="form-field fp-filter-post-wrap">
					<label for="barcelona-tag-fp-filter-post"><?php esc_html_e( 'Filter by Post Manually', 'barcelona' ); ?></label>
					<input name="barcelona_cat[fp_filter_post]" id="barcelona-tag-fp-filter-post" type="text" value="<?php echo esc_attr( $barcelona_fp_filter_post ); ?>" />
					<p class="description"><?php esc_html_e( 'Specify post ids separated by comma. i.e. 45,73,132,19', 'barcelona' ); ?></p>
				</div>

				<div class="form-field fp-orderby-wrap">
					<label for="barcelona-tag-fp-orderby"><?php esc_html_e( 'Order Posts by', 'barcelona' ); ?></label>
					<select name="barcelona_cat[fp_orderby]" id="barcelona-tag-fp-orderby">
						<option value="date"<?php echo ( $barcelona_fp_orderby == 'date' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Date', 'barcelona' ); ?></option>
						<option value="views"<?php echo ( $barcelona_fp_orderby == 'views' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Views', 'barcelona' ); ?></option>
						<option value="comments"<?php echo ( $barcelona_fp_orderby == 'comments' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Comments', 'barcelona' ); ?></option>
						<option value="votes"<?php echo ( $barcelona_fp_orderby == 'votes' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Number of Votes', 'barcelona' ); ?></option>
						<option value="random"<?php echo ( $barcelona_fp_orderby == 'random' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Random', 'barcelona' ); ?></option>
						<option value="posts"<?php echo ( $barcelona_fp_orderby == 'posts' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Manual Post IDs', 'barcelona' ); ?></option>
					</select>
				</div>

				<div class="form-field fp-order-wrap">
					<label for="barcelona-tag-fp-order"><?php esc_html_e( 'Posts Order Type', 'barcelona' ); ?></label>
					<select name="barcelona_cat[fp_order]" id="barcelona-tag-fp-order">
						<option value="asc"<?php echo ( $barcelona_fp_order == 'asc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Ascending', 'barcelona' ); ?></option>
						<option value="desc"<?php echo ( $barcelona_fp_order == 'desc' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Descending', 'barcelona' ); ?></option>
					</select>
				</div>

				<div class="form-field fp-prevent-duplication-wrap">
					<label for="barcelona-tag-fp-prevent-duplication"><?php esc_html_e( 'Do not duplicate (Display only in featured posts area)', 'barcelona' ); ?></label>
					<label><input type="radio" name="barcelona_cat[fp_prevent_duplication]" value="on"<?php echo ( $barcelona_prevent_duplication == 'on' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'On', 'barcelona' ); ?></label>
					<label><input type="radio" name="barcelona_cat[fp_prevent_duplication]" value="off"<?php echo ( $barcelona_prevent_duplication == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Off', 'barcelona' ); ?></label>
					<p class="description"><?php esc_html_e( 'Enable this option if you want posts in featured posts area to be excluded from other modules so they don\'t appear twice', 'barcelona' ); ?></p>
				</div>

			</div>
		</td>
	</tr>

	<tr class="form-field posts-layout-wrap">
		<th scope="row">
			<label for="barcelona-tag-posts-layout"><?php esc_html_e( 'Posts Layout', 'barcelona' ); ?></label>
		</th>
		<td>
			<div class="barcelona-tax-radio-img barcelona-clearfix" id="barcelona-tag-posts-layout">
				<?php foreach ( array( 'c' => 'a', 'd' => 'b', 'i' => 'd', 'h' => 'c', 'j' => 'e', 'k' => 'f' ) as $k => $v ): ?>
				<div class="barcelona-radio<?php echo ( $barcelona_posts_layout == $k ) ? ' barcelona-selected' : ''; ?>" data-val="<?php echo esc_attr( $k ); ?>">
					<img src="<?php echo BARCELONA_THEME_PATH; ?>includes/admin/images/pmodule-<?php echo sanitize_key( $v ); ?>.png" width="120" />
				</div>
				<?php endforeach; ?>
				<input type="hidden" name="barcelona_cat[posts_layout]" class="barcelona-hidden-val" value="<?php echo esc_attr( $barcelona_posts_layout ); ?>" />
			</div>
			<p class="description"><?php esc_html_e( 'Choose how posts of the category will display.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field pagination-wrap">
		<th scope="row">
			<label for="barcelona-tag-pagination"><?php esc_html_e( 'Pagination Type', 'barcelona' ); ?></label>
		</th>
		<td>
			<select name="barcelona_cat[pagination]" id="barcelona-tag-pagination" class="barcelona-tax-select">
				<option value="<?php echo esc_attr( 'numeric' ); ?>"<?php echo ( $barcelona_pagination == 'numeric' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Numeric Pagination Buttons', 'barcelona' ); ?></option>
				<option value="<?php echo esc_attr( 'nextprev' ); ?>"<?php echo ( $barcelona_pagination == 'nextprev' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Prev/Next Page Links', 'barcelona' ); ?></option>
				<option value="<?php echo esc_attr( 'loadmore' ); ?>"<?php echo ( $barcelona_pagination == 'loadmore' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Load More Button', 'barcelona' ); ?></option>
				<option value="<?php echo esc_attr( 'infinite' ); ?>"<?php echo ( $barcelona_pagination == 'infinite' ) ? ' selected' : ''; ?>><?php echo esc_html__( 'Infinite Scroll', 'barcelona' ); ?></option>
			</select>
		</td>
	</tr>

	<tr class="form-field post-meta-choices-wrap">
		<th scope="row">
			<label for="barcelona-tag-post-meta-choices"><?php esc_html_e( 'Post Meta Data', 'barcelona' ); ?></label>
		</th>
		<td>
			<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="excerpt"<?php echo in_array( 'excerpt', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Excerpt', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="date"<?php echo in_array( 'date', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Date', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="views"<?php echo in_array( 'views', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Views', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="likes"<?php echo in_array( 'likes', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Votes', 'barcelona' ); ?></label>
			<label><input type="checkbox" name="barcelona_cat[post_meta_choices][]" value="comments"<?php echo in_array( 'comments', $barcelona_post_meta_choices ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Post Comments', 'barcelona' ); ?></label>
			<p class="description"><?php esc_html_e( 'Check which meta data to show for the posts in this category.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field sidebar-wrap">
		<th scope="row">
			<label for="barcelona-tag-sidebar"><?php esc_html_e( 'Sidebar', 'barcelona' ); ?></label>
		</th>
		<td>
			<select name="barcelona_cat[sidebar]" id="barcelona-tag-sidebar" class="barcelona-tax-select">
				<?php foreach( $wp_registered_sidebars as $k => $v ): ?>
				<option value="<?php echo esc_attr( $k ); ?>"<?php echo ( $barcelona_default_sidebar == $k ) ? ' selected' : ''; ?>><?php echo esc_html( $v['name'] ); ?></option>
				<?php endforeach; ?>
			</select>
			<p class="description"><?php esc_html_e( 'Choose any sidebar. This will be default for the category.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field sidebar-position-wrap">
		<th scope="row">
			<label for="barcelona-tag-sidebar-position"><?php esc_html_e( 'Sidebar Position', 'barcelona' ); ?></label>
		</th>
		<td>
			<div class="barcelona-tax-radio-img barcelona-clearfix" id="barcelona-tag-sidebar-position">
				<?php foreach ( array( 'right', 'left', 'none' ) as $k ): ?>
				<div class="barcelona-radio<?php echo ( $barcelona_sidebar_position == $k ) ? ' barcelona-selected' : ''; ?>" data-val="<?php echo esc_attr( $k ); ?>">
					<img src="<?php echo BARCELONA_THEME_PATH; ?>includes/admin/images/sidebar-<?php echo sanitize_key( $k ); ?>.jpg" width="120" />
				</div>
				<?php endforeach; ?>
				<input type="hidden" name="barcelona_cat[sidebar_position]" class="barcelona-hidden-val" value="<?php echo esc_attr( $barcelona_sidebar_position ); ?>" />
			</div>
			<p class="description"><?php esc_html_e( 'Choose the position of sidebar for the category.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field show-breadcrumb-wrap">
		<th scope="row">
			<label for="barcelona-tag-display-breadcrumb"><?php esc_html_e( 'Display Breadcrumb', 'barcelona' ); ?></label>
		</th>
		<td>
			<label><input type="radio" name="barcelona_cat[show_breadcrumb]" value="on"<?php echo ( $barcelona_show_breadcrumb == 'on' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'On', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[show_breadcrumb]" value="off"<?php echo ( $barcelona_show_breadcrumb == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Off', 'barcelona' ); ?></label>
		</td>
	</tr>

	<tr class="form-field show-cat-title-wrap">
		<th scope="row">
			<label for="barcelona-tag-display-cat-title"><?php esc_html_e( 'Display Category Title', 'barcelona' ); ?></label>
		</th>
		<td>
			<label><input type="radio" name="barcelona_cat[show_cat_title]" value="on"<?php echo ( $barcelona_show_cat_title == 'on' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'On', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[show_cat_title]" value="off"<?php echo ( $barcelona_show_cat_title == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Off', 'barcelona' ); ?></label>
		</td>
	</tr>

	<tr class="form-field add-header-ad-wrap" data-el="barcelona-header-ad-custom">
		<th scope="row">
			<label for="barcelona-tag-add-header-ad"><?php esc_html_e( 'Header Ad', 'barcelona' ); ?></label>
		</th>
		<td>
			<label><input type="radio" name="barcelona_cat[add_header_ad]" class="barcelona-sec" value="inherit"<?php echo ( $barcelona_add_header_ad == 'inherit' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Inherit (Same as global setting)', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[add_header_ad]" class="barcelona-sec" value="custom"<?php echo ( $barcelona_add_header_ad == 'custom' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Custom', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[add_header_ad]" class="barcelona-sec" value="off"<?php echo ( $barcelona_add_header_ad == 'off' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Disabled', 'barcelona' ); ?></label>
			<p class="description"><?php esc_html_e( 'You can specify custom header ad for the category.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field barcelona-header-ad-custom<?php echo ( $barcelona_add_header_ad != 'custom' ) ? ' barcelona-hide' : ''; ?>" data-cond="is:custom">
		<th scope="row">&nbsp;</th>
		<td>
			<div class="barcelona-toggle-area barcelona-clearfix">

				<div class="form-field header-ad-1-wrap">
					<label for="barcelona-tag-header-ad-1"><?php esc_html_e( 'Header Ad for Large Screens (728x90)', 'barcelona' ); ?></label>
					<textarea name="barcelona_cat[header_ad_1]" id="barcelona-tag-header-ad-1" rows="4" cols="40"><?php echo esc_textarea( $barcelona_header_ad_1 ); ?></textarea>
				</div>

				<div class="form-field header-ad-2-wrap">
					<label for="barcelona-tag-header-ad-2"><?php esc_html_e( 'Header Ad for Small Screens (468x60)', 'barcelona' ); ?></label>
					<textarea name="barcelona_cat[header_ad_2]" id="barcelona-tag-header-ad-2" rows="4" cols="40"><?php echo esc_textarea( $barcelona_header_ad_2 ); ?></textarea>
				</div>

			</div>
		</td>
	</tr>

	<tr class="form-field set-background-wrap" data-el="barcelona-background-kit">
		<th scope="row">
			<label for="barcelona-tag-set-background"><?php esc_html_e( 'Background', 'barcelona' ); ?></label>
		</th>
		<td>
			<label><input type="radio" name="barcelona_cat[set_background]" class="barcelona-sec" value="inherit"<?php echo ( $barcelona_set_background == 'inherit' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Inherit (Same as global setting)', 'barcelona' ); ?></label>
			<label><input type="radio" name="barcelona_cat[set_background]" class="barcelona-sec" value="custom"<?php echo ( $barcelona_set_background == 'custom' ) ? ' checked' : ''; ?> /> <?php esc_html_e( 'Custom', 'barcelona' ); ?></label>
			<p class="description"><?php esc_html_e( 'You can specify custom background for the category.', 'barcelona' ); ?></p>
		</td>
	</tr>

	<tr class="form-field barcelona-background-kit<?php echo ( $barcelona_set_background != 'custom' ) ? ' barcelona-hide' : ''; ?>" data-cond="is:custom">
		<th scope="row">&nbsp;</th>
		<td>
			<div class="barcelona-toggle-area barcelona-clearfix">

				<div class="form-field backgrond-color-wrap">
					<label for="barcelona-tag-background-color"><?php esc_html_e( 'Background Color', 'barcelona' ); ?></label>
					<input type="text" name="barcelona_cat[background_color]" value="<?php echo esc_attr( $barcelona_background['background-color'] ); ?>" id="barcelona-tag-background-color" class="barcelona-colorpicker" />
				</div>

				<div class="form-field form-field-half background-repeat-wrap">
					<label for="barcelona-tag-background-repeat"><?php esc_html_e( 'Background Repeat', 'barcelona' ); ?></label>
					<select name="barcelona_cat[background_repeat]" id="barcelona-tag-background-repeat" class="widefat">
						<option value="">--</option>
						<option value="repeat"<?php echo ( $barcelona_background['background-repeat'] == 'repeat' ) ? ' selected' : ''; ?>><?php echo esc_html_x( 'Repeat All', 'Background repeat', 'barcelona' ); ?></option>
						<option value="no-repeat"<?php echo ( $barcelona_background['background-repeat'] == 'no-repeat' ) ? ' selected' : ''; ?>><?php echo esc_html_x( 'No Repeat', 'Background repeat', 'barcelona' ); ?></option>
						<option value="repeat-x"<?php echo ( $barcelona_background['background-repeat'] == 'repeat-x' ) ? ' selected' : ''; ?>><?php echo esc_html_x( 'Repeat Horizontally', 'Background repeat', 'barcelona' ); ?></option>
						<option value="repeat-y"<?php echo ( $barcelona_background['background-repeat'] == 'repeat-y' ) ? ' selected' : ''; ?>><?php echo esc_html_x( 'Repeat Vertically', 'Background repeat', 'barcelona' ); ?></option>
						<option value="inherit"<?php echo ( $barcelona_background['background-repeat'] == 'inherit' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Inherit', 'barcelona' ); ?></option>
					</select>
				</div>

				<div class="form-field form-field-half background-position-wrap">
					<label for="barcelona-tag-background-position"><?php esc_html_e( 'Background Position', 'barcelona' ); ?></label>
					<select name="barcelona_cat[background_position]" id="barcelona-tag-background-position" class="widefat">
						<option value="">--</option>
						<option value="left top"<?php echo ( $barcelona_background['background-position'] == 'left top' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Left Top', 'barcelona' ); ?></option>
						<option value="left center"<?php echo ( $barcelona_background['background-position'] == 'left center' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Left Center', 'barcelona' ); ?></option>
						<option value="left bottom"<?php echo ( $barcelona_background['background-position'] == 'left bottom' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Left Bottom', 'barcelona' ); ?></option>
						<option value="center top"<?php echo ( $barcelona_background['background-position'] == 'center top' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Center Top', 'barcelona' ); ?></option>
						<option value="center center"<?php echo ( $barcelona_background['background-position'] == 'center center' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Center Center', 'barcelona' ); ?></option>
						<option value="center bottom"<?php echo ( $barcelona_background['background-position'] == 'center bottom' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Center Bottom', 'barcelona' ); ?></option>
						<option value="right top"<?php echo ( $barcelona_background['background-position'] == 'right top' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Right Top', 'barcelona' ); ?></option>
						<option value="right center"<?php echo ( $barcelona_background['background-position'] == 'right center' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Right Center', 'barcelona' ); ?></option>
						<option value="right bottom"<?php echo ( $barcelona_background['background-position'] == 'right bottom' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Right Bottom', 'barcelona' ); ?></option>
					</select>
				</div>

				<div class="form-field form-field-half background-attachment-wrap">
					<label for="barcelona-tag-background-attachment"><?php esc_html_e( 'Background Attachment', 'barcelona' ); ?></label>
					<select name="barcelona_cat[background_attachment]" id="barcelona-tag-background-attachment" class="widefat">
						<option value="">--</option>
						<option value="fixed"<?php echo ( $barcelona_background['background-attachment'] == 'fixed' ) ? ' selected' : ''; ?>><?php echo esc_html_x( 'Fixed', 'Background Attachment', 'barcelona' ); ?></option>
						<option value="scroll"<?php echo ( $barcelona_background['background-attachment'] == 'scroll' ) ? ' selected' : ''; ?>><?php echo esc_html_x( 'Scroll', 'Background Attachment', 'barcelona' ); ?></option>
						<option value="inherit"<?php echo ( $barcelona_background['background-attachment'] == 'inherit' ) ? ' selected' : ''; ?>><?php esc_html_e( 'Inherit', 'barcelona' ); ?></option>
					</select>
				</div>

				<div class="form-field form-field-half background-size-wrap">
					<label for="barcelona-tag-background-size"><?php esc_html_e( 'Background Size', 'barcelona' ); ?></label>
					<input type="text" name="barcelona_cat[background_size]" id="barcelona-tag-background-size" class="barcelona-input-wide" value="<?php echo esc_attr( $barcelona_background['background-size'] ); ?>" />
				</div>

				<div class="form-field background-image-wrap">
					<label for="barcelona-tag-background-image"><?php esc_html_e( 'Background Image', 'barcelona' ); ?></label>
					<input type="hidden" class="barcelona-media-val" name="barcelona_cat[background_image]" value="<?php echo esc_url( $barcelona_background['background-image'] ); ?>" />
					<p class="barcelona-media-placeholder">
						<?php if ( ! empty( $barcelona_background['background-image'] ) ): ?>
						<img src="<?php echo esc_url( $barcelona_background['background-image'] ); ?>" />
						<?php endif; ?>
					</p>
					<button type="button" class="barcelona-media button<?php echo empty( $barcelona_background['background-image'] ) ? '' : ' barcelona-hide'; ?>" id="barcelona-tag-background-image"><?php esc_html_e( 'Select Image', 'barcelona' ); ?></button>
					<button type="button" class="barcelona-media-remove button<?php echo empty( $barcelona_background['background-image'] ) ? ' barcelona-hide' : ''; ?>" id="barcelona-tag-background-image"><?php esc_html_e( 'Remove Image', 'barcelona' ); ?></button>
				</div>

			</div>
		</td>
	</tr>
	<?php

}
add_action( 'category_edit_form_fields', 'barcelona_category_edit_form_fields' );

/*
 * Category save/create form fields
 */
function barcelona_save_category_meta_fields( $term_id ) {

	if ( array_key_exists( 'barcelona_cat', $_POST ) && is_array( $_POST['barcelona_cat'] ) ) {

		$barcelona_meta = array();

		$barcelona_meta['fp_style']                 = isset( $_POST['barcelona_cat']['fp_style'] ) ? sanitize_key( $_POST['barcelona_cat']['fp_style'] ) : sanitize_key( barcelona_get_option( 'fp_style__category' ) );
		$barcelona_meta['fp_max_number_of_posts']   = is_numeric( $_POST['barcelona_cat']['fp_max_number_of_posts'] ) ? intval( $_POST['barcelona_cat']['fp_max_number_of_posts'] ) : intval( barcelona_get_option( 'fp_max_number_of_posts__category' ) );
		$barcelona_meta['fp_posts_offset']          = is_numeric( $_POST['barcelona_cat']['fp_posts_offset'] ) ? intval( $_POST['barcelona_cat']['fp_posts_offset'] ) : intval( barcelona_get_option( 'fp_posts_offset__category' ) );
		$barcelona_meta['fp_filter_tag']            = isset( $_POST['barcelona_cat']['fp_filter_tag'] ) ? sanitize_text_field( $_POST['barcelona_cat']['fp_filter_tag'] ) : sanitize_text_field( barcelona_get_option( 'fp_filter_tag__category' ) );
		$barcelona_meta['fp_filter_post']           = isset( $_POST['barcelona_cat']['fp_filter_post'] ) ? sanitize_text_field( $_POST['barcelona_cat']['fp_filter_post'] ) : sanitize_text_field( barcelona_get_option( 'fp_filter_post__category' ) );
		$barcelona_meta['fp_orderby']               = isset( $_POST['barcelona_cat']['fp_orderby'] ) ? sanitize_key( $_POST['barcelona_cat']['fp_orderby'] ) : sanitize_key( barcelona_get_option( 'fp_orderby__category' ) );
		$barcelona_meta['fp_order']                 = isset( $_POST['barcelona_cat']['fp_order'] ) ? sanitize_key( $_POST['barcelona_cat']['fp_order'] ) : sanitize_key( barcelona_get_option( 'fp_order__category' ) );
		$barcelona_meta['fp_prevent_duplication']   = isset( $_POST['barcelona_cat']['fp_prevent_duplication'] ) ? sanitize_key( $_POST['barcelona_cat']['fp_prevent_duplication'] ) : sanitize_key( barcelona_get_option( 'fp_prevent_duplication__category' ) );

		$barcelona_meta['fp_post_meta_choices'] = array();
		if ( isset( $_POST['barcelona_cat']['fp_post_meta_choices'] ) && is_array( $_POST['barcelona_cat']['fp_post_meta_choices'] ) ) {
			foreach ( $_POST['barcelona_cat']['fp_post_meta_choices'] as $barcelona_v ) {
				$barcelona_meta['fp_post_meta_choices'][] = sanitize_key( $barcelona_v );
			}
		}

		$barcelona_meta['posts_layout']     = isset( $_POST['barcelona_cat']['posts_layout'] ) ? sanitize_key( $_POST['barcelona_cat']['posts_layout'] ) : sanitize_key( barcelona_get_option( 'posts_layout__category' ) );
		$barcelona_meta['pagination']       = isset( $_POST['barcelona_cat']['pagination'] ) ? sanitize_key( $_POST['barcelona_cat']['pagination'] ) : sanitize_key( barcelona_get_option( 'pagination__category' ) );
		$barcelona_meta['default_sidebar']  = isset( $_POST['barcelona_cat']['sidebar'] ) ? sanitize_text_field( $_POST['barcelona_cat']['sidebar'] ) : sanitize_text_field( barcelona_get_option( 'default_sidebar__category' ) );
		$barcelona_meta['sidebar_position'] = isset( $_POST['barcelona_cat']['sidebar_position'] ) ? sanitize_key( $_POST['barcelona_cat']['sidebar_position'] ) : sanitize_key( barcelona_get_option( 'sidebar_position__category' ) );
		$barcelona_meta['show_breadcrumb']  = isset( $_POST['barcelona_cat']['show_breadcrumb'] ) ? sanitize_key( $_POST['barcelona_cat']['show_breadcrumb'] ) : sanitize_key( barcelona_get_option( 'show_breadcrumb__category' ) );
		$barcelona_meta['show_cat_title']   = isset( $_POST['barcelona_cat']['show_cat_title'] ) ? sanitize_key( $_POST['barcelona_cat']['show_cat_title'] ) : sanitize_key( barcelona_get_option( 'show_cat_title__category' ) );

		$barcelona_meta['post_meta_choices'] = array();
		if ( isset( $_POST['barcelona_cat']['post_meta_choices'] ) && is_array( $_POST['barcelona_cat']['post_meta_choices'] ) ) {
			foreach ( $_POST['barcelona_cat']['post_meta_choices'] as $barcelona_v ) {
				$barcelona_meta['post_meta_choices'][] = sanitize_key( $barcelona_v );
			}
		}

		$barcelona_meta['add_header_ad'] = sanitize_key( $_POST['barcelona_cat']['add_header_ad'] );

		// We trust the author here. The author can add html ad code.
		$barcelona_meta['header_ad_1'] = isset( $_POST['barcelona_cat']['header_ad_1'] ) ? stripcslashes( $_POST['barcelona_cat']['header_ad_1'] ) : '';
		$barcelona_meta['header_ad_2'] = isset( $_POST['barcelona_cat']['header_ad_2'] ) ?  stripcslashes( $_POST['barcelona_cat']['header_ad_2'] ) : '';

		$barcelona_meta['set_background']                       = ( $_POST['barcelona_cat']['set_background'] == 'custom' ) ? 'custom' : 'inherit';
		$barcelona_meta['background']['background-color']       = isset( $_POST['barcelona_cat']['background_color'] ) ? sanitize_text_field( $_POST['barcelona_cat']['background_color'] ) : '';
		$barcelona_meta['background']['background-repeat']      = isset( $_POST['barcelona_cat']['background_repeat'] ) ? sanitize_key( $_POST['barcelona_cat']['background_repeat'] ) : '';
		$barcelona_meta['background']['background-position']    = isset( $_POST['barcelona_cat']['background_position'] ) ? sanitize_text_field( $_POST['barcelona_cat']['background_position'] ) : '';
		$barcelona_meta['background']['background-attachment']  = isset( $_POST['barcelona_cat']['background_attachment'] ) ? sanitize_key( $_POST['barcelona_cat']['background_attachment'] ) : '';
		$barcelona_meta['background']['background-size']        = isset( $_POST['barcelona_cat']['background_size'] ) ? sanitize_text_field( $_POST['barcelona_cat']['background_size'] ) : '';
		$barcelona_meta['background']['background-image']       = isset( $_POST['barcelona_cat']['background_image'] ) ? esc_url_raw( $_POST['barcelona_cat']['background_image'] ) : '';

		update_option( '_barcelona_category_'. $term_id, $barcelona_meta );

	}

}
add_action( 'edited_category', 'barcelona_save_category_meta_fields', 10, 2 );
add_action( 'create_category', 'barcelona_save_category_meta_fields', 10, 2 );

function barcelona_category_pre_edit_form( $term ) {

	if ( barcelona_get_option( 'barcelona_override_options__category' ) == 'on' ):
	?>
	<div id="message" class="notice barcelona-notice">
		<p><?php echo esc_html__( 'The options for this category are overridden from global category options. To disable override, go to Theme Options -> Layout Settings -> Category' ); ?></p>
	</div>
	<?php
	endif;

}
add_action( 'category_pre_edit_form', 'barcelona_category_pre_edit_form' );