<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Framework_Admin' ) ) {
	/**
	 * Admin Theme Class
	 *
	 * @class Wolf_Framework_Admin
	 * @since 1.4.2
	 * @package WolfFramework
	 * @author WolfThemes
	 */
	class Wolf_Framework_Admin {

		/**
		 * Wolf_Framework_Admin Constructor.
		 */
		public function __construct() {

			if ( ! WOLF_DEBUG && WOLF_ENABLE_OPTIONS_EXPORTER ) {
				/**
				 * We need to handle the redirection from the theme options panel here to avoid "header already sent" error
				 */

				// Download options zip file
				if ( isset( $_POST['wolf-options-export-file-submit'] ) ) {

					wp_redirect( WOLF_THEME_URI . '/includes/admin/export/options-export.zip' );

				// Refresh theme options after save
				} elseif ( isset( $_GET['page'] ) && 'wolf-theme-options' == $_GET['page'] && isset( $_POST['action'] ) && $_POST['action'] == 'save' && ! isset( $_POST['wolf-options-import-file-submit'] ) ) {

					wp_redirect( admin_url( 'admin.php?page=wolf-theme-options&message=save' ) );
				}
			}

			// Refresh CSS box after save
			if ( isset( $_POST['wolf-theme-css-save'] ) ) {
				wp_redirect( admin_url( 'admin.php?page=wolf-theme-css&message=save' ) );
			}

			// Auto-load admin classes on demand
			if ( function_exists( '__autoload' ) ) {
				spl_autoload_register( '__autoload' );
			}

			spl_autoload_register( array( $this, 'autoload' ) );

			add_action( 'init', array( $this, 'init' ) );
			add_action( 'admin_menu', array( $this, 'menu' ), 8 );
			add_action( 'admin_notices', array( $this, 'display_notice' ) );
		}

		/**
		 * Update the theme from uploaded zip file
		 */
		public function zip_theme_update() {
			require_once( WOLF_FRAMEWORK_DIR . '/classes/class-update-zip.php' );
			if ( class_exists( 'Wolf_Update_Zip' ) ) {
				$wolf_do_theme_update_zip = new Wolf_Update_Zip;
				$wolf_do_theme_update_zip->do_update_zip();
			}
		}

		/**
		 * Auto-load classes on demand to reduce memory consumption.
		 *
		 * @param string $class
		 */
		public function autoload( $class ) {
			$path  = null;
			$class = strtolower( $class );
			$file  = 'class-' . str_replace( '_', '-', $class ) . '.php';

			if ( strpos( $class, 'wolf_theme_admin_' ) !== false ) {
				$file = str_replace( 'wolf-theme-admin-', '', $file );
				$path = WOLF_FRAMEWORK_DIR . '/classes/';
			}

			if ( $path && is_readable( $path . $file ) ) {
				include_once( $path . $file );
				return;
			}
		}

		/**
		 * Includes admin functions, scripts and files from the theme includes/admin folder
		 */
		public function includes() {

			// Core admin functions
			require_once( WOLF_FRAMEWORK_DIR . '/includes/admin/admin-functions.php' );
			require_once( WOLF_FRAMEWORK_DIR . '/includes/admin/admin-scripts.php' );

			$inc_dir    = WOLF_THEME_DIR . '/includes/admin';
			
			if ( is_dir( $inc_dir ) ) {
				foreach ( glob( $inc_dir . '/*.php' ) as $filename ) {
					include_once( $filename );
				}
			}
		}

		/**
	  	 * Includes admin files
		 */
		public function init() {

			// include function files
			$this->includes();

			if ( ! WOLF_DEBUG ) {
				// zip upload theme update
				$this->zip_theme_update();
			}

			// set default options
			$this->default_options();
		}

		/**
		 * Add the Theme menu to the WP admin menu
		 */
		public function menu() {

			$current_theme_name = wp_get_theme()->Name;
			$svg_data = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhbHF1ZV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjEyODBweCIgaGVpZ2h0PSIxMjgwcHgiIHZpZXdCb3g9IjAgMCAxMjgwIDEyODAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyODAgMTI4MCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCjwvZz4NCjxnPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMjMxRjIwIiBkPSJNNTkzLjc2OSw0ODcuMjczYzMxLjI1Mi0xOS4xNSw5Ny4wOS0xMTUuNDY4LDExMC41NjctMTI5LjUwMg0KCQljNy41ODYtNi42MDYsMTQuMzU5LTUuOTE5LDIxLjE5OC0xLjI5NWMxMi45MjcsMTEuMDM2LDMyLjU0Nyw1MC44MjcsMzQuMDI4LDY5LjM4OGMxLjU2NiwxMC4yOS01LjI5Myw1Mi4yMTYtMC43MTgsNjYuODk2DQoJCWwzNi4xNjUtMTIuNTYzYy0xLjE2Ni0yLjIzNS02LjkyLTkuODE5LTEwLjgwMS0xNC4yMTFjLTAuNTMtMC41NDgtMS0xLjA5OC0xLjQ4MS0xLjYyNmMtMC42NDYtMC44NDItMS40MjktMS4yMTUtMC4yMjQtMS45MjINCgkJYzEuODAzLTEuMDM5LDUuOTc5LTAuOTAyLDEwLjU1NiwxLjIxNmwyMS4wOSw5LjI3MWMzLjg0MS0yLjA5OCw1LjM3LTIuMTk1LDkuMjEyLTQuMjkzYzYuODgxLTIuMjU1LDExLjQwNiwwLjc2NCwxNC40MjYsNi4yNzINCgkJbDkuMTcyLDMxLjI2NGMyLjE5OCw2Ljk1OSwxLjY0NiwxMy4wOTItMS43NjMsMTguNDgybC00OC4yMzYsNjAuMzEzYy0yLjM2NCwzLjEzNi0xNS4xMDMsMjEuMTEtMTcuNDk0LDI0LjMwNA0KCQljLTUuMjMyLDkuNTY3LTUuNTk3LDM0LjA0NiwxLjgxMyw1OS41NjZjMS4xODcsNC42NjYsMi4zMTIsOS4zMzEsMy40OTgsMTMuOTU3bC0xMy45NzUtMTMuMjMyDQoJCWMwLjMxMiwxNC40MDksMTAuOTI3LDQ2LjY1MSwxNy44NzcsNjQuNzQzYy03Ljk3Mi0yLjg0NC0xMy4zOS03LjkwMS0yMy42NDItMjQuOTkxYy0xLjU3NywxMS40MDgsMzAuMDc4LDc0LjIwNyw0Ny42MjEsNzcuMzgyDQoJCWMtMi43MDMsOC4yNzMtMzEuNDMsMy42MDktMzkuMjExLTMuOTM5bDQuNTQ4LDI1Ljc1NWM0LjMxMiw3LjExNSwxNS44NDgsMy4zOTMsMjIuMzk0LDIuNTkxDQoJCWMtMi40MjEsNi41MDUtMTIuNDk1LDE5LjQyMy0yNC45MDEsMzMuMTYyYzEwLjkyNSw1NC41NSwwLjA2OCwxMDkuODIyLTcuMDQ3LDE2NC42MjZsLTM3LjkwOSwyNTcuNjEyaC0zMi40MjkNCgkJYzQuMzk5LTM1LjQ3NSw2Ljc5MS02Ni41MjMsNy40MjgtOTMuNTczYzIuMzkxLTk5LjAyMS0xOC41NjItMTQzLjkyNy00OS4xNTgtMTU1LjMxNQ0KCQljLTgyLjcyNS0xOS43OTgtMTkzLjQwMS01MC4yMTktMjQ0LjQ1LTExMS4wMDFjMTA0LjQyMyw0MC43MywxODEuOTIzLTM1LjgyOCwyMDkuMzU0LTkwLjUzMw0KCQljMy44NTItNy42NjMsNDguMDUtMTMuMDM2LDQ5LjQ2MS0xOS44NzdjLTMyLjkwOCwxLjI1NS03OS4zMjQtMTEuMjQ5LTg0LjA3Ny0yMi4zNjNjMTQuMDk0LDQuMTkzLDg1LjA1OCwxMS43MDEsMTI0LjA3My0xLjENCgkJYy0yMi40NjItNi42NjItNDkuMzA2LTEzLjg5Ni01OC4zNzEtMzYuNTE0Yy02LjkwOS0xNy4xOSwxLjEtMjkuMTQ2LTQuMDU3LTM4LjE4MWMtMTguMzk2LTEzLjgxOS0zOS41OTQtMTcuMjMtNzIuMTQyLTMuNTg5DQoJCWMyMS4yODgtMjguMTI2LDEuNDExLTI5Ljc3Mi0yNi44MzEtNTkuODAzYzk2LjYzLDM5LjIyMiwxODguMjk0LTEwMi4yMzQsMjUwLjA0NS0xMjMuNTgyDQoJCWMtMjAuOTUzLTIuOTItNDguNzI4LDE0LjExNC03MS40NDUsMjEuMjQ4Yy0zLjYxNS0yLjU4Ny04LjM1MS05Ljk5Ny03LjQ5Ni0xMS45MThjMi44OTktMzMuMTA2LDE0LjkxNi01OS4yMTMsMTguMzA4LTg2Ljk0OA0KCQljMC42NzYtNS4zMzItMi4yMTctMjIuODczLTQuNTU5LTI2LjEwOWMtMTAuNDA4LDExLjUyNi0zMy45MzksOC4zODktMzMuOTM5LTEyLjM4N2MwLTIuMTE2LDkuODExLDkuMjkyLDE0Ljk0Niw0LjkNCgkJYzguMzQxLTcuMTcyLDIuMzE0LTE2LjkxNSwxLjE2Ni0yNC44MTNjLTEuOTcxLTYuNTQ4LTcuMDQ3LTMuNTQ4LTEwLjY3MSwwLjIxM2MtMTQuMDkzLDE0Ljc2LTI1LjY4NywzNC40Mi00OS42MjksNjUuNjA0DQoJCWMzLjgwMiwwLjgwNCw3LjYzMywzLjIxNSwxMC45OTMsOC43ODJjLTEyLjY4OSw1LjM1MS00OS4wNzksNDIuMzk3LTY0LjgxNyw1OC40MTFMNTkzLjc2OSw0ODcuMjczeiIvPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMjMxRjIwIiBkPSJNNTkzLjc2OSw0ODcuMjczYy0yNi41NzgsMTIuMDM2LTU2LjI1NSwxOS4wMzMtNzMuOTM2LDE1LjAzNA0KCQljMS44MDYsNC44MDEsNC40NDksOS4yOTIsOC45MTksMTMuMDczYy0yNi43NjUsNDMuNTU1LTM5LjUyNSw4Ny4xNDUtNzMuNTMyLDExNi44MDJjLTI5Ljc3MywyOS4yNjMtMTAyLjgwNSw0OS45MDItMTAwLjU0MSw1NC40NjkNCgkJYzIuNTE4LDE4LjY1OSw0NC41OSw0NS43MDcsODAuNjY3LDUwLjYwOWM0Ni44NTYsNC42MjMsOTkuMjI5LTcuOTk4LDExNy4wMjgtNTAuNDMzYzEuNDk5LTIwLjQwNS0xNC42MzMtMTQuMzA4LTQzLjg3Ny0xMC41NDcNCgkJYy02LjkxOSw3LjA1OCwyNy43MTYsNC40MTEsMjMuNSwxNC4xNzNjLTQuNjgzLDE3LjM4Ni03NC44MjUsNDcuNjY5LTExOS42NzMsMjUuNzE1Yy04LjIwMi0xMC4xMzIsMjUuOTMzLDcuNTg4LDM1LjgxLTguNDY3DQoJCWMxLjMzNS0yLjE1NS0yMi4yODMtNy4zMy0yMy43MzYtMTYuMjFjOC4yMTQsNS4yMTMsMzkuNTkzLDYuNjQ1LDQxLjQ5NSw2LjExNWM3LjE1Ni0yLjExNCwzMi44NjMtMi41NjcsMjguMDctMjcuMTQ2DQoJCWMtMi4xMzctMTEuMzUtMTQuMjUxLTEyLjI1LTMzLjE4NC01Ljk1OWMtMy4xNTctNi40NjgsMjEuMjg3LTIyLjM0NCwzOS41NzQtMjguODUzYzIuNTI4LTAuOTc5LDkuODM3LTQuNjY0LDEzLjUyMi01LjQ4Ng0KCQljMjQuNDQ0LTE0LjMxLDQxLjIwMy02MC44NjMsNDEuNDA3LTcyLjA5MWMtMTAuMDk0LDIxLjk1My0yOC4zMzMsMzMuMjAzLTQ3LjEsMzEuMjhsMzQuNjA1LTY3LjE3bDI0LjM4My0xLjc4NA0KCQljNy4wNjcsMTAuMDk0LDQuMjgzLDI0LjM0NiwwLjUyLDQwLjM3N2MxLjk1MSwwLjA0MSwyLjgwMy0wLjg2Myw1LjAyNy0xLjAzOGMxMC4wNDUtMTYuNzc3LDE4Ljg1NS0yMy42OTksMjQuOTEyLTMxLjE0Ng0KCQljMy42MzctNC41MjcsMC43MTctOS45OTUsNy41ODYtMzAuNzc0bC0wLjMzMi05LjA5M0w1OTMuNzY5LDQ4Ny4yNzNMNTkzLjc2OSw0ODcuMjczeiIvPg0KCTxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjMjMxRjIwIiBkPSJNNDIzLjY4Myw3NDQuMzk0YzQyLjY0Miw4LjUyNiw3Ni4zNTQsNi4zMTMsMTI2LjEwMS0xOS4zNDQNCgkJYy0xNS41MjIsMzMuOTI4LTQ0LjA5OSw2MC40MjktODIuNzcyLDcwLjUyMWMtNi4wMjgsMTkuNTg0LTE0LjMxLDI5LjU0LTE3LjYwMiwzOS40NzZjNy43NjMsMTUuNTI2LDQwLjMyOSwxOS42NTksOTQuMDI1LDUuMDc3DQoJCWMtMTQuMzY3LDIxLjY3OC03Ny4xMDksNzQuNjItMTYyLjAyLDQ3LjU1M2MtMy43ODEsMjMuMjA3LDIuNDAxLDQ4LjEzOCwxNS4zNjksNzQuMjQ3YzM5LjMyOCw3MS4xNTEsODYuNzAxLDc5LjY0LDEzNS43NzMsOTkuMjc2DQoJCWM2LjQxOSwyLjY2NiwyMy4yODYsNi4zNzQsNDAuMzc4LDIuNTdjLTEwMy4zODUsNjIuODM5LTIwMS4xMTQsMTkuMTUtMjQzLjA5LDE4LjI2OGMtMC4zOC05Ljk3Ny0wLjc2NS0xOS45NzUtMS4xMzctMjkuOTkxDQoJCWMtMjIuMTQsMzMuNjE1LTQ1LjM3NCw1Mi40NTQtODUuMjYxLDgwLjMwNmMtNi4yMzUsNC4zNzMsMTExLjE4NCwyMC4yMDcsMTgzLjY2Nyw4MS4wNjkNCgkJYy0xMTUuMjMzLTYuNzI0LTI4Ni45NjQtMTAuMjE1LTM4Ni45MTgsNTEuNjg1YzIxLjI0OC00MS4zOTUsNjkuOTY1LTc5LjU3Nyw3Ni40MDQtODUuMDA4bDAsMA0KCQljLTEuNzI0LTYuMjUyLTMuNS0xMi41NjQtNS4yNTMtMTguODM0YzExLjI5LDIuOTk5LDI0LjAwMywwLjkzOCwzOC43NjEtOC4zODljLTIwLjU5MS0wLjIzNi0yNi44NTQtMTUuNDQ3LTM0LjE4NC0yOC4xODcNCgkJYzIwLjA4MSw3LjkzNiw1OC41NjcsNi40MjcsNzQuNDU1LTEuMDM4Yy0xNy42NTItMC45ODEtMzEuNjk1LTcuMzUxLTM3LjQ4Ny0xMi43ODFjMjIuNzI3LTIuNjg0LDc5LjEzOC0yMC42NzksMTA4LjE1Ni02My41NjQNCgkJYzAsMCw1Ni44OTItNzkuMjI3LDcyLjk5Mi0xMjkuMjA4YzAuNjM5LTEuODAzLTIxLjU5OSw1LjIxNC0zOC45MzUsMC4xMzhjNDEuNDU1LTE4LjM0OSw4Ni45NDgtNzYuMDkzLDk0LjQzNi05NC4yDQoJCUM0MDQuMDA0LDc5Ni41MTQsNDE0LjI1Niw3NjguODM4LDQyMy42ODMsNzQ0LjM5NHoiLz4NCgk8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzIzMUYyMCIgZD0iTTY0Mi4xMzMsMTQuNjYxYy0zNDguOTgxLDAtNjMxLjgzOCwyODIuOTM3LTYzMS44MzgsNjMxLjg0OQ0KCQljMCwxNTcuMTM4LDU3LjM4MiwzMDAuODcyLDE1Mi4yODksNDExLjQyYzAsMCw0Ljk3OCw1LjYwNCwxMi42OSwxMy4zMjdjNjguMTczLTMwLjIyNCw3My45ODUtOTEuOTY4LDczLjk4NS05MS45NjhsLTE0LjY3Mi0yMS42OA0KCQloMC4wNGMtNDcuNDYzLTc0LjcxOC03NC45ODMtMTYzLjMzMi03NC45ODMtMjU4LjM5NGMwLTI2Ni40OTIsMjE2LjAwOS00ODIuNDUzLDQ4Mi40OTEtNDgyLjQ1Mw0KCQljMjY2LjQ1MywwLDQ4Mi40OSwyMTUuOTYsNDgyLjQ5LDQ4Mi40NTNjMCwyMTguMzktMTQ1LjEyMiw0MDIuODEzLTM0NC4xMDgsNDYyLjM0bC05LjEzNCwxMDMuNTUNCgkJQzEwNTguMzM1LDEyMDUuNDQyLDEyNzQsOTUxLjIwMywxMjc0LDY0Ni41MUMxMjc0LDI5Ny41OTcsOTkxLjEwNCwxNC42NjEsNjQyLjEzMywxNC42NjF6Ii8+DQo8L2c+DQo8L3N2Zz4NCg==';
			add_menu_page( $current_theme_name, $current_theme_name, 'manage_options', 'wolf-theme-options', array( $this, 'options' ), $svg_data );
			add_submenu_page( 'wolf-theme-options', __( 'Options', 'wolf' ), __( 'Options', 'wolf' ), 'manage_options', 'wolf-theme-options', array( $this, 'options' ) );
			add_submenu_page( 'wolf-theme-options', __( 'Custom CSS', 'wolf' ), __( 'Custom CSS', 'wolf' ), 'manage_options', 'wolf-theme-css', array( $this, 'css' ) );

			/* If update notice is enabled, we add a theme update page */
			if ( WOLF_UPDATE_NOTICE ) {

				$menu_title = __( 'Updates', 'wolf' );
				if ( $xml = wolf_get_theme_changelog() ) {
					if ( version_compare( WOLF_THEME_VERSION, $xml->latest ) == -1 ) {
						$menu_title = __( 'Updates', 'wolf' ) . '<span class="update-plugins count-1 wolf-custom-count"><span class="update-count">1</span></span>';
					}
				}

				add_submenu_page( 'wolf-theme-options', __( 'Updates', 'wolf' ), $menu_title, 'manage_options', 'wolf-theme-update', array( $this, 'update_page' ) );
			}

				// Support forum link/page
			if ( WOLF_SUPPORT_PAGE ) {

				add_submenu_page( 'wolf-theme-options', __( 'Helpdesk', 'wolf' ), __( 'Helpdesk', 'wolf' ), 'manage_options', 'wolf-theme-support', array( $this, 'support_page' ) );
			}

			add_submenu_page(
				'options.php',
				//'wolf-theme-options',
				'presets',
				'presets',
				'manage_options',
				'wolf-customizer-presets',
				array( $this, 'customizer_preset_page' )
			);
		}

		/**
		 * This page is not visible. It is used to execute customizer preset functions as no js fallback
		 * @todo remove
		 */
		public function customizer_preset_page() {

			require( WOLF_FRAMEWORK_DIR . '/includes/customizer-presets.php' );
		}

		/**
		 * Add an update or error notice to the dashboard when needed
		 */
		public function display_notice() {

			global $pagenow;

			// Theme update notifications
			if ( $pagenow == 'index.php' ) {
				wolf_theme_update_notification_message();
			}

			if ( WOLF_ERROR_NOTICES ) {

				/* Error notices
			    	--------------------------------------------------------*/

				// No cURL
				$no_cURL = __( 'The <strong>cURL</strong> extension is not installed on your server. This extension is required to display theme update notifications.', 'wolf' );

				if ( ! function_exists( 'curl_init' ) ) {
					wolf_admin_notice( $no_cURL, 'error', true, 'no_cURL' );
				}

				// No GD library
				$no_GD_library = __( 'The <strong>GD library</strong> extension is not installed on your server. This extension is essential to Wordpress to be able to resize your images. Please contact your hosting service for more informations.', 'wolf' );

				if ( ! extension_loaded( 'gd' ) && ! function_exists( 'gd_info' ) ) {
					wolf_admin_notice( $no_GD_library, 'error', true, 'no_GD_library' );
				}
			}

			/* Always display wrong theme installation notice
		    	-------------------------------------------------------------------*/

			/* Incorect Installation */
			$wrong_install = sprintf(
				__( 'It seems that <strong>the theme has been installed incorrectly</strong>. Go <a href="%s" target="_blank">here</a> to find instructions about theme installation.', 'wolf' ), 'http://wolfthemes.com/common-wordpress-theme-issues/'
				);

			$wolf_wp_themes_folder = basename( dirname( dirname( dirname( __FILE__ ) ) ) );

			if ( $wolf_wp_themes_folder != 'themes' ) {
				wolf_admin_notice( $wrong_install , 'error' );
			}

			return false;
		}

		/**
		 * Update Page
		 */
		public function update_page() {
			require( WOLF_FRAMEWORK_DIR . '/pages/update.php' );
		}

		/**
		 * Support Page  :
		 * Redirect to the support forum
		 * http://help.wolfthemes.com/
		 */
		public function support_page() {
			require( WOLF_FRAMEWORK_DIR . '/pages/support.php' );
		}

		/**
		 * Theme Options
		 * Generate Theme Options page with the Wolf_Theme_Options class
		 * The theme options are set in includes/options.php as an array
		 */
		public function options() {
			if ( class_exists( 'Wolf_Theme_Admin_Options' ) ) {
				global $wolf_theme_options;
				$wolf_do_theme_options = new Wolf_Theme_Admin_Options( $wolf_theme_options );
			}
		}

		/**
		 * CSS
		 */
		public function css() {
			require( WOLF_FRAMEWORK_DIR . '/pages/css.php' );
		}

		/**
		 * Update Page
		 */
		public function importer() {
			require( WOLF_FRAMEWORK_DIR . '/pages/importer.php' );
		}

		/**
		 * Theme Default Options
		 */
		public function default_options() {

			if ( is_file( WOLF_THEME_DIR . '/config/default-options.php' ) ) {
				include_once( WOLF_THEME_DIR . '/config/default-options.php' );
			}

			// Default theme options are defined in "includes/default-options.php"
			if ( function_exists( 'wolf_theme_default_options_init' ) && ! get_option( 'wolf_theme_options_' . wolf_get_theme_slug() ) )
				wolf_theme_default_options_init();

			// Default customizer options are defined in "includes/default-customizer-options.php"
			if ( function_exists( 'wolf_theme_customizer_options_init' ) )
				wolf_theme_customizer_options_init();
		}

	} // end class

} // end class exists check
