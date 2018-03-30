<?php
	/**
	 * ReduxFramework Sample Config File
	 * For full documentation, please visit: http://docs.reduxframework.com/
	 */

	if ( ! class_exists( 'Redux_Framework_berg_config' ) ) {

		class Redux_Framework_berg_config {

			public $args = array();
			public $sections = array();
			public $theme;
			public $ReduxFramework;


			public function __construct() {

				if ( ! class_exists( 'ReduxFramework' ) ) {
					return;
				}

				if (true == Redux_Helpers::isTheme(__FILE__)) {
					$this->initSettings();
				} else {
					add_action('plugins_loaded', array($this, 'initSettings'), 10);
				}

			}

			public function initSettings() {
				$this->theme = wp_get_theme();
				$this->setArguments();
				$this->setSections();

				if (!isset($this->args['opt_name'])) {
					return;
				}

				$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

			}

            function compiler_action( $options, $css, $changed_values ) {
              $filename = THEME_DIR. '/redux' . '.css';
              // print_r($filename);
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }
              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             
            }



			public function setHelpTabs() {
                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.', 'redux-framework-demo' )
                );
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.', 'redux-framework-demo' )
                );
                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.', 'redux-framework-demo' );
            }

			public function setSections() {

				$sidebarsArray = berg_get_sidebars_array();
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/general.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/appearance.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/customcss.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/customcolors.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/mobilehomepage.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/navigation.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/introsection.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/home.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/home_2.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/blog.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/posts.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/portfolio.php');																
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/foodmenu.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/team.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/contact.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/archive.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/footer.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/social.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/woocommerce.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/demoimport.php');
				$this->sections[] = include(THEME_INCLUDES.'/redux/global/themeupdate.php');
			}

			/**
			 * All the possible arguments for Redux.
			 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
			 * */
			public function setArguments() {

				$theme = wp_get_theme(); // For use with some settings. Not necessary.

				$this->args = array(
					// TYPICAL -> Change these values as you need/desire
					'opt_name'             => 'redux',
					'ajax_save'			   => true,
					// This is where your data is stored in the database and also becomes your global variable name.
					'display_name'         => __( 'Theme Settings', 'BERG' ),
					// Name that appears at the top of your panel
					'display_version'      => '',
					// Version that appears at the top of your panel
					'menu_type'            => 'menu',
					//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
					'allow_sub_menu'       => true,
					// Show the sections below the admin menu item or not
					'menu_title'           => __( 'Theme Settings', 'BERG' ),
					'page_title'           => __( 'Theme Settings', 'BERG' ),
					// You will need to generate a Google API key to use this feature.
					// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
					'google_api_key'       => '',
					// Set it you want google fonts to update weekly. A google_api_key value is required.
					'google_update_weekly' => false,
					// Must be defined to add google fonts to the typography module
					'async_typography'     => true,
					// Use a asynchronous font on the front end or font string
					//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
					'admin_bar'            => true,
					// Show the panel pages on the admin bar
					'admin_bar_icon'     => 'dashicons-screenoptions',
					// Choose an icon for the admin bar menu
					'admin_bar_priority' => 50,
					// Choose an priority for the admin bar menu
					'global_variable'      => '',
					// Set a different name for your global variable other than the opt_name
					'dev_mode'             => false,
					// Show the time the page took to load, etc
					'update_notice'        => false,
					// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
					'customizer'           => true,
					// Enable basic customizer support
					//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
					'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

					// OPTIONAL -> Give you extra features
					'page_priority'        => null,
					// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
					'page_parent'          => 'themes.php',
					// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
					'page_permissions'     => 'manage_options',
					// Permissions needed to access the options panel.
					'menu_icon'            => 'dashicons-screenoptions',
					// Specify a custom URL to an icon
					'last_tab'             => '',
					// Force your panel to always open to a specific tab (by id)
					'page_icon'            => 'icon-themes',
					// Icon displayed in the admin panel next to your menu_title
					'page_slug'            => '_options',
					// Page slug used to denote the panel
					'save_defaults'        => true,
					// On load save the defaults to DB before user clicks save or not
					'default_show'         => false,
					// If true, shows the default value next to each field that is not the default value.
					'default_mark'         => '',
					// What to print by the field's title if the value shown is default. Suggested: *
					'show_import_export'   => true,
					// Shows the Import/Export panel when not used as a field.

					// CAREFUL -> These options are for advanced use only
					'transient_time'       => 60 * MINUTE_IN_SECONDS,
					'output'               => true,
					// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
					'output_tag'           => true,
					// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
					// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

					// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
					'database'             => '',
					// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
					'system_info'          => false,
					// REMOVE

					'network_sites' => true,
					'network_admin' => true,
					// HINTS
					'hints'                => array(
						'icon'          => 'icon-question-sign',
						'icon_position' => 'right',
						'icon_color'    => 'lightgray',
						'icon_size'     => 'normal',
						'tip_style'     => array(
							'color'   => 'light',
							'shadow'  => true,
							'rounded' => false,
							'style'   => '',
						),
						'tip_position'  => array(
							'my' => 'top right',
							'at' => 'bottom left',
						),
						'tip_effect'    => array(
							'show' => array(
								'effect'   => 'fade',
								'duration' => '200',
								'event'    => 'mouseover',
							),
							'hide' => array(
								'effect'   => 'fade',
								'duration' => '200',
								'event'    => 'click mouseleave',
							),
						),
					)
				);

				if (function_exists('icl_object_id')  && !function_exists('pll_is_translated_post_type')) {
					global $sitepress;
					$defaultLang = $sitepress->get_default_language();

					$optionName = 'redux';

					if (ICL_LANGUAGE_CODE != $defaultLang) {
						$optionName = 'redux_'.ICL_LANGUAGE_CODE;
					}

					$this->args['opt_name'] = $optionName;
				}

				// Panel Intro text -> before the form
				if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
					if ( ! empty( $this->args['global_variable'] ) ) {
						$v = $this->args['global_variable'];
					} else {
						$v = str_replace( '-', '_', $this->args['opt_name'] );
					}
					//$this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong>', 'redux-framework-demo' ), $v );
				} else {
					//$this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'redux-framework-demo' );
				}

				// Add content after the form.
				//$this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'redux-framework-demo' );
			}
		}

		global $reduxConfig;
		$reduxConfig = new Redux_Framework_berg_config();
	} else {
		echo "The class named Redux_Framework_berg_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
	}
