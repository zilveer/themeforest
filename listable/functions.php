<?php
/**
 * Listable functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Listable
 */

if ( ! function_exists( 'listable_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function listable_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Listable, use a find and replace
		 * to change 'listable' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'listable', get_template_directory() . '/languages' );

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

		// Used for Listing Cards
		// Max Width of 450px
		add_image_size( 'listable-card-image', 450, 9999, false );

		// Used for Single Listing carousel images
		// Max Height of 800px
		add_image_size( 'listable-carousel-image', 9999, 800, false );

		// Used for Full Width (fill) images on Pages and Listings
		// Max Width of 2700px
		add_image_size( 'listable-featured-image', 2700, 9999, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'            => esc_html__( 'Primary Menu', 'listable' ),
			'secondary'          => esc_html__( 'Secondary Menu', 'listable' ),
			'search_suggestions' => esc_html__( 'Search Menu', 'listable' ),
			'footer_menu'        => esc_html__( 'Footer Menu', 'listable' ),
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

		add_theme_support( 'custom-logo' );

		/*
		 * No support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array() );

		add_theme_support( 'job-manager-templates' );

		add_theme_support( 'woocommerce' );

		add_post_type_support( 'page', 'excerpt' );

		remove_post_type_support( 'page', 'thumbnail' );

		// custom javascript handlers - make sure it is the last one added
		add_action( 'wp_head', 'listable_load_custom_js_header', 999 );
		add_action( 'wp_footer', 'listable_load_custom_js_footer', 999 );

		/*
		 * Add editor custom style to make it look more like the frontend
		 * Also enqueue the custom Google Fonts and self-hosted ones
		 */
		add_editor_style( array( 'editor-style.css' ) );
	}
endif; // listable_setup
add_action( 'after_setup_theme', 'listable_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function listable_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'listable_content_width', 1050, 0 );
}

add_action( 'after_setup_theme', 'listable_content_width', 0 );

/**
 * Set the gallery widget width in pixels, based on the theme's design and stylesheet.
 */
function listable_gallery_widget_width( $args, $instance ) {
	return '1050';
}

add_filter( 'gallery_widget_content_width', 'listable_gallery_widget_width', 10, 3 );

/**
 * Enqueue scripts and styles.
 */
function listable_scripts() {
	$theme = wp_get_theme();

	$google_maps_key = listable_get_option( 'google_maps_api_key' );

	if ( ! empty( $google_maps_key ) ) {
		$google_maps_key = '&key=' . $google_maps_key;
	} else {
		$google_maps_key = '';
	}
	//if there is no mapbox token use Google Maps instead
	if ( '' == listable_get_option( 'mapbox_token', '' ) ) {
		wp_deregister_script('google-maps');
		wp_enqueue_script( 'google-maps', '//maps.google.com/maps/api/js?v=3.exp&amp;libraries=places' . $google_maps_key, array(), '3.22', true );
		$listable_scripts_deps[] = 'google-maps';
	} elseif ( wp_script_is( 'google-maps' ) || listable_using_facetwp() ) {
		wp_deregister_script('google-maps');
		wp_enqueue_script( 'google-maps', '//maps.google.com/maps/api/js?v=3.exp&amp;libraries=places' . $google_maps_key, array(), '3.22', false );
		$listable_scripts_deps[] = 'google-maps';
	}

	wp_deregister_style( 'wc-paid-listings-packages' );
	wp_deregister_style( 'wc-bookings-styles' );

	$main_style_deps = array();

	//only enqueue the de default font if Customify is not present
	if ( ! class_exists( 'PixCustomifyPlugin' ) ) {
		wp_enqueue_style( 'listable-default-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700' );
		$main_style_deps[] = 'listable-default-fonts';
	}

	if ( !is_rtl() ) {
		wp_enqueue_style( 'listable-style', get_stylesheet_uri(), $main_style_deps, $theme->get( 'Version' ) );
	}

	if ( class_exists( 'LoginWithAjax' ) ) {
		wp_enqueue_style( 'listable-login-with-ajax', get_template_directory_uri() . '/assets/css/login-with-ajax.css', $main_style_deps, $theme->get( 'Version' ) );
	}

	global $post;
	$listable_scripts_deps = array('jquery');
	if ( ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'jobs' ) && true === listable_jobs_shortcode_get_show_map_param( $post->post_content ) )
		     || ( is_single() && 'job_listing' == $post->post_type )
		     || is_search()
	         || ( isset( $post->post_content ) && is_archive() && 'job_listing' == $post->post_type )
		     || is_tax( array( 'job_listing_category', 'job_listing_tag', 'job_listing_region' ) )
		     || ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'submit_job_form' ) )
		) {

		wp_enqueue_script( 'leafletjs', get_template_directory_uri() . '/assets/js/plugins/leaflet.js', array( 'jquery' ), '1.0.0', true );
		$listable_scripts_deps[] = 'leafletjs';
	}

	wp_enqueue_script( 'tween-lite', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenLite.min.js', array( 'jquery' ) );
	$listable_scripts_deps[] = 'tween-lite';
	wp_enqueue_script( 'scroll-to-plugin', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/plugins/ScrollToPlugin.min.js', array( 'jquery' ) );
	$listable_scripts_deps[] = 'scroll-to-plugin';
	wp_enqueue_script( 'cssplugin', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/plugins/CSSPlugin.min.js', array( 'jquery' ) );
	$listable_scripts_deps[] = 'cssplugin';
	
	wp_enqueue_script( 'listable-scripts', get_template_directory_uri() . '/assets/js/main.js', $listable_scripts_deps, $theme->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'listable-scripts', 'listable_params', array(
		'login_url' => rtrim( esc_url( wp_login_url() ) , '/'),
		'listings_page_url' => listable_get_listings_page_url(),
		'strings' => array(
			'wp-job-manager-file-upload' => esc_html__( 'Add Photo', 'listable' ),
			'no_job_listings_found' => esc_html__( 'No results', 'listable' ),
			'results-no' => esc_html__( 'Results', 'listable'), //@todo this is not quite right as it is tied to the number of results - they can 1 or 0
			'select_some_options' => esc_html__( 'Select Some Options', 'listable' ),
			'select_an_option' => esc_html__( 'Select an Option', 'listable' ),
			'no_results_match' => esc_html__( 'No results match', 'listable' ),
		)
	) );

}

add_action( 'wp_enqueue_scripts', 'listable_scripts' );

function listable_admin_scripts() {

	if ( listable_is_edit_page() ) {
		wp_enqueue_script( 'listable-admin-edit-scripts', get_template_directory_uri() . '/assets/js/admin/edit-page.js', array( 'jquery' ), '1.0.0', true );

		if ( get_post_type() === 'job_listing' ) {
			wp_enqueue_style( 'listable-admin-edit-styles', get_template_directory_uri() . '/assets/css/admin/edit-listing.css' );
		} elseif ( get_post_type() === 'page' ) {
			wp_enqueue_style( 'listable-admin-edit-styles', get_template_directory_uri() . '/assets/css/admin/edit-page.css' );
		}
	} else if ( is_post_type_archive( 'job_listing' ) ) {
		wp_enqueue_style( 'listable-admin-edit-styles', get_template_directory_uri() . '/assets/css/admin/edit-listing.css' );
	}

	if ( listable_is_nav_menus_page() ) {
		wp_enqueue_script( 'listable-admin-nav-menus-scripts', get_template_directory_uri() . '/assets/js/admin/edit-nav-menus.js', array( 'jquery' ), '1.0.0', true );
	}

	wp_enqueue_script( 'listable-admin-general-scripts', get_template_directory_uri() . '/assets/js/admin/admin-general.js', array( 'jquery' ), '1.0.0', true );

	$translation_array = array (
			'import_failed' => esc_html__( 'The import didn\'t work completely!', 'listable') . '<br/>' . esc_html__( 'Check out the errors given. You might want to try reloading the page and try again.', 'listable'),
			'import_confirm' => esc_html__( 'Importing the demo data will overwrite your current site content and options. Proceed anyway?', 'listable'),
			'import_phew' => esc_html__( 'Phew...that was a hard one!', 'listable'),
			'import_success_note' => esc_html__( 'The demo data was imported without a glitch! Awesome! ', 'listable') . '<br/><br/>',
			'import_success_reload' => esc_html__( '<i>We have reloaded the page on the right, so you can see the brand new data!</i>', 'listable'),
			'import_success_warning' => '<p>' . esc_html__( 'Remember to update the passwords and roles of imported users.', 'listable') . '</p><br/>',
			'import_all_done' => esc_html__( "All done!", 'listable'),
			'import_working' => esc_html__( "Working...", 'listable'),
			'import_widgets_failed' => esc_html__( "The setting up of the demo widgets failed...", 'listable'),
			'import_widgets_error' => esc_html__( 'The setting up of the demo widgets failed', 'listable') . '</i><br />' . esc_html__( '(The script returned the following message', 'listable'),
			'import_widgets_done' => esc_html__( 'Finished setting up the demo widgets...', 'listable'),
			'import_theme_options_failed' => esc_html__( "The importing of the theme options has failed...", 'listable'),
			'import_theme_options_error' => esc_html__( 'The importing of the theme options has failed', 'listable') . '</i><br />' . esc_html__( '(The script returned the following message', 'listable'),
			'import_theme_options_done' => esc_html__( 'Finished importing the demo theme options...', 'listable'),
			'import_posts_failed' => esc_html__( "The importing of the theme options has failed...", 'listable'),
			'import_posts_step' => esc_html__( 'Importing posts | Step', 'listable'),
			'import_error' =>  esc_html__( "Error:", 'listable'),
			'import_try_reload' =>  esc_html__( "You can reload the page and try again.", 'listable'),
	);
	wp_localize_script( 'listable-admin-general-scripts', 'listable_admin_js_texts', $translation_array );
}

add_action( 'admin_enqueue_scripts', 'listable_admin_scripts' );

function listable_login_scripts() {
	wp_enqueue_style( 'listable-custom-login', get_template_directory_uri() . '/assets/css/admin/login-page.css' );
}

add_action( 'login_enqueue_scripts', 'listable_login_scripts' );

/**
 * Load custom javascript set by theme options
 * This method is invoked by wpgrade_callback_themesetup
 * The function is executed on wp_enqueue_scripts
 */
function listable_load_custom_js_header() {
	$custom_js = listable_get_option( 'custom_js' );
	if ( ! empty( $custom_js ) ) {
		//first lets test is the js code is clean or has <script> tags and such
		//if we have <script> tags than we will not enclose it in anything - raw output
		if ( strpos( $custom_js, '</script>' ) !== false ) {
			echo $custom_js . "\n";
		} else {
			echo "<script type=\"text/javascript\">\n;(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
		}
	}
}

function listable_load_custom_js_footer() {
	$custom_js = listable_get_option( 'custom_js_footer' );
	if ( ! empty( $custom_js ) ) {
		//first lets test is the js code is clean or has <script> tags and such
		//if we have <script> tags than we will not enclose it in anything - raw output
		if ( strpos( $custom_js, '</script>' ) !== false ) {
			echo $custom_js . "\n";
		} else {
			echo "<script type=\"text/javascript\">\n;(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
		}
	}
}

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */

require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/widgets.php';

require get_template_directory() . '/inc/tutorials.php';

require get_template_directory() . '/inc/activation.php';

/**
 * Load various plugin integrations
 */
require get_template_directory() . '/inc/integrations.php';

/**
 * Load theme's configuration file (via Customify plugin)
 */
require get_template_directory() . '/inc/config.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Recommended/Required plugins notification
 */
require get_template_directory() . '/inc/required-plugins/required-plugins.php';



// Callback function to insert 'styleselect' into the $buttons array
function listable_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'listable_mce_buttons');

// Callback function to filter the MCE settings
function listable_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Intro',
			'inline' => 'span',
			'classes' => 'intro',
			'wrapper' => true
		),
		array(
			'title' => 'Two Columns',
			'block' => 'div',
			'classes' => 'twocolumn',
			'wrapper' => true
		),
		array(
			'title' => 'Separator',
			'block' => 'hr',
			'classes' => 'clear'
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'listable_formats' );
set_site_transient('update_themes', null);

/* Automagical updates */
function wupdates_check_Kv7Br( $transient ) {
	// Nothing to do here if the checked transient entry is empty
	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	// Let's start gathering data about the theme
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	// Then WordPress version
	include( ABSPATH . WPINC . '/version.php' );
	$http_args = array (
		'body' => array(
			'slug' => $slug,
			'url' => home_url(), //the site's home URL
			'version' => 0,
			'locale' => get_locale(),
			'phpv' => phpversion(),
			'child_theme' => is_child_theme(),
			'data' => null, //no optional data is sent by default
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
	);

	// If the theme has been checked for updates before, get the checked version
	if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
		$http_args['body']['version'] = $transient->checked[ $slug ];
	}

	// Use this filter to add optional data to send
	// Make sure you return an associative array - do not encode it in any way
	$optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

	// Encrypting optional data with private key, just to keep your data a little safer
	// You should not edit the code bellow
	$optional_data = json_encode( $optional_data );
	$w=array();$re="";$s=array();$sa=md5('0ab162a893ad8d7cfce46a6569d63b4a1203aeb9');
	$l=strlen($sa);$d=$optional_data;$ii=-1;
	while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
	while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
	$l=strlen($d);$ii=-1;$j=0;$k=0;
	while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
		$x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
	$optional_data=bin2hex($re);

	// Save the encrypted optional data so it can be sent to the updates server
	$http_args['body']['data'] = $optional_data;

	// Check for an available update
	$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/Kv7Br', 'http' );
	if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $http_args );
	if ( $ssl && is_wp_error( $raw_response ) ) {
		$raw_response = wp_remote_post( $http_url, $http_args );
	}
	// We stop in case we haven't received a proper response
	if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
		return $transient;
	}

	$response = (array) json_decode($raw_response['body']);
	if ( ! empty( $response ) ) {
		// You can use this action to show notifications or take other action
		do_action( 'wupdates_before_response', $response, $transient );
		if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
			$transient->response[ $slug ] = (array) $response['transient'];
		}
		do_action( 'wupdates_after_response', $response, $transient );
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check_Kv7Br' );

/* Only allow theme updates with a valid Envato purchase code */
function wupdates_add_purchase_code_field_Kv7Br( $themes ) {
	$output = '';
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );
	if ( ! is_multisite() && isset( $themes[ $slug ] ) ) {
		$output .= "<br/><br/>"; //put a little space above

		//get errors so we can show them
		$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
		delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

		//check if we have a purchase code saved already
		$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
		//in case there is an update available, tell the user that it needs a valid purchase code
		if ( empty( $purchase_code ) && ! empty( $themes[ $slug ]['hasUpdate'] ) ) {
			$output .= '<div class="notice notice-error notice-alt notice-large">' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates' ) . '</div>';
		}
		//output errors and notifications
		if ( ! empty( $errors ) ) {
			foreach ( $errors as $key => $error ) {
				$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
			}
		}
		if ( ! empty( $purchase_code ) ) {
			if ( ! empty( $errors ) ) {
				//since there is already a purchase code present - notify the user
				$output .= '<div class="notice notice-warning notice-alt"><p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates' ) . '</p></div>';
			} else {
				//this means a valid purchase code is present and no errors were found
				$output .= '<div class="notice notice-success notice-alt notice-large">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates' ) . '</div>';
			}
		}

		$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
		           '<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
		           '<input type="text" id="' . esc_attr( strtolower( $slug ) ) . '_wup_purchase_code" name="' . esc_attr( strtolower( $slug ) ) . '_wup_purchase_code"
	            value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates' ) . '" style="width:100%"/>' .
		           '<p>' . __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates' ) . '</p>' .
		           '<p class="theme-description">' .
		           __( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates' ) .
		           '</p>
			</form>';
	}
	//finally put the markup after the theme tags
	if ( ! isset( $themes[ $slug ]['tags'] ) ) {
		$themes[ $slug ]['tags'] = '';
	}
	$themes[ $slug ]['tags'] .= $output;

	return $themes;
}
add_filter( 'wp_prepare_themes_for_js' ,'wupdates_add_purchase_code_field_Kv7Br' );

/* Handle the purchase code input for multisite installations */
function wupdates_ms_theme_list_purchase_code_field_Kv7Br( $theme, $r ) {
	$output = '<br/>';
	$slug = $theme->get_template();
	//get errors so we can show them
	$errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
	delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//in case there is an update available, tell the user that it needs a valid purchase code
	if ( empty( $purchase_code ) ) {
		$output .=  '<p>' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates' ) . '</p>';
	}
	//output errors and notifications
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $key => $error ) {
			$output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
		}
	}
	if ( ! empty( $purchase_code ) ) {
		if ( ! empty( $errors ) ) {
			//since there is already a purchase code present - notify the user
			$output .= '<p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates' ) . '</p>';
		} else {
			//this means a valid purchase code is present and no errors were found
			$output .= '<p><span class="notice notice-success notice-alt">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates' ) . '</span></p>';
		}
	}

	$output .= '<form class="wupdates_purchase_code" action="" method="post">' .
	           '<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
	           '<input type="text" id="' . esc_attr( strtolower( $slug ) ) . '_wup_purchase_code" name="' . esc_attr( strtolower( $slug ) ) . '_wup_purchase_code"
		        value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates' ) . '"/>' . ' ' .
	           __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates' ) . ' ' .
	           __( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates' ) .
	           '</form>';

	echo $output;
}
add_action( 'in_theme_update_message-' . basename( get_template_directory() ), 'wupdates_ms_theme_list_purchase_code_field_Kv7Br', 10, 2 );

function wupdates_purchase_code_needed_notice_Kv7Br() {
	global $current_screen;

	$output = '';
	$slug = basename( get_template_directory() );
	//check if we have a purchase code saved already
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
	//if the purchase code doesn't pass the prevalidation, show notice
	if ( in_array( $current_screen->id, array( 'update-core', 'update-core-network') ) && true !== wupdates_prevalidate_purchase_code_Kv7Br( $purchase_code ) ) {
		$output .= '<div class="updated"><p>' . sprintf( __( '<a href="%s">Please enter your purchase code</a> to get automatic updates for <b>%s</b>.', 'wupdates' ), network_admin_url( 'themes.php?theme=' . $slug ), wp_get_theme( $slug ) ) . '</p></div>';
	}

	echo $output;
}
add_action( 'admin_notices', 'wupdates_purchase_code_needed_notice_Kv7Br' );
add_action( 'network_admin_notices', 'wupdates_purchase_code_needed_notice_Kv7Br' );

function wupdates_process_purchase_code_Kv7Br() {
	//in case the user has submitted the purchase code form
	if ( ! empty( $_POST['wupdates_pc_theme'] ) ) {
		$errors = array();
		$slug = sanitize_text_field( $_POST['wupdates_pc_theme'] ); // get the theme's slug
		$purchase_code_key = esc_attr( strtolower( $slug ) ) . '_wup_purchase_code';
		$purchase_code = false;
		if ( ! empty( $_POST[ $purchase_code_key ] ) ) {
			//get the submitted purchase code and sanitize it
			$purchase_code = sanitize_text_field( $_POST[ $purchase_code_key ] );
			//do a prevalidation; no need to make the API call if the format is not right
			if ( true !== wupdates_prevalidate_purchase_code_Kv7Br( $purchase_code ) ) {
				$purchase_code = false;
			}
		}
		if ( ! empty( $purchase_code ) ) {
			//check if this purchase code represents a sale of the theme
			$http_args = array (
				'body' => array(
					'slug' => $slug, //the theme's slug
					'url' => home_url(), //the site's home URL
					'purchase_code' => $purchase_code,
				)
			);

			//make sure that we use a protocol that this hosting is capable of
			$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/front/check_envato_purchase_code/Kv7Br', 'http' );
			if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
				$url = set_url_scheme( $url, 'https' );
			}
			//make the call to the purchase code check API
			$raw_response = wp_remote_post( $url, $http_args );
			if ( $ssl && is_wp_error( $raw_response ) ) {
				$raw_response = wp_remote_post( $http_url, $http_args );
			}
			// In case the server hasn't responded properly, show error
			if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
				$errors[] = __( 'We are sorry but we couldn\'t connect to the verification server. Please try again later.', 'wupdates' ) . '<span class="hidden">' . print_r( $raw_response, true ) . '</span>';
			} else {
				$response = json_decode( $raw_response['body'], true );
				if ( ! empty( $response ) ) {
					//we will only update the purchase code if it's valid
					//this way we keep existing valid purchase codes
					if ( isset( $response['purchase_code'] ) && 'valid' == $response['purchase_code'] ) {
						//all is good, update the purchase code option
						update_option( strtolower( $slug ) . '_wup_purchase_code', $purchase_code );
						//delete the update_themes transient so we force a recheck
						set_site_transient('update_themes', null);
					} else {
						if ( isset( $response['reason'] ) && ! empty( $response['reason'] ) && 'out_of_support' == $response['reason'] ) {
							$errors[] = esc_html__( 'Your purchase\'s support period has ended. Please extend it to receive automatic updates.', 'wupdates' );
						} else {
							$errors[] = esc_html__( 'Could not find a sale with this purchase code. Please double check.', 'wupdates' );
						}
					}
				}
			}
		} else {
			//in case the user hasn't entered a purchase code
			$errors[] = esc_html__( 'Please enter a purchase code. Make sure to get all the characters.', 'wupdates' );
		}

		if ( count( $errors ) > 0 ) {
			//if we do have errors, save them in the database so we can display them to the user
			update_option( strtolower( $slug ) . '_wup_errors', $errors );
		} else {
			//since there are no errors, delete the option
			delete_option( strtolower( $slug ) . '_wup_errors' );
		}

		//redirect back to the themes page and open popup
		wp_redirect( add_query_arg( 'theme', $slug ) );
		exit;
	}
}
add_action( 'admin_init', 'wupdates_process_purchase_code_Kv7Br' );

function wupdates_send_purchase_code_Kv7Br( $optional_data, $slug ) {
	//get the saved purchase code
	$purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

	if ( null === $optional_data ) { //if there is no optional data, initialize it
		$optional_data = array();
	}
	//add the purchase code to the optional_data so we can check it upon update check
	//if a theme has an Envato item selected, this is mandatory
	$optional_data['envato_purchase_code'] = $purchase_code;

	return $optional_data;
}
add_filter( 'wupdates_call_data_request', 'wupdates_send_purchase_code_Kv7Br', 10, 2 );

function wupdates_prevalidate_purchase_code_Kv7Br( $purchase_code ) {
	$purchase_code = preg_replace( '#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#', '$1-$2-$3-$4-$5', strtolower( $purchase_code ) );
	if ( 36 == strlen( $purchase_code ) ) {
		return true;
	}
	return false;
}

/* End of Envato checkup code */

// Adds login buttons to the wp-login.php pages
function add_wc_social_login_buttons_wplogin() {

	// Displays login buttons to non-logged in users + redirect back to login
	if(function_exists("woocommerce_social_login_buttons")) {
		woocommerce_social_login_buttons();
	}

}
add_action( 'login_form', 'add_wc_social_login_buttons_wplogin' );
add_action( 'register_form', 'add_wc_social_login_buttons_wplogin' );

// Changes the login text from what's set in our WooCommerce settings so we're not talking about checkout while logging in.
function change_social_login_text_option( $login_text ) {

	global $pagenow;

	// Only modify the text from this option if we're on the wp-login page
	if( 'wp-login.php' === $pagenow ) {
		// Adjust the login text as desired
		$login_text = esc_html__( 'You can also create an account with a social network.', 'woocommerce-social-login' );
	}

 	return $login_text;
}
add_filter( 'pre_option_wc_social_login_text', 'change_social_login_text_option' );