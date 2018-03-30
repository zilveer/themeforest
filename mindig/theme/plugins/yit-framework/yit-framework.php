<?php
/*
Plugin Name: YIT Framework
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Add all features for the YIThemes theme (portfolio, sliders, services, shortcodes, etc..)
Text Domain: yit
Domain Path: /languages/
Author: YIThemes
Author URI: http://yithemes.com/
Version: 1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Define using of YIThemes Theme */
define( 'USE_YIT_THEME', true );

if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

/* Plugin Framework Version Check */
! function_exists( 'yit_maybe_plugin_fw_loader' ) && require_once( 'plugin-fw/init.php' );
yit_maybe_plugin_fw_loader( dirname( __FILE__ ) );


/**
 * Manage all features of a YIT Theme
 */
class YIT_Framework {

	/** @var YIT_Framework Single instance of the class */
	protected static $instance;

	/** @var array All modules to active */
	protected $_modules = null;

	/** @var array All modules to active */
	protected $_active_modules = array();

	/** @var array All plugins installed */
	protected $_installed_plugins = array();

	/** @var string Detect if plugin is installed from plugin of wordpress or is bundled inside the theme */
	private $_from = 'theme';

	/**
	 * Returns single instance of the class
	 *
	 * @return YIT_Framework
	 * @since 1.0.0
	 */
	public static function get_instance(){
		if( is_null( self::$instance ) ){
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @return YIT_Framework
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'check_plugin_position' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ), 5 );
		add_action( 'plugins_loaded', array( $this, 'plugin_fw_loader' ), 15 );
		add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );
		add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ) );

		add_action( 'after_setup_theme', array( $this, 'load_modules' ), 0 );

		// admin page
		add_action( 'admin_init', array( $this, 'deactivate_singular_plugins' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_modules_page' ), 20 );
		add_action( 'admin_init', array( $this, 'activate_module_action' ) );
		add_action( 'admin_init', array( $this, 'deactivate_module_action' ) );

		add_action('switch_theme', array( $this, 'reset_yit_framework_options' ) );

		// filter list of plugin
		add_filter( 'all_plugins', array( $this, 'remove_modules' ), 10, 1 );
		// add notice
		add_action( 'admin_notices', array( $this, 'notice' ), 20 );
		// hide notice
		add_action( 'admin_init', array( $this, 'hide_notice' ) );

		// active new google analytics module, if there is sidebar active
		add_action( 'admin_init', array( $this, 'activate_new_google_analytics' ) );
	}

	/**
	 * Load YIT Plugin Framework
	 *
	 * @since  1.0
	 * @access public
	 * @return void
	 * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */

	public function plugin_fw_loader() {
		if ( ! defined( 'YIT_CORE_PLUGIN' ) ) {
			global $plugin_fw_data;
			if ( ! empty( $plugin_fw_data ) ) {
				$plugin_fw_file = array_shift( $plugin_fw_data );
				require_once( $plugin_fw_file );
			}
		}
	}

	/**
	 * Remove modules from plugins list.
	 *
	 * @param array $plugins
	 * @return mixed
	 * @author Francesco Licandro
	 */
	public function remove_modules( $plugins ) {

		$modules = $this->get_modules();
		$this->_installed_plugins = $plugins;

		foreach( $modules as $name => $args ) {
			$unset =  'yit-' . $name . '/' . $args['file'];
			unset( $plugins[ $unset ] );
		}

		return $plugins;
	}

	/**
	 * Add admin notice
	 *
	 * @author Francesco Licandro
	 */
	public function notice() {

		global $pagenow;

		if( $pagenow != 'plugins.php' || get_option( 'yit_framework_hide_notice' ) ) {
			return;
		}

		$find = false;
		$modules = $this->get_modules();

		foreach( $modules as $name => $args ) {
			$key =  'yit-' . $name . '/' . $args['file'];
			if( array_key_exists( $key, $this->_installed_plugins ) ){
				$find = true;
			}
		}

		if( ! $find ) {
			update_option( 'yit_framework_hide_notice', true );
			return;
		}

		ob_start();

		?>
		<div id="yit-framework-notice" class="update-nag settings-error notice is-dismissible">
			<p><?php
				$url = menu_page_url( 'yit-framework-modules', false );
				printf( __( 'Some plugins as YIT Contact Form, YIT Newsletter, etc.. have been removed from this plugins list. You can activate or deactive it from <a href="%s">YIT Framework Modules</a> panel.', 'yit' ), $url );
				?></p>
			<div class="action-link">
				<a class="dismiss-notice" href="<?php echo esc_url( add_query_arg( 'yitfm_hide_notice', 1 ) ); ?>"><?php _e( 'Dismiss this notice', 'yit' ); ?></a>
			</div>
		</div>
		<?php

		$notice = ob_get_clean();

		echo apply_filters( 'yit_framework_modules_notice', $notice );
	}

	/**
	 * Hide notice
	 *
	 * @author Francesco Licandro
	 */
	public function hide_notice() {
		if( ! isset( $_GET['yitfm_hide_notice'] ) || ! $_GET['yitfm_hide_notice'] ) {
			return;
		}

		update_option( 'yit_framework_hide_notice', true );
	}


	/**
	 * This method is hook inside "plugins_loaded", so this called, the plugin is installed as plugin on wordpress
	 *
	 * @since 1.0.0
	 */
	public function check_plugin_position() {
		$this->_from = 'plugin';
	}

	/**
	 * Load the textdomain for the YIT Framework
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'yit-framework', false, plugin_basename( __FILE__ ) . "/languages" );
	}

	/**
	 * Load the textdomain for the YIT Framework
	 */
	public function load_theme_textdomain() {
		if ( $this->_from == 'theme' ) {
			load_theme_textdomain( 'yit-framework', false, plugin_basename( __FILE__ ) . "/languages" );
		}
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 *
	 * @author     Antonino Scarfi' <antonino.scarfi@yithemes.com>
	 * @since      2.0.0
	 */
	public function plugin_url() {
		$url = 'plugin' == $this->_from ? plugins_url( '/', __FILE__ ) : get_template_directory_uri() . '/theme/plugins/yit-framework';
		return trailingslashit( $url );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 *
	 * @author     Antonino Scarfi' <antonino.scarfi@yithemes.com>
	 * @since      2.0.0
	 */
	public function plugin_path() {
		$path = 'plugin' == $this->_from ? plugin_dir_path( __FILE__ ) : get_template_directory() . '/theme/plugins/yit-framework';
		return trailingslashit( $path );
	}

	/**
	 * Retrieve the pathname to the module file
	 *
	 * @param $module string The module to find the file specified on second parameter
	 * @param $path string The relative path to a file
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function module_path( $module, $path = '' ) {
		return trailingslashit( $this->plugin_path() . 'modules/' . $module ) . $path;
	}

	/**
	 * Load the file with all modules
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_modules() {
		if ( ! empty( $this->_modules ) ) {
			return $this->_modules;
		}

		$this->_modules = include_once( $this->plugin_path() . 'modules.php' );

		foreach ( $this->_modules as $module => &$args ) {
			$main_file = ! empty( $args['file'] ) ? $args['file'] : 'init.php';
			$path = $this->module_path( $module, $main_file );

			if ( ! file_exists( $path ) ) {
				unset( $this->_modules[ $module ] );
				continue;
			}

			$args['file'] = $main_file;
		}

		return $this->_modules;
	}

	/**
	 * Load all active modules
	 */
	public function load_modules() {
		! defined( 'YIT_CORE_PLUGIN_URL' ) && define( 'YIT_CORE_PLUGIN_URL', untrailingslashit( $this->plugin_url() . '/plugin-fw' ) );

		$modules = $this->get_modules();
		$active_modules = $this->active_modules();

		foreach ( $modules as $module => $args ) {
			if ( in_array( $module, array_keys( $active_modules ) ) ) {
				include_once( $this->module_path( $module, $args['file'] ) );
			}
		}
	}

	/**
	 * Load the file with all modules
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function active_modules() {
		if ( ! empty( $this->_active_modules ) ) {
			return $this->_active_modules;
		}

		$modules = $this->get_modules();
		$active = get_option( 'yit_framework_active_modules', array() );
		foreach ( $active as $m ) {
			if ( isset( $modules[ $m ] ) ) {
				$this->_active_modules[ $m ] = $modules[ $m ];
			}
		}

		return $this->_active_modules;
	}

	/**
	 * Activate a module
	 *
	 * @param $module string The module to activate
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function activate_module( $module ) {
		$modules          = $this->get_modules();
		$active_modules   = $this->active_modules();
		$is_all_activated = ( $module == 'all' );

		if ( ( ! $is_all_activated ) && ( ! in_array( $module, array_keys( $modules ) ) || in_array( $module, array_keys( $active_modules ) ) ) ) {
			return false;
		}

		if ( $is_all_activated ) {
			$this->_active_modules = $modules;

			foreach ( $this->_active_modules as $key => $item ) {
				if ( is_plugin_active( 'yit-' . $key . '/' . $item['file'] ) ) {
					deactivate_plugins( 'yit-' . $key . '/' . $item['file'] );
				}
			}

		}
		else {

			$module_data = $modules[$module];
			if ( is_plugin_active( 'yit-' . $module . '/' . $module_data['file'] ) ) {
				deactivate_plugins( 'yit-' . $module . '/' . $module_data['file'] );
			}

			$this->_active_modules[$module] = $modules[$module];
		}

		update_option( 'yit_framework_active_modules', array_keys( $this->_active_modules ) );

		return true;
	}

	/**
	 * Deactivate a module
	 *
	 * @param $module string The module to deactivate
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function deactivate_module( $module ) {
		$modules = $this->get_modules();
		$active_modules = $this->active_modules();

		if ( $module != 'all' && ( ! in_array( $module, array_keys( $modules ) ) || ! in_array( $module, array_keys( $active_modules ) ) ) ) {
			return false;
		}

		if ( 'all' == $module ) {
			$this->_active_modules = array();
		} else {
			unset( $this->_active_modules[ $module ] );
		}

		update_option( 'yit_framework_active_modules', array_keys( $this->_active_modules ) );

		return true;
	}

	/**
	 * Add the admin page for modules management
	 *
	 * @since 1.0.0
	 */
	public function add_admin_modules_page() {
		$menu = $this->_from == 'plugin' ? 'themes.php' : 'yit_panel';
		add_submenu_page( $menu, __( 'YIT Framework Modules', 'yit-framework' ), __( 'Modules', 'yit-framework' ), 'install_plugins', 'yit-framework-modules', array( $this, 'admin_modules_page' ) );
	}

	/**
	 * Show the admin page content
	 *
	 * @since 1.0.0
	 */
	public function admin_modules_page() {
		$modules = $this->get_modules();
		$active_modules = $this->active_modules();
		?>

		<?php if ( isset( $_GET['message'] ) && $_GET['message'] == 'activated' ) : ?>
			<div id="message" class="updated notice is-dismissible"><p><?php _e( 'Module <strong>activated</strong>.', 'yit-framework' ) ?></p></div>
		<?php elseif ( isset( $_GET['message'] ) && $_GET['message'] == 'deactivated' ) : ?>
			<div id="message" class="updated notice is-dismissible"><p><?php _e( 'Module <strong>deactivated</strong>.', 'yit-framework' ); ?></p></div>
		<?php elseif ( isset( $_GET['message'] ) && $_GET['message'] == 'activated-all' ) : ?>
			<div id="message" class="updated notice is-dismissible"><p><?php _e( 'Modules <strong>activated</strong>.', 'yit-framework' ) ?></p></div>
		<?php elseif ( isset( $_GET['message'] ) && $_GET['message'] == 'deactivated-all' ) : ?>
			<div id="message" class="updated notice is-dismissible"><p><?php _e( 'Modules <strong>deactivated</strong>.', 'yit-framework' ); ?></p></div>
		<?php endif; ?>

		<div class="wrap">
			<h2><?php _e( 'YIT Framework Modules', 'yit-framework' ) ?></h2>
			<p><?php _e( "Here you can activate or deactive some module of the theme as portfolio, sliders, etc.. If you don't use any feature of theme, you can deactive below.", 'yit-framework' ) ?></p>

			<div class="tablenav top">
				<div class="alignleft actions">
					<p>
						<a href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'activate', 'module' => 'all' ) ), 'activate-yit-plugin' ) ?>"><?php _e( 'Activate all', 'yit-framework' ) ?></a> |
						<a href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'deactivate', 'module' => 'all' ) ), 'deactivate-yit-plugin' ) ?>"><?php _e( 'Deactivate all', 'yit-framework' ) ?></a>
					</p>
				</div>
			</div>

			<div class="wp-list-table widefat plugin-install-network">
				<div id="the-list">

					<?php foreach ( $modules as $module => $args ) : $is_active = in_array( $module, array_keys( $active_modules ) ); ?>
						<div class="plugin-card plugin-card-<?php echo $module ?>">
							<div class="plugin-card-top">
								<a class="thickbox plugin-icon">
									<img src="<?php echo ! empty( $args['image'] ) ? $args['image'] : $this->plugin_url() . 'assets/images/placeholder_plugin.png' ?>" />
								</a>

								<div class="name column-name">
									<h4><?php echo $args['name'] ?></h4>
								</div>

								<div class="action-links">
									<ul class="plugin-action-buttons">
										<?php if ( $is_active ) : ?>
											<li>
												<a class="deactivate-now button" data-slug="<?php echo $module ?>" href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'deactivate', 'module' => $module ) ), 'deactivate-yit-plugin' ) ?>" aria-label="<?php printf( __( 'Deactivate %s now', 'yit-framework' ), $args['name'] ) ?>" data-name="<?php echo $args['name'] ?>">
													<?php _e( 'Deactivate', 'yit-framework' ) ?>
												</a>
											</li>
										<?php else : ?>
											<li>
												<a class="activate-now button" data-slug="<?php echo $module ?>" href="<?php echo wp_nonce_url( add_query_arg( array( 'action' => 'activate', 'module' => $module ) ), 'activate-yit-plugin' ) ?>" aria-label="<?php printf( __( 'Activate %s now', 'yit-framework' ), $args['name'] ) ?>" data-name="<?php echo $args['name'] ?>">
													<?php _e( 'Activate', 'yit-framework' ) ?>
												</a>
											</li>
										<?php endif; ?>
									</ul>
								</div>

								<div class="desc column-description">
									<p><?php echo $args['desc'] ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>

		<script>
			jQuery(document).ready(function($){

				$('ul.plugin-action-buttons').on( 'click', 'a.button', function(e){
					$(this).prepend('<span class="update-message updating-message"></span>');
				});

			});
		</script>

		<style type="text/css">
			.plugin-card .updating-message:before {
				display: inline-block;
				margin-top: 3px;
				font: 400 20px/1 dashicons;
				color: #d54e21;
			}
		</style>

		<?php
	}

	/**
	 * Trigger action of module activate
	 *
	 * @since 1.0.0
	 */
	public function activate_module_action() {
		if ( empty( $_GET['page'] ) || $_GET['page'] != 'yit-framework-modules' || ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'activate-yit-plugin' ) ) {
			return;
		}

		$modules = $this->get_modules();
		$activated_modules = $this->active_modules();
		$module = $_GET['module'];

		// exit if is not a valid module
		if ( empty( $_GET['module'] ) || 'all' != $module && ! in_array( $module, array_keys( $modules ) ) ) {
			wp_die( __( 'The module is not valid.', 'yit-framework' ) . sprintf( ' <a href="%s">%s</a>', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ), __( 'Back to modules', 'yit-framework' ) ) );
		}

		// exit if is a module already activated
		if ( 'all' != $module && in_array( $module, array_keys( $activated_modules ) ) ) {
			wp_die( __( 'The module is already activated.', 'yit-framework' ) . sprintf( ' <a href="%s">%s</a>', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ), __( 'Back to modules', 'yit-framework' ) ) );
		}

		if ( ! $this->activate_module( $module ) ) {
			wp_die( __( "Activation of the module is not possible.", 'yit-framework' ) . sprintf( ' <a href="%s">%s</a>', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ), __( 'Back to modules', 'yit-framework' ) ) );
		}

		wp_redirect( add_query_arg( 'message', 'all' == $module ? 'activated-all' : 'activated', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ) ) );
		exit();
	}

	/**
	 * Trigger action of module activate
	 *
	 * @since 1.0.0
	 */
	public function deactivate_module_action() {
		if ( empty( $_GET['page'] ) || $_GET['page'] != 'yit-framework-modules' || ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'deactivate-yit-plugin' ) ) {
			return;
		}

		$modules = $this->get_modules();
		$activated_modules = $this->active_modules();
		$module = $_GET['module'];

		// exit if is not a valid module
		if ( empty( $_GET['module'] ) || 'all' != $module && ! in_array( $module, array_keys( $modules ) ) ) {
			wp_die( __( 'The module is not valid.', 'yit-framework' ) . sprintf( ' <a href="%s">%s</a>', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ), __( 'Back to modules', 'yit-framework' ) ) );
		}

		// exit if is a module already activated
		if ( 'all' != $module && ! in_array( $module, array_keys( $activated_modules ) ) ) {
			wp_die( __( 'The module is already deactivated.', 'yit-framework' ) . sprintf( ' <a href="%s">%s</a>', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ), __( 'Back to modules', 'yit-framework' ) ) );
		}

		if ( ! $this->deactivate_module( $module ) ) {
			wp_die( __( "Activation of the module is not possible.", 'yit-framework' ) . sprintf( ' <a href="%s">%s</a>', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ), __( 'Back to modules', 'yit-framework' ) ) );
		}

		wp_redirect( add_query_arg( 'message', 'all' == $module ? 'deactivated-all' : 'deactivated', remove_query_arg( array( 'action', 'module', '_wpnonce' ) ) ) );
		exit();
	}

	/**
	 * Check the status of singular plugin activated already in the website
	 *
	 * @since 1.0.0
	 */
	public function deactivate_singular_plugins() {
		if ( get_option( 'yit_framework_deactivated_plugin' ) ) {
			return;
		}

		$modules = $this->get_modules();
		$to_active = array();

		// active only modules of plugin activated
		foreach ( $modules as $module => $args ) {
			if ( is_plugin_active( 'yit-' . $module . '/' . $args['file'] ) ) {
				$to_active[] = $module;
				deactivate_plugins( 'yit-' . $module . '/' . $args['file'] );
				$this->activate_module( $module );

				// if sidebar, active also google analytics module for back compatibility
				if ( 'sidebar' == $module ) {
					$this->activate_module( 'google-analytics' );
				}
			}
		}

		// if nothing found installed, active all modules
		if ( empty( $to_active ) ) {
			foreach ( $modules as $module => $args ) {
				$this->activate_module( $module );
			}
		}

		update_option( 'yit_framework_deactivated_plugin', true );

		wp_safe_redirect( wp_unslash( $_SERVER['REQUEST_URI'] ) );
		exit();
	}

	/**
	 * Reset YIT_Framework option
	 *
	 * @since 1.0.0
	 * @author Francesco Licandro
	 */
	public function reset_yit_framework_options() {
		delete_option( 'yit_framework_deactivated_plugin' );
		delete_option( 'yit_framework_active_modules' );
		delete_option( 'yit_framework_hide_notice' );
	}

	/**
	 * Activate automatically google analytics module when sidebar module is active
	 */
	public function activate_new_google_analytics() {
		if ( get_option( 'yit_framework_activate_google_analytics_on_update' ) ) {
			return;
		}

		if ( in_array( 'sidebar', array_keys( $this->active_modules() ) ) ) {
			$this->activate_module( 'google-analytics' );
		}

		update_option( 'yit_framework_activate_google_analytics_on_update', true );
	}

}

function YIT_Framework() {
	return YIT_Framework::get_instance();
}

YIT_Framework();