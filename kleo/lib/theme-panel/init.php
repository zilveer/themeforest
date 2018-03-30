<?php
/* KLEO THEME PANEL */

class SQ_Panel {

	/**
	 * @var SQ_Panel The reference to *SQ_Panel* instance of this class
	 */
	protected static $_instance = null;

	public $slug = 'kleo-panel';


	public function __construct() {

		$this->set_constants();
		$this->set_hooks();

		$this->load_dependencies();

	}

	/**
	 * Returns the SQ_Panel instance of this class.
	 *
	 * @return SQ_Panel - Main instance
	 */
	public static function getInstance()
	{
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function set_constants() {
		if ( ! defined( 'KLEO_PANEL_DIR' ) ) {
			define('KLEO_PANEL_DIR', KLEO_LIB_DIR . '/theme-panel');
		}

		if ( ! defined( 'KLEO_PANEL_URI' ) ) {
			define('KLEO_PANEL_URI', KLEO_LIB_URI . '/theme-panel');
		}
	}

	public function load_dependencies() {
		require_once( KLEO_PANEL_DIR . '/class-addons-manager.php' );
		if ( ! class_exists( 'kleoImport' ) ) {
			require_once( KLEO_LIB_DIR . '/importer/import.php' );
		}
	}
	
	public function set_hooks() {

		add_action( 'admin_menu', array( $this, 'register_panel_page' ) );
		add_action( 'admin_init', array( $this, 'redirect_to_panel' ), 0 );

		add_action( 'wp_ajax_sq_theme_registration', array( $this, 'theme_registration' ) );

		if( ( isset( $_GET['page'] ) && $_GET['page'] == $this->slug ) || ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'sq_do_plugin_action' ) ) {

			add_action( 'admin_init', array( $this, 'config_addons' ), 12 );

			add_action( 'admin_enqueue_scripts', array( $this, 'panel_scripts' ) );
		}

	}


	/**
	 * Register CSS & JS Files
	 */
	function panel_scripts() {
		//CSS
		wp_register_style( "kleo-panel", KLEO_PANEL_URI . "/assets/css/theme-panel.css", array(), KLEO_THEME_VERSION, "all");
		wp_enqueue_style( 'kleo-panel' );

		//JS
		wp_enqueue_script( 'jquery-ui-tooltip');
		wp_register_script( "kleo-panel", KLEO_PANEL_URI . "/assets/js/theme-panel.js", array('jquery'), KLEO_THEME_VERSION, true);
		wp_enqueue_script( 'kleo-panel' );
	}

	public function register_panel_page() {
		add_theme_page(
			esc_html__( 'KLEO Welcome', 'kleo_framework' ),
			esc_html__( 'KLEO Welcome', 'kleo_framework' ),
			'manage_options',
			$this->slug,
			array( $this, 'panel_page' )
		);
	}

	function panel_page() {
		
		require( KLEO_PANEL_DIR . '/templates/welcome.php');

	}
	
	public function redirect_to_panel() {
		// Theme activation redirect
		global $pagenow;
		if( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

			wp_redirect( admin_url("themes.php?page=kleo-panel") );
			exit;
		}
	}

	public function theme_registration() {
		if ( ! isset( $_POST['sq_nonce'] ) || ! wp_verify_nonce( $_POST['sq_nonce'], 'sq_theme_registration' ) ) {
			wp_send_json_error( array( 'error' => 'Sorry, your nonce did not verify.' ) );
		}

		$option_name = "kleo_" . KLEO_DOMAIN;
		$tf_username = isset( $_POST['username'] ) ? $_POST['username'] : '';
		$tf_api      = isset( $_POST['api_key'] ) ? $_POST['api_key'] : '';

		if( ! empty( $tf_username ) && ! empty( $tf_api ) ){

			// Check to see if the user credentials are ok and if the user purchased the theme;
			if ( ! class_exists( "Envato_Protected_API" ) ) {
				require_once( KLEO_FW_DIR . "/inc/pixelentity-themes-updater/class-envato-protected-api.php");
			}

			$theme_author = 'SeventhQueen';
			$api = new Envato_Protected_API( $tf_username,$tf_api );
			$purchased = $api->wp_list_themes(true);
			$installed = wp_get_themes();
			$filtered = array();
			$has_purchased = false;

			foreach ( $installed as $theme ) {
				if (  $theme->{'Author Name'} !== $theme_author) {
					continue;
				}

				$filtered[$theme->Name] = $theme;
			}

			foreach ($purchased as $theme) {
				if ( isset( $theme->theme_name ) && isset( $filtered[$theme->theme_name] ) ) {
					$has_purchased = true;

				}
			}

			if( $has_purchased ) {
				// Save the updater values

				//Get entire array
				$my_options = get_option( $option_name );

				//Alter the options array appropriately
				$my_options['tf_username'] = $tf_username;
				$my_options['tf_apikey'] = $tf_api;

				//Update entire array
				update_option( $option_name, $my_options);

				wp_send_json_success(array( 'message' => __('Credentials saved successfully', 'zn_framework') ));
			}
			else{
				wp_send_json_error( array( 'error' => 'It seems you have not purchased the theme from the added account. Please check the credentials provided!' ) );
			}

		}

		wp_send_json_error( array( 'error' => 'Please enter your username and API key.' ) );
	}

	public function config_addons() {

		//move elements first
		SQ_Addons_Manager()->plugins = array('woocommerce' => SQ_Addons_Manager()->plugins['woocommerce']) + SQ_Addons_Manager()->plugins;
		SQ_Addons_Manager()->plugins = array('bbpress' => SQ_Addons_Manager()->plugins['bbpress']) + SQ_Addons_Manager()->plugins;
		SQ_Addons_Manager()->plugins = array('buddypress' => SQ_Addons_Manager()->plugins['buddypress']) + SQ_Addons_Manager()->plugins;
		SQ_Addons_Manager()->plugins = array('revslider' => SQ_Addons_Manager()->plugins['revslider']) + SQ_Addons_Manager()->plugins;
		SQ_Addons_Manager()->plugins = array('js_composer' => SQ_Addons_Manager()->plugins['js_composer']) + SQ_Addons_Manager()->plugins;
		SQ_Addons_Manager()->plugins = array('k-elements' => SQ_Addons_Manager()->plugins['k-elements']) + SQ_Addons_Manager()->plugins;

		$prepend = array('kleo-child' => array (
			'addon_type'		   => 'child_theme',
			'name'                 => 'KLEO child theme',
			'slug'                 => 'kleo-child',
			'source'               => KLEO_LIB_DIR . '/inc/kleo-child.zip',
			'source_type'          => 'bundled',
			'version'              => '1.0',
			'required'              => TRUE,
			'description' => 'Always activate the child theme to safely update KLEO and for better customization. <a href="https://codex.wordpress.org/Child_Themes" target="_blank">More on Child Themes</a>.',
		) );

		SQ_Addons_Manager()->plugins = $prepend + SQ_Addons_Manager()->plugins;
	}

}

SQ_Panel::getInstance();


