<?php

/**
 * Loads the whole library and application files
 */

// load theme-specific settings
if (file_exists(TEMPLATEPATH.'/application/settings.php'))
    require_once(TEMPLATEPATH.'/application/settings.php');
// load the library settings
require_once(TEMPLATEPATH.'/library/settings.php');

// we need this helper for BFILoader
require_once(TEMPLATEPATH.'/library/helpers/bfi_get_filenames_from_dir.php');
// we need for reading theme options
require_once(TEMPLATEPATH.'/library/helpers/bfi_get_option_functions.php');

BFILoader::requireOverridableLibraryFiles('helpers');
BFILoader::requireOverridableLibraryFiles('models');
BFILoader::requireOverridableLibraryFiles('models/pagemedia');
BFILoader::requireOverridableLibraryFiles('models/admin');
BFILoader::requireOverridableLibraryFiles('models/admin/panel');
BFILoader::requireOverridableLibraryFiles('models/admin/option');
BFILoader::requireOverridableLibraryFiles('models/admin/meta');
BFILoader::requireOverridableLibraryFiles('models/admin/pagebuilder');
BFILoader::requireOverridableLibraryFiles('models/admin/plugin');
BFILoader::requireOverridableLibraryFiles('models/sidebar');
BFILoader::requireOverridableLibraryFiles('models/navigation');
BFILoader::requireOverridableLibraryFiles('models/shortcode');
BFILoader::requireOverridableLibraryFiles('models/widget');
BFILoader::requireOverridableLibraryFiles('controllers');
BFILoader::requireOverridableLibraryFiles('controllers/admin');
BFILoader::requireOverridableLibraryFiles('modules');


if (is_admin()) {
    $notificationController = new BFIAdminNotificationController();
    $scriptController = new BFIAdminScriptController();
    $metaController = new BFIAdminMetaController();
    $tinymceController = new BFITinyMCEController();
    $pluginController = new BFIAdminPluginController();
} else {
    $shortcodeController = new BFIShortcodeController();
    $scriptController = new BFIScriptController();
}    
$controller = new BFIAdminController();
$navigationController = new BFINavigationController();
$portoflioController = new BFIPortfolioController();
$pagemediaController = new BFIPagemediaController();
$sidebarController = new BFISidebarController();
$widgetController = new BFIWidgetController();
$pagebuilderController = new BFIAdminPagebuilderController();



class BFILoader {
    public static function getOverridableLibraryFile($path, $urlForm = false) {
        if (stripos($path, '/') == 0) {
            $path = substr($path, 1);
        }
        if (file_exists(BFI_APPLICATIONPATH.$path)) {
            if ($urlForm) return BFI_APPLICATIONURL.$path;
            return BFI_APPLICATIONPATH.$path;
        }
        if ($urlForm) return BFI_LIBRARYURL.$path; 
        return BFI_LIBRARYPATH.$path;
    }

    public static function requireOverridableLibraryFile($path) {
        require_once(self::getOverridableLibraryFile($path));
    }
    
    public static function requireOverridableLibraryFiles($path, $applicationOverride = true) {
        $filenames = self::getOverridableLibraryFiles($path, $applicationOverride);
        foreach ($filenames as $filename) {
            if (!preg_match('/\.php$/i', $filename)) continue;
            require_once($filename);
        }
    }

    // includes the proper view, prioritizing application views before the library views 
    public static function includeViewTemplate($callingFile = 'index.php', 
                                               $subfolder = '') {
        $callingFile = basename($callingFile);
        $callingFile = $subfolder ? $subfolder . '/' . $callingFile : $callingFile;
        if (file_exists(BFI_APPLICATIONPATH.'views/'.$callingFile)) {
            include(BFI_APPLICATIONPATH.'views/'.$callingFile);
        } else {
            @(include(BFI_LIBRARYPATH.'views/'.$callingFile)) or die("ERROR: ".BFI_LIBRARYPATH.'views/'.$callingFile." is missing from the theme.");
        }
    }

    // gets all files in the given path, prioritizing same-named files in the application
    // folder first before the library folder
    public static function getOverridableLibraryFiles($path, $applicationOverride = true) {
        $files = array();
        
        if (stripos($path, '/') == 0 && stripos($path, '/') !== false)
            $path = substr($path, 1);
        
        // load the library files
        $libraryFullFilenames = bfi_get_filenames_from_dir(TEMPLATEPATH.'/library/'.$path, '*');
        
        // if no need to override, require everything
        if (!$applicationOverride) {
            foreach ($libraryFullFilenames as $filename) {
                $files[] = $filename;
            }
            return $files;
        }
        
        // load the application files
        $applicationFullFilenames = bfi_get_filenames_from_dir(TEMPLATEPATH.'/application/'.$path, '*');
        $applicationFilenames = array();
        foreach ($applicationFullFilenames as $filename) {
            $applicationFilenames[] = str_replace(TEMPLATEPATH.'/application', '', $filename);
        }
        
        // require the library files WHICH are not present in the application files
        foreach ($libraryFullFilenames as $i => $filename) {
            $libraryFilename = str_replace(TEMPLATEPATH.'/library', '', $filename);
            if (!in_array($libraryFilename, $applicationFilenames)) {
                $files[] = $filename;
            }
        }
    
        // require ALL the application files
        foreach ($applicationFullFilenames as $filename) {
            $files[] = $filename;      
        }
        
        return $files;
    } 
}
