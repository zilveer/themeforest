<?php
/**
 */

/**
 * Enqueues a Google WebFont
 *
 * @param string @optionName The option name for the google font option
 * @param array @deps The handle names of the style dependencies
 * @return string The generated handle name of the enqueued style
 */
function bfi_wp_enqueue_googlefont($optionName, $deps = array()) {
    
    $fontName = bfi_get_option($optionName);
    
    // At first init of theme, our data won't be a serialized array
    // it will be just the 'key' of the font properties.
    // get the correct script name for that key
    if (!preg_match('/^([adObis]:|N;)/', $fontName)) {
        $allFonts = bfi_get_googlefonts();
        if (!array_key_exists($fontName, $allFonts)) {
            return false;
        }
        // create the required array
        // this is the same format that we're saving
        $currFont = array('src' => $fontName,
                          'css' => $allFonts[$fontName]['css']);
    } else {
        // normal serialized behavior
        $currFont = unserialize($fontName);
    }
    
    $charSets = unserialize(bfi_get_option(BFI_CHARACTERSETOPTION));
    
    if (is_array($charSets)) $charSets = implode(',', $charSets);
    else $charSets = '';
    
    $charSets = $charSets ? "&amp;subset=$charSets" : "";
    
    // prevent loading of same fonts by using the name - style pair
    // of the font as the name
    $styleName = preg_replace("/[^a-zA-Z0-9]+/", "", strtolower($currFont['src']));
    
    bfi_wp_enqueue_style(
        'googlefont-' . $styleName, 
        'http://fonts.googleapis.com/css?family=' . $currFont['src'] . $charSets, 
        $deps, 
        NULL);
    
    return 'googlefont-' . $optionName;
}