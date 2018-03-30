<?php
/**
 */
 
/**
 * Gets an option set from the admin, use this instead of WP's get_option
 *
 * This is an optimized get_option function that uses the data from
 * a single global array instead of performing a database call.
 *
 * @package API\WordPress Replacements
 * @param string $option the name of the option
 * @param mixed $default the value to return if the option does not exist.
 * @return mixed the value stored in the database
 */
function bfi_get_option($option, $default = false) {
    $val = bfi_get_option_old($option, $default);
    if (!$val && strpos($option, BFI_SHORTNAME.'_') === false)
        $val = bfi_get_option_old(BFI_SHORTNAME.'_'.$option);
    
    $val = apply_filters('bfi_get_option', $val, $option);
    
    return $val;
}

/**
 * 
 * @internal Used by bfi_get_option function
 * @param string $option the name of the option
 * @param mixed $default the value to return if the option does not exist.
 * @return mixed the value stored in the database
 */
function bfi_get_option_old($option, $default = false) {
    global $bfiGlobalOptions;
    if (!isset($bfiGlobalOptions)) $bfiGlobalOptions = get_option(BFI_SHORTNAME.'_global_settings');
    if ($bfiGlobalOptions == '' || !is_array($bfiGlobalOptions)) $bfiGlobalOptions = array();
    
    // if (BFI_LIVEPREVIEWMODE && isset($_SESSION[$option]) && $_SESSION[$option] != '')
    //     return $_SESSION[$option];
    
    if (strpos($option, BFI_SHORTNAME.'_') !== false) {
        /* 
         * multilanguage filter
         */
        if (isset($_SESSION["l"])) {
            if (array_key_exists($option.'_'.$_SESSION["l"], $bfiGlobalOptions)) {
                return $bfiGlobalOptions[$option.'_'.$_SESSION["l"]];
            }
        }
    
        /*
         * normal behavior
         */
        if (array_key_exists($option, $bfiGlobalOptions)) {
            return $bfiGlobalOptions[$option];
        }
    }
    
    return get_option($option, $default);
}

/**
 * Updates an option set from the admin, use this instead of WP's update_option
 *
 * This is an optimized update_option function that uses the data from
 * a single global array instead of performing a database call.
 *
 * @package API\WordPress Replacements
 * @param string $option the name of the option
 * @param mixed $newvalue the value to save
 * @return mixed the new value stored in the database
 */
function bfi_update_option($option, $newvalue) {
    global $bfiGlobalOptions;
    
    if (strpos($option, BFI_SHORTNAME.'_') === false) {
        $option = BFI_SHORTNAME.'_'.$option;
    }
    
    $bfiGlobalOptions = bfi_get_option('global_settings');
    if ($bfiGlobalOptions == '' || !is_array($bfiGlobalOptions)) $bfiGlobalOptions = array();
    $bfiGlobalOptions[$option] = $newvalue;
    return update_option(BFI_SHORTNAME.'_global_settings', $bfiGlobalOptions);
    
    // return update_option($option, $newvalue);
}


/**
 * Adds an option set from the admin, use this instead of WP's add_option
 *
 * This is an optimized add_option function that uses the data from
 * a single global array instead of performing a database call.
 *
 * @package API\WordPress Replacements
 * @param string $option the name of the option
 * @param mixed $value the value to save
 * @param string $deprecated unused, leave as default
 * @param string $autoload unused, leave as default
 * @return mixed the new value stored in the database
 */
function bfi_add_option($option, $value = '', $deprecated = '', $autoload = 'yes') {
    global $bfiGlobalOptions;
    
    if (strpos($option, BFI_SHORTNAME.'_') !== false) {
        $bfiGlobalOptions = get_option(BFI_SHORTNAME.'_global_settings');
        if ($bfiGlobalOptions == '' || !is_array($bfiGlobalOptions)) $bfiGlobalOptions = array();
        $bfiGlobalOptions[$option] = $value;
        return update_option(BFI_SHORTNAME.'_global_settings', $bfiGlobalOptions);
    }
    
    return add_option($option, $value, $deprecated, $autoload);
}


/**
 * Deletes an option set from the admin, use this instead of WP's delete_option
 *
 * This is an optimized delete_option function that uses the data from
 * a single global array instead of performing a database call.
 *
 * @package API\WordPress Replacements
 * @param string $option the name of the option
 * @return null
 */
function bfi_delete_option($option) {
    global $bfiGlobalOptions;
    
    if (strpos($option, BFI_SHORTNAME.'_') !== false) {
        $bfiGlobalOptions = get_option(BFI_SHORTNAME.'_global_settings');
        if ($bfiGlobalOptions == '' || !is_array($bfiGlobalOptions)) $bfiGlobalOptions = array();
        if (array_search($option, $bfiGlobalOptions) !== false) {
            unset($bfiGlobalOptions[$option]);
            return update_option(BFI_SHORTNAME.'_global_settings', $bfiGlobalOptions);
        }
    }
    
    return delete_option($option);
}
