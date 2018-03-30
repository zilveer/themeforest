<?php
/**
 * Theme Loader
 * @author alex
 */
class ctThemeLoader {

	protected static $instance;

	/**
	 * @var string
	 */
	protected $projectName;
	/**
	 * Is theme activation?
	 * @var bool
	 */

	protected $themeActivation = false;
	/**
	 * Bundled childs
	 * @var array
	 */

	protected $prepackedChildThemes = array();
	/**
	 * @var ctFilesLoader
	 */

	protected static $filesLoader;

	/**
	 * @var array
	 */
	protected $docs = array( 'url' => '', 'label' => '', 'name'=>'' );

	protected $supportUrl = '';

	/**
	 * Inits
	 */

	public function init( $projectName ) {
		$this->projectName = str_replace( array( ' ' ), '', strtolower( $projectName ) );

		$this->constants();

		require_once CT_THEME_LIB_DIR.'/createit/ctFilesLoader.class.php';

		$this->initRoots();

		$this->initCreateit();

		//initialize plugins
		$this->initPlugins();

		//shortcodes
		$this->initShortcodes();

		//widgets
		$this->initWidgets();

		//custom types
		$this->initCustomTypes();

		//breadcrumbs
		$this->initBreadcrumbs();

		//setup
		$this->initSetup();
		$this->initMenu();

		$this->validateSetup();

		//stylesheets
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 100 );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		$this->clickDemoImport();

		//@see 'ct_loader.init'
		add_action( 'init', array( $this, 'initThemeOptions' ), 0 );

		$this->initFrontendOptions();

		$this->initAdminOptions();

		self::getFilesLoader()->tryIncludeOnce( CT_THEME_SETTINGS_MAIN_DIR . '/config.php' );


		add_action( 'after_switch_theme', array( $this, 'themeActivation' ), 10, 2 );
		add_action( 'admin_init', array( $this, 'addAutoUpdate' ) );

		add_action( 'admin_menu', array( $this, 'addDocumentationMenu' ) );
		add_action( 'after_setup_theme', array( $this, 'basicSetup' ) );
		add_action( 'after_setup_theme', array( $this, 'redirectFromAdminMenu' ) );

		//listens to options loader
		if ( self::getFilesLoader()->tryIncludeOnce( CT_THEME_SETTINGS_MAIN_DIR . '/plugin/deps.php' ) ) {
			self::getFilesLoader()->requireOnce( CT_THEME_LIB_DIR . '/plugin/class-tgm-plugin-activation.php' );
			add_action( 'tgmpa_register', array( $this, 'registerPluginDeps' ) );
		}

		self::$instance = $this;
	}

	/**
	 * Standard settings
	 */

	public function basicSetup() {
		// Make theme available for translation
		load_theme_textdomain( 'ct_theme', get_template_directory() . '/lang' );

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'title-tag' );

	}

	/**
	 * Prevent from creating object multiple times
	 * @throws Exception
	 */

	public function __construct() {
		if ( self::$instance ) {
			throw new Exception( "Please use getInstance" );
		}
	}

	/**
	 * Returns loader instance
	 * @return mixed
	 */

	public function getInstance() {
		return self::$instance;
	}

	/**
	 * Add documentation menu
	 */

	public function addDocumentationMenu() {
		if ( $this->docs && !empty($this->docs['name'])) {
			add_theme_page(
				$this->docs['name'],
				$this->docs['name'],
				'manage_options',
				'themes.php?goto=ct-documentation'
			);
		}
	}

	/**
	 * Set URL support
	 *
	 * @param $url
	 */

	public function setSupportUrl( $url ) {
		$this->supportUrl = $url;
	}

	public function redirectFromAdminMenu( $value ) {
		if ( $this->docs ) {
			global $pagenow;
			if ( $pagenow == 'themes.php' && ! empty( $_GET['goto'] ) ) {
				//wp_redirect( 'http://createit.support/documentation/food-truck-documentation?theme' );
				wp_redirect( $this->docs['url'] );
				exit;
			}
		}
	}


	/**
	 * Sets documentation URL
	 *
	 * @param $url
	 * @param $label
	 */

	public function setDocumentationUrl( $url, $label = '' ) {
		if ( ! $label ) {
			$label = esc_html__( "Documentation", 'ct_theme' );
		}

		$this->docs = array( 'url' => $url, 'name' => $label );
	}

	/**
	 * Inits menu
	 */

	protected function initMenu() {
		self::getFilesLoader()->requireOnce( CT_THEME_LIB_DIR . '/menu/ctMenuHandler.class.php' );
	}

	/**
	 * Last function which initializes should call it
	 */

	protected function callInitialized() {
		apply_filters( 'ct_loader.init', $this->projectName );
	}

	/**
	 * FilesLoader - loads required files
	 * @return ctFilesLoader
	 */

	public static function getFilesLoader() {
		if ( ! self::$filesLoader ) {
			self::$filesLoader = new ctFilesLoader();
		}

		return self::$filesLoader;
	}

	/**
	 * Handle click demo import
	 */

	public function clickDemoImport() {
		self::getFilesLoader()->requireOnce( CT_THEME_LIB_DIR . '/demo/install.php' );
	}

	/**
	 * Set child theme names which are bundled with these theme
	 * @see automatic update - these child themes will be updateable by internal udpdated
	 *
	 * @param $names
	 */

	public function setPrepackedChildThemes( $names ) {
		$this->prepackedChildThemes = $names;
	}

	/**
	 * Checks is eveyrthing ok
	 */

	protected function validateSetup() {
		add_action( 'admin_notices', array( $this, 'showLongDirNameError' ) );
	}

	/**
	 * Inits plugins
	 */

	public function registerPluginDeps() {

		$plugins = array();

		//load $plugins variable
		require self::getFilesLoader()->getFilePath( CT_THEME_SETTINGS_MAIN_DIR . '/plugin/deps.php' );

		// Change this to your theme text domain, used for internationalising strings
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */

		$config = array(
			'domain'           => 'ct_theme', // Text domain - likely want to be the same as your theme.
			'default_path'     => '', // Default absolute path to pre-packaged plugins
			/*parent_menu_slug AND parent_url_slug are  DEPRECATED in TGM-Plugin-Activation 2.5.2
			 * 'parent_menu_slug' => 'themes.php', // Default parent menu slug
			'parent_url_slug'  => 'themes.php', // Default parent URL slug
			*/
			'menu'             => 'install-required-plugins', // Menu slug
			'has_notices'      => true, // Show admin notices or not
			'is_automatic'     => false, // Automatically activate plugins after installation or not
			'message'          => '', // Message to output right before the plugins table
			'strings'          => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'ct_theme' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'ct_theme' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'ct_theme' ),
				// %1$s = plugin name
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'ct_theme' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.',
					'This theme requires the following plugins: %1$s.', 'ct_theme' ),
				// %1$s = plugin name(s)
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.',
					'This theme recommends the following plugins: %1$s.', 'ct_theme' ),
				// %1$s = plugin name(s)
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.',
					'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'ct_theme'),
				// %1$s = plugin name(s)
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.',
					'The following required plugins are currently inactive: %1$s.', 'ct_theme' ),
				// %1$s = plugin name(s)
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.',
					'The following recommended plugins are currently inactive: %1$s.' , 'ct_theme'),
				// %1$s = plugin name(s)
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.',
					'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ct_theme' ),
				// %1$s = plugin name(s)
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
					'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ct_theme' ),
				// %1$s = plugin name(s)
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.',
					'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ct_theme' ),
				// %1$s = plugin name(s)
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'ct_theme'),
				'activate_link'                   => _n_noop( 'Activate installed plugin',
					'Activate installed plugins' , 'ct_theme'),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'ct_theme' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'ct_theme' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s',
					'ct_theme' ),
				// %1$s = dashboard link
				'nag_type'                        => 'updated'
				// Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa( $plugins, $config );
	}

	/**
	 * Listener for theme activation
	 */

	public function themeActivation() {
		$this->themeActivation = true;

		$theme_data = wp_get_theme();
		$newVersion = (float) $theme_data->get( 'Version' );

		//add default image crop
		if ( apply_filters( 'ct_theme_loader.crop_images', true ) ) {
			if ( ! get_option( "medium_crop" ) ) {
				add_option( "medium_crop", "1" );
			} else {
				update_option( "medium_crop", "1" );
			}
		}

		apply_filters( 'ct.theme_activation', (float) get_option( $this->projectName . '_theme_version', 0 ), $newVersion, $this->projectName );
	}

	/**
	 * Displays a message when theme is deployed not correctly
	 */

	public function showLongDirNameError() {
		$name = basename( $this->getThemeDir() );
		if ( strlen( $name ) > 20 ) {
			echo '<div class="error">
       <p><strong>' . sprintf( esc_html__( "Your theme's directory name %s is too long! It will cause unpredictable errors in your Wordpres installation. Please change it's directory name to maximum 20 characters.",
					'ct_theme' ),
					$name ) . '</strong></p>
    </div>';
		}
	}

	/**
	 * Returns theme dir (or child dir)
	 * @return string
	 */

	public function getThemeDir() {
		return is_child_theme() ? get_stylesheet_directory() : CT_THEME_DIR;
	}

	/**
	 * Add auto update
	 */

	public function addAutoUpdate() {
		self::getFilesLoader()->requireOnce( CT_THEME_LIB_DIR . '/updater/ctThemeUpdater.class.php' );

		//check child theme update
		$mainTheme = $this->projectName;

		if ( is_child_theme() && ( in_array( $this->projectName, $this->prepackedChildThemes ) ) ) {
			$u = new ctThemeUpdater( basename( get_stylesheet_directory() ) );
			$u->setInternalName( $this->projectName );

			if ( $this->themeActivation ) {
				$u->checkForUpdates();
			}

			//we will guess that that is it's name
			$mainTheme = basename( CT_THEME_DIR );
		}

		$u = new ctThemeUpdater( basename( CT_THEME_DIR ) );
		$u->setInternalName( $mainTheme );

		if ( $this->themeActivation ) {
			$u->checkForUpdates();
		}

		/** @var $NHP_Options NHP_Options */
		global $NHP_Options;
		//add options listener for license
		add_action( 'nhp-opts-options-validate-' . $NHP_Options->args['opt_name'],
			array( $u, 'handleLicenseKeySaved' ) );
	}

	/**
	 * Inits frontend options
	 */

	protected function initFrontendOptions() {
		//registers additional option events
		self::getFilesLoader()->requireOnce(CT_THEME_LIB_DIR . '/createit/ctFrontendOptionsHandler.class.php' );
		$h = new ctFrontendOptionsHandler();
		$h->init();
	}

	/**
	 * Inits admin options
	 */

	protected function initAdminOptions() {
		//registers additional option events
		self::getFilesLoader()->requireOnce( CT_THEME_LIB_DIR . '/createit/ctAdminOptionsHandler.class.php' );
		$h = new ctAdminOptionsHandler();
		$h->init();
	}

	/**
	 * Setup constants
	 */

	protected function constants() {
		define( 'CT_PROJECT_NAME', $this->projectName );

		define( "CT_THEME_DIR", get_template_directory() );
		define( "CT_THEME_DIR_URI", get_template_directory_uri() );

		define( "CT_THEME_ASSETS", CT_THEME_DIR_URI . '/assets' );

		//lib dir
		define( "CT_THEME_LIB_DIR", CT_THEME_DIR . '/framework' );
		define( "CT_THEME_LIB_DIR_URI", CT_THEME_DIR_URI . '/framework' );

		//options fields dir
		define('CT_THEME_OPT_FIELDS_DIR',CT_THEME_LIB_DIR.'/options/fields');

		//shortcodes
		define('CT_THEME_SHORTCODES_DIR',CT_THEME_LIB_DIR.'/shortcodes');

		define( "CT_THEME_ADMIN_ASSETS_URI", CT_THEME_LIB_DIR_URI . '/admin/assets' );

		//theme lib dir
		define( "CT_THEME_LIB_WIDGETS", CT_THEME_LIB_DIR . '/widgets' );

		//theme settings
		define( "CT_THEME_SETTINGS_MAIN_DIR", CT_THEME_DIR . '/theme' );

		define( "CT_DOCS_URL", $this->docs['url'] );

		define( "CT_SUPPORT_URL", $this->supportUrl );

		//theme demo content

		$demoDir = CT_THEME_SETTINGS_MAIN_DIR . '/demo';
		if ( is_child_theme() ) {
			$dir = get_stylesheet_directory() . '/demo';
			if ( file_exists( $dir ) ) {
				$demoDir = $dir;
			}
		}

		define( "CT_THEME_DEMO_DIR", $demoDir );

		define( "CT_THEME_SETTINGS_MAIN_DIR_URI", CT_THEME_DIR_URI . '/theme' );

		//theme shortcodes
		define( "CT_THEME_SHORTCODE_DIR", CT_THEME_SETTINGS_MAIN_DIR . '/shortcodes' );

		//custom types
		define( "CT_THEME_CUSTOM_TYPES_DIR", CT_THEME_SETTINGS_MAIN_DIR . '/types' );

		//breadcrumbs
		define( "CT_THEME_BREADCRUMBS_DIR", CT_THEME_SETTINGS_MAIN_DIR . '/breadcrumbs' );

		//setup
		define( "CT_THEME_SETUP_DIR", CT_THEME_SETTINGS_MAIN_DIR . '/setup' );

		//theme widgets
		define( "CT_THEME_WIDGETS_DIR", CT_THEME_SETTINGS_MAIN_DIR . '/widgets' );

		//theme plugins
		define( "CT_THEME_PLUGINS", CT_THEME_SETTINGS_MAIN_DIR . '/plugin' );

	}

	/**
	 * Do we need upgrade?
	 * @return bool
	 */
	protected function isUpgradeRequired() {
		$theme_data = wp_get_theme();
		$newVersion = (float) $theme_data->get( 'Version' );
		if ( ! $currentVersion = (float) get_option( $this->projectName . '_theme_version', 0 ) ) {
			return false;
		}

		return version_compare( $newVersion, $currentVersion, '>' );
	}

	/**
	 * Inits Option tree
	 */

	public function initThemeOptions() {
		if ( ! class_exists( 'ctNHP_Options' ) ) {
			self::getFilesLoader()->requireOnce( CT_THEME_LIB_DIR . '/createit/ctNHP_Options.class.php' );
		}

		//load our theme options
		$dir = CT_THEME_SETTINGS_MAIN_DIR . '/options';

		//these variables are for being filled in theme
		$sections = array(); //section structure
		$tabs     = array(); //additional, custom tabs
		$args     = array(); //options configuration

		//include because we use injected variables. Otherwise we could use ctFilesLoader::includeOnce
		include self::getFilesLoader()->getFilePath( $dir . '/init.php' );

		/** @var $order array */
		foreach ( $order as $e ) {
			include self::getFilesLoader()->getFilePath( $dir . '/_' . $e . '.php' );
		}

		//add options
		if ( $s = apply_filters( 'ct_theme_loader.options.load', $sections ) ) {
			$sections = $s;
		}

		//lets initialize options
		global $NHP_Options;
		$NHP_Options = new ctNHP_Options( $sections, $args, $tabs );

		if ( $this->isUpgradeRequired() ) {
			$NHP_Options->refresh();
		}

		$theme_data = wp_get_theme();
		//add current version
		update_option( $this->projectName . '_theme_version', (float) $theme_data->get( 'Version' ) );

		add_action( 'nhp-opts-load-page-' . $NHP_Options->getOptionsPageName(),
			array( $this, 'themeOptionsCustomAssets' ) );

		$this->callInitialized();
	}

	public function themeOptionsCustomAssets() {
		wp_register_script( 'ct_admin_theme_options_js_codemirror',
			CT_THEME_ADMIN_ASSETS_URI . '/js/codemirror.compressed.min.js' );
		wp_register_script( 'ct_admin_theme_options_js',
			CT_THEME_ADMIN_ASSETS_URI . '/js/options.js',
			array( 'ct_admin_theme_options_js_codemirror' ) );
		wp_enqueue_script( 'ct_admin_theme_options_js' );

		wp_enqueue_style( 'ct_admin_theme_options_js_codemirror',
			CT_THEME_ADMIN_ASSETS_URI . '/css/codemirror/codemirror.css' );
	}

	/**
	 * Counts theme options qty
	 *
	 * @param array $sections
	 *
	 * @return int
	 */
	protected function countThemeOptionsQty( $sections ) {
		$total = 0;
		foreach ( $sections as $s ) {
			if ( isset( $s['fields'] ) ) {
				$total += count( $s['fields'] );
			}
		}

		return $total;
	}

	/**
	 * Init shortcodes
	 */

	protected function initShortcodes() {
		require_once CT_THEME_LIB_DIR . '/shortcodes/ctShortcodeHandler.class.php';
		ctShortcodeHandler::getInstance(); //initialize shortcodes
	}

	/**
	 * Add scripts
	 */

	public function scripts() {

		if ( apply_filters( 'ct_theme_loader.load_styles', true ) ) {

			if ( $styles = apply_filters( 'ct_theme_loader.styles', array() ) ) {
				//load styles with compile
				foreach ( $styles as $handleName => $path ) {
					if ( file_exists( CT_THEME_DIR . '/assets/css/style.css' ) ) {
						wp_enqueue_style( $handleName, $path, false, null );
					} else {
						wp_enqueue_style( $handleName, CT_THEME_DIR_URI . '/ct/css.php?file=' . urlencode( $path ), false, null );
					}
				}

			} elseif ( file_exists( CT_THEME_DIR . '/assets/css/style.css' ) ) {
				wp_enqueue_style( 'ct_theme', CT_THEME_DIR_URI . '/assets/css/style.css', false, null );
			} elseif ( file_exists( CT_THEME_DIR . '/assets/less/style.less' ) ) {
				wp_enqueue_style( 'ct_theme', CT_THEME_DIR_URI . '/ct/css.php?assets/css/style.css', false, null );
			} else {
				//load legacy solution
				wp_enqueue_style( 'ct_bootstrap', CT_THEME_DIR_URI . '/assets/css/bootstrap.css', false, null );
				wp_enqueue_style( 'ct_bootstrap_responsive',
					CT_THEME_DIR_URI . '/assets/css/bootstrap-responsive.css',
					array( 'ct_bootstrap' ),
					null );
				wp_enqueue_style( 'ct_app2', CT_THEME_DIR_URI . '/assets/css/app.css', false, null );
			}
		}

		// Load style.css from child theme
		if ( is_child_theme() ) {
			wp_enqueue_style( 'ct_child', get_stylesheet_uri(), false, null );
		}

		if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if(apply_filters('ct_theme_loader.load_plugins.js', true)) {
			wp_register_script('ct_plugins', CT_THEME_DIR_URI . '/assets/js/plugins.js', array('jquery'), null, true);
			wp_enqueue_script('ct_plugins');
		}
		//custom user style
		if ( file_exists( CT_THEME_DIR . '/assets/js/main.js' ) ) {
			wp_register_script( 'ct_main', CT_THEME_DIR_URI . '/assets/js/main.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'ct_main' );

			if ( apply_filters( 'ct_main.localize', false ) ) {
				wp_localize_script( 'ct_main', 'ct_params', array(
					'assets' => CT_THEME_ASSETS,
					'theme'  => CT_THEME_DIR_URI
				) );
			}
		}
	}

	/**
	 * Adds admin scripts
	 */

	public function admin_scripts() {
		wp_register_style( 'ct_admin_style', CT_THEME_ADMIN_ASSETS_URI . '/css/style.css' );
		wp_enqueue_style( 'ct_admin_style' );

		wp_register_script( 'ct_admin_js', CT_THEME_ADMIN_ASSETS_URI . '/js/admin.js' );
		wp_enqueue_script( 'ct_admin_js' );
	}

	/**
	 * Roots
	 */

	protected function initRoots() {

		//for older PHP systems
		if ( ! defined( '__DIR__' ) ) {
			define( '__DIR__', CT_THEME_LIB_DIR.'/createit/' );
		}

		//load core files
		$files = array( 'utils', 'config', 'cleanup' );
		foreach ( $files as $f ) {
			self::getFilesLoader()->includeOnce( CT_THEME_LIB_DIR . '/roots/' . $f . '.php' );
		}
	}

	/**
	 * Roots
	 */

	protected function initCreateit() {

		//for older PHP systems
		if ( ! defined( '__DIR__' ) ) {
			define( '__DIR__', CT_THEME_LIB_DIR.'/createit/' );
		}

        self::getFilesLoader()->includeOnce(CT_THEME_LIB_DIR.'/encrypt/Aes.class.php');
        self::getFilesLoader()->includeOnce(CT_THEME_LIB_DIR.'/encrypt/ctDataCipher.class.php');

		//load core files
		$files = array( 'cleanup', 'tools', 'ctContextOptions.class' );
		foreach ( $files as $f ) {
			self::getFilesLoader()->includeOnce( CT_THEME_LIB_DIR . '/createit/' . $f . '.php' );
		}

		//load additional optional libs - internal use, not available in production theme
		if ( file_exists( CT_THEME_DIR . '/ct/functions.php' ) ) {
			require_once CT_THEME_DIR . '/ct/functions.php';
		}

		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Init plugins
	 */

	protected function initPlugins() {
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_LIB_DIR . '/plugin' );
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_SETTINGS_MAIN_DIR . '/plugin' );
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_SETTINGS_MAIN_DIR . '/plugin/*/' );
	}

	/**
	 * Init widgets
	 */

	protected function initWidgets() {
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_WIDGETS_DIR, '/*/*.php' );
	}

	/**
	 * Init custom types
	 */

	protected function initCustomTypes() {
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_CUSTOM_TYPES_DIR );
	}

	/**
	 * Init breadcrumbs
	 */

	protected function initBreadcrumbs() {
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_BREADCRUMBS_DIR );
	}

	/**
	 * Init setup
	 */

	protected function initSetup() {
		self::getFilesLoader()->includeOnceByPattern( CT_THEME_SETUP_DIR );
	}

}
