<?php
/**
 * Mental Theme Setup
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call


/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

/**
 * Theme Support
 */
if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Declare Woocommerce support
	add_theme_support( 'woocommerce' );

	// Localisation Support
	load_theme_textdomain( 'mental', get_template_directory() . '/languages' );
}

/**
 * Change some Wordpress settings after activating Theme
 */
add_action("after_switch_theme", "mental_theme_wp_settings");
function mental_theme_wp_settings()
{
	update_option( 'thumbnail_size_w', 150 );
	update_option( 'thumbnail_size_h', 150 );
	update_option( 'thumbnail_crop', 0 );

	update_option( 'medium_size_w', 700 );
	update_option( 'medium_size_h', 700 );
	update_option( 'medium_crop', 0 );

	update_option( 'large_size_w', 1280 );
	update_option( 'large_size_h', 1280 );
	update_option( 'large_crop', 0 );
}

/**
 * Mental styles
 */
add_action( 'wp_enqueue_scripts', 'mental_styles' );
function mental_styles()
{
	// Preloader styles
	if( get_mental_option( 'preloader_show' ) && ! wp_is_mobile() ) {
		wp_register_style( 'mental-preloader', get_template_directory_uri() . '/assets/css/preloader.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'mental-preloader' ); // Enqueue it!
	}

	// Boostrap
	wp_register_style( 'bootstrap-mental', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'bootstrap-mental' ); // Enqueue it!

	// Vendor plugins styles
	wp_register_style( 'vendor-mental', get_template_directory_uri() . '/assets/css/vendor.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'vendor-mental' ); // Enqueue it!

	// Woocommerce styles
	if ( class_exists( 'WooCommerce' ) ) {
		wp_register_style( 'woocommerce-mental', get_template_directory_uri() . '/assets/css/woocommerce.css', array('woocommerce-general'), '1.0', 'all' );
		wp_enqueue_style( 'woocommerce-mental' ); // Enqueue it!
	}

	// Main theme styles
	wp_register_style( 'mental', get_template_directory_uri() . '/style.css', array('bootstrap-mental', 'vendor-mental'), '1.0', 'all' );
	wp_enqueue_style( 'mental' ); // Enqueue it!

}


/**
 * Add Mental Scripts
 */
add_action( 'wp_enqueue_scripts', 'mental_scripts' );
function mental_scripts()
{
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) { // Only if not admin panel

		// Scripts in head

		// Modernizr
		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js', array(), '2.6.2', false );
		wp_enqueue_script( 'modernizr' ); // Enqueue it!

		// Preloader
		if( get_mental_option( 'preloader_show' ) && ! wp_is_mobile() ) {
			wp_register_script( 'mental-preloader', get_template_directory_uri() . '/assets/js/preloader.min.js', array( 'modernizr' ), '1.0', false );
			wp_enqueue_script( 'mental-preloader' ); // Enqueue it!
		}

		// jQuery
		wp_enqueue_script( 'jquery' ); // Enqueue it!

		// Scripts in footer

		// Jquery IU
		wp_register_script( 'jqueryui', get_template_directory_uri() . '/assets/js/vendor/jquery-ui-1.10.4.custom.min.js', array( 'jquery' ), '1.10.4', true );
		wp_enqueue_script( 'jqueryui' ); // Enqueue it!

		// Google WebFont
		wp_register_script( 'webfont', 'http://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', array(), '', true );
		wp_enqueue_script( 'webfont' ); // Enqueue it!

		// TouchSwipe
		wp_register_script( 'touchSwipe', get_template_directory_uri() . '/assets/js/vendor/jquery.touchSwipe.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'touchSwipe' ); // Enqueue it!

		// Bootstrap
		wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ), '3.2.0', true );
		wp_enqueue_script( 'bootstrap' ); // Enqueue it!

		// Knob (pie charts)
		wp_register_script( 'knob', get_template_directory_uri() . '/assets/js/vendor/jquery.knob.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'knob' ); // Enqueue it!

		// Stellar (Parallax)
		wp_register_script( 'stellar', get_template_directory_uri() . '/assets/js/vendor/jquery.stellar.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'stellar' ); // Enqueue it!

		// Mousewheel
		wp_register_script( 'mousewheel', get_template_directory_uri() . '/assets/js/vendor/jquery.mousewheel.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'mousewheel' ); // Enqueue it!

		// Perfect Scrollbar
		wp_register_script( 'perfect-scrollbar', get_template_directory_uri() . '/assets/js/vendor/perfect-scrollbar.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'perfect-scrollbar' ); // Enqueue it!

		// MtMenu
		wp_register_script( 'mtmenu', get_template_directory_uri() . '/assets/js/vendor/jquery.mtmenu.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'mtmenu' ); // Enqueue it if Top menu layout

                // imagesLoaded
		wp_register_script( 'imagesLoaded', get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'imagesLoaded' ); // Enqueue it!
                
		// Isotope
		wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/vendor/isotope.pkgd.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'isotope' ); // Enqueue it!

		// Intense images zoom
		wp_register_script( 'intense', get_template_directory_uri() . '/assets/js/vendor/intense.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'intense' ); // Enqueue it!

		// LayerSlider
		wp_register_script( 'greensock', get_template_directory_uri() . '/assets/plugins/layerslider/js/greensock.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'greensock' ); // Enqueue it!
		wp_register_script( 'layerslider', get_template_directory_uri() . '/assets/plugins/layerslider/js/layerslider.kreaturamedia.jquery.js', array( 'jquery', 'greensock' ), '', true );
		wp_enqueue_script( 'layerslider' ); // Enqueue it!
		wp_register_script( 'layerslider-transitions', get_template_directory_uri() . '/assets/plugins/layerslider/js/layerslider.transitions.js', array( 'jquery', 'greensock' ), '', true );
		wp_enqueue_script( 'layerslider-transitions' ); // Enqueue it!
		wp_register_style( 'layerslider', get_template_directory_uri() . '/assets/plugins/layerslider/css/layerslider.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'layerslider' ); // Enqueue it!

		// Placeholder script
		wp_register_script( 'placeholder', get_template_directory_uri() . '/assets/js/vendor/jquery.placeholder.min.js', array(), '', true );
		wp_enqueue_script( 'placeholder' ); // Enqueue it!

		//@TODO Minimizer all changed javaScript files and connect min version to production
		// Mental Theme Plugins
		wp_register_script( 'plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), '', true );
		wp_enqueue_script( 'plugins' ); // Enqueue it!

		// Mental Theme Main
		//@TODO Minimizer all changed javaScript files and connect min version to production
		wp_register_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '', true );
		wp_enqueue_script( 'main' ); // Enqueue it!

		// SmoothScroll script
		wp_register_script( 'smooth',  get_template_directory_uri() . '/assets/js/vendor/jquery.smoothscroll.min.js', array(), '', true );
		wp_enqueue_script( 'smooth' ); // Enqueue it!

	}
}


/**
 * Post Formats
 */
add_action( 'after_setup_theme', 'mental_post_formats' );
function mental_post_formats()
{
	add_theme_support( 'post-formats', array(
		'gallery',
		'quote',
		'video',
		'audio'
	) );
	add_post_type_support( 'post', 'post-formats', array( 'gallery', 'quote', 'video', 'audio' ) );
	add_post_type_support( 'gallery', 'post-formats', array( 'gallery', 'video', 'audio' ) );
}


/**
 * Widgets areas init
 */
add_action( 'widgets_init', 'mental_widgets_init' );
function mental_widgets_init()
{
	// Define Sidebar Widget Area
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mental' ),
		'id'            => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="wg-title">',
		'after_title'   => '</h3>'
	) );

	// Define Footer 1 Widget Area
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'mental' ),
		'id'            => 'footer-area-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="wg-title">',
		'after_title'   => '</h3>'
	) );

	// Define Footer 2 Widget Area
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'mental' ),
		'id'            => 'footer-area-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="wg-title">',
		'after_title'   => '</h3>'
	) );

	// Define Footer 3 Widget Area
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'mental' ),
		'id'            => 'footer-area-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="wg-title">',
		'after_title'   => '</h3>'
	) );

	// Define Footer 4 Widget Area
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'mental' ),
		'id'            => 'footer-area-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="wg-title">',
		'after_title'   => '</h3>'
	) );

	// Separate WooCommerce widget areas
	if( class_exists('WooCommerce') )
	{
		// Define WooCommerce Sidebar Widget Area
		register_sidebar( array(
			'name'          => __( 'WooCommerce Sidebar', 'mental' ),
			'id'            => 'widget-area-woocommerce',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="wg-title">',
			'after_title'   => '</h3>'
		) );

		// Define Footer 1 Widget Area
		register_sidebar( array(
			'name'          => __( 'WooCommerce Footer 1', 'mental' ),
			'id'            => 'footer-area-wc-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="wg-title">',
			'after_title'   => '</h3>'
		) );

		// Define Footer 2 Widget Area
		register_sidebar( array(
			'name'          => __( 'WooCommerce Footer 2', 'mental' ),
			'id'            => 'footer-area-wc-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="wg-title">',
			'after_title'   => '</h3>'
		) );

		// Define Footer 3 Widget Area
		register_sidebar( array(
			'name'          => __( 'WooCommerce Footer 3', 'mental' ),
			'id'            => 'footer-area-wc-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="wg-title">',
			'after_title'   => '</h3>'
		) );

		// Define Footer 4 Widget Area
		register_sidebar( array(
			'name'          => __( 'WooCommerce Footer 4', 'mental' ),
			'id'            => 'footer-area-wc-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="wg-title">',
			'after_title'   => '</h3>'
		) );
	}

}


/**
 * Register Mental Menus
 */
add_action( 'init', 'register_mental_menu' );
function register_mental_menu()
{
	register_nav_menus( array( // Using array to specify more menus if needed
		'top-menu'         => __( 'Top Menu', 'mental' ), // Top Navigation
		'menubar-menu'     => __( 'Menubar Menu', 'mental' ), // Menubar Navigation
		'menubar-menu-onepage'     => __( 'Menubar Onepage Menu', 'mental' ), // Menubar Onepage Navigation
		'top-menu-onepage' => __( 'Top Menu Onepage', 'mental' ), // Menubar Navigation
	) );
}


/**
 * Add mental body classes
 */
add_filter( 'body_class', 'mental_body_classes' );
function mental_body_classes( $classes )
{

	if ( get_mental_option( 'menubar_opened_on_load' ) )
		$classes[] = 'menu-bar-opened';

	if ( get_mental_option( 'menubar_opened_for_big_screen' ) )
		$classes[] = 'menu-bar-opened-big';

	if ( get_mental_option( 'container_width' ) == '960' )
		$classes[] = 'cont-960';

	if ( ! get_mental_option( 'show_menubar' ) ) {
		$classes[] = 'no-menubar';
	} else {

		if ( get_mental_option( 'menubar_side' ) == 'right' ) {
			$classes[] = 'menu-bar-right';
		}

		$menubar_open_style = get_mental_option( 'menubar_open_style' );
		if ( $menubar_open_style == 'over_content' ) {
			$classes[] = 'menu-bar-ontop';
		} else if ( $menubar_open_style == 'push_content' ) {
			$classes[] = 'menu-bar-push';
		}

		$menubar_hide_handler = get_mental_option( 'menubar_hide_handler' );
		if ( $menubar_hide_handler == true) {
			$classes[] = 'menu-bar-handler-hide';
		}
	}

	if( get_mental_option( 'preloader_show' ) && ! wp_is_mobile() ) {
		$classes[] = 'preloader';
	}

	$classes[] = 'black-body';

	return $classes;
}


/**
 * Alter page title
 */
add_filter( 'wp_title', 'mental_wp_title_filter', 10, 2 );
function mental_wp_title_filter( $title, $sep )
{
	global $paged, $page;

	$title = trim( $title, $sep . ' ' );

	if ( is_feed() ) {
		return $title;
	} // end if

	// Add the site name.
	if ( $title ) {
		$title .= ' ' . $sep . ' ';
	} // Add separator
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	} // end if

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'mental' ), max( $paged, $page ) ) . " $sep $title";
	} // end if

	return $title;
}


/**
 * Add WebFont loader library to footer
 */
add_action('wp_footer', 'google_webfont_loader', 200);
function google_webfont_loader() {

	$font_loader_data =  get_mental_option('font_loader');

	$google_fonts = array();
	$typekit_ids = array();
	$custom_fonts = array();

	if( is_array($font_loader_data) ) {
		foreach ( $font_loader_data as $font ) {
			if ( $font['type'] == 'google' ) $google_fonts[] = esc_js(get_google_font_params( $font ));
			if ( $font['type'] == 'typekit' ) $typekit_ids[] = $font['typekit_id'];
			if ( $font['type'] == 'custom' ) $custom_fonts[] = esc_js($font['name']);
		}
	}

	// Theme Default Font
	$google_fonts[] = 'Oxygen:400,700';
	?>
	<script>
		WebFont.load({

			<?php if(!empty($google_fonts)): ?>
			google: {
				families: ['<?php echo implode("', '", $google_fonts) ?>']
			},
			<?php endif ?>

			<?php if(!empty($typekit_ids)): ?>
			typekit: {
				id: '<?php echo esc_js($typekit_ids[0]); ?>'
			},
			<?php endif ?>

			<?php if(!empty($custom_fonts)): ?>
			custom: {
				families: ['<?php echo implode("', '", $custom_fonts) ?>']
			},
			<?php endif ?>

		});
	</script>
	<?php
}

/**
 * Google Analytics code
 */
add_action('wp_footer', 'mental_ga_code', 101);
function mental_ga_code() {
	if(get_mental_option('ga_code')) {
		?>
		<script>
			<?php echo stripslashes(strip_tags(get_mental_option('ga_code'))); ?>
		</script>
		<?php
	}
}

/**
 * Mental theme JS variables
 */
add_action('wp_head', 'mental_js_variables');
function mental_js_variables() {
	?>
	<script type="text/javascript">
		var mental_vars = {
			ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
			siteurl: '<?php echo site_url(); ?>',
		};
	</script>
	<?php
}

/**
 * Register TGMPA plugin for admin only
 */
if( is_admin() ) {
	// Load TGMPA library
	require_once( 'plugins/class-tgm-plugin-activation.php' );

	add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins()
{

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Required plugins

		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true,
		),
		array(
			'name'               => 'Visual Composer',
			'slug'               => 'VisualComposer',
			'source'             => get_template_directory() . '/plugins/js_composer.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		),

		// Recommended plugins

		array(
			'name'     => 'Yet Another Related Posts Plugin',
			'slug'     => 'yet-another-related-posts-plugin',
			'required' => false,
		),
		array(
			'name'     => 'WP Instagram Widget',
			'slug'     => 'wp-instagram-widget',
			'required' => false,
		),
		array(
			'name'     => 'Wordpress Popular Posts',
			'slug'     => 'wordpress-popular-posts',
			'required' => false,
		),
		array(
			'name'               => 'Envato WordPress Toolkit',
			'slug'               => 'envato-wordpress-toolkit-master',
			'source'             => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip', // The plugin source.
			'external_url'       => 'https://github.com/envato/envato-wordpress-toolkit', // If set, overrides default API URL and points to an external URL.
			'required'           => false,
		),
		array(
			'name'               => 'LayerSlider WP',
			'slug'               => 'LayerSlider',
			'source'             => get_template_directory() . '/plugins/LayerSlider.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),
		array(
			'name'               => 'Revolution Slider',
			'slug'               => 'revslider',
			'source'             => get_template_directory() . '/plugins/revslider.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),
		array(
			'name'               => 'Multiple Post Thumbnails',
			'slug'               => 'multiple-post-thumbnails',
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',
		// Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
			'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
			'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ),
			// %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			// %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			// %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			// %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			// %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ),
			// %s = dashboard link.
			'nag_type'                        => 'updated'
			// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}

