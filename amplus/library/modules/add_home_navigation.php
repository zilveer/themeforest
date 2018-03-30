<?php

// adds a 'home' dummy page for building menus
class BFIModuleAddHomeNavigation {
    public static function run() {
        add_filter('wp_page_menu_args', array(__CLASS__, 'addHome'));
    }
    
    public static function addHome($args) {
        $args['show_home'] = true;
        return $args;
    }
}

BFIModuleAddHomeNavigation::run();