<?php
if ( ! class_exists( 'NHP_Options' ) ) {

	// windows-proof constants: replace backward by forward slashes - thanks to: https://github.com/peterbouwmeester
	$fslashed_dir = trailingslashit( str_replace( '\\', '/', CT_THEME_LIB_DIR.'/options/' ) );
	$fslashed_abs = trailingslashit( str_replace( '\\', '/', ABSPATH ) );

	if ( ! defined( 'NHP_OPTIONS_DIR' ) ) {
		define( 'NHP_OPTIONS_DIR', $fslashed_dir );
	}

	if ( ! defined( 'NHP_OPTIONS_URL' ) ) {
		define( 'NHP_OPTIONS_URL', site_url( $fslashed_abs != '/' ? str_replace( $fslashed_abs, '', $fslashed_dir ) : $fslashed_dir ) );
	}

	class NHP_Options {

		protected $framework_url = 'http://leemason.github.com/NHP-Theme-Options-Framework/';
		protected $framework_version = '1.0.6';

		public $dir = NHP_OPTIONS_DIR;
		public $url = NHP_OPTIONS_URL;
		public $page = '';
		public $args = array();
		public $sections = array();
		public $extra_tabs = array();
		public $errors = array();
		public $warnings = array();
		public $options = array();


		/**
		 * Class Constructor. Defines the args for the theme options class
		 *
		 * @since NHP_Options 1.0
		 *
		 * @param $array $args Arguments. Class constructor arguments.
		 */
		function __construct( $sections = array(), $args = array(), $extra_tabs = array() ) {

			$defaults = array();

			$defaults['opt_name'] = ''; //must be defined by theme/plugin

			$defaults['google_api_key'] = ''; //must be defined for use with google webfonts field type

			$defaults['menu_icon']      = NHP_OPTIONS_URL . '/img/menu_icon.png';
			$defaults['menu_title']     = esc_html__( 'Options', 'ct_theme' );
			$defaults['page_icon']      = 'icon-themes';
			$defaults['page_title']     = esc_html__( 'Options', 'ct_theme' );
			$defaults['page_slug']      = '_options';
			$defaults['page_cap']       = 'manage_options';
			$defaults['page_type']      = 'menu';
			$defaults['page_parent']    = '';
			$defaults['page_position']  = 100;
			$defaults['allow_sub_menu'] = true;

			$defaults['show_import_export']  = true;
			$defaults['dev_mode']            = true;
			$defaults['stylesheet_override'] = false;

			$defaults['help_tabs']    = array();
			$defaults['help_sidebar'] =  '';

			//get args
			$this->args = wp_parse_args( $args, $defaults );
			$this->args = apply_filters( 'nhp-opts-args-' . $this->args['opt_name'], $this->args );

			//get sections
			$this->sections = apply_filters( 'nhp-opts-sections-' . $this->args['opt_name'], $sections );

			//get extra tabs
			$this->extra_tabs = apply_filters( 'nhp-opts-extra-tabs-' . $this->args['opt_name'], $extra_tabs );

			//set option with defaults
			add_action( 'init', array( &$this, '_set_default_options' ) );

			//options page
			add_action( 'admin_menu', array( &$this, '_options_page' ) );

			//register setting
			add_action( 'admin_init', array( &$this, '_register_setting' ) );

			//add the js for the error handling before the form
			add_action( 'nhp-opts-page-before-form-' . $this->args['opt_name'], array( &$this, '_errors_js' ), 1 );

			//add the js for the warning handling before the form
			add_action( 'nhp-opts-page-before-form-' . $this->args['opt_name'], array( &$this, '_warnings_js' ), 2 );

			//hook into the wp feeds for downloading the exported settings
			add_action( 'do_feed_nhpopts-' . $this->args['opt_name'], array( &$this, '_download_options' ), 1, 1 );

			//get the options for use later on
			$this->options = get_option( $this->args['opt_name'] );

			//escape attributes for options
			$this->escapeArgs();

		}

		/**
		 * Escape arguments to prevent problems in options fields
		 */

		protected function escapeArgs() {
			$keys = array('id','class','opt_name');

			foreach ( $keys as $k ) {
				if ( isset( $this->args[ $k ] ) ) {
					$this->args[ $k ] = esc_attr( $this->args[ $k ] );
				}
			}
		}

		//function


		/**
		 * ->get(); This is used to return and option value from the options array
		 *
		 * @since NHP_Options 1.0.1
		 *
		 * @param $array $args Arguments. Class constructor arguments.
		 */
		function get( $opt_name, $default = null ) {
			return ( ! empty( $this->options[ $opt_name ] ) ) ? $this->options[ $opt_name ] : $default;
		}

		//function

		/**
		 * ->set(); This is used to set an arbitrary option in the options array
		 *
		 * @since NHP_Options 1.0.1
		 *
		 * @param string $opt_name the name of the option being added
		 * @param mixed $value the value of the option being added
		 */
		function set( $opt_name = '', $value = '' ) {
			if ( $opt_name != '' ) {
				$this->options[ $opt_name ] = $value;
				update_option( $this->args['opt_name'], $this->options );
			}
			//if
		}

		/**
		 * ->show(); This is used to echo and option value from the options array
		 *
		 * @since NHP_Options 1.0.1
		 *
		 * @param $array $args Arguments. Class constructor arguments.
		 */
		function show( $opt_name, $default = '' ) {
			$option = $this->get( $opt_name );
			if ( ! is_array( $option ) && $option != '' ) {
				echo esc_html( $option );
			} elseif ( $default != '' ) {
				echo esc_html( $default );
			}
		}

		//function


		/**
		 * Get default options into an array suitable for the settings API
		 *
		 * @since NHP_Options 1.0
		 *
		 */
		function _default_values() {

			$defaults = array();

			foreach ( $this->sections as $k => $section ) {

				if ( isset( $section['fields'] ) ) {

					foreach ( $section['fields'] as $fieldk => $field ) {

						if ( ! isset( $field['std'] ) ) {
							$field['std'] = '';
						}

						$defaults[ $field['id'] ] = $field['std'];

					}
					//foreach

				}
				//if

			}
			//foreach

			//fix for notice on first page load
			$defaults['last_tab'] = 0;

			return $defaults;

		}


		/**
		 * Set default options on admin_init if option doesnt exist (theme activation hook caused problems, so admin_init it is)
		 *
		 * @since NHP_Options 1.0
		 *
		 */
		function _set_default_options() {
			if ( ! get_option( $this->args['opt_name'] ) ) {
				add_option( $this->args['opt_name'], $this->_default_values() );
			}
			$this->options = get_option( $this->args['opt_name'] );
		}

		//function


		/**
		 * Class Theme Options Page Function, creates main options page.
		 *
		 * @since NHP_Options 1.0
		 */
		function _options_page() {
			if ( $this->args['page_type'] == 'submenu' ) {
				if ( ! isset( $this->args['page_parent'] ) || empty( $this->args['page_parent'] ) ) {
					$this->args['page_parent'] = 'themes.php';
				}
				$this->page = add_theme_page(
					$this->args['page_title'],
					$this->args['menu_title'],
					$this->args['page_cap'],
					$this->args['page_slug'],
					array( &$this, '_options_page_html' )
				);
			}

			add_action( 'admin_print_styles-' . $this->page, array( &$this, '_enqueue' ) );
			add_action( 'load-' . $this->page, array( &$this, '_load_page' ) );
		}

		//function


		/**
		 * enqueue styles/js for theme page
		 *
		 * @since NHP_Options 1.0
		 */
		function _enqueue() {

			wp_register_style(
				'nhp-opts-css',
				$this->url . 'css/options.css',
				array( 'farbtastic' ),
				time(),
				'all'
			);

			wp_register_style(
				'nhp-opts-jquery-ui-css',
				apply_filters( 'nhp-opts-ui-theme', $this->url . 'css/jquery-ui-aristo/aristo.css' ),
				'',
				time(),
				'all'
			);


			if ( false === $this->args['stylesheet_override'] ) {
				wp_enqueue_style( 'nhp-opts-css' );
			}


			wp_enqueue_script(
				'nhp-opts-js',
				$this->url . 'js/options.js',
				array( 'jquery' ),
				time(),
				true
			);
			wp_localize_script( 'nhp-opts-js', 'nhp_opts', array(
					'reset_confirm' => esc_html__( 'Are you sure? Resetting will loose all custom values.', 'ct_theme' ),
					'opt_name'      => $this->args['opt_name']
				) );

			do_action( 'nhp-opts-enqueue-' . $this->args['opt_name'] );


			foreach ( $this->sections as $k => $section ) {

				if ( isset( $section['fields'] ) ) {

					foreach ( $section['fields'] as $fieldk => $field ) {

						if ( isset( $field['type'] ) ) {

							$field_class = 'NHP_Options_' . $field['type'];

							if ( ! class_exists( $field_class ) ) {

								if ( is_file( $this->dir . 'fields/' . $field['type'] . '/field_' . $field['type'] . '.php' ) ) {

									require_once( $this->dir . 'fields/' . $field['type'] . '/field_' . $field['type'] . '.php' );

								}

							}
							//if

							if ( class_exists( $field_class ) && method_exists( $field_class, 'enqueue' ) ) {
								$enqueue = new $field_class( '', '', $this );
								$enqueue->enqueue();
							}
							//if

						}
						//if type

					}
					//foreach

				}
				//if fields

			}
			//foreach


		}

		//function

		/**
		 * Download the options file, or display it
		 *
		 * @since NHP_Options 1.0.1
		 */
		function _download_options() {
			//-'.$this->args['opt_name']
			if ( ! isset( $_GET['secret'] ) || $_GET['secret'] != md5( AUTH_KEY . SECURE_AUTH_KEY ) ) {
				wp_die( 'Invalid Secret for options use' );
				exit;
			}
			if ( ! isset( $_GET['feed'] ) ) {
				wp_die( 'No Feed Defined' );
				exit;
			}
			$backup_options                    = get_option( str_replace( 'nhpopts-', '', $_GET['feed'] ) );
			$backup_options['nhp-opts-backup'] = '1';
			$content                           = '###' . serialize( $backup_options ) . '###';


			if ( isset( $_GET['action'] ) && $_GET['action'] == 'download_options' ) {
				header( 'Content-Description: File Transfer' );
				header( 'Content-type: application/txt' );
				header( 'Content-Disposition: attachment; filename="' . str_replace( 'nhpopts-', '', $_GET['feed'] ) . '_options_' . date( 'd-m-Y' ) . '.txt"' );
				header( 'Content-Transfer-Encoding: binary' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate' );
				header( 'Pragma: public' );
				//no escape required
				echo $content;
				exit;
			} else {
				//no escape required
				echo $content;
				exit;
			}
		}


		/**
		 * show page help
		 *
		 * @since NHP_Options 1.0
		 */
		function _load_page() {

			//do admin head action for this page
			add_action( 'admin_head', array( &$this, 'admin_head' ) );

			//do admin footer text hook
			add_filter( 'admin_footer_text', array( &$this, 'admin_footer_text' ) );

			$screen = get_current_screen();

			if ( is_array( $this->args['help_tabs'] ) ) {
				foreach ( $this->args['help_tabs'] as $tab ) {
					$screen->add_help_tab( $tab );
				}
				//foreach
			}
			//if

			if ( $this->args['help_sidebar'] != '' ) {
				$screen->set_help_sidebar( $this->args['help_sidebar'] );
			}
			//if

			do_action( 'nhp-opts-load-page-' . $this->args['opt_name'], $screen );

		}

		//function


		/**
		 * do action nhp-opts-admin-head for theme options page
		 *
		 * @since NHP_Options 1.0
		 */
		function admin_head() {

			do_action( 'nhp-opts-admin-head-' . $this->args['opt_name'], $this );

		}

		//function


		function admin_footer_text( $footer_text ) {
			return $this->args['footer_credit'];
		}

		//function


		/**
		 * Register Option for use
		 *
		 * @since NHP_Options 1.0
		 */
		function _register_setting() {

			register_setting( $this->args['opt_name'] . '_group', $this->args['opt_name'], array(
					&$this,
					'_validate_options'
				) );

			foreach ( $this->sections as $k => $section ) {

				add_settings_section( $k . '_section', $section['title'], array(
						&$this,
						'_section_desc'
					), $k . '_section_group' );

				if ( isset( $section['fields'] ) ) {

					foreach ( $section['fields'] as $fieldk => $field ) {

						if ( isset( $field['title'] ) ) {

							$th = ( isset( $field['sub_desc'] ) ) ? $field['title'] . '<span class="description">' . $field['sub_desc'] . '</span>' : $field['title'];
						} else {
							$th = '';
						}

						add_settings_field( $fieldk . '_field', $th, array(
								&$this,
								'_field_input'
							), $k . '_section_group', $k . '_section', $field ); // checkbox

					}
					//foreach

				}
				//if(isset($section['fields'])){

			}
			//foreach

			do_action( 'nhp-opts-register-settings-' . $this->args['opt_name'] );

		}

		//function


		/**
		 * Validate the Options options before insertion
		 *
		 * @since NHP_Options 1.0
		 */
		function _validate_options( $plugin_options ) {

			set_transient( 'nhp-opts-saved', '1', 1000 );

			if ( ! empty( $plugin_options['import'] ) ) {

				if ( $plugin_options['import_code'] != '' ) {
					$import = $plugin_options['import_code'];
				} elseif ( $plugin_options['import_link'] != '' ) {
					$import = wp_remote_retrieve_body( wp_remote_get( $plugin_options['import_link'] ) );
				}

				$imported_options = unserialize( trim( $import, '###' ) );
				if ( is_array( $imported_options ) && isset( $imported_options['nhp-opts-backup'] ) && $imported_options['nhp-opts-backup'] == '1' ) {
					$imported_options['imported'] = 1;

					return $imported_options;
				}


			}


			if ( ! empty( $plugin_options['defaults'] ) ) {
				$plugin_options = $this->_default_values();

				return $plugin_options;
			}
			//if set defaults


			//validate fields (if needed)
			$plugin_options = $this->_validate_values( $plugin_options, $this->options );

			if ( $this->errors ) {
				set_transient( 'nhp-opts-errors-' . $this->args['opt_name'], $this->errors, 1000 );
			}
			//if errors

			if ( $this->warnings ) {
				set_transient( 'nhp-opts-warnings-' . $this->args['opt_name'], $this->warnings, 1000 );
			}
			//if errors

			do_action( 'nhp-opts-options-validate-' . $this->args['opt_name'], $plugin_options, $this->options );


			unset( $plugin_options['defaults'] );
			unset( $plugin_options['import'] );
			unset( $plugin_options['import_code'] );
			unset( $plugin_options['import_link'] );

			return $plugin_options;

		}

		//function


		/**
		 * Validate values from options form (used in settings api validate function)
		 * calls the custom validation class for the field so authors can override with custom classes
		 *
		 * @since NHP_Options 1.0
		 */
		function _validate_values( $plugin_options, $options ) {
			foreach ( $this->sections as $k => $section ) {

				if ( isset( $section['fields'] ) ) {

					foreach ( $section['fields'] as $fieldk => $field ) {
						$field['section_id'] = $k;

						if ( isset( $field['type'] ) && $field['type'] == 'multi_text' ) {
							continue;
						} //we cant validate this yet

						if ( ! isset( $plugin_options[ $field['id'] ] ) || $plugin_options[ $field['id'] ] == '' ) {
							continue;
						}

						//force validate of custom filed types

						if ( isset( $field['type'] ) && ! isset( $field['validate'] ) ) {
							if ( $field['type'] == 'color' || $field['type'] == 'color_gradient' ) {
								$field['validate'] = 'color';
							} elseif ( $field['type'] == 'date' ) {
								$field['validate'] = 'date';
							}
						}
						//if

						if ( isset( $field['validate'] ) ) {
							$validate = 'NHP_Validation_' . $field['validate'];

							if ( ! class_exists( $validate ) ) {
								require_once( $this->dir . 'validation/' . $field['validate'] . '/validation_' . $field['validate'] . '.php' );
							}
							//if

							if ( class_exists( $validate ) ) {
								$validation                     = new $validate( $field, $plugin_options[ $field['id'] ], $options[ $field['id'] ] );
								$plugin_options[ $field['id'] ] = $validation->value;
								if ( isset( $validation->error ) ) {
									$this->errors[] = $validation->error;
								}
								if ( isset( $validation->warning ) ) {
									$this->warnings[] = $validation->warning;
								}
								continue;
							}
							//if
						}
						//if


						if ( isset( $field['validate_callback'] ) && function_exists( $field['validate_callback'] ) ) {

							$callbackvalues                 = call_user_func( $field['validate_callback'], $field, $plugin_options[ $field['id'] ], $options[ $field['id'] ] );
							$plugin_options[ $field['id'] ] = $callbackvalues['value'];
							if ( isset( $callbackvalues['error'] ) ) {
								$this->errors[] = $callbackvalues['error'];
							}
							//if
							if ( isset( $callbackvalues['warning'] ) ) {
								$this->warnings[] = $callbackvalues['warning'];
							}
							//if

						}
						//if


					}
					//foreach

				}
				//if(isset($section['fields'])){

			}

			//foreach
			return $plugin_options;
		}

		//function


		/**
		 * HTML OUTPUT.
		 *
		 * @since NHP_Options 1.0
		 */
		function _options_page_html() {

			throw new Exception( "Please implement in subclass" );

		}

		//function


		/**
		 * JS to display the errors on the page
		 *
		 * @since NHP_Options 1.0
		 */
		function _errors_js() {

			if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' && get_transient( 'nhp-opts-errors-' . $this->args['opt_name'] ) ) {
				$errors         = get_transient( 'nhp-opts-errors-' . $this->args['opt_name'] );
				$section_errors = array();
				foreach ( $errors as $error ) {
					$section_errors[ $error['section_id'] ] = ( isset( $section_errors[ $error['section_id'] ] ) ) ? $section_errors[ $error['section_id'] ] : 0;
					$section_errors[ $error['section_id'] ] ++;
				}


				echo '<script type="text/javascript">';
				echo 'jQuery(document).ready(function(){';
				echo 'jQuery("#nhp-opts-field-errors span").html("' . esc_js( count( $errors ) ) . '");';
				echo 'jQuery("#nhp-opts-field-errors").show();';

				foreach ( $section_errors as $sectionkey => $section_error ) {
					echo 'jQuery("#' . esc_js( $sectionkey ) . '_section_group_li_a").append("<span class=\"nhp-opts-menu-error\">' . esc_js( $section_error ) . '</span>");';
				}

				foreach ( $errors as $error ) {
					echo 'jQuery("#' . esc_js( $error['id'] ) . '").addClass("nhp-opts-field-error");';
					echo 'jQuery("#' . esc_js( $error['id'] ) . '").closest("td").append("<span class=\"nhp-opts-th-error\">' . esc_js( $error['msg'] ) . '</span>");';
				}
				echo '});';
				echo '</script>';
				delete_transient( 'nhp-opts-errors-' . $this->args['opt_name'] );
			}

		}

		//function


		/**
		 * JS to display the warnings on the page
		 *
		 * @since NHP_Options 1.0.3
		 */
		function _warnings_js() {

			if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' && get_transient( 'nhp-opts-warnings-' . $this->args['opt_name'] ) ) {
				$warnings         = get_transient( 'nhp-opts-warnings-' . $this->args['opt_name'] );
				$section_warnings = array();
				foreach ( $warnings as $warning ) {
					$section_warnings[ $warning['section_id'] ] = ( isset( $section_warnings[ $warning['section_id'] ] ) ) ? $section_warnings[ $warning['section_id'] ] : 0;
					$section_warnings[ $warning['section_id'] ] ++;
				}


				echo '<script type="text/javascript">';
				echo 'jQuery(document).ready(function(){';
				echo 'jQuery("#nhp-opts-field-warnings span").html("' . esc_js( count( $warnings ) ) . '");';
				echo 'jQuery("#nhp-opts-field-warnings").show();';

				foreach ( $section_warnings as $sectionkey => $section_warning ) {
					echo 'jQuery("#' . esc_js( $sectionkey ) . '_section_group_li_a").append("<span class=\"nhp-opts-menu-warning\">' . esc_js( $section_warning ) . '</span>");';
				}

				foreach ( $warnings as $warning ) {
					echo 'jQuery("#' . esc_js( $warning['id'] ) . '").addClass("nhp-opts-field-warning");';
					echo 'jQuery("#' . esc_js( $warning['id'] ) . '").closest("td").append("<span class=\"nhp-opts-th-warning\">' . esc_js( $warning['msg'] ) . '</span>");';
				}
				echo '});';
				echo '</script>';
				delete_transient( 'nhp-opts-warnings-' . $this->args['opt_name'] );
			}

		}

		//function


		/**
		 * Section HTML OUTPUT.
		 *
		 * @since NHP_Options 1.0
		 */
		function _section_desc( $section ) {

			$id = rtrim( $section['id'], '_section' );

			if ( isset( $this->sections[ $id ]['desc'] ) && ! empty( $this->sections[ $id ]['desc'] ) ) {
				echo '<div class="nhp-opts-section-desc">' . esc_html( $this->sections[ $id ]['desc'] ) . '</div>';
			}

		}

		//function


		/**
		 * Field HTML OUTPUT.
		 *
		 * Gets option from options array, then calls the speicfic field type class - allows extending by other devs
		 *
		 * @since NHP_Options 1.0
		 */
		function _field_input( $field ) {


			if ( isset( $field['callback'] ) && function_exists( $field['callback'] ) ) {
				$value = ( isset( $this->options[ $field['id'] ] ) ) ? $this->options[ $field['id'] ] : '';
				do_action( 'nhp-opts-before-field-' . $this->args['opt_name'], $field, $value );
				call_user_func( $field['callback'], $field, $value );
				do_action( 'nhp-opts-after-field-' . $this->args['opt_name'], $field, $value );

				return;
			}

			if ( isset( $field['type'] ) ) {

				$field_class = 'NHP_Options_' . $field['type'];

				if ( class_exists( $field_class ) ) {
					require_once( $this->dir . 'fields/' . $field['type'] . '/field_' . $field['type'] . '.php' );
				}
				//if

				if ( class_exists( $field_class ) ) {
					$value = ( isset( $this->options[ $field['id'] ] ) ) ? $this->options[ $field['id'] ] : '';
					do_action( 'nhp-opts-before-field-' . $this->args['opt_name'], $field, $value );
					$render = '';
					$render = new $field_class( $field, $value, $this );
					$render->render();
					do_action( 'nhp-opts-after-field-' . $this->args['opt_name'], $field, $value );
				}
				//if

			}
			//if $field['type']

		}
		//function


	}
	//class
}//if
?>