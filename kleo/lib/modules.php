<?php
/* Modules config file */

add_filter( 'k_elements_shortcodes', array( 'Modules_Data', 'remove_shortcodes' ) );

class Modules_Data {
	static $shortcodes = array(
		'kleo_grid' => array(
			'option_name' => 'sh_feature_item',
			'css_file' => 'feature_item'
		),
		'kleo_feature_item' => array(
			'option_name' => 'sh_feature_item',
			'css_file' => 'feature_item'
		),
		'kleo_register' => array(
			'option_name' => 'sh_kleo_register',
			'css_file' => 'kleo_register'
		),
		'kleo_news_focus' => array(
			'option_name' => 'sh_news_focus',
			'css_file' => 'news_focus'
		),
		'kleo_news_highlight' => array(
			'option_name' => 'sh_news_highlight',
			'css_file' => 'news_highlight'
		),
		'kleo_news_ticker' => array(
			'option_name' => 'sh_news_ticker',
			'css_file' => 'news_ticker'
		),
		'kleo_pin' => array(
			'option_name' => 'sh_poi',
			'css_file' => 'poi_pins'
		),
		'kleo_pricing_table' => array(
			'option_name' => 'sh_pricing_table',
			'css_file' => 'pricing_table'
		),
		'kleo_pricing_table_item' => array(
			'option_name' => 'sh_pricing_table',
			'css_file' => 'pricing_table'
		),
	);

	static $modules = array(
		'kleo_clients' => array(
			'option_name' => 'module_clients'
		),
		'kleo_testimonials' => array(
			'option_name' => 'module_testimonials'
		),
		'kleo_portfolio' => array(
			'option_name' => 'module_portfolio'
		)
	);

	public static function remove_shortcodes( $shortcodes ) {
		if ( ! empty(self::$modules )) {
			foreach( self::$modules as $k => $module ) {
				if ( sq_option($module['option_name'], 1 ) == 0 ) {
					unset( $shortcodes[ $k ] );
				}
			}
		}

		if ( ! empty( self::$shortcodes )) {
			foreach( self::$shortcodes as $k => $shortcode ) {
				if ( sq_option($shortcode['option_name'], 1 ) == 0 ) {
					unset( $shortcodes[ $k ] );
				}
			}
		}

		return $shortcodes;
	}
}


class SQ_Modules_Config {

	public $sq_modules;
	public $shortcodes_list = array();
	public $modules_list = array();

	public function __construct() {

		$this->set_data();

		/* Get modules instance */
		$this->sq_modules = SQ_Modules::getInstance();

		/* If remove query option is ON */
		if ( sq_option( 'perf_remove_query', 0 ) == 1 ) {
			$this->sq_modules->query_string = null;
		}
		$this->define_scopes();
		$this->register_modules();
		$this->register_shortcodes();

		//remove modules files on theme options save
		add_action( 'kleo-opts-saved', array( $this, 'remove_files' ), 10, 2 );

		//replace default theme files
		add_action( 'wp_enqueue_scripts', array( $this, 'replace_assets' ), 30 );

		//plugins file
		add_action( 'init', array( $this, 'register_plugins' ), 12 );
		add_action( 'activated_plugin', array( $this, 'detect_plugin_change' ), 10 );
		add_action( 'deactivated_plugin', array( $this, 'detect_plugin_change' ), 10 );
		
	}

	public function set_data() {
		$this->modules_list = Modules_Data::$modules;
		$this->shortcodes_list = Modules_Data::$shortcodes;
	}


	public function define_scopes() {

		global $kleo_config;

		$app = new Modules_Scope(
			'app',
			'app.css',
			trailingslashit( THEME_DIR ) . 'assets/css/modules/',
			trailingslashit( $kleo_config['custom_style_path'] ),
			trailingslashit( $kleo_config['custom_style_url'] )
		);
		$shortcodes = new Modules_Scope(
			'shortcodes',
			'shortcodes.css',
			trailingslashit( THEME_DIR ) . 'assets/css/shortcodes/',
			trailingslashit( $kleo_config['custom_style_path'] ),
			trailingslashit( $kleo_config['custom_style_url'] )
		);
		$plugins = new Modules_Scope(
			'plugins',
			'plugins.css',
			trailingslashit( THEME_DIR ) . 'assets/css/plugins/',
			trailingslashit( $kleo_config['custom_style_path'] ),
			trailingslashit( $kleo_config['custom_style_url'] )
		);
		$combined = new Modules_Scope(
			'combined',
			'combined.css',
			trailingslashit( THEME_DIR ) . 'assets/css/',
			trailingslashit( $kleo_config['custom_style_path'] ),
			trailingslashit( $kleo_config['custom_style_url'] )
		);

		$this->sq_modules->add_scope( $app );
		$this->sq_modules->add_scope( $shortcodes );
		$this->sq_modules->add_scope( $plugins );
		$this->sq_modules->add_scope( $combined );
	}

	public function register_modules() {

		$app = $this->sq_modules->get_scope_data( 'app' );
		$combined = $this->sq_modules->get_scope_data( 'combined' );

		//main css theme structure
		$this->sq_modules->add_mod( $app, 'base' );

		// Contact form functionality
		if( sq_option( 'contact_form', 1 ) == 1 ) {
			$this->sq_modules->add_mod( $app, 'quick-contact-form' );
			SQ_Modules::add_option( 'contact_form' );
		}

		// Portfolio
		if( sq_option( 'module_portfolio', 1 ) == 1 ) {
			$this->sq_modules->add_mod( $app, 'portfolio' );
			SQ_Modules::add_option( 'module_portfolio' );
		}

		// Sidemenu functionality
		if( sq_option( 'side_menu', 1 ) == 1 ) {
			$this->sq_modules->add_mod( $app, 'sidemenu' );
			SQ_Modules::add_option( 'side_menu' );
		}

		//combined extra css
		if ( sq_option( 'perf_combine_css', 0 ) == 1 ) {
			$this->sq_modules->add_mod( $combined, 'bootstrap', array('path' => trailingslashit( THEME_DIR ) . 'assets/css/bootstrap.min.css' ) );
			$this->sq_modules->add_mod( $app, 'magnific', array( 'path' => trailingslashit( THEME_DIR ) . 'assets/js/plugins/magnific-popup/magnific.css' ) );
		}
	}

	public function register_shortcodes() {

		$shortcodes = $this->sq_modules->get_scope_data( 'shortcodes' );

		if ( ! empty($this->shortcodes_list )) {
			foreach ( $this->shortcodes_list as $k => $shortcode ) {

				if( sq_option( $shortcode['option_name'], 1 ) == 1 ) {
					$this->sq_modules->add_mod( $shortcodes, $shortcode['css_file'] );
				}
				SQ_Modules::add_option( $shortcode['option_name'] );

			}
		}

		//popovers & tooltips always enabled
		$this->sq_modules->add_mod( $shortcodes, 'popover_tooltips' );

	}


	function register_plugins() {

		if ( $this->sq_modules->file_needs_generation( 'plugins' ) ) {

			$plugins_scope = $this->sq_modules->get_scope_data( 'plugins' );

			/* badgeOS */
			if ( class_exists( 'BadgeOS' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'badgeos' );
			}

			/* BP Cover Photo || BUDDYPRESS */
			if ( function_exists( 'bp_is_active' ) || function_exists( 'sq_bp_cover_photo_init' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'bp-cover-photo' );
			}

			/* BP Profile Search */
			if ( defined( 'BPS_VERSION' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'bp-profile-search' );
			}

			/* Contact Form 7 */
			if ( defined( 'WPCF7_VERSION' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'contact-form-7' );
			}

			/* Events Manager */
			if ( defined( 'EM_VERSION' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'events-manager' );
			}

			/* Geo My WP */
			if ( class_exists( 'GEO_my_WP' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'geo-my-wp' );
			}

			/* Mailchimp 4 WP */
			if ( defined( 'MC4WP_VERSION' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'mc4wp' );
			}
			/* MyCred */
			if (defined('myCRED_VERSION')) {
				$this->sq_modules->add_mod( $plugins_scope ,'mycred' );
			}

			/* PMPRO */
			if ( defined( 'PMPRO_VERSION' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'pmpro' );
			}

			/* Revslider */
			if ( class_exists( 'RevSliderBase' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'revslider' );
			}

			/* RtMedia */
			if (class_exists( 'RTMedia' )) {
				$this->sq_modules->add_mod( $plugins_scope ,'rtmedia' );
			}

			/* Social Articles */
			if (class_exists( 'SocialArticles' )) {
				$this->sq_modules->add_mod( $plugins_scope ,'social-articles' );
			}

			/* Visual composer */
			$this->sq_modules->add_mod( $plugins_scope ,'visual-composer' );

			/* WPML */
			if( defined('ICL_SITEPRESS_VERSION') ) {
				$this->sq_modules->add_mod( $plugins_scope ,'wpml' );
			}

			/* YITH Wishlist */
			if( defined('YITH_WCWL') ) {
				$this->sq_modules->add_mod( $plugins_scope ,'yith-wcwl' );
			}

			/* BP Group Email Subscription */
			if ( function_exists( 'ass_loader' ) ) {
				$this->sq_modules->add_mod( $plugins_scope ,'bp-group-email-subscription' );
			}
			/* Cometchat */
			$this->sq_modules->add_mod( $plugins_scope ,'cometchat' );

			//Mediaelement styling
			$this->sq_modules->add_mod( $plugins_scope, 'mediaelement' );

		}
	}


	 /**
	 * Replace theme assets with dynamically generated ones
	 */
	public function replace_assets() {

		/* Combined assets check */
		if ( sq_option( 'perf_combine_css', 0 ) == 1 ) {

			$combined_content = $this->sq_modules->get_content( 'combined' );
			$combined_content .= $this->sq_modules->get_content( 'app' );
			$combined_content .= $this->sq_modules->get_content( 'shortcodes' );
			$combined_content .= $this->sq_modules->get_content( 'plugins' );

			if ( $this->sq_modules->file_exists_and_check_generation( 'combined', $combined_content ) ) {
				wp_deregister_style( 'kleo-combined' );
				wp_register_style( 'kleo-combined', $this->sq_modules->mods->combined->output_url . $this->sq_modules->mods->combined->filename, array(), $this->sq_modules->query_string, 'all' );

				//make sure fonts are loaded
				wp_enqueue_style( 'kleo-fonts' );
			}
		} else {
			$app_content = $this->sq_modules->get_content( 'app' );
			$app_content .= $this->sq_modules->get_content( 'shortcodes' );

			if ( $this->sq_modules->file_exists_and_check_generation( 'app', $app_content ) ) {
				wp_deregister_style( 'kleo-app' );
				wp_register_style( 'kleo-app', $this->sq_modules->mods->app->output_url . $this->sq_modules->mods->app->filename, array(), $this->sq_modules->query_string, 'all' );
			}

			if ( $this->sq_modules->file_exists_and_check_generation( 'plugins' ) ) {
				wp_deregister_style( 'kleo-plugins' );
				wp_register_style( 'kleo-plugins', $this->sq_modules->mods->plugins->output_url . $this->sq_modules->mods->plugins->filename, array(), $this->sq_modules->query_string, 'all' );
			}
		}
	}

	/**
	 * Remove dynamically generated app.css if a module setting has changed
	 * @param $value
	 * @param array $changed_values
	 */
	public function remove_files( $value, $changed_values ) {

		if ( is_array( $changed_values ) ) {
			foreach ( $changed_values as $k => $v ) {
				if ( in_array( $k, SQ_Modules::$options ) || $k == 'performance' || $k == 'perf_combine_css' ) {
					$this->sq_modules->remove_file( 'app' );
					$this->sq_modules->remove_file( 'combined' );
					$this->sq_modules->remove_file( 'plugins' );
					break;
				}
			}
		}
	}

	/**
	 * Regenerate theme css on plugin activate/deactivate
	 */
	function detect_plugin_change( $plugin ) {
		$this->sq_modules->remove_file( 'plugins' );
		$this->sq_modules->remove_file( 'combined' );
	}

}

if ( sq_option( 'performance', 0 ) == 1 ) {
	new SQ_Modules_Config();
}