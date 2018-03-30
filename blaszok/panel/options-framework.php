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

define('MPC_GOOGLE_FONTS_API_ID', 'AIzaSyDYrMY_TsJqaZSHAECtf-2u49BWT2_dnHw'); // Blaszok Theme Key from mpc.apis

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
	require_once (MPC_THEME_PATH . '/panel/options-sanitize.php');
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
	require_once (MPC_THEME_PATH . '/panel/options-interface.php');
	require_once (MPC_THEME_PATH . '/panel/options-medialibrary-uploader.php');

	// Loads the options array from the theme
	if ($mpcth_optionsfile = locate_template( array('mpcth-admin-options.php'))) {
		require_once($mpcth_optionsfile);
	} else if (file_exists( MPC_THEME_PATH . '/panel/admin-options.php' )) {
		require_once (MPC_THEME_PATH . '/panel/admin-options.php');
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

		// Load the required CSS and JS
		add_action('admin_enqueue_scripts', 'mpcth_optionsframework_load_scripts');
	}
}

/* Loads the javascript */
function mpcth_optionsframework_load_scripts($hook) {
	if ('toplevel_page_mpcth-options-framework' != $hook)
		return;

	// Styles
	wp_enqueue_style('wp-color-picker');

	wp_enqueue_style('font-awesome', MPC_THEME_URI . '/fonts/font-awesome.css');
	wp_enqueue_style('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,800');

	if (! is_rtl())
		wp_enqueue_style('mpcth-optionsframework', MPC_THEME_URI . '/panel/css/optionsframework.css');
	else
		wp_enqueue_style('mpcth-optionsframework', MPC_THEME_URI . '/panel/css/optionsframework-rtl.css');

	// Scripts
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('mpcth-options-custom', MPC_THEME_URI . '/panel/js/optionsframework.js', array('jquery'));
	wp_enqueue_script('webfonts', '//ajax.googleapis.com/ajax/libs/webfont/1.1.2/webfont.js');

	/* Localize */
	$google_webfonts = get_transient('mpcth_google_webfonts');
	wp_localize_script('mpcth-options-custom', 'mpcthLocalize', array(
		'optionsName' => MPC_OPTIONS_NAME,
		'sampleText' => __('Short sample text.', 'mpcth'),
		'googleAPIErrorMsg' => __('There is problem with access to Google Webfonts. Please try again later. If this message keeps appearing please contact our support at <a href="http://mpc.ticksy.com/">mpc.ticksy.com</a>.', 'mpcth'),
		'googleAPIKey' => MPC_GOOGLE_FONTS_API_ID,
		'googleFonts' => stripslashes($google_webfonts)
	) );

	// Inline scripts from options-interface.php
	add_action('admin_head', 'mpcth_of_admin_head');
}

function mpcth_of_admin_head() {
	// Hook to add custom scripts
	do_action('mpcth_optionsframework_custom_scripts');
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

		$mpc_theme = wp_get_theme();
		$saved_version = get_option('mpc_theme_version');
?>
	<div id="mpcth-of-wrap" class="">

		<?php if($mpc_theme->get('Version') !== $saved_version) { ?>
		<div id="mpcth_update_msg">
			<h3><?php echo __('Welcome to Blaszok', 'mpcth') . ' ' . $mpc_theme->get('Version') . ' ' . __('update!', 'mpcth'); ?></h3>
			<p><?php _e('We have added some options here to improve your experience with our theme. Please save the panel to update all options after update. Thanks!', 'mpcth'); ?></p>
			<p><?php _e('We try our best to make it issues free but some bugs might still be there waiting to appear. If you found any issues or need help, please feel free to send us a support ticket and we will write back to you as soon as possible :) Visit ', 'mpcth'); ?><a href="http://mpc.ticksy.com" target="_blank"><?php _e('our support', 'mpcth'); ?></a>.</p>
		</div>
		<?php } ?>

		<div id="mpcth-of-metabox" class="">
			<div id="mpcth-of-header">
				<span class="mpcth-of-logo"></span>
				<h2><?php _e('Welcome to Massive Panel', 'mpcth'); ?></h2>
				<h3><?php _e('use it wisely to customize your theme.', 'mpcth'); ?></h3>
				<a href="http://mpc.ticksy.com" class="mpcth-of-support" target="_blank"><?php _e('Support', 'mpcth'); ?></a>
			</div>
			<div class="mpcth-of-nav-tab-wrapper">
				<?php echo mpcth_optionsframework_tabs(); ?>
			</div>
			<div class="mpcth-of postbox">
				<form id="mpcth_theme_panel" action="options.php" method="post">
				<?php settings_fields('mpcth_optionsframework'); ?>
				<?php mpcth_optionsframework_fields(); /* Settings */ ?>
				<div id="optionsframework-submit">
					<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e('Save Options', 'mpcth'); ?>" />
					<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e('Restore Defaults', 'mpcth'); ?>" onclick="return confirm( '<?php print esc_js(__('If you want to reset all settings to default values click OK. All your changes will be overwriten.', 'mpcth')); ?>' );" />
					<div class="ajax-indicator"></div>
					<div class="ajax-message" class="">
						<div class="ajax-label ajax-saved"><?php _e('Options and styles saved.', 'mpcth'); ?></div>
						<div class="ajax-label ajax-options"><?php _e('Only options were saved. Try again.', 'mpcth'); ?></div>
						<div class="ajax-label ajax-styles"><?php _e('Only styles were saved. Try again.', 'mpcth'); ?></div>
						<div class="ajax-label ajax-error"><?php _e('Something went wrong. Try again.', 'mpcth'); ?></div>
					</div>
					<div class="clear"></div>
				</div>
				</form>
			</div>
		</div>
		<?php do_action('mpcth_optionsframework_after'); ?>
		<div class="clear version-info"><?php echo $mpc_theme->get('Name'); ?> Theme v<?php echo $mpc_theme->get('Version'); ?></div>
	</div>
	<form id="mpcth_import_settings" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" method="post">
		<input type="hidden" name="action" value="mpcth_import_settings">
		<input type="hidden" name="panel_url" value="" id="mpcth_panel_url">
		<input id="import_settings_button" class="import_button button mpcth-of-gray-button" type="submit" value="Import Settings" rel="import" disabled="disabled">
		<input type="file" name="import_settings_file" id="import_settings_file">
	</form>
	<input id="export_settings_button" class="export_button button mpcth-of-gray-button" type="button" value="Export Settings" rel="export">

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

		return $clean;
	}

}

/* ---------------------------------------------------------------- */
/* AJAX Save
/* ---------------------------------------------------------------- */

add_action('wp_ajax_mpcth_save_panel_options', 'mpcth_save_panel_options');
function mpcth_save_panel_options() {
	$clean = array();
	$mpcth_options = mpcth_optionsframework_options();

	$input = array();
	parse_str($_POST['data'], $input);

	if(isset($input['option_page']) && $input['option_page'] != 'mpcth_optionsframework')
		die('0');

	$input = $input['mpcth_options_theme_customizer'];

	foreach ($mpcth_options as $mpcth_option) {
		if (!isset($mpcth_option['id'])) {
			continue;
		}

		if (!isset($mpcth_option['type'])) {
			continue;
		}

		$id = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($mpcth_option['id']));

		// Set checkbox to false if it wasn't sent in the $_POST
		if ('checkbox' == $mpcth_option['type'] && ! isset($input[$id])) {
			$input[$id] = false;
		}

		// Set each item in the multicheck to false if it wasn't sent in the $_POST
		if ('multicheck' == $mpcth_option['type'] && ! isset($input[$id])) {
			foreach ($mpcth_option['options'] as $key => $value) {
				$input[$id][$key] = false;
			}
		}

		// For a value to be submitted to database it must pass through a sanitization filter
		if (has_filter('mpcth_of_sanitize_' . $mpcth_option['type'])) {
			$clean[$id] = apply_filters('mpcth_of_sanitize_' . $mpcth_option['type'], $input[$id], $mpcth_option);
		}
	}

	if(!is_array(get_option('mpcth_options_theme_customizer'))) {
		$options = array();
	} else {
		$options = get_option('mpcth_options_theme_customizer');
	}

	if($clean != $options) {
		if(update_option('mpcth_options_theme_customizer', $clean)) {
			$result = 1;
		} else {
			$result = 0;
		}
	} else {
		$result = 1;
	}

	$result += mpcth_update_custom_styles();

	die((string)$result);
}

/* ---------------------------------------------------------------- */
/* AJAX Export
/* ---------------------------------------------------------------- */

add_action('wp_ajax_mpcth_export_settings', 'mpcth_export_settings');
function mpcth_export_settings() {
	$options = get_option(MPC_OPTIONS_NAME);

	if(is_multisite()) {
		$url = wp_upload_dir();
		$old_url = $url['baseurl'];
	} else {
		$old_url = content_url();
	}

	array_walk_recursive($options, 'replace_base_url', array($old_url, '__BASE_URL__'));

	header('Content-Disposition: attachment; filename="mpc_panel_settings.mps"');

	echo json_encode($options);

	die();
}

function replace_base_url(&$item, $key, $urls) {
	$item = str_replace($urls[0], $urls[1], $item);
}

/* ---------------------------------------------------------------- */
/* AJAX Import
/* ---------------------------------------------------------------- */

add_action('wp_ajax_mpcth_import_settings', 'mpcth_import_settings');
function mpcth_import_settings($inner_call = false) {
	try{
		$import_file_path = $_FILES["import_settings_file"]["tmp_name"];

		if(file_exists($import_file_path) == false) {
			echo '<h3>' . __('Wrong file uploaded.', 'mpcth') . '</h3>';
		}
		else {
			$import_data = @file_get_contents($import_file_path);

			$import_array = json_decode($import_data, true);

			// if(is_multisite()) {
				$url = wp_upload_dir();
				$new_url = str_replace( '/uploads', '', $url['baseurl'] );
			// } else {
			// 	$new_url = content_url();
			// }

			array_walk_recursive($import_array, 'replace_base_url', array('__BASE_URL__', $new_url));

			if(empty($import_array))
				echo '<h3>' . __('Empty file content.', 'mpcth') . '</h3>';
			else {
				echo '<h3>' . __('Importing...', 'mpcth') . '</h3>';
				$options = get_option(MPC_OPTIONS_NAME);

				if(isset($options)) {
					// unregister_setting(MPC_OPTIONS_NAME, MPC_OPTIONS_NAME, 'mp_validate_options');

					$options = $import_array;

					update_option(MPC_OPTIONS_NAME, $options);

					// register_setting(MPC_OPTIONS_NAME, MPC_OPTIONS_NAME, 'mp_validate_options');

					echo '<h4>' . __('All settings were imported.', 'mpcth') . '</h4>';
					echo '<script>location.href = "' . $_REQUEST['panel_url'] . '"</script>';
				} else {
					echo __('Something went wrong. Please try again.', 'mpcth');
				}
			}

		}
	} catch(Exception $error) {
		echo __('Something went wrong. Please try again.', 'mpcth');
	}

	if(!empty($_REQUEST['panel_url']))
		echo '<a href="' . $_REQUEST['panel_url'] . '">' . __('Return to panel', 'mpcth') . '</a>';

	if (! $inner_call)
		die();
}

/* ---------------------------------------------------------------- */
/* Custom CSS file
/* ---------------------------------------------------------------- */

function mpcth_update_custom_styles() {
	$mpcth_options = get_option(MPC_OPTIONS_NAME);

	/* Panel main color */
	$main_color = isset($mpcth_options['mpcth_color_main']) ? $mpcth_options['mpcth_color_main'] : '#B163A3';
	$base_font_size = isset($mpcth_options['mpcth_base_font_size']) ? $mpcth_options['mpcth_base_font_size'] : '12px';

	$custom_styles = "
body
		{ font-size: $base_font_size; }

#mpcth_page_wrap #mpcth_sidebar a:hover,#mpcth_page_wrap #mpcth_footer a:hover,#mpcth_page_wrap #mpcth_header_area a:hover, a
		{ color: $main_color; }

#mpcth_page_wrap .mpcth-color-main-color,#mpcth_page_wrap .mpcth-color-main-color-hover:hover
		{ color: $main_color; }

#mpcth_page_wrap .mpcth-color-main-background,
#mpcth_page_wrap .mpcth-color-main-background-hover:hover,
#mpcth_page_wrap #mpcth_load_more.mpcth-color-main-background-hover:hover,
#mpcth_page_wrap #mpcth_shop_load_more.mpcth-color-main-background-hover:hover,
#mpcth_page_wrap .esg-loadmore:hover,
#mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more:hover
		{ background-color: $main_color; }

#mpcth_page_wrap .mpcth-color-main-border,#mpcth_page_wrap .mpcth-color-main-border-hover:hover
		{ border-color: $main_color !important; }

.bbpress #mpcth_content .bbp-replies .reply .bbp-reply-header .bbp-reply-permalink:hover,
.bbpress #mpcth_content .bbp-replies .topic .bbp-reply-header .bbp-reply-permalink:hover,
.bbpress #mpcth_content .bbp-replies .reply .bbp-reply-admin-links .bbp-admin-links a:hover,
.bbpress #mpcth_content .bbp-replies .topic .bbp-reply-admin-links .bbp-admin-links a:hover,
.bbpress #mpcth_content #bbp-user-wrapper #bbp-single-user-details #bbp-user-navigation .current a,
.bbpress #mpcth_content #bbp-user-wrapper #bbp-single-user-details #bbp-user-navigation a:hover,
.mpc-vc-newsletter #mpcth_newsletter .mpcth-newsletter-subscribe input:hover,
.mpc-vc-newsletter #mpcth_newsletter .mc4wp-form input[type=submit]:hover,
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_controls_wrap #mpcth_controls_container > a.active, #mpcth_page_wrap #mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_controls_wrap #mpcth_controls_container > a:hover,#jckqv .woocommerce-product-rating .star-rating span:before,#mpcth_page_wrap .woocommerce .mpcth-post-header .mpcth-quick-view .fa:hover,.woocommerce-page #mpcth_page_wrap .mpcth-post-header .mpcth-quick-view .fa:hover,#mpcth_page_wrap .woocommerce .mpcth-post-header .yith-wcwl-add-to-wishlist .fa:hover,.woocommerce-page #mpcth_page_wrap .mpcth-post-header .yith-wcwl-add-to-wishlist .fa:hover,#mpcth_back_to_top:hover,.woocommerce #mpcth_page_wrap .mpcth-shop-style-slim .products .product .mpcth-post-content .fa,.woocommerce #mpcth_page_wrap .mpcth-shop-style-slim .products .product .mpcth-post-content a:hover,.woocommerce #mpcth_page_wrap .mpcth-shop-style-slim .products .product .mpcth-post-content .add_to_cart_button i,.woocommerce #mpcth_page_wrap .mpcth-shop-style-center .products .product .mpcth-post-content .fa,.woocommerce #mpcth_page_wrap .mpcth-shop-style-center .products .product .mpcth-post-content a:hover,#mpcth_page_wrap .woocommerce .mpcth-shop-style-slim .products .product .mpcth-post-content .fa,#mpcth_page_wrap .woocommerce .mpcth-shop-style-slim .products .product .mpcth-post-content a:hover,#mpcth_page_wrap .woocommerce .mpcth-shop-style-slim .products .product .mpcth-post-content .add_to_cart_button i,#mpcth_page_wrap .woocommerce .mpcth-shop-style-center .products .product .mpcth-post-content .fa,#mpcth_page_wrap .woocommerce .mpcth-shop-style-center .products .product .mpcth-post-content a:hover,.page-template-template-blog-php #mpcth_content .mpcth-post .mpcth-post-title > a:hover,.archive #mpcth_page_wrap #mpcth_content .mpcth-post .mpcth-post-title > a:hover,#mpcth_page_wrap .mpcth-mobile-menu .page_item > a:hover,#mpcth_page_wrap .mpcth-mobile-menu .menu-item > a:hover,#mpcth_page_wrap .mpcth-mobile-menu .page_item.current-menu-item > a,#mpcth_page_wrap .mpcth-mobile-menu .menu-item.current-menu-item > a,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .summary .stock.out-of-stock,.woocommerce-wishlist #mpcth_page_wrap #mpcth_content .yith-wcwl-share li a:hover,#mpcth_page_wrap .wpcf7 .contact-form-input label,#mpcth_page_wrap .wpcf7 .contact-form-message label,#mpcth_page_wrap .woocommerce.widget.widget_layered_nav .chosen a,#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter input[type=submit]:hover,#mpcth_page_wrap #mpcth_smart_search_wrap .mpcthSelect,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .star-rating span,#mpcth_page_wrap .widget_product_categories .product-categories .cat-item.current-cat > a,#mpcth_page_wrap .products .product .mpcth-post-content .product_type_variable:hover,#mpcth_page_wrap .products .product .mpcth-post-content .add_to_cart_button:hover,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs #review_form_wrapper .stars a:hover,#mpcth_page_wrap #mpcth_comments #mpcth_comments_wrap .mpcth-comment-header a:hover,#mpcth_page_wrap .widget .product_list_widget li .star-rating > span,#mpcth_page_wrap .widget .product_list_widget li a,#mpcth_page_wrap #mpcth_main .nivoSlider .nivo-directionNav a,#mpcth_page_wrap #mpcth_main .rev_slider_wrapper .tparrows,#mpcth_page_wrap #mpcth_main .flexslider .flex-direction-nav a,#mpcth_page_wrap #mpcth_main .widget a:hover,#mpcth_page_wrap #mpcth_main .widget.widget_text a,#mpcth_page_wrap .widget.mpc-w-twitter-widget a,#mpcth_page_wrap .mpc-sc-tooltip-wrap .mpc-sc-tooltip-text,#mpcth_page_wrap #mpcth_smart_search_wrap select,#mpcth_page_wrap #mpcth_smart_search_wrap input,#mpcth_page_wrap #mpcth_page_header_secondary_content a:hover,#mpcth_page_wrap #mpcth_main .vc_text_separator > div,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li.active a,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li:hover a,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-accordions h6.active a,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-accordions h6:hover a,.woocommerce-page #mpcth_page_wrap .woocommerce-breadcrumb a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_accordion_header.ui-state-active a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_accordion_header:hover a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle.wpb_toggle_title_active .mpcth-title-wrap,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle:hover .mpcth-title-wrap,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle.wpb_toggle_title_active .mpcth-toggle-mark,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle:hover .mpcth-toggle-mark,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tabs .wpb_tabs_nav > li.ui-state-active > a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tabs .wpb_tabs_nav > li.ui-state-hover > a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav > li.ui-state-active > a > span,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav > li.ui-state-hover > a > span,#mpcth_page_wrap .mpcth-menu .page_item:hover > a,#mpcth_page_wrap #mpcth_mini_cart a.mpcth-mini-cart-title,#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .mpcth-menu .menu-item:hover > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .mpcth-menu .page_item.current-menu-item > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .mpcth-menu .menu-item.current-menu-item > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav #mpcth_mega_menu .widget ul .menu-item > a:hover,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav #mpcth_mega_menu .widget .sub-container > .sub-menu li > a:hover,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav #mpcth_mega_menu .widget ul .menu-item.current-page-ancestor > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav #mpcth_mega_menu .widget ul .menu-item.current-menu-item > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .current-page-ancestor > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .current-menu-ancestor > a,body #mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .current_page_ancestor > a,#mpcth_page_wrap .widget_nav_menu .page_item.current-menu-item > a,#mpcth_page_wrap .widget_nav_menu .menu-item.current-menu-item > a,#mpcth_page_wrap .widget_nav_menu .current-page-ancestor > a,#mpcth_page_wrap .widget_nav_menu .current-menu-ancestor > a,#mpcth_page_wrap .widget_nav_menu .current_page_ancestor > a,#mpcth_page_wrap .mpcth-socials-list li a:hover,#mpcth_page_wrap #mpcth_content .product .mpcth-post-content .price ins .amount,.woocommerce-page #mpcth_page_wrap #mpcth_content .products .product .mpcth-post-categories a:hover,.page-template-template-portfolio-php #mpcth_page_wrap #mpcth_content .mpcth-post .mpcth-post-content .mpcth-post-categories a:hover,.page-template-template-portfolio-php #mpcth_page_wrap #mpcth_portfolio_sorts li.active,.page-template-template-portfolio-php #mpcth_page_wrap #mpcth_portfolio_filters li.active,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-tabs-list > li a:hover,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-tabs-list > li.vc_active a,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-accordion .vc_tta-panel-heading a:hover,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-accordion .vc_active .vc_tta-panel-heading a,
#mpcth_breadcrumbs a
		{ color: $main_color; }

.woocommerce a.remove {
	color: $main_color !important;
}
.woocommerce a.remove:hover {
	color: red !important;
}

.blog #mpcth_page_wrap  #mpcth_content.mpcth-blog-layout-full-alt .mpcth-post .mpcth-post-footer .mpcth-read-more:hover,
.page-template-template-blog-php #mpcth_page_wrap #mpcth_content.mpcth-blog-layout-full-alt .mpcth-post .mpcth-post-footer .mpcth-read-more:hover {
	background: none !important;
	color: $main_color !important;
}

.mpcth-page .mpcth-page-content .post-password-form input[type=submit],.mpc-vc-newsletter #mpcth_newsletter .mpcth-newsletter-subscribe input,.mpc-vc-newsletter #mpcth_newsletter .mc4wp-form input[type=submit],.page-template-template-blog-php #mpcth_page_wrap #mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more:hover,#mpcth_page_wrap .format-chat .mpcth-post-thumbnail .mpcth-chat-message-odd .mpcth-chat-message-text,#mpcth_page_wrap .gform_wrapper input[type=submit]:hover,.bbpress #mpcth_content .bbp-body .bbp-topic-pagination a:hover,.bbpress #mpcth_page_wrap #mpcth_content .button:hover,#mpcth_mini_search #searchsubmit:hover, #jckqv #jckqv_summary .onsale,#jckqv #jckqv_summary .yith-wcwl-add-to-wishlist a:hover,#jckqv #jckqv_summary .single_add_to_cart_button,#jckqv #jckqv_summary h1:after,#jckqv #jckqv_summary .product_meta:after,.woocommerce-wishlist #mpcth_page_wrap #mpcth_content a.button,#mpcth_page_wrap #mpcth_mini_cart .button:hover,#mpcth_page_wrap #mpcth_mini_cart .button.alt,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .summary .yith-wcwl-add-to-wishlist a:hover,.page-template-template-blog-php #mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more:hover,.archive #mpcth_page_wrap #mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more:hover,.blog #mpcth_page_wrap #mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more:hover,.woocommerce-page.single-product #mpcth_page_wrap .cart .quantity .plus-wrap:hover,.woocommerce-page.single-product #mpcth_page_wrap .cart .quantity .minus-wrap:hover,.woocommerce-cart #mpcth_page_wrap .cart .quantity .plus-wrap:hover,.woocommerce-cart #mpcth_page_wrap .cart .quantity .minus-wrap:hover,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_separator.mpcth-separator .vc_sep_holder_l .vc_sep_line:before,#mpcth_page_wrap #mpcth_smart_search_wrap #searchsubmit,#mpcth_page_wrap .s2_form_widget form input[type=submit]:hover,#mpcth_page_wrap .mpcth-menu-label-hot,#mpcth_page_wrap .bra-photostream-widget ul li:hover a,.woocommerce-page.single-product #mpcth_page_wrap .cart .single_add_to_cart_button:hover,.woocommerce-cart #mpcth_page_wrap .cart .single_add_to_cart_button:hover,#mpcth_page_wrap .wpcf7 .form-submit .wpcf7-submit:hover,#mpcth_page_wrap #review_form_wrapper #submit:hover,#mpcth_page_wrap .widget #searchform #searchsubmit:hover,#mpcth_page_wrap .widget #searchform #searchsubmit.alt,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta:after,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_share:after,#mpcth_page_wrap .woocommerce #review_form_wrapper #submit:hover,#mpcth_page_wrap .woocommerce button.button:hover,#mpcth_page_wrap .woocommerce input.button:hover,#mpcth_page_wrap .woocommerce a.button:hover,.woocommerce #mpcth_page_wrap #review_form_wrapper #submit:hover,.woocommerce #mpcth_page_wrap button.button:hover,.woocommerce #mpcth_page_wrap input.button:hover,.woocommerce #mpcth_page_wrap a.button:hover,#mpcth_page_wrap .woocommerce #review_form_wrapper #submit.alt,#mpcth_page_wrap .woocommerce button.button.alt,#mpcth_page_wrap .woocommerce input.button.alt,#mpcth_page_wrap .woocommerce a.button.alt,.woocommerce #mpcth_page_wrap #review_form_wrapper #submit.alt,.woocommerce #mpcth_page_wrap button.button.alt,.woocommerce #mpcth_page_wrap input.button.alt,.woocommerce #mpcth_page_wrap a.button.alt,#mpcth_page_wrap #mpcth_main .wpb_separator:before,#mpcth_page_wrap #mpcth_main .vc_text_separator:before,#mpcth_page_wrap .woocommerce.widget.widget_layered_nav_filters .chosen a,#mpcth_page_wrap #mpcth_page_header_content #mpcth_controls_wrap #mpcth_controls_container > a:hover,#mpcth_page_wrap #mpcth_page_header_content #mpcth_controls_wrap #mpcth_controls_container > a.active,#mpcth_page_wrap .woocommerce.widget.widget_price_filter .ui-slider-handle,#mpcth_page_wrap .woocommerce.widget.widget_price_filter .ui-slider-range,#mpcth_page_wrap .woocommerce.widget.widget_price_filter .button:hover,#mpcth_page_wrap #mpcth_comments #respond #mpcth_comment_form .form-submit input:hover,.blog #mpcth_page_wrap #mpcth_content .post .mpcth-post-thumbnail .mpcth-lightbox,.page-template-template-blog-php #mpcth_page_wrap #mpcth_content .post .mpcth-post-thumbnail .mpcth-lightbox,#mpcth_page_wrap #mpcth_main .vc_carousel .vc_carousel-indicators li.vc_active,#mpcth_page_wrap #mpcth_main .wpb_posts_slider .nivo-controlNav a,#mpcth_page_wrap #mpcth_main .flexslider .flex-control-nav li a,#mpcth_page_wrap #mpcth_main .rev_slider_wrapper .tp-bullets .tp-bullet
		{ background-color: $main_color; }

.mpcth-page .mpcth-page-content .post-password-form input[type=submit],.mpcth-page .mpcth-page-content .post-password-form input[type=submit]:hover,#mpcth_back_to_top:hover,#mpcth_page_wrap .mpc-sc-tooltip-wrap .mpc-sc-tooltip-text,#mpcth_page_wrap .mpcth-deco-header span,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs #review_form_wrapper #reply-title,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li.active a,.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li:hover a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_accordion_header.ui-state-active a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_accordion_header:hover a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle.wpb_toggle_title_active .mpcth-title-wrap,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle:hover .mpcth-title-wrap,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle.wpb_toggle_title_active .mpcth-toggle-mark,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle:hover .mpcth-toggle-mark,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tabs .wpb_tabs_nav > li.ui-state-active > a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tabs .wpb_tabs_nav > li.ui-state-hover > a,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav > li.ui-state-active > a > span,#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav > li.ui-state-hover > a > span,#mpcth_page_wrap #mpcth_comments #reply-title,#mpcth_page_wrap #mpcth_main .vc_carousel .vc_carousel-indicators li.vc_active,#mpcth_page_wrap #mpcth_main .wpb_posts_slider .nivo-controlNav a.active,#mpcth_page_wrap #mpcth_main .flexslider .flex-control-nav li a.flex-active,#mpcth_page_wrap #mpcth_main .rev_slider_wrapper .tp-bullets .tp-bullet.selected,#mpcth_page_wrap .page_item.menu-item-has-children:after,#mpcth_page_wrap .menu-item.menu-item-has-children:after,#mpcth_page_wrap .page_item.menu-item-has-children:after,#mpcth_page_wrap .menu-item.menu-item-has-children:after,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-tabs-list > li a:hover,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-tabs-list > li.vc_active a,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-accordion .vc_tta-panel-heading a:hover span,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_tta-container .vc_tta-accordion .vc_active .vc_tta-panel-heading a span
{ border-color: $main_color; }

.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-accordions h6.active a span,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-accordions h6:hover a span,
#mpcth_page_wrap #mpcth_main .wpb_call_to_action.cta_align_bottom .wpb_button_a:after,
#mpcth_main .vc_cta3.vc_cta3-align-bottom .vc_btn3:after
		{ border-bottom-color: $main_color; }

#mpcth_page_wrap .mpcth-list-item:before,#mpcth_page_wrap ul li:before, #mpcth_page_wrap #mpcth_main ul li:before,ol li:before,#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter .mpcth-newsletter-toggle:before,#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter form:before,#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter .mpcth-newsletter-subscribe:before,#mpcth_page_wrap #mpcth_main .wpb_call_to_action.cta_align_left .wpb_button_a:after,
#mpcth_main .vc_cta3.vc_cta3-align-left .vc_btn3:after
		{ border-left-color: $main_color; }

#mpcth_page_wrap #mpcth_main .wpb_call_to_action.cta_align_right .wpb_button_a:after ,
#mpcth_main .vc_cta3.vc_cta3-align-right .vc_btn3:after
		{ border-right-color: $main_color; }

#jckqv #jckqv_summary .mpcth-sale-wrap:before, #mpcth_page_wrap .woocommerce .mpcth-sale-wrap:before, .woocommerce-page #mpcth_page_wrap .mpcth-sale-wrap:before
		{ border-bottom-color: " . mpcth_adjust_brightness($main_color, -25) . "; }

#mpcth_page_wrap .woocommerce .mpcth-sale-wrap:after, .woocommerce-page #mpcth_page_wrap .mpcth-sale-wrap:after
		{ border-left-color: " . mpcth_adjust_brightness($main_color, -25) . "; }

#jckqv #jckqv_summary .mpcth-sale-wrap:after, #mpcth_page_wrap .mpcth-thumbs-sale-swap #jckWooThumbs_img_wrap + .mpcth-sale-wrap:after
		{ border-right-color: " . mpcth_adjust_brightness($main_color, -25) . "; }

#mpcth_page_wrap #mpcth_smart_search_wrap #s::-webkit-input-placeholder,#mpcth_page_wrap #mpcth_smart_search_wrap #s::-webkit-input-placeholder
		{ color: $main_color; }

#mpcth_page_wrap #mpcth_smart_search_wrap #s:-moz-placeholder,#mpcth_page_wrap #mpcth_smart_search_wrap #s:-moz-placeholder
		{ color: $main_color; }

#mpcth_page_wrap #mpcth_smart_search_wrap #s::-moz-placeholder,#mpcth_page_wrap #mpcth_smart_search_wrap #s::-moz-placeholder
		{ color: $main_color; }

#mpcth_page_wrap #mpcth_smart_search_wrap #s:-ms-input-placeholder,#mpcth_page_wrap #mpcth_smart_search_wrap #s:-ms-input-placeholder
		{ color: $main_color; }

.mpcth-skin-dark .mpcth-cart-wrap i, .mpcth-skin-dark .mpcth-cart-wrap a:hover,
.mpcth-skin-dark .mpcth-post-content-wrap .mpcth-post-title a:hover
		{ color: $main_color !important; }
		";

	if (isset($mpcth_options['mpcth_content_font']) && is_array($mpcth_options['mpcth_content_font'])) {
		if ($mpcth_options['mpcth_content_font']['type'] == 'google') {
			$content_family = str_replace(' ', '+', $mpcth_options['mpcth_content_font']['family']);
			$content_style = $mpcth_options['mpcth_content_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_content_font']['style'] : '';
		}
	}
	if (isset($mpcth_options['mpcth_heading_font']) && is_array($mpcth_options['mpcth_heading_font'])) {
		if ($mpcth_options['mpcth_heading_font']['type'] == 'google') {
			$heading_family = str_replace(' ', '+', $mpcth_options['mpcth_heading_font']['family']);
			$heading_style = $mpcth_options['mpcth_heading_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_heading_font']['style'] : '';
		}
	}
	if (isset($mpcth_options['mpcth_menu_font']) && is_array($mpcth_options['mpcth_menu_font'])) {
		if ($mpcth_options['mpcth_menu_font']['type'] == 'google') {
			$menu_family = str_replace(' ', '+', $mpcth_options['mpcth_menu_font']['family']);
			$menu_style = $mpcth_options['mpcth_menu_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_menu_font']['style'] : '';
		}
	}
	/* Custom font family */
	if (isset($content_family)) {
		$custom_styles .= "
html, body, #jckqv,
#mpcth_page_wrap .mpcthSelect .mpcthSelectInner,
#mpcth_page_wrap .woocommerce .woocommerce-ordering .mpcthSelect .mpcthSelectInner,
.woocommerce-page #mpcth_page_wrap .woocommerce-ordering .mpcthSelect .mpcthSelectInner,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .summary .variations_form .variations .value .mpcthSelect .mpcthSelectInner,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .sku_wrapper span,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .sku_wrapper a,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .posted_in span,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .posted_in a,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .tagged_as span,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .tagged_as a,
#mpcth_page_wrap .woocommerce.widget.widget_layered_nav .chosen a:before,
#jckqv #jckqv_summary .mpcthSelect .mpcthSelectInner {";
			$custom_styles .= "font-family: " . str_replace('+', ' ', $content_family) . ";";
			if (!empty($mpcth_options['mpcth_content_font']['font-style'])) {
				$custom_styles .= "font-style: {$mpcth_options['mpcth_content_font']['font-style']};";
			}
			if (!empty($mpcth_options['mpcth_content_font']['font-weight']) && $mpcth_options['mpcth_content_font']['font-weight'] != 'regular') {
				$custom_styles .= "font-weight: {$mpcth_options['mpcth_content_font']['font-weight']};";
			}
		$custom_styles .= "}";
	}
	if (isset($heading_family)) {
		$custom_styles .= "
h1, h2, h3, h4, h5, h6,
#jckqv h1, #jckqv h2, #jckqv h3, #jckqv h4, #jckqv h5, #jckqv h6,
#mpcth_page_wrap #mpcth_mini_cart .mpcth-mini-cart-products .mpcth-mini-cart-title,
#mpcth_page_wrap #mpcth_mini_cart .mpcth-mini-cart-subtotal,
#mpcth_page_wrap #mpcth_main .widget .product_list_widget li a,
#mpcth_page_wrap #mpcth_header_area .widget .product_list_widget li a,
#mpcth_page_wrap #mpcth_footer .widget .product_list_widget li a,
#mpcth_page_wrap .widget.widget_shopping_cart .total,
#mpcth_page_wrap #mpcth_footer .mpc-sc-portfolio-meta li .mpcth-portfolio-meta-name,
#mpcth_page_wrap #mpcth_main .mpc-sc-portfolio-meta li .mpcth-portfolio-meta-name,
#mpcth_page_wrap #mpcth_footer .mpc-vc-icon-column-wrap .mpc-vc-icon-column-content .mpc-vc-icon-column-title,
#mpcth_page_wrap #mpcth_main .mpc-vc-icon-column-wrap .mpc-vc-icon-column-content .mpc-vc-icon-column-title,
#mpcth_page_wrap #mpcth_footer .mpc-vc-quote p .mpc-vc-quote-left,
#mpcth_page_wrap #mpcth_footer .mpc-vc-quote p .mpc-vc-quote-right,
#mpcth_page_wrap #mpcth_main .mpc-vc-quote p .mpc-vc-quote-left,
#mpcth_page_wrap #mpcth_main .mpc-vc-quote p .mpc-vc-quote-right,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_accordion_header,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tabs .wpb_tabs_nav > li > a,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav > li > a,
#mpcth_main .wpb_call_to_action,
.woocommerce-cart #mpcth_page_wrap .mpcth-page-content > .woocommerce > form .shop_table_wrap .shop_table .product-name a,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li a,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .sku_wrapper,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .posted_in,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta .tagged_as,
.woocommerce-checkout #mpcth_page_wrap #mpcth_content .shop_table tfoot th,
.woocommerce-wishlist #mpcth_page_wrap #mpcth_content .shop_table .product-name a,
#yith-wcwl-popup-message,
.vc_tta-title-text {";
			$custom_styles .= "font-family: " . str_replace('+', ' ', $heading_family) . ";";
			if (!empty($mpcth_options['mpcth_heading_font']['font-style'])) {
				$custom_styles .= "font-style: {$mpcth_options['mpcth_heading_font']['font-style']};";
			}
			if (!empty($mpcth_options['mpcth_heading_font']['font-weight']) && $mpcth_options['mpcth_heading_font']['font-weight'] != 'regular') {
				$custom_styles .= "font-weight: {$mpcth_options['mpcth_heading_font']['font-weight']};";
			}
		$custom_styles .= "}";
	}
	if (isset($menu_family)) {
		$custom_styles .= "
#mpcth_page_wrap #mpcth_nav_mobile,
#mpcth_page_wrap #mpcth_nav {";
			$custom_styles .= "font-family: " . str_replace('+', ' ', $menu_family) . ";";
			if (!empty($mpcth_options['mpcth_menu_font']['font-style'])) {
				$custom_styles .= "font-style: {$mpcth_options['mpcth_menu_font']['font-style']};";
			}
			if (!empty($mpcth_options['mpcth_menu_font']['font-weight']) && $mpcth_options['mpcth_menu_font']['font-weight'] != 'regular') {
				$custom_styles .= "font-weight: {$mpcth_options['mpcth_menu_font']['font-weight']};";
			}
		$custom_styles .= "}";
	}

	/* Dropdown backgrounds */
	$menu_id = get_nav_menu_locations();
	if(isset($menu_id['mpcth_menu'])) {
		$menu_items = wp_get_nav_menu_items($menu_id['mpcth_menu']);

		if (! empty($menu_items))
			foreach ($menu_items as $item) {
				if ($item->menu_item_parent === '0') {
					$custom_styles .= "#mpcth_page_wrap #mpcth_mega_menu .menu-item-$item->ID > .sub-container > .sub-menu {";

					if (isset($mpcth_options['mpcth_menu_bg_image_' . $item->object_id]) && $mpcth_options['mpcth_menu_bg_image_' . $item->object_id] != '') {
						$custom_styles .= "background-image: url('" . $mpcth_options['mpcth_menu_bg_image_' . $item->object_id] . "');";
						$custom_styles .= "background-repeat: no-repeat;";
					}
					if (isset($mpcth_options['mpcth_menu_bg_align_' . $item->object_id]) && $mpcth_options['mpcth_menu_bg_align_' . $item->object_id] != '') {
						$custom_styles .= "background-position: " . $mpcth_options['mpcth_menu_bg_align_' . $item->object_id] . ";";
					} else {
						$custom_styles .= "background-position: bottom center;";
					}
					if (isset($mpcth_options['mpcth_menu_bg_padding_' . $item->object_id]) && $mpcth_options['mpcth_menu_bg_padding_' . $item->object_id] != '')
						$custom_styles .= "padding: 1.5em " . $mpcth_options['mpcth_menu_bg_padding_' . $item->object_id] . ";";

					$custom_styles .= "}";
				}
			}
	}

	/* Custom colors */
	$enable_header_image = $mpcth_options['mpcth_colors_header_enable_image'];
	$enable_header_area_image = $mpcth_options['mpcth_colors_header_area_enable_image'];
	$enable_footer_image = $mpcth_options['mpcth_colors_footer_enable_image'];
	$enable_footer_ex_image = $mpcth_options['mpcth_colors_footer_ex_enable_image'];

	if (! empty($mpcth_options['mpcth_use_advance_colors']) && $mpcth_options['mpcth_use_advance_colors']) {
		// Header colors
		$custom_styles .= '
#mpcth_page_header_wrap #mpcth_header_section
		{ background-color: ' . $mpcth_options['mpcth_colors_header_background'] . '; }

#mpcth_page_header_wrap #mpcth_header_section {';

if( !empty( $enable_header_image ) && $enable_header_image ) {
	$custom_styles .= 'background-repeat:' . $mpcth_options['mpcth_colors_header_bg_repeat'] . ';';
	$custom_styles .= 'background-size: ' . $mpcth_options['mpcth_colors_header_bg_size'] . ';';
	$custom_styles .= $mpcth_options['mpcth_colors_header_bg_align'] ? 'background-position:' . $mpcth_options['mpcth_colors_header_bg_align'] . ';' : '';

	$custom_styles .= 'background-image:url('. $mpcth_options['mpcth_colors_header_bg_image'] .');';
}

$custom_styles .= '}

#mpcth_page_header_wrap #mpcth_header_section #mpcth_mega_menu .sub-container > .sub-menu:after,
#mpcth_header_section #mpcth_mini_cart:after,
#mpcth_page_wrap #mpcth_mini_search:after,
#mpcth_page_wrap #mpcth_page_header_wrap .sub-menu:after
		{ border-top-color: ' . $mpcth_options['mpcth_colors_header_background'] . '; }

#mpcth_page_header_wrap #mpcth_header_section,
#mpcth_nav .mpcth-menu .page_item.menu-item-has-children > a:after,
#mpcth_nav .mpcth-menu .menu-item.menu-item-has-children > a:after,
#mpcth_header_section #mpcth_page_header_content #mpcth_mega_menu .menu-item-has-children > a:after
		{ border-color: ' . $mpcth_options['mpcth_colors_header_border'] . '; }

#mpcth_page_header_wrap #mpcth_header_section,
#mpcth_page_header_wrap #mpcth_header_section a,
#mpcth_page_header_wrap #mpcth_header_section #mpcth_nav a,
#mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a
		{ color: ' . $mpcth_options['mpcth_colors_header_font'] . '; }

#mpcth_header_section #mpcth_page_header_content #mpcth_controls_wrap #mpcth_controls_container > a.active,
#mpcth_header_section #mpcth_page_header_content #mpcth_controls_wrap #mpcth_controls_container > a:hover
		{ background-color: ' . $mpcth_options['mpcth_colors_header_active'] . '; }

#mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a.active,
#mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a:hover,
#mpcth_page_header_wrap.mpcth-sticky-header.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a.active,
#mpcth_page_header_wrap.mpcth-sticky-header.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a:hover
		{ color: ' . $mpcth_options['mpcth_colors_header_active'] . '; }

#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_header_section a:hover,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_header_section #mpcth_nav .current-menu-ancestor > a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_header_section #mpcth_nav .current-menu-item > a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_header_section #mpcth_nav #mpcth_mega_menu .current-menu-item > a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_header_section #mpcth_nav #mpcth_mega_menu a:hover,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_header_section #mpcth_nav a:hover,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .mpcth-menu .menu-item:hover > a,
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav .current-menu-ancestor > a,
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav .current-menu-item > a,
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav #mpcth_mega_menu .current-menu-item > a,
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav #mpcth_mega_menu a:hover,
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav a:hover
		{ color: ' . $mpcth_options['mpcth_colors_header_active'] . '; }';

		// Secondary header
		$custom_styles .= '
#mpcth_header_second_section
		{ background-color: ' . $mpcth_options['mpcth_colors_header_second_background'] . '; }

#mpcth_page_header_wrap #mpcth_header_second_section,
#mpcth_page_header_wrap #mpcth_page_header_secondary_content,
#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter:before,
#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_secondary_menu:before,
#mpcth_page_wrap #mpcth_secondary_mini_menu:before
		{ border-color: ' . $mpcth_options['mpcth_colors_header_second_border'] . '; }

#mpcth_header_second_section #mpcth_page_header_secondary_content,
#mpcth_header_second_section #mpcth_page_header_secondary_content a,
#mpcth_header_second_section
		{ color: ' . $mpcth_options['mpcth_colors_header_second_font'] . '; }

#mpcth_header_second_section #mpcth_page_header_secondary_content a:hover
		{ color: ' . $mpcth_options['mpcth_colors_header_second_active'] . '; }

#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter form:before,
#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_newsletter .mpcth-newsletter-subscribe:before
		{ border-left-color: ' . $mpcth_options['mpcth_colors_header_second_border'] . '; }';

		// Header Widget Area colors
		$custom_styles .= '
#mpcth_page_wrap #mpcth_toggle_header_area,
#mpcth_page_wrap #mpcth_header_area_wrap
		{ background-color: ' . $mpcth_options['mpcth_colors_header_area_background'] . '; }

#mpcth_page_wrap #mpcth_header_area_wrap {';

if( !empty( $enable_header_area_image ) && $enable_header_area_image ) {
	$custom_styles .= 'background-repeat:' . $mpcth_options['mpcth_colors_header_area_bg_repeat'] . ';';
	$custom_styles .= 'background-size: ' . $mpcth_options['mpcth_colors_header_area_bg_size'] . ';';
	$custom_styles .= $mpcth_options['mpcth_colors_header_area_bg_align'] ? 'background-position:' . $mpcth_options['mpcth_colors_header_area_bg_align'] . ';' : '';

	$custom_styles .= 'background-image:url('. $mpcth_options['mpcth_colors_header_area_bg_image'] .');';
}

$custom_styles .= '
}

#mpcth_page_wrap #mpcth_header_area_wrap #mpcth_header_area .widget-title
		{ border-color: ' . $mpcth_options['mpcth_colors_header_area_border'] . '; }

#mpcth_page_wrap #mpcth_toggle_header_area,
#mpcth_page_wrap #mpcth_header_area
		{ color: ' . $mpcth_options['mpcth_colors_header_area_font'] . '; }

#mpcth_page_wrap #mpcth_toggle_header_area:hover,
#mpcth_page_wrap #mpcth_header_area_wrap #mpcth_header_area a:hover
		{ color: ' . $mpcth_options['mpcth_colors_header_area_active'] . '; }

#mpcth_page_wrap #mpcth_header_area_wrap #mpcth_header_area ul li:before
		{ border-left-color: ' . $mpcth_options['mpcth_colors_header_area_active'] . '; }

#mpcth_page_wrap #mpcth_header_area_wrap #mpcth_header_area .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_header_area_active'] . ' !important; }

#mpcth_page_wrap #mpcth_header_area_wrap #mpcth_header_area .widget-title .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_header_area_heading'] . ' !important; }';

		// Dropdown colors
		$custom_styles .= '
#mpcth_page_wrap #mpcth_mobile_nav_wrap,
#mpcth_simple_mobile_nav_wrap,
#mpcth_page_wrap #mpcth_mini_search,
#mpcth_page_wrap #mpcth_page_header_wrap .mpcth-menu .sub-menu,
#mpcth_page_wrap #mpcth_secondary_mini_menu .sub-menu,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_mega_menu .sub-container > .sub-menu,
#mpcth_page_wrap #mpcth_mini_cart
		{ background-color: ' . $mpcth_options['mpcth_colors_dropdown_background'] . '; }

#mpcth_simple_mobile_nav_wrap,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_mega_menu .sub-container > .sub-menu:before,
#mpcth_page_wrap #mpcth_mini_cart:before,
#mpcth_page_wrap #mpcth_mini_search:before,
#mpcth_page_wrap #mpcth_page_header_wrap .sub-menu:before
		{ border-top-color: ' . $mpcth_options['mpcth_colors_dropdown_border'] . '; }

#mpcth_page_wrap #mpcth_mobile_nav_wrap #mpcth_page_header_secondary_content,
#mpcth_page_wrap #mpcth_mobile_nav_wrap #mpcth_nav_mobile .mpcth-mobile-menu .page_item.page_item_has_children > a,
#mpcth_page_wrap #mpcth_mobile_nav_wrap #mpcth_nav_mobile .mpcth-mobile-menu .menu-item.menu-item-has-children > a,
#mpcth_page_wrap #mpcth_simple_mobile_nav_wrap #mpcth_nav_mobile .mpcth-mobile-menu .page_item.page_item_has_children > a,
#mpcth_page_wrap #mpcth_simple_mobile_nav_wrap #mpcth_nav_mobile .mpcth-mobile-menu .menu-item.menu-item-has-children > a,
#mpcth_page_wrap #mpcth_mini_cart .mpcth-mini-cart-products .mpcth-mini-cart-thumbnail img,
#mpcth_page_wrap #mpcth_mini_search,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_mega_menu .sub-container > .sub-menu,
#mpcth_page_wrap #mpcth_page_header_wrap .sub-menu,
#mpcth_page_wrap #mpcth_secondary_mini_menu .sub-menu,
#mpcth_page_wrap #mpcth_page_header_wrap .widget .mega-hdr-a,
#mpcth_page_wrap #mpcth_mini_cart,
#mpcth_page_wrap #mpcth_mini_cart .mpcth-mini-cart-products
		{ border-color: ' . $mpcth_options['mpcth_colors_dropdown_border'] . '; }

#mpcth_page_wrap #mpcth_mobile_nav_wrap #mpcth_nav_mobile,
#mpcth_page_wrap #mpcth_mobile_nav_wrap #mpcth_nav_mobile a,
#mpcth_page_wrap #mpcth_simple_mobile_nav_wrap #mpcth_nav_mobile,
#mpcth_page_wrap #mpcth_simple_mobile_nav_wrap #mpcth_nav_mobile a,
#mpcth_page_wrap #mpcth_mini_search,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_nav .sub-menu a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_secondary_mini_menu .sub-menu a,
#mpcth_page_wrap #mpcth_mini_cart,
#mpcth_page_wrap #mpcth_mini_cart #mpcth_mini_cart_wrap a.mpcth-mini-cart-title:hover,
#mpcth_page_wrap #mpcth_mini_cart #mpcth_mini_cart_wrap a.alt:hover,
#mpcth_page_wrap #mpcth_mini_cart a
		{ color: ' . $mpcth_options['mpcth_colors_dropdown_font'] . '; }

#mpcth_page_wrap #mpcth_mini_cart .button:hover,
#mpcth_page_wrap #mpcth_mini_cart .button.alt,
#mpcth_page_wrap #mpcth_mini_search #searchsubmit:hover
		{ background-color: ' . $mpcth_options['mpcth_colors_dropdown_active'] . '; }

#mpcth_page_wrap #mpcth_mini_cart .mpcth-mini-cart-subtotal,
#mpcth_page_wrap #mpcth_mini_cart a.mpcth-mini-cart-title,
#mpcth_page_wrap #mpcth_mini_cart a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_secondary_mini_menu .sub-menu a:hover,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_secondary_mini_menu .current-menu-item a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_page_header_container #mpcth_header_section #mpcth_nav .sub-menu .current-menu-ancestor > a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_page_header_container #mpcth_header_section #mpcth_nav .sub-menu .current-menu-item > a,
#mpcth_page_wrap #mpcth_page_header_wrap #mpcth_page_header_container #mpcth_header_section #mpcth_nav .sub-menu a:hover
		{ color: ' . $mpcth_options['mpcth_colors_dropdown_active'] . '; }

#mpcth_page_wrap #mpcth_page_header_wrap .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_dropdown_active'] . ' !important; }';

		// Search colors
		$custom_styles .= '
#mpcth_page_wrap #mpcth_smart_search_wrap
		{ background-color: ' . $mpcth_options['mpcth_colors_search_background'] . '; }

#mpcth_page_wrap #mpcth_smart_search_wrap .mpcthSelect,
#mpcth_page_wrap #mpcth_smart_search_wrap input[type=text]
		{ border-color: ' . $mpcth_options['mpcth_colors_search_border'] . '; }

#mpcth_page_wrap #mpcth_smart_search_wrap
		{ color: ' . $mpcth_options['mpcth_colors_search_font'] . '; }

#mpcth_page_wrap #mpcth_smart_search_wrap #searchsubmit
		{ background-color: ' . $mpcth_options['mpcth_colors_search_active'] . '; }

#mpcth_page_wrap #mpcth_smart_search_wrap select,
#mpcth_page_wrap #mpcth_smart_search_wrap input,
#mpcth_page_wrap #mpcth_smart_search_wrap .mpcthSelect
		{ color: ' . $mpcth_options['mpcth_colors_search_active'] . '; }
#mpcth_page_wrap #mpcth_smart_search_wrap #s::-webkit-input-placeholder,
#mpcth_page_wrap #mpcth_smart_search_wrap #s::-webkit-input-placeholder
		{ color: ' . $mpcth_options['mpcth_colors_search_active'] . '; }
#mpcth_page_wrap #mpcth_smart_search_wrap #s:-moz-placeholder,
#mpcth_page_wrap #mpcth_smart_search_wrap #s:-moz-placeholder
		{ color: ' . $mpcth_options['mpcth_colors_search_active'] . '; }
#mpcth_page_wrap #mpcth_smart_search_wrap #s::-moz-placeholder,
#mpcth_page_wrap #mpcth_smart_search_wrap #s::-moz-placeholder
		{ color: ' . $mpcth_options['mpcth_colors_search_active'] . '; }
#mpcth_page_wrap #mpcth_smart_search_wrap #s:-ms-input-placeholder,
#mpcth_page_wrap #mpcth_smart_search_wrap #s:-ms-input-placeholder
		{ color: ' . $mpcth_options['mpcth_colors_search_active'] . '; }';

		// Sidebar colors
		$custom_styles .= '
.mpcth-sidebar-left #mpcth_page_wrap #mpcth_sidebar,
.mpcth-sidebar-right #mpcth_page_wrap #mpcth_sidebar,
#mpcth_main_container:before
		{ background-color: ' . $mpcth_options['mpcth_colors_sidebar_background'] . '; }

#mpcth_sidebar,
#mpcth_sidebar .widget .widget-title
		{ border-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }

.mpcth-sidebar-left #mpcth_page_wrap #mpcth_sidebar
		{ border-right-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }
.mpcth-sidebar-left #mpcth_page_wrap #mpcth_sidebar .mpcth-sidebar-arrow:before
		{ border-left-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }

.mpcth-sidebar-left #mpcth_page_wrap #mpcth_sidebar .mpcth-sidebar-arrow:after
		{ border-left-color: ' . $mpcth_options['mpcth_colors_sidebar_background'] . '; }

.mpcth-sidebar-left #mpcth_page_wrap #mpcth_content_wrap
		{ border-left-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }

.mpcth-sidebar-right #mpcth_page_wrap #mpcth_sidebar
		{ border-left-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }

.mpcth-sidebar-right #mpcth_page_wrap #mpcth_sidebar .mpcth-sidebar-arrow:before
		{ border-right-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }

.mpcth-sidebar-right #mpcth_page_wrap #mpcth_sidebar .mpcth-sidebar-arrow:after
		{ border-right-color: ' . $mpcth_options['mpcth_colors_sidebar_background'] . '; }

.mpcth-sidebar-right #mpcth_page_wrap #mpcth_content_wrap
		{ border-right-color: ' . $mpcth_options['mpcth_colors_sidebar_border'] . '; }

#mpcth_sidebar,
#mpcth_page_wrap #mpcth_main #mpcth_sidebar .mpc-w-twitter-widget .tweet a:hover
		{ color: ' . $mpcth_options['mpcth_colors_sidebar_font'] . '; }

#mpcth_sidebar .widget #searchform #searchsubmit:hover,
#mpcth_sidebar .widget #searchform #searchsubmit.alt
		{ background-color: ' . $mpcth_options['mpcth_colors_sidebar_active'] . '; }

#mpcth_page_wrap #mpcth_main #mpcth_sidebar .widget a:hover,
#mpcth_page_wrap #mpcth_main #mpcth_sidebar .widget.widget_text a,
#mpcth_page_wrap #mpcth_sidebar .widget.mpc-w-twitter-widget a
		{ color: ' . $mpcth_options['mpcth_colors_sidebar_active'] . '; }

#mpcth_page_wrap #mpcth_sidebar ul li:before
		{ border-left-color: ' . $mpcth_options['mpcth_colors_sidebar_active'] . '; }

#mpcth_page_wrap #mpcth_sidebar .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_sidebar_active'] . ' !important; }

#mpcth_page_wrap #mpcth_sidebar .widget-title .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_sidebar_heading'] . ' !important; }';

		// Content colors
		$custom_styles .= '
#mpcth_page_wrap
		{ background-color: ' . $mpcth_options['mpcth_colors_content_background'] . '; }

.page-template-template-lookbook-php.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:before,
.page-template-template-lookbook-php.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:after,
.page-template-template-fullwidth-php.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:before,
.page-template-template-fullwidth-php.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:after,
.page-template-template-fullwidth-with-sidebar-php.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:before,
.page-template-template-fullwidth-with-sidebar-php.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:after,
.page-template-default.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:before,
.page-template-default.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:after,
.single-product.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:before,
.single-product.mpcth-sidebar-none #mpcth_main_container .mpcth-vc-row-wrap.mpcth-vc-row-wrap-image .mpcth-vc-row-wrap-arrow:after
		{ border-bottom-color: ' . $mpcth_options['mpcth_colors_content_background'] . ' !important; }

.bbpress #mpcth_page_wrap #mpcth_content .bbp-topics,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-replies,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-forums,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-admin-links,
.bbpress #mpcth_page_wrap #mpcth_content .forum .bbp-forum-form,
.bbpress #mpcth_page_wrap #mpcth_content .reply .bbp-reply-form,
.bbpress #mpcth_page_wrap #mpcth_content .topic .bbp-topic-form,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-forum-title,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-reply-title,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-topic-title,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-single-user-details #bbp-user-navigation,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-user-profile .bbp-user-section,
#mpcth_page_wrap .woocommerce .shop_table tbody td,
.woocommerce #mpcth_page_wrap .shop_table tbody td,
.woocommerce-wishlist #mpcth_page_wrap #mpcth_content .shop_table tbody td,
.woocommerce-wishlist #mpcth_page_wrap #mpcth_content .mpcth-mobile-wishlist .mpcth-wishlist-item,
.woocommerce-cart #mpcth_page_wrap #mpcth_content .mpcth-mobile-cart .mpcth-cart-item,
.woocommerce-cart #mpcth_page_wrap .mpcth-page-content > .woocommerce > form .shop_table_wrap .shop_table tbody td
		{ border-top-color: ' . $mpcth_options['mpcth_colors_content_border'] . '; }

.bbpress #mpcth_page_wrap #mpcth_content .bbp-header,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-body .topic,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-body .forum,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-forum-header,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-reply-header,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-topic-header,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-single-user-details #bbp-user-navigation a,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-user-profile .bbp-user-section > p
		{ border-bottom-color: ' . $mpcth_options['mpcth_colors_content_border'] . '; }

@media only screen and (max-width: 480px) {
	.mpcth-responsive .bbpress #mpcth_page_wrap #mpcth_content .bbp-forum-author,
	.mpcth-responsive .bbpress #mpcth_page_wrap #mpcth_content .bbp-reply-author,
	.mpcth-responsive .bbpress #mpcth_page_wrap #mpcth_content .bbp-topic-author
		{ border-bottom-color: ' . $mpcth_options['mpcth_colors_content_border'] . '; }
}

.bbpress #mpcth_page_wrap #mpcth_content .bbp-forum-author,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-reply-author,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-topic-author
		{ border-right-color: ' . $mpcth_options['mpcth_colors_content_border'] . '; }

.bbpress #mpcth_page_wrap #mpcth_content .forum,
.bbpress #mpcth_page_wrap #mpcth_content .reply,
.bbpress #mpcth_page_wrap #mpcth_content .topic,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-form,
.bbpress #mpcth_page_wrap #mpcth_content .bbp-form legend,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-your-profile .bbp-form,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-your-profile .bbp-form legend,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper #bbp-your-profile .bbp-form .bbp-form .description,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper .subscription-toggle,
.bbpress #mpcth_page_wrap #mpcth_content #bbp-user-wrapper .favorite-toggle,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_separator.vc_sep_color_grey .vc_sep_line,
#mpcth_page_wrap #mpcth_main .mpc-vc-deco-header,
#mpcth_page_wrap #mpcth_content .mpcth-post .mpcth-post-title,
#mpcth_page_wrap #mpcth_content .mpcth-post,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_accordion_header,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav > li,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tabs_nav,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tour .wpb_tab,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_tabs .wpb_tabs_nav,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_toggle .mpcth-toggle-mark,
#mpcth_page_wrap .mpcth-deco-header,
#mpcth_page_wrap
		{ border-color: ' . $mpcth_options['mpcth_colors_content_border'] . '; }

#mpcth_page_wrap #mpcth_content .mpcth-deco-header .mpcth-color-main-border,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs #review_form_wrapper #reply-title,
#mpcth_page_wrap #mpcth_comments #reply-title,
.blog #mpcth_content .mpcth-post .mpcth-post-title > a,
.page-template-template-blog-php #mpcth_content .mpcth-post .mpcth-post-title > a,
#mpcth_page_wrap #mpcth_main .mpc-vc-deco-header span,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li.active a,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .woocommerce-tabs .tabs li:hover a
		{ border-color: ' . $mpcth_options['mpcth_colors_content_heading'] . ' !important; }

#jckqv #jckqv_summary h1:after,
#jckqv #jckqv_summary .product_meta:after,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_separator.mpcth-separator .vc_sep_holder_l .vc_sep_line:before,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_meta:after,
.woocommerce-page.single-product #mpcth_page_wrap #mpcth_content > .product .product_share:after,
#mpcth_page_wrap #mpcth_main .wpb_separator:before,
#mpcth_page_wrap #mpcth_main .vc_text_separator:before
		{ background-color: ' . $mpcth_options['mpcth_colors_content_heading'] . ' !important; }

#mpcth_page_wrap
		{ color: ' . $mpcth_options['mpcth_colors_content_font'] . '; }';

		// Footer colors
		$custom_styles .= '
#mpcth_footer_section
		{ background-color: ' . $mpcth_options['mpcth_colors_footer_background'] . ';';

        if( !empty( $enable_footer_image ) && $enable_footer_image ) {
            $custom_styles .= 'background-repeat:' . $mpcth_options['mpcth_colors_footer_bg_repeat'] . ';';
			$custom_styles .= 'background-size: ' . $mpcth_options['mpcth_colors_footer_bg_size'] . ';';
            $custom_styles .= $mpcth_options['mpcth_colors_footer_bg_align'] ? 'background-position:' . $mpcth_options['mpcth_colors_footer_bg_align'] . ';' : '';

            $custom_styles .= 'background-image:url('. $mpcth_options['mpcth_colors_footer_bg_image'] .');';
        }

$custom_styles .= '}

#mpcth_footer #mpcth_toggle_mobile_footer,
#mpcth_footer #mpcth_footer_section,
#mpcth_footer #mpcth_footer_section .widget-title
		{ border-color: ' . $mpcth_options['mpcth_colors_footer_border'] . '; }

#mpcth_footer_section
		{ color: ' . $mpcth_options['mpcth_colors_footer_font'] . '; }

#mpcth_page_wrap #mpcth_footer .widget.widget_text a:hover
		{ color: ' . $mpcth_options['mpcth_colors_footer_active'] . '; }

#mpcth_page_wrap #mpcth_footer_section ul li:before
		{ border-left-color: ' . $mpcth_options['mpcth_colors_footer_active'] . '; }

#mpcth_page_wrap #mpcth_footer_section .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_footer_active'] . ' !important; }

#mpcth_page_wrap #mpcth_footer_section .widget-title .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_footer_heading'] . ' !important; }';

		// Extended footer colors
		$custom_styles .= '
#mpcth_footer_extended_section
		{ background-color: ' . $mpcth_options['mpcth_colors_footer_ex_background'] . ';';

        if( !empty( $enable_footer_ex_image ) && $enable_footer_ex_image ) {
            $custom_styles .= 'background-repeat:' . $mpcth_options['mpcth_colors_footer_ex_bg_repeat'] . ';';
			$custom_styles .= 'background-size: ' . $mpcth_options['mpcth_colors_footer_ex_bg_size'] . ';';
            $custom_styles .= $mpcth_options['mpcth_colors_footer_ex_bg_align'] ? 'background-position:' . $mpcth_options['mpcth_colors_footer_ex_bg_align'] . ';' : '';

            $custom_styles .= 'background-image:url('. $mpcth_options['mpcth_colors_footer_ex_bg_image'] .');';
        }

$custom_styles .= '}

#mpcth_footer_extended_content:after
		{ background-color: ' . $mpcth_options['mpcth_colors_footer_ex_border'] . '; }

#mpcth_footer #mpcth_toggle_mobile_extended_footer,
#mpcth_footer #mpcth_footer_extended_section .widget-title,
#mpcth_footer #mpcth_footer_extended_section
		{ border-color: ' . $mpcth_options['mpcth_colors_footer_ex_border'] . '; }

#mpcth_footer_extended_section
		{ color: ' . $mpcth_options['mpcth_colors_footer_ex_font'] . '; }

#mpcth_footer #mpcth_footer_extended_section a:hover
		{ color: ' . $mpcth_options['mpcth_colors_footer_ex_active'] . '; }

#mpcth_page_wrap #mpcth_footer_extended_section ul li:before
		{ border-left-color: ' . $mpcth_options['mpcth_colors_footer_ex_active'] . '; }

#mpcth_page_wrap #mpcth_footer_extended_section .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_footer_ex_active'] . ' !important; }

#mpcth_page_wrap #mpcth_footer_extended_section .widget-title .mpcth-color-main-border
		{ border-color: ' . $mpcth_options['mpcth_colors_footer_ex_heading'] . ' !important; }';

		// Copyright colors
		$custom_styles .= '
#mpcth_footer_copyrights_section
		{ background-color: ' . $mpcth_options['mpcth_colors_copyright_background'] . '; }

#mpcth_footer #mpcth_footer_copyrights_wrap,
#mpcth_footer #mpcth_footer_copyrights_section
		{ border-color: ' . $mpcth_options['mpcth_colors_copyright_border'] . '; }

#mpcth_footer #mpcth_footer_copyrights_wrap
		{ color: ' . $mpcth_options['mpcth_colors_copyright_font'] . '; }

#mpcth_footer #mpcth_footer_copyrights_section a:hover
		{ color: ' . $mpcth_options['mpcth_colors_copyright_active'] . '; }';
	}

	/* Custom font sizes */
	if (! empty($mpcth_options['mpcth_use_advance_font_sizes']) && $mpcth_options['mpcth_use_advance_font_sizes']) {
		// Header font sizes
		$custom_styles .= '
#mpcth_page_wrap #mpcth_nav,
#mpcth_page_wrap #mpcth_controls_wrap
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_menu'] . '; }

#mpcth_page_wrap #mpcth_controls_wrap
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_button'] . '; }';

		// Secondary header font sizes
		$custom_styles .= '
#mpcth_page_wrap #mpcth_page_header_secondary_content
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_second'] . '; }';

		// Header Widget Area font sizes
		$custom_styles .= '
#mpcth_header_area_wrap #mpcth_header_area .widget-title
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_area_header'] . '; }

#mpcth_header_area_wrap #mpcth_header_area,
#mpcth_header_area_wrap #mpcth_header_area .widget
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_area_content'] . '; }

#mpcth_header_area_wrap #mpcth_header_area .post-date,
#mpcth_header_area_wrap #mpcth_header_area small
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_area_small'] . '; }';

		// Dropdown font sizes
		$custom_styles .= '
#mpcth_page_wrap #mpcth_page_header_wrap .sub-menu,
#mpcth_page_wrap #mpcth_controls_wrap #mpcth_mini_cart,
#mpcth_page_wrap #mpcth_controls_wrap #mpcth_mini_search
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_dropdown'] . '; }

#mpcth_page_wrap #mpcth_page_header_secondary_content #mpcth_secondary_mini_menu .sub-menu
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_second_dropdown'] . '; }';

		// Search font sizes
		$custom_styles .= '
#mpcth_page_wrap #mpcth_smart_search_wrap,
#mpcth_page_wrap #mpcth_mini_search
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_header_search'] . '; }';

		// Page font sizes
		$custom_styles .= '
#mpcth_page_wrap #mpcth_content_wrap .mpcth-page-title,
#mpcth_page_wrap #mpcth_content_wrap .mpcth-post-title
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_content_header'] . ' !important; }

#mpcth_page_wrap #mpcth_content_wrap,
#mpcth_page_wrap #mpcth_content_wrap .mpcth-post-content
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_content_content'] . '!important;  }

#mpcth_page_wrap #mpcth_content_wrap small,
#mpcth_page_wrap #mpcth_content_wrap .mpcth-post-categories,
#mpcth_page_wrap #mpcth_content_wrap .mpcth-post-meta,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .mpcth-slide-count,
#mpcth_page_wrap #mpcth_main_container #mpcth_content_wrap .mpcth-slide-time
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_content_small'] . '!important;  }';

		// Sidebar font sizes
		$custom_styles .= '
#mpcth_page_wrap #mpcth_sidebar .widget-title
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_sidebar_header'] . '; }

#mpcth_page_wrap #mpcth_sidebar .widget
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_sidebar_content'] . '; }

#mpcth_page_wrap #mpcth_sidebar .post-date,
#mpcth_page_wrap #mpcth_sidebar small
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_sidebar_small'] . '; }';

		// Footer font sizes
		$custom_styles .= '
#mpcth_footer #mpcth_footer_section .widget-title
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_header'] . '; }

#mpcth_footer #mpcth_footer_section,
#mpcth_footer #mpcth_footer_section .widget
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_content'] . '; }

#mpcth_footer #mpcth_footer_section .post-date,
#mpcth_footer #mpcth_footer_section small
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_small'] . '; }';

		// Extended footer font sizes
		$custom_styles .= '
#mpcth_footer #mpcth_footer_extended_section .widget-title
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_ex_header'] . '; }

#mpcth_footer #mpcth_footer_extended_section,
#mpcth_footer #mpcth_footer_extended_section .widget
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_ex_content'] . '; }

#mpcth_footer #mpcth_footer_extended_section .post-date,
#mpcth_footer #mpcth_footer_extended_section small
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_ex_small'] . '; }';

		// Copyright font sizes
		$custom_styles .= '
#mpcth_footer #mpcth_footer_copyrights_section,
#mpcth_footer #mpcth_footer_copyrights_section #mpcth_footer_socials
		{ font-size: ' . $mpcth_options['mpcth_font_sizes_footer_copyright'] . '; }';
	}

	/* Overwrite Shortcodes Colors */
	if (isset($mpcth_options['mpcth_overwrite_shortcodes_colors']) && $mpcth_options['mpcth_overwrite_shortcodes_colors'] == '1')
		$custom_styles .= "
#mpcth_page_wrap .wpb_call_to_action .wpb_button_a { background: $main_color !important; }
#mpcth_page_wrap .wpb_call_to_action .wpb_button_a .mpcth-cta-arrow { border-color: $main_color !important; }
#mpcth_main .vc_cta3 .vc_cta3_content-container .vc_cta3-actions button.vc_btn3 { background: $main_color !important; border-color: $main_color !important; }
#mpcth_page_wrap .vc_btn3 { background-color: $main_color; }
#mpcth_page_wrap .vc_btn3 { background-color: $main_color; }
#mpcth_page_wrap .vc_progress_bar .vc_single_bar .vc_bar { background: $main_color !important; }
#mpcth_page_wrap .vc_progress_bar .vc_single_bar .vc_label { color: #ffffff !important; }
#mpcth_page_wrap .mpc-vc-icon-column-wrap .mpc-vc-icon-column-icon i { color: $main_color; }
#mpcth_page_wrap .mpc-vc-icon-column-wrap:hover .mpc-vc-icon-column-icon .mpc-vc-icon-column-arrow { border-top-color: $main_color !important; }
#mpcth_page_wrap .mpc-vc-icon-column-wrap:hover .mpc-vc-icon-column-icon { background: $main_color !important; }
#mpcth_page_wrap .mpc-sc-highlight { background: $main_color !important; }
#mpcth_page_wrap .mpc-sc-dropcaps { background: $main_color !important; }
#mpcth_page_wrap .mpc-sc-tooltip-message { background: $main_color !important; border-top-color: $main_color !important; }
#mpcth_page_wrap .mpc-vc-icons-list li i { color: $main_color; }
#mpcth_page_wrap .slide6_text1 { color: $main_color; }
#mpcth_page_wrap .slide6_text2 .mpcth-price-big { color: $main_color; }
#mpcth_page_wrap .slide2_main_text { color: $main_color; }
#mpcth_page_wrap .mpcth-circle-badge2 { background: $main_color; }
		";

	/* Buttons Border Color disable */
	if( $mpcth_options['mpcth_disable_buttons_border'] )
		$custom_styles .= '
#bbpress-forums #bbp_search_submit, #bbpress-forums .summary .yith-wcwl-add-to-wishlist a,
#bbpress-forums #searchsubmit, #bbpress-forums #review_form_wrapper #submit,
#bbpress-forums button.button, #bbpress-forums input.button, #bbpress-forums a.button,
#searchform #bbp_search_submit, #searchform .summary .yith-wcwl-add-to-wishlist a,
#searchform #searchsubmit, #searchform #review_form_wrapper #submit,
#searchform button.button, #searchform input.button, #searchform a.button,
#mpcth_page_wrap .woocommerce #bbp_search_submit,
#mpcth_page_wrap .woocommerce .summary .yith-wcwl-add-to-wishlist a,
#mpcth_page_wrap .woocommerce #searchsubmit,
#mpcth_page_wrap .woocommerce #review_form_wrapper #submit,
#mpcth_page_wrap .woocommerce button.button, #mpcth_page_wrap .woocommerce input.button,
#mpcth_page_wrap .woocommerce a.button, .woocommerce #mpcth_page_wrap #bbp_search_submit,
.woocommerce #mpcth_page_wrap .summary .yith-wcwl-add-to-wishlist a,
.woocommerce #mpcth_page_wrap #searchsubmit,
.woocommerce #mpcth_page_wrap #review_form_wrapper #submit,
.woocommerce #mpcth_page_wrap button.button, .woocommerce #mpcth_page_wrap input.button,
.woocommerce #mpcth_page_wrap a.button,
.woocommerce-page.single-product #mpcth_page_wrap .cart .quantity .plus-wrap,
.woocommerce-page.single-product #mpcth_page_wrap .cart .quantity .minus-wrap,
.woocommerce-cart #mpcth_page_wrap .cart .quantity .plus-wrap,
.woocommerce-cart #mpcth_page_wrap .cart .quantity .minus-wrap,
body #mpcth_page_header_content #mpcth_controls_wrap #mpcth_controls_container > a,
#mpcth_page_wrap #mpcth_mini_cart .button,
#jckqv #jckqv_summary .yith-wcwl-add-to-wishlist a,
#jckqv #jckqv_summary .single_add_to_cart_button,
.blog #mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more,
.page-template-template-blog-php #mpcth_content .mpcth-post .mpcth-post-footer .mpcth-read-more,
#mpcth_page_wrap #mpcth_smart_search_wrap #searchsubmit,
#mpcth_comments #respond #mpcth_comment_form input[type=submit],
.wpcf7 .form-submit .wpcf7-submit,
#mpcth_page_wrap .woocommerce.widget.widget_price_filter .button,
#mpcth_page_wrap .woocommerce.widget.widget_layered_nav_filters .chosen a,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .wpb_button,
#mpcth_page_wrap #mpcth_main #mpcth_content_wrap .vc_btn3,
#mpcth_page_wrap .mpcth-page .mpcth-page-content .post-password-form input[type=submit],
#mpcth_page_wrap .mpcth-page .mpcth-page-content .post-password-form input[type=submit]:hover
	{ border-color: transparent; }';

	/* Paddings */
	$custom_styles .= '
body #mpcth_page_header_content
		{ padding: ' . $mpcth_options['mpcth_header_padding'] . ';}';

	$custom_styles .= '
body #mpcth_page_header_secondary_content
		{ padding: ' . $mpcth_options['mpcth_header_secondary_padding'] . '; }';

	$custom_styles .= '
body #mpcth_footer_content
		{ padding: ' . $mpcth_options['mpcth_footer_padding'] . '; }';

	$custom_styles .= '
body #mpcth_footer_extended_content
		{ padding: ' . $mpcth_options['mpcth_footer_extended_padding'] . '; }';

	$custom_styles .= '
body #mpcth_footer_copyrights_section
		{ padding: ' . $mpcth_options['mpcth_copyright_padding'] . ';}';

	/* Header Vertical Center */
	if ( $mpcth_options['mpcth_enable_vertical_center'] )
		$custom_styles .= "
#mpcth_menu > .menu-item > a,
#mpcth_page_wrap #mpcth_mega_menu .widget ul.menu > li > a,
body #mpcth_page_header_content #mpcth_controls_wrap
	{ padding: 1.5em .3em 1.5em; }
#mpcth_page_wrap #mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_controls_wrap #mpcth_controls_container
	{ padding: 0; }
body #mpcth_page_header_content #mpcth_controls_wrap,
body #mpcth_page_header_content #mpcth_nav
	{ vertical-align: middle; }
		";

	/* Panel Custom CSS */
	if (isset($mpcth_options['mpcth_custom_css'])) {
		$custom_styles .= PHP_EOL . html_entity_decode(stripslashes(stripslashes($mpcth_options['mpcth_custom_css'])));
	}

	$style_file = @fopen(get_stylesheet_directory() . '/style_custom.css', 'w');

	if ($style_file === false)
		return 0;

	$saved = fwrite($style_file, $custom_styles);
	fclose($style_file);

	if($saved !== false) {
		$mpc_theme = wp_get_theme();
		update_option('mpc_theme_version', $mpc_theme->get('Version'));

		return 2;
	} else {
		return 0;
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
			'href' => admin_url( 'admin.php?page=mpcth-options-framework' )
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
