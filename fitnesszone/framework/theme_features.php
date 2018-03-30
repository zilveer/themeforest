<?php if (!function_exists('dt_theme_features')) {

	// Register Theme Features
	function dt_theme_features() {
		global $wp_version;

		// Add theme support for Custom Background
		$b_args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
			'wp-head-callback' => '_custom_background_cb',
			'admin-head-callback' => '',
			'admin-preview-callback' => ''
		);
		add_theme_support('custom-background', $b_args);
		// END of Custom Background Feature

		// Add theme support for Custom Header
		$hargs = array( 'default-image'=>'',	'random-default'=>false,	'width'=>0,					'height'=>0,
				'flex-height'=> false,	'flex-width'=> false,		'default-text-color'=> '',	'header-text'=> false,
				'uploads'=> true,		'wp-head-callback'=> '',	'admin-head-callback'=> '',	'admin-preview-callback' => '');
				
		add_theme_support('custom-header', $hargs);
		// END of Custom Header Feature

		// Add theme support for Translation
		load_theme_textdomain('iamd_text_domain', get_template_directory().'/languages');

		// Add theme support for Post Formats
		$formats = array(
			'status',
			'quote',
			'gallery',
			'image',
			'video',
			'audio',
			'link',
			'aside',
			'chat'
		);
		add_theme_support('post-formats', $formats);
		// END of Post Formats

		// Add theme support for custom CSS in the TinyMCE visual editor
		add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', dt_theme_admin_fonts_url() ) );

		// Add theme support for title tag, WP can Manage
		add_theme_support( 'title-tag' );

		// Add theme support for html5 markup in search-form, comment-form, comment-list, gallery, etc...
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Add theme support for Automatic Feed Links
		add_theme_support('automatic-feed-links');
		// END of Automatic Feed Links

		// Add theme support for Featured Images
		add_theme_support('post-thumbnails');

		//Blog Image Sizes
		add_image_size('blog-onecol', 1168, 600, true);
		add_image_size('blog-onecol-sidebar', 772, 528, true);
		add_image_size('blog-onecol-bothsidebar', 588, 402, true);
		add_image_size('blog-twocol', 568, 388, true);
		add_image_size('blog-twocol-sidebar', 445, 304, true);
		add_image_size('blog-twocol-bothsidebar', 439, 300, true);
		add_image_size('blog-threecol', 439, 300, true);
		add_image_size('blog-threecol-sidebar', 445, 304, true);
		add_image_size('blog-threecol-bothsidebar', 588, 402, true);
		add_image_size('blog-thumb', 439, 300, true);
		add_image_size('blog-thumb-sidebar', 439, 300, true);
		add_image_size('blog-thumb-bothsidebar', 588, 402, true);	

		//Gallery Image Sizes
		add_image_size('gallery-twocol', 585, 392, true);
		add_image_size('gallery-twocol-sidebar', 420, 287, true);
		add_image_size('gallery-twocol-bothsidebar', 441, 301, true);
		add_image_size('gallery-threecol', 420, 287, true);
		add_image_size('gallery-threecol-sidebar', 448, 306, true);
		add_image_size('gallery-threecol-bothsidebar', 441, 301, true);
		add_image_size('gallery-fourcol', 420, 287, true);
		add_image_size('gallery-fourcol-sidebar', 448, 306, true);
		add_image_size('gallery-fourcol-bothsidebar', 441, 301, true);

		add_image_size("my-post-thumb", 100, 80, true);
	}
	// Hook into the 'after_setup_theme' action
	add_action('after_setup_theme', 'dt_theme_features');
}

if (!function_exists('dt_theme_navigation_menus')) {

	// Register Navigation Menus
	function dt_theme_navigation_menus() {
		$locations = array(
			'primary-menu' => __('Primary Menu', 'iamd_text_domain'),
			'secondary-menu' => __('Secondary Menu', 'iamd_text_domain')
		);
		register_nav_menus($locations);
	}

	// Hook into the 'init' action
	add_action('init', 'dt_theme_navigation_menus');
}

if (!function_exists( 'dt_theme_admin_fonts_url')) {

	//Register Google fonts for Admin Editor.
	//@return string Google fonts URL for the theme.
	function dt_theme_admin_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
	
		/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'iamd_text_domain' ) ) {
			$fonts[] = 'Noto Sans:400italic,700italic,400,700';
		}
	
		/* translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'iamd_text_domain' ) ) {
			$fonts[] = 'Noto Serif:400italic,700italic,400,700';
		}
	
		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'iamd_text_domain' ) ) {
			$fonts[] = 'Inconsolata:400,700';
		}
	
		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'iamd_text_domain' );
	
		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}
	
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}
	
		return $fonts_url;
	}
}

if (!function_exists( '_wp_render_title_tag')){

	//Register Theme slug render title
    function dt_theme_slug_render_title() { ?>
		<title><?php dt_theme_public_title(); ?></title>
		<?php
    }
    add_action( 'wp_head', 'dt_theme_slug_render_title' );
}