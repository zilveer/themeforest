<?php
/*
Plugin Name: Options Framework
Plugin URI: http://www.wptheming.com
Description: A framework for building theme options.
Version: 0.8
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
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

/* Basic plugin definitions */

define('OPTIONS_FRAMEWORK_VERSION', '0.9');

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little plugin, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'optionsframework_rolescheck' );

function optionsframework_rolescheck () {
	if ( current_user_can( 'edit_theme_options' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action( 'admin_menu', 'optionsframework_add_page');
		add_action( 'admin_init', 'optionsframework_init' );
		//add_action( 'admin_init', 'optionsframework_mlu_init' );
	}
}

/* Loads the file for option backup */

add_action('init', 'optionsframework_load_backup' );

function optionsframework_load_backup() {
	//require_once dirname( __FILE__ ) . '/options-backup.php';
}

/* Loads the file for option sanitization */

add_action('init', 'optionsframework_load_sanitization' );

function optionsframework_load_sanitization() {
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
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

function optionsframework_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-medialibrary-uploader.php';
	
	require_once (OPTIONS_FRAMEWORK_ROOT . 'options-data.php');
	
	$optionsframework_settings = get_option('optionsframework' );
	
	// Updates the unique option id in the database if it has changed
	optionsframework_option_name();
	
	// Gets the unique id, returning a default if it isn't defined
	if ( isset($optionsframework_settings['id']) ) {
		$option_name = $optionsframework_settings['id'];
	}
	else {
		$option_name = 'optionsframework';
	}
	
	
	//Check if theme has data
	$theme_data_status = get_option( $option_name . '_init');
	
	if ($theme_data_status<>"") {
		//OK
		} else {
		options_setdefaults();
		update_option( $option_name . '_init', '1'  );
	}
	
	
	// If the option has no saved data, load the defaults
	//if ( ! get_option($option_name) ) {
	//	optionsframework_setdefaults();
	//}
	
	// Registers the settings fields and callback
	//if (!isset( $_POST['OptionsFramework-backup-import'] )) {
	//	register_setting( 'optionsframework', $option_name, 'optionsframework_validate' );
	//}
	if ( isSet($_POST['mtheme_options_nonce']) ) {
	if ( empty($_POST) || !wp_verify_nonce($_POST['mtheme_options_nonce'], basename(__FILE__))) {
		// Don't pass me by
		print 'Sorry, your nonce did not verify.';
	} else {
		if (isset( $_POST['update'] )) {
			$clean = array();
			$options = optionsframework_options();
			$exportpack="array(";
			$update_values = true;

			//print_r($options);

			// IMPORT user entered export data pack.
			$importpack=array();
			$importpack = $_POST[$option_name]['importpack'];

			if ( $importpack<>"" && is_serialized($importpack) ) {

				add_settings_error( 'options-framework', 'restore_defaults', __( 'Options Imported!', 'mthemelocal' ), 'updated fade' );

				$update_values = false;
				$import_value = "";
				$importpack =  stripslashes_deep($importpack);
				$imported_values = array();
				$imported_values = unserialize($importpack);
				//var_export($imported_values);
				foreach($imported_values as $key => $value) {
					//echo $key;
					//echo $value;
					foreach($value as $store_key => $store_value) {
						//echo $store_key;
						//echo $store_value;

						update_option('mtheme_' . $store_key, $store_value );

						if ( is_array($store_value) && $store_key=="header_section_order" ) {
							//update('mtheme_' . $home_key, $store_value );
							foreach($store_value as $home_key => $home_value) {
								//echo $home_key;
								//echo $home_value;

							}
						}
					}
				}


			    update_option( 'mtheme_exportpack', $importpack  );
			} elseif ( $importpack<>"" && !is_serialized($importpack) ) {
				add_settings_error( 'options-framework', 'restore_defaults', __( 'Invalid Import', 'mthemelocal' ), 'error fade' );
			} else {
				add_settings_error( 'options-framework', 'restore_defaults', __( 'Options Saved!', 'mthemelocal' ), 'updated fade' );
			}

		if ($update_values) {

			$countarray=0;
			$export_options=array();
			foreach($options as $value) {
			
				if ( isset($value['id'] ) && ! empty($value['id']) ) {
					
					if (isset($_POST[$option_name][$value['id']])) {
					
						$hold_save_value = $_POST[$option_name][ $value['id']];
						
						if ( $value['type']=="text" ) {
							$hold_save_value = stripslashes_deep ( $hold_save_value );
						}
						
						if ( !isset ($option) ) $option="";
						
						if ($value['type'] == "dragdrop_sorter") {
							$sort_array = $hold_save_value;
							$save_value=array();
							foreach($sort_array as $sortkey => $sortstate) {
								$save_value[] = $sortkey;
							}

						} else {
							$save_value = apply_filters( 'of_sanitize_' . $value['type'], $hold_save_value, $option );
						}
					
					}
					
					if ($value['type']=="checkbox") {
						if ( isset( $_POST[$option_name][ $value['id'] ] ) ) {
							$save_value = '1';
						} else {
							$save_value = false;
						}
					}
					// Skip the export pack and import pack values. Store everything else.
					if ( $value['id']!="exportpack" && $value['id']!="importpack") {

						update_option( 'mtheme_' . $value['id'], $save_value  );
						
						if ($value['type'] == "dragdrop_sorter") {
							$export_options[] =  array($value['id'] => $save_value);

						} else {
							$export_options[] =  array($value['id'] => $save_value);
						}
					}
				}
				
			}

			$exportpack = serialize($export_options);
			update_option( 'mtheme_exportpack', $exportpack  );
		}

		}
		
		if ( isset( $_POST['reset'] ) ) {
			options_setdefaults();
		}
	} // End of Nonce Check
	}
	
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
 
 
function options_setdefaults() {
	add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'mthemelocal' ), 'updated fade' );
	$output = array();
	$options = optionsframework_options();
	foreach($options as $value) {
		$default_value="";
		if ( isset($value['id'] ) && ! empty($value['id']) ) {
			
			if (isset( $value['std'] )) {
				$default_value=$value['std'];
			} else {
				if ($value['type']=="checkbox") {
					$default_value = '0';
				} else {
					$default_value = false;
				}
			}
			if ($value['type'] == "dragdrop_sorter") {
				$sort_array = $default_value;
				foreach($sort_array as $sortkey => $sortstate) {
					$default_value[] = $sortkey;
				}

			}
		//$opt_pack .= $value['type'] . " << VALUE ID " . $value['id'] . " >> | " . $_POST[$option_name][ $value['id']] . " || " .  $save_value . "<br/>";
		// Save the options
			delete_option('mtheme_' . $value['id']);
			update_option( 'mtheme_' . $value['id'], $default_value  );
			//echo $value['id'] . "----------" . $default_value . "<br/>";

		}
	}
}

function optionsframework_setdefaults() {
	
	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	/* 
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.  
	 *
	 */
	
	if ( isset($optionsframework_settings['knownoptions']) ) {
		$knownoptions =  $optionsframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$optionsframework_settings['knownoptions'] = $knownoptions;
			update_option('optionsframework', $optionsframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$optionsframework_settings['knownoptions'] = $newoptionname;
		update_option('optionsframework', $optionsframework_settings);
	}
	
	// Gets the default options data from the array in options.php
	$options = optionsframework_options();
	
	// If the options haven't been added to the database yet, they are added now
	$values = of_get_default_values();
	
	if ( isset($values) ) {
		add_option( $option_name, $values ); // Add option with default settings
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if ( !function_exists( 'optionsframework_add_page' ) ) {
function optionsframework_add_page() {

	$of_page = add_menu_page(
		'Options', 
		'Options', 
		'edit_theme_options', 
		'options-framework',
		'optionsframework_page',
		OPTIONS_FRAMEWORK_DIRECTORY.'images/options-settings16.png',
		61
		);
	
	// Adds actions to hook in the required css and javascript
	add_action("admin_print_styles-$of_page",'optionsframework_load_styles');
	add_action("admin_print_scripts-$of_page", 'optionsframework_load_scripts');
	
}
}

/* Loads the CSS */

function optionsframework_load_styles() {
	wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY.'css/admin-style.css');
	//wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'css/colorpicker.css');
}	

/* Loads the javascript */

function optionsframework_load_scripts() {

	// Inline scripts from options-interface.php
	add_action('admin_head', 'of_admin_head');
	
	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');
	//wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'js/colorpicker.js', array('jquery'));
	wp_enqueue_style( 'wp-color-picker' );
	//wp_enqueue_script('wp-color-picker');
	wp_enqueue_script( 'options-custom', OPTIONS_FRAMEWORK_DIRECTORY.'js/options-custom.js', array( 'wp-color-picker' ), false, true );
	//wp_enqueue_script('options-custom', OPTIONS_FRAMEWORK_DIRECTORY.'js/options-custom.js', array('jquery'));
	
	// Transfered from the core admin file.
	//wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	 
	//wp_enqueue_script("jqueryui", OPTIONS_FRAMEWORK_DIRECTORY."js/jquery-ui-1.8.7.custom.min.js", array( 'jquery' ), "1.0");
	//wp_enqueue_script("range_script", OPTIONS_FRAMEWORK_DIRECTORY."js/rangeinput.js", array( 'jquery' ), "1.0");
	wp_enqueue_script("init-script", OPTIONS_FRAMEWORK_DIRECTORY."js/init.js", array( 'jquery' ), "1.0");
}

function of_admin_head() {

	// Hook to add custom scripts
	do_action( 'optionsframework_custom_scripts' );
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

if ( !function_exists( 'optionsframework_page' ) ) {
function optionsframework_page() {
	//$return = optionsframework_fields();
	?>
    <div class="options_wrap">
	<div class="wrap">

	<div class="clear"></div>
	<form method="post"> 
		<?php /* Top buttons */ ?>
		<div id="optionsframework-submit">
			<div class="optionsframework-submit-inner">
				<span><?php echo get_screen_icon( $screen = 'settings'); ?>
				<div class="options-title">Theme Options</div>
				<input type="submit" class="button-primary topbutton-right" name="update" value="<?php esc_attr_e( 'Save Options' ); ?>" />

				</span>
				
	            <div class="clear"></div>
				<?php settings_errors(); ?>
			</div>
		</div>
    <div class="nav-tab-wrapper">
        <?php echo optionsframework_tabs(); ?>
    </div>
    
    <div class="metabox-holder">

    <div id="optionsframework" class="postbox">
		
		<?php settings_fields('optionsframework'); ?>

		<?php optionsframework_fields(); /* Settings */ ?>
        
        <?php /* Bottom buttons */ ?>
        <div id="optionsframework-reset">
        	<?php echo '<input type="hidden" name="mtheme_options_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />'; ?>
			<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options' ); ?>" />
            <input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!','mthemelocal' ) ); ?>' );" />
            <div class="clear"></div>
		</div>
	
	</div> <!-- / #container -->
	</div>
</form>
</div>
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
 * @uses $_POST['reset']
 * @uses $_POST['update']
 */
function optionsframework_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */
	 
	if ( isset( $_POST['reset'] ) ) {
		add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'mthemelocal' ), 'updated fade' );
		return of_get_default_values();
	}

	/*
	 * Udpdate Settings.
	 */
	 
	if ( isset( $_POST['update'] ) ) {
		$clean = array();
		$options = optionsframework_options();
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
				$input[$id] = '0';
			}

			// Set each item in the multicheck to false if it wasn't sent in the $_POST
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = '0';
				}
			}

			// For a value to be submitted to database it must pass through a sanitization filter
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		add_settings_error( 'options-framework', 'save_options', __( 'Options saved.', 'mthemelocal' ), 'updated fade' );
		return $clean;
	}

	/*
	 * Request Not Recognized.
	 */
	
	return of_get_default_values();
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
 
function of_get_default_values() {
	$output = array();
	$config = optionsframework_options();
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
		update_option ('mtheme_'.$option['std']);
		if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
	}
	//return $output;
}

/**
 * Add Theme Options menu item to Admin Bar.
 */
 
add_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );

function optionsframework_adminbar() {
	
	global $wp_admin_bar;
	
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id' => 'of_theme_options',
		'title' => __( 'Theme Options','mthemelocal' ),
		'href' => admin_url( 'themes.php?page=options-framework' )
  ));
}

if ( ! function_exists( 'of_get_option' ) ) {

	/**
	 * Get Option.
	 *
	 * Helper function to return the theme option value.
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */
	 
	function of_get_option( $name, $default = false ) {
		/**
		$config = get_option( 'optionsframework' );

		if ( ! isset( $config['id'] ) ) {
			return $default;
		}

		$options = get_option( $config['id'] );
		
		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}
		*/
		
		$opt_value=get_option( 'mtheme_' .  $name );
		if ( isset( $opt_value ) ) {
			return $opt_value;
		}

		return $default;
	}
}