<?php
/**
 */

/**
 * alternative for glob. Uses glob AND for failsafe uses opendir
 *
 * @internal used by the framework loader to include scripts
 * @return array Filenames of all matching files in the directory
 */
function bfi_get_filenames_from_dir($dir, $filenamePattern) {
    $dir .= substr($dir, -1) == "/" ? "" : "/";
    
    // try and use glob function 
    $filenames = glob($dir.$filenamePattern);
    
    if (is_array($filenames) && count($filenames) > 0 && $filenames !== False) {
        return $filenames;
    }
    
    // if glob doesn't work, try opendir and readdir
    $filenames = array();
    if (!is_dir($dir)) return $filenames;
    
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && fnmatch($filenamePattern, $file)) {
                $filenames[] = $dir.$file;
            }
        }
    }
    closedir($handle);
    return $filenames;
}