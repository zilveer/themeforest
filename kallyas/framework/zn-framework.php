<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_upload_dir;
$wp_upload_dir = wp_upload_dir();

/**
 * Class Zn_Framework
 */
final class Zn_Framework {

	/**
	 * Keeps an instance of the current class
	 * @var Zn_Framework The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Keeps the current theme data
	 * @var array
	 */
	public $theme_data = array();

	/**
	 * @var string holds the version number
	 */
	public $version;

	/**
	 * Keeps a record of all inline javascript
	 * @var array
	 */
	public $inline_js = array();

	/**
	 * Keeps a record of all inline css
	 * @var string
	 */
	public $inline_css = '';

	/**
	 * Keeps a record of all color schemes
	 * @var array
	 */
	public $color_schemes = array();
	/**
	 * @var
	 */
	public $installer;
	public $theme_options;
	public $metabox;
	public $termmeta;
	public $pagebuilder;
	public $mega_menu;
	public $icon_manager;
	public $html = null;
	public $unlimited_styles = null;
	/**
	 * Main Zn_Framework Instance
	 *
	 * Ensures only one instance of Zn_Framework is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see ZN()
	 * @return Zn_Framework - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( '__clone', __( 'Cheatin&#8217; huh?', 'zn_framework' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( '__wakeup', __( 'Cheatin&#8217; huh?', 'zn_framework' ), '1.0.0' );
	}


	/**
	 * @param $key
	 * @return mixed
	 */
	public function __get( $key ) {
		return $this->$key();
	}


	/**
	 * Class constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// SET-UP THE FRAMEWORK BASED ON CONFIG FILE
		$config_file = apply_filters( 'zn_theme_config_file', get_template_directory().'/template_helpers/theme_config.php' );
		$theme_config = '';
		if ( file_exists( $config_file ) ) {
			include( $config_file );
			$this->theme_data = apply_filters( 'zn_theme_config', $theme_config );

			$this->define_constants();
			$this->version = ZN_FW_VERSION;
			$this->includes();
			$this->add_actions();
		}

	}

	/**
	 * Define ZN Constants
	 */
	private function define_constants() {

		$active_theme = wp_get_theme();
		$version = $active_theme->parent() ? $active_theme->parent()->get('Version') : $active_theme->get('Version');

		define( 'ZN_FW_VERSION', $version );
		define( 'THEME_BASE', get_template_directory() );
		define( 'CHILD_BASE', get_stylesheet_directory() );
		define( 'THEME_BASE_URI', esc_url( get_template_directory_uri() ) );
		define( 'CHILD_BASE_URI', esc_url( get_stylesheet_directory_uri() ) );
		define( 'FW_PATH', dirname( __FILE__ ) );
		// TODO : BETTER WRITE THIS
		define( 'FW_URL', esc_url( get_template_directory_uri() . '/framework' ) );
	}


	/**
	 * What type of request is this?
	 * @var string $type ajax, frontend or admin
	 * @return bool
	 */
	public function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}

		return false;
	}

	private function includes() {
		include( FW_PATH .'/classes/functions-helper.php' );
		$this->fonts = include( FW_PATH .'/modules/google_fonts/ZnHg_Google_Fonts.php' );

		// Load the new shortcodes manager
		include( FW_PATH .'/modules/shortcodes_manager/class-shortcodes-manager.php' );

		if ( $this->is_request( 'admin' ) ) {

			include( FW_PATH .'/classes/functions-backend.php' );
			include( FW_PATH .'/classes/class-install.php' );
			include( FW_PATH .'/classes/class-zn-about.php' );

			include( FW_PATH .'/admin/class-zn-admin.php' );
			include( FW_PATH .'/classes/class-metaboxes.php' );
			include( FW_PATH .'/classes/class-term-meta.php' );

		}

		if ( $this->is_request( 'ajax' ) ) {
			include( FW_PATH .'/classes/theme_ajax.php' );
		}

		if ( $this->is_request( 'frontend' ) ) {
			include( FW_PATH .'/classes/functions-frontend.php' );
		}

	}

	private function add_actions() {

		add_filter( 'upload_mimes', array( $this, 'kallyas_upload_mime' ), 0 );

		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'wp_footer', array( $this, 'output_inline_js' ), 25 );
		add_action( 'wp_head', array( $this, 'output_inline_css' ), 25 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'init_scripts' ) );
	}

	public function kallyas_upload_mime( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['ttf'] = 'font/ttf';
		$mimes['woff'] = 'application/font-woff';
		$mimes['eot'] = 'application/vnd.ms-fontobject';
		return $mimes;
	}

	public function init() {

		$theme_supports = $this->theme_data['supports'];

		// LOAD ON ADMIN SCREENS AND AJAX CALLS
		if ( $this->is_request( 'admin' ) ) {
			// Classes
			$this->installer = new Zn_Install();
			$this->theme_options = new ZnAdmin();
			$this->metabox = new ZnMetabox();
			$this->metabox = new ZnTermMeta();

			if ( isset ( $theme_supports['theme_updater'] ) && $theme_supports['theme_updater'] ) {
				$this->init_theme_updater();
			}
		}

		if ( $this->theme_data['supports']['iconmanager'] ) {
			$this->init_iconmanager();
		}

		if ( $this->theme_data['supports']['pagebuilder'] ) {
			$this->init_pagebuilder();
		}

		if ( $this->theme_data['supports']['megamenu'] ) {
			$this->init_megamenu();
		}

		if ( isset ( $theme_supports['imageresizer'] ) && $theme_supports['imageresizer'] ) {
			$this->init_imageresizer();
		}

		if ( $this->is_debug() ) {
			$this->init_exporter();
		}

		do_action( 'zn_framework_init' );

	}

	function init_scripts() {
		wp_register_script( 'isotope', FW_URL .'/assets/js/jquery.isotope.min.js','jquery','',true );
	}

	function init_pagebuilder() {

		// Don't load the internal PB if the PB plugin is active
		if( class_exists( 'ZnBuilder' ) ){
			return false;
		}

		include( FW_PATH .'/pagebuilder/class-page-builder.php' );
		$this->pagebuilder = new ZnPageBuilder();

	}

	function init_theme_updater() {
		include( FW_PATH .'/modules/envato_theme_updater/class-theme-updater.php' );
		new ZnThemeUpdater( $this->theme_data['supports']['theme_updater'] );
	}

	function init_megamenu() {

		// MEGA MENU CLASS
		include( FW_PATH .'/classes/class-mega-menu.php' );

		// INIT THE ICONS CLASS
		$this->mega_menu = new ZnMegaMenu();

	}

	function init_iconmanager() {

		// INCLUDE ICON MANAGER
		include( FW_PATH .'/classes/class-icon-manager.php' );

		// INIT THE ICONS CLASS
		$this->icon_manager = new ZnIconManager();

	}

	function init_imageresizer() {

		// INCLUDE IMAGE RESIZE FUNCTIONS
		include( FW_PATH .'/classes/class-image-resize.php' );

	}

	function init_exporter() {
		// Include the main exporter class
		include( FW_PATH .'/importer/zn_export/zn_export.php' );
	}

	/**
	 * Load the HTML class if not loaded.
	 *
	 * @access public
	 * @return object
	 */
	function html() {
		if ( ! empty( $this->html ) ) {
			return $this->html;
		}

		include( FW_PATH .'/classes/class-html.php' );
		$this->html = new ZnHtml();

		return $this->html;

	}

	/**
	 * Unlimited Styles
	 *
	 * @access public
	 * @return array
	 */
	function unlimited_styles() {
		if ( ! empty( $this->unlimited_styles ) ) {
			return $this->unlimited_styles;
		}

		$all_styles = zget_option( 'custom_colors', 'style_options' );
		unset( $all_styles[''] );
		$styles = array( '' => 'Default Style' );
		$styles = apply_filters( 'zn_unlimited_styles', $styles );

		if ( is_array( $all_styles ) ) {
			foreach ( $all_styles as $key => $style ) {
				if ( ($old_style_name = $style['custom_style_name']) ) {
					// ** My Style Name => zn_cs_MyStyleName
					$style_name = preg_replace( '/[^a-zA-Z0-9]+/', '', $old_style_name );
					$styles[ 'zn_cs_'.$style_name ] = $style['custom_style_name'];
				}
			}
		}

		$this->unlimited_styles = $styles;
		return $this->unlimited_styles;

	}


	/**
	 * @var $option
	 * @var $slug
	 * @var null $prefix
	 * @return mixed
	 */
	function get_color_scheme_option( $option, $slug, $prefix = null ) {
		if ( ! empty( $this->color_schemes[ $slug ][ $option ] ) ) {
			return $this->color_schemes[ $slug ][ $option ];
		}

		$all_styles = zget_option( $option, $slug );
		$styles = array();
		if ( is_array( $all_styles ) ) {
			foreach ( $all_styles as $key => $style ) {
				if ( $old_style_name = $style['custom_style_name'] ) {
					//** My Style Name => zn_cs_MyStyleName
					$style_name = preg_replace( '/[^a-zA-Z0-9]+/', '', $old_style_name );
					$styles[ $prefix.$style_name ] = $style['custom_style_name'];
				}
			}
		}

		$this->color_schemes[ $slug ][ $option ] = $styles;
		return $this->color_schemes[ $slug ][ $option ];
	}


	/**
	 * @param string $code The code that you want to add to inline js
	 * @param bool|false $echo should we echo or return the code ?
	 */
	public function add_inline_js( $code, $echo = false ) {

		if ( $echo ) {

			$code = $code[ key( $code ) ];

			echo '<!-- Generated inline javascript -->';
			echo '<script type="text/javascript">';
				echo '(function($){';
					echo $code;
				echo '})(jQuery);';
			echo '</script>';

			return;
		}

		$this->inline_js[ key( $code ) ] = "\n" . $code[ key( $code ) ] . "\n";
	}


	/**
	 * @param string $code
	 * @param bool|false $echo
	 */
	public function add_inline_css( $code, $echo = false ) {

		if ( $echo ) {

			echo '<!-- Generated inline styles -->';
			echo '<style type="text/css">';
				echo $code;
			echo '</style>';

			return;
		}


		$this->inline_css .= $code;

	}

	/**
	 * Output the inline js
	 */
	public function output_inline_js() {

		if ( $this->inline_js ) {

			echo '<!-- Zn Framework inline JavaScript-->';
			echo '<script type="text/javascript">';
				echo 'jQuery(document).ready(function($) {';
				foreach ( $this->inline_js as $key => $code ) {
					echo $code;
				}
				echo '});';
			echo '</script>';

		}
	}

	/**
	 * Output the inline css
	 */
	public function output_inline_css() {
		if ( $this->inline_css ) {
			echo '<!-- Generated inline styles -->';
			echo "<style type='text/css' id='zn-inline-styles'>";
				echo $this->inline_css;
			echo '</style>';

		}

	}

	function load_html_scripts() {

		do_action( 'znfw_scripts' );

		// STYLES
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'zn_html_css', FW_URL .'/assets/css/zn_html_css.css' );

		wp_register_script( 'wp-color-picker-alpha', FW_URL .'/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), ZN_FW_VERSION );

		// HTML SCRIPTS
		wp_enqueue_script( 'wp-color-picker' ); // HTML
		wp_enqueue_script( 'wp-color-picker-alpha' );
		wp_enqueue_script( 'jquery-ui-slider' ); // HTML
		wp_enqueue_script( 'jquery-ui-button' ); // HTML
		wp_enqueue_script( 'jquery-ui-sortable' ); // HTML + PB
		wp_enqueue_script( 'jquery-ui-datepicker' ); // HTML

		wp_enqueue_media();

		// Add a dummy editor so we can use functions like wplink
		add_action( 'wp_footer', array( $this, 'add_dummy_editor' ), 1 );
		add_action( 'admin_footer', array( $this, 'add_dummy_editor' ), 1 );

		wp_enqueue_script( 'zn_timepicker', FW_URL .'/assets/js/jquery.timepicker.min.js',array( 'jquery' ),ZN_FW_VERSION, true );
		wp_enqueue_script( 'zn_modal', FW_URL .'/assets/js/zn_modal.js',array( 'jquery' ),ZN_FW_VERSION,true );
		wp_enqueue_script( 'zn_media', FW_URL .'/assets/js/zn_media.js',array( 'jquery' ),ZN_FW_VERSION,true );
		wp_enqueue_script( 'zn_ace', FW_URL .'/assets/js/src-min-noconflict/ace.js',array( 'jquery' ),ZN_FW_VERSION,true );
		wp_enqueue_script( 'ZnFormHelper', FW_URL .'/assets/js/ZnFormHelper.js',array( 'jquery' ),ZN_FW_VERSION,true );

		wp_enqueue_script( 'zn_html_script', FW_URL .'/assets/js/zn_html_script.js',array( 'jquery' ),ZN_FW_VERSION,true );
		wp_localize_script( 'zn_html_script', 'ZnAjax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php', 'relative' ),
			'security' => wp_create_nonce( 'zn_framework' ),
			'debug' => $this->is_debug(),
		) );

		$extension = ! $this->is_debug() ? '.min' : '';
		// Load the main shortcodes Scripts
		wp_register_script( 'znhg-options-machine', FW_URL .'/assets/js/dist/admin/options/options'.$extension.'.js', array( 'backbone', 'wp-color-picker', 'wp-color-picker-alpha', 'jquery-ui-slider' ), ZN_FW_VERSION, true );
		wp_register_style( 'znhg-options-machine', FW_URL .'/assets/css/options.css', array('wp-color-picker'), ZN_FW_VERSION );

	}

	function add_dummy_editor(){
		echo '<div class="zn_hidden">';
			wp_editor( 'dummy_text', 'zn_dummy_editor_id' );
		echo '</div>';
	}

	function is_debug(){
		return defined( 'ZN_FW_DEBUG' ) && ZN_FW_DEBUG == true;
	}

	/**
	 * Retrieve all pages as ID => Title to display in the theme options for user tos elect their custom Coming Soon
	 * page
	 * @since v4.1.4
	 * @return array
	 */
	public function get_pages()
	{
		$result = array(
			'__zn_default__' => __('Use default', 'zn_framework')
		);

		$pages = get_pages();
		if(empty($pages)){
			return $result;
		}

		foreach($pages as $page){
			$result[$page->ID] = $page->post_title;
		}
		return $result;
	}

	/**
	 * Check to see whether or not the current user is the network/website administrator
	 * @since v4.1.5
	 * @return bool
	 */
	public static function isManagingAdmin(){
		return (is_user_logged_in() && (current_user_can('manage_network') || current_user_can('manage_options')));
	}
}


/**
 * Returns the main instance of ZnFramework to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return Zn_Framework
 */
function ZN() {
	return Zn_Framework::instance();
}
/**
 * Returns the main instance of Pagebuilder
 *
 * @since  1.0.0
 * @return Zn_Framework
 */
function ZNPB() {
	return Zn_Framework::instance()->pagebuilder;
}


// Global for backwards compatibility.
$GLOBALS['zn_framework'] = ZN();
