<?php

class BFIShortcodeController {
    
    private static $loadedShortcodes = array();
    // this is just a compilation of all the loaded shortcode names
    public static $aliases = array();
    
    function __construct() {
        $this->loadShortcodes();
    }
    
    // load all sidebars in application/models/shortcode
    private function loadShortcodes() {
        $definedClasses = get_declared_classes();
        self::$loadedShortcodes = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIShortcode[a-zA-Z0-9]+Model$/', $className)) {
                $o = new $className();
                $this->getAliases($o);
                self::$loadedShortcodes[] = $o;
            }
        }
    }
    
    private function getAliases($shortcodeModel) {
        $val = constant(get_class($shortcodeModel).'::SHORTCODE');
        if ($val) self::$aliases[$val] = $shortcodeModel;
        $val = constant(get_class($shortcodeModel).'::ALIAS');
        if ($val) self::$aliases[$val] = $shortcodeModel;
        $val = constant(get_class($shortcodeModel).'::ALIAS2');
        if ($val) self::$aliases[$val] = $shortcodeModel;
        $val = constant(get_class($shortcodeModel).'::ALIAS3');
        if ($val) self::$aliases[$val] = $shortcodeModel;
    }
}
