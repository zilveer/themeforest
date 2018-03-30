<?php
/**
 * Omni functions and definitions.
 *
 * @link    https://codex.wordpress.org/Functions_File_Explained
 *
 * @package omni
 */

if ( ! function_exists( 'omni_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function omni_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on omni, use a find and replace
		 * to change 'omni' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'omni', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu'   => esc_html__( 'Main Menu', 'omni' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'omni' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'quote',
			'audio',
			'image',
			'video',
			'gallery',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'omni_custom_background_args', array(
			'default-color' => 'FFFFFF',
			'default-image' => '',
		) ) );

		add_editor_style( get_template_directory_uri() . '/css/editor.css' );
		add_theme_support( 'woocommerce' );
	}
endif;
add_action( 'after_setup_theme', 'omni_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

add_action( 'switch_theme', 'omni_enforce_image_size_options' );
/**
 * Change image sizes for blog on theme activation.
 */
function omni_enforce_image_size_options() {
	update_option( 'thumbnail_crop', 0 );
	update_option( 'medium_size_w', 750 );
	update_option( 'medium_size_h', 465 );
	update_option( 'large_size_w', 1140 );
	update_option( 'large_size_h', 450 );

}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function omni_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'omni' ),
		'id'            => 'primary',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget-entry clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><!-- end widget-title -->',
	) );

	$footer = '<div id="%1$s" class="widget widget-entry ';
	$footer .= '  col-sm-6 col-md-' . reactor_get_widget_columns( 'footer' );
	$footer .= '  %2$s">';

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'omni' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => $footer,
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><!-- end widget-title -->',
	) );
}

add_action( 'widgets_init', 'omni_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function omni_scripts() {

	if ( ! is_admin() ) {
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'devices', get_template_directory_uri() . '/css/devices.min.css' );
		wp_enqueue_style( 'swiper-slider-css', get_template_directory_uri() . '/css/idangerous.swiper.css' );
		wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
		wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri() . '/css/magnific-popup.css' );


		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'global-js', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'idangerous-swiper', get_template_directory_uri() . '/js/idangerous.swiper.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'wow-animation', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'sharrre-js', get_template_directory_uri() . '/js/jquery.sharrre.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'ajax-subscription', get_template_directory_uri() . '/js/subscription.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'magnific-popup-js', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Custom Google fonts for heading.
	$custom_font_heading          = cs_get_customize_option( 'heading_typography_use_custom' );
	$custom_font_settings_heading = cs_get_customize_option( 'heading_typography_custom_font' );
	if ( isset( $custom_font_heading ) && ( true === $custom_font_heading ) && isset( $custom_font_settings_heading ) && ! ( empty( $custom_font_settings_heading ) ) ) {
		$typography_selected_styles = 'latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';
		$enqueue_fonts              = $custom_font_settings_heading . '&subset=' . $typography_selected_styles;
		wp_enqueue_style( 'crum-heading-google-fonts', esc_url( add_query_arg( 'family', ( $enqueue_fonts ), 'https://fonts.googleapis.com/css' ) ), array(), null );

	}

	// Custom Google fonts for body.
	$custom_font_body          = cs_get_customize_option( 'body_typography_use_custom' );
	$custom_font_settings_body = cs_get_customize_option( 'body_typography_custom_font' );
	if ( isset( $custom_font_body ) && ( true === $custom_font_body ) && isset( $custom_font_settings_body ) && ! ( empty( $custom_font_settings_body ) ) ) {
		$typography_selected_styles = 'latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';
		$enqueue_fonts              = $custom_font_settings_body . '&subset=' . $typography_selected_styles;
		wp_enqueue_style( 'crum-body-google-fonts', esc_url( add_query_arg( 'family', ( $enqueue_fonts ), 'https://fonts.googleapis.com/css' ) ), array(), null );

	}
}

add_action( 'wp_enqueue_scripts', 'omni_scripts' );


/**
 * Disable unused framework components.
 */

define( 'CS_ACTIVE_FRAMEWORK', false );

/**
 * Disable unused framework components.
 */

define( 'CS_ACTIVE_SHORTCODE', false );


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */

require_once get_template_directory() . '/inc/cs-framework/cs-framework.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
 * admin scripts
 */
add_action( 'admin_enqueue_scripts', 'crum_register_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'crum_enqueue_admin_scripts' );


/**
 * Register Theme JS /CSS for wp admin.
 */
function crum_register_admin_scripts() {
	wp_register_script( 'crumina-admin-area-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array(), false, true );
}

/**
 * Include Theme JS /CSS in wp admin.
 */
function crum_enqueue_admin_scripts() {
	wp_enqueue_script( 'crumina-admin-area-scripts' );
	wp_enqueue_media();
	wp_enqueue_style( 'crum-fonts-admin', crum_fonts_url(), array(), '1.0.0' );
}

/**
 * Require theme extensions
 */

// TGM.
require_once get_template_directory() . '/inc/plugins/tgm-config.php';


// Custom colors.
require_once get_template_directory() . '/inc/extensions/styles.php';

// Updater.

require_once get_template_directory() . '/inc/extensions/theme-update-checker.php';

$omni_update_checker = new ThemeUpdateChecker(
	'omni',
	'http://up.crumina.net/updates.server/wp-update-server/?action=get_metadata&slug=omni'
);


// Ttheme thumb.
if ( ! function_exists( 'crum_theme_thumb' ) ) :
	/**
	 *  Dynamic Resize Images.
	 *
	 * @param string $url    url of image.
	 * @param int    $width  Width for resized image.
	 * @param int    $height Height for resized image.
	 * @param bool   $crop   Crop image.
	 * @param string $align  Align for image crop.
	 *
	 * @return string
	 */
	function crum_theme_thumb( $url, $width, $height = 0, $crop, $align = '' ) {
		require_once get_template_directory() . '/inc/extensions/mr-image-resize.php';
		if ( extension_loaded( 'gd' ) ) {
			return mr_image_resize( $url, $width, $height, $crop, $align, false );
		} else {
			return $url;
		}
	}
endif;

if ( ! ( function_exists( 'crum_thousands_convert' ) ) ) {
	/**
	 * Convert big nubers to smaller.
	 *
	 * @param int $amount Input number to convert.
	 *
	 * @return string
	 */
	function crum_thousands_convert( $amount ) {

		$k_meter    = 1000;
		$k100_meter = 100000;

		if ( ( $amount > $k_meter ) && ( $amount < $k100_meter ) ) {
			$amount = round( $amount / $k_meter, 1 ) . 'k';
		} elseif ( $amount > $k100_meter ) {
			$amount = round( $amount / $k_meter, 0 ) . 'k';

		} else {
			return $amount;
		}

		return $amount;
	}
}


if ( ! function_exists( 'crum_main_menu' ) ) {
	/**
	 * Init Theme main menu.
	 */
	function crum_main_menu() {

		$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );

		$defaults = array(
			'theme_location' => 'main-menu',
			'container'      => false,
			'depth'          => 5,
			'echo'           => true,
			'fallback_cb'    => 'crum_menu_fallback',
			'menu_class'     => false,
			'walker'         => new Crum_Nav_Menu_Walker(),
		);

		if ( isset( $page_meta['meta-page-menu'] ) && ! ( 'default' === $page_meta['meta-page-menu'] ) && ! ( '' === $page_meta['meta-page-menu'] ) ) {
			$defaults['menu'] = $page_meta['meta-page-menu'];
		}

		wp_nav_menu( $defaults );
	}
}

if ( ! function_exists( 'crum_footer_menu' ) ) {
	/**
	 * Init Theme main menu.
	 */
	function crum_footer_menu() {

		$defaults = array(
			'theme_location' => 'footer-menu',
			'container'      => false,
			'before'         => '',
			'after'          => '',
			'link_before'    => '',
			'link_after'     => '',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'          => 1,
			'echo'           => true,
			'menu_class'     => 'footer-linck',
		);

		wp_nav_menu( $defaults );
	}
}


require_once get_template_directory() . '/inc/extensions/walkers.php';

//tinyMCE shortcodes
require get_template_directory() . '/inc/shortcodes/tinyMCE-shortcodes.php';

/**
 *  Display social networks icons.
 *
 * @param bool|true $display_icon Show soc network pictogramm.
 */
function crum_do_socnetworks( $display_icon = true ) {
	$soc_networks_array = array(
		'fa fa-facebook'   => esc_html__( 'Facebook', 'omni' ),
		'fa fa-google'     => esc_html__( 'Google', 'omni' ),
		'fa fa-twitter'    => esc_html__( 'Twitter', 'omni' ),
		'fa fa-instagram'  => esc_html__( 'Instagram', 'omni' ),
		'fa fa-xing'       => esc_html__( 'Xing', 'omni' ),
		'fa fa-lastfm'     => esc_html__( 'LastFM', 'omni' ),
		'fa fa-dribbble'   => esc_html__( 'Dribble', 'omni' ),
		'fa fa-vk'         => esc_html__( 'Vkontakte', 'omni' ),
		'fa fa-youtube'    => esc_html__( 'Youtube', 'omni' ),
		'fa fa-windows'    => esc_html__( 'Microsoft', 'omni' ),
		'fa fa-deviantart' => esc_html__( 'Deviantart', 'omni' ),
		'fa fa-linkedin'   => esc_html__( 'LinkedIN', 'omni' ),
		'fa fa-pinterest'  => esc_html__( 'Pinterest', 'omni' ),
		'fa fa-wordpress'  => esc_html__( 'Wordpress', 'omni' ),
		'fa fa-behance'    => esc_html__( 'Behance', 'omni' ),
		'fa fa-flickr'     => esc_html__( 'Flickr', 'omni' ),
		'fa fa-rss'        => esc_html__( 'RSS', 'omni' ),
	);

	$output = '';

	foreach ( $soc_networks_array as $icon => $soc_network ) {

		$soc_network_link = cs_get_customize_option( 'soc_' . str_replace( 'fa fa-', '', $icon ) );
		if ( isset( $soc_network_link ) && ! empty( $soc_network_link ) ) {

			$output .= '<a href="' . esc_url( $soc_network_link ) . '" title="' . esc_attr( $soc_network ) . '">';

			$output .= '<i class="' . esc_attr( $icon ) . '"></i>';

			$output .= '</a>';
		}
	}

	echo $output; // WPCS: XSS OK.
}

/**
 * Add tags to allowedtags filter
 */
function omni_extend_allowed_tags() {
	global $allowedtags;

	$allowedtags['i']      = array(
		'class' => array(),
	);
	$allowedtags['img']    = array(
		'src'    => array(),
		'alt'    => array(),
		'width'  => array(),
		'height' => array(),
		'class'  => array(),
	);
	$allowedtags['iframe'] = array(
		'src'    => array(),
		'height' => array(),
		'width'  => array(),
	);
	$allowedtags['span']   = array(
		'class' => array(),
	);
}
add_action( 'init', 'omni_extend_allowed_tags' );


/**
 * Register Fonts.
 */
function crum_fonts_url() {
	$font_url = '';

	/*
	Translators: If there are characters in your language that are not supported
	by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'omni' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Crimson Text:400,700italic,700,600italic,600,400italic|PT Sans:400,700,400italic,700italic&subset=cyrillic,cyrillic-ext' ), 'https://fonts.googleapis.com/css' );
	}

	return $font_url;
}

// Load VC if not already active.
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( $disable_updater = true );

}

function crum_list_categories_count( $output ) {
	$output = str_replace( '(', '<span>(', $output );
	$output = str_replace( ')', ')</span>', $output );

	return $output;
}

add_filter( 'wp_list_categories', 'crum_list_categories_count' );

add_filter( 'get_archives_link', 'crum_archives_count' );
function crum_archives_count( $links ) {

	$links = str_replace( '&nbsp;', '', $links );
	$links = str_replace( '(', '<span>(', $links );
	$links = str_replace( ')', ')</span>', $links );

	return $links;
}

/**
 * Count Widgets.
 * Count the number of widgets to add dynamic column class.
 *
 * @param string $sidebar_id id of sidebar.
 *
 * @since 1.0.0
 * @return int
 */
function reactor_get_widget_columns( $sidebar_id ) {
	$columns = apply_filters( 'reactor_columns', 12 );

	$the_sidebars = wp_get_sidebars_widgets();

	if ( ! isset( $the_sidebars[ $sidebar_id ] ) ) {
		return esc_html__( 'Invalid sidebar ID', 'omni' );
	}

	$num = count( $the_sidebars[ $sidebar_id ] );
	switch ( $num ) {
		case 1 :
			$num = $columns;
			break;
		case 2 :
			$num = $columns / 2;
			break;
		case 3 :
			$num = $columns / 3;
			break;
		case 4 :
			$num = $columns / 4;
			break;
		case 5 :
			$num = $columns / 5;
			break;
		case 6 :
			$num = $columns / 6;
			break;
		case 7 :
			$num = $columns / 7;
			break;
		case 8 :
			$num = $columns / 8;
			break;
	}
	$num = floor( $num );

	return $num;
}

if ( ! ( function_exists( 'omni_build_retina_style' ) ) ) {
	function omni_build_retina_style( $image ) {
		$image_id = omni_get_image_id( $image );

		$image_size = wp_get_attachment_metadata( $image_id );

		$image_size = absint( $image_size['width'] / 2 );

		$style = 'style="width:' . $image_size . 'px;"';

		return $style;
	}
}

function omni_get_image_id( $image_url ) {
	global $wpdb;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

	return $attachment[0];
}