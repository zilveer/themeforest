<?php
/**************************/
/* Include LayerSlider WP */
/**************************/
 
// Path for LayerSlider WP main PHP file
$layerslider = get_template_directory() . '/include/plugin/layerslider/layerslider.php';
 
// Check if the file is available to prevent warnings
if(file_exists($layerslider)) {
 
    // Include the file
    include $layerslider;
 
    // Get last version number, defaults to 1.0
    $layerslider_last_version = get_option('layerslider_last_version', '1.0');
 
    // Activate the plugin if necessary
    if(get_option('<unique_prefix>_layerslider_activated', '0') == '0') {
 
        // Run activation script
        layerslider_activation_scripts();
 
        // Save a flag that it is activated, so this won't run again
        update_option('<unique_prefix>_layerslider_activated', '1');
 
        // Save the current version number of LayerSlider
        update_option('layerslider_last_version', $GLOBALS['lsPluginVersion']);
 
    // Do version check
    } else if(version_compare($GLOBALS['lsPluginVersion'], $layerslider_last_version, '>')) {
 
        // Run again activation scripts for possible adjustments
        layerslider_activation_scripts();
 
        // Update the version number
        update_option('layerslider_last_version', $GLOBALS['lsPluginVersion']);
    }
}

// Register your custom function to override some LayerSlider data
add_action('layerslider_ready', 'my_layerslider_overrides');

// Define your function
function my_layerslider_overrides() {
	 
	// Items to override
	$GLOBALS['lsPluginPath'] = get_template_directory_uri() . '/include/plugin/layerslider/';
	$GLOBALS['lsAutoUpdateBox'] = false;
}

?>