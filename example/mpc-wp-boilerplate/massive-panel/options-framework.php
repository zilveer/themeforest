<?php
/*
Description: A framework for building theme options.
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
Version: 1.3
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there! I'm just a little extension, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'mpcth_optionsframework_rolescheck' );

function mpcth_optionsframework_rolescheck () {
	if ( current_user_can( 'edit_posts' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action( 'admin_menu', 'mpcth_optionsframework_add_page');
		add_action( 'admin_init', 'mpcth_optionsframework_init' );
		add_action( 'admin_init', 'mpcth_optionsframework_mlu_init' );
		add_action( 'wp_before_admin_bar_render', 'mpcth_optionsframework_adminbar' );
	}
}

/* Loads the file for option sanitization */

add_action('init', 'mpcth_optionsframework_load_sanitization' );

function mpcth_optionsframework_load_sanitization() {
	require_once (get_template_directory() . '/mpc-wp-boilerplate/massive-panel/options-sanitize.php');
}

/*
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function mpcth_optionsframework_init() {

	// Include the required files
	require_once (get_template_directory() . '/mpc-wp-boilerplate/massive-panel/options-interface.php');
	require_once (get_template_directory() . '/mpc-wp-boilerplate/massive-panel/options-medialibrary-uploader.php');

	// Loads the options array from the theme
	if ($mpcth_optionsfile = locate_template( array('mpcth-admin-options.php'))) {
		require_once($mpcth_optionsfile);
	} else if (file_exists( get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-admin-options.php' )) {
		require_once (get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-admin-options.php');
	}

	$mpcth_optionsframework_settings = get_option('mpcth_optionsframework');

	// Updates the unique option id in the database if it has changed
	mpcth_optionsframework_option_name();

	// Gets the unique id, returning a default if it isn't defined
	if (isset($mpcth_optionsframework_settings['id'])) {
		$mpcth_option_name = $mpcth_optionsframework_settings['id'];
	} else {
		$mpcth_option_name = 'mpcth_optionsframework';
	}

	// If the option has no saved data, load the defaults
	if (!get_option($mpcth_option_name)) {
		mpcth_optionsframework_setdefaults();
	}

	// Registers the settings fields and callback
	register_setting('mpcth_optionsframework', $mpcth_option_name, 'mpcth_optionsframework_validate');

	// Change the capability required to save the 'optionsframework' options group.
	add_filter( 'mpcth_option_page_capability_optionsframework', 'mpcth_optionsframework_page_capability' );
}

/**
 * Ensures that a user with the 'edit_theme_options' capability can actually set the options
 * See: http://core.trac.wordpress.org/ticket/14365
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */

function mpcth_optionsframework_page_capability($capability) {
	return 'edit_theme_options';
}

/*
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function mpcth_optionsframework_setdefaults() {
	$mpcth_optionsframework_settings = get_option('mpcth_optionsframework');

	// Gets the unique option id
	$mpcth_option_name = $mpcth_optionsframework_settings['id'];

	/*
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.
	 *
	 */

	if (isset($mpcth_optionsframework_settings['knownoptions'])) {
		$mpcth_knownoptions =  $mpcth_optionsframework_settings['knownoptions'];
		if ( !in_array($mpcth_option_name, $mpcth_knownoptions) ) {
			array_push( $mpcth_knownoptions, $mpcth_option_name );
			$mpcth_optionsframework_settings['knownoptions'] = $mpcth_knownoptions;
			update_option('mpcth_optionsframework', $mpcth_optionsframework_settings);
		}
	} else {
		$mpcth_new_option_name = array($mpcth_option_name);
		$mpcth_optionsframework_settings['knownoptions'] = $mpcth_new_option_name;
		update_option('mpcth_optionsframework', $mpcth_optionsframework_settings);
	}

	// Gets the default options data from the array in options.php
	$mpcth_options = mpcth_optionsframework_options();

	// If the options haven't been added to the database yet, they are added now
	$mpcth_values = mpcth_of_get_default_values();

	if (isset($mpcth_values)) {
		add_option($mpcth_option_name, $mpcth_values); // Add option with default settings
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if (!function_exists('mpcth_optionsframework_add_page')) {

	function mpcth_optionsframework_add_page() {
		$mpcth_of_page = add_menu_page(__('Theme Options', 'mpcth'), __('Theme Options', 'mpcth'), 'edit_theme_options', 'mpcth-options-framework','mpcth_optionsframework_page');

		// Load the required CSS and javscript
		add_action('admin_enqueue_scripts', 'mpcth_optionsframework_load_scripts');
//		add_action( 'admin_print_styles-' . $mpcth_of_page, 'mpcth_optionsframework_load_styles');
		mpcth_optionsframework_load_styles();
	}

}

/* Loads the CSS */

function mpcth_optionsframework_load_styles() {
	wp_enqueue_style('mpcth-optionsframework', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/css/optionsframework.css');
	wp_enqueue_style('mpcth-color-picker', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/css/colorpicker.css');
}

/* Loads the javascript */

function mpcth_optionsframework_load_scripts($hook) {
	global $mpcth_options_name;
	/*
	TO DO: check
	if ('appearance_page_mpcth-options-framework' != $hook)
    	return;
	*/

	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');

	// jQuery UI
	wp_enqueue_script('jquery-ui-slider', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/js/jquery-ui-1.9.2.custom.min.js', array('jquery'));

	// Color Picket
	wp_enqueue_script('mpcth-color-picker', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/js/colorpicker.js', array('jquery'));

	// Custom JS
	wp_enqueue_script('mpcth-options-custom', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/js/options-custom.js', array('jquery'));

	// Google Font
	wp_enqueue_script('webfonts', '//ajax.googleapis.com/ajax/libs/webfont/1.1.2/webfont.js');

	/* Localize */
	$all_google_fonts = get_transient('mpcth_google_fonts');
	wp_localize_script('mpcth-options-custom', 'mpcthLocalize', array(
		'optionsName' => $mpcth_options_name,
		'sampleText' => __('Short sample text.', 'mpcth'),
		'googleAPIErrorMsg' => __('There is problem with access to Google Webfonts. Please try again later. If this message keeps appearing please contact our support at <a href="http://mpc.ticksy.com/">mpc.ticksy.com</a>.', 'mpcth'),
		'googleAPIKey' => 'AIzaSyBt2419oEtyBeJkhKnc0oomQZrLS3W8MlM', // Example Theme Key from mpc.apis
		'googleFonts' => $all_google_fonts
	) );

	$mpcth_custom_fonts = get_option('mpcth_custom_fonts');

	if(isset($mpcth_custom_fonts))
		wp_enqueue_script('mpcth-custom-fonts', MPC_THEME_ROOT . '/mpc-wp-boilerplate/massive-panel/js/cufon.js', array('jquery'));

	// Inline scripts from options-interface.php
	add_action('admin_head', 'mpcth_of_admin_head');
}

function mpcth_of_admin_head() {

	// Hook to add custom scripts
	do_action('mpcth_optionsframework_custom_scripts');
}

/* Cache Google Webfonts */

add_action('wp_ajax_cache_google_webfonts', 'cache_google_webfonts');
function cache_google_webfonts() {
	if(isset($_POST['google_webfonts'])) {
		set_transient('mpcth_google_fonts', $_POST['google_webfonts'], DAY_IN_SECONDS);
	}

	die();
}

/*
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if (!function_exists('mpcth_optionsframework_page')) {
	function mpcth_optionsframework_page() {
		settings_errors();
?>

	<!-- optionsframework-wrap -->
	<div id="mpcth-of-wrap" class="">


    <!-- optionsframework-metabox -->
    <!-- metabox-holder <- class deleted -->
    <div id="mpcth-of-metabox" class="">
    	<div id="mpcth-of-header">
    		<span class="mpcth-of-logo">l</span>
    		<h2><?php _e('Welcome to Massive Panel', 'mpcth'); ?></h2>
    		<h3><?php _e('use it wisely to customize your theme.', 'mpcth'); ?></h3>
    		<a href="http://mpc.ticksy.com" class="mpcth-of-support" target="_blank"><?php _e('Support', 'mpcth'); ?></a>
    	</div>
	    	 <!-- nav-tab-wrapper -->
	    <div class="mpcth-of-nav-tab-wrapper">
	        <?php echo mpcth_optionsframework_tabs(); ?>
	    </div>
    	<!-- optionsframework -->
	    <div class="mpcth-of postbox">
			<form action="options.php" method="post">
			<?php settings_fields('mpcth_optionsframework'); ?>
			<?php mpcth_optionsframework_fields(); /* Settings */ ?>
			<div id="optionsframework-submit">
				<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e('Save Options', 'mpcth'); ?>" />
				<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e('Restore Defaults', 'mpcth'); ?>" onclick="return confirm( '<?php print esc_js(__('Click OK to reset. Any theme settings will be lost!', 'mpcth')); ?>' );" />
				<div class="clear"></div>
			</div>
			</form>
		</div> <!-- / #container -->
	</div>
	<?php do_action('mpcth_optionsframework_after'); ?>
	<div class="clear"></div>
	</div> <!-- / .wrap -->

<?php
	}
}

/**
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset'] to restore default options
 */
function mpcth_optionsframework_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */

	if (isset($_POST['reset'])) {
		add_settings_error( 'mpcth-options-framework', 'restore_defaults', __('Default options restored.', 'mpcth'), 'updated fade' );
		return mpcth_of_get_default_values();
	} else {

	/*
	 * Update Settings
	 *
	 * This used to check for $_POST['update'], but has been updated
	 * to be compatible with the theme customizer introduced in WordPress 3.4
	 */

		$clean = array();
		$mpcth_options = mpcth_optionsframework_options();

		foreach ($mpcth_options as $mpcth_option) {
			if (!isset($mpcth_option['id'])) {
				continue;
			}

			if (!isset($mpcth_option['type'])) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $mpcth_option['id'] ) );

			// Set checkbox to false if it wasn't sent in the $_POST
			if ('checkbox' == $mpcth_option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = false;
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ('multicheck' == $mpcth_option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $mpcth_option['options'] as $key => $value ) {
					$input[$id][$key] = false;
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if (has_filter( 'mpcth_of_sanitize_' . $mpcth_option['type'] ) ) {
				$clean[$id] = apply_filters( 'mpcth_of_sanitize_' . $mpcth_option['type'], $input[$id], $mpcth_option );
			}
		}

		add_settings_error( 'mpcth-options-framework', 'save_options', __('Options saved.', 'mpcth'), 'updated fade' );

		// print_r($clean);
		return $clean;
	}

}

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */

function mpcth_of_get_default_values() {
	$output = array();
	$config = mpcth_optionsframework_options();

	foreach ( (array) $config as $mpcth_option ) {
		if ( ! isset( $mpcth_option['id'] ) ) {
			continue;
		}
		if ( ! isset( $mpcth_option['std'] ) ) {
			continue;
		}
		if ( ! isset( $mpcth_option['type'] ) ) {
			continue;
		}
		if ( has_filter( 'mpcth_of_sanitize_' . $mpcth_option['type'] ) )
			$output[$mpcth_option['id']] = apply_filters( 'mpcth_of_sanitize_' . $mpcth_option['type'], $mpcth_option['std'], $mpcth_option );
		else
			$output[$mpcth_option['id']] = $mpcth_option['std'];
	}
	return $output;
}

/**
 * Add Theme Options menu item to Admin Bar.
 */

function mpcth_optionsframework_adminbar() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
			'parent' => 'appearance',
			'id' => 'mpcth_of_theme_options',
			'title' => __('Theme Options', 'mpcth'),
			'href' => admin_url( 'themes.php?page=mpcth-options-framework' )
		));
}

if (!function_exists('mpcth_of_get_option')) {

	/**
	 * Get Option.
	 *
	 * Helper function to return the theme option value.
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */

	function mpcth_of_get_option($name, $default = false) {
		$config = get_option('mpcth_optionsframework');

		if (!isset( $config['id'])) {
			return $default;
		}

		$mpcth_options = get_option($config['id']);

		if (isset($mpcth_options[$name])){
			return $mpcth_options[$name];
		}

		return $default;
	}
}