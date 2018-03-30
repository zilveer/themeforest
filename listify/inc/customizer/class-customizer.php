<?php
/**
 * Customize
 *
 * @package Listify
 * @since Listify 1.0.0
 */
class Listify_Customizer {

	/**
	 * @var object $instance self
	 * @access private
	 */
	private static $instance;

	/**
	 * Allow this to be accessed directly.
	 *
	 * @var object $fonts
	 * @access public
	 */
	public static $fonts;

	/**
	 * Allow this to be accessed directly.
	 *
	 * @var object $icons
	 * @access public
	 */
	public static $icons;

	/**
	 * Get the single instance of this class
	 *
	 * If the class has not been created create it, and include files.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Listify_Customizer ) ) {
			self::$instance = new self;
			self::includes();
			self::init();
		}

		return self::$instance;
	}

	/**
	 * Include needed files
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public static function includes() {
		$files = array(
			'helper-functions.php',

			'class-customizer-utils.php',

			'class-customizer-source.php',
			'class-customizer-sourceloader-interface.php',
			'class-customizer-sourceloader.php',

			'fonts/class-customizer-fonts.php',
			'icons/class-customizer-icons.php'
		);

		foreach ( $files as $file ) {
			include_once( trailingslashit( dirname( __FILE__) ) . $file );
		}
	}

	public static function init() {
		// include early
		include_once( dirname( __FILE__ ) . '/output-styles/class-customizer-output.php' );
		include_once( dirname( __FILE__ ) . '/output-styles/class-customizer-css.php' );
		include_once( dirname( __FILE__ ) . '/output-styles/class-customizer-preview.php' );

		self::$fonts = new Listify_Customizer_Fonts();
		self::$icons = new Listify_Customizer_Icons();

		// frontend
		add_action( 'after_setup_theme', array( __CLASS__, 'output_styles' ) );
		add_action( 'customize_preview_init', array( __CLASS__, 'customizer_scripts_preview' ), 99 );

		// backend
		add_action( 'customize_register', array( __CLASS__, 'custom_controls' ) );

		add_action( 'customize_register', array( __CLASS__, 'setup_panels' ), 10 );
		add_action( 'customize_register', array( __CLASS__, 'setup_sections' ), 20 );
		add_action( 'customize_register', array( __CLASS__, 'setup_controls' ), 30 );

		// we need to register select2 early as WooCommerce has an outdated version
		add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'customizer_select2' ), 0 );
		add_action( 'customize_controls_enqueue_scripts', array( __CLASS__, 'customizer_scripts' ) );

		add_filter( 'customize_dynamic_setting_args', array( __CLASS__, 'filter_dynamic_setting_args' ), 10, 2 );

		add_action( 'wp_ajax_listify_search_terms', array( 'Listify_Customizer_Utils', 'search_terms' ) );
	}

	/**
	 * Load custom controls.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public static function custom_controls( $wp_customize ) {
		foreach ( glob( dirname( __FILE__ ) . '/controls/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Output custom CSS based on control values.
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public static function output_styles() {
		foreach ( glob( dirname( __FILE__ ) . '/output-styles/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Register and modify panels.
	 *
	 * @since 1.5.0
	 * @param object $wp_customize WP_Customize_Manager
	 * @return void
	 */
	public static function setup_panels( $wp_customize ) {
		// include all custom panels
		foreach ( glob( dirname( __FILE__ ) . '/definitions/panels/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Register and modify sections.
	 *
	 * @since 1.5.0
	 * @param object $wp_customize WP_Customize_Manager
	 * @return void
	 */
	public static function setup_sections( $wp_customize ) {
		// include all custom sections
		foreach ( glob( dirname( __FILE__ ) . '/definitions/sections/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * Register and modify controls.
	 *
	 * @since 1.5.0
	 * @param object $wp_customize WP_Customize_Manager
	 * @return void
	 */
	public static function setup_controls( $wp_customize ) {
		// include all custom controls
		foreach ( glob( dirname( __FILE__ ) . '/definitions/controls/*.php' ) as $file ) {
			include_once( $file );
		}
	}

	/**
	 * select2 Scripts and styles
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public static function customizer_select2() {
		wp_register_script( 'listify-select2', get_template_directory_uri() . '/inc/customizer/assets/js/vendor/select2/js/select2.min.js', array( 'jquery' ) );
		wp_register_style( 'listify-select2', get_template_directory_uri() . '/inc/customizer/assets/js/vendor/select2/css/select2.min.css' );
		wp_register_style( 'listify-select2-customizer', get_template_directory_uri() . '/inc/customizer/assets/css/listify-select2.css', array( 'listify-select2' ) );
	}

	/**
	 * Customizer Scripts and styles
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public static function customizer_scripts() {
		wp_enqueue_script( 'listify-customizer', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-admin.js', array( 'jquery' ) );

		wp_localize_script( 'listify-customizer', 'listifyCustomizer', apply_filters( 'listify_customizer_scripts', array(
			'BigChoices' => array(),
			'l10n' => array(
				'facetwpPlaceholder' => __( 'Choose facets...', 'listify' )
			)
		) ) );
	}

	/**
	 * Preview Scripts and styles
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public static function customizer_scripts_preview( $wp_customize ) {
		wp_enqueue_script( 'webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js' );
		wp_enqueue_script( 'listify-customizer-preview', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-preview.js', array( 'jquery', 'underscore', 'webfont' ), '', true );

		wp_localize_script( 'listify-customizer-preview', 'listifyCustomizerPreview', array() );
	}

	/**
	 * Filters a dynamic setting's constructor args.
	 *
	 * For a dynamic setting to be registered, this filter must be employed
	 * to override the default false value with an array of args to pass to
	 * the WP_Customize_Setting constructor.
	 *
	 * @since 1.5.0
	 * @param false|array $setting_args The arguments to the WP_Customize_Setting constructor.
	 * @param string      $setting_id   ID for dynamic setting, usually coming from `$_POST['customized']`.
	 * @return array|false
	 */
	public static function filter_dynamic_setting_args( $setting_args, $setting_id ) {
		if ( preg_match( '/marker-color-(.*)/', $setting_id ) ) {
			$setting_args = array(
				'transport' => 'postMessage',
				'default' => '#555555'
			);
		}

		if ( preg_match( '/listings-(.*)-icon/', $setting_id ) ) {
			$setting_args = array(
				'transport' => 'postMessage',
				'default' => 'information-circled'
			);
		}

		return $setting_args;
	}

}

/**
 * Return the single customizer instance.
 *
 * @since 1.0.0
 * @return object Listify_Customizer
 */
function listify_customizer() {
    return Listify_Customizer::instance();
}

// start things up
listify_customizer();
