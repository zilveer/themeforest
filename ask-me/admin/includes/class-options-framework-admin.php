<?php
/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2013 WP Theming
 */
class Options_Framework_Admin {

	/**
     * Page hook for the options screen
     *
     * @since 1.7.0
     * @type string
     */
    protected $options_screen = null;

    /**
     * Hook in the scripts and styles
     *
     * @since 1.7.0
     */
    public function init() {

		// Gets options to load
    	$options = & Options_Framework::_optionsframework_options();

		// Checks if options are available
    	if ( $options ) {

			// Add the options page and menu item.
			add_action('admin_menu', array( $this, 'vpanel_add_admin' ) );
			
			// Settings need to be registered after admin_init
			add_action( 'admin_init', array( $this, 'settings_init' ) );

		}

    }

	/**
     * Registers the settings
     *
     * @since 1.7.0
     */
    function settings_init() {
    	// Load Options Framework Settings
    	//update_option( "optionsframework",array("id" => "ask") );
        $optionsframework_settings = get_option(vpanel_options);

		// Registers the settings fields and callback
		register_setting( "vpanel", vpanel_options,  array ( $this, 'validate_options' ) );

		// Displays notice after options save
		add_action( 'optionsframework_after_validate', array( $this, 'save_options_notice' ) );

    }

	/*
	 * Define menu options (still limited to appearance section)
	 *
	 * Examples usage:
	 *
	 * add_filter( 'optionsframework_menu', function( $menu ) {
	 *     $menu['page_title'] = 'The Options';
	 *	   $menu['menu_title'] = 'The Options';
	 *     return $menu;
	 * });
	 *
	 * @since 1.7.0
	 *
	 */
	/**
     * Add a subpage called "Theme Options" to the appearance menu.
     *
     * @since 1.7.0
     */
	function vpanel_add_admin() {
		add_menu_page('Ask me Settings', 'Ask me' ,'install_themes', 'options' , array( $this, 'options_page' ),"dashicons-admin-site" );
		
		// Load the required CSS and javscript
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
     * Loads the required stylesheets
     *
     * @since 1.7.0
     */
	function enqueue_admin_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style("vpanel_style",OPTIONS_FRAMEWORK_DIRECTORY .'vpanel_style/vpanel_style.css');
		if (is_rtl()) {
			wp_enqueue_style("vpanel_style_css",OPTIONS_FRAMEWORK_DIRECTORY .'vpanel_style/vpanel_style_ar.css');
			wp_enqueue_style( 'vpanel', OPTIONS_FRAMEWORK_DIRECTORY . 'css/optionsframework-ar.css', array(), Options_Framework::VERSION );
		}else {
			wp_enqueue_style( 'vpanel', OPTIONS_FRAMEWORK_DIRECTORY . 'css/optionsframework.css', array(), Options_Framework::VERSION );
		}
	}

	/**
     * Loads the required javascript
     *
     * @since 1.7.0
     */
	function enqueue_admin_scripts() {
		$categories_obj = get_categories('hide_empty=0');
		$categories = array();
		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		wp_enqueue_script( 'options-custom', OPTIONS_FRAMEWORK_DIRECTORY . 'js/options-custom.js', array( 'jquery','wp-color-picker' ));
		wp_enqueue_script("ahmed",OPTIONS_FRAMEWORK_DIRECTORY .'js/ahmed.js',array('jquery'));
		wp_localize_script("ahmed","ajax_a",admin_url("admin-ajax.php"));
		wp_localize_script("ahmed","confirm_reports",__("If you press will delete report !","vbegy"));
		wp_localize_script("ahmed","confirm_delete_attachment",__("If you press will delete the attachemtn !","vbegy"));
		wp_localize_script("ahmed","confirm_reset",__("Click OK to reset. Any theme settings will be lost!","vbegy"));
		wp_enqueue_script("vbegy_more",OPTIONS_FRAMEWORK_DIRECTORY .'js/more.js',array('jquery'));
		wp_localize_script("vbegy_more","vpanel_name","vpanel_".vpanel_name);
		wp_enqueue_script("builder_admin",OPTIONS_FRAMEWORK_DIRECTORY .'js/builder.js',array('jquery','jquery-ui-sortable'));
		wp_localize_script("builder_admin","categories",$categories);
		wp_localize_script("builder_admin","builder_ajax",admin_url("admin-ajax.php"));
		wp_enqueue_script("vbegy_checkbox",OPTIONS_FRAMEWORK_DIRECTORY .'js/checkbox.min.js',array('jquery'));
		wp_localize_script("vbegy_checkbox","images_url",OPTIONS_FRAMEWORK_DIRECTORY. 'images/');
		wp_enqueue_script("vbegy_tipsy.js",OPTIONS_FRAMEWORK_DIRECTORY .'js/jquery.tipsy.js',array('jquery'));
		$url = RWMB_CSS_URL . 'jqueryui';
		wp_register_style( 'jquery-ui-core', "{$url}/jquery.ui.core.css", array(), '1.8.17' );
		wp_register_style( 'jquery-ui-theme', "{$url}/jquery.ui.theme.css", array(), '1.8.17' );
		wp_enqueue_style( 'jquery-ui-datepicker', "{$url}/jquery.ui.datepicker.css", array( 'jquery-ui-core', 'jquery-ui-theme' ), '1.8.17' );
		$locale = str_replace( '_', '-', get_locale() );
		$file_path = 'jqueryui/datepicker-i18n/jquery.ui.datepicker-' . $locale . '.js';
		$deps = array( 'jquery-ui-datepicker' );
		if ( file_exists( RWMB_DIR . 'js/' . $file_path ) ) {
			wp_register_script( 'jquery-ui-datepicker-i18n', RWMB_JS_URL . $file_path, $deps, '1.8.17', true );
			$deps[] = 'jquery-ui-datepicker-i18n';
		}
		wp_enqueue_script( 'rwmb-date', RWMB_JS_URL . 'date.js', $deps, RWMB_VER, true );
		wp_localize_script( 'rwmb-date', 'RWMB_Datepicker', array( 'lang' => $locale ) );
		add_action( 'admin_head', array( $this, 'of_admin_head' ) );
	}

	function of_admin_head() {
		// Hook to add custom scripts
		do_action( 'optionsframework_custom_scripts' );
	}

	/**
     * Builds out the options panel.
     *
	 * If we were using the Settings API as it was intended we would use
	 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
	 * we'll call our own custom optionsframework_fields.  See options-interface.php
	 * for specifics on how each individual field is generated.
	 *
	 * Nonces are provided using the settings_fields()
	 *
     * @since 1.7.0
     */
	 function options_page() {
	 	global $themename;?>
		<div id="optionsframework-wrap">
		    <form action="options.php" id="main_options_form" method="post">
				<div class="optionsframework-header">
					<a href="http://themeforest.net/item/ask-me-responsive-questions-answers-wordpress/7935874?ref=2codeThemes" target="_blank"></a>
					<input type="submit" class="button-primary vpanel_save" name="update" value="<?php esc_attr_e( 'Save Options', 'vbegy' ); ?>">
					<div class="vpanel_social">
						<ul>
							<li><a class="vpanel_social_f" href="https://www.facebook.com/2code.info" target="_blank"><i class="dashicons dashicons-facebook"></i></a></li>
							<li><a class="vpanel_social_t" href="#" target="_blank"><i class="dashicons dashicons-twitter"></i></a></li>
							<li><a class="vpanel_social_e" href="#" target="_blank"><i class="dashicons dashicons-email-alt"></i></a></li>
							<li><a class="vpanel_social_s" href="#" target="_blank"><i class="dashicons dashicons-sos"></i></a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="optionsframework-content">
				    <h2 class="nav-tab-wrapper">
				        <?php echo Options_Framework_Interface::optionsframework_tabs(); ?>
				    </h2>
				    <?php settings_errors( 'options-framework' ); ?>
				    <div id="optionsframework-metabox" class="metabox-holder">
					    <div id="optionsframework" class="postbox">
							<?php Options_Framework_Interface::optionsframework_fields(); /* Settings */ ?>
							<div id="ajax-saving"><i class="dashicons dashicons-yes"></i><?php _e("Saving","vbegy")?></div>
							<div id="ajax-reset"><i class="dashicons dashicons-info"></i><?php _e("Reseting Options","vbegy")?></div>
						</div> <!-- / #container -->
					</div>
					<?php do_action( 'optionsframework_after' ); ?>
					<div class="clear"></div>
				</div>
				<div class="optionsframework-footer">
					<input type="submit" class="button-primary vpanel_save" name="update" value="<?php esc_attr_e( 'Save Options', 'vbegy' ); ?>">
					<div id="loading"></div>
					<input type="submit" class="reset-button button-secondary" id="reset_c" name="reset" value="<?php esc_attr_e( 'Restore Defaults', 'vbegy' ); ?>">
					<div class="clear"></div>
				</div>
			</form>
		</div> <!-- / .wrap -->
	<?php
	}

	/**
	 * Validate Options.
	 *
	 * This runs after the submit/reset button has been clicked and
	 * validates the inputs.
	 *
	 * @uses $_POST['reset'] to restore default options
	 */
	function validate_options( $input ) {

		/*
		 * Restore Defaults.
		 *
		 * In the event that the user clicked the "Restore Defaults"
		 * button, the options defined in the theme's options.php
		 * file will be added to the option for the active theme.
		 */

		if ( isset( $_POST['reset'] ) ) {
			add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'vbegy' ), 'updated fade' );
			return $this->get_default_values();
		}

		/*
		 * Update Settings
		 *
		 * This used to check for $_POST['update'], but has been updated
		 * to be compatible with the theme customizer introduced in WordPress 3.4
		 */

		$clean = array();
		$options = & Options_Framework::_optionsframework_options();
		foreach ( $options as $option ) {

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( ! isset( $option['type'] ) ) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

			// Set checkbox to false if it wasn't sent in the $_POST
			if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = false;
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = false;
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		// Hook to run after validation
		do_action( 'optionsframework_after_validate', $clean );

		return $clean;
	}

	/**
	 * Display message when options have been saved
	 */

	function save_options_notice() {
		add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', 'vbegy' ), 'updated fade' );
	}

	/**
	 * Get the default values for all the theme options
	 *
	 * Get an array of all default values as set in
	 * options.php. The 'id','std' and 'type' keys need
	 * to be defined in the configuration array. In the
	 * event that these keys are not present the option
	 * will not be included in this function's output.
	 *
	 * @return array Re-keyed options configuration array.
	 *
	 */

	function get_default_values() {
		$output = array();
		$config = & Options_Framework::_optionsframework_options();
		foreach ( (array) $config as $option ) {
			if ( ! isset( $option['id'] ) ) {
				continue;
			}
			if ( ! isset( $option['std'] ) ) {
				continue;
			}
			if ( ! isset( $option['type'] ) ) {
				continue;
			}
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
			}
		}
		return $output;
	}
}