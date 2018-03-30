<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Text Domain
============================================================================= */

if( ! function_exists( 'shiroi_load_theme_textdomain' ) ):

function shiroi_load_theme_textdomain() {
	load_theme_textdomain( 'shiroi', get_template_directory() . '/languages' );
}
endif;
add_action( 'after_setup_theme', 'shiroi_load_theme_textdomain' );

/* ==========================================================================
	Theme Support
============================================================================= */

if( ! function_exists( 'shiroi_add_theme_support' ) ):

function shiroi_add_theme_support() {

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'gallery', 'quote' ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	/* Add custom background support */
	remove_theme_mod( 'background_color' );
	add_theme_support( 'custom-background' );

	/* Add RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
}
endif;
add_action( 'init', 'shiroi_add_theme_support' );

/* ==========================================================================
	Pre WordPress 4.1 <title>
============================================================================= */

if( ! function_exists( '_wp_render_title_tag' ) ):

function shiroi_render_title() {
	echo '<title>' . wp_title( '|', false, 'right' ) . '</title>' . PHP_EOL;
}
add_action( 'wp_head', 'shiroi_render_title' );

function shiroi_wp_title( $title, $sep ) {
	global $page, $paged;

	if( empty( $title ) && ! is_feed() ) {
		$title .= get_bloginfo( 'name', 'display' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'shiroi' ), max( $paged, $page ) );
		}
	}

	return $title;
}
add_filter( 'wp_title', 'shiroi_wp_title', 10, 2 );
endif;

/* ==========================================================================
	Image Sizes
============================================================================= */

if( ! function_exists( 'shiroi_add_image_sizes' ) ):

function shiroi_add_image_sizes() {

	$image_sizes = apply_filters( 'shiroi_wp_image_sizes', array(
		'shiroi_featured' => array(
			'width' => 1600
		), 
		'shiroi_fullwidth' => array(
			'width' => 1020
		), 
		'shiroi_medium' => array(
			'width' => 630
		), 
		'shiroi_thumbnail' => array(
			'width' => 96, 
			'height' => 64
		), 
		'shiroi_square' => array(
			'width'  => 720, 
			'height' => 720, 
			'crop'   => true
		), 
		'shiroi_4by3' => array(
			'width'  => 720, 
			'height' => 480, 
			'crop'   => true
		), 
		'shiroi_16by9' => array(
			'width'  => 720, 
			'height' => 405, 
			'crop'   => true
		)
	));

	foreach( $image_sizes as $name => $size ) {

		/* Skip reserved names */
		if( preg_match( '/^((post-)?thumbnail|thumb|medium|large)$/', $name ) ) {
			continue;
		}

		$size = wp_parse_args( $size, array(
			'width'  => 0, 
			'height' => 0, 
			'crop'   => false
		));
		add_image_size( $name, $size['width'], $size['height'], $size['crop'] );
	}
}
endif;
add_action( 'init', 'shiroi_add_image_sizes' );

/* ==========================================================================
	Widgets
============================================================================= */

if( ! function_exists( 'shiroi_widgets_init' ) ):

function shiroi_widgets_init() {

	// Register the default sidebar
	register_sidebar(array(
		'name'          => __( 'Default Sidebar', 'shiroi' ), 
		'id'            => 'default-sidebar', 
		'description'   => __( 'This is the default sidebar of Shiroi Hana theme.', 'shiroi' ), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>'
	));

	// Register custom user sidebars
	if( $custom_widget_areas = Youxi()->option->get( 'custom_widget_areas' ) ) {

		foreach( $custom_widget_areas as $index => $sidebar ) {

			$sidebar_id = sanitize_key( 'custom-' . $sidebar['title'] );

			register_sidebar( array(
				'name'          => $sidebar['title'], 
				'id'            => $sidebar_id, 
				'description'   => $sidebar['description'], 
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title"><span>',
				'after_title'   => '</span></h4>'
			));
		}
	}

	// Register footer widget area
	if( $num_footer_widgets = Youxi()->option->get( 'footer_widget_areas' ) ) {

		for( $i = 1; $i <= $num_footer_widgets; $i++ ) {

			register_sidebar(array(
				'name' => sprintf( __( 'Footer Widget Area %d', 'shiroi' ), $i ), 
				'id' => 'footer_widget_area_' . $i, 
				'description' => sprintf( __( 'This is footer widget area #%d', 'shiroi' ), $i ), 
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => ( $i < $num_footer_widgets ? '<div class="spacer-30 hidden-md hidden-lg"></div>' : '' ) . '</div>', 
				'before_title' => '<h5 class="widget-title"><span>', 
				'after_title' => '</span></h5>'
			));
		}
	}
}
endif;
add_action( 'widgets_init', 'shiroi_widgets_init' );

/* ==========================================================================
	Automatic Theme Updates
============================================================================= */

function shiroi_check_theme_updates( $updates ) {

	if( isset( $updates->checked ) ) {

		/* Get Envato username and API key */
		$envato_username = Youxi()->option->get( 'envato_username' );
		$envato_apikey   = Youxi()->option->get( 'envato_api_key' );

		if( '' !== $envato_username && '' !== $envato_apikey ) {
			if( ! class_exists( 'Pixelentity_Themes_Updater' ) ) {
				require( get_template_directory() . '/lib/class-pixelentity-themes-updater.php' );
			}

			$updater = new Pixelentity_Themes_Updater( $envato_username, $envato_apikey );
			$updates = $updater->check( $updates );
		}
	}

	return $updates;
}
add_filter( 'pre_set_site_transient_update_themes', 'shiroi_check_theme_updates' );

/* ==========================================================================
	Deregister Default WordPress MEJS Styles
============================================================================= */

if( ! function_exists( 'shiroi_wp_mediaelement' ) ):

function shiroi_wp_mediaelement() {

	/* Dequeue default wp mediaelement style */
	wp_deregister_style( 'mediaelement' );
	wp_deregister_style( 'wp-mediaelement' );
}
endif;
add_action( 'wp_enqueue_scripts', 'shiroi_wp_mediaelement' );

/* ==========================================================================
	User Social Profiles
============================================================================= */

if( ! function_exists( 'shiroi_user_social_profiles' ) ):

function shiroi_user_social_profiles() {
	return array(
		'blogger'     => __( 'Blogger', 'shiroi' ), 
		'dribbble'    => __( 'dribbble', 'shiroi' ), 
		'facebook'    => __( 'Facebook', 'shiroi' ), 
		'flickr'      => __( 'Flickr', 'shiroi' ), 
		'forrst'      => __( 'Forrst', 'shiroi' ), 
		'foursquare'  => __( 'Foursquare', 'shiroi' ), 
		'googleplus'  => __( 'Google+', 'shiroi' ), 
		'instagram'   => __( 'Instagram', 'shiroi' ), 
		'linkedin'    => __( 'LinkedIn', 'shiroi' ), 
		'pinterest'   => __( 'Pinterest', 'shiroi' ), 
		'soundcloud'  => __( 'SoundCloud', 'shiroi' ), 
		'stumbleupon' => __( 'StumbleUpon', 'shiroi' ), 
		'tumblr'      => __( 'tumblr', 'shiroi' ), 
		'twitter'     => __( 'Twitter', 'shiroi' ), 
		'vimeo'       => __( 'Vimeo', 'shiroi' ), 
		'vkontakte'   => __( 'VKontakte', 'shiroi' ), 
		'wordpress'   => __( 'WordPress', 'shiroi' ), 
		'yahoo'       => __( 'Yahoo!', 'shiroi' ), 
		'youtube'     => __( 'YouTube', 'shiroi' )
	);
}
endif;

/**
 * User Contact Methods
 */
if( ! function_exists( 'shiroi_user_contactmethods' ) ):

function shiroi_user_contactmethods( $methods ) {
	return array_merge( $methods, shiroi_user_social_profiles() );
}
endif;
add_filter( 'user_contactmethods', 'shiroi_user_contactmethods' );

/* ==========================================================================
	Modify Stylesheet URI
============================================================================= */

if( ! function_exists( 'shiroi_stylesheet_uri' ) ):

function shiroi_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {

	if( ! is_child_theme() ) {
		if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			return $stylesheet_dir_uri . "/assets/css/shiroi.css";
		}
		return $stylesheet_dir_uri . "/assets/css/shiroi.min.css";
	}

	return $stylesheet_uri;	
}
endif;
add_filter( 'stylesheet_uri', 'shiroi_stylesheet_uri', 10, 2 );

/* ==========================================================================
	WordPress Upgrades
============================================================================= */

/**
 * Whether the site is being previewed in the Customizer.
 *
 * @since 4.0.0
 *
 * @global WP_Customize_Manager $wp_customize Customizer instance.
 *
 * @return bool True if the site is being previewed in the Customizer, false otherwise.
 */
if( ! function_exists( 'is_customize_preview' ) ):

function is_customize_preview() {
	global $wp_customize;

	return is_a( $wp_customize, 'WP_Customize_Manager' ) && $wp_customize->is_preview();
}
endif;

/**
 * Try to convert an attachment URL into a post ID.
 *
 * @since 4.0.0
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param string $url The URL to resolve.
 * @return int The found post ID.
 */
if( ! function_exists( 'attachment_url_to_postid' ) ):

function attachment_url_to_postid( $url ) {
	global $wpdb;

	$dir = wp_upload_dir();
	$path = $url;

	if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
		$path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
	}

	$sql = $wpdb->prepare(
		"SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value = %s",
		$path
	);
	$post_id = $wpdb->get_var( $sql );
	if ( ! empty( $post_id ) ) {
		return (int) $post_id;
	}
}
endif;

/**
 * Verifies an attachment is of a given type.
 *
 * @since 4.2.0
 *
 * @param string      $type    Attachment type. Accepts 'image', 'audio', or 'video'.
 * @param int|WP_Post $post_id Optional. Attachment ID. Default 0.
 * @return bool True if one of the accepted types, false otherwise.
 */
if( ! function_exists( 'wp_attachment_is' ) ):

function wp_attachment_is( $type, $post_id = 0 ) {
	if ( ! $post = get_post( $post_id ) ) {
		return false;
	}

	if ( ! $file = get_attached_file( $post->ID ) ) {
		return false;
	}

	if ( 0 === strpos( $post->post_mime_type, $type . '/' ) ) {
		return true;
	}

	$check = wp_check_filetype( $file );
	if ( empty( $check['ext'] ) ) {
		return false;
	}

	$ext = $check['ext'];

	if ( 'import' !== $post->post_mime_type ) {
		return $type === $ext;
	}

	switch ( $type ) {
	case 'image':
		$image_exts = array( 'jpg', 'jpeg', 'jpe', 'gif', 'png' );
		return in_array( $ext, $image_exts );

	case 'audio':
		return in_array( $ext, wp_get_audio_extensions() );

	case 'video':
		return in_array( $ext, wp_get_video_extensions() );

	default:
		return $type === $ext;
	}
}
endif;

/* ==========================================================================
	`wp_enqueue_scripts`
============================================================================= */

if( ! function_exists( 'shiroi_wp_enqueue_script' ) ):

function shiroi_wp_enqueue_script( $hook ) {

	$wp_theme = wp_get_theme();
	$theme_version = $wp_theme->exists() ? $wp_theme->get( 'Version' ) : false;

	$script_debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
	$suffix = $script_debug ? '' : '.min';

	/* Register Core Styles */
	wp_register_style( 'bootstrap', get_template_directory_uri() . "/assets/bootstrap/css/bootstrap{$suffix}.css", array(), '3.3.5', 'screen' );
	wp_register_style( 'shiroi', get_stylesheet_uri(), array( 'bootstrap' ), $theme_version, 'screen' );

	/* Register Icons */
	wp_register_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0', 'screen' );

	/* Register Plugin Styles */
	wp_register_style( 'fotorama', get_template_directory_uri() . "/assets/plugins/fotorama/fotorama.css", array(), '4.6.3', 'screen' );
	wp_register_style( 'magnific-popup', get_template_directory_uri() . "/assets/plugins/mfp/mfp{$suffix}.css", array(), '1.0.0', 'screen' );

	/* Enqueue Google Fonts */
	if( $google_fonts_url = Youxi_Font::google_font_request_url() ) {
		wp_enqueue_style( 'google-fonts', $google_fonts_url, array(), $theme_version, 'screen' );
	}

	/* Enqueue Icons */
	wp_enqueue_style( 'fontawesome' );

	/* Enqueue Main style */
	wp_enqueue_style( 'shiroi' );

	/* Make sure the LESS compiler exists */
	if( ! class_exists( 'Youxi_LESS_Compiler' ) ) {
		require( get_template_directory() . '/lib/framework/class-less-compiler.php' );
	}
	$less_compiler = Youxi_LESS_Compiler::get();

	/* Get the accent color setting */
	$brand_primary = Youxi()->option->get( 'accent_color', shiroi_default_accent_color() );

	/* Custom accent color styles */
	if( shiroi_default_accent_color() !== $brand_primary ) {
		wp_add_inline_style( 'bootstrap', $less_compiler->compile( '/assets/less/overrides/bootstrap.less', array( 'bs-override' => array( 'brand-primary' => $brand_primary ) ) ) );
		wp_add_inline_style( 'shiroi', $less_compiler->compile( '/assets/less/overrides/core.less', array( 'core-override' => array( 'brand-primary' => $brand_primary ) ) ) );
	}

	/* Color scheme */
	$color_scheme = Youxi()->option->get( 'color_scheme' );
	if( 'custom' == $color_scheme ) {
		$color_scheme_data = shiroi_custom_color_scheme();
	} elseif( 'default' != $color_scheme ) {
		$color_scheme_data = shiroi_get_color_scheme( $color_scheme );
	}

	if( isset( $color_scheme_data ) && is_array( $color_scheme_data ) ) {
		$color_vars = array();
		$color_vars[ $color_scheme ] = array_merge( $color_scheme_data, array( 'brand-primary' => $brand_primary ) );

		$color_scheme_css = $less_compiler->compile( '/assets/less/mods/color-scheme.less', $color_vars );
		if( ! is_wp_error( $color_scheme_css ) ) {
			wp_add_inline_style( 'shiroi', $color_scheme_css );
		}
	}

	/* Prepare variables */
	$theme_options_vars = array();

	/* Custom theme styles */
	$theme_options_vars['logo-padding-top']    = sprintf( '%dpx', absint( Youxi()->option->get( 'logo_top_padding' ) ) );
	$theme_options_vars['logo-padding-bottom'] = sprintf( '%dpx', absint( Youxi()->option->get( 'logo_bottom_padding' ) ) );
	$theme_options_vars['logo-max-width']      = sprintf( '%dpx', absint( Youxi()->option->get( 'logo_max_width' ) ) );
	$theme_options_vars['logo-max-height']     = Youxi()->option->get( 'logo_max_height' ) ? 
		sprintf( '%dpx', absint( Youxi()->option->get( 'logo_max_height' ) ) ) : 'none';

	/* Add custom styles from theme options */
	$theme_options_css = $less_compiler->compile( '/assets/less/mods/theme-options.less', array(
		'theme-options' => $theme_options_vars
	));
	if( ! is_wp_error( $theme_options_css ) ) {
		wp_add_inline_style( 'shiroi', $theme_options_css );
	}

	/* Add custom fonts from theme options */
	$font_less_vars = Youxi_Font::get_less_vars();

	if( ! empty( $font_less_vars ) ) {
		$theme_fonts_css = $less_compiler->compile( '/assets/less/mods/theme-fonts.less', array(
			'theme-fonts' => $font_less_vars
		));
		if( ! is_wp_error( $theme_fonts_css ) ) {
			wp_add_inline_style( 'shiroi', $theme_fonts_css );
		}
	}

	/* Custom user styles */
	$inline_styles = Youxi()->option->get( 'custom_css' );
	$inline_styles = trim( $inline_styles );
	if( $inline_styles ) {
		wp_add_inline_style( 'shiroi', $inline_styles );
	}

	/* Core */
	if( $script_debug ) {
		wp_register_script( 'shiroi-plugins', get_template_directory_uri() . "/assets/js/shiroi.plugins.js", array( 'jquery' ), $theme_version, true );
		wp_register_script( 'shiroi', get_template_directory_uri() . "/assets/js/shiroi.setup.js", array( 'shiroi-plugins' ), $theme_version, true );
	} else {
		wp_register_script( 'shiroi', get_template_directory_uri() . "/assets/js/shiroi.min.js", array( 'jquery' ), $theme_version, true );
	}

	/* Plugins */
	wp_register_script( 'fotorama', get_template_directory_uri() . "/assets/plugins/fotorama/fotorama{$suffix}.js", array( 'jquery' ), '4.6.3', true );
	wp_register_script( 'magnific-popup', get_template_directory_uri() . "/assets/plugins/mfp/jquery.mfp-1.0.0{$suffix}.js", array( 'jquery' ), '1.0.0', true );

	/* AddThis */
	wp_register_script( 'addthis', 'http://s7.addthis.com/js/300/addthis_widget.js', array(), 300, true );

	/* Pass configuration to frontend */
	wp_localize_script( 'shiroi', '_shiroi', apply_filters( 'shiroi_js_vars', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ), 
		'homeUrl' => home_url( '/' )
	)));

	/* Enqueue core */
	wp_enqueue_script( 'shiroi' );

	/* Enqueue Fotorama */
	wp_enqueue_script( 'fotorama' );
	wp_enqueue_style( 'fotorama' );

	/* Enqueue Magnific Popup */
	wp_enqueue_script( 'magnific-popup' );
	wp_enqueue_style( 'magnific-popup' );

	/* Enqueue masonry */
	wp_enqueue_script( 'masonry' );

	/* Enqueue AddThis */
	if( is_singular( 'post' ) ) {

		$addthis_config = array( 'ui_delay' => 100 );
		if( $addthis_profile_id = Youxi()->option->get( 'addthis_profile_id' ) ) {
			$addthis_config['pubid'] = $addthis_profile_id;
		}
		wp_enqueue_script( 'addthis' );
		wp_localize_script( 'addthis', 'addthis_config', $addthis_config );
	}

	/* Enqueue comment-reply */
	if( is_singular( array( 'post', 'page' ) ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'shiroi_wp_enqueue_script' );
