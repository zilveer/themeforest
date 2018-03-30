<?php
/**
 * Use Options API to add options onto options already
 * present in framework. This is possible in Theme Blvd
 * Framework 2.1.0+.
 *
 * @since 2.1.0
 */
function alyeska_options() {

	// Add Styles
	themeblvd_add_option_tab( 'styles', __( 'Styles', 'themeblvd' ), true );

	// Add Styles > Main section
	$main_options = array(
		array(
			'name' 		=> __( 'Body Style', 'themeblvd' ),
			'desc'		=> __( 'Choose the main style of the theme, dark or light.', 'themeblvd' ),
			'id'		=> 'body_style',
			'std'		=> 'light',
			'type' 		=> 'select',
			'options'	=> array(
				'light' 		=> __( 'Light', 'themeblvd' ),
				'dark' 			=> __( 'Dark', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Body Shape', 'themeblvd' ),
			'desc'		=> __( 'Choose how you want the entire shape of your website to be set.', 'themeblvd' ),
			'id'		=> 'body_shape',
			'std'		=> 'boxed',
			'type' 		=> 'select',
			'options'	=> array(
				'boxed' 		=> __( 'Boxed', 'themeblvd' ),
				'stretch' 		=> __( 'Stretch', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Menu Color', 'themeblvd' ),
			'desc'		=> __( 'Choose the color you\'d like the main menu of your website to be.', 'themeblvd' ),
			'id'		=> 'menu_color',
			'std'		=> 'dark',
			'type' 		=> 'select',
			'options'	=> array(
				'black' 		=> __( 'Black', 'themeblvd' ),
				'blue' 			=> __( 'Blue', 'themeblvd' ),
				'brown' 		=> __( 'Brown', 'themeblvd' ),
				'dark_purple'	=> __( 'Dark Purple', 'themeblvd' ),
				'dark' 			=> __( 'Dark', 'themeblvd' ),
				'green' 		=> __( 'Green', 'themeblvd' ),
				'light_blue' 	=> __( 'Light Blue', 'themeblvd' ),
				'light' 		=> __( 'Light', 'themeblvd' ),
				'navy' 			=> __( 'Navy', 'themeblvd' ),
				'orange' 		=> __( 'Orange', 'themeblvd' ),
				'pink' 			=> __( 'Pink', 'themeblvd' ),
				'purple' 		=> __( 'Purple', 'themeblvd' ),
				'red' 			=> __( 'Red', 'themeblvd' ),
				'slate' 		=> __( 'Slate Grey', 'themeblvd' ),
				'teal' 			=> __( 'Teal', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Menu Shape', 'themeblvd' ),
			'desc'		=> __( 'Choose the shape you\'d like applied to the main menu of your website.', 'themeblvd' ),
			'id'		=> 'menu_shape',
			'std'		=> 'flip',
			'type' 		=> 'select',
			'options'	=> array(
				'flip' 			=> __( 'Flip Over', 'themeblvd' ),
				'classic' 		=> __( 'Classic', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Menu Search Bar', 'themeblvd' ),
			'desc'		=> __( 'Choose whether you\'d like to show the popup search box on the main menu or not.', 'themeblvd' ),
			'id'		=> 'menu_search',
			'std'		=> 'show',
			'type' 		=> 'select',
			'options'	=> array(
				'show' 			=> __( 'Show', 'themeblvd' ),
				'hide' 			=> __( 'Hide', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Social Icon Color', 'themeblvd' ),
			'desc'		=> __( 'Select the color you\'d like applied to the social icons.', 'themeblvd' ),
			'id'		=> 'social_media_style',
			'std'		=> 'light',
			'type' 		=> 'select',
			'options'	=> array(
				'dark' 			=> __( 'Dark', 'themeblvd' ),
				'light' 		=> __( 'Light', 'themeblvd' ),
				'grey' 			=> __( 'Grey', 'themeblvd' ),
				'color'			=> __( 'Color', 'themeblvd' )
			)
		)
	);
	themeblvd_add_option_section( 'styles', 'main_styles', __( 'Main', 'themeblvd' ), null, $main_options, false );

	// Add Styles > Links section
	$links_options = array(
		array(
			'name' 		=> __( 'Link Color', 'themeblvd' ),
			'desc' 		=> __( 'Choose the color you\'d like applied to links.', 'themeblvd' ),
			'id' 		=> 'link_color',
			'std' 		=> '#2a9ed4',
			'type' 		=> 'color'
		),
		array(
			'name' 		=> __( 'Link Hover Color', 'themeblvd' ),
			'desc' 		=> __( 'Choose the color you\'d like applied to links when they are hovered over.', 'themeblvd' ),
			'id' 		=> 'link_hover_color',
			'std' 		=> '#1a5a78',
			'type' 		=> 'color'
		)
	);
	themeblvd_add_option_section( 'styles', 'links', __( 'Links', 'themeblvd' ), null, $links_options, false );

	// Add Styles > Typography section
	$typography_options = array(
		array(
			'name' 		=> __( 'Primary Font', 'themeblvd' ),
			'desc' 		=> __( 'This applies to most of the text on your site.', 'themeblvd' ),
			'id' 		=> 'typography_body',
			'std' 		=> array('size' => '12px', 'style' => 'normal', 'face' => 'lucida', 'color' => '', 'google' => ''),
			'atts'		=> array('size', 'style', 'face'),
			'type' 		=> 'typography'
		),
		array(
			'name' 		=> __( 'Header Font', 'themeblvd' ),
			'desc' 		=> __( 'This applies to all of the primary headers throughout your site (h1, h2, h3, h4, h5, h6). This would include header tags used in redundant areas like widgets and the content of posts and pages.', 'themeblvd' ),
			'id' 		=> 'typography_header',
			'std' 		=> array('size' => '', 'style' => 'normal', 'face' => 'google', 'color' => '', 'google' => 'Yanone Kaffeesatz'),
			'atts'		=> array('face', 'style'),
			'type' 		=> 'typography'
		),
		array(
			'name' 		=> __( 'Special Font', 'themeblvd' ),
			'desc' 		=> __( 'It can be kind of overkill to select a super fancy font for the previous option, but here is where you can go crazy. There are a few special areas in this theme where this font will get used.', 'themeblvd' ),
			'id' 		=> 'typography_special',
			'std' 		=> array('size' => '', 'style' => 'normal', 'face' => 'google', 'color' => '', 'google' => 'Yanone Kaffeesatz'),
			'atts'		=> array('face', 'style'),
			'type' 		=> 'typography'
		)
	);
	themeblvd_add_option_section( 'styles', 'typography', __( 'Typography', 'themeblvd' ), null, $typography_options, false );

	// Add Styles > Custom section
	$custom_options = array(
		array(
			'name' 		=> __( 'Custom CSS', 'themeblvd' ),
			'desc' 		=> __( 'If you have some minor CSS changes, you can put them here to override the theme\'s default styles. However, if you plan to make a lot of CSS changes, it would be best to create a child theme.', 'themeblvd' ),
			'id' 		=> 'custom_styles',
			'type'		=> 'textarea'
		)
	);
	themeblvd_add_option_section( 'styles', 'custom', __( 'Custom', 'themeblvd' ), null, $custom_options, false );

	// Add social media option to Layout > Header
	$social_media = array(
		'name' 		=> __( 'Social Media Buttons', 'themeblvd' ),
		'desc' 		=> __( 'Configure the social media buttons you\'d like to show in the header of your site. Check the buttons you\'d like to use and then input the full URL you\'d like the button to link to in the corresponding text field that appears.<br><br>Example: http://twitter.com/jasonbobich<br><br><em>Note: On the "Email" button, if you want it to link to an actual email address, you would input it like this:<br><br><strong>mailto:you@youremail.com</strong></em><br><br><em>Note: If you\'re using the RSS button, your default RSS feed URL is:<br><br><strong>'.get_feed_link().'</strong></em>', 'themeblvd' ),
		'id' 		=> 'social_media',
		'std' 		=> array(
			'includes'	=>  array( 'facebook', 'google', 'twitter', 'rss' ),
			'facebook'	=> 'http://facebook.com/jasonbobich',
			'google'	=> 'https://plus.google.com/116531311472104544767/posts',
			'twitter'	=> 'http://twitter.com/jasonbobich',
			'rss'		=> get_feed_link()
		),
		'type' 		=> 'social_media'
	);
	themeblvd_add_option( 'layout', 'header', 'social_media', $social_media );

	// Add header text option to Layout > Header
	$header_text = array(
		'name' 		=> __( 'Header Text', 'themeblvd' ),
		'desc'		=> __( 'Enter a very brief piece of text you\'d like to show below the social icons.', 'themeblvd' ),
		'id'		=> 'header_text',
		'std'		=> '<strong>Call Now: 1-800-123-4567</strong>',
		'type' 		=> 'text'
	);
	themeblvd_add_option( 'layout', 'header', 'header_text', $header_text );

	// Add meta option for archive posts
	$archive_meta = array(
		'name' 		=> __( 'Show meta info?', 'themeblvd' ),
		'desc' 		=> __( 'Choose whether you want to show meta information under the title of each post.', 'themeblvd' ),
		'id' 		=> 'archive_meta',
		'std' 		=> 'show',
		'type' 		=> 'radio',
		'options' 	=> array(
			'show'	=> __( 'Show meta info.', 'themeblvd' ),
			'hide' 	=> __( 'Hide meta info.', 'themeblvd' )
		)
	);
	themeblvd_add_option( 'content', 'archives', 'archive_meta', $archive_meta );

	// Add tags option for archive posts
	$archive_meta = array(
		'name' 		=> __( 'Show tags?', 'themeblvd' ),
		'desc' 		=> __( 'Choose whether you want to show tags under at the bottom of each post.', 'themeblvd' ),
		'id' 		=> 'archive_tags',
		'std' 		=> 'show',
		'type' 		=> 'radio',
		'options' 	=> array(
			'show'	=> __( 'Show tags.', 'themeblvd' ),
			'hide' 	=> __( 'Hide tags.', 'themeblvd' )
		)
	);
	themeblvd_add_option( 'content', 'archives', 'archive_tags', $archive_meta );

	// Add comments link option for archive posts
	$archive_comment_link = array(
		'name' 		=> __( 'Show comments link?', 'themeblvd' ),
		'desc' 		=> __( 'Choose whether you want to show the comments link under at the bottom of each post. Keep in mind that if you want to disable the comment link for an individual post, you\'d do so under that post\'s discussion settings.', 'themeblvd' ),
		'id' 		=> 'archive_comment_link',
		'std' 		=> 'show',
		'type' 		=> 'radio',
		'options' 	=> array(
			'show'	=> __( 'Show comments link.', 'themeblvd' ),
			'hide' 	=> __( 'Hide comments link.', 'themeblvd' )
		)
	);
	themeblvd_add_option( 'content', 'archives', 'archive_comment_link', $archive_comment_link );

	// Add post list options
	$post_list_description = __( 'These options apply to posts when they are shown from within any post list throughout your site. This includes the Primary Posts Display described above, as well.<br><br>Note: It may be confusing why these options are not present when editing a specific post list. The reason is because the options when working with a specific post list are incorporated into the actual theme framework, while these settings have been added to this particular theme design for your conveniance.', 'themeblvd' );
	$post_list = array(
		array(
			'name' 		=> __( 'Show meta info?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether you want to show meta information under the title of each post.', 'themeblvd' ),
			'id' 		=> 'post_list_meta',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show meta info.', 'themeblvd' ),
				'hide' 	=> __( 'Hide meta info.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show tags?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether you want to show tags under at the bottom of each post.', 'themeblvd' ),
			'id' 		=> 'post_list_tags',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show tags.', 'themeblvd' ),
				'hide' 	=> __( 'Hide tags.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show comments link?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether you want to show the comment number in the top right corner of each post. Keep in mind that if you want to disable the comment link for an individual post, you\'d do so under that post\'s discussion settings.', 'themeblvd' ),
			'id' 		=> 'post_list_comment_link',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show comments link.', 'themeblvd' ),
				'hide' 	=> __( 'Hide comments link.', 'themeblvd' )
			)
		)

	);
	themeblvd_add_option_section( 'content', 'post_list', __( 'Post Lists', 'themeblvd' ), $post_list_description, $post_list );

	// Add post grid options
	$post_grid_description = __( 'These options apply to posts when they are shown from within any post grid throughout your site.<br><br>Note: It may be confusing why these options are not present when editing a specific post grid. The reason is because the options when working with a specific post grid are incorporated into the actual theme framework, while these settings have been added to this particular theme design for your conveniance.', 'themeblvd' );
	$post_grid = array(
		array(
			'name' 		=> __( 'Show title?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether or not you want to show the title below each featured image in post grids.', 'themeblvd' ),
			'id' 		=> 'post_grid_title',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show titles.', 'themeblvd' ),
				'hide' 	=> __( 'Hide titles.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show excerpts?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether or not you want to show the excerpt on each post.', 'themeblvd' ),
			'id' 		=> 'post_grid_excerpt',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show excerpts.', 'themeblvd' ),
				'hide' 	=> __( 'Hide excerpts.', 'themeblvd' )
			)
		),
		array(
			'name' 		=> __( 'Show buttons?', 'themeblvd' ),
			'desc' 		=> __( 'Choose whether or not you want to show a button that links to the single post.', 'themeblvd' ),
			'id' 		=> 'post_grid_button',
			'std' 		=> 'show',
			'type' 		=> 'radio',
			'options' 	=> array(
				'show'	=> __( 'Show buttons.', 'themeblvd' ),
				'hide' 	=> __( 'Hide buttons.', 'themeblvd' )
			)
		)
	);
	themeblvd_add_option_section( 'content', 'post_grid', __( 'Post Grids', 'themeblvd' ), $post_grid_description, $post_grid, false );

	// Add Configuration tab, if it doesn't exist.
	themeblvd_add_option_tab( 'config', __( 'Configuration', 'themeblvd' ) );

	// Add responsive options
	$responsiveness = array(
		'responsive_css' => array(
			'name' 		=> __( 'Tablets and Mobile Devices', 'themeblvd' ),
			'desc' 		=> __( 'This theme comes with a special stylesheet that will target the screen resolution of your website vistors and show them a slightly modified design if their screen resolution matches common sizes for a tablet or a mobile device.', 'themeblvd' ),
			'id' 		=> 'responsive_css',
			'std' 		=> 'true',
			'type' 		=> 'radio',
			'options' 	=> array(
				'true'		=> __( 'Yes, apply special styles to tablets and mobile devices.', 'themeblvd' ),
				'false' 	=> __( 'No, allow website to show normally on tablets and mobile devices.', 'themeblvd' )
			)
		),
		'mobile_nav' => array(
			'name' 		=> __( 'Mobile Navigation', 'themeblvd' ),
			'desc' 		=> __( 'Select how you\'d like the <em>Primary Navigation</em> displayed on mobile devices.', 'themeblvd' ),
			'id' 		=> 'mobile_nav',
			'std' 		=> 'style_1',
			'type' 		=> 'radio',
			'options' 	=> array(
				'style_1' => __('Style 1: Full graphic menu with toggle', 'themeblvd'),
				'style_2' => __('Style 2: Graphically masked select menu', 'themeblvd'),
				'style_3' => __('Style 3: Simple select menu', 'themeblvd')
			)
		)
	);
	themeblvd_add_option_section( 'config', 'responsiveness', __( 'Responsiveness', 'themeblvd' ), '', $responsiveness, true );

	// Modify framework options
	themeblvd_edit_option( 'content', 'single', 'single_thumbs', 'std', 'full' );
	themeblvd_edit_option( 'content', 'blog', 'blog_thumbs', 'std', 'full' );
	themeblvd_edit_option( 'content', 'blog', 'blog_content', 'std', 'excerpt' );
	themeblvd_edit_option( 'content', 'archives', 'archive_thumbs', 'std', 'full' );
	themeblvd_edit_option( 'layout', 'header', 'logo', 'std', array( 'type' => 'image', 'image' => get_template_directory_uri().'/assets/images/logo.png', 'image_width' => '220', 'image_2x' => get_template_directory_uri().'/assets/images/logo_2x.png' ) );
}
add_action( 'after_setup_theme', 'alyeska_options' );

/**
 * Setup theme for customizer.
 *
 * @since 2.1.0
 */
function alyeska_customizer(){

	// Setup main styles options
	$main_style_options = array(
		'body_style' => array(
			'name' 		=> __( 'Body Style', 'themeblvd' ),
			'id'		=> 'body_style',
			'type' 		=> 'select',
			'options'	=> array(
				'light' 		=> __( 'Light', 'themeblvd' ),
				'dark' 			=> __( 'Dark', 'themeblvd' )
			),
			'priority' => 1
		),
		'body_shape' => array(
			'name' 		=> __( 'Body Shape', 'themeblvd' ),
			'id'		=> 'body_shape',
			'type' 		=> 'select',
			'options'	=> array(
				'boxed' 		=> __( 'Boxed', 'themeblvd' ),
				'stretch' 		=> __( 'Stretch', 'themeblvd' )
			),
			'priority' => 2
		),
		'menu_color' => array(
			'name' 		=> __( 'Menu Color', 'themeblvd' ),
			'id'		=> 'menu_color',
			'type' 		=> 'select',
			'options'	=> array(
				'black' 		=> __( 'Black', 'themeblvd' ),
				'blue' 			=> __( 'Blue', 'themeblvd' ),
				'brown' 		=> __( 'Brown', 'themeblvd' ),
				'dark_purple'	=> __( 'Dark Purple', 'themeblvd' ),
				'dark' 			=> __( 'Dark', 'themeblvd' ),
				'green' 		=> __( 'Green', 'themeblvd' ),
				'light_blue' 	=> __( 'Light Blue', 'themeblvd' ),
				'light' 		=> __( 'Light', 'themeblvd' ),
				'navy' 			=> __( 'Navy', 'themeblvd' ),
				'orange' 		=> __( 'Orange', 'themeblvd' ),
				'pink' 			=> __( 'Pink', 'themeblvd' ),
				'purple' 		=> __( 'Purple', 'themeblvd' ),
				'red' 			=> __( 'Red', 'themeblvd' ),
				'slate' 		=> __( 'Slate Grey', 'themeblvd' ),
				'teal' 			=> __( 'Teal', 'themeblvd' )
			),
			'priority' => 3
		),
		'menu_shape' => array(
			'name' 		=> __( 'Menu Shape', 'themeblvd' ),
			'id'		=> 'menu_shape',
			'type' 		=> 'select',
			'options'	=> array(
				'flip' 			=> __( 'Flip Over', 'themeblvd' ),
				'classic' 		=> __( 'Classic', 'themeblvd' )
			),
			'priority' => 4
		),
		'menu_search' => array(
			'name' 		=> __( 'Menu Search Bar', 'themeblvd' ),
			'id'		=> 'menu_search',
			'type' 		=> 'select',
			'options'	=> array(
				'show' 			=> __( 'Show', 'themeblvd' ),
				'hide' 			=> __( 'Hide', 'themeblvd' )
			),
			'priority' => 5
		),
		'social_media_style' => array(
			'name' 		=> __( 'Social Icon Color', 'themeblvd' ),
			'id'		=> 'social_media_style',
			'type' 		=> 'select',
			'options'	=> array(
				'color' 		=> __( 'Color', 'themeblvd' ),
				'dark' 			=> __( 'Dark', 'themeblvd' ),
				'light' 		=> __( 'Light', 'themeblvd' ),
				'grey' 			=> __( 'Grey', 'themeblvd' )
			)
			,
			'priority' => 6
		)
	);
	themeblvd_add_customizer_section( 'main_styles', __( 'Main Styles', 'themeblvd' ), $main_style_options, 2 );

	// Setup primary font options
	$font_options = array(
		'typography_body' => array(
			'name' 		=> __( 'Primary Font', 'themeblvd' ),
			'id' 		=> 'typography_body',
			'atts'		=> array('size', 'style', 'face'),
			'type' 		=> 'typography',
			'transport'	=> 'postMessage'
		),
		'typography_header' => array(
			'name' 		=> __( 'Header Font', 'themeblvd' ),
			'id' 		=> 'typography_header',
			'atts'		=> array('face', 'style'),
			'type' 		=> 'typography',
			'transport'	=> 'postMessage'
		),
		'typography_special' => array(
			'name' 		=> __( 'Special Font', 'themeblvd' ),
			'id' 		=> 'typography_special',
			'atts'		=> array('face', 'style'),
			'type' 		=> 'typography',
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'typography', __( 'Typography', 'themeblvd' ), $font_options, 103 );

	$links_options = array(
		'link_color' => array(
			'name' 		=> __( 'Link Color', 'themeblvd' ),
			'id' 		=> 'link_color',
			'type' 		=> 'color'
		),
		'link_hover_color' => array(
			'name' 		=> __( 'Link Hover Color', 'themeblvd' ),
			'id' 		=> 'link_hover_color',
			'type' 		=> 'color'
		)
	);
	themeblvd_add_customizer_section( 'links', __( 'Links', 'themeblvd' ), $links_options, 103 );

	// Setup custom styles option
	$custom_styles_options = array(
		'custom_styles' => array(
			'name' 		=> __( 'Enter styles to preview their results.', 'themeblvd' ),
			'id' 		=> 'custom_styles',
			'type' 		=> 'textarea',
			'transport'	=> 'postMessage'
		)
	);
	themeblvd_add_customizer_section( 'custom_css', __( 'Custom CSS', 'themeblvd' ), $custom_styles_options, 121 );
}
add_action( 'after_setup_theme', 'alyeska_customizer' );

/**
 * Add specific theme elements to customizer.
 *
 * @since 2.1.0
 */
function alyeska_customizer_init( $wp_customize ){

	// Remove custom background options
	// $wp_customize->remove_section( 'colors' );
	// $wp_customize->remove_section( 'background_image' );

	// Add real-time option edits
	if ( $wp_customize->is_preview() && ! is_admin() ){
		add_action( 'wp_footer', 'alyeska_customizer_preview', 21 );
	}

}
add_action( 'customize_register', 'alyeska_customizer_init' );

/**
 * Add real-time option edits for this theme in customizer.
 *
 * @since 2.1.0
 */
function alyeska_customizer_preview(){

	// Global option name
	$option_name = themeblvd_get_option_name();

	// Begin output
	?>
	<script type="text/javascript">
	window.onload = function(){ // window.onload for silly IE9 bug fix
		(function($){

			// ---------------------------------------------------------
			// Logo
			// ---------------------------------------------------------

			<?php themeblvd_customizer_preview_logo(); ?>

			// ---------------------------------------------------------
			// Typography
			// ---------------------------------------------------------

			<?php themeblvd_customizer_preview_font_prep(); ?>
			<?php themeblvd_customizer_preview_primary_font(); ?>
			<?php themeblvd_customizer_preview_header_font(); ?>

			// ---------------------------------------------------------
			// Special Typography
			// ---------------------------------------------------------

			var special_font_selectors = '#branding .header_logo .tb-text-logo, #featured .media-full .slide-title, #content .media-full .slide-title, #featured_below .media-full .slide-title, .element-slogan .slogan .slogan-text, .element-tweet, .special-font';

			/* Special Typography - Style */
			wp.customize('<?php echo $option_name; ?>[typography_special][style]',function( value ) {
				value.bind(function(style) {
					// Possible choices: normal, bold, italic, bold-italic
					if( style == 'normal' ) {
						$(special_font_selectors).css('font-weight', 'normal');
						$(special_font_selectors).css('font-style', 'normal');
					} else if( style == 'bold' ) {
						$(special_font_selectors).css('font-weight', 'bold');
						$(special_font_selectors).css('font-style', 'normal');
					} else if( style == 'italic' ) {
						$(special_font_selectors).css('font-weight', 'normal');
						$(special_font_selectors).css('font-style', 'italic');
					} else if( style == 'bold-italic' ) {
						$(special_font_selectors).css('font-weight', 'bold');
						$(special_font_selectors).css('font-style', 'italic');
					}
				});
			});

			/* Special Typography - Face */
			wp.customize('<?php echo $option_name; ?>[typography_special][face]',function( value ) {
				value.bind(function(face) {
					if( face == 'google' ){
						googleFonts.specialToggle = true;
						var google_font = googleFonts.specialName.split(":"),
							google_font = google_font[0];
						$(special_font_selectors).css('font-family', google_font);
					}
					else
					{
						googleFonts.specialToggle = false;
						$(special_font_selectors).css('font-family', fontStacks[face]);
					}
				});
			});

			/* Special Typography - Google */
			wp.customize('<?php echo $option_name; ?>[typography_special][google]',function( value ) {
				value.bind(function(google_font) {
					// Only proceed if user has actually selected for
					// a google font to show in previous option.
					if(googleFonts.specialToggle)
					{
						// Set global google font for reference in
						// other options.
						googleFonts.specialName = google_font;

						// Remove previous google font to avoid clutter.
						$('.preview_google_special_font').remove();

						// Format font name for inclusion
						var include_google_font = google_font.replace(/ /g,'+');

						// Include font
						$('head').append('<link href="http://fonts.googleapis.com/css?family='+include_google_font+'" rel="stylesheet" type="text/css" class="preview_google_special_font" />');

						// Format for CSS
						google_font = google_font.split(":");
						google_font = google_font[0];

						// Apply font in CSS
						$(special_font_selectors).css('font-family', google_font);
					}
				});
			});

			// ---------------------------------------------------------
			// Custom CSS
			// ---------------------------------------------------------

			<?php themeblvd_customizer_preview_styles(); ?>

		})(jQuery);
	} // End window.onload for silly IE9 bug
	</script>
	<?php
}