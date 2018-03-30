<?php
/**
 */

/**
 * Decodes the name of the Cufon font from it's filename
 *
 * @deprecated Google WebFonts are now used
 * @ignore
 * @param string $fontfile The filename of the font
 * @return string The font name
 */
function bfi_get_fontname_from_fontfile($fontfile) {
    $fontFiles = bfi_get_font_filenames();
    
    $key1 = '';
    $key2 = 0;
    
    $found = false;
    foreach ($fontFiles as $key => $files) {
        $key1 = $key;
        foreach ($files as $key => $filename) {
            $key2 = $key;
            if ($fontfile == $filename) {
                $found = true;
                break;
            }
        }
        if ($found) break;
    }
    
    if (!$found) return $fontfile;
    
    $fontNames = bfi_get_font_names();
    return $fontNames[$key1][$key2]; 
}