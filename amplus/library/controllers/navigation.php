<?php

class BFINavigationController {
    
    public static $loadedNavigationModels = array();
    
    function __construct() {
        $this->loadNavigationModels();
        $this->registerNavigationModels();
    }
    
    private function loadNavigationModels() {
        $definedClasses = get_declared_classes();
        self::$loadedNavigationModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFINavigation[a-zA-Z0-9]+Model$/', $className)) {
                self::$loadedNavigationModels[] = new $className();
            }
        }
    }
    
    private function registerNavigationModels() {
        foreach (self::$loadedNavigationModels as $navigationModel) {
            register_nav_menus(array(
                $navigationModel->slug => $navigationModel->name
                ));
        }
    }
}
