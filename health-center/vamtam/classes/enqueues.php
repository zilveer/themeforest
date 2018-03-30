<?php

/**
 * Enqueue styles and scripts used by the theme
 *
 * @package wpv
 */

/**
 * class WpvEnqueues
 */
class WpvEnqueues {
	/**
	 * Hook the relevant actions
	 */
	public static function actions() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'cf7_shortcode_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'styles' ), 99 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_styles' ) );
	}

	private static function is_our_admin_page() {
		if ( ! is_admin() ) return false;

		$screen = get_current_screen();

		return
			in_array( $screen->base, array( 'post', 'widgets', 'themes', 'upload' ) ) ||
			strpos( $screen->base, 'vamtam_page' ) === 0 ||
			strpos( $screen->base, 'toplevel_page_wpv' ) === 0 ||
			$screen->base === 'media_page_vamtam_icons';
	}

	private static function inject_dependency( $handle, $dep ) {
		global $wp_scripts;

		$script = $wp_scripts->query( $handle, 'registered' );

		if( !$script )
			return false;

		if( !in_array( $dep, $script->deps ) ){
			$script->deps[] = $dep;
		}

		return true;
	}

	/**
	 * Front-end scripts
	 */
	public static function scripts() {
		if ( is_admin() || WpvTemplates::is_login() ) return;

		global $is_IE, $content_width;

		$theme_version = WpvFramework::get_version();
		$gmap_key = wpv_get_option( 'gmap_api_key' );

		// modernizr should be on top
		wp_enqueue_script( 'modernizr', WPV_JS .'modernizr.min.js' );

		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply', false, false, false, true );
		}

		if ( $is_IE ) {
			// wp_enqueue_script( 'vamtam-respondjs', WPV_JS .'plugins/thirdparty/respond.min.js', array(), $theme_version, true ); // only IE 8
			wp_enqueue_script( 'vamtam-selectivizr', WPV_JS .'plugins/thirdparty/selectivizr.min.js', array(), $theme_version, true );
		}

		wp_enqueue_script( 'jquery-transit', WPV_JS .'plugins/thirdparty/jquery.transit.min.js', array(), '0.9.9', true );
		wp_enqueue_script( 'jquery-match-height', WPV_JS .'plugins/thirdparty/jquery.matchheight.min.js', array(), '0.5.1', true );
		wp_enqueue_script( 'jquery-bxslider', WPV_JS .'plugins/thirdparty/jquery.bxslider.js', array(), '4.1.2', true );

		$all_js_path = ( WP_DEBUG || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || ( defined( 'WPV_SCRIPT_DEBUG' ) && WPV_SCRIPT_DEBUG ) ) ? 'all.js' : 'all.min.js';
		$all_js_deps = array(
			'jquery',
			'jquery-migrate',
			'jquery-ui-core',
			'jquery-effects-core',
			'jquery-ui-widget',
			'underscore',
			'jquery-match-height',
			'jquery-transit',
		);

		wp_enqueue_script( 'vamtam-all', WPV_JS . $all_js_path, $all_js_deps, $theme_version, true );

		self::inject_dependency( 'wc-cart-fragments', 'vamtam-all' );

		$script_vars = array(
			'content_width'    => $content_width,
			'magnific_close'   => __( 'Close (Esc)', 'health-center' ),
			'magnific_loading' => __( 'Loading...', 'health-center' ),
		);

		if ( ! empty( $gmap_key ) ) {
			$script_vars['gmap_api_key'] = $gmap_key;
		}

		wp_localize_script( 'vamtam-all', 'WPV_FRONT', $script_vars );
	}

	/**
	 * Admin scripts
	 */
	public static function admin_scripts() {
		if ( ! self::is_our_admin_page() ) return;

		$theme_version = WpvFramework::get_version();

		wp_enqueue_script( 'jquery-magnific-popup', WPV_JS .'plugins/thirdparty/jquery.magnific.js', array( 'jquery' ), $theme_version, true );

		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'editor' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-range', WPV_ADMIN_ASSETS_URI .'js/jquery.ui.range.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'jquery-ui-slider' );

		wp_enqueue_script( 'farbtastic' );

		wp_enqueue_media();

		wp_enqueue_script( 'wpv_admin', WPV_ADMIN_ASSETS_URI .'js/admin-all.js', array( 'jquery', 'underscore', 'backbone' ), $theme_version, true );
		wp_enqueue_script( 'wpv-shortcode', WPV_ADMIN_ASSETS_URI . 'js/shortcode.js', array( 'jquery' ), $theme_version, true );

		wp_localize_script(
			'wpv_admin', 'WPV_ADMIN', array(
				'stylesurl' => admin_url( 'admin.php?page=wpv_styles' ),
				'addNewIcon' => __( 'Add New Icon', 'health-center' ),
				'iconName' => __( 'Icon', 'health-center' ),
				'iconText' => __( 'Text', 'health-center' ),
				'iconLink' => __( 'Link', 'health-center' ),
				'iconChange' => __( 'Change', 'health-center' ),
				'fonts' => $GLOBALS['wpv_fonts'],
			)
		);
	}

	/**
	 * Some scripts are only necessary if there is a CF7 form on the page
	 */
	public static function cf7_shortcode_scripts() {
		global $post;

		if ( is_a( $post, 'WP_Post' ) && strpos( $post->post_content, '[contact-form' ) !== false ) {
			if ( wp_script_is( 'chosen', 'registered' ) ) {
				wp_enqueue_script( 'chosen' );
			} else {
				wp_enqueue_script( 'chosen', WPV_JS .'plugins/thirdparty/chosen.jquery.min.js', array( 'jquery' ), '1.1.0', true );
			}

			wp_enqueue_script( 'webshims', WPV_JS .'plugins/thirdparty/polyfiller.js', array( 'jquery' ), '1.12.4', true );
			wp_enqueue_style( 'wpv-chosen', wpv_prepare_url( WPV_THEME_CSS . 'chosen.css' ) );
		}
	}

	/**
	 * Front-end styles
	 */
	public static function styles() {
		if ( is_admin() || WpvTemplates::is_login() ) return;

		$theme_version = WpvFramework::get_version();

		$external_fonts = maybe_unserialize( wpv_get_option( 'external-fonts' ) );
		if ( is_array( $external_fonts ) && ! empty( $external_fonts ) ) {
			foreach ( $external_fonts as $name => $url ) {
				wp_enqueue_style( 'wpv-'.$name, $url, array(), $theme_version );
			}
		}

		wp_enqueue_style( 'front-magnific-popup', wpv_prepare_url( WPV_THEME_CSS . 'magnific.css' ) );

		$cache_timestamp = wpv_get_option( 'css-cache-timestamp' );

		$generated_deps = array( 'front-magnific-popup' );

		if ( wpv_has_woocommerce() ) {
			$generated_deps[] = 'woocommerce-layout';
			$generated_deps[] = 'woocommerce-smallscreen';
			$generated_deps[] = 'woocommerce-general';
		}

		if ( class_exists( 'Tribe__Events__Main' ) && ( tribe_is_event_query() ||  tribe_is_event_organizer() || tribe_is_event_venue() ) ) {
			$generated_deps[] = 'tribe-events-calendar-style';
			$generated_deps[] = 'tribe-events-full-calendar-style';
		}

		$suffix = is_multisite() ? $GLOBALS['blog_id'] : '';
		$css_file = 'all'.$suffix.'.css';
		$css_path = WPV_CACHE_URI . $css_file;

		if ( ! file_exists( WPV_CACHE_DIR . $css_file ) ) {
			$css_path = WPV_SAMPLES_URI . 'all-default.css';
		}

		wp_enqueue_style( 'front-all', wpv_prepare_url( $css_path ), $generated_deps, $cache_timestamp );

		global $wpv_is_shortcode_preview;

		if ( $wpv_is_shortcode_preview ) {
			wp_enqueue_style( 'vamtam-shortcode-preview', WPV_ADMIN_ASSETS_URI . 'css/shortcode-preview.css' );
		}

		$custom_icons = get_option( 'vamtam-custom-icons-map' );

		if ( $custom_icons ) {
			$icons_path = trailingslashit( WP_CONTENT_URL ) . 'vamtam/custom-icon-font/';
			$custom_icons_css = "
				@font-face {
					font-family: 'vamtam-custom-icons';
					src: url({$icons_path}custom-icons.eot);
					src: url({$icons_path}custom-icons.eot?#iefix) format('embedded-opentype'),
						url({$icons_path}custom-icons.ttf) format('truetype');
					font-weight: normal;
					font-style: normal;
				}
			";

			wp_add_inline_style( 'front-all', $custom_icons_css );
		}
	}

	/**
	 * Admin styles
	 */
	public static function admin_styles() {
		if ( is_admin() ) {
			wp_enqueue_style( 'vamtam-admin-fonts', WPV_ADMIN_ASSETS_URI . 'css/fonts.css' );
		}

		if ( ! self::is_our_admin_page() ) return;

		wp_enqueue_style( 'magnific', WPV_ADMIN_ASSETS_URI . 'css/magnific.css' );
		wp_enqueue_style( 'wpv_admin', WPV_ADMIN_ASSETS_URI . 'css/wpv_admin.css' );
		wp_enqueue_style( 'farbtastic' );
	}
}
